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
    <link rel="stylesheet" href="CSS/Resolved.css">
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
                                    <span class="badge badge-yellow" id="inProcessBadge">0</span>
                                </a> 
                                <a href="Resolved.php">
                                    <img class="img-subMenu" src="Pictures/resolved.png">
                                    <label class="sub-spa"> Resolved </label>
                                </a> 
                                <a href="Escalated.php">
                                    <img class="img-subMenu" src="Pictures/warning.png">
                                    <label class="sub-spa"> Escalated </label>
                                    <span class="badge badge-red" id="escalatedBadge">0</span>
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
                            <h2 class="namePerModule"> Resolved Complaints </h2>
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
                                    <th style="width:12%"> Complaint No. </th>
                                    <th style="width:15%" data-sort onclick="sortTable(0, event)"> Complaint </th>
                                    <th style="width:25%"> Date Submitted </th>
                                    <th style="width:12%" > Status </th>                                   
                                    <th style="width:15%" > Action </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        
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
                            <div id="ComplaineeSection">
                                <h2> Complainee </h2>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Name: </label>
                                    <input class="inputCompDeta" type="text" id="ComplaineeName">
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Address: </label>
                                    <input class="inputCompDeta" type="text" id="ComplaineeAddress">
                                </div>
                            </div>

                            <h2> Complainant </h2>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Name: </label>
                                <input class="inputCompDeta" type="text" id="ComplainantName">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Address: </label>
                                <input class="inputCompDeta" type="text" id="ComplainantAddress">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Date Submitted: </label>
                                <input class="inputCompDeta" type="text" id="DateSubmit">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Nature Of Complaint: </label>
                                <input class="inputCompDeta" type="text" id="ComplaintType">
                            </div>
                            <h2> Details </h2>
                            <div style="display: flex; margin-bottom: 15px;">
                                <label class="LabelCompDeta"> Description: </label>
                                <textarea class="textAreaCompDeta" id="Description"> </textarea>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Current Status: </label>
                                <input class="inputCompDeta" type="text" id="Status">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Processed Date: </label>
                                <input class="inputCompDeta" type="text" id="ProcessDate">
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Proof Images: </label>
                                <button class="BiewwPicture"> View </button>
                                 <!-- Modal for Image Preview -->
                                <div class="imageModal" style="display: none;">
                                    <span class="closeModal">&times;</span>
                                    <button class="prevImage" onclick="changeImage(-1)">&#10094;</button>
                                    <img class="modalImage" src="" alt="Image Preview" />
                                    <button class="nextImage" onclick="changeImage(1)">&#10095;</button>
                                </div>
            
                                <!-- <img id="ProofFileName" alt="Proof Image" style="max-width: 300px; max-height: 200px;"></img> -->

                            </div>     
                            
                            <div id="pdfSection" style="display: none;">
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Previous Complaint Report: </label>
                                    <div id="pdfLinksContainer" style="margin-left: 10px; display: flex; flex-wrap: wrap; gap: 10px;">
                                        <!-- This will hold the links -->
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Barangay Settled Report: </label>
                                <div id="BrngySettle" style="margin-left: 10px; display: flex; flex-wrap: wrap; gap: 10px;">
                                    <!-- This will hold the links -->
                                </div>
                            </div>

                            <!-- Galing Pending Lagayan -->
                            <h2>First Remark:</h2>
                            <div style="background: rgb(138, 187, 231); padding: 10px;">
                                <div style="display: flex; margin-bottom: 15px;">
                                    <label class="LabelCompDeta"> Remark: </label>
                                    <textarea class="textAreaCompDeta" id="FirstRemark"> </textarea>
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Remark by: </label>
                                    <input class="inputCompDeta" type="text" id="FirstRemarkBy">
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Status: </label>
                                    <input class="inputCompDeta" type="text" id="FirstStatus">
                                </div>
                                <div style="display: flex; align-items:center;">
                                    <label class="LabelCompDeta"> Remark Date: </label>
                                    <input class="inputCompDeta" type="text" id="FirstRemarkDate">
                                </div>
                            </div>


                            <div id="SecondRemarkSectionContainer">
                            <h2>Second Remark:</h2>
                            <div style="background: rgb(110, 160, 204); padding: 10px;">
                                <div style="display: flex; margin-bottom: 15px;">
                                    <label class="LabelCompDeta"> Remark: </label>
                                    <textarea class="textAreaCompDeta" id="SecondRemark"> </textarea>
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Remark by: </label>
                                    <input class="inputCompDeta" type="text" id="SecondRemarkBy">
                                </div>
                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                    <label class="LabelCompDeta"> Status: </label>
                                    <input class="inputCompDeta" type="text" id="SecondStatus">
                                </div>
                                <div style="display: flex; align-items:center;">
                                    <label class="LabelCompDeta"> Remark Date: </label>
                                    <input class="inputCompDeta" type="text" id="SecondRemarkDate">
                                </div>
                            </div>

                            <!-- <div id="ThirdRemarkSectionContainer">
                                <h2>Third Remark:</h2>
                                <div style="background: rgb(138, 187, 231); padding: 10px;">
                                    <div style="display: flex; margin-bottom: 15px;">
                                        <label class="LabelCompDeta"> Remark: </label>
                                        <textarea class="textAreaCompDeta" id="ThirdRemark"> </textarea>
                                    </div>
                                    <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                        <label class="LabelCompDeta"> Remark by: </label>
                                        <input class="inputCompDeta" type="text" id="ThirdRemarkBy">
                                    </div>
                                    <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                        <label class="LabelCompDeta"> Status: </label>
                                        <input class="inputCompDeta" type="text" id="ThirdStatus">
                                    </div>
                                    <div style="display: flex; align-items:center;">
                                        <label class="LabelCompDeta"> Remark Date: </label>
                                        <input class="inputCompDeta" type="text" id="ThirdRemarkDate">
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div style="display: flex; margin-bottom: 15px; margin-top: 10px; align-items:center;">
                                <label class="LabelCompDeta"> Action: </label>
                                <button class="TabkeActionBtn" onclick="toggleStatusFields()"> Take Action </button>
                            </div> -->
                        </div>

                        <!-- Laman Ng Take Action -->
                        <!-- <div class="Take-Action DetaLaman" id="status-container" style="display:none;">
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
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/Resolved.js"></script>
</body>
</html>