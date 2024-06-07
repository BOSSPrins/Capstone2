<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
  if ($_SESSION['role'] == 'user') {
      header("Location: LoginPage.php");
      exit();
  }
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
                                        <th> Action </th>
                                    </tr>
                
                                    <tbody>
                                        
                                        <tr>
                                            <td> Prince Jefferson P. Cervantes </td>
                                            <td> Blk 02 Lot 23 </td>
                                            <!-- <td> ₱ 200</td> -->
                                            <td> ₱ 230 </td>
                                            <td>
                                                <span class="MonthlyDueTableBtn MonthTb-btn"> Completed </span>
                                            </td>
                                            <td>
                                                <button class="MontViewBtn MonthTb-btn"> View </button>
                                            </td>
                                        </tr>
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
                                                        <div class="OverDuePay">
                                                            <label class="LabelDates"> Overdue:</label>
                                                            <input class="InputDates" type="date" id="Ovdate" name="Ovdate">
                                                        </div>
                                                    </div>
                                                    <div class="InputAmountsContainer">
                                                        <div class="InputAmounts">
                                                            <label class="LabelSend"> Monthly Due Amount: </label>
                                                            <input class="InputAm" type="text" id="MDue" name="MDue">
                                                        </div>
                                                        <div class="InputAmounts">
                                                            <label class="LabelSend"> Water Bill Amount: </label>
                                                            <input class="InputAm" type="text" id="WBill" name="WBill">
                                                        </div>
                                                        <div class="InputAmounts">
                                                            <label class="LabelSend"> Total Amount: </label>
                                                            <input class="InputAm" type="text" id="totalAmount" name readonly >
                                                        </div>
                                                        <input type="text" name="UID" id="UID" value="<?php echo $_SESSION['unique_id']?>">
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
    
                                                            <tbody>
                                                                <tr>
                                                                    <td> ₱ 200 </td>
                                                                    <td> Feb. 02, 2024 </td>
                                                                    <td> 
                                                                         <button class="TbPaid"> View </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ModalForConfirming">
                                <div class="subModalConfirming">
                                    <div class="ViewingOfPaidUser">
                                        <div class="CloseModalTwo">
                                            <span class="closeMonthTwo">&times;</span>
                                        </div>
                                        <div class="PaymentFromUser">
                                            <div class="AmountPay">
                                                <label class="LabelNames"> Payment: </label>
                                                <input class="InputPayFromUser int" type="text">
                                            </div>
                                            <div class="ProofPic">
                                                <div class="ProofTop">
                                                    <label class="LabelNames"> Proof Of Payment: </label>
                                                </div>
                                                <div class="PictureUpl">
                                                    <img src="Pictures/sample gcash.png">
                                                </div>
                                            </div>
                                            <div class="BottomRef">
                                                <div class="RefNo">
                                                    <label class="LabelNames"> Reference No. </label>
                                                    <input class="int" type="text">
                                                </div>
                                                <div class="buttonP">
                                                    <button class="btnPaid"> Accept </button>
                                                </div>
                                            </div>
                                        </div>
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
</body>
</html>