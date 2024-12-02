<?php
require '../Connect/Connection.php'; // Database connection
require '../Emailer/OtpEmail.php'; // Email sending function

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
        $expiry = date("Y-m-d H:i:s", strtotime('+60 seconds'));

        // Store OTP in the database
        $query = "INSERT INTO otp_verifications (email, otp, expiry) VALUES ('$email', '$otp', '$expiry')
                  ON DUPLICATE KEY UPDATE otp = '$otp', expiry = '$expiry'";
        if (mysqli_query($conn, $query)) {
            if (sendOTPEmail($email, $otp)) {
                echo json_encode(['success' => true, 'message' => 'OTP sent to your email: ' . $email]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send OTP email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to generate OTP.']);
        }
    } elseif ($action === 'verify_otp') {
            
            $email = $_SESSION['email'] ?? null;
            $otp = $_POST['otp'] ?? null;
        
            if (!$otp) {
                echo json_encode(['success' => false, 'message' => 'OTP is missing.']);
                exit;
            }
        
            if (!$email) {
                echo json_encode(['success' => false, 'message' => 'Session expired. Please request OTP again.']);
                exit;
            }
        
            // Debugging
            error_log("Email: $email, OTP: $otp");
        
            // Fetch OTP from the database
            $query = "SELECT * FROM otp_verifications WHERE email = '$email' AND otp = '$otp' AND expiry > NOW()";
            $result = mysqli_query($conn, $query);
        
            if (mysqli_num_rows($result) > 0) {
                echo json_encode(['success' => true, 'message' => 'OTP verified successfully.']);
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
    
        // Validate the new password
        if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{6,}$/', $confirm_password)) {
            echo json_encode(['success' => false, 'message' => 'Your password must be at least 6 characters long and include a combination of numbers, letters, and special characters.']);
            exit();
        }
    
        // Check if the new password matches the old password
        $query = "SELECT password FROM tblaccounts WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $current_hashed_password = $row['password'];
            $new_hashed_password = md5($new_password); // Ensure you're using the same hashing method
    
            if ($current_hashed_password === $new_hashed_password) {
                echo json_encode(['success' => false, 'message' => 'Your new password must be different from the old password.']);
                exit();
            }
    
            // Update password in the database
            $update_query = "UPDATE tblaccounts SET password = '$new_hashed_password' WHERE email = '$email'";
            if (mysqli_query($conn, $update_query)) {
                echo json_encode(['success' => true, 'message' => 'Password reset successfully.']);
                unset($_SESSION['email']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to reset password.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No account found for the provided email.']);
        }
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action specified.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
