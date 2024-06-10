<?php 
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'admin') {
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
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/UserAnnounce.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="mainDashboardContainer">
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
                <a href="UserChat.php?user_id=<?php echo $encoded_id?>" class="sideside">
                    <img class="img-sideboard" src="Pictures/Chat.png">
                    <span> Chat </span>
                </a>   
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

            <div class="UserSidehContainerr">
                <div class="announcementFeed">
                    <div class="postingAnnouncementFeed">
                        <div class="NameandPicture">
                            <div class="pictureSaposting">
                                <img class="pictureNagPost" src="Pictures/Dasma_City_Logo.png">
                            </div>
                            <div class="PangalanSaPosting">
                                <label class="LabelNamePost"> HOA Admin </label>
                            </div>
                        </div>

                        <?php 
                        
                        if ($encoded_id) {
                           
                            
                        }
                        
                        ?>
                        <div class="PostingAnnouncemntPost">
                            <div id="containerForPostNa">
                                <div class="TitlePostedNaUser">
                                    <h2> Prince Cervantes </h2>
                                </div>
                                <div class="ditoMapupuntaYungPostTextWrapper">
                                    <p class="ditoMapupuntaYungPostText">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                        Error in illum facere non repudiandae magni id, numquam ducimus dolor.\
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                        Blanditiis aut eveniet facere voluptatem nemo, voluptatibus est 
                                        harum ab debitis ipsam ullam reiciendis id at? Velit doloribus 
                                        officia quidem quia ut.
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                        Blanditiis aut eveniet facere voluptatem nemo, voluptatibus est 
                                        harum ab debitis ipsam ullam reiciendis id at? Velit doloribus 
                                        officia quidem quia ut.
                                        <!-- Your long paragraph content here -->
                                    </p>
                                    <span id="spanForSeeMoreandSeeless">See more</span>
                                </div>
                            </div>
                        </div>
                        <div class="ImagesInSlidingPosted">
                            <img src="Pictures/sample_pic.png" alt="Image 1">
                            <img src="Pictures/Female2.png" alt="Image 2">
                            <img src="Pictures/uppermoons.png" alt="Image 3">
                          
                            <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
                            <a class="next" onclick="changeSlide(1)">&#10095;</a>
                          
                            <div class="indicator">
                              <span class="dot" onclick="currentSlide(1)"></span>
                              <span class="dot" onclick="currentSlide(2)"></span>
                              <span class="dot" onclick="currentSlide(3)"></span>
                            </div>
                          </div>                 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/UserAnnounce.js"></script>
</body>
</html>