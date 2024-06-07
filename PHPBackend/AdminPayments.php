<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$start_date = mysqli_real_escape_string($conn, $_POST['Ddate']);
$start_time = mysqli_real_escape_string($conn, $_POST['Ovdate']);
$end_date = mysqli_real_escape_string($conn, $_POST['MDue']);
$end_time = mysqli_real_escape_string($conn, $_POST['WBill']);       //Getting Inputs For Admin Residents data
$unique_id = mysqli_real_escape_string($conn, $_POST['UID']);

if(!empty($pay)) {

} else {
    echo "Payment amount is required!";
}




?>