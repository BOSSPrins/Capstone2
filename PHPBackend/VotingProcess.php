<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:\xampp\apache\logs\error.log');

error_log('Received POST data: ' . print_r($_POST, true)); 

header('Content-Type: application/json');
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

// Function to handle errors and respond with JSON
function handleError($errno, $errstr, $errfile, $errline) {
    echo json_encode(['success' => false, 'error' => "$errstr in $errfile on line $errline"]);
    exit();
}

set_error_handler('handleError');

// Function to close the connection and send a JSON response
function closeConnectionAndRespond($conn, $response) {
    $conn->close();
    echo json_encode($response);
    exit();
}

// Debugging: Output POST data
error_log('POST Data: ' . print_r($_POST, true));

// Handle AJAX request for fetching resident ID sa smart search
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstname'])) {
    // Retrieve the input data
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';

     // Prepare the SQL query using LIKE for partial matching
     $stmt = $conn->prepare("SELECT unique_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name 
                            FROM tblresident 
                            WHERE first_name LIKE ? AND middle_name LIKE ? AND last_name LIKE ?");

    if (!$stmt) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
    }

    // Add wildcards (%) for partial matching
    $firstname = '%' . $firstname . '%';
    $middlename = '%' . $middlename . '%';
    $lastname = '%' . $lastname . '%';

    $stmt->bind_param("sss", $firstname, $middlename, $lastname);

    // Execute the query
    if (!$stmt->execute()) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt->error]);
    }

    $result = $stmt->get_result();
    $suggestions = [];

    // Fetch the results
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = [
            'unique_id' => $row['unique_id'],
            'full_name' => $row['full_name'] // Concatenated full name
        ];
    }

    // Return the suggestions as JSON
    if (count($suggestions) > 0) {
        closeConnectionAndRespond($conn, ['success' => true, 'suggestions' => $suggestions]);
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Resident not found']);
    }
}

// Handle form submission for adding a candidate
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['candi_IMG'])) {
    $candi_ID = isset($_POST['candi_ID']) ? $_POST['candi_ID'] : '';
    $candi_Name = isset($_POST['candi_Name']) ? $_POST['candi_Name'] : '';
    $candi_IMG = $_FILES['candi_IMG'];
    $add_date = isset($_POST['timestamp2']) ? $_POST['timestamp2'] : '';

    // Check if the candidate already exists with a status other than 'Winner'
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM voting WHERE (unique_id = ? OR candidate_name = ?)
                                         AND status != 'Winner' AND status != 'Failure'");

    $checkStmt->bind_param("ss", $candi_ID, $candi_Name);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        // Candidate already exists and is not a Winner, return an error
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Candidate already exists']);
        exit; // Stop further processing
    }

    // Define the upload directory
    $uploadDir = '../Pictures/';
    $uploadFile = $uploadDir . basename($candi_IMG['name']);

    // Move the uploaded file to the server
    if (move_uploaded_file($candi_IMG['tmp_name'], $uploadFile)) {
        $filename = basename($candi_IMG['name']); // Get only the filename

        // Prepare the SQL statement to insert data into the 'voting' table
        $stmt1 = $conn->prepare("INSERT INTO voting (unique_id, candidate_name, img, add_date) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("ssss", $candi_ID, $candi_Name, $filename, $add_date);

        // Prepare the SQL statement to insert data into the 'user_votes' table
        $stmt2 = $conn->prepare("INSERT INTO user_votes (unique_id, candidate) VALUES (?, ?)");
        $stmt2->bind_param("ss", $candi_ID, $candi_Name);

        // Execute both queries
        if ($stmt1->execute() && $stmt2->execute()) {
            $candidate = [
                'unique_id' => $candi_ID,
                'candidate_name' => $candi_Name,
                'img' => $filename,
                'add_date' => $add_date
            ];
            closeConnectionAndRespond($conn, ['success' => true, 'candidate' => $candidate]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt1->error . ' | ' . $stmt2->error]);
        }

        $stmt1->close();
        $stmt2->close();
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Please Upload an Image']);
    }
}

// Pang kuha ng mga boto papuntang table
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetchTable') {
    // SQL query to fetch the candidate and votes information
    $sql = "SELECT unique_id, candidate, votes AS votes_count 
            FROM user_votes 
            WHERE won_date = '' AND fail_date = '' 
            ORDER BY votes DESC";

    $result = $conn->query($sql);

    if ($result) {
        $candidates = [];
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;  // Fetches the 'candidate' and 'votes' fields from the table
        }
        // Respond with the candidates data
        closeConnectionAndRespond($conn, ['success' => true, 'candidates' => $candidates]);
    } else {
        // Handle SQL query error
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Query failed: ' . $conn->error]);
    }
}

// Fetch the latest candidate from the database para sa bobotohan ng user at summary ng modal
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action']; // Get the action from the query parameters

    // Get the session unique ID, if available
    $sessionUniqueId = isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : null;

    if (!$sessionUniqueId) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Session unique ID is missing']);
        exit; // Exit if sessionUniqueId is not available
    }

    if ($action === 'fetchCandidates') {
        // Action 1: Fetch candidates excluding the current user, with empty won_date
        $sql = "SELECT unique_id, candidate_name, img 
                FROM voting 
                WHERE won_date = '' 
                AND unique_id != '$sessionUniqueId' 
                ORDER BY vote_id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $candidates = [];
            while ($candidate = $result->fetch_assoc()) {
                $candidates[] = $candidate;
            }
            closeConnectionAndRespond($conn, ['success' => true, 'candidates' => $candidates]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'No candidates found']);
        }

    } else if ($action === 'fetchVotes') {
        // Action 2: Fetch candidates (without including votes column), without excluding the current user
        $sql = "SELECT unique_id, candidate_name, img 
                FROM voting 
                WHERE won_date = '' 
                ORDER BY vote_id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $candidates = [];
            while ($candidate = $result->fetch_assoc()) {
                $candidates[] = $candidate;
            }
            closeConnectionAndRespond($conn, ['success' => true, 'candidates' => $candidates]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'No candidates found']);
        }
    } else {
        // If the action is not recognized
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid action specified']);
    }
} else {
    // Invalid request method or missing action parameter
    closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid request']);
}

// Pang insert ng boto ng user sa unang botohan


?>