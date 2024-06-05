<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
  if ($_SESSION['role'] == 'user') {
      header("Location: LoginPage.php");
      exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/Documents.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
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

    <div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="headerTop">
                <div class="leftSection">
                    <img class="menu" src="Pictures/menu-hamburger.png">
                    <img class="img-logo" src="Pictures/Dasma_City_Logo.png">
                    <h2> Mabuhay Homes 2000 </h2>
                </div>
                <div class="rightSection">
                    <button id="myProfileBtn" type="button" class="profileBtn">
                        <div class="user-img"></div>
                        <label> Profile </label>
                    </button>
                    <!-- <div class="eme3"></div> -->
                </div>
            </div>

            <div class="sidebarContainer sideActive" id="sidebar">
                <a href="DashBoard.php" class="sideside active">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="HoaOfficials.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Officials.png">
                    <span> HOA Officials </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Residents2.png">
                    <span> Residents </span>
                </a>
                <a href="Documents.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Documents2.png">
                    <span> Documents </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Request2.png">
                    <span> Online Request </span>
                </a>
                <div class="complaintsContainer">
                    <a href="#" class="sideside" id="complaintsDropdown">
                        <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                        <span> Complaints </span>
                        <div class="eme2"></div> 
                    </a>  
                    <ul class="subMenuComp" id="complaintsSubMenu">
                        <li> 
                            <a href="MainChat.php">
                                <img class="img-subMenu" src="Pictures/Chat.png">
                                <label class="sub-spa"> Chat </label>
                            </a> 
                        </li>
                        <li> <a href="#"> Sub Menu 2 </a> </li>
                        <li> <a href="#"> Sub Menu 3 </a> </li>
                    </ul>
                </div>
                <a href="Announcement.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Accounts2.png">
                    <span> Accounts </span>
                </a>
                <a href="Logout.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/logout.png">
                    <span> Logout </span>
                </a>
            </div>

            <div class="DocumentsContainerr DocumentsConActivee">
                <div class="TopNamePage">
                    <h1> Documents </h1>
                </div>

                <div class="container">
                    <div class="docsdCards">
                        <div class="eachDocsCon" onclick="showPage('pageA')">a</div>
                        <div class="eachDocsCon" onclick="showPage('pageB')">b</div>
                        <div class="eachDocsCon" onclick="showPage('pageC')">c</div>
                        <div class="eachDocsCon" onclick="showPage('pageD')">d</div>
                        <div class="eachDocsCon" onclick="showPage('pageE')">e</div>
                        <div class="eachDocsCon" onclick="showPage('pageF')">f</div>
                    </div>
                </div>
                <div class="pagess pagessActive" id="pageA">
                    <div>
                        <span class="spanBack" onclick="goBack()"> &#60; </span>
                    </div>
                    <div class="tableContainerTopp">
                        <div class="table-container">
                            <div class="searchContainer">
                                <div class="searchFilterLeft">
                                    
                                </div>
                                <div class="searchRight">
                                    <label> Search: </label>
                                <input class="searchInputDes" type="search">
                                </div>
                            </div>
    
                            <div class="tableContent">
                                <table>
                                    <thead>
                                        <tr>
                                            <th> Resident's Name </th>
                                            <th> Address </th>
                                            <th> Purpose </th>
                                            <th colspan="2"> Date / Time </th>
                                            <th> Action </th>
                                        </tr>
                    
                                        <tbody>
                                            <tr>
                                                <td> Prince </td>
                                                <td> Blk 02 Lot 23 </td>
                                                <td> Scholarship </td>
                                                <td> 02:02 </td>
                                                <td> 02:02 </td>
                                                <td>
                                                    <button class="GenerateBtn tb-btn"> Generate Certificate </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                            <!-- Modal for generating certificate -->
                            <div id="certificateModal" class="certificateModal">
                                <div class="subCertificateModal">
                                    <div class="certificateModalCon">
                                        <div class="NamecloseContainer">
                                            <div class="FormName">
                                                <h1>Certificate Modal</h1>
                                            </div>
                                            <div class="closeContainer">
                                                <span class="CertClose">&times;</span>
                                            </div>
                                        </div>
                                        <hr class="hrInNameClose">
                                        <div class="InputContainerCert">
                                            <label class="labelInCert"> Full Name: </label>
                                            <input class="inputperCert" type="text">
                                        </div>
                                        <div class="InputContainerCert">
                                            <label class="labelInCert"> Address: </label>
                                            <input class="inputperCert" type="text">
                                        </div>
                                        <div class="InputContainerCert">
                                            <label class="labelInCert"> Purpose: </label>
                                            <input class="inputperCert" type="text">
                                        </div>
                                        <div class="buttonsInCerti">
                                            <button class="cancelCertBtn CBtn">
                                                Cancel
                                            </button>
                                            <button class="confirmCertBtn CBtn">
                                                Confirm
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagess pagessActive" id="pageB">Content of Page B</div>
                <div class="pagess pagessActive" id="pageC">Content of Page C</div>
                <div class="pagess pagessActive" id="pageD">Content of Page D</div>
                <div class="pagess pagessActive" id="pageE">Content of Page E</div>
                <div class="pagess pagessActive" id="pageF">Content of Page F</div>

            </div>
        </div>
    </div>  
    
    <script src="JS/Documents.js"></script>
</body>
</html>