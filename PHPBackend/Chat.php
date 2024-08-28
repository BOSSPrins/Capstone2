<?php 
  session_start();
  include_once "../Connect/Connection.php";
  $outgoing_id = $_SESSION['unique_id'];

  $sql = mysqli_query($conn, "SELECT tblaccounts.*, tblresident.first_name, tblresident.last_name
                              FROM tblaccounts
                              INNER JOIN tblresident ON tblaccounts.unique_id = tblresident.unique_id
                              WHERE NOT tblaccounts.unique_id = {$outgoing_id} AND tblaccounts.access = 'Approved'");
  $output = "";

  if(mysqli_num_rows($sql) == 1){

    $output .= "No users available to chat";

  } elseif (mysqli_num_rows($sql) > 0) {
      include "Data.php";
  }
  echo $output;

?>