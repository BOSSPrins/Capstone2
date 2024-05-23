<?php 
  session_start();
  include_once "../Connect/Connection.php";
  $conn = connection();

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['loginpassword']);  

   if(!empty($email) && !empty($password)){
                                                       //checking na ng pang login 
      $sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");

         if(mysqli_num_rows($sql) > 0 ){       //check ba kung tugma ba sila ba ang paswurd ba ga at imeyl ba 

            $row = mysqli_fetch_assoc($sql);
            $enc_pass = $row['password']; // pagset ng pass sa variable kasi naka encrypt yung pass

               if(md5($password) === $enc_pass){
                  $status = "Active now";
                  $sql2 = mysqli_query($conn, "UPDATE tblaccounts SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

                     if($sql2){
                        $_SESSION['unique_id'] = $row['unique_id'];
                        echo "success";
                     }else{
                        echo "Something went wrong. Please try again!";
                     }
               } elseif (md5($password) !== $enc_pass) {
                  echo "Password is Incorrect!";
               }
         }else{
            echo "$email - This email not Exist!";
         }
   } else {
      echo "All input fields are required!";
   }
?>