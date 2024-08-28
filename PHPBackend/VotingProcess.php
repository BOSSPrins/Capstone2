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

        // Prepare the SQL statement to insert data into the 'voting' table
        $stmt1 = $conn->prepare("INSERT INTO voting (unique_id, candidate_name, img) VALUES (?, ?, ?)");
        $stmt1->bind_param("sss", $candi_ID, $candi_Name, $filename);

        // Prepare the SQL statement to insert data into the 'user_votes' table
        $stmt2 = $conn->prepare("INSERT INTO user_votes (unique_id, candidate) VALUES (?, ?)");
        $stmt2->bind_param("ss", $candi_ID, $candi_Name);

        // Execute both queries
        if ($stmt1->execute() && $stmt2->execute()) {
            $candidate = [
                'unique_id' => $candi_ID,
                'candidate_name' => $candi_Name,
                'img' => $filename
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


// Fetch the latest candidate from the database para sa bobotohan ng user at summary ng modal
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['votes'])) {
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

// Fetch candidate data based on candidate ID sa add candidate 
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && !isset($_GET['votes'])) {
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

// Pang insert ng boto ng user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['voter_id']) && isset($data['candidate_ids'])) {
        $voter_id = $data['voter_id'];
        $candidate_ids = $data['candidate_ids'];

        // Ensure there are exactly 9 candidate IDs
            // if (count($candidate_ids) !== 9) {
            //     closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Exactly nine candidate IDs are required']);
            // }

        // Prepare variables for bind_param
        $params = array_pad($candidate_ids, 9, '');

        // Prepare SQL statement for inserting votes into voting history
        $sql_insert = "INSERT INTO voting_history (unique_id, candidate1, candidate2, candidate3, candidate4, candidate5, candidate6, candidate7, candidate8, candidate9) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_insert = $conn->prepare($sql_insert);
        if (!$stmt_insert) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
        }

        // Use variables for bind_param
        $stmt_insert->bind_param("ssssssssss", $voter_id, $params[0], $params[1], $params[2], $params[3], $params[4], $params[5], $params[6], $params[7], $params[8]);

        if (!$stmt_insert->execute()) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt_insert->error]);
        }

        // Prepare SQL statement for updating votes
        $sql_update = "UPDATE user_votes SET votes = votes + 1 WHERE unique_id = ?";

        $stmt_update = $conn->prepare($sql_update);
        if (!$stmt_update) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
        }

        // Update votes for each selected candidate
        foreach ($candidate_ids as $candidate_id) {
            // Bind parameter and execute update
            $stmt_update->bind_param("i", $candidate_id);
            if (!$stmt_update->execute()) {
                closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt_update->error]);
            }
        }

        closeConnectionAndRespond($conn, ['success' => true, 'message' => 'Votes stored and updated successfully']);
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid request']);
    }
}

// Pang kuha ng mga boto papuntang table
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id']) && isset($_GET['votes'])) {
    // Fetch candidate data based on votes
    $sql = "SELECT candidate, votes AS votes_count FROM user_votes ORDER BY votes DESC";
    
    $result = $conn->query($sql);
    if ($result) {
        $candidates = [];
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
        closeConnectionAndRespond($conn, ['success' => true, 'candidates' => $candidates]);
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Query failed']);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'declare_war') {
    error_log('POST request received.');

    // Log exact value of 'action' and its length
    $action = isset($_POST['action']) ? trim($_POST['action']) : null;

    // Debugging: Output the action variable and log it
    var_dump($action); // Outputs the exact string and its details
    error_log('Var dump of action: ' . var_export($action, true));

    error_log('Exact value of action parameter: "' . $action . '" with length: ' . strlen($action));

    // Log full POST data to verify it is being sent correctly
    error_log('Full POST data: ' . print_r($_POST, true));

    if (strcasecmp($action, 'declare_winner') === 0) {
        error_log('Action parameter is correct.');

        // SQL to update the top 9 candidates by votes to "winner"
        $sql = "UPDATE user_votes
                SET status = 'Winner'
                WHERE unique_id IN (
                    SELECT unique_id 
                    FROM (
                        SELECT unique_id 
                        FROM user_votes 
                        ORDER BY votes DESC 
                        LIMIT 9
                    ) AS TopCandidates
                )";

        if ($conn->query($sql) === TRUE) {
            $response = ['success' => true];
            error_log('Query successful.');
        } else {
            error_log("SQL Error: " . $conn->error);
            $response = ['success' => false, 'error' => "Database error occurred"];
        }

        closeConnectionAndRespond($conn, $response);
    } else {
        error_log('Invalid action parameter: "' . $action . '" with length: ' . strlen($action));
        $response = ['success' => false, 'error' => 'Invalid request'];
        closeConnectionAndRespond($conn, $response);
    }
} else {
    error_log('Invalid request method: ' . $_SERVER['REQUEST_METHOD']);
    $response = ['success' => false, 'error' => 'Invalid request method'];
    closeConnectionAndRespond($conn, $response);
}
echo "PHP script is working.";
echo 'Error log path: ' . ini_get('error_log');







// Eto yung panglagay ng winner sa mga candidate kapag tapos ng countdown
// Eto yung panglagay ng winner sa mga candidate kapag tapos ng countdown
// error_log('Debugging started.');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     error_log('POST request received.');

//     // Log exact value of 'action' and its length
//     $action = isset($_POST['action']) ? trim($_POST['action']) : null;

//     // Debugging: Output the action variable and log it
//     var_dump($action); // Outputs the exact string and its details
//     error_log('Var dump of action: ' . var_export($action, true));

//     error_log('Exact value of action parameter: "' . $action . '" with length: ' . strlen($action));

//     // Log full POST data to verify it is being sent correctly
//     error_log('Full POST data: ' . print_r($_POST, true));

//     if (strcasecmp($action, 'declare_winner') === 0) {
//         error_log('Action parameter is correct.');

//         // SQL to update the top 9 candidates by votes to "winner"
//         $sql = "UPDATE user_votes
//                 SET status = 'Winner'
//                 WHERE unique_id IN (
//                     SELECT unique_id 
//                     FROM (
//                         SELECT unique_id 
//                         FROM user_votes 
//                         ORDER BY votes DESC 
//                         LIMIT 9
//                     ) AS TopCandidates
//                 )";

//         if ($conn->query($sql) === TRUE) {
//             $response = ['success' => true];
//             error_log('Query successful.');
//         } else {
//             error_log("SQL Error: " . $conn->error);
//             $response = ['success' => false, 'error' => "Database error occurred"];
//         }

//         closeConnectionAndRespond($conn, $response);
//     } else {
//         error_log('Invalid action parameter: "' . $action . '" with length: ' . strlen($action));
//         $response = ['success' => false, 'error' => 'Invalid request'];
//         closeConnectionAndRespond($conn, $response);
//     }
// } else {
//     error_log('Invalid request method: ' . $_SERVER['REQUEST_METHOD']);
//     $response = ['success' => false, 'error' => 'Invalid request method'];
//     closeConnectionAndRespond($conn, $response);
// }
// echo "PHP script is working.";
// echo 'Error log path: ' . ini_get('error_log');




?>