<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if (isset($_POST['click_BiyuModal'])) {

  $id = $_POST['user_id'];
  $arrayresult = [];
  
  $retrieve_query = mysqli_query($conn,"SELECT * FROM tblresident WHERE user_id = '$id' AND access = 'Pending'");

  if (mysqli_num_rows($retrieve_query) > 0 ){ 

    while ($row = mysqli_fetch_assoc($retrieve_query)) {

        array_push($arrayresult, $row);
        header('content-type:/json');
        echo json_encode($arrayresult);
      
    }
  }
}
else 
{
  echo '<h4>No Data Found</h4>';
}






?>