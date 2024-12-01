<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'barangay') {
        header("Location: LoginPage.php");
        exit();
    }
} else {
    header("Location: LoginPage.php");
    exit();
}


$admin_unique_id = ''; // Default value if no admin found
$admin_sql = mysqli_query($conn, "SELECT unique_id FROM tblaccounts WHERE role = 'admin' LIMIT 1");
if ($admin_sql && mysqli_num_rows($admin_sql) > 0) {
    $admin_row = mysqli_fetch_assoc($admin_sql);
    $admin_unique_id = $admin_row['unique_id'];
}
$encoded_id = urlencode($admin_unique_id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/UserDocuments.css">
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 Phase 5 </h2>
                </div>
                <div class="DagdagNanaman">
                    
                </div>
                <a href="UserDashBoard.php" class="sideside baractive">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="UserDocuments.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Documents2.png">
                    <span> Documents </span>
                </a>
                <div class="complaintsContainer">
                    <a href="UserComplaints.php" class="sideside" id="complaintsDropdown">
                        <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                        <span> Complaints </span>
                        <button class="buttonEme2">
                            <div class="eme2"></div>
                        </button> 
                    </a>  
                    <ul class="subMenuComp" id="complaintsSubMenu">
                        <li> 
                            <a href="UserChat.php?user_id=<?php echo $encoded_id?>">
                                <img class="img-subMenu" src="Pictures/Chat.png">
                                <label class="sub-spa"> Chat </label>
                            </a> 
                        </li>
                    </ul>
                </div>
                <a href="UserAnnouncement.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
                </a>
                <a href="UserVoting.php" class="sideside">
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
                            <h2 class="namePerModule"> Documents </h2>
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
                    <!-- TABLE LIST FOR REQUEST -->
                    <div class="ContainerForDocuments" id="TblConForDocs">
                        <header style="margin-bottom: 10px;">
                            <h2> List Of Requested Documents </h2>
                            <button class="NewReqDocu" onclick="togglePageNewReqAndTbl('RequestingDocu')"> Request New Document </button>
                        </header>
                        <hr style="width: 100%; height: 0.5px; background: rgb(196, 196, 196); margin-bottom: 5px;">
                        <div class="TblListDocu">
                            <table class="ListReqTable">
                                <thead>
                                    <tr>
                                        <th> Request No.</th>
                                        <th> Requested Document </th>
                                        <th> Requested Date </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td> 123456 </td>
                                            <td> Move In </td>
                                            <td> 02-02-23  02:23 </td>
                                            <td> Pending </td>
                                            <td> 
                                                <button class="ViewDetBtn" id="ViewDetBtn"> View Details </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </thead>
                            </table>

                            <div class="BiewwModalPoIto">
                                <div class="SubBieww">
                                    <div class="ViewDetailsLaman">
                                        <header class="PangEkis">
                                            <span class="EkisToo"> &times; </span>
                                        </header>
                                        <div class="LoobToNgBiew">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- REQUESTING NEW DOCUMENTS -->
                    <div class="ContainerForDocuments" id="RequestingDocu">
                        <div class="ContainerNewReq" onclick="togglePageNewReqAndTbl('TblConForDocs')">
                            <span style="font-size: 17px; color: blue; cursor: pointer;"> &larr; </span>
                            <span style="color: blue; cursor: pointer;"> Back to List Of Complaint </span> 
                        </div>
                        <br>
                        <header style="display: flex; align-items: center; width: 100%; margin-bottom: 10px;">
                            <label class="LabelDocument" style="font-weight: bold;"> Select type of Document: </label>
                            <div class="TypeDocuDrop">
                                <div class="TyDis" onclick="toggleTypeDoc()"> Move Out</div>
                                <div class="TypeDropOptionsDoc" style="display: none;">
                                    <div class="TypeDropOpt" onclick="TypeSet('Move Out')"> Move Out </div>
                                    <div class="TypeDropOpt" onclick="TypeSet('Move In')"> Move In </div>
                                </div>
                            </div>
                        </header>

                        <div id="moveOutCon" class="ConttentParehas" style="display: none;">
                            Move Out To
                        </div>

                        <div id="moveInCon" class="ConttentParehas" style="display: none;">
                            Move In To
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/UserDocuments.js"></script>
</body>
</html>
