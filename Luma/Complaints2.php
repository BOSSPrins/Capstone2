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
    <link rel="stylesheet" href="CSS/Complaints.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                            <h2 class="namePerModule"> Complaints </h2>
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
                    <div class="TablessContainer">
                        <header class="TableHeaderr">
                            <div class="itemsController">
                                <h3>Show</h3>
                                <div class="dropdown" id="itemPerpage">
                                    <div class="selected" style="z-index: 1;" id="dropdownSelected"> 23 </div>
                                    <div class="options">
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
                                <input class="inputSearchhh" type="text" name="" id="search" placeholder="search">
                            </div>
                        </header>
                        <div class="TablesContainer">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width:400px" data-sort onclick="sortTable(0, event)"> Name </th>
                                        <th data-sort onclick="sortTable(1, event)"> Address </th>
                                        <th style="width:200px" > Complaint </th>
                                        <th style="width:200px" > Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td> Ruella </td>
                                        <td> Blk 22 Lot 48 </td>
                                        <td> Neighbor </td>
                                        <td> -->
                                            <!-- <button> 
                                                <span> &#x2714; </span>
                                            </button>
                                            <button>
                                                <span> ✖ </span>
                                            </button> -->
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

                        <div class="ModalNgComplain">
                            <div class="SubModalComplain">
                                <div class="LamanNgViewCom">
                                    <header class="titleHeaderView">
                                        <span class="closeViewModal">&times;</span>
                                    </header>
                                    <div class="boxsaLoob">
                                        <div class="BotonDalawa">
                                            <button class="MessComp Compsss"> Message </button>
                                            <button class="repsComp Compsss"> Reply </button>
                                        </div>
                                        <div class="ComplaineeInLab divssComp">
                                            <label style="font-size: medium; font-weight:bold;"> Complainee: </label>
                                            <input class="inputComplaintss" type="text">
                                        </div>
                                        <div class="ReasonCom divssComp">
                                            <label style="font-size: medium; font-weight:bold;"> Complaint: </label>
                                            <input class="inputComplaintss" type="text">
                                        </div>
                                        <div class="DescriptionComp">
                                            <label style="font-size: medium; font-weight:bold;"> Description: </label>
                                            <textarea class="DescriTextArea"> </textarea>
                                        </div>
                                        <div class="PicProof">
                                            <label style="font-size: medium; font-weight:bold;"> Proof: </label>
                                            <div class="LagayanPictureComp"> </div>
                                        </div>
                                    </div>
                                    <div class="boxLoobReply">
                                        <div class="SubBoxLoobReply">
                                            <div class="RespondsInt">
                                                <label style="font-size: medium; font-weight:bold;"> Responds To: </label>
                                                <input class="ComplaintName" type="text">
                                            </div>
                                            <div class="RespondsTextArea">
                                                <textarea class="textAreaComp"> </textarea>
                                            </div>
                                        </div>
                                        <footer class="footerRespo">
                                            <button class="BackBtn Compsss"> Back </button>
                                            <button class="SubmitRespo"> Submit </button>
                                        </footer>
                                    </div>
                                    <div class="boxLoobReply2">
                                        <h1 style="text-align: center; margin-bottom: 10px ;"> Messaging </h1>
                                        <div class="SubBoxLoobReply2">
                                            <div class="RespondsInt2">
                                                <label style="font-size: medium; font-weight:bold;"> Responds To: </label>
                                                <input class="ComplaintName2" type="text">
                                            </div>
                                            <div class="RespondsTextArea2">
                                                <textarea class="textAreaComp2"> </textarea>
                                            </div>
                                        </div>
                                        <footer class="footerRespo2">
                                            <button class="BackBtn Compsss"> Back </button>
                                            <button class="SubmitRespo2"> Submit </button>
                                        </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/Complaints.js"></script>
</body>
</html>