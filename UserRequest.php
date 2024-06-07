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

//Mga session para sa request 
$res_userID  = $_SESSION['res_userID'];
$acc_userID  = $_SESSION['acc_userID']; 
$block       = $_SESSION['block']; 
$first_name  = $_SESSION['first_name']; 
$middle_name = $_SESSION['middle_name']; 
$last_name   = $_SESSION['last_name']; 
$block       = $_SESSION['block']; 
$lot         = $_SESSION['lot']; 

function getUserNameFromDatabase($res_userID) {
    $conn = connection(); // Establish database connection

    // Your SQL query to select the user's name from the tblresident table
     $query = " SELECT tblresident.*
                FROM tblresident
                INNER JOIN tblaccounts ON tblresident.user_id = tblaccounts.user_id
                WHERE tblaccounts.user_id = $res_userID";

    
    $result = mysqli_query($conn, $query);

    
    if ($result && mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_assoc($result);
        // Return the user's name
        $firstName = $row['first_name']; 
        $midName = $row['middle_name']; 
        $lastName = $row['last_name'];
        $block = $row['block'];  
        $lot = $row['lot'];
        return array('first_name' => $firstName, 'middle_name' => $midName, 'last_name' =>  $lastName, 'block' => $block, 'lot' => $lot);
    } else {
        // If the query fails or no results found, return a default name and address
        return array('firstName' => 'Default Fname', 'midName' => 'Default Midname', 'lastName' => 'Default Lname', 'block' => 'Default block', 'lot' => 'Default lot');
    }
}

// Get the user's name from the database
$userData = getUserNameFromDatabase($res_userID);

// Store the user's name in the session variable
$_SESSION['Fname'] = $userData['first_name'];
$_SESSION['Mname'] = $userData['middle_name'];
$_SESSION['Lname'] = $userData['last_name'];
$_SESSION['block'] = $userData['block'];
$_SESSION['lot'] = $userData['lot'];

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
                <div class="UserTopNamePage">
                    <h1> Requesting Forms </h1>
                </div>

                <div class="eachConReqForm">
                    <div class="RequestingDocuCon">
                        <div class="ContainersNgRequestForms" onclick="FirstDocu()" >
                            <div class="ModalForEachReqForm">
                                <div class="SubModalForEachReqForm">
                                    <form action="PHPBackend/UserFormReq.php" method="post">
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
                                                <input type="text" id="MubAwt" name="MubAwt" value="Move Out" hidden>
                                                <input type="text" id="Stats" name="Stats" value="Pending" hidden>

                                                <label class="labelReq"> First Name: </label>
                                                    <input class="inputReq" type="text" id="Fname" name="Fname" value="<?php echo $_SESSION['Fname'];?>">

                                                <label class="labelReq"> Middle Name: </label>
                                                    <input class="inputReq" type="text" id="Mname" name="Mname" value="<?php echo $_SESSION['Mname'];?>">

                                                <label class="labelReq"> Last Name: </label>
                                                    <input class="inputReq" type="text" id="Lname" name="Lname" value="<?php echo $_SESSION['Lname'];?>">
                                            </div>
                                            <div class="RequestInput">
                                                <label class="labelReq"> Block: </label>
                                                <input class="inputReq" type="text" id="block" name="block" value="<?php echo $_SESSION['block'];?>">
                                                <label class="labelReq"> Lot: </label>
                                                <input class="inputReq" type="text" id="lot" name="lot" value="<?php echo $_SESSION['lot'];?>">
                                            </div>
                                            <!-- <div class="RequestInput">
                                                <label class="labelReq"> Purpose: </label>
                                                <input class="inputReq" type="text">
                                            </div> -->
                                            <div class="buttonsInRequest">
                                                <button class="cancelReqBtn RBtn">
                                                    Cancel
                                                </button>
                                                <button class="submitReqtBtn RBtn" type="submit">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
                <div class="TableParaSaReq">
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
                                                <th> Form Type </th>
                                                <th hidden> Address </th>
                                                <th> Status </th>
                                            </tr>
                        
                                            <tbody>
                                                <?php    
                                                    $query = "SELECT tblresident.first_name, tblresident.middle_name, tblresident.last_name,
                                                    forms.form_name, forms.block, forms.lot, forms.status, forms.forms_id
                                                    FROM tblresident 
                                                    JOIN forms   ON tblresident.first_name = forms.first_name
                                                                AND tblresident.middle_name = forms.middle_name
                                                                AND tblresident.last_name = forms.last_name; ";
                                                   
                                                  
                                                  
                                                  $result = mysqli_query($conn, $query);

                                                if($result){
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                   
                                                        $backgroundColor = '';
                                                        $textColor = 'black';
                                                        if ($row['status'] == 'Pending' || $row['status'] == 'Verifying') {
                                                            $backgroundColor = 'background-color: #FFFF99;';
                                                        } else if ($row['status'] == 'Ready to Pick Up') {
                                                            $backgroundColor = 'background-color: #66CC66;';
                                                            $textColor = 'color: black;';
                                                        }
                                                        // echo "Status: " . $row['status'] . " - Background color: " . $backgroundColor . " - Text color: " . $textColor . "<br>";
                                                ?>
                                                <tr>
                                                    <td class="forms_id" hidden><?php echo $row['forms_id'] ?></td>
                                                    <td><?php echo $row['form_name']; ?></td>
                                                    <td hidden><?php echo "Block " . $row['block'] . " Lot " . $row['lot'] ?></td>
                                                    <td hidden><?php echo $row['status']; ?></td>
                                                    <td>
                                                        <span style=" padding: 5px 10px; border-radius: 5px; <?php echo $backgroundColor;?> <?php echo $textColor; ?>"><?php echo $row['status']; ?> </span> 
                                                    </td>
                                                </tr>
                                                <?php
                                                        }
                                                    } else {
                                                    ?>
                                                        <tr>
                                                            <td colspan="2">No data found.</td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    } else {
                                                        echo "Query failed: " . mysqli_error($conn);
                                                    }    
                                    
                                                mysqli_close($conn);
                                                ?>
                                            </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

    <script src="JS/UserRequest.js"></script>
</body>
</html>