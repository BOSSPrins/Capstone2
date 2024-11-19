<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       body {
            background: rgb(204, 204, 204); 
            font-family: Arial, Sans-serif;
        }

        .A4 {
            background: white;
            width: 21cm;
            height: 29.7cm;
            padding: 20px;
            margin: 0 auto;
            box-sizing: border-box;
            position: relative;  /* Position context for absolute centering */
        }

        header {
            display: flex;
            justify-content: flex-start;  /* Align the logo to the left */
            align-items: flex-start;
        }

        .LogoManuhay {
            flex: 0 0 auto;  /* Keeps the logo at its natural size */
        }

        .NameOfMabuhay {
            position: absolute;
            top: 3%;
            left: 24.5%;
            /* transform: translate(-35%, -40%); */
            text-align: center;
        }

        .NameOfMabuhay span {
            display: block;
            margin: 2px 0;
            line-height: 1.6;
        }

        .Pangalan{
            font-size: 35px;
            font-weight: bold;
            color: rgb(0, 0, 154);
        }

        .Address{
            font-size: medium;
            color: rgb(7, 7, 178);
            letter-spacing: 4px;
            font-weight: bold;
        }

        .ReqNo{
            color: rgb(214, 0, 0);
            font-weight: bold;
            letter-spacing: 2px;
        }

        .TelNo{
            color: rgb(7, 7, 178);
            font-weight: bold;
            letter-spacing: 1.7px;
        }

        .Hrr{
            width: 100%;
            height: 1px;
            background: rgb(0, 81, 168);
            border: none;
        }     
    </style>
</head>
<body>
    <div class="A4">
        <header>
            <div class="LogoManuhay">
                <img style="width: 21%;" class="img-logo" src="Mabuhay_Logo.png">
            </div>
            <div class="NameOfMabuhay">
                <div>
                    <span class="Pangalan"> 
                        MABUHAY HOMES 2000 PHASE V
                    </span>
                </div>
                <div>
                    <Span class="Address"> Brgy. Salawag, Dasmarinas, Cavite</Span>
                </div>
                <div>
                    <Span class="ReqNo"> HLURB REG. &#35; 04-3792 </Span>
                </div>
                <div>
                    <Span class="TelNo"> Tel. No. 973-9422 </Span>
                </div>
            </div>
        </header>
        <hr class="Hrr"> 
    </div>
</body>
</html>