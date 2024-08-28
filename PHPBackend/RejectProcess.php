<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if(isset($_POST['reject_user'])){
    $reject_userID = $_POST['reject_userID'];

     // Update tblresident
     $reject_userID_query_resident = "UPDATE tblresident SET access = 'Rejected' WHERE unique_id = '$reject_userID'";
     $reject_userID_query_run_resident = mysqli_query($conn, $reject_userID_query_resident);
 
     // Update tblaccounts
     $reject_userID_query_accounts = "UPDATE tblaccounts SET access = 'Rejected' WHERE unique_id = '$reject_userID'";
     $reject_userID_query_run_accounts = mysqli_query($conn, $reject_userID_query_accounts);
 
     if ($reject_userID_query_run_resident && $reject_userID_query_run_accounts) {
      
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('error' => 'Failed to rejecy user'));
    }
} else {
    echo json_encode(array('error' => 'Invalid Request'));
};
?>