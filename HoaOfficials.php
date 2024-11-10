<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'user') {
        header("Location: LoginPage.php");
        exit();
    }
  } else {
    header("Location: LoginPage.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/HoaOfficials.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
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

<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 <br> Phase 5 </h2>
                </div>
                <div class="DagdagNanaman">
                    <a href="DashBoard.php" class="sideside baractive">
                        <img class="img-sideboard" src="Pictures/Dashboard2.png">
                        <span> Dasboard </span>
                    </a>
                    <a href="HoaOfficials.php" class="sideside">
                        <img class="img-sideboard" src="Pictures/Officials.png">
                        <span> Hoa Officials </span>
                    </a>
                    <a href="Residents.php" class="sideside">
                        <img class="img-sideboard" src="Pictures/Residents2.png">
                        <span> Residents </span>
                    </a>
                    <a href="Documents.php" class="sideside">
                        <img class="img-sideboard" src="Pictures/Documents2.png">
                        <span> Documents </span>
                    </a>
                    <div class="complaintsContainer">
                        <a href="Complaints.php" class="sideside" id="complaintsDropdown">
                            <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                            <span> Manage Complaints</span>
                            <button class="buttonEme2">
                                <div class="eme2"></div>
                            </button>
                        </a>  
                        <ul class="subMenuComp" id="complaintsSubMenu">
                            <li> 
                                <a href="In-Process.php">
                                    <img class="img-subMenu" src="Pictures/In-Process.png">
                                    <label class="sub-spa"> In-Process </label>
                                </a> 
                                <a href="Resolved.php">
                                    <img class="img-subMenu" src="Pictures/resolved.png">
                                    <label class="sub-spa"> Resolved </label>
                                </a> 
                                <a href="Escalated.php">
                                    <img class="img-subMenu" src="Pictures/warning.png">
                                    <label class="sub-spa"> Escalated </label>
                                </a> 
                                <a href="MainChat.php">
                                    <img class="img-subMenu" src="Pictures/Chat.png">
                                    <label class="sub-spa"> Chat </label>
                                </a> 
                            </li>
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
                    <!-- <a href="MonthlyDue.php" class="sideside">
                        <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                        <span> Monthly Due </span>
                    </a> -->
                    <a href="Voting.php" class="sideside">
                        <img class="img-sideboard" src="Pictures/voting.png">
                        <span> Voting </span>
                    </a>
                    <a href="Logout.php" class="sideside">
                        <img class="img-sideboard" src="Pictures/logout.png">
                        <span> Logout </span>
                    </a>
                </div>
            </div>

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

            <div class="MainBodyContainerr MainBodyConActivee">
                <div class="headerTopMain">
                    <div class="HamburgerandOthers">
                        <div class="memuIcon">
                            <img id="menuBtn" class="menu" src="Pictures/menu-hamburger.png">
                        </div>
                        <div class="NamesModuleCon">
                            <h2 class="namePerModule"> HOA Officials </h2>
                        </div>
                    </div>
                    <div class="ProfileViewww">
                        <button id="myProfileBtn" type="button" class="profileBtn">
                            <label> Profile </label>
                        </button>
                        <div class="user-img"></div>
                    </div>
                </div>
                <div class="MainContainerForTables">
                    <div class="MainContainerAll">
                        <div class="subofficialCards">

                            <!-- PRESIDENT  -->
                            <div class="everyConOfficial" id="PresContainer">
                                <div class="officialLaman" id="imageContainer">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="President"> PRESIDENT </h2>
                                <input class="inputNgUUpo" type="text" id="PresName">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics">Upload Picture</button>
                                        <input class="inputFileCert inputts" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- VICE PRESIDENT -->
                            <div class="everyConOfficial" id="ViceContainer">
                                <div class="officialLaman" id="imageContainer2">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="VicePresident">  VICE PRESIDENT </h2>
                                <input class="inputNgUUpo" type="text" id="ViceName">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics2">Upload Picture</button>
                                        <input class="inputFileCert2 inputts" type="file" id="VicePic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- SECRETARY -->
                            <div class="everyConOfficial" id="SecContainer">
                                <div class="officialLaman" id="imageContainer3">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="Secretary"> SECRETARY </h2>
                                <input class="inputNgUUpo" type="text" id="SecName">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics3">Upload Picture</button>
                                        <input class="inputFileCert3 inputts" type="file" id="SecPic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- TREASURER -->
                            <div class="everyConOfficial" id="TresContainer">
                                <div class="officialLaman" id="imageContainer4">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="Treasurer"> TREASURER </h2>
                                <input class="inputNgUUpo" type="text" id="TresName">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics4">Upload Picture</button>
                                        <input class="inputFileCert4 inputts" type="file" id="TresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- AUDITOR -->
                            <div class="everyConOfficial" id="AudContainer">
                                <div class="officialLaman" id="imageContainer5">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="Auditor"> AUDITOR </h2>
                                <input class="inputNgUUpo" type="text" id="AudName">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics5">Upload Picture</button>
                                        <input class="inputFileCert5 inputts" type="file" id="AudPic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- PEACE IN ORDER -->
                            <div class="everyConOfficial" id="PeaceContainer">
                                <div class="officialLaman" id="imageContainer6">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="PeaceInOrder"> PEACE IN ORDER </h2>
                                <input class="inputNgUUpo" type="text" id="PeaceName">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics6">Upload Picture</button>
                                        <input class="inputFileCert6 inputts" type="file" id="PeacePic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- DIRECTOR 1 -->
                            <div class="everyConOfficial" id="Direc1Container">
                                <div class="officialLaman" id="imageContainer7">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="Director1"> DIRECTOR </h2>
                                <input class="inputNgUUpo" type="text" id="Direc1Name">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics7">Upload Picture</button>
                                        <input class="inputFileCert7 inputts" type="file" id="Direc1Pic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- DIRECTOR 2  -->
                            <div class="everyConOfficial" id="Direc2Container">
                                <div class="officialLaman" id="imageContainer8">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="Director2"> DIRECTOR </h2>
                                <input class="inputNgUUpo" type="text" id="Direc2Name">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics8">Upload Picture</button>
                                        <input class="inputFileCert8 inputts" type="file" id="Direc2Pic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
                                </div>
                            </div>

                            <!-- DIRECTOR 3  -->
                            <div class="everyConOfficial" id="Direc3Container">
                                <div class="officialLaman" id="imageContainer9">
                                    <!-- Image will be displayed here -->
                                </div>
                                <h2 class="LabelUpo" value="Director3"> DIRECTOR </h2>
                                <input class="inputNgUUpo" type="text" id="Direc3Name">
                                <div class="buttonsNgOffi">
                                    <div class="btnOne">
                                        <button class="buttonSiv UploadPics9">Upload Picture</button>
                                        <input class="inputFileCert9 inputts" type="file" id="Direc3Pic" style="display: none;">
                                    </div>
                                    <div class="btnTwo">
                                        <button class="buttonSiv SaveBtn"> Save </button>
                                    </div>
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