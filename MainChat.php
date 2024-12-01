<?php 
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'user' || $_SESSION['role'] == 'barangay') {
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
    <link rel="stylesheet" href="CSS/Chat.css">
    <script src="jQuery/jquery.min.js"></script>
</head>
<body>
    <div class="mainCoversationChatContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 <br> Phase 5 </h2>
                </div>
                <div class="DagdagNanaman">
                    <a href="DashBoard.php" class="sideside">
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
                                    <label class="sub-spa"> In-Process </label>
                                </a>
                                <a href="#">
                                    <img class="img-subMenu" src="">
                                    <label class="sub-spa"> Release </label>
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

                    <a href="AnnouncementTable.php" class="sideside">
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
                        <div class="chatContentSidebar">
                                <?php 
                                include_once "Connect/Connection.php";
                                $sql = mysqli_query($conn, "SELECT tblaccounts.unique_id, tblresident.first_name, tblresident.last_name
                                                            FROM tblaccounts
                                                            INNER JOIN tblresident ON tblaccounts.unique_id = tblresident.unique_id
                                                            WHERE tblaccounts.unique_id = '{$_SESSION['unique_id']}';");
                                                            
                                if(mysqli_num_rows($sql) > 0){
                                    $row = mysqli_fetch_assoc($sql);
                                }
                                ?> 
                            <form action="#">
                                <div class="SeachingChat">
                                    <input type="search" class="chatContentSidebarInput sertslist" placeholder="Search...">
                                    <button type="submit" class="chatContentSubmit">
                                        <img class="chatSearch" src="Pictures/search.png">
                                    </button>
                                </div>
                            </form>

                            <div class="contentMessages">
                                <ul class="messagesList">
                                    <li class="activee userslisto">
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="conChatConversation">
                            <div class="TopngConversation contentDiv">
                                    <?php 
                                        include_once "Connect/Connection.php";
                                        
                                        // Check if 'user_id' parameter is present in the URL
                                        if(isset($_GET['user_id'])) {
                                            // Escape and retrieve user_id from the URL
                                            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                                            
                                            // Perform the query
                                            $sql = mysqli_query($conn, "SELECT tblaccounts.unique_id, tblaccounts.img,  tblaccounts.status, 
                                                                                tblresident.first_name, tblresident.last_name
                                                                        FROM tblaccounts
                                                                        INNER JOIN tblresident ON tblaccounts.unique_id = tblresident.unique_id
                                                                        WHERE tblaccounts.unique_id ='" . $user_id . "'");
                                            
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
                                    <img class="mgaKausapImages" src="Pictures/<?php echo $row['img']; ?>">
                                    <div>
                                        <div class="mgaKausapNames"> <?php echo $row['first_name'] ." ". $row['last_name']?> </div>
                                        <div class="mgaKausapStatus <?php echo $offline ?>"> <?php echo $row['status'] ?> </div>
                                    </div>
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
                                            <textarea id="message-input" name="message" rows="1" class="message-input input-field " placeholder="Type your message..."></textarea>
                                            <button id="send-btn" class="send-btn sendbtn ">
                                                <img class="imgSend-btn" src="Pictures/Send.png">
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
    
    <script>
    function hideDivIfNoID() {
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('user_id');

   
        if (id === null) {
            var contentDivs = document.querySelectorAll('.contentDiv');
            contentDivs.forEach(function(div) {         // Hide the divs with class "contentDiv" kapag walang id sa URL
                div.style.display = 'none';
            });
        }
    }

    hideDivIfNoID();

    </script>

    <script src="JS/Chat.js"></script>
    <script src="JS/SendMsg.js"></script>
    <script src="JS/checkSessionStatus.js"></script>
</body>
</html>