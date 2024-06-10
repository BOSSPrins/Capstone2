<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Residents </title>
  <link rel="stylesheet" href="CSS/Residents.css">
</head>
<body>
<div class="mainDashboardContainer">
        <div class="secMainDash">
            <!-- <div class="headerTop">
                <div class="leftSection">
                    <img id="menuBtn" class="menu" src="Pictures/menu-hamburger.png">
                    <img class="img-logo" src="Pictures/Dasma_City_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 </h2>
                </div>
                <div class="rightSection">
                    <button id="myProfileBtn" type="button" class="profileBtn">
                        <div class="user-img"></div>
                        <label> Profile </label>
                    </button>
                </div>
            </div> -->

            <div class="sidebarContainer sideActive" id="sidebar">
                <div class="headerTop">
                    <img class="img-logo" src="Pictures/Dasma_City_Logo.png">
                    <h2 class="MabuhayName"> Mabuhay Homes 2000 Phase 5 </h2>
                </div>
                <a href="Dash.html" class="sideside baractive">
                    <img class="img-sideboard" src="Pictures/Dashboard2.png">
                    <span> Dasboard </span>
                </a>
                <a href="HoaOfficials.html" class="sideside">
                    <img class="img-sideboard" src="Pictures/Officials.png">
                    <span> HOA Officials </span>
                </a>
                <a href="#" class="sideside">
                    <img class="img-sideboard" src="Pictures/Residents2.png">
                    <span> Residents </span>
                </a>
                <a href="Documents.html" class="sideside">
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
                            <a href="Chat.html">
                                <img class="img-subMenu" src="Pictures/Chat.png">
                                <label class="sub-spa"> Chat </label>
                            </a> 
                        </li>
                    </ul>
                </div>
                <a href="Announcement.html" class="sideside">
                    <img class="img-sideboard" src="Pictures/Announcement.png">
                    <span> Announcement </span>
                </a>
                <a href="Accounts.html" class="sideside">
                    <img class="img-sideboard" src="Pictures/Accounts2.png">
                    <span> Accounts </span>
                </a>
                <a href="MonthlyDue.html" class="sideside">
                    <img class="img-sideboard" src="Pictures/MonthlyDue.png">
                    <span> Monthly Due </span>
                </a>
                <a href="#" class="sideside">
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
                                    <div class="selected" id="dropdownSelected"> 23 </div>
                                    <div class="options">
                                        <div class="option" data-value="4">04</div>
                                        <div class="option" data-value="5">05</div>
                                        <div class="option" data-value="8">08</div>
                                        <div class="option" data-value="10">10</div>
                                        <div class="option" data-value="23">15</div>
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

                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label><label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
                                    <label><input class="DropFilterInput" type="radio" value="3" name="filter_option">Block 3</label>
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
                                <input class="inputSearchhh" type="text" name="" id="search" placeholder="search">
                            </div>
                        </header>
                        <div class="TablesContainer">
                            <table>
                                <thead>
                                    <tr>
                                        <th data-sort onclick="sortTable(0, event)"> Name </th>
                                        <th data-sort onclick="sortTable(1, event)"> Age </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> b </td>
                                        <td> 25 </td>
                                        <td>
                                            <button> View </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> c </td>
                                        <td> 12 </td>
                                    </tr>
                                    <tr>
                                        <td> d</td>
                                        <td> 34 </td>
                                    </tr>
                                    <tr>
                                        <td> f </td>
                                        <td> 45 </td>
                                    </tr>
                                    <tr>
                                        <td> h </td>
                                        <td> 56 </td>
                                    </tr>
                                    <tr>
                                        <td> j </td>
                                        <td> 67 </td>
                                    </tr>
                                    <tr>
                                        <td> L </td>
                                        <td> 78 </td>
                                    </tr>
                                    <tr>
                                        <td> N </td>
                                        <td> 89 </td>
                                    </tr>
                                    <tr>
                                        <td> O</td>
                                        <td> 98 </td>
                                    </tr>
                                    <tr>
                                        <td> Q </td>
                                        <td> 87 </td>
                                    </tr>
                                    <tr>
                                        <td> R </td>
                                        <td> 76 </td>
                                    </tr>
                                    <tr>
                                        <td> T </td>
                                        <td> 65 </td>
                                    </tr>
                                    <tr>
                                        <td> U </td>
                                        <td> 54 </td>
                                    </tr>
                                    <tr>
                                        <td> S </td>
                                        <td> 43 </td>
                                    </tr>
                                    <tr>
                                        <td> P </td>
                                        <td> 32 </td>
                                    </tr>
                                    <tr>
                                        <td> O </td>
                                        <td> 21 </td>
                                    </tr>
                                    <tr>
                                        <td> M </td>
                                        <td> 77 </td>
                                    </tr>
                                    <tr>
                                        <td> K </td>
                                        <td> 88 </td>
                                    </tr>
                                    <tr>
                                        <td> i </td>
                                        <td> 99 </td>
                                    </tr>
                                    <tr>
                                        <td> g </td>
                                        <td> 44 </td>
                                    </tr>
                                    <tr>
                                        <td> e </td>
                                        <td> 55 </td>
                                    </tr>
                                    <tr>
                                        <td> c </td>
                                        <td> 11 </td>
                                    </tr>
                                    <tr>
                                        <td> a </td>
                                        <td> 900 </td>
                                    </tr>
                                </tbody>
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
                        <div class="containerNgViewModal">
                            <div class="subContainerViewModal">
                                <div class="viewItongmodal">
                                    <header class="titleHeaderView">
                                        <h1 id="modalViewtitle"> Resident's Information </h1>
                                        <span class="closeViewModal">&times;</span>
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
                                                    <input class="inputngViewModalTo" type="text" id="Fname" name="firstName">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Suffix: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Date of Birth: </label>
                                                    <input class="inputngViewModalTo" type="text" id="Fname" name="firstName">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Age: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Gender: </label>
                                                    <select class="simpleOption">
                                                        <option> Female </option>
                                                        <option> Male </option>
                                                        <option> Rather not to say </option>
                                                    </select>
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Contact Number: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="headerModalRow">
                                                <h2> Address </h2>
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Block: </label>
                                                    <input class="inputngViewModalTo" type="text" id="Fname" name="firstName">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Lot: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Street: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="headerModalRow">
                                                <h2> Emergency Address </h2>
                                            </div>
                                            <div class="inputboxView">
                                                <label> Name: </label>
                                                <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                            </div>
                                            <div class="row">
                                                <div class="inputboxView">
                                                    <label> Contact Number: </label>
                                                    <input class="inputngViewModalTo" type="text" id="Fname" name="firstName">
                                                </div>
                                                <div class="inputboxView">
                                                    <label> Relationship: </label>
                                                    <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                                </div>
                                            </div>
                                            <div class="inputboxView">
                                                <label> Address: </label>
                                                <input class="inputngViewModalTo"  type="text" id="Mname" name="middleName">
                                            </div>
                                        </form>
                                    </div>
                                    <footer class="footerNgViewModal">
                                        fsfdfad
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>