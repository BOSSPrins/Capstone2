<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user') {
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
    <link rel="stylesheet" href="CSS/BarangayHisto.css">
    <script src="jQuery/jquery.min.js"></script>
    <script src="jsPDF/dist/jspdf.umd.min.js"></script>
</head>
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div id="profileModal" class="modal">
                <div class="subModal">
                    <div class="modal-content">
                        <div class="profileSidebar">
                            <a href="#" onclick="openPage('Edit Profile')"> Edit Profile </a>
                            <a href="#" onclick="openPage('Edit Email')"> Edit Email </a>
                            <a href="#" onclick="openPage('Change Password')"> Change Password </a>
                            <a href="Logout.php">Logout</a>
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
                            <h2 class="namePerModule"> Barangay </h2>
                        </div>
                    </div>
                    <div class="ProfileViewww">
                        <button id="myProfileBtn" type="button" class="profileBtn">
                            <label> Profile </label>
                        </button>
                        <div class="user-img"></div>
                    </div>
                </div>
                <div class="BarangayNavv">
                    <a href="BarangayTable.php" class="NavTop NavActive">List Of Escalated Complaints
                        <span class="badge badge-red" id="escalatedBadge">0</span>
                    </a>
                    <a href="BarangayHisto.php" class="NavTop">History</a>
                </div>
                
                <div class="MainContainerForTables">
                    <!-- Section for the List of Escalated Complaints -->
                    <div class="EachContainerBarang2" id="TableHistory">
                        <header class="BarangHeader">
                            <div class="BarangItemCon">
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
                        <hr style="width: 100%; height: 0.5px; background: rgb(196, 196, 196);">
                        <div class="TableBarangCont">
                            <table class="TableBarangDet">
                                <thead>
                                    <th> Complaint No. </th>
                                    <th> Complaint </th>
                                    <th> Date Submitted </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td> 123456 </td>
                                        <td> Ruella Cervantes </td>
                                        <td> 02-02-23 02:23 </td>
                                        <td> Escalated </td>
                                        <td> 
                                           
                                            <button class="BiewHisto" onclick="toggleHistoBiew('ViewExcaltedDet2')"> View </button>
                                        </td> -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <footer class="bottom-field">
                            <ul class="pagination">
                                <li class="prev">
                                    <a href="#" class="prevv" id="prev"> &#139; Previous </a>
                                </li>
                                <li class="next">
                                    <a href="#" class="nextt" id="next"> Next &#155; </a>
                                </li>
                            </ul>
                        </footer>
                    </div>
                
                    <!-- Section for the Complaint Details (when View is clicked) -->
                    <div class="EachContainerBarang2" id="ViewExcaltedDet2" style="display: none;">
                        <div style="display: flex; align-items: center;" class="NameAndBtn">
                            <!-- Back button to return to the TableListEsca section -->
                            <button class="ButtonBack" onclick="toggleHistoBiew('TableHistory')"> &#60; </button>
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
                                <textarea class="textAreaBarangDeta2" id="Description"> </textarea>
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
                                <button class="BiewPictures"> View </button>
                                 <!-- Modal for Image Preview -->
                                <div class="imageModalHistory" style="display: none;">
                                    <span class="closeModalHisto">&times;</span>
                                    <button class="prevImage" onclick="changeHistoImg(-1)">&#10094;</button>
                                    <img class="modalImageHisto" src="" alt="Image Preview" />
                                    <button class="nextImage" onclick="changeHistoImg(1)">&#10095;</button>
                                </div>
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
                                <label class="LabelCompDeta"> HOA Turn Over Report: </label>
                                <div id="HoaReport" style="margin-left: 10px; display: flex; flex-wrap: wrap; gap: 10px;">
                                    <!-- This will hold the links -->
                                </div>
                            </div>
             

                            <!-- Galing Pending Lagayan -->
                            <h2>First Remark:</h2>
                            <div style="background: rgb(138, 187, 231); padding: 10px;">
                                <div style="display: flex; margin-bottom: 15px;">
                                    <label class="LabelCompDeta"> Remark: </label>
                                    <textarea class="textAreaBarangDeta2" id="FirstRemark"> </textarea>
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

                            <h2>Second Remark:</h2>
                            <div style="background: rgb(138, 187, 231); padding: 10px;">
                                <div style="display: flex; margin-bottom: 15px;">
                                    <label class="LabelCompDeta"> Remark: </label>
                                    <textarea class="textAreaBarangDeta2" id="SecondRemark"> </textarea>
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
                            <div style="display: flex; margin-bottom: 15px; margin-top: 10px; align-items:center;">
                                <label class="LabelCompDeta"> Action: </label>
                                <button class="DownloadBtn" id="generatePdfBtn" disabled> Generate Complaint Letter </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/BarangayHisto.js"></script>
</body>
</html>