<?php
session_start();
include_once "../Connect/Connection.php";
include_once "../Emailer/OtpEmail.php"; // Include the emailer file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'sendOTP') {
        $email = $_POST['email'];
        $otp = rand(100000, 999999); // Generate a 6-digit OTP

        // Store OTP in session
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_email'] = $email;
        $_SESSION['otp_expiry'] = time() + 60; // OTP valid for a minute

        // Call the emailer function
        if (sendOTPEmail($email, $otp)) {
            echo json_encode(['success' => true, 'message' => 'OTP sent successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send OTP. Please try again.']);
        }
    } elseif ($action === 'verifyOTP') {
        $userOTP = $_POST['otp'];  // OTP entered by the user
        $storedOTP = $_SESSION['otp'] ?? null;  // OTP stored in session
        $storedEmail = $_SESSION['otp_email'] ?? null;  // Email stored in session

        error_log("User OTP: " . $userOTP);
        error_log("Stored OTP: " . $storedOTP);
        error_log("Stored Email: " . $storedEmail);

    
        // Check if session OTP exists or has expired
        if (!$storedOTP || !$storedEmail || time() > $_SESSION['otp_expiry']) {
            echo json_encode(['success' => false, 'message' => 'OTP expired or session cleared. Please request a new OTP.']);
            exit();
        }
    
        // Validate OTP
        if ($userOTP == $storedOTP) {
            // Update the account's status to "Verified" in tblaccounts
            $update_status_query = mysqli_query($conn, "UPDATE tblaccounts SET otp = 'Verified' WHERE email = '{$storedEmail}'");
    
            if ($update_status_query) {
                // Unset OTP and email from session after successful verification
                unset($_SESSION['otp']);
                unset($_SESSION['otp_email']);
                unset($_SESSION['otp_expiry']);
    
                echo json_encode(['success' => true, 'message' => 'Email verified successfully!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to verify email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid OTP.']);
        }

    } elseif ($action === 'checkBlockLot') {

        $block = $_POST['block'];
        $lot = $_POST['lot'];

        $query = $conn->prepare("SELECT * FROM tblresident WHERE block = ? AND lot = ?");
        $query->bind_param("ss", $block, $lot);
        $query->execute();
        $result = $query->get_result();

        $response = ["exists" => $result->num_rows > 0];
        echo json_encode($response);
        exit();
    }
}
?>