<?php 
include "Header.php"; 
include_once "Connect/Connection.php";
session_start();

if(!isset($_SESSION['unique_id'])){
    header("location: LoginPage.php");
}

?>
<body>
 <div class="SuccessModalIto" id="successModal"> <!--style="display: none;" -->
        <div class="subSuccessModalContent">
            <div class="successModalContent">
                <div class="successText">
                    <img class="successImg" src="Pictures/success.png">
                    <h2 class="paragSuccess">Operation completed successfully!</h2>
                </div>
                <hr class="hrSuccess"> 
                <div class="successButtons">
                    <button class="buttonSuccess okButn OkSaModal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL NG SUCCESS -->
    
    <!-- MODAL NG EDIT -->
<div class="ModalParasaViewDetails" id="ModalParasaViewDetails">
    <div class="subModalDetails">
        <div class="viewDetailsModal">
            <div class="viewTop">
                <h2> Announcement Information </h2>
                <span class="closeDetails" onclick="closeDetails()">&times;</span>
            </div>
            <div class="containerngLamanView">
                <div class="modalContainer1">
                    <div class="modalDateTime">
                        <div class="modaleLeftTiDa">
                            <input type="date" id="StrDate">
                            <input type="time" id="StrTime">
                        </div>
                        <div class="modaleRightTiDa">
                            <input type="date" id="EnDate">
                            <input type="time" id="EnTime">
                        </div>
                    </div>
                    <div class="modalTitleText">
                        <div class="modalTitleContainer">  
                            <div class="modalTitleTo">
                                <h3> TITLE: </h3>
                                <input class="modaltitleinputIto" type="text" id="Title">
                            </div>
                            <div class="modalTextContainer">
                                <div class="modalTextTo">
                                    <h3> ANNOUNCEMENT TEXT CONTENT: </h3>
                                    <textarea class="modalTextInputIto" rows="1" id="Descrip"> </textarea>
                                    <input type="text" id="newsID" hidden>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="buttonDeletee cancelButn" onclick="closeDetails()">Cancel</button>
                    <button class="edit-btn tb-btn" id="Apdeyt">Update</button>
                </div>
                <div class="modalContainer2">
                    <div class="EditingPicturesModal">
                        <div id="EditingPics" class="EditingPics">
                            <input type="file" class="editingInput newEditingInput" id="PicNames" multiple>
                            <img class="editingImgModal" src="Pictures/cloudUpload.png">
                            <p class="editingLagayanText">Select new images or <span class="spanNiyaModal">browse</span>.</p>
                        </div>
                        <div class="editingUploadedImages Imagess" id="Images"></div>
                        <input type="hidden" id="PicNames"> 
                        <div id="selectedFileNames" hidden></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL NG DELETE -->
    <div class="DeleteModalIto" id="deleteModal">
        <div class="subDeleteModalContent">
            <div class="deleteModalContent">
                <input type="text" id="del_newsID" class="delete_newsID" hidden>
                <div class="deleteText">
                    <img class="deleteImg" src="Pictures/danger.png">
                    <h2 class="paragDelete">Are you sure you want to delete this?</h2>
                </div>
                <hr class="hrDelete"> 
                <div class="deleteButtonss">
                    <button class="buttonDeletee cancelButn" id="klowsmodal" onclick="closeModal()">Cancel</button>
                    <button class="buttonDeletee deleteButn DelSaModal" onclick="deleteItem()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    



  <!-- Modal ng table ng announcement -->


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
                        <h2>Change Password Page</h2>
                        <p>Welcome to the Change Password page.</p>
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
                <a href="DashBoard.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Officials.png">
                    <span> HOA Officials </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Residents2.png">
                    <span> Residents </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Documents2.png">
                    <span> Documents </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Request2.png">
                    <span> Online Request </span>
                </a>
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
                        <li> <a href="#"> Sub Menu 2 </a> </li>
                        <li> <a href="#"> Sub Menu 3 </a> </li>
                    </ul>
                </div>
                <a href="" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Accounts2.png">
                    <span> Accounts </span>
                </a>
                <a href="Logout.php" class="sideside">
                    <img class="img-sideboard" src="Pictures/logout.png">
                    <span> Logout </span>
                </a>
            </div>

            <div class="mainAnnouncementhContainerr mainAnnouncementConActivee">
                <div class="titlengAtibaPa">
                        <h1 class="announceTop"> Announcement </h1>
                  <form class="anawns" enctype="multipart/form-data">
                    <div class="creatingAnnouncement">
                        <div class="announceDurationContainer">
                            <div class="leftButtonPost">
                                <input type="date" name="start_date" id="start_date">
                                <input type="time" name="start_time" id="start_time">
                            </div>
                            <div class="rightButtonPost">
                                <input type="date" name="end_date" id="end_date">
                                <input type="time" name="end_time" id="end_time">
                            </div>
                        </div> 
                        
                        <div class="postingandTitleContainer">
                            <div class="titleAnnounceInputniya">
                                <h2 class="headerNila"> TITLE: </h2>
                                <input class="titleInputItosAnnounce" type="text" placeholder="Title here..." name="title_name">
                            </div>
                            <div class="postingContainerRaps">
                                <div class="postingContainerInput">
                                    <h2 class="headerNila"> ANNOUNCEMENT TEXT CONTENT: </h2>
                                    <textarea class="announcementPostInput" rows="1" placeholder="Enter your text announcement here...." name="description_name" id="description_name"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="creatingAnnounceRap">
                            <p class="upperUpload">
                                <span class="uploadInfoValue">0</span> file(s) uploaded.
                            </p>
                            <div class="creatingAnnouncementForm">
                                <input type="file" class="announceInput" name="images[]" multiple>
                                <img class="uploaderImg" src="Pictures/cloudUpload.png">
                                <p class="uploadLagayanText">Select images or <span class="spanNiya">browse</span>.</p>
                            </div>
                            <div class="uploadingImages">
                                <!-- Uploaded images will be displayed here -->
                            </div>
                        </div>

                        <div class="buttonToPost">
                            <input class="buttonPostInputSub" type="submit" id="sabmitBoton">
                        </div>
                        <div class="iror"></div>  
                        <div class="sakses"></div>                    
                    </div>
                  </form>
                </div>


                <!-- Eto na yung table  -->
                <div class="tableContainerTopp">
                    <div class="table-container">
                        <form action="" method="get" id="filterForm">
                            <div class="searchContainer">
                                <div class="searchFilterLeft">
                                    <input type="date" name="filter_start_date">
                                    <input type="date" name="filter_end_date">
                                </div>
                                <div class="searchRight">
                                    <label> Search: </label>
                                    <input class="searchInputDes" type="search" name ="search_input">
                                    <button type="submit" id="filterButton">Filter</button>
                                </div>
                            </div>

                            <div class="tableContent">
                                <table id="dynamicTable">
                                    <thead>
                                        <tr>
                                            <th colspan="1"> Date </th>
                                            <th colspan="1"> Time </th>
                                            <th> Title Announcement </th>
                                            <th colspan="2"> Action </th>
                                        </tr>
                    
                                        <tbody id="tableBody">
                            
                                        <?php
                                            $searchQuery = isset($_GET['search_input']) ? strtolower($_GET['search_input']) : '';
                                            $start_date = isset($_GET['filter_start_date']) ? $_GET['filter_start_date'] : '';
                                            $end_date = isset($_GET['filter_end_date']) ? $_GET['filter_end_date'] : '';

                                            $query = "SELECT * FROM announcements"; 

                                            $whereClauses = [];

                                            if (!empty($searchQuery)) {
                                                // Check if the search query is a month or year
                                                $monthNum = date('n', strtotime($searchQuery));
                                                $isMonth = date('F', strtotime($searchQuery)) == ucfirst($searchQuery);
                                                $isYear = is_numeric($searchQuery) && strlen($searchQuery) == 4;
                                    
                                                $searchConditions = [];
                                                $searchConditions[] = "LOWER(title) LIKE '%$searchQuery%'"; 
                                                $searchConditions[] = "LOWER(start_date) LIKE '%$searchQuery%'";
                                                $searchConditions[] = "LOWER(start_time) LIKE '%$searchQuery%'";
                                                $searchConditions[] = "LOWER(end_date) LIKE '%$searchQuery%'";
                                                $searchConditions[] = "LOWER(end_time) LIKE '%$searchQuery%'";
                                    
                                                if ($isMonth) {
                                                    $searchConditions[] = "LOWER(MONTHNAME(start_date)) = '$searchQuery'";
                                                }
                                    
                                                if ($isYear) {
                                                    $searchConditions[] = "YEAR(start_date) = '$searchQuery'";
                                                }

                                                $whereClauses[] = "(" . implode(" OR ", $searchConditions) . ")";
                                            }

                                            if (!empty($start_date) && !empty($end_date)) {
                                                $whereClauses[] = "(start_date >= '$start_date' AND end_date <= '$end_date')";
                                                          
                                            }

                                            if (!empty($whereClauses)) {
                                                $query .= " WHERE " . implode(" AND ", $whereClauses);
                                            }
                                                    
                                            $result = mysqli_query($conn, $query);

                                            if (!$result) {
                                                die("Query failed: " . mysqli_error($conn));
                                            }
                                          
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <tr>
                                                        <td hidden class="news_id"><?php echo $row['news_id'] ?> </td>
                                                        <td><?php echo date('F d Y', strtotime($row['start_date']))?></td>
                                                        <td hidden><?php echo date('F d Y', strtotime($row['end_date'])) ?></td>
                                                        <td><?php echo $row['start_time'] ?></td>
                                                        <td hidden><?php echo $row['end_time'] ?> </td>
                                                        <td><?php echo $row['title'] ?> </td>
                                                        <td>
                                                            <button class="edit-btn tb-btn iditBoton SaModal" id="iditBoton" name="iditBoton" onclick="openEditModal()"> Edit </button>
                                                        </td>
                                                        <td>
                                                            <button class="delete-btn tb-btn dilitBoton delBOTON" id="dilitBoton" name="dilitBoton" data-news-id="<?php echo $row['news_id'] ?>" onclick="openDeleteModal(this)"> Delete </button>
                                                        </td>                                                       
                                                    </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                        <tr>
                                                            <td colspan="6">No data found.</td>
                                                        </tr>
                                                    <?php
                                                }
   
                        
                                        mysqli_close($conn);
                                        ?>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="JS/Announcement.js"></script>

</body>
</html>