<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Report</title>
    <link id="favicon" rel="icon" href="Pictures/Mabuhay_Logo.ico">
    <style>
        html, body {
            margin: 0;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <iframe src="<?php echo $_GET['file']; ?>"></iframe>
</body>
</html>
