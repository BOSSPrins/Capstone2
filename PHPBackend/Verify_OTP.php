<?php
require '../Connect/Connection.php'; // Database connection
require '../Emailer/OtpEmail.php'; // Email sending function

session_start();
$conn = connection();
error_log(print_r($_POST, true));

$input = file_get_contents('php://input');
error_log("Raw Input: " . $input);  // Log raw input to check if it's coming through correctly
$input = json_decode($input, true);  // Decode JSON data
error_log("Decoded Input: " . print_r($input, true));  // Log decoded input to see the structure

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($input['action'])) {
    $action = $input['action'];  // Use $input['action'] for the action from JSON
    error_log("Action: " . $action);

    if ($action === 'send_otp') {
        $email = $input['email'];  // Retrieve email from JSON

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // Fix the validation check
            echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
            exit;
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime('+60 seconds'));

        // Store OTP in the database
        $query = "INSERT INTO otp_verifications (email, otp, expiry) VALUES ('$email', '$otp', '$expiry')
                  ON DUPLICATE KEY UPDATE otp = '$otp', expiry = '$expiry'";
        if (mysqli_query($conn, $query)) {
            if (sendOTPEmail($email, $otp)) {
                echo json_encode(['success' => true, 'message' => 'OTP sent successfully to ' . $email]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send OTP email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to generate OTP.']);
        }
    } elseif ($action === 'verify_otp') {
        $email = $input['email'];  // Use $input for email in verify_otp
        $otp = $input['otp'];  // Use $input for OTP in verify_otp

        // Fetch OTP from the database
        $query = "SELECT * FROM otp_verifications WHERE email = '$email' AND otp = '$otp' AND expiry > NOW()";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Insert or update the email in the verified_email table
            $update_query = "INSERT INTO verified_email (email, status) 
                             VALUES (?, ?) 
                             ON DUPLICATE KEY UPDATE status = ?";
            $status = 'Verified';
            $stmt_update = mysqli_prepare($conn, $update_query);
            mysqli_stmt_bind_param($stmt_update, "sss", $email, $status, $status);
            
            if (mysqli_stmt_execute($stmt_update)) {
                $_SESSION['otp_status'] = 'Verified';
                error_log("OTP update successful for email: $email");
                echo json_encode(['success' => true, 'message' => 'Account verified successfully.']);
            } else {
                error_log("Error verifying account: " . mysqli_error($conn));
                echo json_encode(['success' => false, 'message' => 'Failed to verify account.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }
        
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
