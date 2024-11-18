<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="stylesheet" href="CSS/BarangayHisto.css">
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
                    <a href="BarangayTable.html" class="NavTop">List Of Escalated Complaints</a>
                    <a href="BarangayHisto.html" class="NavTop">History</a>
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
                                    <th> Name </th>
                                    <th> Date Submitted </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 123456 </td>
                                        <td> Ruella Cervantes </td>
                                        <td> 02-02-23 02:23 </td>
                                        <td> Escalated </td>
                                        <td> 
                                            <!-- View button to show the complaint details -->
                                            <button class="BiewHisto" onclick="toggleHistoBiew('ViewExcaltedDet2')"> View </button>
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
                                <li class="next">
                                    <a href="#" class="nextt" id="next"> Next &#155; </a>
                                </li>
                            </ul>
                        </footer>
                    </div>
                
                    <!-- Section for the Complaint Details (when View is clicked) -->
                    <div class="EachContainerBarang2" id="ViewExcaltedDet2">
                        <div style="display: flex; align-items: center;" class="NameAndBtn">
                            <!-- Back button to return to the TableListEsca section -->
                            <button class="ButtonBack" onclick="toggleHistoBiew('TableHistory')"> &#60; </button>
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
                                <textarea class="textAreaBarangDeta2"> </textarea>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> File: </label>
                                <button class="BiewPictures"> View </button>
                                 <!-- Modal for Image Preview -->
                                <div class="imageModalHistory" style="display: none;">
                                    <span class="closeModalHisto">&times;</span>
                                    <button class="prevImage" onclick="changeHistoImg(-1)">&#10094;</button>
                                    <img class="modalImageHisto" src="" alt="Image Preview" />
                                    <button class="nextImage" onclick="changeHistoImg(1)">&#10095;</button>
                                </div>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> Current Status: </label>
                                <input class="inputCompDeta" type="text">
                            </div>

                            <!-- Galing Pending Lagayan -->
                            <div style="background: rgb(138, 187, 231); padding: 10px;">
                                <div style="display: flex; margin-bottom: 15px;">
                                    <label class="LabelCompDeta"> Remark: </label>
                                    <textarea class="textAreaBarangDeta2"> </textarea>
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
                                <button class="DownloadBtn"> Download </button>
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