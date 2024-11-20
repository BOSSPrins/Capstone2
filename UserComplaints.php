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
    <link rel="stylesheet" href="CSS/UserComplaints.css">
    <script src="jQuery/jquery.min.js"></script>
    <script src="jsPDF/dist/jspdf.umd.min.js"></script>
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 Phase 5 </h2>
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
                    <!-- TABLE LIST PAGE -->
                    <div class="ContainerForComplaints" id="tblConforComplaints">
                        <header style="margin-bottom: 20px;">
                            <h2> List Of Complaints </h2>
                            <button class="NewCompl" onclick="togglePageNewAndTbl('AddNewComplaints')"> File New Complaint </button>
                            <input type="hidden" id="UserUID" value="<?php echo $_SESSION['unique_id']?>">
                        </header>
                        <div class="TblListComplaint">
                            <table class="ListTablee">
                                <thead>
                                    <tr>
                                        <th> Complaint No. </th>
                                        <th> Complaint Type </th>
                                        <th> Date Submitted </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <!-- <td> 123456 </td>
                                            <td> General Complaint </td>
                                            <td> 02-02-23  02:23</td>
                                            <td> In-Process </td>
                                            <td>
                                                <button class="viewDetailsBtn" id="viewDetailsBtn">View Details</button>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </thead>
                            </table>
                            <button id="generatePdfBtn" disabled>Generate Complaint Letter</button>

                            <!-- MODAL VIEW TRACKING  -->
                            <div class="ModalNato">
                                <div class="SubModalNato">
                                    <div class="contentModalNato">
                                        <header class="EkisTo">
                                            <span class="PagEkis"> &times; </span>
                                        </header>
                                        <div class="LoobNaPoIto">

                                            <div id="ComplaineeSection">
                                                <h2> Complainee </h2>
                                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                    <label class="LabelModalDet"> Name: </label>
                                                    <input class="InputModalDet" type="text" id="UserComplaineeName">
                                                </div>
                                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                    <label class="LabelModalDet"> Address: </label>
                                                    <input class="InputModalDet" type="text" id="UserComplaineeAddress">
                                                </div>
                                            </div>
                                            
                                            <h2> Complainant </h2>
                                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                <label class="LabelModalDet"> Name: </label>
                                                <input class="InputModalDet" type="text" id="UserComplainantName">
                                            </div>
                                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                <label class="LabelModalDet"> Address: </label>
                                                <input class="InputModalDet" type="text" id="UserComplainantAddress">
                                            </div>
                                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                <label class="LabelModalDet"> Date Submitted: </label>
                                                <input class="InputModalDet" type="text" id="UserDateSubmit">
                                            </div>
                                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                <label class="LabelModalDet"> Nature Of Complaint: </label>
                                                <input class="InputModalDet" type="text" id="UserComplaintType">
                                            </div>
                                            <h2> Details </h2>
                                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                <label class="LabelModalDet"> Description: </label>
                                                <textarea class="textAreaModalDet" id="UserDescription"></textarea>
                                            </div>
                                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                <label class="LabelModalDet"> Current Status: </label>
                                                <input class="InputModalDet" type="text" id="UserStatus">
                                            </div>
                                            <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                <label class="LabelModalDet">  File: </label>
                                                <!-- input a images when click the edit button it will show a "x" above the images -->
                                            </div>


                                            <!-- Lagayan galing admin 1 -->
                                            <div style="background: rgb(138, 187, 231); padding: 10px; margin-bottom:10px;">
                                                <div style="display: flex; margin-bottom: 15px;">
                                                    <label class="LabelModalDet"> Remark: </label>
                                                    <textarea class="textAreaModalDet" id="UserFirstRemark"> </textarea>
                                                </div>
                                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                    <label class="LabelModalDet"> Remark by: </label>
                                                    <input class="InputModalDet" type="text" id="UserFirstRemarkBy">
                                                </div>
                                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                    <label class="LabelModalDet"> Status: </label>
                                                    <input class="InputModalDet" type="text" id="UserFirstStatus">
                                                </div>
                                                <div style="display: flex; align-items:center;">
                                                    <label class="LabelModalDet"> Remark Date: </label>
                                                    <input class="InputModalDet" type="text" id="UserFirstRemarkDate">
                                                </div>
                                            </div>


                                             <!-- Lagayan galing admin 2 -->
                                             <div style="background: rgb(138, 187, 231); padding: 10px;">
                                                <div style="display: flex; margin-bottom: 15px;">
                                                    <label class="LabelModalDet"> Remark: </label>
                                                    <textarea class="textAreaModalDet" id="UserSecondRemark"> </textarea>
                                                </div>
                                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                    <label class="LabelModalDet"> Remark by: </label>
                                                    <input class="InputModalDet" type="text" id="UserSecondRemarkBy">
                                                </div>
                                                <div style="display: flex; margin-bottom: 15px; align-items:center;">
                                                    <label class="LabelModalDet"> Status: </label>
                                                    <input class="InputModalDet" type="text" id="UserSecondStatus">
                                                </div>
                                                <div style="display: flex; align-items:center;">
                                                    <label class="LabelModalDet"> Remark Date: </label>
                                                    <input class="InputModalDet" type="text" id="UserSecondRemarkDate">
                                                </div>
                                            </div>
                                            <div style="display: flex; margin-bottom: 15px; margin-top: 10px; align-items:center;">
                                                <label class="LabelModalDet"> Action: </label>
                                                <button class="BtnDownloadModal"> Download </button>
                                            </div>
                                        <!-- <input type="text" id="UserComplaineeName">
                                        <input type="text" id="UserComplaineeAddress">
                                        <input type="text" id="UserComplainantName">
                                        <input type="text" id="UserComplainantAddress">
                                        <input type="text" id="UserDateSubmit">
                                        <input type="text" id="UserComplaintType">
                                        <input type="text" id="UserDescription">
                                        <input type="text" id="UserStatus"> -->                                     
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    
                    <!-- NEW COMPLAINT PAGE -->
                    <div class="ContainerForComplaints" id="AddNewComplaints">
                        <div class="TableComplaintsCon" onclick="togglePageNewAndTbl('tblConforComplaints')"> 
                            <span style="font-size: 17px; color: blue; cursor: pointer;"> &larr; </span>
                            <span style="color: blue; cursor: pointer;"> Back to List Of Complaint </span> 
                        </div>
                        <br>
                        <!-- <hr style="border: 1px solid #d0d0d0; width: 100%; margin: 20px auto;"> -->
                        <header style="display: flex; align-items: center; width: 40%; margin-bottom: 10px;">
                            <label style="width: 50%; font-weight: bold;"> Select type of Complaint: </label>
                            <div class="TypeDrop">
                                <!-- Clicking this div will trigger the dropdown toggle -->
                                <div class="TypeDisplay" onclick="toggleType()"> ---- </div>
                                <!-- Hidden dropdown options -->
                                <div class="TypedropOptions" style="display: none;">
                                    <div class="TypeDropOption" onclick="setType('General Complaint')"> General Complaint </div>
                                    <div class="TypeDropOption" onclick="setType('Direct Complaint')"> Direct Complaint </div>
                                </div>
                            </div>
                        </header>

                        
                        <!-- GENERAL COMPLAINT PAGE  -->
                        <div id="generalContent" class="contentBoth" style="display: none;">
                            <input type="hidden" id="GENComplainantUID" value="<?php echo $_SESSION['unique_id']?>">
                            <input type="hidden" id="GENComplainantName"   value="<?php echo $_SESSION['first_name'] . ' ' . (!empty($_SESSION['middle_name']) ? $_SESSION['middle_name'] . ' ' : '') . $_SESSION['last_name']; ?>">
                            <input type="hidden" id="GENComplainantAddress"   value="<?php echo 'Blk' . ' ' . $_SESSION['block'] . ' ' . 'Lot' . ' ' . $_SESSION['lot']; ?>">

                            <div class="GenComplainUser">
                                <label> Nature Of Complaint: </label>
                                <div class="dropdownInputGen">
                                    <input class="InputFiledGen" type="text" id="selectGenComplaintInput" readonly>
                                    <button class="BtnInputGendrop">
                                        <span class="ArrowDownGen"> &#9660; </span>
                                    </button>
                                    <div class="DropContentInputGen">
                                        <div onclick="selectGenComplaint('Noise Complaint')"> Noise Complaint </div>
                                        <div onclick="selectGenComplaint('Parking Problems')"> Parking Problems </div>
                                        <div onclick="selectGenComplaint('Pet Issues ')"> Pet Issues </div>
                                        <div onclick="selectGenComplaint('Property Maintenance')"> Property Maintenance </div>
                                        <div onclick="selectGenComplaint('Rule Violation')"> Rule Violation </div>
                                    </div>
                                </div>
                            </div>
                            <div class="DescripUserGen">
                                <label> Description: </label>
                                <textarea style="margin-left: 20px;" class="DescripUserGenn" id="DescriptionGen"></textarea>
                            </div>
                            <!-- Proof Section with Multiple Image Upload -->
                            <div class="GenComplainUser2">
                                <label> Proof: </label>
                                <div class="FileUploadWrapp">
                                    <div class="FileUploadCont">
                                        <input class="InputFileGen" type="file" id="ProofGen" accept=".jpg, .jpeg, .png" multiple> <!-- Allow multiple file selection -->
                                        <div class="FileUploadGen">
                                            <span class="plusIconGen">+ <br> Upload Pictures here... </br> </span>
                                        </div>
                                    </div>

                                    <!-- Image previews will appear here -->
                                    <div class="ImagePreviewCon"></div>
                                </div>

                                <!-- Display non-image file names here -->
                                <div id="fileListGenn"></div>
                            </div>

                            <!-- Submit Button -->
                            <footer class="footerUserSubGen">
                                <button class="submitUserGen" id="submitGen">Submit</button>
                            </footer>

                            <!-- Lightbox modal -->
                            <div class="lightboxGen">
                                <span class="LightBoxClose"> × </span>
                                <img class="LarawanContainer" id="lightboxImage" />
                            </div>
                        </div>




                        <!-- DIRECT COMPLAINT PAGE  -->
                        <div id="directContent" class="contentBoth" style="display: none;">
                            <!-- Direct Content goes here -->
                            <div class="ComplainUser">
                                <div>
                                    <label>Complainee Name:</label>
                                    <input class="inputUserComps2" type="text" id="Complainee">
                                </div>
                                <div>
                                    <label>Address:</label>
                                    <input class="inputUserComps2" type="text" id="ComplaineeAddress">
                                    <input class="inputUserComps2" type="hidden" id="ComplainantUID" value="<?php echo $_SESSION['unique_id']?>">
                                    <input class="inputUserComps2" type="hidden" id="ComplainantName"   value="<?php echo $_SESSION['first_name'] . ' ' . (!empty($_SESSION['middle_name']) ? $_SESSION['middle_name'] . ' ' : '') . $_SESSION['last_name']; ?>">
                                    <input class="inputUserComps2" type="hidden" id="ComplainantAddress"   value="<?php echo 'Blk' . ' ' . $_SESSION['block'] . ' ' . 'Lot' . ' ' . $_SESSION['lot']; ?>">
                                </div>
                            </div>
                            <div class="ComplainUser2">
                                <label>Nature Of Complaint:</label>
                                <div class="dropdownInput">
                                    <input type="text" id="selectedComplaint" class="dropdownInputField" placeholder="Select Complaint" readonly>
                                    <button class="dropbtnInput">
                                        <span class="arrowDown">&#9660;</span> <!-- Downward arrow -->
                                    </button>
                                    <div class="dropdownContentInput">
                                        <div onclick="selectComplaint('Noise Complaint')"> Noise Complaint </div>
                                        <div onclick="selectComplaint('Parking Problems ')"> Parking Problems </div>
                                        <div onclick="selectComplaint('Pet Issues')"> Pet Issues </div>
                                        <div onclick="selectComplaint('Property Maintenance')"> Property Maintenance </div>
                                        <div onclick="selectComplaint('Rule Violation')"> Rule Violation </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="DescriUser">
                                <label> Description: </label>
                                <textarea class="DescriptUsers" id="Description"></textarea>
                            </div>
                            <div class="ComplainUser3">
                                <label>Proof:</label>
                                <div class="file-upload-wrapper">
                                    <div class="file-upload-container">
                                        <input class="inputFile" type="file" id="Proof" accept=".jpg, .jpeg, .png" multiple>
                                        <div class="file-upload-btn">
                                            <span class="plus-icon">+ <br> Upload Pictures here... </br> </span>
                                        </div>
                                    </div>

                                    <!-- Image previews will appear here -->
                                    <div class="image-preview-container" id="imagePreviewContainer"></div>
                                </div>
                    
                                <!-- Display non-image file names here -->
                                <div id="fileList"></div>
                            </div>
                    
                            <!-- Submit Button -->
                            <footer class="footerUserSubmitt">
                                <button class="submittUserComp" id="Submit">Submit</button>
                            </footer>
                        </div>
                    
                        <!-- Lightbox modal -->
                        <div id="lightbox" class="lightbox">
                            <span id="closeLightbox" class="close-lightbox">×</span>
                            <img id="lightboxImage" class="lightbox-image" />
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/UserComplaints.js"></script>
</body>
</html>