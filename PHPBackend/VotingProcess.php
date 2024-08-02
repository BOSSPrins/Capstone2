<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Handle AJAX request for fetching resident ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstname'])) {
    // Retrieve the input data
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';

    // Prepare and bind
    $stmt = $conn->prepare("SELECT unique_id FROM tblresident WHERE first_name = ? AND middle_name = ? AND last_name = ?");
    if (!$stmt) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
    }
    
    $stmt->bind_param("sss", $firstname, $middlename, $lastname);
    
    // Execute the query
    if (!$stmt->execute()) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt->error]);
    }
    
    $stmt->bind_result($unique_id);
    $stmt->fetch();
    
    if ($unique_id) {
         
        // Store the unique_id in the session
        // $_SESSION['unique_id'] = $unique_id;
        closeConnectionAndRespond($conn, ['success' => true, 'unique_id' => $unique_id]);
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Resident not found']);
    }
}

// Handle form submission for adding a candidate
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['candi_IMG'])) {
  $candi_ID = isset($_POST['candi_ID']) ? $_POST['candi_ID'] : '';
  $candi_Name = isset($_POST['candi_Name']) ? $_POST['candi_Name'] : '';
  $candi_IMG = $_FILES['candi_IMG'];

  // Define the upload directory
  $uploadDir = '../Pictures/';
  $uploadFile = $uploadDir . basename($candi_IMG['name']);

  // Move the uploaded file to the server
  if (move_uploaded_file($candi_IMG['tmp_name'], $uploadFile)) {
      $filename = basename($candi_IMG['name']); // Get only the filename

      // Prepare the SQL statement to insert data into the database
      $stmt = $conn->prepare("INSERT INTO voting (unique_id, candidate_name, img) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $candi_ID, $candi_Name, $filename);

        if ($stmt->execute()) {
        $candidate = [
            'unique_id' => $candi_ID,
            'candidate_name' => $candi_Name,
            'img' => $filename
        ];
        closeConnectionAndRespond($conn, ['success' => true, 'candidate' => $candidate]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt->error]);
        }

    $stmt->close();
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Possible file upload attack!']);
    }
}

// Fetch the latest candidate from the database
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT unique_id, candidate_name, img FROM voting ORDER BY vote_id DESC";
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
}

// Fetch candidate data based on candidate ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $candidateId = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT unique_id, candidate_name, img FROM voting WHERE unique_id = ?");
    if (!$stmt) {
        error_log("Statement prepare error: " . $conn->error);
        closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
    }

    $stmt->bind_param("s", $candidateId);

    if (!$stmt->execute()) {
        error_log("Statement execute error: " . $stmt->error);
        closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt->error]);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $candidate = $result->fetch_assoc();
        error_log("Fetched candidate data: " . json_encode($candidate));
        closeConnectionAndRespond($conn, ['success' => true, 'candidate' => $candidate]);
    } else {
        error_log("Candidate not found for ID: " . $candidateId);
        closeConnectionAndRespond($conn, ['success' => true, 'candidate' => null]);
    }
}


// Handle AJAX request for vote submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['voter_id']) && isset($data['candidate_ids'])) {
        $voter_id = $data['voter_id'];
        $candidate_ids = $data['candidate_ids'];

        // Temporarily skip the candidate count check
        // if (count($candidate_ids) !== 9) {
        //     closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Nine candidate IDs are required']);
        // }

        // Prepare variables for bind_param
        $params = array_pad($candidate_ids, 9, '');

        // Prepare SQL statement
        $sql = "INSERT INTO user_voting (unique_id, candidate1, candidate2, candidate3, candidate4, candidate5, candidate6, candidate7, candidate8, candidate9) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
        }

        // Use variables for bind_param
        $stmt->bind_param("ssssssssss", $voter_id, $params[0], $params[1], $params[2], $params[3], $params[4], $params[5], $params[6], $params[7], $params[8]);

        if ($stmt->execute()) {
            closeConnectionAndRespond($conn, ['success' => true, 'message' => 'Votes stored successfully']);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt->error]);
        }
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid request']);
    }
}


// Fetch candidates and their vote counts
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "
        SELECT 
            v.unique_id, 
            v.candidate_name, 
            COALESCE(SUM(uv.votes_count), 0) AS votes
        FROM 
            voting v
        LEFT JOIN (
            SELECT candidate1 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate1
            UNION ALL
            SELECT candidate2 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate2
            UNION ALL
            SELECT candidate3 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate3
            UNION ALL
            SELECT candidate4 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate4
            UNION ALL
            SELECT candidate5 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate5
            UNION ALL
            SELECT candidate6 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate6
            UNION ALL
            SELECT candidate7 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate7
            UNION ALL
            SELECT candidate8 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate8
            UNION ALL
            SELECT candidate9 AS unique_id, COUNT(*) AS votes_count FROM user_voting GROUP BY candidate9
        ) uv
        ON v.unique_id = uv.unique_id
        GROUP BY 
            v.unique_id, v.candidate_name
        ORDER BY 
            votes DESC
    ";
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
}

// Default response for invalid request
closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid request']);
?>