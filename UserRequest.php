<?php 
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
  if ($_SESSION['role'] == 'admin') {
      header("Location: LoginPage.php");
      exit();
  }
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
    <link rel="stylesheet" href="CSS/UserRequest.css">
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
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="Logout.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/logout.png">
                    <span> Logout </span>
                </a>
            </div>

            <div class="UserSidehContainerr">
                <div class="UserTopNamePage">
                    <h1> Requesting Forms </h1>
                </div>

                <div class="eachConReqForm">
                    <div class="RequestingDocuCon">
                        <div class="ContainersNgRequestForms" onclick="FirstDocu()">
                            <div class="ModalForEachReqForm">
                                <div class="SubModalForEachReqForm">
                                    <div class="nasaLoobNgModalReq">
                                        <div class="ReqNamecloseContainer">
                                            <div class="ReqFormName">
                                                <h1>Certificate Modal </h1> <!--  (Name to ng Document na nirerequest) -->
                                            </div>
                                            <div class="ReqCloseContainer">
                                                <span class="ReqCertClose">&times;</span>
                                            </div>
                                        </div>
                                        <hr class="hrRequest">
                                        <div class="RequestInput">
                                            <label class="labelReq"> Full Name: </label>
                                            <input class="inputReq" type="text">
                                        </div>
                                        <div class="RequestInput">
                                            <label class="labelReq"> Address: </label>
                                            <input class="inputReq" type="text">
                                        </div>
                                        <div class="RequestInput">
                                            <label class="labelReq"> Purpose: </label>
                                            <input class="inputReq" type="text">
                                        </div>
                                        <div class="buttonsInRequest">
                                            <button class="cancelReqBtn RBtn">
                                                Cancel
                                            </button>
                                            <button class="submitReqtBtn RBtn">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ContainersNgRequestForms"> b </div>
                        <div class="ContainersNgRequestForms"> c </div>
                        <div class="ContainersNgRequestForms"> d </div>
                        <div class="ContainersNgRequestForms"> e </div>
                        <div class="ContainersNgRequestForms"> f </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <script src="JS/UserRequest.js"></script>
</body>
</html>