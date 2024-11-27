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
    <link rel="stylesheet" href="CSS/DashBoard.css">
    <script src="jQuery/jquery.min.js"></script>
    <script src="JS/sidebar.js"></script>
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
                            <input type="hidden" value="<?php echo $_SESSION['unique_id'];?>" id="fetchUID">
                            <a href="#" onclick="openPage('EditProfile')"> Edit Profile </a>
                            <a href="#" onclick="openPage('EditEmail')"> Edit Email </a>
                            <a href="#" onclick="openPage('ChangePassword')"> Change Password </a>
                        </div>
        
                        <div class="profilePages">
                            <span class="closeProf">&times;</span>
                            <form method="POST" enctype="multipart/form-data" id="editProfileForm">
                                <div id="EditProfile" name="ProfileName" class="page">
                                    <h2>Edit Profile Page</h2>
                                    <p>Welcome to the Edit Profile page.</p>
                                    <h2>Name:</h2>
                                    <div class="Profilebyu">
                                        <label> First Name: </label>
                                        <input type="text" name="fname" id="fname" readonly>
                                        <label> Middle Name: </label>
                                        <input type="text" name="mname" id="mname" readonly>
                                    </div>
                                    <div class="Profilebyu">
                                        <label> Last Name: </label>
                                        <input type="text" name="lname" id="lname" readonly>
                                        <label> Suffix: </label>
                                        <input type="text" name="suffix" id="suffix" readonly>
                                    </div>
                                    <div class="Profilebyu">
                                        <label> Date of Birth: </label>
                                        <input type="text" name="bday" id="bday" readonly>
                                        <label> Age: </label>
                                        <input type="text" name="age" id="age" readonly>
                                    </div>
                                    <div class="Profilebyu">
                                        <label> Sex: </label>
                                        <input type="text" name="sex" id="sex" readonly>
                                        <label> Contact Number: </label>
                                        <input type="text" name="contNum" id="contNum" readonly>
                                    </div>
                                    <h2>Person with Disability:</h2>
                                    <div class="Profilebyu">
                                        <label>
                                        <input type="checkbox" name="pwd_yes" id="pwdYes" disabled value="1"> Yes
                                        </label>
                                        <label>
                                        <input type="checkbox" name="pwd_no" id="pwdNo" disabled value="1"> No
                                        </label>
                                    </div>
                                    <h2>Address:</h2>
                                    <div class="Profilebyu">
                                        <label> Block: </label>
                                        <input type="text" name="blk" id="blk" readonly>
                                        <label> Lot: </label>
                                        <input type="text" name="lot" id="lot" readonly>                                        
                                    </div>
                                    <div class="Profilebyu">
                                        <label> Street: </label>
                                        <input type="text" name="street" id="street" readonly>
                                    </div>
                                    <h2>Emergency Contact: </h2> 
                                    <div class="Profilebyu">                                                               
                                        <label> Name: </label>   
                                        <input type="text" name="ecName" id="ecName" readonly>
                                        <label> Contact Number: </label>
                                        <input type="text" name="ecPhoneNum" id="ecPhoneNum" readonly>
                                    </div>
                                    <div class="Profilebyu">                                                               
                                        <label> Relationship: </label>   
                                        <input type="text" name="relasyon" id="relasyon" readonly>
                                        <label> Address: </label>
                                        <input type="text" name="ecAddress" id="ecAddress" readonly>
                                    </div>

                                    <div class="buttons">
                                        <button type="button" id="editButton">Edit</button>
                                        <button type="submit" id="updateButton" style="display: none;">Update</button>
                                        <button id="cancelButton" style="display: none;">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" enctype="multipart/form-data" id="formEmail">
                                <div id="EditEmail" class="page">
                                    <h2>Edit Email Page</h2>
                                    <p>Welcome to the Edit Email page.</p>

                                    <input type="text" id="oldEmail" value="<?php echo $_SESSION['email'];?>">
                                    <input type="text" id="newEmail" required>
                                    <button type="submit" id="submitEmail">Submit</button>

                                </div>
                            </form>
                            <form method="POST" enctype="multipart/form-data" id="profileChangePass">
                                <div id="ChangePassword" class="page">
                                    <h2> Change Password </h2>
                                    <p class="paragChange">
                                        Your password must be at least 6 character and should include a 
                                        combination of numbers, letters and special characters (&#33; &#36; &#64; &#37;)
                                    </p>

                                    <div class="changingPassword">
                                        <div class="changingInputBox">
                                            <input class="inputngChanging" type="password" placeholder="Current Password" id="OldPass">
                                        </div>
                                        <div class="changingInputBox">
                                            <input class="inputngChanging" type="password" placeholder="New Password" id="NewPass">
                                        </div>
                                        <div class="changingInputBoxLast">
                                            <input class="inputngChanging" type="password" placeholder="Re-type Password" id="confirmNewPass">
                                        </div>
                                        <div class="changingForgotPass">
                                            <a class="forgotpassAs" href="#"> Forgot Password? </a>
                                        </div>
                                        <div class="changingButton">
                                            <button class="buttonSapagPalit" type="submit" id="submitChangePass"> Change Password </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                            <h2 class="namePerModule"> Dashboard </h2>
                        </div>
                    </div>
                    <div class="ProfileViewww">
                        <button id="myProfileBtn" type="button" class="profileBtn">
                            <label> Profile </label>
                        </button>
                        <div class="user-img" style="background-image: url('Pictures/<?php echo $_SESSION['img']; ?>');"></div>
                    </div>

                </div>
                <div class="MainContainerForTables">
                    <div class="MainContainerAll">
                        <h3 class="ResidentsH3"> Resident's Record Summary </h3>

                        <div class="dashboardCards">
                            <div class="TotalResidents">
                                <div class="center">
                                    <div class="left-per-card">
                                        <img class="img-cards" src="Pictures/Accounts2.png">
                                    </div>
                                    <div class="right-per-card">
                                        <h3 class="info-card"> 
                                            <?php
                                                $dash_residents_sql = "SELECT * FROM tblresident";
                                                $dash_residents_query = mysqli_query($conn, $dash_residents_sql); 
                                                if($residents_total = mysqli_num_rows($dash_residents_query)) {
                                                    echo '<p class="#"> '.$residents_total.' </p>';
                                                }
                                                else {
                                                    echo '<p class="#"> No Data </p>';
                                                }
                                            ?>
                                        </h3>
                                        <h4 class="info-card"> Total Number of Residents </h4>
                                    </div>
                                </div> 
                            </div>

                            <div class="TotalResidents">
                                <div class="center">
                                    <div class="left-per-card">
                                        <img class="img-cards" src="Pictures/Accounts2.png">
                                    </div>
                                    <div class="right-per-card">
                                        <h3 class="info-card">
                                            <?php
                                                $dash_residents_sql = "SELECT * FROM tblresident WHERE sex = 'Female'";
                                                $dash_residents_query = mysqli_query($conn, $dash_residents_sql); 
                                                if($residents_total = mysqli_num_rows($dash_residents_query)) {
                                                    echo '<p class="#"> '.$residents_total.' </p>';
                                                }
                                                else {
                                                    echo '<p class="#"> No Data </p>';
                                                }
                                            ?>
                                        </h3>
                                        <h4 class="info-card"> Total Number of Female </h4>
                                    </div>
                                </div> 
                            </div>

                            <div class="TotalResidents">
                                <div class="center">
                                    <div class="left-per-card">
                                        <img class="img-cards" src="Pictures/Accounts2.png">
                                    </div>
                                    <div class="right-per-card">
                                        <h3 class="info-card">
                                            <?php
                                                $dash_residents_sql = "SELECT * FROM tblresident WHERE sex = 'Male'";
                                                $dash_residents_query = mysqli_query($conn, $dash_residents_sql); 
                                                if($residents_total = mysqli_num_rows($dash_residents_query)) {
                                                    echo '<p class="#"> '.$residents_total.' </p>';
                                                }
                                                else {
                                                    echo '<p class="#"> No Data </p>';
                                                }
                                            ?>
                                        </h3>
                                        <h4 class="info-card"> Total Number of Male </h4>
                                    </div>
                                </div> 
                            </div>

                            <!-- <div class="TotalResidents">
                                <div class="center">
                                    <div class="left-per-card">
                                        <img class="img-cards" src="Pictures/Accounts2.png">
                                    </div>
                                    <div class="right-per-card">
                                        <h3 class="info-card"> 1 </h3>
                                        <h4 class="info-card"> Total Number of Residents </h4>
                                    </div>
                                </div> 
                            </div>

                            <div class="TotalResidents">
                                <div class="center">
                                    <div class="left-per-card">
                                        <img class="img-cards" src="Pictures/Accounts2.png">
                                    </div>
                                    <div class="right-per-card">
                                        <h3 class="info-card"> 1 </h3>
                                        <h4 class="info-card"> Total Number of Residents </h4>
                                    </div>
                                </div> 
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/DashBoard.js"></script>
    <script src="JS/checkSessionStatus.js"></script>
</body>
</html>