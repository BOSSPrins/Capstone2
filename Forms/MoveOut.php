<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Mve-Out Clearance </title>
    <style>
        body {
            background: rgb(204,204,204); 
            font-family: Arial, Sans-serif;
        }
        .A4 {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        /*box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
        }
        .A4{  
        width: 21cm;
        height: 14.85cm; 
        }

        p{
            margin: 0;
            margin-top: 13px;
            color: rgb(0, 0, 116);
            font-weight: 545;
        }

        .ContainerHeader{
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 15px;
        }

        .ContNameOfSubdiandLogo{
            display: flex;
        }

        .ImgLogeHead{
            width: 140px;
        }

        .NameOfSubdiHeader{
            margin-left: 80px;
            text-align: center;
        }

        .DateIssued{
            display: flex;
            justify-content: end;
            /* padding-right: 40px; */
        }

        .LetterTopPanimula{
        padding-left: 60px;
        /*padding-right: 30px;*/
        }

        .UnangParagraph,
        .HulingParagraph{
            margin-left: 50px;
        }

        .containerOfPipirmaa{
            display: flex;
            text-align: center;
            justify-content: space-between;
            padding-left: 40px;
            padding-right: 40px;
        }

        .UnangPipirma{
            margin-left: 5px;
        }

        .BlkInput,
        .LotInput{
            width: 30px;
            text-align: center;
        }

        .fullNameInput{
            width: 220px;
        }

        .NameNakaUpo{
            font-weight: bold;
        }

        .HeaderNameSubdi{
            color: rgb(5, 143, 5);
        }

        .moveOutHead{
            color: rgb(0, 0, 116);
        }

        .LetterTopPanimula input{
            border: none;
            color: rgb(0, 0, 116);
            font-size: 15px;
            text-align: center;
        }

        .DateIssued input{
            border: none;
            color: rgb(0, 0, 116);
            font-size: 15px;
            width: 140px;
        }

        .DateIssuedInputt{
            font-size: 15px;
            color: rgb(0, 0, 116);
        }
    </style>
</head>
<body>
    <div class="A4">
        <div class="ContainerHeader">
            <div class="ContNameOfSubdiandLogo">
                <div class="LogoOfHeader">
                    <img class="ImgLogeHead" src="Pictures/Dasma_City_Logo.png">
                </div>
                <div class="NameOfSubdiHeader">
                    <h1 class="HeaderNameSubdi"> MABUHAY HOMES 2000 PH, 5 </h1>
                    <h2 class="moveOutHead"> MOVE-OUT CLEARANCE </h2>
                </div>
            </div>
            <div class="DateIssued">
                <p> Date: <input class="DateIssuedInputt" id="DateIssuedInput" type="type"></p>
            </div>
            <div class="LetterTopPanimula">
                <p> To whom it may concern;</p>
                <p class="UnangParagraph"> This is to certify that Mr./Mrs.<input class="fullNameInput" type="type"> from Block <input class="BlkInput" type="type"> Lot <input class="LotInput" type="type"></p>
                <p> Mabuhay Homes 2000 PV, Brgy. Salawag, City of Dasmarinas, Cavite is cleared in his/her</p>
                <p> water bill and no pending case filed at Peace and Order Dept.</p>
                <br>
                <p class="HulingParagraph"> This certification is being issued for whatever legal purpose this may serve.</p>
            </div>
            <br>
            <div class="containerOfPipirmaa">
                <div class="UnangPipirma">
                    <p> Verified by: </p>
                    <br>
                    <p>____________</p>
                    <p class="NameNakaUpo"> Melinda l. Bae </p>
                    <p> Cashier </p>
                </div>
                <div class="UnangPipirma">
                    <p> Cleared by: </p>
                    <br>
                    <p>___________________</p>
                    <p class="NameNakaUpo"> Officer in Charge </p>
                    <p> Peace and Order Dept. </p>
                </div>
                <div class="UnangPipirma">
                    <p> Checked by: </p>
                    <br>
                    <p>____________________</p>
                    <p class="NameNakaUpo"> Dir. Freddie S. Magante </p>
                    <p> Treasurer </p>
                </div>
                <div class="UnangPipirma">
                    <p> Approved by: </p>
                    <br>
                    <p>______________________</p>
                    <p class="NameNakaUpo"> Kag/Dir. Solomon M. Malit </p>
                    <p> HOA President </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Your JavaScript code here
        const monthNames = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE",
                            "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"
                            ];

        const d = new Date();
        const formattedDate = monthNames[d.getMonth()] + ', ' + d.getDate() + ' ' + d.getFullYear();
        document.getElementById("DateIssuedInput").value = formattedDate;
    </script>
</body>
</html>