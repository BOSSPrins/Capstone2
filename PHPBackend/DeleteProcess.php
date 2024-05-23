<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if(isset($_POST['Confirm_DEL'])){
    $delete_newsID = $_POST['delete_newsID'];

    $delete_newsID_query = "DELETE FROM announcements WHERE news_id = '$delete_newsID'";
    $delete_newsID_query_run = mysqli_query($conn, $delete_newsID_query);

    if ($delete_newsID_query_run) {
    echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('error' => 'Failed to delete record'));
    }
} else {
    echo json_encode(array('error' => 'Invalid Request'));
};
?>