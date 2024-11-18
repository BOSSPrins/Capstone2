<?php
include_once "Connect/Connection.php";
session_start();
$conn = connection();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'user') {
        header("Location: LoginPage.php");
        exit();
    }
  } else {
    header("Location: LoginPage.php");
    exit();
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['unique_id'])) {
    $unique_id = $_POST['unique_id'];

    // Check if today is the 3rd day of the month
    // if (date('j') == 8) {

    //     error_log("PHP Script executed on the 3rd day of the month.");
    //     // Fetch the current pending amount
    //     $sql = "SELECT pending FROM payments WHERE unique_id = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("s", $unique_id);
    //     $stmt->execute();
    //      $result = $stmt->get_result();                                                 // di pa okay to kasi nauulit yung +200 na Mdue
    //     $currentRow = $result->fetch_assoc();
    //     $old_pending = $currentRow['pending'];

    //     // Add 200 to the pending amount
    //     $new_pending = $old_pending + 200;

    //     // Update the pending amount in the payments table
    //     $updatePendingSQL = "UPDATE payments SET pending = ? WHERE unique_id = ?";
    //     $updateStmt = $conn->prepare($updatePendingSQL);
    //     $updateStmt->bind_param("ds", $new_pending, $unique_id);
    //     $updateStmt->execute();

    //     error_log("Pending amount increased by 200.");
    //     // Insert the change into the history table
    //     $currentDate = date('Y-m-d H:i:s');
    //     $historySQL = "INSERT INTO payment_history (unique_id, old_pending, new_pending, changed_at) VALUES (?, ?, ?, ?)";
    //     $historyStmt = $conn->prepare($historySQL);
    //     $historyStmt->bind_param("sdds", $unique_id, $old_pending, $new_pending, $currentDate);
    //     $historyStmt->execute();
    // }

    // Fetch the current total pending amount
    $sql = "SELECT SUM(pending) AS total_pending FROM payments WHERE unique_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $unique_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_pending = $row['total_pending'];

    // Calculate the new status
    $status = ($total_pending > 600) ? 'Delinquent' : 'Good Standing';

    // Update the status in the tblresident table
    $updateStatusSQL = "UPDATE payments SET status = ? WHERE unique_id = ?";
    $updateStmt = $conn->prepare($updateStatusSQL);
    $updateStmt->bind_param("ss", $status, $unique_id);
    $updateStmt->execute();

    // Fetch the updated data
    $sql = "SELECT tblresident.*, payments.* 
            FROM tblresident 
            INNER JOIN payments ON tblresident.unique_id = payments.unique_id 
            WHERE tblresident.unique_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $unique_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Return the updated row data as JSON
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No record found with unique ID: " . $unique_id]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Mabuhay Website </title>
  <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
  <link rel="stylesheet" href="CSS/Payments.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
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

    <div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="headerTop">
                <div class="leftSection">
                    <img class="menu" src="Pictures/menu-hamburger.png">
                    <img class="img-logo" src="Pictures/Dasma_City_Logo.png">
                    <h2> Mabuhay Homes 2000 </h2>
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
                <a href="DashBoard.php" class="sideside active">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="HoaOfficials.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Officials.png">
                    <span> HOA Officials </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Residents2.png">
                    <span> Residents </span>
                </a>
                <a href="Documents.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Documents2.png">
                    <span> Documents </span>
                </a>
                <!-- <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Request2.png">
                    <span> Online Request </span>
                </a> -->
                <div class="complaintsContainer">
                    <a href="#" class="sideside" id="complaintsDropdown">
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
                        <!-- <li> <a href="#"> Sub Menu 2 </a> </li>
                        <li> <a href="#"> Sub Menu 3 </a> </li> -->
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
                <a href="Payments.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="Logout.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/logout.png">
                    <span> Logout </span>
                </a>
            </div>

            <div class="MonthlyDuessContainerr MonthlyDuessConActivee">
                <div class="MonthlyTopNamePage">
                    <h1> Monthly Dues </h1>
                </div>
                <div class="MonthlyTableConTop">
                    <div class="MonthTable-container">
                        <div class="MonthSearchContainer">
                            <div class="searchFilterLeft">
                                
                            </div>
                            <div class="searchRight">
                                <label> Search: </label>
                            <input class="MonthSearchInputDes" type="search">
                            </div>
                        </div>

                        <div class="MonthluDueableContent">
                            <table>
                                <thead>
                                    <tr>
                                        <th> Resident's Name </th>
                                        <th> Address </th>
                                        <!-- <th> Paid </th> -->
                                        <th> Pending </th>
                                        <th> Status </th>
                                        <th colspan = "2"> Action </th>
                                    </tr>
                                    <!-- binago ko yung SUM ginawa kong total pending talaga yon -->
                                    <tbody>
                                        <?php 

                                                $sql = "SELECT tblresident.first_name, tblresident.middle_name, tblresident.last_name, 
                                                        tblresident.block, tblresident.lot, tblresident.unique_id, 
                                                        SUM(payments.total) AS total_pending,
                                                        CASE
                                                            WHEN SUM(payments.total) > 600 THEN 'Delinquent'
                                                            ELSE 'Good Standing'
                                                        END AS status
                                                        FROM tblresident 
                                                INNER JOIN payments ON tblresident.unique_id = payments.unique_id
                                                WHERE tblresident.unique_id IS NOT NULL AND tblresident.unique_id != ''  -- Filter out empty unique_id
                                                GROUP BY tblresident.unique_id, tblresident.first_name, tblresident.middle_name, tblresident.last_name, tblresident.block, tblresident.lot
                                                ORDER BY CASE 
                                                    WHEN SUM(payments.total) > 600 THEN 1
                                                    ELSE 2
                                                END";
                                                $result = $conn->query($sql);
                                            while ($row = $result->fetch_assoc()) {
                                                 $statusClass = '';
                                            switch ($row['status']) {
                                                case 'Delinquent':
                                                $statusClass = 'status-delinquent';
                                                break;
                                            case 'Good Standing':
                                                $statusClass = 'status-good-standing';
                                                break;
                                            default:
                                                $statusClass = '';
                                                break;
                                            }
                                            
                                    
                                        echo "<tr class='{$statusClass}'>";
                                        echo "<td>{$row['first_name']} {$row['middle_name']} {$row['last_name']}</td>";           
                                        echo "<td>Block {$row['block']} Lot {$row['lot']} </td>";
                                        echo "<td> ₱ {$row['total_pending']}</td>";
                                        echo "<td> {$row['status']}</td>";
                                        echo "<td>";
                                        echo "<button class='MontViewBtn MonthTb-btn' onclick=\"handleActionClick(this)\">View</button>";
                                        echo "<input type='hidden' value='{$row['unique_id']}'>";
                                        echo "</td>";                                     
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </thead>
                            </table>

                            <div class="ModalForPayments">
                                <div class="SubModalSchedPay">
                                    <div class="PayingModalContainer">
                                        <div class="CloseModalMonth">
                                            <span class="closeMonth">&times;</span>
                                        </div>
                                        <div class="PayingMonthlyContainer">
                                            
                                            <div class="ContentsSaMonthly">
                                                <form class="adminBayad">
                                                    <div class="DatesForPaying">
                                                        <div class="DueDatePay">
                                                            <label class="LabelDates"> Due Date:</label>
                                                            <input class="InputDates" type="date" id="Ddate" name="Ddate">
                                                        </div>
                                                        <!-- <div class="OverDuePay">
                                                            <label class="LabelDates"> Overdue:</label>
                                                            <input class="InputDates" type="date" id="Ovdate" name="Ovdate">
                                                        </div> -->
                                                    </div>
                                                    <div class="InputAmountsContainer">
                                                        <div class="InputAmounts">
                                                            <label class="LabelSend"> Monthly Due Amount: </label>
                                                            <input class="InputAm" type="number" id="MDue" name="MDue"step="0.01" min="0" placeholder="0.00">
                                                        </div>
                                                        <div class="InputAmounts">
                                                            <label class="LabelSend"> Water Bill Amount: </label>
                                                            <input class="InputAm" type="number" id="WBill" name="WBill" step="0.01" min="0" placeholder="0.00">
                                                        </div>
                                                        <div class="InputAmounts">
                                                            <label class="LabelSend"> Total Amount: </label>
                                                            <input class="InputAm" type="text" id="totalAmount" name="totalAmount" readonly >
                                                        </div>
                                                        <input type="text" name="UID" id="UID" hidden>
                                                    </div>
                                                    <div class="SendButtonToUser">
                                                        <button class="SBtnMont SendBtn"> Send </button>
                                                    </div>
                                                </form>
                                            </div>                                          
                                            <div class="TableParaSaUserPaid">
                                                <div class="subTablePaid">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th> Paid Amount </th>
                                                                <th> Date </th>
                                                                <th> Action </th>
                                                            </tr>
                                                                <?php 
                                                                
                                                                $query = "SELECT * FROM payments";
                                                                $result = mysqli_query($conn, $query);

                                                            if($result){
                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                               
                                                                ?>
                                                                
                                                            <tbody>
                                                                <tr>
                                                                    <td class="unique_id" hidden><?php echo $row['unique_id'] ?></td>
                                                                    <td><?php echo "₱ " . number_format($row['money'], 2) ?></td>
                                                                    <td><?php echo date('F j, Y', strtotime($row['paydate'])); ?></td>
                                                                    <td> 
                                                                         <button class="TbPaid viewBOTON"> View </button>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                } else {
                                                                ?>
                                                                    <tr>
                                                                        <td colspan="3">No data found.</td>
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

                            <div class="ModalForConfirming" id="SikandModal">
                                <div class="subModalConfirming">
                                    <div class="ViewingOfPaidUser">
                                        <form class="SikanModal" enctype="multipart/form-data" method="post">
                                            <div class="CloseModalTwo">
                                                <span class="closeMonthTwo">&times;</span>
                                            </div>
                                            <div class="PaymentFromUser">
                                                <div class="AmountPay">
                                                    <label class="LabelNames"> Payment: </label>
                                                    <input class="InputPayFromUser int" type="number" id="userBayad" name="userBayad" step="0.01" min="0">
                                                </div>
                                                <div class="ProofPic">
                                                    <div class="ProofTop">
                                                        <label class="LabelNames"> Proof Of Payment: </label>
                                                    </div>
                                                    <div class="PictureUpl">
                                                        <img src="Pictures/GCash-MyQR-07062024130428.PNG.jpg" id="userPic" name="userPic">
                                                    </div>
                                                </div>
                                                <div class="BottomRef">
                                                    <div class="RefNo">
                                                        <label class="LabelNames"> Reference No. </label> <input type="text"  id="secUID" hidden> 
                                                        <input type="number"  id="totals" hidden>
                                                        <input class="int" type="text" id="userRefer" name="userRefer">
                                                    </div>
                                                    <div class="buttonP">            
                                                        <button type="submit" class="btnPaid SabmitBtn"> Accept </button>
                                                    </div>
                                                </div>
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
    </div>

    <script src="JS/Payments.js"></script>

    <script>
            function handleActionClick(button) {
        // Get the unique ID from the hidden input element
        var uniqueId = button.nextElementSibling.value;
        // Perform your desired action with the unique ID
        console.log("Unique ID:", uniqueId);
        document.getElementById('UID').value = uniqueId;
        
        // Set the due date to the 3rd day of the current month
        var currentDate = new Date();
        currentDate.setDate(3); // Set to the 3rd day of the month
        var formattedDate = currentDate.toISOString().split('T')[0];
        document.getElementById('Ddate').value = formattedDate;
        
        // Example: Make an AJAX call to send the unique ID to the PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true); // "" to send the request to the same page
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server
                console.log(xhr.responseText);
                // Optionally, you could parse the JSON response and display it in the page
                var response = JSON.parse(xhr.responseText);
                if (response.error) {
                    alert(response.error);
                } else {
                     console.log("First Name: " + response.first_name + "\nLast Name: " + response.last_name); 
                }
            }
        };
        xhr.send("unique_id=" + encodeURIComponent(uniqueId));
    }


        function startDailyInterva() {
        // Check if the interval has already been started today
        var intervalStartedToday = localStorage.getItem('intervalStartedToday');
        if (!intervalStartedToday) {
            // Calculate the milliseconds until the next day
            var now = new Date();
            var tomorrow = new Date(now);
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setHours(0, 0, 0, 0);
            var millisecondsUntilNextDay = tomorrow - now;

            // Start the interval
            setInterval(function() {
                console.log("Interval function executed.");
                // Perform your desired action here
            }, millisecondsUntilNextDay);

            // Set a flag indicating that the interval has been started today
            localStorage.setItem('intervalStartedToday', true);
        }
    }

    // Start the daily interval when the page is fully loaded
    // window.addEventListener("load", startDailyInterval);
</script>
</body>
</html>