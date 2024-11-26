<?php
session_start();
include_once "Connect/Connection.php";
$conn = connection();



// Flush the output to ensure it is sent to the browser
ob_flush();
flush();

// Check if unique_id is set
if (isset($_SESSION['unique_id'])) {
    $unique_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    
    

    // Flush the output to ensure it is sent to the browser
    ob_flush();
    flush();

    if (isset($unique_id)) {
        // Set the user's status to 'Offline now' in the tblaccounts table
        $status = "Offline now";    
        $sql = "UPDATE tblaccounts SET status = '{$status}' WHERE unique_id = '{$unique_id}'";
        $result = mysqli_query($conn, $sql);

        // Flush the output to ensure it is sent to the browser
        ob_flush();
        flush();

        if ($result) {
            // Set the current session to 'inactive' in the session tracking table (if you have one)
            $current_session = session_id(); // Get the current session ID
            $update_sql = "UPDATE tbl_sessions SET status = 'inactive' WHERE session_id = '{$current_session}'";
            $session_result = mysqli_query($conn, $update_sql);
            
            if ($session_result) {
                // Unset and destroy session
                session_unset();
                session_destroy();
               

                // Flush the output to ensure it is sent to the browser
                ob_flush();
                flush();

                // Use JavaScript to redirect after a delay
                echo '<script>';
                echo 'setTimeout(function(){ window.location.href = "LoginPage.php"; });'; // 5-second delay
                echo '</script>';
                exit(); // Ensure no further code execution after redirection
            } else {
                echo "Error updating session status: " . mysqli_error($conn);
                exit();
            }
        } else {
            // Handle error if updating the status in tblaccounts fails
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    } else {
        echo "Unique ID not set properly.";
        exit();
    }
} else {
    echo "Session does not have unique_id.";

    // Flush the output to ensure it is sent to the browser
    ob_flush();
    flush();

    // Use JavaScript to redirect after a delay
    echo '<script>';
    echo 'setTimeout(function(){ window.location.href = "LoginPage.php"; });'; // 5-second delay
    echo '</script>';
    exit(); // Ensure no further code execution after redirection
}
?>
