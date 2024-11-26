<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h1>Email OTP Password Reset</h1>

    <!-- Form to request OTP -->
    <form id="requestOTPForm">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send OTP</button>
    </form>

    <br>

    <!-- Form to verify OTP -->
    <form id="verifyOTPForm" style="display:none;">
        <!-- <input type="email" name="email" value="<?php echo $_SESSION['email']?>" required> -->
        <input type="text" name="otp" placeholder="Enter the OTP" required>
        <button type="submit">Verify OTP</button>
    </form>

    <br>

    <!-- Form to reset password -->
    <form id="resetPasswordForm" style="display:none;">
        <!-- <input type="email" name="email" value="<?php echo $_SESSION['email']?>" required> -->
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
        <button type="submit">Reset Password</button>
    </form>

    <script src="JS/ForgotPass.js"></script>
</body>
</html>
