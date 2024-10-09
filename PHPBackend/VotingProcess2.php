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

// Fetch candidate data para sa pagshow ng data ng napiling candidate sa unang summary modal
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $candidateId = $_GET['id'];
  
  $stmt = $conn->prepare("SELECT unique_id, candidate_name, img FROM voting WHERE won_date = '' AND fail_date = '' AND unique_id = ?");
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log('JSON decode error: ' . json_last_error_msg());
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid JSON']);
    }

    // Log received data for debugging
    error_log('Received POST data: ' . print_r($data, true));

    // Check if all necessary data is provided
    if (isset($data['voter_id']) && !empty($data['candidate_ids']) && isset($data['voteStatus']) && isset($data['vote_date'])) {
        $voter_id = $data['voter_id'];
        $candidate_ids = $data['candidate_ids'];
        $voteStatus = $data['voteStatus'];
        $voteDate = $data['vote_date'];

        // Ensure there are at least 1 candidate ID
        if (count($candidate_ids) === 0) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'No candidates selected']);
        }

        // Prepare SQL statement for inserting votes into voting history
        $sql_insert = "INSERT INTO voting_history (unique_id, candidate1, candidate2, candidate3, candidate4, candidate5, candidate6, candidate7, candidate8, candidate9, vote_status, vote_date) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_insert = $conn->prepare($sql_insert);
        if (!$stmt_insert) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
        }

        // Ensure candidate_ids array has exactly 9 elements, fill missing with empty strings
        $params = array_pad($candidate_ids, 9, '');

        // Use variables for bind_param
        $stmt_insert->bind_param("ssssssssssss", $voter_id, $params[0], $params[1], $params[2], $params[3], $params[4], $params[5], $params[6], $params[7], $params[8], $voteStatus, $voteDate);

        if (!$stmt_insert->execute()) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt_insert->error]);
        }

        // Prepare SQL statement for updating votes
        $sql_update = "UPDATE user_votes SET votes = votes + 1 WHERE unique_id = ? AND (won_date IS NULL OR won_date = '') AND (fail_date IS NULL OR fail_date = '')";


        $stmt_update = $conn->prepare($sql_update);
        if (!$stmt_update) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => $conn->error]);
        }

        // Update votes for each selected candidate
        foreach ($candidate_ids as $candidate_id) {
            $stmt_update->bind_param("i", $candidate_id);
            if (!$stmt_update->execute()) {
                closeConnectionAndRespond($conn, ['success' => false, 'error' => $stmt_update->error]);
            }
        }

        closeConnectionAndRespond($conn, ['success' => true, 'message' => 'Votes stored and updated successfully']);
    } else {
        // Log the received data for debugging
        error_log('Invalid request: ' . json_encode($data));
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid request data']);
    }
}
?>