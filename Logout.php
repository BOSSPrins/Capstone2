<?php

session_start();
if(isset($_SESSION['unique_id'])){
  include_once "Connect/Connection.php";

  $logout_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);

    if(isset($logout_id)){          // pang bago ng status kapag naglogout 
        $status = "Offline now";    
        $sql = mysqli_query($conn , "UPDATE tblaccounts SET status = '{$status}' WHERE unique_id = {$logout_id}");
        if($sql){
          session_unset();
          session_destroy();
          header("Location: LoginPage.php");
          
        }
    } else {
      header("Location: DashBoard.php");
      
    }
} else {
header("Location: LoginPage.php");
}
?>