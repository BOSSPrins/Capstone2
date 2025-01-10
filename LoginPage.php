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
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="MainBodyContainerr MainBodyConActivee">
                <!-- <div class="arawAtOras">
                    <div> Monday </div>
                    <div> Tuesday </div>
                    <div> Wednesday </div>
                    <div> Thursday </div>
                    <div> Friday </div>
                    <div> Saturday </div>
                    <div> Sunday </div>
                </div> -->
                <div class="headerTopMain">
                    <div class="LogoLandingPage">
                        <div class="logoImageCon">
                            <a href="#" class="asLogo">
                                <img class="Logoo" src="Pictures/Mabuhay_Logo.png">
                            </a>
                        </div>
                        <div class="NameOfSubdi">
                            <h1> MABUHAY HOMES 2000 PH-V </h1>
                            <h3> BRGY. SALAWAG CITY OF DASMARINAS </h3>
                        </div>
                    </div>
                    <div class="MhNavbar">
                        <!-- Hamburger icon for mobile/tablet view -->
                        <div class="hamburger" onclick="toggleNavbar()">
                            &#9776; <!-- Hamburger icon -->
                        </div>
                        <ul class="MhNavv">
                            <li>
                                <a href="Index.php"> Home </a>
                            </li>
                            <!-- <li>
                                <a href="Index.html#AboutUs"> About Us </a>
                            </li>
                            <li>
                                <a href="Index.html#HOAOfficials"> HOA Officials  </a>
                            </li> -->
                            <li>
                                <a href="LoginPage.html"> Login </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="MainContainerForTables">
                    <div class="MainContainerAll">
                        <div class="left">
                            <img class="HoaOffice" src="Pictures/HOA_Officee.jpg" alt="">
                        </div>
                        <div class="right" id="LoginFormContainer">
                            <div class="LoginForm" id="LoginForm">
                                <div class="LogoLog-In">
                                    <img class="imgLogo" src="Pictures/Mabuhay_Logo.png">
                                </div>
                        
                                <span class="login-title">Login</span>
                        
                                <form class="LoginLaman">
                                    <div class="LoginInputField">
                                        <input class="inputLogin" type="text" required="required" name="email">
                                        <span class="SpanLogin">Email Address</span>
                                        <img class="ImgIcon" src="Pictures/usernameCap.png">
                                    </div>
                        
                                    <div class="LoginInputField">
                                        <input class="inputLogin" type="password" required="required" name="loginpassword" id="loginpassword">
                                        <span class="SpanLogin"> Password </span>
                                        <img src="Pictures/Open-eyed.png" alt="Show password" class="MataNgPassword" id="LogOpened" onclick="togglePasswordVisibilityLog('LogOpened', 'LogClosed')" style="display:none;"> 
                                        <img src="Pictures/closed-eye.png" alt="Hide password" class="MataNgPassword" id="LogClosed" onclick="togglePasswordVisibilityLog('LogClosed', 'LogOpened')">
                                    </div>
                        
                                    <div class="forgotpass-container">
                                        <a href="ForgotPass.php" class="forgot-text">Forgot Password?</a>                                      
                                    </div>
                        
                                    <div class="btn-login">
                                        <button class="login-press laginbtn">Login</button>
                                    </div>
                        
                                    <div class="signtext-container">
                                        <span class="login-signup">Don't have an account?
                                            <button class="BtnSignUp" onclick="showForms('SignUpForm')">Sign Up</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="right" id="SignUpFormContainer" style="display: none;">
                            <div class="LogoLog-In">
                                <img class="imgLogo" src="Pictures/Mabuhay_Logo.png">
                            </div>
        
                            <span class="login-title"> Sign Up </span>
        
                            <div class="SignUpForm" id="SignUpForm">
                                <form class="SignUpLaman">
                                    <div class="PersonalDetails SignUpParehas" id="PersonalDet">
                                        <!-- Personal details input fields go here -->
                                        <h3> Personal Details </h3>
        
                                        <div class="OneInputField">
                                            <label class="Labels"> First Name </label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your First Name">
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels"> Middle Name </label>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your Middle Name">
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels"> Last Name </label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your Last Name">
                                        </div>
        
                                        <div class="RowInputFields">
                                            <div class="OneInputField">
                                                <label class="Labels"> Suffix </label>
                                                <input class="SignUpInput" type="text" placeholder="Enter Your Suffix">
                                            </div>
        
                                            <div class="OneInputField dropdown">
                                                <label class="Labels"> Sex </label>
                                                <span style="color:red"> &#42; </span>
                                                <div class="dropdown-button">Select Option</div>
                                                <div class="dropdown-content">
                                                    <label class="option" data-value="male">
                                                        <input class="Pili SignUpInput" type="radio" name="gender" value="Male"> Male
                                                    </label>
                                                    <label class="option" data-value="female">
                                                        <input class="Pili SignUpInput" type="radio" name="gender" value="Female"> Female
                                                    </label>
                                                    <label class="option" data-value="other">
                                                        <input class="Pili SignUpInput" type="radio" name="gender" value="Preferred not to say"> Preferred not to say
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="RowInputFields">
                                            <div class="OneInputField">
                                                <label class="Labels"> Date Of Birth </label>
                                                <span style="color:red"> &#42; </span>
                                                <input class="SignUpInput" type="date">
                                            </div>
        
                                            <div class="OneInputField">
                                                <label class="Labels"> Age </label>
                                                <span style="color:red"> &#42; </span>
                                                <input class="SignUpInput" type="text" readonly>
                                            </div>
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels"> Contact No.</label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your Number">
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels"> Do you have disabilities? </label>
                                            <div style="margin-top: 15px; margin-bottom: 15px;" class="radioButtonPwd">
                                                <div class="check1">
                                                    <span class="spanCheck"> Yes </span>
                                                    <input type="checkbox">
                                                </div>
        
                                                <div class="check2">
                                                    <span class="spanCheck"> No </span>
                                                    <input class="checkBoxx" type="checkbox" id="checkNo" name="disabilities" value="No">
                                                </div>
                                            </div>
                                        </div>
        
                                        <!-- ADDRESS DETAILS -->
                                        <h3> Address Details </h3>
                                        <div class="RowInputFields">
                                            <div class="OneInputField">
                                                <label class="Labels"> Block </label>
                                                <span style="color:red"> &#42; </span>
                                                <input class="SignUpInput" type="text">
                                            </div>
        
                                            <div class="OneInputField">
                                                <label class="Labels"> Lot </label>
                                                <span style="color:red"> &#42; </span>
                                                <input class="SignUpInput" type="text">
                                            </div>
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels"> Street </label>
                                            <input class="SignUpInput" type="text">
                                        </div>
        
                                        <div class="NextBtnCon">
                                            <button class="NextBtn" type="button"> Next </button>
                                        </div>
                                    </div>
                                </form>
        
                               <form class="EmailForm">
                                    <div class="EmailCon SignUpParehas" id="EmailAdd">
                                        <!-- Email input fields go here -->
                                        <h3> Create Account </h3>
                                        <p class="EmailParag"> Please Enter Your Valid Email Address For You <br> To Create an Account </p>
        
                                        <div class="OneInputField Middle">
                                            <label class="Labels"> Email </label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your Email Address">
                                        </div>
        
                                        <div class="ButtonNextAndBack Bottom">
                                            <button class="NextBtn"> Back </button>
                                            <button class="NextBtn"> Send </button>
                                        </div>
                                    </div>
                               </form>
                        
                                <form class="OtpForm">
                                    <div class="OtpCon SignUpParehas" id="OtpInt">
                                        <!-- OTP input fields go here -->
                                        <h3> Verify Your Email </h3>
                                        <div class="OtpParagg">
                                            <p class="EmailParag"> Please Enter The 6 Digit Code Sent To </p>
                                            <input class="OtpInt" type="email">
                                        </div> 
            
                                        <div class="MiddleOtp">
                                            <input class="SignUpInput" type="text" placeholder="Enter the OTP">
                                        </div>
            
                                        <div class="ButtonNextAndBack Bottom">
                                            <button class="NextBtn"> Back </button>
                                            <button class="NextBtn"> Verify </button>
                                        </div>
                                    </div>
                                </form>
                        
                                <form class="CreatePassForm">
                                    <div class="CreatePassCon SignUpParehas" id="CreatePassword">
                                        <!-- Create password fields go here -->
                                        <h3> Create Password </h3>
                                        <p class="EmailParag"> Create a strong password by combining at least 8 characters,  <!-- HINDI PA TO SURE NAKA DIPENDE PA TO SAYO BEBI KUNG ANONG BALAK MO -->
                                            including uppercase and lowercase letters, numbers, 
                                            and special characters (e.g., !, @, #, $). Avoid using easily 
                                            guessable information such as your name or birthdate.
                                        </p> 
                                            
                                        <div class="OneInputField">
                                            <label class="Labels"> Password </label>
                                            <span style="color:red"> &#42; </span>
                                            <div class="CreatePassSign">
                                                <input class="SignUpInput" type="password" id="Pass" placeholder="Enter Password">
                                                <img class="MataSign" src="Pictures/Open-eyed.png" id="BukasMata1" onclick="toggleEye1('BukasMata1', 'SaradoMata1', 'Pass')" style="display: none;">
                                                <img class="MataSign" src="Pictures/closed-eye.png" id="SaradoMata1"  onclick="toggleEye1('SaradoMata1', 'BukasMata1', 'Pass')">
                                            </div>
            
                                            <label class="Labels"> Confirm Password </label>
                                            <span style="color:red"> &#42; </span>
                                            <div class="CreatePassSign">
                                                <input class="SignUpInput" type="password" id="Pass2" placeholder="Enter Password">
                                                <img class="MataSign" src="Pictures/Open-eyed.png" id="BukasMata2" onclick="toggleEye2('BukasMata2', 'SaradoMata2', 'Pass2')" style="display: none;">
                                                <img class="MataSign" src="Pictures/closed-eye.png" id="SaradoMata2"  onclick="toggleEye2('SaradoMata2', 'BukasMata2', 'Pass2')">
                                            </div>
            
                                            <button class="NextBtn"> Submit </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
        
                            <div class="signtext-container">
                                <span class="login-signup">Already have an account?
                                    <button class="BtnSignUp" onclick="showForms('LoginForm')"> Login </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    
    <script src="JS/Signup.js"></script>     
    <script src="JS/Login.js"></script>  
</body>
</html>
