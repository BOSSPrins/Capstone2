<?php
include_once "Header.php";
if (!isset($_SESSION)){
    session_start();
}
if (isset($_SESSION['unique_id'])){
    header("location: DashBoard.php");
}
include "Connect/Connection.php";
?>

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
                     <span class="signUp-title"> Sign Up </span>
                    <div class="formSignup">
                        
                        <form class="signup-form saynap" enctype="multipart/form-data">
                            <div class="iror"></div>
                            <div class="form first">
                                <div class="details personal">
                                    <span class="titleniyato"> Personal Details </span>

                                    <div class="input-field">
                                        <span> First Name </span>
                                        <input type="text" placeholder="Enter Your First Name" name="fname">
                                    </div>
        
                                    <div class="input-field">
                                        <span> Middle Name </span>
                                        <input type="text" placeholder="Enter Your Last Name" name="mname">
                                    </div>

                                    <div class="input-field">
                                        <span> Last Name </span>
                                        <input type="text" placeholder="Enter Your Middle Name" name="lname">
                                    </div>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Suffix </span>
                                            <input type="text" placeholder="Enter Your Suffix" name="suffix">
                                        </div>
            
                                        <div class="input-field">
                                            <span> Sex </span>
                                            <input type="text" placeholder="Gender" name="gender">
                                        </div>
                                    </div>
                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Age </span>
                                            <input type="text" placeholder="Enter Your Age" name="age">
                                        </div>
            
                                        <div class="input-field">
                                            <span> PWD </span>
                                             <input type="text" placeholder="Enter if you are PWD" > <!--lalagyan ng checkbox -->
                                        </div>
                                    </div>

                                    <div class="input-field">
                                        <span> Phone Number </span>
                                        <input type="text" placeholder="Enter Your Phone Number" name="phonenum">
                                    </div>

                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Block </span>
                                            <input type="text" placeholder="Enter your Block" name="block"> 
                                        </div>
            
                                        <div class="input-field">
                                            <span> Lot </span>
                                             <input type="text" placeholder="Enter your Lot" name="lot"> 
                                        </div>
                                    </div>


                                    <div class="details ID">
                                        <span class="titleniyato">Emergency Contacts </span>

                                        <div class="input-field">
                                            <span> Guardian's Name </span>
                                            <input type="text" placeholder="Enter Your Guradian Name" name="GrdnName">
                                        </div>

                                        <div class="input-field">
                                            <span> Guardian's Contact Number </span>
                                            <input type="text" placeholder="Enter Your Guardian Number" name="GrdnNumber">
                                        </div>
            
                                        <div class="input-field">
                                            <span> Relationship </span>
                                            <input type="text" placeholder="Enter relationship to Guardian" name="GrdnRelship">
                                        </div>
    
                                        <div class="input-field">
                                            <span> Guardian's Address </span>
                                            <input type="text" placeholder="Enter your Guardian Address" name="GrdnAdress">
                                        </div>
                                    </div>

                                    <button class="nextBtn">
                                        <span class="btnText"> Next </span>
                                    </button>

                                </div>
                            </div>


                            <div class="form second">
                                <div class="details personal">
                                    <span class="titleniyato"> Create your account: </span>

                                    <div class="input-field">
                                        <span> Email Address </span>
                                        <input type="text" placeholder="Enter Your First Name" name="email">
                                    </div>

                                    <div class="input-field">
                                        <span> Password </span>
                                        <input type="text" placeholder="Enter own Password" name="password">
                                    </div>

                                    <div class="input-field">
                                        <span> Select Image </span>
                                        <input type="file" name="image">
                                    </div>

                                    <div class="buttonss btnn">
                                        <div class="backBtn">
                                            <span class="btnText"> Back </span>
                                        </div>

                                        <button class="nextBtn bttn">
                                            <span class="btnText"> Submit </span>
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

    <script>
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

        nextBtn.addEventListener("click", () => {
            let allFilled = true;
            allInput.forEach(input => {
                if (input.getAttribute('placeholder') !== "Enter Your Suffix" && input.value === "") {
                    allFilled = false;
                }
            });

            if (allFilled) {
                form.classList.add('secActive');
            }
        });

        backBtn.addEventListener("click", () => {form.classList.remove('secActive');});
    </script> 
    <script src="JS/Signup.js"></script>     
    <script src="JS/Login.js"></script>  
</body>
</html>
