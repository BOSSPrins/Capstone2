<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = htmlspecialchars($_POST['fullName']);
    $Lot = htmlspecialchars($_POST['lot']);
    $Block = htmlspecialchars($_POST['block']);
    $purpose = htmlspecialchars($_POST['purpose']);
    $forms_id = htmlspecialchars($_POST['forms_id']);
    $dateIssued = $_POST['dateIssued'];

    // Start the HTML for printing
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Move-Out Clearance</title>";
    echo "<link rel='icon' type='image/x-icon' href='../Pictures/Dasma_City_Icon.ico'>";
    echo "<style>";
    echo "@page { size: A4 landscape; margin: 1cm; }";
    echo "body {background: rgb(204,204,204); font-family: Arial, Sans-serif;}";
    echo ".A4 {background: white; display: block; margin: 0 auto; margin-bottom: 0.5cm;}";
    echo ".A4 {width: 21cm; height: 14.85cm;}";
    echo "p {margin: 0; margin-top: 13px; color: rgb(0, 0, 116); font-weight: 545;}";
    echo ".ContainerHeader {padding-left: 10px; padding-right: 10px; padding-top: 15px;}";
    echo ".ContNameOfSubdiandLogo {display: flex;}";
    echo ".ImgLogeHead {width: 140px;}";
    echo ".NameOfSubdiHeader {margin-left: 80px; text-align: center;}";
    echo ".DateIssued {display: flex; justify-content: end;}";
    echo ".LetterTopPanimula {padding-left: 60px;}";
    echo ".UnangParagraph, .HulingParagraph {margin-left: 50px;}";
    echo ".containerOfPipirmaa {display: flex; text-align: center; justify-content: space-between; padding-left: 40px; padding-right: 40px;}";
    echo ".UnangPipirma {margin-left: 5px;}";
    echo ".BlkInput, .LotInput {width: 30px; text-align: center;}";
    echo ".fullNameInput {width: 220px;}";
    echo ".NameNakaUpo {font-weight: bold;}";
    echo ".HeaderNameSubdi {color: rgb(5, 143, 5);}";
    echo ".moveOutHead {color: rgb(0, 0, 116);}";
    echo ".LetterTopPanimula input {border: none; color: rgb(0, 0, 116); font-size: 15px; text-align: center;}";
    echo ".DateIssued input {border: none; color: rgb(0, 0, 116); font-size: 15px; width: 140px;}";
    echo ".DateIssuedInputt {font-size: 15px; color: rgb(0, 0, 116);}";
    echo "</style>";
    echo "</head>";
    echo "<body>";
    echo "<div class='A4'>";
    echo "<div class='ContainerHeader'>";
    echo "<div class='ContNameOfSubdiandLogo'>";
    echo "<div class='LogoOfHeader'><img class='ImgLogeHead' src='Pictures/Dasma_City_Logo.png'></div>";
    echo "<div class='NameOfSubdiHeader'><h1 class='HeaderNameSubdi'>MABUHAY HOMES 2000 PH, 5</h1>";
    echo "<h2 class='moveOutHead'>MOVE-OUT CLEARANCE</h2></div></div>";
    echo "<div class='DateIssued'><p>Date: <input class='DateIssuedInputt' id='DateIssuedInput' type='text' value='" . $dateIssued . "'></p></div>";
    echo "<div class='LetterTopPanimula'><p>To whom it may concern;</p>";
    echo "<p class='UnangParagraph'>This is to certify that Mr./Mrs. <input class='fullNameInput' type='text' value='" . $fullName . "'> from Block <input class='BlkInput' type='text' value='" . $Block . "'> Lot <input class='LotInput' type='text' value='" . $Lot . "'></p>";
    echo "<p>Mabuhay Homes 2000 PV, Brgy. Salawag, City of Dasmarinas, Cavite is cleared in his/her</p>";
    echo "<p>water bill and no pending case filed at Peace and Order Dept.</p><br>";
    echo "<p class='HulingParagraph'>This certification is being issued for whatever legal purpose this may serve.</p></div><br>";
    echo "<div class='containerOfPipirmaa'>";
    echo "<div class='UnangPipirma'><p>Verified by:</p><br><p>____________</p><p class='NameNakaUpo'>Melinda l. Bae</p><p>Cashier</p></div>";
    echo "<div class='UnangPipirma'><p>Cleared by:</p><br><p>___________________</p><p class='NameNakaUpo'>Officer in Charge</p><p>Peace and Order Dept.</p></div>";
    echo "<div class='UnangPipirma'><p>Checked by:</p><br><p>____________________</p><p class='NameNakaUpo'>Dir. Freddie S. Magante</p><p>Treasurer</p></div>";
    echo "<div class='UnangPipirma'><p>Approved by:</p><br><p>______________________</p><p class='NameNakaUpo'>Kag/Dir. Solomon M. Malit</p><p>HOA President</p></div></div>";
    echo "</div></div>";
    echo "</body>";
    echo "</html>";
}
?>
