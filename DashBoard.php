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
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/DashBoard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
        .containerNgEditModal{
    display: none;
}

.subContainerEditModal{
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    font-family: Arial, sans-serif;
}

.editItongmodal{
    position: relative;
    max-width: 600px;
    width: 100%;
    margin-top: 10px;
    height: 590px;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    overflow: hidden;
    overflow-y: scroll;
}

.editItongmodal hr {
    border: none;
    height: 1px;
    background-color: #ccc;
    margin: 15px 0;
}

.editItongmodal::-webkit-scrollbar{
    display: none;
}

.titleHeaderEdit{
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.edit-form h4{
    font-size: 20px;
    margin-bottom: 10px;
}

.closeEditModal{
    height: 30px;
    font-size: 28px;
    font-weight: bold;
    outline: none;
    border: none;
    background: none;
    cursor: pointer;
}

.edit-form .inputbox-edit{
    width: 100%;
}

.edit-form .inputbox-edit .inputngEditModalTo{
    position: relative;
    display: inline-block;
    height: 30px;
    width: 100%;
    font-size: small;
    outline: none;
    /* background: rgb(234, 240, 245);
    border: 1px solid rgb(203, 214, 220); */
    border-radius: 4px;
    padding: 0 10px;
    margin-top: 3px;
}

.inputbox-edit select{
    position: relative;
    height: 30px;
    width: 100%;
    outline: none;
    /* background: rgb(234, 240, 245);
    border: 1px solid rgb(203, 214, 220); */
    border-radius: 4px;
    padding: 0 10px;
    margin-top: 3px;
}

.edit-form .inputbox-edit label{
    font-weight: 550;
}

.edit-form .row{
    display: flex;
    column-gap: 15px;
    margin-bottom: 13px;
}

.edit-form .row1{
    display: grid;
    grid-template-columns: 1fr 250px 1fr;
    column-gap: 15px;
    margin-bottom: 13px;
}

.edit-form .row2{
    display: flex;
    column-gap: 15px;
    padding-bottom: 10px;
}

.edit-form .row3{
    display: grid;
    grid-template-columns: 1fr 1fr 250px;
    column-gap: 15px;
    padding-bottom: 10px;
}

.edit-form .row5{
    display: flex;
    column-gap: 15px;
    margin-top: 13px;
}

.edit-form .row6{
    margin-top: 10px;
    padding-bottom: 10px;
}
.dashView{
    color: rgb(17, 94, 119);
    background: rgb(173, 234, 255);
}

.dashView:hover{
    background: rgb(95, 201, 236);
}

</style>
</head>
<body>
    <div class="containerNgEditModal" id="Dash_Edit_Modal">
        <div class="subContainerEditModal">
            <div class="editItongmodal">
                <div class="titleHeaderEdit">
                    <h2 id="modal_title"> Resident's Information </h2>
                    <input type="text" id="userID" hidden>
                    <span class="closeEditModal" id="Dash_Close_Modal">&times;</span>
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
                            <input class="inputngEditModalTo"  type="text" id="Age" name="age">
                        </div>
                        <!-- <div class="inputbox-edit">
                            <label> Place Of Birth: </label>
                            <input class="inputngEditModalTo"  type="text" id="Bplace" name="birthplace">
                        </div> -->
                        <div class="inputbox-edit">
                            <label> Contact Number: </label>
                            <input class="inputngEditModalTo" type="text" id="PhoneNum" name="contNum">
                        </div>
                        <div class="inputbox-edit">
                            <label> Gender: </label>
                            <input class="inputngEditModalTo"  type="text" id="Sex" name="gender">
                        </div>
                    </div>
                    <div class="row2">
                        <!-- <div class="inputbox-edit">
                            <label> Contact Number: </label>
                            <input class="inputngEditModalTo" type="text" id="PhoneNum" name="contNum">
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
                    <div class="header-row">
                        <h4> Emergency Contact </h4>
                    </div>
                    <div class="row4">
                        <div class="inputbox-edit">
                            <label> Name: </label>
                            <input class="inputngEditModalTo" type="text" id="ecName" name="emName">
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
                            <input class="inputngEditModalTo" type="text" id="ecAddress" name="emAddress">
                        </div>
                    </div>
                    <!-- <hr>
                    <div class="save-btn"> 
                        <button class="CancelButton" type="button"> Cancel </button>
                        <button class="saveButton" type="button"> Save </button>
                    </div> -->
                </form>
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
                    <div class="user-img"> </div>
                    <div class="eme3"></div>
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
                <a href="Residents.php" class="sideside">
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

            <div class="mainDashContainerr mainDashConActivee">
                <div class="dashContents">
                    <h1> Dashboard </h1>
                    <h4> Resident's Record Summary </h4>
                </div>

                <div class="dashboardCards">
                    <div class="TotalResidents">
                        <div class="center">
                            <div class="left-per-card">
                                <img class="img-cards" src="Pictures/Accounts2.png">
                            </div>
                            <div class="right-per-card">
                                <h3 class="info-card"> 
                                    <?php
                                        $dash_residents_sql = "SELECT * FROM tblresident";
                                        $dash_residents_query = mysqli_query($conn, $dash_residents_sql); 
                                        if($residents_total = mysqli_num_rows($dash_residents_query)) {
                                            echo '<p class="#"> '.$residents_total.' </p>';
                                        }
                                        else {
                                            echo '<p class="#"> No Data </p>';
                                        }
                                    ?>
                                </h3>
                                <h4 class="info-card"> Total Number of Residents </h4>
                            </div>
                        </div> 
                    </div>

                    <div class="TotalResidents">
                        <div class="center">
                            <div class="left-per-card">
                                <img class="img-cards" src="Pictures/Accounts2.png">
                            </div>
                            <div class="right-per-card">
                                <h3 class="info-card">
                                    <?php
                                        $dash_residents_sql = "SELECT * FROM tblresident WHERE sex = 'Female'";
                                        $dash_residents_query = mysqli_query($conn, $dash_residents_sql); 
                                        if($residents_total = mysqli_num_rows($dash_residents_query)) {
                                            echo '<p class="#"> '.$residents_total.' </p>';
                                        }
                                        else {
                                            echo '<p class="#"> No Data </p>';
                                        }
                                    ?>
                                </h3>
                                <h4 class="info-card"> Total Number of Female </h4>
                            </div>
                        </div> 
                    </div>

                    <div class="TotalResidents">
                        <div class="center">
                            <div class="left-per-card">
                                <img class="img-cards" src="Pictures/Accounts2.png">
                            </div>
                            <div class="right-per-card">
                                <h3 class="info-card">
                                    <?php
                                        $dash_residents_sql = "SELECT * FROM tblresident WHERE sex = 'Male'";
                                        $dash_residents_query = mysqli_query($conn, $dash_residents_sql); 
                                        if($residents_total = mysqli_num_rows($dash_residents_query)) {
                                            echo '<p class="#"> '.$residents_total.' </p>';
                                        }
                                        else {
                                            echo '<p class="#"> No Data </p>';
                                        }
                                    ?>
                                </h3>
                                <h4 class="info-card"> Total Number of Male </h4>
                            </div>
                        </div> 
                    </div>

                    <div class="TotalResidents">
                        <div class="center">
                            <div class="left-per-card">
                                <img class="img-cards" src="Pictures/Accounts2.png">
                            </div>
                            <div class="right-per-card">
                                <h3 class="info-card"> 1 </h3>
                                <h4 class="info-card"> Total Number of Residents </h4>
                            </div>
                        </div> 
                    </div>

                    <div class="TotalResidents">
                        <div class="center">
                            <div class="left-per-card">
                                <img class="img-cards" src="Pictures/Accounts2.png">
                            </div>
                            <div class="right-per-card">
                                <h3 class="info-card"> 1 </h3>
                                <h4 class="info-card"> Total Number of Residents </h4>
                            </div>
                        </div> 
                    </div>
                </div>

                <div class="table-container">
                    <h1> Resident's Data </h1>
    
                    <div class="search-and-btn">
                        <form action="" method="get">
                            <div class="dropDownContents">
                                <div class="dropDown">  
                                    <div class="selectContainer">
                                        <span class="selected"> Select </span>
                                        <div class="eme"></div>
                                    </div>
                                    <ul class="selectMenu" name="filter_option">
                                        <li><input class="selectActive"> Select </li>
                                        <li><input type="checkbox" value="1" name="filter_option">Block 1</li>
                                        <li><input type="checkbox" value="2" name="filter_option">Block 2</li>
                                        <li><input type="checkbox" value="3" name="filter_option">Block 3</li>
                                    </ul>
                                </div>
                                <!-- Dropdown Filter Button -->
                                <div class="dropDown-btn">
                                    <button class="add-btn tb" type="submit"> Filter </button>
                                </div>
                            </div>
                                <!-- Search Filter Button -->
                        <div class="search-content">
                                <div class="ewanKona">
                                    <label class=""> Search: </label>
                                    <input class="search-input" type="search" name="search_query">
                                </div>
                                <!-- <div class="dropDown-btn">
                                        <button class="add-btn tb" type="submit"> Search </button>
                                </div> -->
                        </form> 
                                <!-- Add New Resident Button -->
                            <!-- <div class="dropDown-btn">
                                <button class="add-btn tb" type="submit"> + Add New </button>
                            </div> -->
                        </div>
                    </div>
    
                    <div class="tableContent">
                        <table>
                            <thead>
                                <tr>
                                    <th> Name </th>
                                    <th> Address </th>
                                    <th> Contact Number </th>
                                    <th> Action </th>
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
                                                                <button class="dashView tb-btn dashModal BiyuModal"> View </button>
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
                </div>
            </div>
        </div>
    </div>

    <script src="JS/DashBoard.js"></script>
</body>
</html>