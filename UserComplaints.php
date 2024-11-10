<?php 
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: LoginPage.php");
        exit();
    }
    } else {
    header("Location: LoginPage.php");
    exit();
    }

$admin_unique_id = ''; // Default value if no admin found
$admin_sql = mysqli_query($conn, "SELECT unique_id FROM tblaccounts WHERE role = 'admin' LIMIT 1");
if ($admin_sql && mysqli_num_rows($admin_sql) > 0) {
    $admin_row = mysqli_fetch_assoc($admin_sql);
    $admin_unique_id = $admin_row['unique_id'];
}
$encoded_id = urlencode($admin_unique_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/UserComplaints.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 Phase 5 </h2>
                </div>
                <a href="UserDashBoard.php" class="sideside baractive">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="UserDocuments.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Documents2.png">
                    <span> Documents </span>
                </a>
                <div class="complaintsContainer">
                    <a href="UserComplaints.php" class="sideside" id="complaintsDropdown">
                        <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                        <span> Complaints </span>
                        <button class="buttonEme2">
                            <div class="eme2"></div>
                        </button> 
                    </a>  
                    <ul class="subMenuComp" id="complaintsSubMenu">
                        <li> 
                            <a href="UserChat.php?user_id=<?php echo $encoded_id?>">
                                <img class="img-subMenu" src="Pictures/Chat.png">
                                <label class="sub-spa"> Chat </label>
                            </a> 
                        </li>
                    </ul>
                </div>
                <a href="UserAnnouncement.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
                </a>
                <a href="UserVoting.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/voting.png">
                    <span> Voting </span>
                </a>
                <a href="Logout.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/logout.png">
                    <span> Logout </span>
                </a>
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
                            <h2 class="namePerModule"> Complaints </h2>
                        </div>
                    </div>
                    <div class="ProfileViewww">
                        <button id="myProfileBtn" type="button" class="profileBtn">
                            <label> Profile </label>
                        </button>
                        <div class="user-img"></div>
                    </div>
                </div>
                <form method="POST" enctype="multipart/form-data"></form>
                    <div class="MainContainerForTables">
                        <div class="MainContainerAll">
                            <div class="ComplainUser">
                                <label style="font-size: medium; font-weight: bold;">Complainee Name:</label>
                                <input class="inputUserComps" type="text" id="Complainee">
                                <label class="Label2">Address:</label>
                                <input class="inputUserComps2" type="text" id="ComplaineeAddress">
                                <input class="inputUserComps2" type="hidden" id="ComplainantUID" value="<?php echo $_SESSION['unique_id']?>">
                                <input class="inputUserComps2" type="hidden" id="ComplainantName"   value="<?php echo $_SESSION['first_name'] . ' ' . (!empty($_SESSION['middle_name']) ? $_SESSION['middle_name'] . ' ' : '') . $_SESSION['last_name']; ?>">
                                <input class="inputUserComps2" type="hidden" id="ComplainantAddress"   value="<?php echo 'Blk' . ' ' . $_SESSION['block'] . ' ' . 'Lot' . ' ' . $_SESSION['lot']; ?>">
                            </div>
                            <div class="ComplainUser2">
                                <label style="font-size: medium; font-weight: bold;">Nature Of Complaint:</label>
                                <div class="dropdownInput">
                                    <input type="text" id="selectedComplaint" class="dropdownInputField" placeholder="Select Complaint" readonly>
                                    <button class="dropbtnInput">
                                        <span class="arrowDown">&#9660;</span> <!-- Downward arrow -->
                                    </button>
                                    <div class="dropdownContentInput">
                                        <div onclick="selectComplaint('Noise Complaint')"> Noise Complaint </div>
                                        <div onclick="selectComplaint('Parking Problems ')"> Parking Problems </div>
                                        <div onclick="selectComplaint('Pet Issues')"> Pet Issues </div>
                                        <div onclick="selectComplaint('Property Maintenance')"> Property Maintenance </div>
                                        <div onclick="selectComplaint('Rule Violation')"> Rule Violation </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="DescriUser">
                                <label style="font-size: medium; font-weight: bold;"> Description: </label>
                                <textarea class="DescriptUsers" id="Description"></textarea>
                            </div>
                            <div class="ComplainUser3">
                                <label style="font-size: medium; font-weight: bold;"> Proof:</label>
                                <input class="inputFile" type="file" id="Proof" accept=".jpg, .jpeg, .png, .pdf">
                            </div>
                            <footer class="footerUserSubmitt">
                                <button class="submittUserComp" id="Submit"> Submit </button>
                            </footer>                      
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="JS/UserComplaints.js"></script>
</body>
</html>