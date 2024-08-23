<?php 
include "Connect/Connection.php";
session_start();

if(isset($_SESSION['unique_id'])){
    // Perform logout actions
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/LoginPage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="main">
        <div class="mainContainer">
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
                                    <div class="login-input-field">
                                        <input type="text" required="required" class="inputLogin" name="email">
                                        <span>Email Address</span>
                                        <img class="img-login" src="Pictures/usernameCap.png">
                                    </div>
                                    <div class="login-input-field">
                                        <input type="password" required="required" class="password inputLogin" name="loginpassword">
                                        <span>Password</span>
                                    </div>

                                    <div class="forgotpass-container">
                                        <a href="#" class="forgot-text">Forgot Password?</a>
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
                        <img class="imgLogo" src="Pictures/Mabuhay_Logo.png">
                    </div>

                    <span class="signUp-title"> Sign Up </span>
                    <div class="formSignup">
                        
                        <form class="signup-form saynap" enctype="multipart/form-data">
                        <div class="iror"></div>
                            <div class="form first">
                                <div class="details personal">
                                    <span class="titleniyato"> Personal Details </span>

                                    <div class="input-field">
                                        <span> First Name </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text" placeholder="Enter Your First Name" name="fname"> 
                                    </div>

                                    <div class="input-field">
                                        <span> Middle Name </span>
                                        <input class="SUF" type="text" placeholder="Enter Your Middle Name" name="mname">
                                    </div>
        
                                    <div class="input-field">
                                        <span> Last Name </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text" placeholder="Enter Your Last Name" name="lname">
                                    </div>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Suffix </span>
                                            <input class="SUF" type="text" placeholder="Enter Your Suffix" name="suffix">
                                        </div>
            
                                        <div class="input-field dropdown">
                                            <span>Gender</span>
                                            <span style="color:red"> &#42; </span>
                                            <div class="dropdown-button">Select Option</div>
                                            <div class="dropdown-content">
                                                <label class="option" data-value="male">
                                                    <input class="pagpipilianKasarian SUF" type="radio" name="gender" value="male"> Male
                                                </label>
                                                <label class="option" data-value="female">
                                                    <input class="pagpipilianKasarian SUF" type="radio" name="gender" value="female"> Female
                                                </label>
                                                <label class="option" data-value="other">
                                                    <input class="pagpipilianKasarian SUF" type="radio" name="gender" value="other"> Other
                                                </label>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Date Of Birth </span>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SUF" type="date">
                                        </div>

                                        <div class="input-field">
                                            <span> Age </span>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SUF" type="text">
                                        </div>
                                    </div>

                                    <div class="input-field">
                                        <span> Contact No. </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text" placeholder="Enter Your Number" name="lname">
                                    </div>

                                    <div class="input-field">
                                        <span> Do you have disabilities? </span>
                                        <div class="radioButtonPwd">
                                            <div class="check1">
                                                <span class="spanCheck"> Yes </span>
                                                <input type="checkbox">
                                            </div>

                                            <div class="check2">
                                                <span class="spanCheck"> No </span>
                                                <input type="checkbox">
                                            </div>
                                        </div>
                                    </div>

                                    <span class="titleniyato"> Address Details </span>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Block </span>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SUF" type="text">
                                        </div>

                                        <div class="input-field">
                                            <span> Lot </span>
                                            <span style="color:red"> &#42; </span>
                                            <input class="SUF" type="text">
                                        </div>
                                    </div>

                                    <div class="input-field">
                                        <span> Street </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text">
                                    </div>

                                    <span class="titleniyato"> Create Account </span>

                                    <div class="input-field">
                                        <span> Email </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text">
                                    </div>

                                    <div class="input-field">
                                        <span> Password </span>
                                        <span style="color:red"> &#42; </span>
                                        <input class="SUF" type="text">
                                    </div>

                                    <!-- <div class="rowFields">
                                        <div class="input-field">
                                            <span> Suffix </span>
                                            <input type="text" placeholder="Enter Your Suffix">
                                        </div>
            
                                        <div class="input-field">
                                            <span> Gender </span>
                                            <input type="text" placeholder="Gender">
                                        </div>
                                    </div> -->

                                    <div class="btnNgSubmit">
                                        <button class="SumbitSignUp-Btn SaynapBtn">
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
    
    <!-- <script>
        // JavaScript logic
        function showSignUpForm() {
            document.getElementById("loginForm").classList.remove("show");
            document.getElementById("signUpForm").classList.add("show");
        }
    
        function showLoginForm() {
            document.getElementById("signUpForm").classList.remove("show");
            document.getElementById("loginForm").classList.add("show");
        }
    
        const form = document.querySelector(".signup-form");
        const nextBtn = form.querySelector(".nextBtn");
        const backBtn = form.querySelector(".backBtn");
        const allInput = form.querySelectorAll(".first input");

        const genderSelect = form.querySelector("#gender");
        const PWD = form.querySelector("#pwd"); 
        // const ecNamee = form.querySelector("#GrdnName");
        // const ecNumb = form.querySelector("#GrdnNumber");
        // const ecRels = form.querySelector("#GrdnRelship");
        // const ecAddr = form.querySelector("#GrdnAdress");

    </script>  -->
    <script src="JS/Signup.js"></script>     
    <script src="JS/Login.js"></script>  
</body>
</html>
