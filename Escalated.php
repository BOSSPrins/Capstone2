<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/Escalated.css">
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
                    <a href="Documents.php" class="sideside">
                        <img class="img-sideboard" src="Pictures/Documents2.png">
                        <span> Documents </span>
                    </a>
                    <div class="complaintsContainer">
                        <a href="" class="sideside" id="complaintsDropdown">
                            <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                            <span> Manage Complaints</span>
                            <button class="buttonEme2">
                                <div class="eme2"></div>
                            </button>
                        </a>  
                        <ul class="subMenuComp" id="complaintsSubMenu">
                            <li> 
                                <a href="#">
                                    <img class="img-subMenu" src="#">
                                    <label class="sub-spa"> In-Process </label>
                                </a> 
                                <a href="#">
                                    <img class="img-subMenu" src="#">
                                    <label class="sub-spa"> Resolved </label>
                                </a> 
                                <a href="#">
                                    <img class="img-subMenu" src="#">
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
                            <h2 class="namePerModule"> Escalated Complaints </h2>
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
                    <div class="TablessContainer" id="tableCon">
                        <header class="TableHeaderr">
                            <div class="itemsController">
                                <h3>Show</h3>
                                <div class="dropdown" id="itemPerpage">
                                    <div class="selected" style="z-index: 1;" id="dropdownSelected"> All </div>
                                    <div class="options" style="z-index: 1;">
                                        <div class="option" style="z-index: 1;" data-value="4">04</div>
                                        <div class="option" style="z-index: 1;" data-value="5">05</div>
                                        <div class="option" style="z-index: 1;" data-value="8">08</div>
                                        <div class="option" style="z-index: 1;" data-value="10">10</div>
                                        <div class="option" style="z-index: 1;" data-value="23">15</div>
                                    </div>
                                </div>
                                <h3>Per Page</h3>
                            </div>
                            <div class="searchTablee">
                                <h3>Search:</h3>
                                <input class="inputSearchhh" type="search" name="search_query" id="search" placeholder="search">
                            </div>
                        </header>
                        <div class="TableComplaintsPen">
                            <table class="TableComPend">
                                <thead>
                                    <!-- <th style="width:10%"> Complain No.</th> -->
                                    <th style="width:25%" data-sort onclick="sortTable(0, event)"> Complaint Name </th>
                                    <th style="width:25%"> Address </th>
                                    <th style="width:15%"> Date Submitted </th>
                                    <th style="width:12%" > Status </th>
                                    <th style="width:15%" > Action </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td> 02022023 </td> -->
                                        <td> Ruella </td>
                                        <td> Blk 22 Lot 48 </td>
                                        <td> 2023-02-02 02:23 </td>
                                        <td style="color: red;"> Escalated </td>
                                        <td>
                                            <button class="BiewPendBtn" onclick="togglePage('PangalawangCon')">View Details</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <footer class="bottom-field">
                            <ul class="pagination">
                                <li class="prev">
                                    <a href="#" class="prevv" id="prev"> &#139; Previous </a>
                                </li>
                                    <!-- page number here -->
                                <li class="next">
                                    <a href="#" class="nextt" id="next"> Next &#155; </a>
                                </li>
                            </ul>
                        </footer>
                    </div>
                    
                    <div class="TablessContainer DetailsTo" id="PangalawangCon" style="display: none;">
                        <div style="display: flex; align-items: center;" class="NameAndBtn">
                            <button class="BtnNgNameBack" onclick="togglePage('tableCon')"> &#60; </button>
                            <h2 style="margin-left: 10px;"> Complaint Details </h2>
                        </div>
                        <div class="DetaLaman">
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Complaint Name: </label>
                                <input class="inputCompDeta" type="text">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Address: </label>
                                <input class="inputCompDeta" type="text">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Date Submitted: </label>
                                <input class="inputCompDeta" type="text">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Nature Of Complaint: </label>
                                <input class="inputCompDeta" type="text">
                            </div>
                            <h2> Details </h2>
                            <div style="display: flex; margin-bottom: 15px;">
                                <label class="LabelCompDeta"> Description: </label>
                                <textarea class="textAreaCompDeta"> </textarea>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> File: </label>
                                <input class="inputCompDeta" type="file">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Current Status: </label>
                                <input class="inputCompDeta" type="text">
                            </div>

                            <!-- Galing Pending Lagayan -->
                            <div style="background: rgb(138, 187, 231); padding: 10px;">
                                <div style="display: flex; margin-bottom: 15px;">
                                    <label class="LabelCompDeta"> Remark: </label>
                                    <textarea class="textAreaCompDeta"> </textarea>
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Remark by: </label>
                                    <input class="inputCompDeta" type="text">
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Status: </label>
                                    <input class="inputCompDeta" type="text">
                                </div>
                                <div style="display: flex; align-items:center;">
                                    <label class="LabelCompDeta"> Remark Date: </label>
                                    <input class="inputCompDeta" type="text">
                                </div>
                            </div>


                            <!-- Galing In-Process Lagayan -->
                            <div style="background: rgb(110, 160, 204); padding: 10px;">
                                <div style="display: flex; margin-bottom: 15px;">
                                    <label class="LabelCompDeta"> Remark: </label>
                                    <textarea class="textAreaCompDeta"> </textarea>
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Remark by: </label>
                                    <input class="inputCompDeta" type="text">
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Status: </label>
                                    <input class="inputCompDeta" type="text">
                                </div>
                                <div style="display: flex; align-items:center;">
                                    <label class="LabelCompDeta"> Remark Date: </label>
                                    <input class="inputCompDeta" type="text">
                                </div>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; margin-top: 10px; align-items:center;">
                                <label class="LabelCompDeta"> Action: </label>
                                <button class="TabkeActionBtn" onclick="toggleStatusFields()"> Take Action </button>
                            </div>
                        </div>

                        <!-- Laman Ng Take Action -->
                        <div class="Take-Action DetaLaman" id="status-container" style="display:none;">
                            <div style="display: flex; margin-bottom: 15px; width: 50%; align-items:center;">
                                <label class="LabelCompDeta">Status: </label>
                                <div class="custom-dropdown">
                                    <div class="dropdown-display" onclick="toggleDropdown()"> --- </div>
                                    <div class="dropdown-options" style="display: none;">
                                        <div class="dropdown-option" onclick="setStatus('In-Progress')"> In-Process </div>
                                        <div class="dropdown-option" onclick="setStatus('Resolved')"> Resolved </div>
                                        <div class="dropdown-option" onclick="setStatus('Escalated')"> Escalated </div>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex;">
                                <label class="LabelCompDeta">Remark: </label>
                                <textarea class="textAreaCompDeta"></textarea>
                            </div>
                            <div style="display: flex; justify-content: end; width: 100%; margin-top: 10px;">
                                <button style="padding: 10px 30px;"> Submit </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/Escalated.js"></script>
</body>
</html>