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
        $timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : '';
    
        // Start a transaction to ensure all updates happen together
        $conn->begin_transaction();
    
        try {
            // First update query for the top 9 winners in user_votes where won_date is empty or NULL
            $sql1 = "UPDATE user_votes
                     SET status = 'Winner', access = 'Declared', won_date = ?
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
        // Fetch the most recent voting status
        $sql = "SELECT voting_status FROM voting_countdown ORDER BY countdown_id DESC LIMIT 1;";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if ($row['voting_status'] === 'VotingEnded') {
                // Query to fetch exactly 9 candidates marked as winners
                $winners_sql = "SELECT candidate_name, img FROM voting WHERE status = 'winner' LIMIT 9";
                $winners_result = $conn->query($winners_sql);
                $winners = [];
    
                while ($winner = $winners_result->fetch_assoc()) {
                    $winners[] = $winner;
                }
    
                $response = [
                    'success' => true,
                    'status' => 'VotingEnded',
                    'winners' => $winners
                ];
            } else {
                $response = ['success' => true, 'status' => $row['voting_status']];
            }
        } else {
            $response = ['success' => false, 'error' => 'No message found'];
        }
    
        closeConnectionAndRespond($conn, $response);
        
    } elseif ($action === 'fetch_winners') {

        $pictures_dir = 'Pictures/';

        $sql = "SELECT candidate_name, img, won_date 
                FROM voting 
                WHERE status = 'Winner' 
                ORDER BY won_date DESC";
        
        if ($result = $conn->query($sql)) {
            $winners = [];
            while ($row = $result->fetch_assoc()) {

                $image_path = $pictures_dir . $row['img'];

                $winners[] = [
                    'candidate_name' => $row['candidate_name'],
                    'img' => $image_path,
                    'won_date' => $row['won_date']
                ];
            }
            $response = ['success' => true, 'data' => $winners];
        } else {
            error_log("SQL Error: " . $conn->error);
            $response = ['success' => false, 'error' => "Database error occurred"];
        }

        closeConnectionAndRespond($conn, $response);

    } elseif ($action === 'resident_action') {
        $resident_id = isset($_POST['resident_id']) ? $_POST['resident_id'] : null;
        
        if ($resident_id) {
            // Perform the desired action with the resident ID (for example, fetching more details or updating a field)
            $sql = "SELECT first_name, middle_name, last_name, block, lot, phone_number FROM tblresident WHERE user_id = ?";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $resident_id);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $resident = $result->fetch_assoc();
                        $response = [
                            'success' => true,
                            'message' => 'Resident action successfully processed.',
                            'resident' => $resident
                        ];
                    } else {
                        $response = ['success' => false, 'error' => 'Resident not found'];
                    }
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
            $response = ['success' => false, 'error' => 'Missing resident ID'];
        }

        closeConnectionAndRespond($conn, $response);

    } elseif ($action === 'search_residents') {
            $query = isset($_POST['query']) ? trim($_POST['query']) : '';
         
            // Debugging: Log the received query
            error_log("Search Query: " . $query);

            if ($query !== '') {
                $sql = "SELECT tblresident.user_id, 
                        tblresident.first_name, 
                        tblresident.middle_name, 
                        tblresident.last_name, 
                        tblresident.sex, 
                        tblresident.age, 
                        tblresident.block, 
                        tblresident.lot, 
                        tblresident.unique_id, 
                        tblaccounts.img
                    FROM tblresident
                    INNER JOIN tblaccounts ON tblresident.unique_id = tblaccounts.unique_id
                    WHERE (CONCAT(tblresident.first_name, ' ', tblresident.middle_name, ' ', tblresident.last_name) LIKE ? 
                        OR tblresident.block LIKE ? 
                        OR tblresident.lot LIKE ?)
                    AND tblresident.unique_id NOT IN (
                        SELECT unique_id
                        FROM voting
                        WHERE status = ''
                    )";
                    
                        
                // Debugging: Log the SQL statement
                error_log("SQL Statement: " . $sql);
                
                $stmt = $conn->prepare($sql);
                
                if ($stmt === false) {
                    // Log preparation error
                    error_log("Prepare Statement Error: " . $conn->error);
                    closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Database error occurred']);
                    return;
                }

                $likeQuery = "%" . $query . "%";
                $stmt->bind_param("sss", $likeQuery, $likeQuery, $likeQuery);
                
                // Debugging: Log the binding of parameters
                error_log("Binding Parameters: " . $likeQuery);

                if (!$stmt->execute()) {
                    // Log execution error
                    error_log("Execute Statement Error: " . $stmt->error);
                    closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Database error occurred']);
                    return;
                }

                $result = $stmt->get_result();
                
                // Debugging: Log the number of rows fetched
                error_log("Number of Rows Fetched: " . $result->num_rows);

                $residents = [];
                while ($row = $result->fetch_assoc()) {
                    $residents[] = $row;
                }

                // Return the results as JSON and close connection
                closeConnectionAndRespond($conn, $residents);
            } else {
                // Return an empty array if no query is provided
                closeConnectionAndRespond($conn, []);
            }
    } elseif ($action === 'add_candidate') {
        $unique_id = isset($_POST['unique_id']) ? $_POST['unique_id'] : null;
        $candidate_name = isset($_POST['candidate_name']) ? $_POST['candidate_name'] : null;
        $img = isset($_POST['img']) ? $_POST['img'] : null;
        $add_date = isset($_POST['add_date']) ? $_POST['add_date'] : null;
    
        if ($unique_id && $candidate_name && $img && $add_date) {
            // First insertion query for the voting table
            $sql1 = "INSERT INTO voting (unique_id, candidate_name, img, add_date) VALUES (?, ?, ?, ?)";
            if ($stmt1 = $conn->prepare($sql1)) {
                $stmt1->bind_param("ssss", $unique_id, $candidate_name, $img, $add_date);
                if ($stmt1->execute()) {
                    // If the first query was successful, proceed to insert into user_votes
                    $sql2 = "INSERT INTO user_votes (unique_id, candidate) VALUES (?, ?)";
                    if ($stmt2 = $conn->prepare($sql2)) {
                        $stmt2->bind_param("ss", $unique_id, $candidate_name);
                        if ($stmt2->execute()) {
                            $response = ['success' => true, 'message' => 'Candidate added to both tables successfully.'];
                        } else {
                            error_log("SQL Error on second query: " . $stmt2->error);
                            $response = ['success' => false, 'error' => "Error occurred while adding candidate to user_votes"];
                        }
                        $stmt2->close();
                    } else {
                        error_log("SQL Error: " . $conn->error);
                        $response = ['success' => false, 'error' => "Database error occurred on preparing user_votes statement"];
                    }
                } else {
                    error_log("SQL Error on first query: " . $stmt1->error);
                    $response = ['success' => false, 'error' => "Database error occurred while adding candidate to voting"];
                }
                $stmt1->close();
            } else {
                error_log("SQL Error: " . $conn->error);
                $response = ['success' => false, 'error' => "Database error occurred on preparing voting statement"];
            }
        } else {
            $response = ['success' => false, 'error' => 'Missing candidate data'];
        }
    
        closeConnectionAndRespond($conn, $response);

    // }elseif ($action === 'fetch_history') {
    //     // Fetch winners grouped by won_date
    //     $sql = "SELECT GROUP_CONCAT(candidate_name SEPARATOR ', ') AS candidate_names, won_date, vote_id
    //             FROM voting
    //             WHERE status = 'Winner'
    //             GROUP BY won_date";
        
    //     if ($result = $conn->query($sql)) {
    //         $winners = [];
    //         while ($row = $result->fetch_assoc()) {
    //             $winners[] = [
    //                 'vote_id' => $row['vote_id'],
    //                 'candidate_names' => $row['candidate_names'],
    //                 'won_date' => $row['won_date']
    //             ];
    //         }

    //         if (!empty($winners)) {
    //             $response = [
    //                 'success' => true,
    //                 'winners' => $winners
    //             ];
    //         } else {
    //             $response = ['success' => false, 'message' => 'No winners found.'];
    //         }
    //     } else {
    //         $response = ['success' => false, 'error' => 'Database error occurred.'];
    //     }
    //     closeConnectionAndRespond($conn, $response);

    // } 
}elseif ($action === 'fetch_history') {
    // Fetch winners grouped by won_date, including vote_id and candidate_name
    $sql = "SELECT vote_id, candidate_name, won_date
            FROM voting
            WHERE status = 'Winner'
            ORDER BY won_date DESC";

    if ($result = $conn->query($sql)) {
        $winnersByDate = [];
        while ($row = $result->fetch_assoc()) {
            $won_date = $row['won_date'];
            $winnersByDate[$won_date][] = [
                'vote_id' => $row['vote_id'],
                'candidate_name' => $row['candidate_name']
            ];
        }

        if (!empty($winnersByDate)) {
            $response = [
                'success' => true,
                'winners' => $winnersByDate
            ];
        } else {
            $response = ['success' => false, 'message' => 'No winners found.'];
        }
    } else {
        $response = ['success' => false, 'error' => 'Database error occurred.'];
    }
    closeConnectionAndRespond($conn, $response);
}

    else {
        $response = ['success' => false, 'error' => 'Invalid request'];
        closeConnectionAndRespond($conn, $response);
    }
} else {
    $response = ['success' => false, 'error' => 'Invalid request method'];
    closeConnectionAndRespond($conn, $response);
}

?>