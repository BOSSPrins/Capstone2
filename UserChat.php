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

// Fetch the unique_id of an admin
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
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/UserChat.css">
    <script src="jQuery/jquery.min.js"></script>
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
                            <h2 class="namePerModule"> Chat </h2>
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
                    <div class="MainContainerAll">
                        <div class="TopngConversation contentDiv">
                            <?php                                
                                // Check if 'user_id' parameter is present in the URL
                                if(isset($_GET['user_id'])) {
                                    // Escape and retrieve user_id from the URL
                                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                                    
                                    // Perform the query
                                    $sql = mysqli_query($conn, "SELECT tblaccounts.unique_id, tblaccounts.user_id, tblaccounts.status, tblaccounts.role
                                    FROM tblaccounts
                                    INNER JOIN tblresident ON tblaccounts.unique_id = tblresident.unique_id
                                    WHERE tblaccounts.unique_id ='" . $user_id . "' AND tblaccounts.role = 'admin'");
                                    
                                    // Check if rows were returned
                                    if(mysqli_num_rows($sql) > 0){
                                        $row = mysqli_fetch_assoc($sql);
                                        $offline = ($row['status'] == "Offline now") ? "offline" : "online";
                                        // Now you can use $row to access the data from the database
                                    } else {
                                        // Handle the case where no rows are returned
                                        echo "No user found with ID: " . $user_id;
                                    }
                                } else {
                                    // Handle the case where 'user_id' parameter is not present in the URL
                                    echo "User ID parameter is missing in the URL.";
                                }
                            ?>
                            <button type="button" class="conversationBack">
                                <img class="img-kaliwa" src="Pictures/arrowLeft.png">
                            </button>
                            <div class="mgaKausap IntervalStats">
                                <img class="mgaKausapImages" src="Pictures/Dasma_City_Logo.png">
                                <div>
                                    <div class="mgaKausapNames"> HOA Admin </div>
                                    <div class="mgaKausapStatus <?php echo $offline ?>"> <?php echo $row['status'] ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="containerChat">
                            <div class="messenger-container chatbaks2">
                                <div id="message-display" class="message-display chatbaks contentDiv istap">
                                    <ul class="chatRaps">
                                        <li class="dividerngKatawan">
                                            
                                        </li>                        
                                    </ul>
                                </div>
                                <form action="" class="typing-area">
                                    <div class="input-container contentDiv">
                                        <button id="send-btn" class="send-btn">
                                            <img class="imgSendImg-btn" src="Pictures/send-image.png">
                                        </button>
                                        <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                                        <input type="text" name="incoming_id" value="<?php echo $user_id ; ?>" hidden>
                                        <textarea id="message-input" name="message" rows="1" class="UserMessageInput input-field " placeholder="Type your message..."></textarea>
                                        <button id="UserSendBtn" class="UserSendBtn sendbtn ">
                                            <img class="UserImgSend-btn" src="Pictures/Send.png">
                                        </button>
                                    </div>
                                </form>
                            </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/SendMsg.js"></script>
</body>
</html>