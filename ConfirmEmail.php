<?php
require 'vendor/autoload.php'; // Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();
include_once "Connect/Connection.php";

// Function to send confirmation email
function sendConfirmationEmail($user_email) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 2;                                     
        $mail->isSMTP();    
        $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'prnccrvnts@gmail.com'; // Your Gmail address
        $mail->Password   = 'sizv upme csoz cile'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Debugoutput = function($str, $level) {
            echo "debug level $level; message: $str\n";
        };

        // Recipients
        $mail->setFrom('Mabuhay Homes 2000', 'Admin');
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

// Validate if user_id is set
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Fetch user email from database
    $conn = connection();
    $query = "SELECT email FROM tblaccounts WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_email = $row['email'];

        // Send confirmation email
        if(sendConfirmationEmail($user_email)) {
            // Email sent successfully
            echo json_encode(array('success' => true));
        } else {
            // Failed to send email
            echo json_encode(array('error' => 'Failed to send confirmation email'));
        }
    } else {
        // User not found in database
        echo json_encode(array('error' => 'User not found'));
    }
} else {
    // Invalid request
    echo json_encode(array('error' => 'Invalid Request'));
}
?>
