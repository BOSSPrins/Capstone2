<?php
session_start();
include "Connect/Connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mabuhay Website </title>
    <link rel="icon" type="image/x-icon" href="Pictures/Dasma_City_Icon.ico">
    <link rel="stylesheet" href="CSS/index.css">
    <script src="jQuery/jquery.min.js"></script>
</head>
<body>
    <div class="arawAtOras">
        <div> Monday </div>
        <div> Tuesday </div>
        <div> Wednesday </div>
        <div> Thursday </div>
        <div> Friday </div>
        <div> Saturday </div>
        <div> Sunday </div>
    </div>
    
    <div class="HeaderWithLogo">
        <div class="LogoLandingPage">
            <div class="logoImageCon">
                <a href="#" class="asLogo">
                    <img class="Logoo" src="Pictures/Dasma_City_Logo.png">
                </a>
            </div>
            <div class="NameOfSubdi">
                <h1> MABUHAY HOMES 2000 PH-V </h1>
                <h3> BRGY. SALAWAG CITY OF DASMARINAS </h3>
            </div>
        </div>
        <div class="MhNavbar">
            <ul class="MhNavv">
                <li>
                    <a href="#Home"> Home </a>
                </li>
                <li>
                    <a href="#AboutUs"> About Us </a>
                </li>
                <li>
                    <a href="LoginPage.php"> Services </a>
                </li>
                <li>
                    <a href="#HOAOfficials"> HOA Officials </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="HeaderWithLogo hiddenHeader">
        <div class="LogoLandingPage">
            <div class="logoImageCon">
                <a href="#" class="asLogo">
                    <img class="Logoo" src="Pictures/Dasma_City_Logo.png">
                </a>
            </div>
            <div class="NameOfSubdi">
                <h1> MABUHAY HOMES 2000 PH-V </h1>
                <h3> BRGY. SALAWAG CITY OF DASMARINAS </h3>
            </div>
        </div>
        <div class="MhNavbar">
            <ul class="MhNavv">
                <li>
                    <a href="#Home"> Home </a>
                </li>
                <li>
                    <a href="#AboutUs"> About Us </a>
                </li>
                <li>
                    <a href="LoginPage.php"> Services </a>
                </li>
                <li>
                    <a href="#HOAOfficials"> HOA Officials </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="ContainerNgImages">
        <div class="imagesSliding">
            <img src="Pictures/435422549_403877862400828_4775813149732484992_n.png"> <!-- SAMPLE IMAGES -->
            <img src="Pictures/Dasma_City_Logo.png"> <!-- SAMPLE IMAGES -->
            <img src="Pictures/435422549_403877862400828_4775813149732484992_n.png"> <!-- SAMPLE IMAGES -->
            <img src="Pictures/Dasma_City_Logo.png"> <!-- SAMPLE IMAGES -->
            <img src="Pictures/435422549_403877862400828_4775813149732484992_n.png"> <!-- SAMPLE IMAGES -->
        </div>
    </div>
    
    <!-- ILILIPAT PA TO SA LINK NG NAVBAR PAG NAKAPAG PROVIDE NA 
    SI MALIT NG MGA GUSTO NIYANG IPALAGAY-->
    
    <div class="ContentsOfSubdi" id="HOAOfficials">
        <div class="HoaPresidentLaman">
            <div class="MgaLamanContainer">
                
            </div>
            <div class="ContainerNgDalawa">
                <div class="pangalanNgBawatIsa">
                    <input class="inputNilaBawat" type="text">
                </div>
                <div class="LabelNgBawatIsa">
                    <label> PRESIDENT </label>
                </div>
            </div>
        </div>

        <div class="HoaPresident1">
            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">

                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> VICE PRESIDENT </label>
                    </div>
                </div>
            </div>

            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">

                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> SECRETARY </label>
                    </div>
                </div>
            </div>

            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">

                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> TREASURER </label>
                    </div>
                </div>
            </div>

            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">

                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> AUDITOR </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="HoaPresident1">
            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">

                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> PEACE IN ORDER </label>
                    </div>
                </div>
            </div>

            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">

                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> DIRECTOR </label>
                    </div>
                </div>
            </div>

            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">

                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> DIRECTOR </label>
                    </div>
                </div>
            </div>

            <div class="HoaPresidentLaman">
                <div class="MgaLamanContainer">
                    
                </div>
                <div class="ContainerNgDalawa">
                    <div class="pangalanNgBawatIsa">
                        <input class="inputNilaBawat" type="text">
                    </div>
                    <div class="LabelNgBawatIsa">
                        <label> DIRECTOR </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footerngLandingPage">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </footer>
    <script src="JS/index.js"></script>
</body>
</html>