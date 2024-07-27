<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> User Vote </title>
  <link rel="stylesheet" href="CSS/UserVoting.css">
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Dasma_City_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 Phase 5 </h2>
                </div>
                <a href="DashBoard.php" class="sideside baractive">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="Announcement.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
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
                            <a href="Chat.php">
                                <img class="img-subMenu" src="Pictures/Chat.png">
                                <label class="sub-spa"> Chat </label>
                            </a> 
                        </li>
                    </ul>
                </div>
                <a href="MonthlyDue.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="USER_VOTING.HTML" class="sideside">
                    <img class="img-sideboard" src="Pictures/voting.png">
                    <span> Voting </span>
                </a>
                <a href="#" class="sideside">
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
                    <div class="MainContainerAllOne">
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
                            <div class="User_CandidatesCon form-element">
                                <input class="checkboxx" type="checkbox" name="platform" value="Candidate1" id="Candidate1">
                                <label for="Candidate1">
                                    <div class="User_CandiImageContainer">
                                        <img src="Pictures/malit.jpg">
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
                            </div>
                        </div>
                        <footer class="footerCandidatesSubmit">
                            <button class="buttonSubmitBoto" type="submit"> Submit </button>
                        </footer>
                    </div>

                    <div class="MainContainerAll">
                        <div class="containerDivssPangalawa">
                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> President </label>
                                      <label><input type="radio" name="option" value="option2"> Vice President </label>
                                      <label><input type="radio" name="option" value="option3"> Secretary </label>
                                      <label><input type="radio" name="option" value="option3"> Treasurer </label>
                                      <label><input type="radio" name="option" value="option3"> Auditor </label>
                                      <label><input type="radio" name="option" value="option3"> Peace In Order </label>
                                      <label><input type="radio" name="option" value="option3"> Director </label>
                                      <label><input type="radio" name="option" value="option3"> Director </label>
                                      <label><input type="radio" name="option" value="option3"> Director </label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input class="DropdownRadio" type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input class="DropdownRadio" type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input class="DropdownRadio" type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>

                            <div class="CandidatesConPangalawa">
                                <div class="CandiImageContainerPangalawa" id="CandiImageContainerPangalawa">
                                    <!-- Image will be displayed here -->
                                </div>
                                <input class="text" type="text">
                                <div class="inputAndDropdownContainer">
                                    <input type="text" placeholder="Select an option" class="dropdown-input">
                                    <button class="btnPosDrop" onclick="toggleDropOpsPos()">
                                        <div class="emeDropPos"> </div>
                                    </button>
                                    <div class="OptionDropDown">
                                      <!-- Dropdown options using labels -->
                                      <label><input type="radio" name="option" value="option1"> Option 1</label>
                                      <label><input type="radio" name="option" value="option2"> Option 2</label>
                                      <label><input type="radio" name="option" value="option3"> Option 3</label>
                                    </div>
                                </div>
                                <!-- <div class="buttonsNgOffiPangal">
                                    <div class="btnOnee">
                                        <button class="btnSiv Larawan"> Upload Picture </button>
                                        <input class="inputFileCandi Lagayann" type="file" id="PresPic" style="display: none;">
                                    </div>
                                    <div class="btnTwoo">
                                        <button class="btnSiv SaveBtn2">Save</button>
                                    </div>
                                </div> -->
                            </div>
                        </div> 
                        <footer class="footerCandidatesSubmit2">
                            <button class="buttonSubmitBoto2" type="submit"> Submit </button>
                        </footer>
                    </div>
                </div>
                <div class="UsersSummaryModal" id="UsersSummaryModal">
                    <div class="UsersSummaryModalBaba">
                        <div class="UsersSubSummary">
                            <header class="UsersHeaderForSummary">
                                <h2> SUMMARY </h2>
                                <span class="UsersCloseSummary">&times;</span>
                            </header>
                            <div class="UsersLamanLoobSummary">
                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <img src="Pictures/malit.jpg">
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>

                                <div class="UsersCandidates">
                                    <div class="UsersPictureCan1">
                                        <!-- Image here -->
                                    </div>
                                    <div class="UsersNameAndPosition">
                                        <input class="UsersInputCan" type="text">
                                    </div>
                                </div>
                            </div>
                            <footer class="UsersFooterSummary">
                                <button class="btnSubmitNaSaAdmin"> Submit </button>
                            </footer>
                        </div>
                    </div>
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
                                <button class="AcceptBtn"> Accept </button>
                            </footer>
                        </div>
                    </div>
                </div>

                <div class="SuccessfulVoteUser">
                    <div class="SubSucessLaman">
                        <div class="SuccessContainer">
                            <h1> Successful </h1>
                            <h1> Vote </h1>
                            <img class="FingerPrint" src="Pictures/Picsart_24-07-24_15-10-12-879.png">
                            <h2> Reference No. </h2>
                            <input class="refNumber" type="text">
                            <button class="OkInSuccess"> Ok </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/UserVoting.js"></script>
</body>
</html>