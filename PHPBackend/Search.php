<?php
  session_start();
  include_once "../Connect/Connection.php";
  $outgoing_id = $_SESSION['unique_id'];

  $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
  $output = "";
  $sql = mysqli_query($conn, "SELECT tblaccounts.*, tblresident.first_name, tblresident.last_name  
                              FROM tblaccounts
                              INNER JOIN tblresident ON tblaccounts.unique_id = tblresident.unique_id
                              WHERE (tblresident.first_name LIKE '%{$searchTerm}%'
                              OR tblresident.last_name LIKE '%{$searchTerm}%')
                              AND tblaccounts.access = 'Approved'
                              AND NOT tblaccounts.unique_id = {$outgoing_id}
                              ORDER BY (tblaccounts.status = 'Active now') DESC, tblresident.first_name ASC");
                        
  if(mysqli_num_rows($sql) > 0){
    include "Data.php";
  } else {
    $output .= "No user found.";
  }
  echo $output;
?>