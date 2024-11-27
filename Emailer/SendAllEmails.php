<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection(); // Get the MySQLi connection
require '../vendor/autoload.php'; // PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Send Emails to All Accounts
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'send_emails') {
    try {
        // Query to select all emails from tblaccounts
        $queryEmails = "SELECT email FROM tblaccounts WHERE email IS NOT NULL";
        
        // Execute the query
        $resultEmails = $conn->query($queryEmails);
        
        if ($resultEmails) {
            // Fetch all emails
            $emails = [];
            while ($row = $resultEmails->fetch_assoc()) {
                $emails[] = $row['email']; // Collect emails into the array
            }

            // Fetch the end_time from the voting_countdown table
            $queryEndTime = "SELECT end_time FROM voting_countdown ORDER BY end_time DESC LIMIT 1";
            $resultEndTime = $conn->query($queryEndTime);
            
            if ($resultEndTime && $resultEndTime->num_rows > 0) {
                $rowEndTime = $resultEndTime->fetch_assoc();
                $endTime = $rowEndTime['end_time'];
                
                // Format the end_time to display the month as a word
                $formattedEndTime = formatDateToWord($endTime);
            } else {
                $formattedEndTime = "Unknown"; // If no end_time is found
            }

            // Loop through the emails and send them one by one
            foreach ($emails as $email) {
                sendEmail($email, $formattedEndTime); // Send email to each address
            }

            // Respond with success
            echo json_encode(['success' => true]);

        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to fetch emails']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to send emails: ' . $e->getMessage()]);
    }
}

// Function to send individual emails
function sendEmail($email, $formattedEndTime) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mabuhayhoa@gmail.com'; // Sender email
        $mail->Password   = 'entm bdkx vcil hkuh'; // Sender email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('mabuhayhoa@gmail.com', 'HOA Admin'); // Sender email and name
        $mail->addAddress($email); // Recipient email address

        $mail->isHTML(true);
        $mail->Subject = 'Voting Update';
        $mail->addEmbeddedImage('../Pictures/Mabuhay_Logo.png', 'logo_cid');
        $mail->Body = '
             <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Voting Update</title>
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
                            <h1>Voting Start Now!</h1>
                            <p>Your participation in the HOA voting process is noted.</p>
                            <p>The voting will end on: <?php echo $formattedEndTime; ?></p>
                            <p>If you have any questions or concerns, please feel free to contact us through our website.</p>
                          
                        </div>
                    </body>
                    </html>
        ';

        $mail->send();
    } catch (Exception $e) {
        error_log('Failed to send email to ' . $email . ': ' . $mail->ErrorInfo);
    }
}

function formatDateToWord($date) {
  $timestamp = strtotime($date);
  return date('F j, Y, g:i a', $timestamp); // 'F' gives the full month name, 'j' gives the day, 'Y' gives the year, 'g:i a' gives the time in 12-hour format
}
?>
