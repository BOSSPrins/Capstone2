<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['loginpassword']);  

if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $enc_pass = $row['password'];

        if (md5($password) === $enc_pass) {
            $status = "Active now";
            $sql2 = mysqli_query($conn, "UPDATE tblaccounts SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id'];    
                $_SESSION['role'] = $row['role']; // Set the session role
                echo $row['role']; // Return only the session role
            } else {
                echo "Something went wrong. Please try again!";
            }
        } else {
            echo "Password is Incorrect!";
        }
    } else {
        echo "$email - This email does not exist!";
    }
} else {
    echo "All input fields are required!";
}
?>
