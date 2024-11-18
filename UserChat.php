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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="mainCoversationChatContainer">
        <div class="secMainDash">
            <div class="headerTop">
                <div class="leftSection">
                    <img class="menu" src="Pictures/menu-hamburger.png">
                    <img class="img-logo" src="Pictures/Dasma_City_Logo.png">
                    <!-- <h2> Mabuhay Homes 2000 </h2> -->
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
                <a href="UserAnnounce.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
                </a>
                <a href="UserRequest.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Request2.png">
                    <span> Online Request </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                    <span> Complaints </span>
                </a>
                <a href="UserChat.php?user_id=<?php echo $encoded_id?>" id="chatLink" class="sideside" >
                    <img class="img-sideboard" src="Pictures/Chat.png"> 
                    <span> Chat </span>
                </a>  
                <a href="UserPayments.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="Logout.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/logout.png">
                    <span> Logout </span>
                </a>
            </div>

            <div class="UserChatContainerr">
                <!-- <div class="UserChatSidebar">                         
                    <div class="UserChatSidebarTitle"> Chats </div>
                    <form action="#" class="UserChatSidebarForm">
                        <input type="search" class="UserchatSidebarInput sertslist" placeholder="Search...">
                        <button type="submit" class="UserChatSubmit">
                            <img class="UserChatSearch" src="Pictures/search.png">
                        </button>
                    </form>
                    <div class="UsertMessages">
                        <ul class="UserMessagesList">
                            <li class="UserMessageTitle"> 
                                <span> Recently </span>
                            </li>
                            <li class="activee userslisto">
                                
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div class="conChatConversation">
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
                        <div class="mgaPipindutin">
                            <button type="button">
                                <img class="imgPhone" src="Pictures/PhoneCall.png">
                            </button>
                            <button type="button">
                                <img class="imgPhone" src="Pictures/videoCall.png">
                            </button> 
                            <button type="button">
                                <img class="imgPhone" src="Pictures/info.png">
                            </button> 
                        </div>
                    </div>
                    <div class="containerChat">
                        <div class="messenger-container chatbaks2">
                            <div id="message-display" class="message-display chatbaks contentDiv istap">
                                <ul class="chatRaps">
                                    <li class="dividerngKatawan">
                                        <span> Today </span>
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

    <script src="JS/SendMsg.js"></script>
</body>
</html>