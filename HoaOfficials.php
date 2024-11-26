<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'barangay') {
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
    <script src="jQuery/jquery.min.js"></script>
    <script src="JS/sidebar.js"> </script>
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 <br> Phase 5 </h2>
                </div>
                <div class="DagdagNanaman">
                    <a href="DashBoard.php" class="sideside">
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
                    <div class="documentsContainer">
                        <a href="Documents.php" class="sideside" id="documentsDropdown">
                            <img class="img-sideboard" src="Pictures/Documents2.png">
                            <span> Documents </span>
                            <button class="buttonEme3">
                                <div class="eme3"></div>
                            </button>
                        </a>
                        <ul class="subMenuDocs" id="documentsSubMenu">
                            <li>
                                <a href="#">
                                    <img class="img-subMenu" src="">
                                    <label class="sub-spa"> ehe </label>
                                </a>
                            </li>
                        </ul>
                    </div>
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
                    <a href="AnnouncementTable.php" class="sideside">
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
                    <div class="HoaContainer">
                        <div class="HoaTableCon">
                            <table class="HoaTbl">
                                <thead>
                                    <th> Pictures </th>
                                    <th> Positions </th>
                                    <th> Name </th>
                                    <th> Action </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Wala pa </td>
                                        <td> President </td>
                                        <td> Solomon Malit </td>
                                        <td>
                                            <button class="HoaEditing" id="HoaEditing" onclick="toggleModalEdit()"> Edit </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <div class="ModalEditingPos">
                                <div class="SubEditingMod">
                                    <div class="EditingContent">
                                        <header class="ConEkis">
                                            <span class="EkisHo"> &times; </span>
                                        </header>
                                        <div class="LamanNgModalEd">
                                            <div class="Paniraa">
                                                <div class="PictureWrapper" id="PictureWrapper">
                                                    <input class="InputPic" type="file" id="Picturee">
                                                    <img class="PictureImgIcon" src="Pictures/cloudUpload.png" alt="Upload Icon">
                                                    <p class="TextIcon"> Select new images or <span class="spanNiyaModal">browse</span>.</p>
                                                </div>
                                            
                                                <div class="imgContainerr" id="imgContainerr"> </div>
                                            </div>
                                            <div style="margin-top: 10px;" class="Coonn">
                                                <label class="LabelEd"> Position: </label>
                                                <input class="InputEd" type="text">
                                            </div> 
                                            <div class="Coonn">
                                                <label class="LabelEd"> Name: </label>
                                                <input class="InputEd" type="text">
                                            </div>                                           
                                        </div>
                                        <footer class="FooterSave">
                                            <button class="SaveEditing"> Save </button>
                                        </footer>
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