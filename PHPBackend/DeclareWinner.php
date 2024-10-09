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

            $sql2 = "UPDATE voting_position SET setposition_status = REPLACE(setposition_status, 'Voted', '')";

            // Prepare and execute the update statement to remove 'Voted'
            if ($stmt2 = $conn->prepare($sql2)) {
                if ($stmt2->execute()) {
                    error_log("Removed 'Voted' from setposition_status successfully.");
                } else {
                    error_log("SQL Error during update: " . $stmt2->error);
                }
                $stmt2->close();
            } else {
                error_log("SQL Error preparing update: " . $conn->error);
            }


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
        $timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : '';
    
        // Start a transaction to ensure all updates happen together
        $conn->begin_transaction();
    
        try {
            // First update query for the top 9 winners in user_votes where won_date is empty or NULL
            $sql1 = "UPDATE user_votes
                     SET status = 'Winner', new_status = 'NewWinner', access = 'Declared', won_date = ?
                     WHERE unique_id IN (
                         SELECT unique_id 
                         FROM (
                            SELECT unique_id 
                            FROM user_votes 
                            WHERE (won_date IS NULL OR won_date = '') 
                            AND (fail_date IS NULL OR fail_date = '')
                            ORDER BY votes DESC
                            LIMIT 9
                         ) AS TopCandidates
                     ) AND (won_date = '' OR won_date IS NULL)";
    
            // Prepare and bind the timestamp value
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("s", $timestamp);
            if (!$stmt1->execute()) {
                throw new Exception("Error updating winners in user_votes: " . $stmt1->error);
            }
            $stmt1->close();
    
            // Second update query for winners in the voting table where won_date is empty or NULL
            $sql2 = "UPDATE voting v
                    JOIN user_votes uv ON v.unique_id = uv.unique_id
                    SET v.status = uv.status, v.won_date = uv.won_date, v.access = CASE 
                        WHEN v.access != 'Declared' THEN 'Declared' 
                        ELSE v.access 
                    END
                    WHERE uv.status = 'Winner' AND (v.access != 'Declared' OR v.access IS NULL)";

    
            $stmt2 = $conn->prepare($sql2);

            if (!$stmt2->execute()) {
                throw new Exception("Error updating winners in voting: " . $stmt2->error);
            }
            $stmt2->close();
    
            // Update all candidates where access is empty to "Failure" in user_votes
            $sql3 = "UPDATE user_votes
                     SET status = 'Failure', access = 'Declared', fail_date = ?
                     WHERE access IS NULL OR access = ''";
    
            $stmt3 = $conn->prepare($sql3);
            $stmt3->bind_param("s", $timestamp);
            if (!$stmt3->execute()) {
                throw new Exception("Error updating failures in user_votes: " . $stmt3->error);
            }
            $stmt3->close();
    
            // Update all candidates where access is empty to "Failure" in voting
            $sql4 = "UPDATE voting v
                    JOIN user_votes uv ON v.unique_id = uv.unique_id
                    SET v.status = uv.status, v.fail_date = uv.fail_date, v.access = CASE 
                        WHEN v.access != 'Declared' THEN 'Declared' 
                        ELSE v.access 
                    END
                    WHERE uv.status = 'Failure' AND (v.access != 'Declared' OR v.access IS NULL)";

    
            $stmt4 = $conn->prepare($sql4);
            
            if (!$stmt4->execute()) {
                throw new Exception("Error updating failures in voting: " . $stmt4->error);
            }
            $stmt4->close();
    
            // Update voting status to "VotingEnded"
            $updateStatusSql = "UPDATE voting_countdown SET voting_status = 'VotingEnded' WHERE voting_status = 'VotingStarted'";
            if ($conn->query($updateStatusSql) !== TRUE) {
                throw new Exception("Database error occurred while updating voting status.");
            }
    
            // Commit the transaction
            $conn->commit();
            $response = ['success' => true];
            error_log('Query successful, winners declared, failures updated, and voting status updated to VotingEnded.');
            
        } catch (Exception $e) {
            // Rollback the transaction in case of any errors
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            $response = ['success' => false, 'error' => $e->getMessage()];
        }
    
        // Close the connection and send response
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
            $sql = "SELECT COUNT(vh.unique_id) AS vote_count
                    FROM voting_history vh, voting_countdown vc
                    WHERE vh.unique_id = ? 
                    AND vc.voting_status = 'VotingStarted'
                    AND vh.vote_date BETWEEN vc.start_time AND vc.end_time
                    ";

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
            $unique_id = isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : null;
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
    
    } elseif ($action === 'insert_positions') {
        $winnerUID = $_POST['winnerUID'];
        $new_statusUID = $_POST['winnerUID'];
        $setPositionStats = 'Voted';

        // Collecting all positions and their corresponding data
        $positions = [
            ['position' => $_POST['presidentPosition'], 'name' => $_POST['presidentName'], 'uid' => $_POST['presidentUID']],
            ['position' => $_POST['vicePresidentPosition'], 'name' => $_POST['vicePresidentName'], 'uid' => $_POST['vicePresidentUID']],
            ['position' => $_POST['secretaryPosition'], 'name' => $_POST['secretaryName'], 'uid' => $_POST['secretaryUID']],
            ['position' => $_POST['treasurerPosition'], 'name' => $_POST['treasurerName'], 'uid' => $_POST['treasurerUID']],
            ['position' => $_POST['auditorPosition'], 'name' => $_POST['auditorName'], 'uid' => $_POST['auditorUID']],
            ['position' => $_POST['peaceInOrderPosition'], 'name' => $_POST['peaceInOrderName'], 'uid' => $_POST['peaceInOrderUID']],
            ['position' => $_POST['director1Position'], 'name' => $_POST['director1Name'], 'uid' => $_POST['director1UID']],
            ['position' => $_POST['director2Position'], 'name' => $_POST['director2Name'], 'uid' => $_POST['director2UID']],
            ['position' => $_POST['director3Position'], 'name' => $_POST['director3Name'], 'uid' => $_POST['director3UID']],
        ];

        $setPosition = $_POST['setPositionDate'];

        // SQL query to insert each role in the table
        $sql = "INSERT INTO voting_position (unique_id, positions, candidate_name, candidate_uid, setposition_date, setposition_status) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $sql2 = "UPDATE user_votes SET new_status = REPLACE(new_status, 'NewWinner', '') WHERE unique_id = ?";  

        // Prepare and execute the update statement for user_votes
        if ($stmt2 = $conn->prepare($sql2)) {
            $stmt2->bind_param("i", $new_statusUID); // Binding the unique_id to the query
            if ($stmt2->execute()) {
                error_log("Updated new_status for UID: $new_statusUID successfully.");
            } else {
                error_log("SQL Error during update: " . $stmt2->error);
            }
            $stmt2->close();
        } else {
            error_log("SQL Error preparing update: " . $conn->error);
        }


        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            foreach ($positions as $pos) {
                $stmt->bind_param("ssssss", $winnerUID, $pos['position'], $pos['name'], $pos['uid'], $setPosition, $setPositionStats);

                // Execute the statement for each position
                if (!$stmt->execute()) {
                    $response = ['success' => false, 'error' => 'Database error: ' . $stmt->error];
                    closeConnectionAndRespond($conn, $response);
                    exit; // Exit to avoid further insertions after an error
                }
            }

            // If all insertions were successful
            $response = ['success' => true, 'message' => 'Positions inserted successfully'];
        } else {
            $response = ['success' => false, 'error' => 'Database error: ' . $conn->error];
        }

        $stmt->close();
        closeConnectionAndRespond($conn, $response);
    
    } elseif ($action === 'check_voting_positions') {
        // Get the unique_id from the AJAX request data
        $user_unique_id = isset($_POST['unique_id']) ? $_POST['unique_id'] : '';
        error_log('User unique_id: ' . $user_unique_id);

        if (!empty($user_unique_id)) {
            // Query to check if the user has already voted in the voting history table
            $sql = "SELECT COUNT(unique_id) AS vote_count FROM voting_position WHERE unique_id = ? AND setposition_status = 'Voted'";

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
    
    } elseif ($action === 'check_new_winners') {
        $sql = "SELECT COUNT(*) as new_winners_count FROM user_votes WHERE new_status = 'NewWinner'";

            $result = $conn->query($sql);

            if ($result) {
                $row = $result->fetch_assoc();
                $count = $row['new_winners_count'];

                if ($count == 0) {
                    $response = ['success' => true, 'message' => 'All Gone', 'count' => $count];
                } else {
                    $response = ['success' => true, 'message' => 'New winners present', 'count' => $count];
                }
            } else {
                error_log("SQL Error: " . $conn->error);
                $response = ['success' => false, 'error' => 'Database error: ' . $conn->error];
            }

            closeConnectionAndRespond($conn, $response); 
    
    } elseif ($action === 'tally_votes') {
        // Remove all 'Winner' statuses from the user_votes table
        $resetWinnersSql1 = "UPDATE user_votes SET status = '' WHERE status = 'Winner'";
    
        // Execute the reset query
        if ($conn->query($resetWinnersSql1) === TRUE) {
            error_log('Previous winner statuses reset.');
        } else {
            error_log('Error resetting previous winner statuses: ' . $conn->error);
        }
    
        // New code for tallying votes
        $sql = "
            SELECT positions, candidate_name, candidate_uid, COUNT(*) as votes
            FROM voting_position
            WHERE setposition_status = 'Voted'
            GROUP BY positions, candidate_name, candidate_uid
            ORDER BY positions, votes DESC;

        ";
    
        $result = $conn->query($sql);
    
        if ($result) {
            $voteTally = [];
    
            while ($row = $result->fetch_assoc()) {
                $position = $row['positions'];
                $candidateName = $row['candidate_name'];
                $candidateUID = $row['candidate_uid'];
                $votes = $row['votes'];
    
                // Store the candidate with the highest votes for each position
                if (!isset($voteTally[$position]) || $voteTally[$position]['votes'] < $votes) {
                    $voteTally[$position] = [
                        'candidate_name' => $candidateName,
                        'candidate_uid' => $candidateUID,
                        'votes' => $votes
                    ];
                }
            }
    
            // Mapping of positions to roles
            $roleMapping = [
                'President' => ['bod_id' => 1],
                'VicePresident' => ['bod_id' => 2],
                'Secretary' => ['bod_id' => 3],
                'Treasurer' => ['bod_id' => 4],
                'Auditor' => ['bod_id' => 5],
                'PeaceInOrder' => ['bod_id' => 6],
                'Director1' => ['bod_id' => 7],
                'Director2' => ['bod_id' => 8],
                'Director3' => ['bod_id' => 9],
            ];
    
            // Update the officials table with the winners
            foreach ($voteTally as $position => $winnerData) {
                if (isset($roleMapping[$position])) {
                    $bodId = $roleMapping[$position]['bod_id'];
                    $winnerName = $winnerData['candidate_name'];
                    $candidateUid = $winnerData['candidate_uid']; // Get candidate_uid for image retrieval
    
                    // Retrieve the winner's unique_id and image from the voting table using candidate_uid
                    $imageSql = "SELECT unique_id, img FROM voting WHERE unique_id = ?"; // Assuming unique_id is the correct column
                    $stmtImg = $conn->prepare($imageSql);
                    $stmtImg->bind_param('s', $candidateUid); // Use candidate_uid here to get the corresponding unique_id
                    $stmtImg->execute();
                    $stmtImg->bind_result($winnerUniqueId, $winnerImg);
                    $stmtImg->fetch();
                    $stmtImg->close();
    
                    // Prepare the update query
                    $updateSql = "
                        UPDATE officials
                        SET name = ?, img = ?
                        WHERE bod_id = ?
                    ";
    
                    $stmt = $conn->prepare($updateSql);
                    $stmt->bind_param('ssi', $winnerName, $winnerImg, $bodId);
                    $stmt->execute();
    
                    // Check for errors
                    if ($stmt->error) {
                        // Log the error for debugging
                        error_log("MySQL error: " . $stmt->error);
                    }
                    $stmt->close();
                }
            }
    
            $response = [
                'success' => true,
                'votes' => $voteTally
            ];
        } else {
            $response = ['success' => false, 'error' => 'Database error: ' . $conn->error];
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