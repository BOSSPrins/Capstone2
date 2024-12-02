<?php 
include_once "Connect/Connection.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/ForgotPass.css">
</head>
<body>
    <div class="ForgotForms">
        <div id="loading-indicator">
            <div class="loader"></div>
        </div>
        <form id="requestOTPForm">
            <div class="Email">
                <div class="top">
                    <h2> Forgot Password </h2>
                    <div class="CircleBackG">
                        <img class="ForgotImg" src="Pictures/forgotPasswordIcon.png">
                    </div>
                    <p> Please Enter Your Email Address To <br> Recieve a Verification Code </p>
                </div>
                    
                <div class="middle">
                    <label> Email Address: </label>
                    <input class="InputEmail" type="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="bottom">
                    <button class="btnSend" type="submit"> Send </button>
                </div>
            </div>
        </form>


        <form id="verifyOTPForm" style="display:none;">
           
            <div class="verify">
                <div class="top">
                    <h2> Verify Your Email </h2>
                    <div class="CircleBackG">
                        <img class="ForgotImg" src="Pictures/emailPassIcon.png">
                    </div>
                    <p> Please Enter The 6 Digit Code Sent To </p>
                    <input type="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" readonly> 
                </div>

                <div class="middle">
                    <input type="hidden" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" readonly required>
                    <input class="InputEmail" type="type" name="otp" placeholder="Enter the OTP" required>
                </div>

                <div class="bottom">
                    <button class="btnSend" type="submit"> Verify </button>
                </div>
            </div>
        </form>

        <form id="resetPasswordForm" style="display:none;">
            <!-- <input type="email" name="email" value="<?php echo $_SESSION['email']?>" required> -->
            <div class="newPass">
                <div class="top">
                    <h2> Create New Password </h2>
                    <div class="CircleBackG">
                        <img class="ForgotImg" src="Pictures/NewPass.png">
                    </div>
                    <p> Your New Password Must Be Different <br> from Previously Used Password </p>
                </div>

                <div class="middle">
                    <label> New Password: </label>
                    <div class="input-container">
                        <input class="InputEmail" type="password" id="Passwordd" name="new_password" placeholder="Enter new password" required>
                        <img class="IconMata" src="Pictures/Open-eyed.png" alt="Open Eye Icon" id="Opened1" onclick="toggleMata1('Opened1', 'Closed1', 'Passwordd')" style="display:none;">
                        <img class="IconMata" src="Pictures/closed-eye.png" alt="Closed Eye Icon" id="Closed1" onclick="toggleMata1('Closed1', 'Opened1', 'Passwordd')">
                    </div>
                    
                    <label style="margin-top: 10px;"> Confirm Password: </label>
                    <div class="input-container">
                        <input class="InputEmail" type="password" id="ConfirmPasswordd" name="confirm_password" placeholder="Confirm new password" required>
                        <img class="IconMata" src="Pictures/Open-eyed.png" alt="Open Eye Icon" id="Opened2" onclick="toggleMata2('Opened2', 'Closed2', 'ConfirmPasswordd')" style="display:none;">
                        <img class="IconMata" src="Pictures/closed-eye.png" alt="Closed Eye Icon" id="Closed2" onclick="toggleMata2('Closed2', 'Opened2', 'ConfirmPasswordd')">
                    </div>
                </div>

                <div class="bottom">
                    <button class="btnSend" type="submit"> Save </button>
                </div>
            </div>
        </form>
    </div>

    <script src="JS/ForgotPass.js"></script>
</body>
</html>
