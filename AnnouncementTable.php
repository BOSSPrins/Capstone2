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
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/AnnouncementTable.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="sidebar.js"></script>
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
                                </a> 
                                <a href="Resolved.php">
                                    <img class="img-subMenu" src="Pictures/resolved.png">
                                    <label class="sub-spa"> Resolved </label>
                                </a> 
                                <a href="Escalated.php">
                                    <img class="img-subMenu" src="Pictures/warning.png">
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
                            <h2 class="namePerModule"> Announcements </h2>
                        </div>
                    </div>
                    <div class="ProfileViewww">
                        <button id="myProfileBtn" type="button" class="profileBtn">
                            <label> Profile </label>
                        </button>
                        <div class="user-img"></div>
                    </div>
                </div>
                <div class="AnnounceNav">
                    <a href="AnnouncementTable.html" class="AnnNavv AnnActive"> Table Posting </a>
                    <a href="AnnounceHistory.html" class="AnnNavv"> History </a>
                </div>
                <div class="MainContainerForTables">
                    <div class="EachContainerAnnounce" id="AnnounceTab">
                        <div>
                            <button class="NewAnnounce" onclick="toggleAnnounce('AnnounceNewPost')"> Post New Announcement </button>
                        </div>
                        <header class="AnnHeader">
                            <div class="AnnItemCon">
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
                        <hr style="width: 100%; height: 0.5px; background: rgb(196, 196, 196); margin-bottom: 5px;">
                        <div class="TableAnnCon">
                            <table class="TableAnnDetails">
                                <thead>
                                    <th> Title Announcement </th>
                                    <th> Date Posted </th>
                                    <th> Action </th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> Anniversary </td>
                                        <td> 02-02-23 02:23 </td>
                                        <td>
                                            <button class="EditingAnn" onclick="toggleAnnounce('AnnounceEdit')"> Edit </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> Anniversary </td>
                                        <td> 02-02-23 02:23 </td>
                                        <td>
                                            <button class="EditingAnn" onclick="toggleAnnounce('AnnounceEdit')"> Edit </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="padding: 10px 25px;" class="EachContainerAnnounce" id="AnnounceEdit">
                        <div style="display: flex; align-items: center;" class="NameAndBtn">
                            <button class="ButtonBack" onclick="toggleAnnounce('AnnounceTab')"> &#60; </button>
                            <h2 style="margin-left: 10px;"> Edit Post   </h2>
                        </div>
                        <div class="LamanContainer"> <!-- Kunin yung css ng table, magigiging flex to (optional pa to)-->
                            <div class="EditDateTime">
                                <div>
                                    <input class="DateTimeInt" type="datetime-local" id="StrDateTime">
                                </div>
                                <div>
                                    <input class="DateTimeInt" type="datetime-local" id="EndDateTime">
                                </div>
                            </div>
                            <div class="input-container">
                                <label for="Title">Title:</label>
                                <input style="padding: 8px;" class="titleInput" type="text" id="Title">
                            </div>
                            <div class="input-container">
                                <label for="Descrip">Description:</label>
                                <textarea class="DescriInput" id="Descrip"></textarea>
                                <input type="text" id="newsID" hidden>
                            </div>
                            <div class="input-container">
                                <label> File: </label>
                                <div class="EditingPicturesModal">
                                    <div id="EditingPics" class="EditingPics">
                                        <input type="file" class="editingInput newEditingInput" id="PicNames" multiple>
                                        <img class="editingImgModal" src="Pictures/cloudUpload.png" alt="Upload Icon">
                                        <p class="editingLagayanText">Select new images or <span class="spanNiyaModal">browse</span>.</p>
                                    </div>
                                    <div class="editingUploadedImages Imagess" id="Images"></div>
                                    <input type="hidden" id="PicNames">
                                    <div id="selectedFileNames" hidden></div>
                                </div>
                            </div>
                            
                            <!-- Custom Lightbox Modal -->
                            <div class="custom-lightbox" id="custom-lightbox">
                                <span class="custom-LightBoxClose" id="custom-lightboxClose"> × </span>
                                <img class="custom-lightbox-image" id="custom-lightboxImage" />
                            </div>                                                       
                        </div>
                       <div class="ButtonEdit"> <!-- kunin naman yung css ng footer page para mag stay sa ibaba (optional pa to)-->
                            <button class="buttonDeletee cancelButn" onclick="closeDetails()">Cancel</button>
                            <button class="edit-btn tb-btn" id="Apdeyt">Update</button>
                        </div>
                    </div>

                    <div style="padding: 10px 25px;" class="EachContainerAnnounce" id="AnnounceNewPost">
                        <div style="display: flex; align-items: center;" class="NameAndBtn">
                            <button class="ButtonBack" onclick="toggleAnnounce('AnnounceTab')"> &#60; </button>
                            <h2 style="margin-left: 10px;"> New Post   </h2>
                        </div>
                        <div class="LamanContainer"> <!-- Kunin yung css ng table, magigiging flex to (optional pa to)-->
                            <div class="NewPostDatetime">
                                <div>
                                    <input class="DateTimeInt" type="datetime-local" name="start_date" id="start_date">
                                </div>
                                <div>
                                    <input class="DateTimeInt" type="datetime-local" name="end_time" id="end_time">
                                </div>
                            </div>
                            <div class="input-Field">
                                <label> Title: </label>
                                <input style="padding: 8px;" class="InputAnn" type="text" placeholder="Title here..." name="title_name">
                            </div>
                            <div class="input-Field">
                                <label> Description: </label>
                                <textarea class="DescriInput2" placeholder="Enter your text announcement here..." name="description_name" id="description_name"></textarea>
                            </div>

                            <div class="input-Field">
                                <label> File: </label>
                                <div class="creatingAnnounceRap">
                                    <p class="upperUpload">
                                        <span class="uploadInfoValue">0</span> file(s) uploaded.
                                    </p>
                                    <div class="creatingAnnouncementForm">
                                        <!-- File input for selecting images -->
                                        <input class="announceInput" type="file" name="images[]" multiple>
                                        <img class="uploaderImg" src="Pictures/cloudUpload.png" alt="Upload Icon">
                                        <p class="uploadLagayanText">Select images or <span class="spanNiya">browse</span>.</p>
                                    </div>
                                    <div class="uploadingImages">
                                        <!-- Uploaded images will appear here -->
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Lightbox Modal -->
                            <div class="lightbox" id="lightbox">
                                <span class="LightBoxClose" id="lightboxClose"> × </span>
                                <img class="lightbox-image" id="lightboxImage" />
                            </div>                                                        
    
                            <div class="buttonToPost">
                                <input class="buttonPostInputSub" type="submit" id="sabmitBoton">
                            </div>
                            <div class="iror"></div>  
                            <div class="sakses"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="AnnouncementTable.js"></script>
</body>
</html>