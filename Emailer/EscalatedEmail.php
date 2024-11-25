
<?php
// sendEmail.php

require '../vendor/autoload.php'; // Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (session_status() == PHP_SESSION_NONE) {
  session_start();  // Start the session only if it hasn't been started
}
include_once "../Connect/Connection.php";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
function sendEscalatedEmail($user_email, $complaint_number, $Description) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;                                      
        $mail->isSMTP();    
        $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mabuhayhoa@gmail.com'; // Your Gmail address
        $mail->Password   = 'entm bdkx vcil hkuh'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('mabuhayhoa@gmail.com', 'HOA Admin');
        $mail->addAddress($user_email); // User's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Filed Complaint Update';
        $mail->addEmbeddedImage('../Pictures/Mabuhay_Logo.png', 'logo_cid');
        $mail->Body = '
            <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Complaint Turned Over</title>
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
                                padding-right: 50px;
                            }

                            .logo {
                                display: flex;
                                justify-content: center;
                                margin-bottom: 20px;
                            }
                            .logo img {
                               height: 180px;
                               margin-left: 180px;
                            }

                            p {
                                color: #555;
                                font-size: 16px;
                                line-height: 1.6;
                                text-align: left;
                            }

                            a.button {
                                display: inline-block;  
                                background-color: #007bff;
                                color: #fff;
                                text-decoration: none;
                                padding: 10px 20px;
                                border-radius: 4px;
                                border: none; /* Added to remove any default border */
                                cursor: pointer; /* Added to show pointer on hover */
                            }

                            .button:hover {
                                background-color: #0056b3;
                            }
                        </style>
                       
                    </head>
                    <body>
                        <div class="modal">
                          <div class="logo">
                            <img src="cid:logo_cid" alt="Logo">
                          </div>
                            <h1>Complaint Turned Over</h1>
                            <p>Your complaint with number <strong>' . $complaint_number . '</strong> has been turned over to the Barangay Salawag Community Hall for further action, as the HOA is unable to resolve it at this time.</p>
                            <p>Description: <strong>' . $Description . '</strong></p>
                            <p>If you have any questions or concerns, please feel free to contact us through our website.</p>
                          
                        </div>
                    </body>
                    </html>
        ';

        // Send email
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        // Log error and return false
        error_log('Failed to send confirmation email: ' . $mail->ErrorInfo);
        return false;
    }
}

// Handle the request to send the email
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complainantUID'])) {
    $complainantUID = $_POST['complainantUID'];
    $complaint_number = $_POST['complaint_number'];
    $Description = $_POST['Description'];

    // Fetch complainant email from the database
    $conn = connection();
    $query = "SELECT email FROM tblaccounts WHERE unique_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $complainantUID);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();

    if ($email) {
        // Send the email to the complainant
        if (sendEscalatedEmail($email, $complaint_number, $Description)) {
            echo json_encode(['success' => true, 'message' => 'Email sent successfully.']);  // Success
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to send email']);  // Failure
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Complainant not found']);  // No email found
    }
  }
?>