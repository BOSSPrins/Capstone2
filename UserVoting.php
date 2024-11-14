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
                    <div class="MainContainerAllOne" id="FirstVotingContainer">
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
                            <!-- <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate1" id="Candidate1">
                                <label for="Candidate1">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Mabuhay_Logo.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>
                        
                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate2" id="Candidate2">
                                <label for="Candidate2">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>
                        
                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate3" id="Candidate3">
                                <label for="Candidate3">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate4" id="Candidate4">
                                <label for="Candidate4">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate5" id="Candidate5">
                                <label for="Candidate5">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate6" id="Candidate6">
                                <label for="Candidate6">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate7" id="Candidate7">
                                <label for="Candidate7">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate8" id="Candidate8">
                                <label for="Candidate8">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate9" id="Candidate9">
                                <label for="Candidate9">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate10" id="Candidate10">
                                <label for="Candidate10">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate11" id="Candidate11">
                                <label for="Candidate11">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate12" id="Candidate12">
                                <label for="Candidate12">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate13" id="Candidate13">
                                <label for="Candidate13">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate14" id="Candidate14">
                                <label for="Candidate14">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div>

                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate15" id="Candidate15">
                                <label for="Candidate15">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/Female2.png">
                                    </div>
                                    <div class="title">
                                        <span> Enter Candidate Name </span>
                                    </div>
                                </label>
                            </div> -->
                        </div>
                        <footer class="footerCandidatesSubmit">
                            <input type="hidden" id="sessionUniqueId" value="<?php echo $_SESSION['unique_id']; ?>">
                            <input type="hidden" id="WinnerUniqueId" value="<?php echo $_SESSION['unique_id']; ?>">                           
                            <button class="buttonSubmitBoto" type="submit" disabled> Submit </button>
                        </footer>
                    </div>

                    <!-- Aalisin na tong pangalawang botohan -->
                    <div class="MainContainerAll" id="SecondVotingContainer">
                        <div class="containerDivssPangalawa">
                        <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage1" name="CandiImage1">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName1" name="CandiName1">
                                <input class="text" type="text" id="CandiPos1" name="CandiPos1" hidden>
                                <input class="text" type="text" id="UID1" name="UID1" hidden>                                
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos1" name="DisplayPos1" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="Emeposs emeDropPos"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div1" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div1" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div1" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div1" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div1" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div1" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div1" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div1" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div1" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage2" name="CandiImage2">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName2" name="CandiName2">
                                <input class="text" type="text" id="CandiPos2" name="CandiPos2" hidden>
                                <input class="text" type="text" id="UID2" name="UID2" hidden>
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos2" name="DisplayPos2" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos2()">
                                        <div class="Emeposs emeDropPos2"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown2">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div2" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div2" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div2" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div2" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div2" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div2" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div2" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div2" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div2" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage3" name="CandiImage3">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName3" name="CandiName3">
                                <input class="text" type="text" id="CandiPos3" name="CandiPos3" hidden>
                                <input class="text" type="text" id="UID3" name="UID3" hidden>
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos3" name="DisplayPos3" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos3()">
                                        <div class="Emeposs emeDropPos3"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown3">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div3" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div3" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div3" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div3" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div3" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div3" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div3" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div3" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div3" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage4" name="CandiImage4">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName4" name="CandiName4">
                                <input class="text" type="text" id="CandiPos4" name="CandiPos4" hidden>
                                <input class="text" type="text" id="UID4" name="UID4" hidden> 
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos4" name="DisplayPos4" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos4()">
                                        <div class="Emeposs emeDropPos4"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown4">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div4" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div4" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div4" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div4" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div4" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div4" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div4" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div4" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div4" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage5" name="CandiImage5">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName5" name="CandiName5">
                                <input class="text" type="text" id="CandiPos5" name="CandiPos5" hidden>
                                <input class="text" type="text" id="UID5" name="UID5" hidden> 
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos5" name="DisplayPos5" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos5()">
                                        <div class="Emeposs emeDropPos5"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown5">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div5" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div5" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div5" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div5" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div5" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div5" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div5" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div5" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div5" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage6" name="CandiImage6">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName6" name="CandiName6">
                                <input class="text" type="text" id="CandiPos6" name="CandiPos6" hidden>
                                <input class="text" type="text" id="UID6" name="UID6" hidden> 
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos6" name="DisplayPos6" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos6()">
                                        <div class="Emeposs emeDropPos6"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown6">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div6" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div6" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div6" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div6" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div6" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div6" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div6" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div6" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div6" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage7" name="CandiImage7">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName7" name="CandiName7">
                                <input class="text" type="text" id="CandiPos7" name="CandiPos7" hidden>
                                <input class="text" type="text" id="UID7" name="UID7" hidden> 
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos7" name="DisplayPos7" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos7()">
                                        <div class="Emeposs emeDropPos7"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown7">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div7" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div7" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div7" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div7" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div7" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div7" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div7" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div7" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div7" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage8" name="CandiImage8">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName8" name="CandiName8">
                                <input class="text" type="text" id="CandiPos8" name="CandiPos8" hidden>
                                <input class="text" type="text" id="UID8" name="UID8" hidden> 
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos8" name="DisplayPos8" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos8()">
                                        <div class="Emeposs emeDropPos8"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown8">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div8" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div8" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div8" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div8" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div8" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div8" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div8" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div8" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div8" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImage9" name="CandiImage9">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text" id="CandiName9" name="CandiName9">
                                <input class="text" type="text" id="CandiPos9" name="CandiPos9" hidden>
                                <input class="text" type="text" id="UID9" name="UID9" hidden>                           
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input" id="DisplayPos9" name="DisplayPos9" readonly>
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos9()">
                                        <div class="Emeposs emeDropPos9"> </div>
                                    </button>
                                    <div class="Optioo OptionDropDown9">
                                        <!-- Dropdown options using labels -->
                                        <label><input type="radio" name="div9" value="President" data-display="President"> President </label>
                                        <label><input type="radio" name="div9" value="VicePresident" data-display="Vice President"> Vice President </label>
                                        <label><input type="radio" name="div9" value="Secretary" data-display="Secretary"> Secretary </label>
                                        <label><input type="radio" name="div9" value="Treasurer" data-display="Treasurer"> Treasurer </label>
                                        <label><input type="radio" name="div9" value="Auditor" data-display="Auditor"> Auditor </label>
                                        <label><input type="radio" name="div9" value="PeaceInOrder" data-display="Peace In Order"> Peace In Order </label>
                                        <label><input type="radio" name="div9" value="Director1" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div9" value="Director2" data-display="Director"> Director </label>
                                        <label><input type="radio" name="div9" value="Director3" data-display="Director"> Director </label>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <footer class="footerCandidatesSubmit2">
                            <button class="buttonSubmitBoto2" type="submit" disabled> Submit </button>
                            <input type="text" id="newCandiPositions" value="<?php echo $user_UID ?>" hidden>
                        </footer>
                    </div>
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

                <!-- Eto ding modal -->
                <div class="SummaryViewModalTwo" id="summaryModalTwo">
                    <div class="summary-ModalTwo">
                        <div class="SubSummaryTwo">
                            <header class="headerForSummaryTwo">
                                <h2> SUMMARY </h2>
                                <span class="closeSummaryTwo">&times;</span>
                            </header>
                            <form method="post">
                            <div class="LamanLoobSummaryTwo">
                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="PresImg"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="PresName">
                                        <input class="inputCanTwo" type="text" id="PresUID" hidden>
                                        <input class="inputCanTwo" type="text" id="PresValue" value="President" hidden>
                                        <label> PRESIDENT </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="VpresImg"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="VpresName">
                                        <input class="inputCanTwo" type="text" id="VpresUID" hidden>
                                        <input class="inputCanTwo" type="text" id="VpresValue" value="VicePresident" hidden>
                                        <label> VICE PRESIDENT </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="SecImg"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="SecName">
                                        <input class="inputCanTwo" type="text" id="SecUID" hidden>
                                        <input class="inputCanTwo" type="text" id="SecValue" value="Secretary" hidden>
                                        <label> SECRETARY </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="TreaImg"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="TreaName">
                                        <input class="inputCanTwo" type="text" id="TreaUID" hidden>
                                        <input class="inputCanTwo" type="text" id="TreaValue" value="Treasurer" hidden>
                                        <label> TREASURER </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="AudImg"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="AudName">
                                        <input class="inputCanTwo" type="text" id="AudUID" hidden>
                                        <input class="inputCanTwo" type="text" id="AudValue" value="Auditor" hidden>
                                        <label> AUDITOR </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="PioImg"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="PioName">
                                        <input class="inputCanTwo" type="text" id="PioUID" hidden>
                                        <input class="inputCanTwo" type="text" id="PioValue" value="PeaceInOrder" hidden>
                                        <label> PEACE IN ORDER </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="Dir1Img"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="Dir1Name">
                                        <input class="inputCanTwo" type="text" id="Dir1UID" hidden>
                                        <input class="inputCanTwo" type="text" id="Dir1Value" value="Director1" hidden>
                                        <label> DIRECTOR </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="Dir2Img"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="Dir2Name">
                                        <input class="inputCanTwo" type="text" id="Dir2UID" hidden>
                                        <input class="inputCanTwo" type="text" id="Dir2Value" value="Director2" hidden>
                                        <label> DIRECTOR </label>
                                    </div>
                                </div>

                                <div class="candidatesTwo">
                                    <div class="PictureCan1Two" id="Dir3Img"> </div>
                                    <div class="NameAndPositionTwo">
                                        <input class="inputCanTwo" type="text" id="Dir3Name">
                                        <input class="inputCanTwo" type="text" id="Dir3UID" hidden>
                                        <input class="inputCanTwo" type="text" id="Dir3Value" value="Director3" hidden>
                                        <label> DIRECTOR </label>
                                    </div>
                                </div>
                            </div>
                            <footer class="footerSummaryTwo">
                                <input type="hidden" id="timestamp2" name="timestamp2">
                                <input type="text" id="WinnerUID" value="<?php echo $user_UID ?>" hidden>
                                <button class="AcceptBtn" id="submitPositionBTN"> Accept </button>                              
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
                         <!-- Eto yung lagayan ng mga nanalo -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/UserVoting.js"></script>
</body>
</html>