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

// if (isset($_SESSION['unique_id'])) {
//     if ($_SESSION['role'] == 'admin') {
//         header("Location: DashBoard.php");
//         exit(); 
//     } elseif ($_SESSION['role'] == 'user') {
//         header("Location: UserRequest.php");
//         exit();
//     }
// }

// echo $_SESSION['unique_id'];

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
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
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
            
                                        <!-- <div class="input-field">
                                            <span> Sex </span>
                                            <input type="text" placeholder="Enter your Sex" name="gender">
                                        </div> -->
                                        <div class="input-field">
                                            <span> Gender </span>
                                            <select name="gender" id="gender">
                                                <option value="" disabled selected>Choose an option</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Preferred Not to Say">Preferred Not to Say</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="rowFields">
                                        <div class="input-field">
                                            <span> Age </span>
                                            <input type="text" placeholder="Enter Your Age" name="age">
                                        </div>
            
                                        <!-- <div class="input-field">
                                            <span> PWD </span>
                                             <input type="text" placeholder="" name="pwd" id="pwd">
                                        </div> -->
                                    

                                        <div class="input-field">
                                            <span> Phone Number </span>
                                            <input type="text" placeholder="Enter Your Phone Number" name="phonenum">
                                        </div>
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


                                    <!-- <div class="details ID">
                                        <span class="titleniyato">Emergency Contacts </span>

                                        <div class="input-field">
                                            <span> Name </span>
                                            <input type="text" placeholder="Enter their Full Name" name="GrdnName" id="GrdnName">
                                        </div>

                                        <div class="input-field">
                                            <span> Contact Number </span>
                                            <input type="text" placeholder="Enter their Contact Number" name="GrdnNumber" id="GrdnNumber">
                                        </div>
            
                                        <div class="input-field">
                                            <span> Relationship </span>
                                            <input type="text" placeholder="Enter your Relationship" name="GrdnRelship" id="GrdnRelship">
                                        </div>
    
                                        <div class="input-field">
                                            <span> Address </span>
                                            <input type="text" placeholder="Enter their Address" name="GrdnAdress" id="GrdnAdress">
                                        </div>
                                    </div> -->

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

        const genderSelect = form.querySelector("#gender");
        const PWD = form.querySelector("#pwd"); 
        // const ecNamee = form.querySelector("#GrdnName");
        // const ecNumb = form.querySelector("#GrdnNumber");
        // const ecRels = form.querySelector("#GrdnRelship");
        // const ecAddr = form.querySelector("#GrdnAdress");



        nextBtn.addEventListener("click", () => {
            let allFilled = true;
            allInput.forEach(input => {
                if (input.getAttribute('placeholder') !== "Enter Your Suffix" && input.value === "") {
                    allFilled = false;
                }
                
            });

            console.log("All input fields filled:", allFilled);

            // ganto kapag pwede walang laman
            // if (PWD.value === "") {
            //     allFilled = true;
            // }
            // console.log("pwd field filled:", allFilled);

            // ganto kapag bawal walang laman
            if (genderSelect.value === "") {
                allFilled = false;
            }
            console.log("Gender select filled:", allFilled);

            // Sa emergency contacts itinago na kasi
            // if (ecNamee.value === "") {
            //     allFilled = true;
            // }
            // console.log("ecNamee select filled:", allFilled);
            // if (ecNumb.value === "") {
            //     allFilled = true;
            // }
            // console.log("ecNumb select filled:", allFilled);
            // if (ecRels.value === "") {
            //     allFilled = true;
            // }
            // console.log("ecRels select filled:", allFilled);
            // if (ecAddr.value === "") {
            //     allFilled = true;
            // }
            // console.log("ecAddr select filled:", allFilled);

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
