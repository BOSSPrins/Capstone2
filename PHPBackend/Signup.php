<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_log("Starting PHP script");

$access = "Pending";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$mname = mysqli_real_escape_string($conn, $_POST['mname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);
$block = mysqli_real_escape_string($conn, $_POST['block']);
$lot = mysqli_real_escape_string($conn, $_POST['lot']);
$street = mysqli_real_escape_string($conn, $_POST['street']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$role = "user";

$disabilities = isset($_POST['disabilities']) ? mysqli_real_escape_string($conn, $_POST['disabilities']) : 'No';

// Default image path if no image is uploaded
$default_image_path = 'Mabuhay_Logo.png'; // Update with the actual path to your default image

if (empty($age) && !empty($dob)) {
    $dobDate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($dobDate)->y;
}

function isGmailOrYahoo($email) {
    $domain = substr(strrchr($email, "@"), 1);
    $allowedDomains = ["gmail.com", "yahoo.com"];
    return in_array($domain, $allowedDomains);
}

if(!empty($access) && !empty($fname) && !empty($mname) && !empty($lname) && !empty($suffix) && !empty($gender) && !empty($age) && !empty($disabilities) && !empty($dob) && !empty($phonenum) && !empty($block) && !empty($lot) && !empty($street) && !empty($email) && !empty($password) && !empty($role)) {

    if(!isGmailOrYahoo($email)) {
        echo "Only Yahoo or Gmail can be used.";
        exit();
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exists!";
        } else {
            // Use default image if no image is uploaded
            $img_name = isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $default_image_path;

            $ran_id = rand(time(), 100000000);
            $status = "Pending";
            $encrypt_pass = md5($password);

            // Insert user data into tblresident
            $insert_query_data = mysqli_query($conn, "INSERT INTO tblresident (unique_id, access, first_name, middle_name, last_name, suffix, sex, age, pwd, birthday, block, lot, street_name, phone_number)
            VALUES ('{$ran_id}', '{$access}', '{$fname}', '{$mname}', '{$lname}', '{$suffix}', '{$gender}', '{$age}', '{$disabilities}', '{$dob}', '{$block}', '{$lot}', '{$street}', '{$phonenum}')");

            if (!$insert_query_data) {
                error_log("Insert query failed: " . mysqli_error($conn));
                echo "Database insertion failed!";
                exit();
            }

            // Insert account data into tblaccounts
            $insert_query_account = mysqli_query($conn, "INSERT INTO tblaccounts (unique_id, email, password, img, status, role, access)
            VALUES ('{$ran_id}', '{$email}', '{$encrypt_pass}', '{$img_name}', '{$status}', '{$role}', '{$access}')");

            if($insert_query_account) {
                $select_sql2 = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");

                if(mysqli_num_rows($select_sql2) > 0) {
                    $result = mysqli_fetch_assoc($select_sql2);
                    $_SESSION['unique_id'] = $result['unique_id'];
                    echo "success";
                } else {
                    error_log("This email address does not exist!");
                    echo "This email address does not exist!";
                }
            } else {
                error_log("Account insertion failed: " . mysqli_error($conn));
                echo "Something went wrong. Please try again!";
            }
        }
    } else {
        error_log("$email is not a valid email!");
        echo "$email is not a valid email!";
    }
} else {
    error_log("All input fields are required!");
    echo "All input fields are required!";
}



//Lumang code to in case lang na may hanapin 
// session_start();
// include_once "../Connect/Connection.php";
// $conn = connection();

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// error_log("Starting PHP script");

// $access = "Pending";
// $fname = mysqli_real_escape_string($conn, $_POST['fname']);
// $mname = mysqli_real_escape_string($conn, $_POST['mname']);
// $lname = mysqli_real_escape_string($conn, $_POST['lname']);
// $suffix = mysqli_real_escape_string($conn, $_POST['suffix']);
// $gender = mysqli_real_escape_string($conn, $_POST['gender']);
// $dob = mysqli_real_escape_string($conn, $_POST['dob']);
// $age = mysqli_real_escape_string($conn, $_POST['age']);
// $phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);
// $block = mysqli_real_escape_string($conn, $_POST['block']);
// $lot = mysqli_real_escape_string($conn, $_POST['lot']);
// $street = mysqli_real_escape_string($conn, $_POST['street']);
// $email = mysqli_real_escape_string($conn, $_POST['email']);
// $password = mysqli_real_escape_string($conn, $_POST['password']);
// $role = "user";
// $disabilities = isset($_POST['disabilities']) ? mysqli_real_escape_string($conn, $_POST['disabilities']) : 'No';

// if (empty($age) && !empty($dob)) {
//     $dobDate = new DateTime($dob);
//     $today = new DateTime();
//     $age = $today->diff($dobDate)->y;
// }

// function isGmailOrYahoo($email) {
//     $domain = substr(strrchr($email, "@"), 1);
//     $allowedDomains = ["gmail.com", "yahoo.com"];
//     return in_array($domain, $allowedDomains);
// }

// if (!empty($access) && !empty($fname) && !empty($mname) && !empty($lname) && !empty($gender) && !empty($suffix) && !empty($disabilities) && !empty($dob) && !empty($phonenum) && !empty($block) && !empty($lot) && !empty($street) && !empty($email) && !empty($password) && !empty($role)) {

//     if (!isGmailOrYahoo($email)) {
//         echo "Only Yahoo or Gmail can be used.";
//         error_log("Invalid email domain: $email");
//         exit();
//     }

//     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

//         error_log("Valid email: $email");

//         $sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");
//         if (mysqli_num_rows($sql) > 0) {
//             error_log("Email already exists: $email");
//             echo "$email - This email already exists!";
//         } else {

//             if (isset($_FILES['image'])) {
//                 $img_name = $_FILES['image']['name'];
//                 $img_type = $_FILES['image']['type'];
//                 $tmp_name = $_FILES['image']['tmp_name'];
                
//                 $img_explode = explode('.', $img_name);
//                 $img_ext = end($img_explode);

//                 $extensions = ["jpeg", "png", "jpg"];
//                 if (in_array($img_ext, $extensions) === true) {
//                     $types = ["image/jpeg", "image/jpg", "image/png"];
//                     if (in_array($img_type, $types) === true) {
//                         $time = time();
//                         $new_img_name = $time . $img_name;

//                         if (move_uploaded_file($tmp_name, "../Pictures/" . $new_img_name)) {
//                             $ran_id = rand(time(), 100000000);
//                             $status = "Pending";
//                             $encrypt_pass = md5($password);

//                             $insert_query_data = mysqli_query($conn, "INSERT INTO tblresident (unique_id, access, first_name, middle_name, last_name, suffix, sex, age, pwd, birthday, block, lot, street_name, phone_number)
//                                 VALUES ('{$ran_id}', '{$access}','{$fname}', '{$mname}', '{$lname}', '{$suffix}', '{$gender}', '{$age}', '{$disabilities}', '{$dob}', '{$block}', '{$lot}', '{$street}', '{$phonenum}')");

//                             if (!$insert_query_data) {
//                                 error_log("Insert query failed: " . mysqli_error($conn));
//                                 echo "Database insertion failed!";
//                                 exit();
//                             }

//                             $insert_query_account = mysqli_query($conn, "INSERT INTO tblaccounts (unique_id, email, password, img, status, role, access)
//                                 VALUES ('{$ran_id}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}', '{$role}', '{$access}')");

//                             if ($insert_query_account) {
//                                 $select_sql2 = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");

//                                 if (mysqli_num_rows($select_sql2) > 0) {
//                                     $result = mysqli_fetch_assoc($select_sql2);
//                                     $_SESSION['unique_id'] = $result['unique_id'];
//                                     echo "success";
//                                 } else {
//                                     error_log("This email address does not exist!");
//                                     echo "This email address does not exist!";
//                                 }
//                             } else {
//                                 error_log("Account insertion failed: " . mysqli_error($conn));
//                                 echo "Something went wrong. Please try again!";
//                             }
//                         } else {
//                             error_log("Failed to move uploaded file.");
//                             echo "Please upload an image file - jpeg, png, jpg";
//                         }
//                     } else {
//                         error_log("Invalid image type.");
//                         echo "Please upload an image file - jpeg, png, jpg";
//                     }
//                 } else {
//                     error_log("Invalid image extension.");
//                     echo "Please upload an image file - jpeg, png, jpg";
//                 }
//             } else {
//                 error_log("No image file uploaded.");
//                 echo "No image file uploaded.";
//             }
//         }
//     } else {
//         error_log("Invalid email address: $email");
//         echo "$email is not a valid email!";
//     }
// } else {
//     error_log("All input fields are required!");
//     echo "All input fields are required!";
// }

?>