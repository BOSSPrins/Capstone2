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
    <link rel="stylesheet" href="CSS/Voting.css">
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
                <div class="VotingNavv">
                    <a href="#" onclick="toggleContent('CandidateTable')"> Candidates Table </a>
                    <a href="#" onclick="toggleContent('History')"> History </a>
                </div>
                <div class="MainContainerForTables">
                    <div id="CandidateTable" class="EachContentsMonth">
                        <div class="page-content contentPage">
                            <header class="TableHeaderr">
                                <div class="TimerVoteAndButton">
                                    <!-- <div class="ButtonGen">
                                        <button class="BtnGeneratee">Generate</button>
                                    </div> -->

                                    <div class="LagayanNgOras">
                                        <div class="InputTimee">
                                            <div class="DikonaAlamOne">
                                                <input type="hidden" id="timestamp" name="timestamp">
                                                <h2 class="h2Timer"> Timer: </h2>
                                            </div>

                                            <div class="DikonaAlamTwo">
                                                <span class="spanNumberTime" id="hours">00</span>
                                                <span class="colon">:</span>
                                                <span class="spanNumberTime" id="minutes">00</span> 
                                                <span class="colon">:</span>
                                                <span class="spanNumberTime" id="seconds">00</span>
                                            </div>
                                        </div>

                                        <div class="dropDownforSetTimer">
                                            <button onclick="toggleSetTimer()" class="dropSetTimer"> 
                                                <div class="emeSet"></div>
                                            </button>
                                            <div id="SetTimerDropDownn" class="timerContent">
                                                <div class="timer">
                                                    <div class="timer-controls">
                                                        <h2>Select date:</h2>
                                                        <input class="dateTime" type="datetime-local" id="input-datetime" placeholder="Select a date and time">

                                                        <div class="btnsForTimer">
                                                            <button id="start">Start</button>
                                                            <button id="stop">Stop</button>
                                                            <button id="reset">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </header>

                            <div class="autocomplete-wrapper">
                                <div class="autocomplete-container">
                                    <input type="text" id="suggestionInput" name="suggestionInput" placeholder="Search...">
                                    <div id="suggestionContainer" class="suggestion-container">
                                        <table>
                                            <tbody id="suggestionTableBody">
                                                <!-- Suggestions will be dynamically inserted here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="ViewingResidentsModal">
                                <div class="ViewingResContent">
                                        <!-- Name -->
                                        <!-- Age -->
                                        <!-- Gender -->
                                        <!-- Picture -->
                                </div>
                            </div>

                            <div class="SummaryViewModal" id="summaryModal">
                                <div class="summary-Modal">
                                    <div class="SubSummary">
                                        <header class="headerForSummary">
                                            <h2> SUMMARY </h2>
                                            <span class="closeSummary">&times;</span>
                                        </header>
                                        <div class="LamanLoobSummary">
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG1"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName1">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG2"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName2">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG3"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName3">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG4"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName4">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG5"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName5">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG6"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName6">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG7"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName7">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG8"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName8">
                                                </div>
                                            </div>
                                            <div class="candidates">
                                                <div class="PictureCan1" id="CandidateIMG9"> </div>
                                                <div class="NameAndPosition">
                                                    <input class="inputCan" type="text" id="CandidateName9">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="TableContainerRank">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;"> Rank </th>
                                            <th style="width: 10%;"> Picture </th>
                                            <th> Name </th>
                                            <th style="width: 10%;"> Total Votes </th>
                                            <th style="width:5%;"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <td> 1 </td>
                                            <td> Prince </td>
                                            <td> 1000 </td>
                                        </tr>
                                        <tr>
                                            <td> 2 </td>
                                            <td> Ruella </td>
                                            <td> 900 </td>
                                        </tr>
                                        <tr>
                                            <td> 3 </td>
                                            <td> Jefferson </td>
                                            <td> 899 </td>
                                        </tr> -->
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>

                    <div id="History" class="EachContentsMonth">
                        <div class="TableForHistory">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Won Date</th>
                                        <th>Description</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="winnersTableBody">
                                    <tr>
                                        <td id="recentWonDate">Loading...</td>
                                        <td>Recent Winners</td>
                                        <td><button onclick="showHistoryModal()">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal for displaying recent winners -->
                    <div class="winnersModals" id="winnersModal" class="modal" style="display: none;">
                        <div class="modal-content">
                            <span class="close" onclick="closeWinnersModal()">&times;</span>
                            <h2>Recent Winners</h2>
                            <ul id="winnersList"></ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="JS/Voting.js"></script>
</body>
</html>
