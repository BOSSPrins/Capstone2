<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

// Check if session is set
if (isset($_SESSION['unique_id'])) {
    $unique_id = $_SESSION['unique_id'];
    
    // Get the current session ID
    $session_id = session_id();

    // Check the session status from the sessions table
    $sql = "SELECT status FROM tbl_sessions WHERE session_id = '{$session_id}' AND unique_id = '{$unique_id}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // If the session status is 'inactive', log the user out
        if ($row['status'] === 'inactive') {
            // Set the user's status to 'Offline now' in the tblaccounts table
            $status = "Offline now";    
            $update_account_sql = "UPDATE tblaccounts SET status = '{$status}' WHERE unique_id = '{$unique_id}'";
            $update_result = mysqli_query($conn, $update_account_sql);

            if ($update_result) {
                // Set the current session to 'inactive' in the session tracking table
                $update_session_sql = "UPDATE tbl_sessions SET status = 'inactive' WHERE session_id = '{$session_id}'";
                $session_result = mysqli_query($conn, $update_session_sql);

                if ($session_result) {
                    // Unset and destroy session
                    session_unset();
                    session_destroy();

                    // Return success status and indicate that the user has been logged out
                    echo json_encode(['status' => 'logged_out']);
                    exit(); // Exit the script after logout
                } else {
                    // Error updating session status
                    echo json_encode(['status' => 'error', 'message' => 'Error updating session status']);
                    exit();
                }
            } else {
                // Error updating the status in tblaccounts
                echo json_encode(['status' => 'error', 'message' => 'Error updating account status']);
                exit();
            }
        } else {
            // Return the current session status if not inactive
            echo json_encode(['status' => $row['status']]);
        }
    } else {
        // If no session found, return inactive
        echo json_encode(['status' => 'inactive']);
    }
} else {
    // If the session is not set, return inactive
    echo json_encode(['status' => 'inactive']);
}

$conn->close();
?>
