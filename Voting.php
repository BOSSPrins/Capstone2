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
    <link rel="stylesheet" href="CSS/Voting.css">
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
                <a href="DashBoard.php" class="sideside baractive">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="HoaOfficials.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Officials.png">
                    <span> HOA Officials </span>
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
                    <a href="#" class="sideside" id="complaintsDropdown">
                        <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                        <span> Complaints </span>
                        <button class="buttonEme2">
                            <div class="eme2"></div>
                        </button> 
                    </a>  
                    <ul class="subMenuComp" id="complaintsSubMenu">
                        <li> 
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
                <a href="Payments.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="Voting.php" class="sideside">
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
                    <div class="NavBarSaLoob">
                        <div class="VotingNavv">
                            <a href="#" onclick="toggleContent('Payments')"> Candidates Table </a>
                            <a href="#" onclick="toggleContent('History')"> Add Candidates </a>
                            <a href="#" onclick="toggleContent('Hindi ko pa alam')"> History </a> <!-- Babaguhin pa to hindi ko pa alam kung anong tawag sa mga editan ng kung ano-ano -->
                        </div>
                        <div class="ContainerOfEachhh">
                            <div id="Payments" class="EachContentsMonth">
                                <!-- Page 1 content -->
                                <div id="page1" class="page-content">
                                    <div class="btnAndTimer">
                                        <div class="timerVote">
                                            <h2> Timer: </h2>
                                            <span class="spanNumberTime" id="hours">00</span>
                                            <span class="colon">:</span>
                                            <span class="spanNumberTime" id="minutes">00</span>
                                            <span class="colon">:</span>
                                            <span class="spanNumberTime" id="seconds">00</span>
                                                                                 
                                            <div class="dropDownforSetTimer">
                                                <button onclick="toggleSetTimer()" class="dropSetTimer"> 
                                                    <div class="emeSet"></div>
                                                </button>
                                                <div id="SetTimerDropDownn" class="timerContent">
                                                    <div class="timer"> 
                                                        <div class="timer-controls">
                                                            <!-- <h2 for="input-hours">Hours:</h2>
                                                            <input type="number" id="input-hours" min="0" step="1">
                        
                                                            <h2 for="input-minutes">Minutes:</h2>
                                                            <input type="number" id="input-minutes" min="0" step="1">
                        
                                                            <h2 for="input-seconds">Seconds:</h2>
                                                            <input type="number" id="input-seconds" min="0" step="1"> -->

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
                                        <div class="ButtonGen">
                                            <button class="BtnGeneratee">Generate</button>
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
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="candidates">
                                                            <div class="PictureCan1"> </div>
                                                            <div class="NameAndPosition">
                                                                <input class="inputCan" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <footer class="footerSummary">
                                                        ,jhfbljdfbjlfd
                                                    </footer>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="TableContainerRank">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;"> Rank </th>
                                                        <th> Name </th>
                                                        <th style="width: 15%;"> Total Votes </th>
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
                        
                                <!-- Page 2 content -->
                                <div id="page2" class="page-content" style="display: none;">
                                    <div class="btnAndTimerTwo">
                                        <div class="timerVoteTwo">
                                            <h2> Timer: </h2>
                                            <span class="spanNumberTimeTwo" id="hours">00:</span>
                                            <span class="spanNumberTimeTwo" id="minutes">00:</span> 
                                            <span class="spanNumberTimeTwo" id="seconds">00</span>
                                            <div class="dropDownforSetTimer">
                                                <button onclick="toggleSetTimerTwo()" class="dropSetTimerTwo"> 
                                                    <div class="emeSetTwo"></div>
                                                </button>
                                                <div id="SetTimerDropDownnTwo" class="timerContentTwo">
                                                    <div class="timerTwo">
                                                        <div class="timer-controlsTwo">
                                                            <h2 for="input-hoursTwo">Hours:</h2>
                                                            <input type="number" id="input-hoursTwo" min="0" step="1">
    
                                                            <h2 for="input-minutesTwo">Minutes:</h2>
                                                            <input type="number" id="input-minutesTwo" min="0" step="1">
    
                                                            <h2 for="input-secondsTwo">Seconds:</h2>
                                                            <input type="number" id="input-secondsTwo" min="0" step="1">
    
                                                            <div class="btnsForTimerTwo">
                                                                <button id="startTwo">Start</button>
                                                                <button id="stopTwo">Stop</button>
                                                                <button id="resetTwo">Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                        
                                        </div>                                    
                                        <div class="ButtonGenTwo">
                                            <button class="BtnGenerateeTwo">Generate</button>
                                        </div>
                                        
                                        <div class="SummaryViewModalTwo" id="summaryModalTwo">
                                            <div class="summary-ModalTwo">
                                                <div class="SubSummaryTwo">
                                                    <header class="headerForSummaryTwo">
                                                        <h2> SUMMARY </h2>
                                                        <span class="closeSummaryTwo">&times;</span>
                                                    </header>
                                                    <div class="LamanLoobSummaryTwo">
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> PPRESIDENT </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> VICE PRESIDENT </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> SECRETARY </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> TREASURER </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> AUDITOR </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> PEACE IN ORDER </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> DIRECTOR </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> DIRECTOR </label>
                                                            </div>
                                                        </div>
    
                                                        <div class="candidatesTwo">
                                                            <div class="PictureCan1Two"> </div>
                                                            <div class="NameAndPositionTwo">
                                                                <input class="inputCanTwo" type="text">
                                                                <label> DIRECTOR </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <footer class="footerSummaryTwo">
                                                        ,jhfbljdfbjlfd
                                                    </footer>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="TableContainerRankTwo">
                                            <table class="tableFinalOfficialVoted">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;"> Rank </th>
                                                        <th> Name </th>
                                                        <th style="width: 15%;"> Total Votes </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
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
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination controls -->
                                <footer>
                                    <div class="pagination">
                                        <button id="page1Btn" onclick="togglePage('page1')" class="page-btn Paginationnactive">Page 1</button>
                                        <button id="page2Btn" onclick="togglePage('page2')" class="page-btn">Page 2</button>
                                    </div>                                    
                                </footer>
                            </div>
                        
                            <!-- Modal ng add candidate -->
                            <div id="History" class="EachContentsMonth">
                                <header class="AddingDivsForCandidates">
                                    <button type="button" class="addingDivsBtn"> Add </button>
                                </header>
                                    <form class="bowting" id="candidateForm"  method="POST" enctype="multipart/form-data">
                                        <div class="addingcanditatesDivCon" id="addingCandidatesContainer" name="addingCandidatesContainer">
                                            <div class="SubAddingCandiCon">
                                                <div class="addingCandidatesLoob">
                                                    <header class="headerNgAdding">
                                                        <h2> Add New Candidate </h2>
                                                        <span class="CloseAdding">&times;</span>
                                                    </header>
                                                    <div class="AddingNewCandidateLoob">
                                                        <div class="NameOfCandidateNew">
                                                            <h2> Name: </h2>
                                                            <input class="NameNewCandi" type="text" placeholder="Enter full name" id="candi_Name" name="candi_Name" oninput="fetchResidentID()">
                                                            <div id="suggestions"></div>
                                                        </div>
                                                        <div class="FileUploadPicNewCandi">
                                                            <div class="file-upload">
                                                                <label for="fileInput" class="file-upload-label">
                                                                    <div class="file-upload-icon">+</div>
                                                                    <div class="file-upload-text">Upload Image</div>
                                                                </label>
                                                                <input type="file" id="fileInput" class="file-upload-input" id="candi_IMG" name="candi_IMG">
                                                            </div>
                                                            <img id="previewImage" src="#" alt="Image Preview" style="display: none; max-width: 100%; max-height: 200px;">
                                                        </div>
                                                        
                                                        <div class="NameOfCandidateNew">
                                                            <input class="NameNewCandi" type="hidden" id="candi_ID" name="candi_ID"> 
                                                        </div>
                                                    </div>
                                                    <footer class="AddingNewCandi">
                                                        <div class="iror" id="iror"></div>
                                                        <div class="sakses" id="sakses"></div>
                                                        <button type="button addCandi" onclick="submitForm(event)"> Add </button>                                                        
                                                    </footer>
                                                </div>
                                            </div>
                                        </div> 
                                    </form>
                                <div class="containerDivss">
                                    <!-- <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name">
                                        <div class="buttonsNgCandidates">
                                            <div class="btCandii">
                                                <button class="buttonSivv UploadPics">Upload Picture</button>
                                                <input class="inputFileCert inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btCandiiTwo">
                                                <button class="buttonSivv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer2">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name">
                                        <div class="buttonsNgCandidates">
                                            <div class="btCandii">
                                                <button class="buttonSivv UploadPics2">Upload Picture</button>
                                                <input class="inputFileCert2 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="buttonSivv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer3">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name">
                                        <div class="buttonsNgOffi">
                                            <div class="btnOne">
                                                <button class="butonSiv UploadPics3">Upload Picture</button>
                                                <input class="inputFileCert3 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="butonSiv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer4">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name"  >
                                        <div class="buttonsNgOffi">
                                            <div class="btnOne">
                                                <button class="butonSiv UploadPics4">Upload Picture</button>
                                                <input class="inputFileCert4 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="butonSiv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer5">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name">
                                        <div class="buttonsNgOffi">
                                            <div class="btnOne">
                                                <button class="butonSiv UploadPics5">Upload Picture</button>
                                                <input class="inputFileCert5 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="butonSiv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer6">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name">
                                        <div class="buttonsNgOffi">
                                            <div class="btnOne">
                                                <button class="butonSiv UploadPics6">Upload Picture</button>
                                                <input class="inputFileCert6 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="butonSiv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer7">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name">
                                        <div class="buttonsNgOffi">
                                            <div class="btnOne">
                                                <button class="butonSiv UploadPics7">Upload Picture</button>
                                                <input class="inputFileCert7 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="butonSiv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer8">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name"value="tangaka">
                                        <div class="buttonsNgOffi">
                                            <div class="btnOne">
                                                <button class="butonSiv UploadPics8">Upload Picture</button>
                                                <input class="inputFileCert8 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="butonSiv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="CandidatesCon">
                                        <div class="CandiImageContainer" id="CandiImageContainer9">
                                            
                                        </div>
                                        <input class="NameCandiInput" type="text" placeholder="Enter Candidate Name">
                                        <div class="buttonsNgOffi">
                                            <div class="btnOne">
                                                <button class="butonSiv UploadPics9">Upload Picture</button>
                                                <input class="inputFileCert9 inputts" type="file" id="PresPic" style="display: none;">
                                            </div>
                                            <div class="btnTwo">
                                                <button class="butonSiv SaveBtn">Save</button>
                                            </div>
                                        </div>
                                    </div> -->
                                </div> 
                            </div>

                             
                            <div id="Hindi ko pa alam" class="EachContentsMonth">
                                <h2> HAHAHAHAHA </h2>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>

    <script src="JS/Voting.js"></script>
</body>
</html>
