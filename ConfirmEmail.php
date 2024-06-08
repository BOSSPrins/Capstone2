<?php
// sendEmail.php

require 'vendor/autoload.php'; // Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();
include_once "Connect/Connection.php";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to send confirmation email
function sendConfirmationEmail($user_email) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                      
        $mail->isSMTP();    
        $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'prnccrvnts@gmail.com'; // Your Gmail address
        $mail->Password   = 'sizv upme csoz cile'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;
        $mail->Debugoutput = function($str, $level) {
            error_log("SMTP debug level $level; message: $str\n");
        };

        // Recipients
        $mail->setFrom('prnccrvnts@gmail.com', 'Admin');
        $mail->addAddress($user_email); // User's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Confirmation';
        $mail->Body    = 'Hello, your account has been confirmed you can now access the website. Thank you.';

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log the error
        error_log('Failed to send confirmation email: ' . $mail->ErrorInfo);
        return false;
    }
}

// Start output buffering to prevent any unexpected output
ob_start();

// Set error reporting to catch any potential issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Check if user_id is not empty
    if (empty($user_id)) {
        $response = ['error' => 'User ID is empty'];
    } else {
        // Fetch user email from database
        $conn = connection();
        $query = "SELECT email FROM tblaccounts WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_email = $row['email'];

            // Send confirmation email
            if (sendConfirmationEmail($user_email)) {
                // Email sent successfully
                $response = ['success' => true];
            } else {
                // Failed to send email
                $response = ['error' => 'Failed to send confirmation email'];
            }
        } else {
            // User not found in database
            $response = ['error' => 'User not found'];
        }
    }
} else {
    // Invalid request
    $response = ['error' => 'Invalid Request'];
}

// Clear the output buffer and send JSON response
ob_end_clean();
header('Content-Type: application/json');
echo json_encode($response);
?>
