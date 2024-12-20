<?php 
include "Connect/Connection.php";
session_start();

if(isset($_SESSION['unique_id'])){
    // Redirect to login page only if the user is not already on the login page
    if(basename($_SERVER['PHP_SELF']) !== 'LoginPage.php') {
        header("Location: LoginPage.php");
        exit();
    }
}

if (isset($_SESSION['role'])) {
    echo '<script>';
    echo 'const sessionRole = "' . $_SESSION['role'] . '";';
    echo '</script>';
} else {
    echo '<script>';
    echo 'const sessionRole = null;';
    echo '</script>';
}

if (!isset($_SESSION['otp_status'])) {
    $_SESSION['otp_status'] = 'Unverified';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/LoginPage.css">
    <script src="jQuery/jquery.min.js"></script>
</head>
<body>
    <div class="main">
        <div class="mainContainer">
            <div id="loading-indicator">
                <div class="loader"></div>
            </div>
            <div class="split-screen">
                <div class="left">
                    <!-- <img src="Pictures/sample_pic.png"> -->
                </div>

                <!-- Login form -->
                <div class="rightt show" id="loginForm">
                    <div class="forms formLogin">
                        <div class="forms">
                            <div class="title-container forms">

                                <div class="LogoLog-In">
                                    <img class="imgLogo" src="Pictures/Mabuhay_Logo.png">
                                </div>

                                <span class="login-title">Login</span>

                                <form class="login-forms lagin" action="" method="POST">
                                    <div class="iror"></div>
                                    <div class="sakses"></div>
                                    <div class="login-input-field">
                                        <input type="text" required="required" class="inputLogin" name="email">
                                        <span>Email Address</span>
                                        <img class="img-login" src="Pictures/usernameCap.png">
                                    </div>
                                    <div class="login-input-field">
                                        <input type="password" required="required" class="password inputLogin" name="loginpassword" id="loginpassword">
                                        <span>Password</span>
                                        <img src="Pictures/Open-eyed.png" alt="Show password" class="toggle-password" id="LogOpened" onclick="togglePasswordVisibilityLog('LogOpened', 'LogClosed')" style="display:none;"> 
                                        <img src="Pictures/closed-eye.png" alt="Hide password" class="toggle-password" id="LogClosed" onclick="togglePasswordVisibilityLog('LogClosed', 'LogOpened')">
                                    </div>

                                    <div class="forgotpass-container">
                                        <a href="ForgotPass.php" class="forgot-text">Forgot Password?</a>                                      
                                    </div>

                                    <div class="btn-login">
                                        <button class="login-press laginbtn">Login</button>
                                    </div>

                                    <div class="signtext-container">
                                        <span class="login-signup">Don't have an account?
                                            <a href="#" class="link signup-text" onclick="showSignUpForm()">Sign Up</a>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Login and Sign Up forms -->
                <div class="rightt" id="signUpForm">

                    <div class="LogoSign-Up">
                        <img class="imgLogo2" src="Pictures/Mabuhay_Logo.png">
                    </div>

                    <span class="signUp-title"> Sign Up </span>
                    <div class="irorSignup"></div>
                    <div class="sakses"></div>
                    <div class="formSignup">
                     
                        <form class="signup-form saynap" enctype="multipart/form-data" method="POST">
                        
                            <div class="form first">
                                <div class="details personal">
                                    <span class="titleniyato"> Personal Details </span>

                                    <div class="input-field">
                                        <span> First Name </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text" placeholder="Enter Your First Name" name="fname" id="fname"> 
                                    </div>

                                    <div class="input-field">
                                        <span> Middle Name </span>
                                        <input class="SUF" type="text" placeholder="Enter Your Middle Name" name="mname" id="mname">
                                    </div>
        
                                    <div class="input-field">
                                        <span> Last Name </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text" placeholder="Enter Your Last Name" name="lname" id="lname">
                                    </div>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Suffix </span>
                                            <input class="SUF" type="text" placeholder="Enter Your Suffix" name="suffix" id="suffix">
                                        </div>
            
                                        <div class="input-field dropdown">
                                            <span>Sex</span>
                                            <span style="color:red"> &#42; </span>
                                            <div class="dropdown-button">Select Option</div>
                                            <div class="dropdown-content">
                                                <label class="option" data-value="male">
                                                    <input class="pagpipilianKasarian SUF" type="radio" name="gender" value="Male"> Male
                                                </label>
                                                <label class="option" data-value="female">
                                                    <input class="pagpipilianKasarian SUF" type="radio" name="gender" value="Female"> Female
                                                </label>
                                                <label class="option" data-value="other">
                                                    <input class="pagpipilianKasarian SUF" type="radio" name="gender" value="Preferred not to say"> Preferred not to say
                                                </label>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Date Of Birth </span>
                                            <span style="color:red"> &#42; </span>
                                            <input id="dob" name="dob" class="SUF" type="date" onchange="calculateAge()">
                                        </div>

                                        <div class="input-field">
                                            <span> Age </span>
                                            <span style="color:red"> &#42; </span>
                                            <input id="age" name="age" class="SUF" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="input-field">
                                        <span> Contact No. </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text" placeholder="Enter Your Number" id="phonenum" name="phonenum">
                                    </div>

                                    <div class="input-field">
                                        <span> Do you have disabilities? </span>
                                        <div class="radioButtonPwd">
                                            <div class="check1">
                                                <span class="spanCheck"> Yes </span>
                                                <input type="checkbox" id="checkYes" name="disabilities" value="Yes">
                                            </div>

                                            <div class="check2">
                                                <span class="spanCheck"> No </span>
                                                <input type="checkbox" id="checkNo" name="disabilities" value="No">
                                            </div>
                                        </div>
                                    </div>

                                    <span class="titleniyato"> Address Details </span>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Block </span>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SUF" type="text" id="block" name="block">
                                        </div>

                                        <div class="input-field">
                                            <span> Lot </span>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SUF" type="text" id="lot" name="lot">
                                        </div>
                                    </div>

                                    <div class="input-field">
                                        <span> Street </span>
                                        <!-- <span style="color:red"> &#42; </span> Tinago ko to kasi minsan wala namang silang street--> 
                                        <input class="SUF" type="text" id="street" name="street">
                                    </div>

                                    <span class="titleniyato"> Create Account </span>

                                    <div class="input-field">
                                        <span> Email </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="email" id="emailOTP" name="email" placeholder="Enter Your Email" required>
                                        <button class="sendOTP" type="button" id="sendOTPBtn" style="display: flex;">Send OTP</button>
                                        <div id="otp-timer" style="color: blue; display: none;">OTP expires in: <span id="timer"></span></div>
                                    </div>

                                    <div class="input-field" id="otpSection" style="display:none;">
                                        <span>Enter OTP</span>
                                        <input class="SUF" type="text" id="EMAILotp" name="otp" placeholder="Enter OTP">
                                        <input type="hidden" id="OTPinput" value="<?php echo $_SESSION['otp_status']; ?>" readonly>
                                        <button class="verifyOTP" type="button" id="verifyOTPBtn">Verify OTP</button>
                                        <button class="resendOTP" type="button" id="resendOTPBtn" style="display:none;">Resend OTP</button>
                                    </div>
                                    
                                    <div class="input-field">
                                        <span>Password</span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="password" id="password" name="password">
                                        <!-- Icons for toggling visibility of 'password' -->
                                        <img src="Pictures/Open-eyed.png" alt="Show password" class="toggle-password" 
                                            id="SignOpened1" 
                                            onclick="togglePasswordVisibilitySign('SignOpened1', 'SignClosed1', 'password')" 
                                            style="display:none;">
                                        <img src="Pictures/closed-eye.png" alt="Hide password" class="toggle-password" 
                                            id="SignClosed1" 
                                            onclick="togglePasswordVisibilitySign('SignClosed1', 'SignOpened1', 'password')">
                                    </div>

                                    <div class="input-field">
                                        <span>Confirm Password</span>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SUF" type="password" id="confirmPassword" name="confirmPassword">
                                            <!-- Icons for toggling visibility of 'confirmPassword' -->
                                            <img src="Pictures/Open-eyed.png" alt="Show password" class="toggle-password" 
                                                id="SignOpened2" 
                                                onclick="togglePasswordVisibilitySign2('SignOpened2', 'SignClosed2', 'confirmPassword')" 
                                                style="display:none;">
                                            <img src="Pictures/closed-eye.png" alt="Hide password" class="toggle-password" 
                                                id="SignClosed2" 
                                                onclick="togglePasswordVisibilitySign2('SignClosed2', 'SignOpened2', 'confirmPassword')">
                                    </div>

                                    <div class="btnNgSubmit">
                                        <button class="SumbitSignUp-Btn SaynapBtn" id="submitBtn" disabled>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="signtext-container">
                        <span class="login-signup">Already have an account?
                            <a href="#" class="link signup-text" onclick="showLoginForm()">Login</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
    <script src="JS/Signup.js"></script>     
    <script src="JS/Login.js"></script>  
</body>
</html>
