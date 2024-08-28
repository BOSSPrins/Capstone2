<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if(isset($_POST['Confirm_conf'])){
    $confirm_userID = $_POST['confirm_userID'];

     // Update tblresident
     $confirm_userID_query_resident = "UPDATE tblresident SET access = 'Approved' WHERE unique_id = '$confirm_userID'";
     $confirm_userID_query_run_resident = mysqli_query($conn, $confirm_userID_query_resident);
 
     // Update tblaccounts
     $confirm_userID_query_accounts = "UPDATE tblaccounts SET access = 'Approved' WHERE unique_id = '$confirm_userID'";
     $confirm_userID_query_run_accounts = mysqli_query($conn, $confirm_userID_query_accounts);
 
     if ($confirm_userID_query_run_resident && $confirm_userID_query_run_accounts) {
      
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('error' => 'Failed to confirm user'));
    }
} else {
    echo json_encode(array('error' => 'Invalid Request'));
};
?>