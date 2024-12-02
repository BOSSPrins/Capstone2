<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
error_log("Starting PHP script");

$access = "Pending";
$fname = isset($_POST['fname']) ? mysqli_real_escape_string($conn, $_POST['fname']) : '';
$mname = isset($_POST['mname']) ? mysqli_real_escape_string($conn, $_POST['mname']) : '';
$lname = isset($_POST['lname']) ? mysqli_real_escape_string($conn, $_POST['lname']) : '';
$suffix = isset($_POST['suffix']) ? mysqli_real_escape_string($conn, $_POST['suffix']) : '';
$gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : ''; // Ensure 'gender' is set
$dob = isset($_POST['dob']) ? mysqli_real_escape_string($conn, $_POST['dob']) : '';
$age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : '';
$phonenum = isset($_POST['phonenum']) ? mysqli_real_escape_string($conn, $_POST['phonenum']) : '';
$block = isset($_POST['block']) ? mysqli_real_escape_string($conn, $_POST['block']) : '';
$lot = isset($_POST['lot']) ? mysqli_real_escape_string($conn, $_POST['lot']) : '';
$street = isset($_POST['street']) ? mysqli_real_escape_string($conn, $_POST['street']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
$role = "user";

$disabilities = isset($_POST['disabilities']) ? mysqli_real_escape_string($conn, $_POST['disabilities']) : 'No';

// Default image path if no image is uploaded
$default_image_path = 'default_Image.png'; // Update with the actual path to your default image

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

if(!empty($access) && !empty($fname) && !empty($lname) && !empty($gender) && !empty($age) && !empty($disabilities) && !empty($dob) && !empty($phonenum) && !empty($block) && !empty($lot) && !empty($email) && !empty($password) && !empty($role)) {

    if(!isGmailOrYahoo($email)) {
        echo "Only Yahoo or Gmail can be used.";
        exit();
    }

    // Validate the new password
    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{6,}$/', $password)) {
        error_log("New password does not meet criteria.");
        echo json_encode(['success' => false, 'message' => 'Your password must be at least 6 characters long and include a combination of numbers, letters, and special characters.']);
        exit();
    }

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $block_lot_check = mysqli_query($conn, "SELECT * FROM tblresident WHERE block = '{$block}' AND lot = '{$lot}'");
        if(mysqli_num_rows($block_lot_check) > 0) {
            echo "This household is already registered!";
            exit();
        }

        $sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exists!";
        } else {
            // Use default image if no image is uploaded
            $img_name = isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $default_image_path;

            $ran_id = rand(time(), 100000000);
            $status = "Offline now";
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

                $verified_query = mysqli_query($conn, "SELECT email, status FROM verified_email WHERE email = '{$email}' AND status = 'Verified'");
                if (mysqli_num_rows($verified_query) > 0) {
                    $verified_data = mysqli_fetch_assoc($verified_query);
                    $verified_status = $verified_data['status'];
                    
                    $update_otp_query = mysqli_query($conn, "UPDATE tblaccounts SET otp = '{$verified_status}' WHERE email = '{$email}'");
                    if (!$update_otp_query) {
                        echo "Failed to update OTP status!";
                        exit();
                    }
                }

                $select_sql2 = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");
                if(mysqli_num_rows($select_sql2) > 0) {
                    $result = mysqli_fetch_assoc($select_sql2);
                    $_SESSION['unique_id'] = $result['unique_id'];
                    if (isset($_SESSION['otp_status'])) {
                        unset($_SESSION['otp_status']);
                    }
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

?>