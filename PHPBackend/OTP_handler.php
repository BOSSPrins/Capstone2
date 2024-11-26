<?php
require '../Connect/Connection.php'; // Database connection
require '../Emailer/OtpEmail.php'; // Email sending function

session_start();
$conn = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'send_otp') {
        $email = $_POST['email'];

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
            exit;
        }

        // Store the email in the session
        $_SESSION['email'] = $email;

        // Generate OTP
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime('+10 minutes'));

        // Store OTP in the database
        $query = "INSERT INTO otp_verifications (email, otp, expiry) VALUES ('$email', '$otp', '$expiry')
                  ON DUPLICATE KEY UPDATE otp = '$otp', expiry = '$expiry'";
        if (mysqli_query($conn, $query)) {
            if (sendOTPEmail($email, $otp)) {
                echo json_encode(['success' => true, 'message' => 'OTP sent to your email.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send OTP email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to generate OTP.']);
        }
    } elseif ($action === 'verify_otp') {
        $email = $_SESSION['email'];
        $otp = $_POST['otp'];

        // Fetch OTP from the database
        $query = "SELECT * FROM otp_verifications WHERE email = '$email' AND otp = '$otp' AND expiry > NOW()";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Mark account as verified
            $update_query = "UPDATE tblaccounts SET otp = 'Verified' WHERE email = '$email'";
            if (mysqli_query($conn, $update_query)) {
                echo json_encode(['success' => true, 'message' => 'Account verified successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to verify account.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }
    } elseif ($action === 'reset_password') {
        $email = $_SESSION['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
    
        // Check if passwords match
        if ($new_password !== $confirm_password) {
            echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
            exit;
        }
    
        // Hash the new password
        $hashed_password = md5($new_password);
    
        // Update password in the database
        $update_query = "UPDATE tblaccounts SET password = '$hashed_password' WHERE email = '$email'";
        if (mysqli_query($conn, $update_query)) {
            echo json_encode(['success' => true, 'message' => 'Password reset successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to reset password.']);
        }
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
