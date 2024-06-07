<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
  if ($_SESSION['role'] == 'user') {
      header("Location: LoginPage.php");
      exit();
  }
}
$conn = connection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/Accounts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="ConfirmModalIto" id="confirmModal">
        <div class="subConfirmModalContent">
            <div class="confirmModalContent">
                <input type="text" id="conf_userID" class="confirm_userID" hidden>
                <div class="confirmText">
                    <img class="confirmImg" src="Pictures/success.png">
                    <h2 class="paragConfirm">Are you sure you want to confirm this?</h2>
                </div>
                <hr class="hrConfirm"> 
                <div class="confirmButtons">
                    <button class="buttonConfirm cancelButn" id="klowsmodal" onclick="closeModal()">Cancel</button>
                    <button class="buttonConfirm confirmButn ConfirmSaModal">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!-- eto namang sa taas modal ng confirm -->

    <!-- View modal to -->
    <div class="containerNgEditModal" id="Accs_Edit_Modal">
        <div class="subContainerEditModal">
            <div class="editItongmodal">
                <div class="titleHeaderEdit">
                    <h2 id="modal_title"> Resident's Information </h2>
                    <input type="text" id="userID" hidden>
                    <span class="closeEditModal" id="Accs_Close_Modal">&times;</span>
                </div>
                <hr>
                <form class="edit-form">
                    <div class="header-row">
                        <h4> Profile </h4>
                    </div>
                    <div class="row">
                        <div class="inputbox-edit">
                            <label> Last Name: </label>
                            <input class="inputngEditModalTo" type="text" id="Lname" name="lastName">
                        </div>
                        <div class="inputbox-edit">
                            <label> First Name: </label>
                            <input class="inputngEditModalTo" type="text" id="Fname" name="firstName">
                        </div>
                        <div class="inputbox-edit">
                            <label> Middle Name: </label>
                            <input class="inputngEditModalTo"  type="text" id="Mname" name="middleName">
                        </div>
                    </div>
                    <div class="row1">
                        <div class="inputbox-edit">
                            <label> Age: </label>
                            <input class="inputngEditModalTo"  type="text" id="Age" name="birthday">
                        </div>
                        <!-- <div class="inputbox-edit">
                            <label> Place Of Birth: </label>
                            <input class="inputngEditModalTo"  type="text" id="Bplace" name="birthplace">
                        </div> -->
                        <div class="inputbox-edit">
                            <label> Contact Number: </label>
                            <input class="inputngEditModalTo" type="text" id="ContNum" name="contNum">
                        </div>
                        <div class="inputbox-edit">
                            <label> Gender: </label>
                            <input class="inputngEditModalTo"  type="text" id="Sex" name="gender">
                        </div>
                        
                    </div>
                    <div class="row2">
                        <!-- <div class="inputbox-edit">
                            <label> Contact Number: </label>
                            <input class="inputngEditModalTo" type="text" id="ContNum" name="contNum">
                        </div> -->
                        <!-- <div class="inputbox-edit">
                            <label> Citizenship: </label>
                            <input class="inputngEditModalTo" type="text" id="CitizShip" name="citizShip">
                        </div> -->
                    </div>
                    <hr>
                    <div class="header-row">
                        <h4> Address </h4>
                    </div>
                    <div class="row3">
                        <div class="inputbox-edit">
                            <label> Block: </label>
                            <input class="inputngEditModalTo" type="text" id="Blk" name="block">
                        </div>
                        <div class="inputbox-edit">
                            <label> Lot: </label>
                            <input class="inputngEditModalTo" type="text" id="Lot" name="lot"> 
                        </div>
                        <div class="inputbox-edit">
                            <label> Street: </label>
                            <input class="inputngEditModalTo" type="text" id="STName" name="streetname">
                        </div>
                    </div>
                    <hr>
                    <!-- <div class="header-row">
                        <h4> Emergency Contact </h4>
                    </div>
                    <div class="row4">
                        <div class="inputbox-edit">
                            <label> Name: </label>
                            <input class="inputngEditModalTo" type="text" id="Name" name="emName">
                        </div>
                    </div>
                    <div class="row5">
                        <div class="inputbox-edit">
                            <label> Contact Number: </label>
                            <input class="inputngEditModalTo" type="text" id="ecNum" name="emNumber">
                        </div>
                        <div class="inputbox-edit">
                            <label> Relationship: </label>
                            <input class="inputngEditModalTo" type="text" id="ecRel" name="emRelationship">
                        </div>
                    </div>
                    <div class="row6">
                        <div class="inputbox-edit">
                            <label id="Address_label"> Address: </label>
                            <input class="inputngEditModalTo" type="text" id="Address" name="emAddress">
                        </div>
                    </div> -->
                    <!-- <hr>
                    <div class="save-btn"> 
                        <button class="CancelButton" type="button"> Cancel </button>
                        <button class="saveButton" type="button"> Save </button>
                    </div> -->
                </form>
            </div>
        </div>
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
                    <a href="" class="sideside" id="complaintsDropdown">
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

            <div class="AccountsssContainerr AccountsssConActivee">
                <div class="AccTopNamePage">
                    <h1> Accounts </h1>
                </div>
                <div class="AccountTableConTop">
                    <div class="AccTable-container">
                        <div class="AccSearchContainer">
                            <div class="searchFilterLeft">
                                
                            </div>
                            <div class="searchRight">
                                <label> Search: </label>
                            <input class="AccSearchInputDes" type="search">
                            </div>
                        </div>

                        <div class="AccountsTableContent">
                            <table>
                                <thead>
                                    <tr>
                                        <th> Resident's Name </th>
                                        <th> Address </th>
                                        <th colspan="2"> Action </th>
                                    </tr>
                
                                    <tbody>
                                      <?php

                                        $query = "SELECT * FROM tblresident WHERE access = 'Pending'";
                                      
                                        $result = mysqli_query($conn, $query);

                                        if($result){
                                          if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                              ?>
                                                <tr>
                                                    <td class="user_id" hidden><?php echo $row['user_id'] ?></td>
                                                    <td><?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name']; ?></td>
                                                    <td><?php echo "Block " . $row['block'] . " Lot " . $row['lot'] ?></td>
                                                    <td>
                                                        <button class="AccViewBtn ACCTb-btn BiyuModal AccsModal"> View </button>
                                                    </td>
                                                    <td>
                                                        <button class="AccConfirmBtn ACCTb-btn confBOTON" data-news-id="<?php echo $row['user_id'] ?>" onclick="openConfirmModal(this)"> Confirm </button>
                                                    </td>
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
                        <!-- Modal for generating certificate
                        <div id="certificateModal" class="certificateModal">
                            
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/Accounts.js"></script>
</body>
</html>