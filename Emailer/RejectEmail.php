<?php
// sendEmail.php

require '../vendor/autoload.php'; // Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();
include_once "../Connect/Connection.php";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to send confirmation email
function sendRejectingEmail($user_email) {
    // Create a new PHPMailer instance
    //$otp = generateOTP(); // Generate OTP
   // $_SESSION['otp'] = $otp; // Store OTP in session (temporary storage)
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                                      
        $mail->isSMTP();    
        $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mabuhayhoa@gmail.com'; // Your Gmail address
        $mail->Password   = 'entm bdkx vcil hkuh'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;
        $mail->Debugoutput = function($str, $level) {
            error_log("SMTP debug level $level; message: $str\n");
        };

        // Recipients
        $mail->setFrom('mabuhayhoa@gmail.com', 'HOA Admin');
        $mail->addAddress($user_email); // User's email address

        // Content
        $mail->isHTML(true);
        $mail->addEmbeddedImage('../Pictures/Dasma_City_Logo.png', 'logo_cid');

        $mail->Subject = 'Failed Account Confirmation';
        $mail->Body = '
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Failed Account Confirmation</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                background-color: rgba(0, 0, 0, 0.5);
                                margin: 0;
                                padding: 0;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                            }
                            .modal {
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 8px;
                                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Added box-shadow */
                                max-width: 600px;
                                width: 100%;
                                position: relative;
                            }
                            h1 {
                                color: #333;
                                text-align: center;
                            }

                            .logo {
                                display: flex;
                                justify-content: center;
                                margin-bottom: 20px;
                            }
                            .logo img {
                                height: 40px; /* Adjust the height of the logo */
                            }

                            p {
                                color: #555;
                                font-size: 16px;
                                line-height: 1.6;
                                text-align: left;
                            }
                            
                        </style>
                    </head>
                    <body>
                        <div class="modal">
                          <div class="logo">
                            <img src="cid:logo_cid" alt="Logo">
                          </div>
                            <h1> Failed Account Confirmation</h1>
                            <p>Hello,</p>
                            <p>Im sorry your account has been rejected. Due to a lack of accuracy in your personal information based on our data, if you have any concerns, feel free to visit our HOA office.. Thank you!</p>
                        </div>
                    </body>
                    </html>
                ';

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
        $query = "SELECT email FROM tblaccounts WHERE unique_id = '$user_id'"; // yung user_id dito unique_id talaga laman di ko pinalitan ng variable
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_email = $row['email'];

            // Send confirmation email
            if (sendRejectingEmail($user_email)) {
                // Email sent successfully
                $response = ['success' => true];
            } else {
                // Failed to send email
                $response = ['error' => 'Failed to send rejecting email'];
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
