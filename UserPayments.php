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

$uniks_id = $_SESSION['unique_id'];

$sql = "SELECT water_bill, month_due FROM payments WHERE unique_id = '$uniks_id'"; // Replace <condition> with your actual condition
$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch the row as an associative array
    $row = mysqli_fetch_assoc($result);
    
    // Assign values to variables
    $waterBill = $row['water_bill'];
    $monthDue = $row['month_due'];
} else {
    // Handle query error
    echo "Error: " . mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/UserPayments.css">
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
                <div class="MonthluDueNav">
                     <a  href="#" onclick="toggleContent('Payments')"> Payments </a>   
                    <a href="#" onclick="toggleContent('History')"> History </a>
                </div>
                <div id="Payments" class="EachContentsMonth">
                    <div class="PaymentandTableCon">
                        <div class="MonthlyDueableInUser">
                            <table>
                                <thead>
                                    <tr>
                                        <th> Monthly Due <br>
                                            Amount </th>
                                        <th> Water Bill <br>
                                            Amount </th>
                                        <th> Due Date </th>
                                        <th> Status </th>
                                    </tr>
                
                                    <tbody>

                                    <?php

                                        $query = "SELECT tblresident.*, payments.*
                                        FROM tblresident 
                                        INNER JOIN payments ON tblresident.unique_id = payments.unique_id
                                        WHERE payments.unique_id IS NOT NULL AND payments.unique_id != ''";
                                  
                                      $result = mysqli_query($conn, $query);

                                      if($result){
                                      if (mysqli_num_rows($result) > 0) {
                                          while ($row = mysqli_fetch_assoc($result)) {

                                    ?>

                                        <tr>
                                            <td class="due_id" hidden><?php echo $row['due_id'] ?></td>
                                            <td> <?php echo "₱ " . number_format($row['month_due'], 2) ?> </td>
                                            <td> <?php echo "₱ " . number_format($row['water_bill'], 2) ?> </td>
                                            <td> <?php echo date('F j, Y', strtotime($row['due_date'])); ?> </td>
                                            <td> <?php echo $row['status'] ?> </td>
                                        </tr>
                                        <?php
                                            }
                                            } else {
                                            ?>
                                                <tr>
                                                    <td colspan="4">No data found.</td>
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
                        <div class="PaymentContainerrr" id="bayadModal">
                            <div class="SubPaymentConss">
                                <form class="userbayad" enctype="multipart/form-data" method="post">
                                  <div class="totalInputUser">
                                      <label class="LabelUserPay"> Total Amounts: </label>
                                      <input class="intUser" type="number" step="0.01" name="total" id="total" value="<?php echo number_format($waterBill + $monthDue, 2); ?>" readonly>
                                  </div>
                                  <div class="PayyInputUser">
                                      <label class="LabelUserPay"> Pay: </label>
                                      <input class="intUser" type="number" name="pay" id="pay" step="0.01" min="0" placeholder="0.00">
                                      <input type="text" name="UID" id="UID" value="<?php echo $_SESSION['unique_id'] ?>" hidden>
                                      <input type="text" name="paydate" id="paydate" value="<?php echo date('Y-m-d H:i:s'); ?>" hidden>
                                  </div>
                                  <div class="ProofPicture">
                                      <label class="LabelUserPay"> Proof of Payment: </label>
                                      <input class="intUserrPic" type="file" onchange="previewImage(event)" name="proof" id="proof">
                                      <img id="preview" src="#" name="preview" alt="Preview" style="width: 100%; max-height: 700px; margin-top: 10px; display: none;">
                                  </div>
                                  <div class="ButtonProcess">
                                      <button type="submit" class="ProcessBtn" id="sabmitBoton"> Process Payment </button>
                                  </div>
                                </form>             
                            </div>
                        </div>
                    </div>
                </div>
                  
                <div id="History" class="EachContentsMonth">
                    <h2>History</h2>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/UserPayments.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector(".userbayad"),
            submitButton = document.getElementById("sabmitBoton");

            if (form) {
                form.onsubmit = (e) => {
                    e.preventDefault();
                };
            }

            if (submitButton) {
                submitButton.onclick = () => {
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST", "PHPBackend/PayProcess.php", true);
                    xhr.onload = () => {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                try {
                                    let jsonData = JSON.parse(xhr.responseText.trim()); // Trim any extra spaces
                                    if (jsonData.success) {
                                        console.log("Payment updated successfully");
                                        alert("Payment updated successfully");
                                        
                                        location.reload();
                                        form.reset();
                                    } else {
                                        console.error("Error:", jsonData.error);
                                        alert("Error: " + jsonData.error);
                                    }
                                } catch (error) {
                                    console.error("Error parsing response:", error);
                                    console.error("Response received:", xhr.responseText);
                                    alert("An error occurred while processing the responseeee.");
                                }
                            } else {
                                console.error("Server responded with status:", xhr.status);
                                alert("Server error: " + xhr.status);
                            }
                        }
                    };
                    let formData = new FormData(form);
                    formData.append('action', 'updatePayment');
                    xhr.send(formData);
                };
            }
        });
</script>
</body>
</html>