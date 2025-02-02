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

// if (!isset($_SESSION['otp_status'])) {
//     $_SESSION['otp_status'] = 'Unverified';
// }

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

    <div class="errorNotifications"></div>
    <div class="successNotifications"></div>

        <div id="loading-indicator">
            <div class="loader"></div>
        </div>
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
                            <h3> BRGY. SALAWAG CITY OF DASMARIÑAS </h3>
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
                                <a href="LoginPage.php"> Login </a>
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
                                <!-- <div class="errorNotifications"></div>
                                <div class="successNotifications"></div> -->
                        
                                <form class="LoginLaman lagin" method="POST">
                                    <!-- <div class="iror"></div>
                                    <div class="sakses"></div> -->
                                    <div class="LoginInputField">
                                        <input class="inputLogin" type="text" name="email" required>
                                        <span class="SpanLogin">Email Address</span>
                                        <img class="ImgIcon" src="Pictures/usernameCap.png">
                                    </div>
                        
                                    <div class="LoginInputField">
                                        <input class="inputLogin" type="password" name="loginpassword" id="loginpassword" required>
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
                            <!-- <div class="errorNotifications"></div>
                            <div class="successNotifications"></div> -->
        
                            <div class="SignUpForm" id="SignUpForm">
                                
                                <!-- <div class="sakses"></div> -->

                                <form class="SignUpLaman saynap" enctype="multipart/form-data" method="POST">
                                    <div class="PersonalDetails SignUpParehas" id="PersonalDet">
                                        <!-- Personal details input fields go here -->
                                        <h3> Personal Details </h3>
        
                                        <div class="OneInputField">
                                            <label class="Labels" for="First Name"> First Name </label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your First Name" name="fname" id="fname" required>
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels"> Middle Name </label>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your Middle Name" name="mname" id="mname">
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels" for="Last Name"> Last Name </label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your Last Name" name="lname" id="lname"required>
                                        </div>
        
                                        <div class="RowInputFields">
                                            <div class="OneInputField">
                                                <label class="Labels"> Suffix </label>
                                                <input class="SignUpInput" type="text" placeholder="Enter Your Suffix" name="suffix" id="suffix">
                                            </div>
        
                                            <div class="OneInputField dropdown">
                                                <label class="Labels" for="Gender"> Sex </label>
                                                <span style="color:red"> &#42; </span>
                                                <div class="dropdown-button" required>
                                                    Select Option
                                                    <span class="arrow"></span>  <!-- Arrow added here -->
                                                </div>
                                                <div class="dropdown-content">
                                                    <label class="option" data-value="male" for="Gender">
                                                        <input class="Pili SignUpInput" type="radio" name="gender" value="Male" id="male" required> Male
                                                    </label>
                                                    <label class="option" data-value="female" for="Gender">
                                                        <input class="Pili SignUpInput" type="radio" name="gender" value="Female" id="female" required> Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="RowInputFields">
                                            <div class="OneInputField">
                                                <label class="Labels" for="Date Of Birth"> Date Of Birth </label>
                                                <span style="color:red"> &#42; </span>
                                                <input class="SignUpInput" id="dob" name="dob" type="date"
                                                onchange="calculateAge()" required>
                                            </div>
        
                                            <div class="OneInputField">
                                                <label class="Labels" for="Age"> Age </label>
                                                <span style="color:red"> &#42; </span>
                                                <input class="SignUpInput ages" type="text" id="age" name="age" readonly required placeholder="Enter your birthdate first">

                                                <input class="SignUpInput" type="text" id="senior" name="senior" readonly hidden>
                                            </div>
                                        </div>
        
                                        <div class="OneInputField">
                                            <label class="Labels" for="Contact Number">Contact No.</label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput" type="text" placeholder="Enter Your Phone Number" id="phonenum" name="phonenum" required maxlength="11" oninput="validatePhoneNumber(this)">
                                        </div>


                                        <div class="OneInputField">
                                            <label class="Labels" for="Disabilities">Do you have disabilities?</label>
                                            <div style="margin-top: 15px; margin-bottom: 15px;" class="radioButtonPwd">
                                                <div class="check1">
                                                    <span class="spanCheck">Yes</span>
                                                    <input type="checkbox" id="checkYes" name="disabilities" value="Yes" required>
                                                </div>

                                                <div class="check2">
                                                    <span class="spanCheck">No</span>
                                                    <input class="checkBoxx" type="checkbox" id="checkNo" name="disabilities" value="No" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- PWD ID Upload Input (Initially Hidden) -->
                                        <div id="pwdIdContainer" style="display: none; margin-top: 10px; margin-bottom: 10px;">
                                            <!-- <label class="Labels" for="pwdId">Upload PWD ID:</label> -->
                                            
                                            <!-- Div that will trigger file input -->
                                            <div id="uploadTrigger" style="border: 2px dashed #000; padding: 10px; text-align: center; cursor: pointer;">
                                                <span>Click here to upload PWD ID</span>
                                                <img id="uploadedImage" style="display: none; max-width: 100%; max-height: 100%; object-fit: contain;" alt="Uploaded PWD ID" />
                                            </div>
                                            
                                            <!-- Hidden file input -->
                                            <input type="file" id="pwdId" name="pwdId" accept="image/*" style="display: none;" required>
                                        </div>

                                        <!-- Image Preview Modal -->
                                        <div class="imageModal" style="display: none;">
                                            <div class="modalContent">
                                                <span class="closeModal" style="cursor: pointer; position: absolute; top: 10px; right: 10px; font-size: 24px;">&times;</span>
                                                <img class="modalImage" src="" alt="Modal Preview" style="max-width: 100%; max-height: 80vh; object-fit: contain; display: block; margin: auto;" />
                                            </div>
                                        </div>

                                        <!-- DROPDOWN NA PWD KASO AYAW NI MASTER SIGE WAG NA 
                                        <div class="OneInputField dropdown">
                                            <label class="Labels"> Do you have disabilities? </label>
                                            <span style="color:red"> &#42; </span>
                                            <div class="dropdown-button">Select Option</div>
                                            <div class="dropdown-content">
                                                <label class="option" data-value="yes">
                                                    <input class="Pili SignUpInput" type="radio" name="disabilities" value="Yes"> Yes
                                                </label>
                                                <label class="option" data-value="no">
                                                    <input class="Pili SignUpInput" type="radio" name="disabilities" value="No"> No
                                                </label>
                                            </div>
                                        </div>-->

        
                                        <!-- ADDRESS DETAILS -->
                                        <h3> Address Details </h3>
                                        <div class="RowInputFields">
                                            <div class="OneInputField">
                                                <label class="Labels" for="Block"> Block </label>
                                                <span style="color:red"> &#42; </span>
                                                <div class="dropdownBL">
                                                    <input class="SignUpInput" type="text" id="block" name="block" placeholder="Select Block" readonly>
                                                    <div class="arrow"> </div>
                                                    <div class="dropdownContenttt" id="blockDropdownContent">
                                                        <div class="dropdown-itemss"> 1 </div>
                                                        <div class="dropdown-itemss"> 2 </div>
                                                        <div class="dropdown-itemss"> 3 </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="OneInputField">
                                                <label class="Labels" for="Lot"> Lot </label>
                                                <span style="color:red"> &#42; </span>
                                                <div class="dropdownBL">
                                                    <input class="SignUpInput" type="text" id="lot" name="lot" placeholder="Select Lot" readonly>
                                                    <div class="arrow"> </div>
                                                    <div class="dropdownContenttt" id="lotDropdownContent">
                                                        <div class="dropdown-itemss"> 1 </div>
                                                        <div class="dropdown-itemss"> 2 </div>
                                                        <div class="dropdown-itemss"> 3 </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="OneInputField">
                                            <label class="Labels"> Street </label>
                                            <input class="SignUpInput" type="text" id="street" name="street" placeholder="Enter Your Street Name">
                                        </div>

                                        <div class="NextBtnCon">
                                            <button class="NextBtn" type="button"> Next </button>
                                        </div>
                                    </div>
                                </form>
         
                               <form class="EmailForm" id="EmailForm" enctype="multipart/form-data" method="POST">
                                    <!-- <div class="sakses"></div> -->
                                    <div class="EmailCon SignUpParehas" id="EmailAdd">
                                        <!-- Email input fields go here -->
                                        <h3> Create Account </h3>

                                        <div class="OneInputField Middle">
                                            <label class="Labels"> Email </label>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SignUpInput emailed" type="text" placeholder="Enter Your Email Address" id="emailOTP" name="email" required> 
                                        </div> 
                                        <p class="EmailParag" style="color:red"> &#42; Please enter a valid e-mail address (Gmail or Yahoo only) </p>

                                        <div class="CreatePassCon SignUpParehas" id="CreatePassword">
                                        <!-- Create password fields go here -->
                                        <h3> Create Password </h3>
                                        <p class="EmailParagg"> Create a strong password by combining at least 8 characters,  
                                            including uppercase and lowercase letters, numbers, 
                                            and special characters (e.g., !, @, #, $). <br> Avoid using weak password and 
                                            guessable information such as your name or birthdate!
                                        </p> 
                                            
                                        <div class="OneInputField">
                                            <label class="Labels"> Password </label>
                                            <span style="color:red"> &#42; </span>
                                            <div class="CreatePassSign">
                                                <input class="SignUpInput password" type="password" id="Pass" placeholder="Enter Password" required>
                                                <img class="MataSign" src="Pictures/Open-eyed.png" id="BukasMata1" onclick="toggleEye1('BukasMata1', 'SaradoMata1', 'Pass')" style="display: none;">
                                                <img class="MataSign" src="Pictures/closed-eye.png" id="SaradoMata1"  onclick="toggleEye1('SaradoMata1', 'BukasMata1', 'Pass')">
                                            </div>
            
                                            <label class="Labels"> Confirm Password </label>
                                            <span style="color:red"> &#42; </span>
                                            <div class="CreatePassSign">
                                                <input class="SignUpInput password" type="password" id="Pass2" placeholder="Enter Password" required>
                                                <img class="MataSign" src="Pictures/Open-eyed.png" id="BukasMata2" onclick="toggleEye2('BukasMata2', 'SaradoMata2', 'Pass2')" style="display: none;">
                                                <img class="MataSign" src="Pictures/closed-eye.png" id="SaradoMata2"  onclick="toggleEye2('SaradoMata2', 'BukasMata2', 'Pass2')">
                                            </div>
            
                                            <!-- <button class="NextBtn"> Submit </button> -->
                                        </div>
                                    </div>
        
                                        <div class="ButtonNextAndBack Bottom">
                                            <button class="NextBtn backEmail" type="button"> Back </button>
                                            <button class="NextBtn sendEmail" id="sendOTPButton" type="button"> Verify Email </button>
                                        </div>
                                    </div>
                               </form>
                        
                                <form class="OtpForm" id="OtpForm">
                                    <div class="OtpCon SignUpParehas" id="OtpInt">
                                        <!-- OTP input fields go here -->
                                        <h3> Verify Your Email </h3>
                                        <div class="OtpParagg" style="display: none">
                                            <p class="EmailParag"> Please Enter The 6 Digit Code Sent To <span id="sentEmail"></span> </p>
                                            <!-- <input class="OtpInt" type="text" > -->
                                        </div> 
            
                                        <div class="MiddleOtp">
                                            <input class="SignUpInput" type="text" placeholder="Enter the OTP" id="beripayOTP">
                                        </div>
            
                                        <div class="ButtonNextAndBack Bottom">
                                             
                                            <!-- <button class="NextBtn" id="backOTPEmail" type="button"> Back </button> -->
                                            <button class="NextBtn" id="sendOTP" type="button"> Send OTP </button>
                                            <button class="NextBtn" id="verifyOTP" type="button"> Verify </button>
                                        </div>

                                        <!-- <div id="timerLabel" style="display:none; color: blue; font-size: medium; margin-top:10px;">
                                            Expires In:
                                        </div>
                                        <div id="otpTimer" style="color:blue; display:none; font-size: medium; margin-top:10px">1:00</div> -->

                                        <!-- Resend OTP button (Initially hidden) -->
                                        <!-- <button class="NextBtn" type="button" class="resendOTP" id="resendOTP" style="display:none; margin-top:10px;">Resend OTP</button> -->
                                    </div>
                                </form>
                        
                                <!-- <form class="CreatePassForm">
                                    <div class="CreatePassCon SignUpParehas" id="CreatePassword">
                                         Create password fields go here 
                                        <h3> Create Password </h3>
                                        <p class="EmailParag"> Create a strong password by combining at least 8 characters,   HINDI PA TO SURE NAKA DIPENDE PA TO SAYO BEBI KUNG ANONG BALAK MO 
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
                                </form> -->
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
