<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="stylesheet" href="CSS/BarangayTable.css">
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
                    <a href="BarangayTable.html" class="NavTop NavActive">List Of Escalated Complaints</a>
                    <a href="BarangayHisto.html" class="NavTop">History</a>
                </div>
                
                <div class="MainContainerForTables">
                    <!-- Section for the List of Escalated Complaints -->
                    <div class="EachContainerBarang" id="TableListEsca">
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
                                            <button class="BiewEscaBarang" onclick="toggleBarangayCon('ViewExcaltedDet')"> View </button>
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
                    <div class="EachContainerBarang" id="ViewExcaltedDet">
                        <div style="display: flex; align-items: center;" class="NameAndBtn">
                            <!-- Back button to return to the TableListEsca section -->
                            <button class="ButtonBack" onclick="toggleBarangayCon('TableListEsca')"> &#60; </button>
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
                                <textarea class="textAreaBarangDeta"> </textarea>
                            </div>
                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                <label class="LabelCompDeta"> File: </label>
                                <button class="BiewwPicture"> View </button>
                                 <!-- Modal for Image Preview -->
                                <div class="imageModal" style="display: none;">
                                    <span class="closeModal">&times;</span>
                                    <button class="prevImage" onclick="changeImage(-1)">&#10094;</button>
                                    <img class="modalImage" src="" alt="Image Preview" />
                                    <button class="nextImage" onclick="changeImage(1)">&#10095;</button>
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
                                    <textarea class="textAreaBarangDeta"> </textarea>
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
                                <button class="DownloadBtn"> Download </button>
                            </div>

                            <!-- Laman Ng Take Action -->
                            <div class="Take-Action" id="status-container" style="display:none;">
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
                                    <textarea class="textAreaBarangDeta"></textarea>
                                </div>
                                <div style="display: flex; justify-content: space-between; width: 100%; margin-top: 10px;">
                                    <button style="padding: 10px 30px;"> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/BarangayTable.js"></script>
</body>
</html>