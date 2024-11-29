<?php 
include_once "../Connect/Connection.php";
require '../vendor/autoload.php'; // Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// if (session_status() == PHP_SESSION_NONE) {
//   session_start();  // Start the session only if it hasn't been started
// }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function sendOTPEmail($email, $otp) {
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

    $mail->setFrom('mabuhayhoa@gmail.com', 'HOA Admin');
    $mail->addAddress($email); // User's email address

    $mail->isHTML(true);
    $mail->Subject = 'OTP for Verification';
    $mail->addEmbeddedImage('../Pictures/Mabuhay_Logo.png', 'logo_cid');
    $mail->Body = '
       <!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Complaint In Process</title>
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
                      <h1>Your OTP for Verification</h1>
                      <p> "Your OTP is: <strong>'. $otp.'</strong> This code is valid for 60 seconds.";</p>
                      
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

?>