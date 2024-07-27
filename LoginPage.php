<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="CSS/LoginPage.css">
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
                                <span class="login-title">Login</span>

                                <form class="login-forms">
                                    <div class="login-input-field">
                                        <input type="text" required="required" class="inputLogin">
                                        <span>Username</span>
                                        <img class="img-login" src="Pictures/usernameCap.png">
                                    </div>
                                    <div class="login-input-field">
                                        <input type="password" required="required" class="password inputLogin">
                                        <span>Password</span>
                                    </div>

                                    <div class="forgotpass-container">
                                        <a href="#" class="forgot-text">Forgot Password?</a>
                                    </div>

                                    <div class="btn-login">
                                        <button class="login-press">Login</button>
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
                    <span class="signUp-title"> Sign Up </span>
                    <div class="formSignup">
                        
                        <form class="signup-form">
                            <div class="form first">
                                <div class="details personal">
                                    <span class="titleniyato"> Personal Details </span>

                                    <div class="input-field">
                                        <span> First Name </span>
                                        <input type="text" placeholder="Enter Your First Name">
                                    </div>

                                    <div class="input-field">
                                        <span> Middle Name </span>
                                        <input type="text" placeholder="Enter Your Middle Name">
                                    </div>
        
                                    <div class="input-field">
                                        <span> Last Name </span>
                                        <input type="text" placeholder="Enter Your Last Name">
                                    </div>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Suffix </span>
                                            <input type="text" placeholder="Enter Your Suffix">
                                        </div>
            
                                        <div class="input-field dropdown">
                                            <span>Gender</span>
                                            <div class="dropdown-button">Select Option</div>
                                            <div class="dropdown-content">
                                                <label class="option" data-value="male">
                                                    <input class="pagpipilianKasarian" type="radio" name="gender" value="male"> Male
                                                </label>
                                                <label class="option" data-value="female">
                                                    <input class="pagpipilianKasarian" type="radio" name="gender" value="female"> Female
                                                </label>
                                                <label class="option" data-value="other">
                                                    <input class="pagpipilianKasarian" type="radio" name="gender" value="other"> Other
                                                </label>
                                            </div>
                                        </div>                                        
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
                                        <button class="SumbitSignUp-Btn">
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
</body>
</html>
