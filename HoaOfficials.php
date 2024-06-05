<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
  if ($_SESSION['role'] == 'user') {
      header("Location: LoginPage.php");
      exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/HoaOfficials.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="SuccessModalIto" id="successModal">
        <div class="subSuccessModalContent">
            <div class="successModalContent">
                <div class="successText">
                    <img class="successImg" src="Pictures/success.png">
                    <h2 class="paragSuccess">Updated Successfully!</h2>
                </div>
                <hr class="hrSuccess"> 
                <div class="successButtons">
                    <button class="buttonSuccess okButn OkSaModal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL NG SUCCESS -->
    <div id="profileModal" class="modal">
        <div class="subModal">
            <div class="modal-content">
                <div class="profileSidebar">
                    <a href="#" onclick="openPage('Edit Profile')"> Edit Profile </a>
                    <a href="#" onclick="openPage('Edit Email')"> Edit Email </a>
                    <a href="#" onclick="openPage('Change Password')"> Change Password </a>
                </div>

                <div class="profilePages">
                    <span class="closeProf">&times;</span>
                    <div id="Edit Profile" class="page">
                        <h2>Edit Profile Page</h2>
                        <p>Welcome to the Edit Profile page.</p>
                    </div>
                    <div id="Edit Email" class="page">
                        <h2>Edit Email Page</h2>
                        <p>Welcome to the Edit Email page.</p>
                    </div>
                    <div id="Change Password" class="page">
                        <h2> Change Password </h2>
                        <p class="paragChange">
                            Your password must be at least 6 character and should include a 
                            combination of numbers, letters and special characters (&#33; &#36; &#64; &#37;)
                        </p>

                        <div class="changingPassword">
                            <div class="changingInputBox">
                                <input class="inputngChanging" type="password" placeholder="Current Password">
                            </div>
                            <div class="changingInputBox">
                                <input class="inputngChanging" type="password" placeholder="New Password">
                            </div>
                            <div class="changingInputBoxLast">
                                <input class="inputngChanging" type="password" placeholder="Re-type Password">
                            </div>
                            <div class="changingForgotPass">
                                <a class="forgotpassAs" href="#"> Forgot Password? </a>
                            </div>
                            <div class="changingButton">
                                <button class="buttonSapagPalit" type="submit"> Change Password </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="headerTop">
                <div class="leftSection">
                    <img class="menu" src="Pictures/menu-hamburger.png">
                    <img class="img-logo" src="Pictures/Dasma_City_Logo.png">
                    <h2> Mabuhay Homes 2000 </h2>
                </div>
                <div class="rightSection">
                    <button id="myProfileBtn" type="button" class="profileBtn">
                        <div class="user-img"></div>
                        <label> Profile </label>
                    </button>
                    <!-- <div class="eme3"></div> -->
                </div>
            </div>

            <div class="sidebarContainer sideActive" id="sidebar">
                <a href="DashBoard.php" class="sideside active">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="HoaOfficials.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Officials.png">
                    <span> HOA Officials </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Residents2.png">
                    <span> Residents </span>
                </a>
                <a href="Documents.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Documents2.png">
                    <span> Documents </span>
                </a>
                <!-- <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Request2.png">
                    <span> Online Request </span>
                </a> -->
                <div class="complaintsContainer">
                    <a href="#" class="sideside" id="complaintsDropdown">
                        <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                        <span> Complaints </span>
                        <div class="eme2"></div> 
                    </a>  
                    <ul class="subMenuComp" id="complaintsSubMenu">
                        <li> 
                            <a href="MainChat.php">
                                <img class="img-subMenu" src="Pictures/Chat.png">
                                <label class="sub-spa"> Chat </label>
                            </a> 
                        </li>
                        <!-- <li> <a href="#"> Sub Menu 2 </a> </li>
                        <li> <a href="#"> Sub Menu 3 </a> </li> -->
                    </ul>
                </div>
                <a href="Announcement.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
                </a>
                <a href="Accounts.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Accounts2.png">
                    <span> Accounts </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="Logout.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/logout.png">
                    <span> Logout </span>
                </a>
            </div>

            <div class="HOAContainerr HOAConActivee">
                <div class="dashContents">
                    <h1> Editing HOA Officials </h1>
                </div>

                <div class="officialsConCards">
                    <div class="subofficialCards">


                        <!-- PRESIDENT  -->
                        <div class="everyConOfficial" id="PresContainer">
                            <div class="officialLaman" id="imageContainer">

                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="President"> PRESIDENT </label>
                                <input class="inputNgUUpo" type="text" id="PresName">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics"> Upload Picture </button>
                                    <input class="inputFileCert inputts" type="file" id="PresPic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                        <!-- VICE PRESIDENT -->
                        <div class="everyConOfficial" id="ViceContainer">
                            <div class="officialLaman" id="imageContainer2">
                                
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="VicePresident"> VICE PRESIDENT </label>
                                <input class="inputNgUUpo" type="text" id="ViceName">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics2"> Upload Picture </button>
                                    <input class="inputFileCert2 inputts" type="file" id="VicePic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                        <!-- SECRETARY -->
                        <div class="everyConOfficial" id="SecContainer">
                            <div class="officialLaman" id="imageContainer3">
                                
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="Secretary"> SECRETARY </label>
                                <input class="inputNgUUpo" type="text" id="SecName">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics3"> Upload Picture </button>
                                    <input class="inputFileCert3 inputts" type="file" id="SecPic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                        <!-- TREASURER -->
                        <div class="everyConOfficial" id="TresContainer">
                            <div class="officialLaman" id="imageContainer4">
                                
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="Treasurer"> TREASURER </label>
                                <input class="inputNgUUpo" type="text" id="TresName">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics4"> Upload Picture </button>
                                    <input class="inputFileCert4 inputts" type="file" id="TresPic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                        <!-- AUDITOR -->
                        <div class="everyConOfficial" id="AudContainer">
                            <div class="officialLaman" id="imageContainer5">
                                            
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="Auditor"> AUDITOR </label>
                                <input class="inputNgUUpo" type="text" id="AudName">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics5"> Upload Picture </button>
                                    <input class="inputFileCert5 inputts" type="file" id="AudPic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                        <!-- PEACE IN ORDER -->
                        <div class="everyConOfficial" id="PeaceContainer">
                            <div class="officialLaman" id="imageContainer6">
                                                           
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="PeaceInOrder"> PEACE IN ORDER </label>
                                <input class="inputNgUUpo" type="text" id="PeaceName">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics6"> Upload Picture </button>
                                    <input class="inputFileCert6 inputts" type="file" id="PeacePic"> 
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                        <!-- DIRECTOR 1 -->
                        <div class="everyConOfficial" id="Direc1Container">
                            <div class="officialLaman" id="imageContainer7">
                                                           
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="Director1"> DIRECTOR </label>
                                <input class="inputNgUUpo" type="text" id="Direc1Name">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics7"> Upload Picture </button>
                                    <input class="inputFileCert7 inputts" type="file" id="Direc1Pic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                         <!-- DIRECTOR 2  -->
                        <div class="everyConOfficial" id="Direc2Container">
                            <div class="officialLaman" id="imageContainer8">
                                                           
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="Director2"> DIRECTOR </label>
                                <input class="inputNgUUpo" type="text" id="Direc2Name">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics8"> Upload Picture </button>
                                    <input class="inputFileCert8 inputts" type="file" id="Direc2Pic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
    

                        <!-- DIRECTOR 3  -->
                        <div class="everyConOfficial" id="Direc3Container">
                            <div class="officialLaman" id="imageContainer9">
                                                            
                            </div>
                            <div class="UpoName">
                                <label class="LabelUpo" value="Director3"> DIRECTOR </label>
                                <input class="inputNgUUpo" type="text" id="Direc3Name">
                            </div>
                            <div class="buttonsNgOffi">
                                <div class="btnOne">
                                    <button class="butonSiv UploadPics9"> Upload Picture </button>
                                    <input class="inputFileCert9 inputts" type="file" id="Direc3Pic">
                                </div>
                                <div class="btnTwo">
                                    <button class="butonSiv SaveBtn"> Save </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    <script src="JS/HoaOfficials.js"></script>
</body>
</html>