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

// Generate a random number for start_id and end_id
function generateRandomId() {
    return rand(1000, 9999);  // Example: generates a number between 1000 and 9999
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? trim($_POST['action']) : null;
    error_log('Action received: ' . $action);

    if ($action === 'store_end_time') {
        $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : null;
        $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : null;
        $voting_status = isset($_POST['voting_status']) ? $_POST['voting_status'] : null;

        if ($end_time && $start_time && $voting_status) {
            // Generate the same random number for start_id and end_id
            $random_id = generateRandomId();
            $start_id = $random_id;
            $end_id = $random_id;

            $sql = "INSERT INTO voting_countdown (start_id, start_time, end_id, end_time, voting_status)
                    VALUES (?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE start_time = VALUES(start_time), end_time = VALUES(end_time), voting_status = VALUES(voting_status)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("issss", $start_id, $start_time, $end_id, $end_time, $voting_status);
                if ($stmt->execute()) {
                    $response = ['success' => true, 'message' => 'End time, start time, and voting status updated successfully.'];
                    error_log('End time, start time, and voting status updated successfully.');
                } else {
                    error_log("SQL Error: " . $stmt->error);
                    $response = ['success' => false, 'error' => "Database error occurred"];
                }
                $stmt->close();
            } else {
                error_log("SQL Error: " . $conn->error);
                $response = ['success' => false, 'error' => "Database error occurred"];
            }
        } else {
            $response = ['success' => false, 'error' => 'Missing end_time, start_time, or voting_status'];
        }

        closeConnectionAndRespond($conn, $response);

    } elseif ($action === 'fetch_times') {
        $sql = "SELECT start_time, end_time, voting_status FROM voting_countdown WHERE voting_status = 'VotingStarted' ORDER BY start_time DESC LIMIT 1";
        
        if ($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            
                // Get the current time
                date_default_timezone_set('Asia/Manila');  // Ensure correct timezone
                $current_time = date('Y-m-d H:i:s');

                // Format the start and end times properly without any trailing characters
                $start_time = rtrim($row['start_time'], '.');  // Remove any trailing periods from the start time
                $end_time = rtrim($row['end_time'], '.');      // Remove any trailing periods from the end time
                
                $start_time = strtotime($row['start_time']);
                $end_time = strtotime($row['end_time']);
                $current_time_str = strtotime($current_time);

                // Log debug info
                error_log("Start Time: " . $row['start_time']);   // Log the start time
                error_log("End Time: " . $row['end_time']);       // Log the end time
                error_log("Current Time: " . $current_time);      // Log the current server time
            
                // Check if the start time is in the future or equal to the current time
                if (strtotime($row['start_time']) <= strtotime($current_time) && strtotime($current_time) <= strtotime($row['end_time'])) {
                    // Start time is valid (equal to or in the future)
                    $response = [
                        'success' => true,
                        'start_time' => $row['start_time'],  // Add start_time
                        'end_time' => $row['end_time'],
                        'voting_status' => $row['voting_status']
                    ];
                } else {
                    // Start time is in the past, so return an error
                    $response = [
                        'success' => false,
                        'error' => 'Start time is in the past.'
                    ];
                }
            } else {
                $response = ['success' => false, 'error' => 'No data found'];
            }
            
        } else {
            error_log("SQL Error: " . $conn->error);
            $response = ['success' => false, 'error' => "Database error occurred"];
        }

        closeConnectionAndRespond($conn, $response);

    } elseif ($action === 'declare_winner') {
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
            // Update voting status to "VotingEnded"
            $updateStatusSql = "UPDATE voting_countdown SET voting_status = 'VotingEnded' WHERE voting_status = 'VotingStarted'";
            if ($conn->query($updateStatusSql) === TRUE) {
                $response = ['success' => true];
                error_log('Query successful and voting status updated to VotingEnded.');
            } else {
                error_log("SQL Error: " . $conn->error);
                $response = ['success' => false, 'error' => "Database error occurred while updating status"];
            }
        } else {
            error_log("SQL Error: " . $conn->error);
            $response = ['success' => false, 'error' => "Database error occurred"];
        }

        closeConnectionAndRespond($conn, $response);

    } elseif ($action === 'delete_voting_started') {
        // SQL query to delete voting record where status is 'VotingStarted'
        $sql = "DELETE FROM voting_countdown WHERE voting_status = 'VotingStarted'";

        if ($conn->query($sql) === TRUE) {
            $response = ['success' => true, 'message' => 'Voting status reset successfully.'];
            error_log('Voting status reset successfully.');
        } else {
            error_log("SQL Error: " . $conn->error);
            $response = ['success' => false, 'error' => "Failed to reset voting status."];
        }

        closeConnectionAndRespond($conn, $response);

        // Etong part na to pababa sa user side na to 
    } elseif ($action === 'check_voting_history') {
        // Get the unique_id from the AJAX request data
        $user_unique_id = isset($_POST['unique_id']) ? $_POST['unique_id'] : '';
        error_log('User unique_id: ' . $user_unique_id);

        if (!empty($user_unique_id)) {
            // Query to check if the user has already voted in the voting history table
            $sql = "SELECT COUNT(*) AS vote_count FROM voting_history WHERE unique_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $user_unique_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                // Check if the user has already voted
                if ($row['vote_count'] > 0) {
                    // If vote count is greater than 0, the user has voted
                    $response = ['success' => true, 'voted' => true, 'message' => 'User has already voted.'];
                } else {
                    // No vote found for this user
                    $response = ['success' => true, 'voted' => false, 'message' => 'User has not voted yet.'];
                }
                $stmt->close();
            } else {
                error_log("SQL Error: " . $conn->error);
                $response = ['success' => false, 'error' => "Database error occurred"];
            }
        } else {
            $response = ['success' => false, 'error' => 'Missing unique ID.'];
        }

        closeConnectionAndRespond($conn, $response);

    } elseif ($action === 'fetch_overlay_message') {
        // Logic for fetching the most recent message from the database
        $sql = "SELECT voting_status FROM voting_countdown ORDER BY countdown_id DESC LIMIT 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = ['success' => true, 'status' => $row['voting_status']];
        } else {
            $response = ['success' => false, 'error' => 'No message found'];
        }
        
        closeConnectionAndRespond($conn, $response);
    
    } elseif ($action === 'check_winner') {
            $unique_id = $_POST['unique_id'] ?? '';
            $response = ['success' => false, 'display' => false]; // Default response
    
            if (!empty($unique_id)) {
                // Query to check if the unique_id is a winner
                $sql = "
                    SELECT a.unique_id 
                    FROM user_votes uv
                    JOIN tblaccounts a ON uv.unique_id = a.unique_id
                    WHERE uv.unique_id = ? AND uv.status = 'Winner'
                ";
    
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param('s', $unique_id); // Bind the unique_id
                    $stmt->execute();
                    $stmt->store_result();
    
                    if ($stmt->num_rows > 0) {
                        $response['success'] = true;
                        $response['display'] = true; // If the status is 'Winner', allow display
                    }
    
                    $stmt->close();
                } else {
                    error_log("SQL Error: " . $conn->error);
                    $response = ['success' => false, 'error' => "Database error occurred"];
                }
            }
    
            closeConnectionAndRespond($conn, $response);

    } else {
        $response = ['success' => false, 'error' => 'Invalid request'];
        closeConnectionAndRespond($conn, $response);
    }
} else {
    $response = ['success' => false, 'error' => 'Invalid request method'];
    closeConnectionAndRespond($conn, $response);
}
?>
