<?php
session_start();

echo "<pre>";
echo "Session before logout:\n";
print_r($_SESSION);
echo "</pre>";

// Flush the output to ensure it is sent to the browser
ob_flush();
flush();

// Check if unique_id is set
if (isset($_SESSION['unique_id'])) {
    include_once "Connect/Connection.php";
    $conn = connection();

    $unique_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    
    echo "Unique ID: " . $unique_id . "<br>";

    // Flush the output to ensure it is sent to the browser
    ob_flush();
    flush();

    if (isset($unique_id)) {
        // Change the status
        $status = "Offline now";    
        $sql = "UPDATE tblaccounts SET status = '{$status}' WHERE unique_id = '{$unique_id}'";
        echo "SQL Query: " . $sql . "<br>"; // Check if the SQL query is constructed correctly
        $result = mysqli_query($conn, $sql);

        // Flush the output to ensure it is sent to the browser
        ob_flush();
        flush();
        
        if ($result) {
            // Unset and destroy session
            session_unset();
            session_destroy();
            echo "Session destroyed.<br>";
            echo "Session after destroy:<br>";
            echo "<pre>";
            print_r($_SESSION); // This should be empty
            echo "</pre>";

            // Flush the output to ensure it is sent to the browser
            ob_flush();
            flush();

            // Use JavaScript to redirect after a delay
            echo '<script>';
            echo 'setTimeout(function(){ window.location.href = "LoginPage.php"; });'; // 5-second delay
            echo '</script>';
            exit(); // Ensure no further code execution after redirection
        } else {
            // Handle SQL error
            echo "Error: " . mysqli_error($conn); // Check for SQL errors

            // Flush the output to ensure it is sent to the browser
            ob_flush();
            flush();
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