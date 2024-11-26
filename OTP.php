<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
    <h1>Email OTP Verification</h1>

    <!-- Form to request OTP -->
    <form id="requestOTPForm">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send OTP</button>
    </form>

    <br>

    <!-- Form to verify OTP -->
    <form id="verifyOTPForm" style="display:none;">
        <input type="text" name="otp" placeholder="Enter the OTP" required>
        <button type="submit">Verify OTP</button>
    </form>

    <br>

    <script src="JS/OTP.js"></script>
</body>
</html>
