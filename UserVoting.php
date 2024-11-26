<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'barangay') {
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

$user_UID = $_SESSION['unique_id'];


// //Check if unique_id is set in the session
// if (isset($_SESSION['unique_id'])) {
//     echo "Unique ID in session: " . $_SESSION['unique_id'] . "\n";
// } else {
//     echo "No unique_id found in session\n";
// }
// // Output all session data for debugging purposes
// echo "Full session data:\n";
// print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/UserVoting.css">
    <script src="jQuery/jquery.min.js"></script>
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 <br> Phase 5 </h2>
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
                            <a href="UserChat.php">
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
                            <h2 class="namePerModule"> Voting </h2>
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
                    <div class="TablessContainer" id="FirstVotingContainer">
                        <header class="CountsVote">
                        <div class="headerCan">
                                <h1> Candidates </h1>
                            </div>
                            <div class="bilangNgBinoto">
                                <h1> Vote: </h1>
                                <input type="text" class="text" value="0" readonly>
                            </div>
                        </header>
                        <div class="User_containerDivss">
                            
                        </div>
                        <footer class="footerCandidatesSubmit">
                            <input type="hidden" id="sessionUniqueId" value="<?php echo $_SESSION['unique_id']; ?>">
                            <input type="hidden" id="WinnerUniqueId" value="<?php echo $_SESSION['unique_id']; ?>">                           
                            <button class="buttonSubmitBoto" type="submit" disabled> Submit </button>
                        </footer>
                    </div>


                    <div class="UsersSummaryModal" id="UsersSummaryModal">
                        <div class="UsersSummaryModalBaba">
                            <form method="POST">
                                <div class="UsersSubSummary">
                                    <header class="UsersHeaderForSummary">
                                        <h2> SUMMARY </h2>
                                        <span class="UsersCloseSummary">&times;</span>
                                    </header>                           
                                    <div class="UsersLamanLoobSummary">
                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi1_img" name="candi1_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi1_name" name="candi1_name">
                                                <input class="UsersInputCan" type="hidden" id="candi1_ID" name="candi1_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi2_img" name="candi2_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi2_name" name="candi2_name">
                                                <input class="UsersInputCan" type="hidden" id="candi2_ID" name="candi2_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi3_img" name="candi3_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi3_name" name="candi3_name">
                                                <input class="UsersInputCan" type="hidden" id="candi3_ID" name="candi3_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi4_img" name="candi4_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi4_name" name="candi4_name">
                                                <input class="UsersInputCan" type="hidden" id="candi4_ID" name="candi4_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi5_img" name="candi5_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi5_name" name="candi5_name">
                                                <input class="UsersInputCan" type="hidden" id="candi5_ID" name="candi5_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi6_img" name="candi6_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi6_name" name="candi6_name">
                                                <input class="UsersInputCan" type="hidden" id="candi6_ID" name="candi6_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi7_img" name="candi7_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi7_name" name="candi7_name">
                                                <input class="UsersInputCan" type="hidden" id="candi7_ID" name="candi7_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi8_img" name="candi8_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi8_name" name="candi8_name">
                                                <input class="UsersInputCan" type="hidden" id="candi8_ID" name="candi8_ID">
                                            </div>
                                        </div>

                                        <div class="UsersCandidates">
                                            <div class="UsersPictureCan1" id="candi9_img" name="candi9_img">
                                                <!-- Image here -->
                                            </div>
                                            <div class="UsersNameAndPosition">
                                                <input class="UsersInputCan" type="text" id="candi9_name" name="candi9_name">
                                                <input class="UsersInputCan" type="hidden" id="candi9_ID" name="candi9_ID">
                                            </div>
                                        </div>
                                    </div>                                                     
                                    <footer class="UsersFooterSummary">
                                        <input type="hidden" name="user_ID" id="user_ID" value="<?php echo $user_UID ?>">
                                        <input type="hidden" name="underVote" id="underVote">
                                        <div class="timestamp" id="timestamp1" hidden></div>
                                        <button type="submit" class="btnSubmitNaSaAdmin" id="submitVoteButton" name="submitVoteButton"> Submit </button>
                                    </footer>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="SuccessfulVoteUser">
                        <div class="SubSucessLaman">
                            <div class="SuccessContainer">
                                <h1> Successful </h1>
                                <h1> Vote </h1>
                                <img class="FingerPrint" src="Pictures/Picsart_24-07-24_15-10-12-879.png">
                                <h2> Reference No. </h2>
                                <input class="refNumber" type="text" value="<?php echo $user_UID ?>">
                                <button class="OkInSuccess OkieNa"> Ok </button>
                            </div>
                        </div>
                    </div>
                    <div class="SuccessfulUnderVote">
                        <div class="SubSucessLaman">
                            <div class="SuccessContainer">
                                <h1> Voted Successfully </h1>
                                <h1> and mark as Under Vote </h1>                           
                                <img class="FingerPrint" src="Pictures/Picsart_24-07-24_15-10-12-879.png">
                                <h2> Reference No. </h2>
                                <input class="refNumber" type="text" value="<?php echo $user_UID ?>">
                                <button class="OkInSuccess OkieNaPo"> Ok </button>
                            </div>
                        </div>
                    </div>
                    <div class="Overlay" id="Overlay">
                        <div class="overlay-content">
                           <div class="TanginangOverlay">
                                <!-- Eto yung picture at pangalan ng nanalo -->
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/UserVoting.js"></script>
    <script src="JS/checkSessionStatus.js"></script>

</body>
</html>