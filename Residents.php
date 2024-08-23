<?php
include_once "Connect/Connection.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    if ($_SESSION['role'] == 'user') {
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
    <link rel="icon" type="image/x-icon" href="Pictures/Mabuhay_Logo.ico">
    <link rel="stylesheet" href="CSS/Residents.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Mabuhay_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 Phase 5 </h2>
                </div>
                <a href="DashBoard.php" class="sideside baractive">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="HoaOfficials.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Officials.png">
                    <span> HOA Officials </span>
                </a>
                <a href="Residents.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Residents2.png">
                    <span> Residents </span>
                </a>
                <a href="Documents.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Documents2.png">
                    <span> Documents </span>
                </a>
                <div class="complaintsContainer">
                    <a href="#" class="sideside" id="complaintsDropdown">
                        <img class="img-sideboard" src="Pictures/ComplaintsCap.png">
                        <span> Complaints </span>
                        <button class="buttonEme2">
                            <div class="eme2"></div>
                        </button> 
                    </a>  
                    <ul class="subMenuComp" id="complaintsSubMenu">
                        <li> 
                            <a href="Chat.php">
                                <img class="img-subMenu" src="Pictures/Chat.png">
                                <label class="sub-spa"> Chat </label>
                            </a> 
                        </li>
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
                <a href="MonthlyDue.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="Voting.php" class="sideside">
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
                            <h2 class="namePerModule"> Residents </h2>
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
                    <div class="TablessContainer">
                        <header class="TableHeaderr">
                            <div class="itemsController">
                                <h3>Show</h3>
                                <div class="dropdown" id="itemPerpage">
                                    <div class="selected" style="z-index: 1;" id="dropdownSelected"> 23 </div>
                                    <div class="options" style="z-index: 1;">
                                        <div class="option" style="z-index: 1;" data-value="4">04</div>
                                        <div class="option" style="z-index: 1;" data-value="5">05</div>
                                        <div class="option" style="z-index: 1;" data-value="8">08</div>
                                        <div class="option" style="z-index: 1;" data-value="10">10</div>
                                        <div class="option" style="z-index: 1;" data-value="23">15</div>
                                    </div>
                                </div>
                                <h3>Per Page</h3>
                            </div>
                            <div class="searchTablee">
                                <div class="dropdownFilter">
                                  <label for="filter_option">Select Option</label>
                                  <input class="DropFilterInput" type="radio" value="" id="filter_option" name="filter_option" checked>
                                  <div class="dropdownFiltercontent">
                                    <label><input class="DropFilterInput" type="radio" value="1" name="filter_option">Block 1</label>
                                    <label><input class="DropFilterInput" type="radio" value="2" name="filter_option">Block 2</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                  </div>
                                </div>
                                <h3>Search:</h3>
                                <input class="inputSearchhh" type="search" name="search_query" id="search" placeholder="search">
                            </div>
                        </header>
                        <div class="TablesContainer">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width:400px" data-sort onclick="sortTable(0, event)"> Name </th>
                                        <th data-sort onclick="sortTable(1, event)"> Address </th>
                                        <th style="width:200px"> Contact Number </th>
                                        <th style="width:200px"> Action </th>
                                    </tr>

                                    <tbody>
                                        <?php
                                            $filterOption = isset($_GET['filter_option']) ? $_GET['filter_option'] : '';
                                            $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

                                            $query = "SELECT * FROM tblresident WHERE access != 'Pending' OR access = 'Approved'";

                                            if (!empty($filterOption)) {
                                                $query .= " WHERE block = '" . mysqli_real_escape_string($conn, $filterOption) . "'";
                                            }

                                            if (!empty($searchQuery)) {
                                                if (!empty($filterOption)) {
                                                    $query .= " AND ";
                                                } else {
                                                    $query .= " WHERE ";
                                                }
                                                $query .= "CONCAT(first_name,middle_name,last_name,block,lot,phone_number) LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%'";
                                            }

                                            $result = mysqli_query($conn, $query);

                                            if ($result) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                            <tr>
                                                                <td class="user_id" hidden><?php echo $row['user_id'] ?></td>
                                                                <td><?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name']; ?></td>
                                                                <td><?php echo "Block " . $row['block'] . " Lot " . $row['lot'] ?></td>
                                                                <td><?php echo $row['phone_number'] ?></td>
                                                                <td>
                                                                    <button class="ResidentsViewBtn BiyuModal"> View </button>
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
                        <footer class="bottom-field">
                            <ul class="pagination">
                                <li class="prev">
                                    <a href="#" class="prevv" id="prev"> &#139; Previous </a>
                                </li>
                                    <!-- page number here -->
                                <li class="next">
                                    <a href="#" class="nextt" id="next"> Next &#155; </a>
                                </li>
                            </ul>
                        </footer>
                        <div class="containerNgViewModal" id="ViewModalResidents">
                            <div class="subContainerViewModal">
                                <div class="viewItongmodal">
                                    <header class="titleHeaderView">
                                        <h1 id="modalViewtitle"> Resident's Information </h1>
                                        <input type="text" id="userID" hidden>
                                        <span class="closeViewModal" id="ViewCloseModalResidents">&times;</span>
                                    </header>
                                    <div class="emeeeee">
                                        <form class="ViewForm">
                                            <div class="headerModalRow">
                                                <h2> Personal Information </h2>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> First Name: </label>
                                                    <input class="inputngViewModalTo" type="text" id="Fname" name="firstName">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Middle Name: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Last Name: </label>
                                                    <input class="inputngViewModalTo" type="text" id="Lname" name="lasttName">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Suffix: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Suffix" name="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Date of Birth: </label>
                                                    <input class="inputngViewModalTo" type="text" id="" name="">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Age: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Age" name="age">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Gender: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Gender" name="gender">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Contact Number: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="PhoneNum" name="contNum">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="headerModalRow">
                                                <h2> Address </h2>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Block: </label>
                                                    <input class="inputngViewModalTo" type="text" id="Blk" name="block">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Lot: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Lot" name="lot">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Street: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="STName" name="streetname">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="headerModalRow">
                                                <h2> Emergency Address </h2>
                                            </div>
                                            <div class="inputboxView">
                                                <label> Name: </label>
                                                <input class="inputngViewModalTo"  type="text" id="ecName" name="emName">
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Contact Number: </label>
                                                    <input class="inputngViewModalTo" type="text" id="ecNum" name="emNumber">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Relationship: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="ecRel" name="emRelationship">
                                                </div>
                                            </div>
                                            <div class="inputboxView">
                                                <label> Address: </label>
                                                <input class="inputngViewModalTo"  type="text" id="ecAddress" name="emAddress">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- <footer class="footerNgViewModal">
                                        <button class="AcceptBtn ResPindot"> Accept </button>
                                        <button class="DecBtn ResPindot"> Decline </button>
                                    </footer> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/Residents.js"></script>
</body>
</html>