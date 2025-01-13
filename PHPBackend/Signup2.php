<?php
session_start();
include_once "../Connect/Connection.php";
include_once "../Emailer/OtpEmail.php"; // Include the emailer file

$conn = connection();

// Collect form data
$fname = isset($_POST['fname']) ? mysqli_real_escape_string($conn, $_POST['fname']) : '';
$mname = isset($_POST['mname']) ? mysqli_real_escape_string($conn, $_POST['mname']) : '';
$lname = isset($_POST['lname']) ? mysqli_real_escape_string($conn, $_POST['lname']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';
$gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : ''; // Ensure 'gender' is set
$dob = isset($_POST['dob']) ? mysqli_real_escape_string($conn, $_POST['dob']) : '';
$phonenum = isset($_POST['phonenum']) ? mysqli_real_escape_string($conn, $_POST['phonenum']) : '';
$block = isset($_POST['block']) ? mysqli_real_escape_string($conn, $_POST['block']) : '';
$lot = isset($_POST['lot']) ? mysqli_real_escape_string($conn, $_POST['lot']) : '';
$street = isset($_POST['street']) ? mysqli_real_escape_string($conn, $_POST['street']) : '';

// Check if required fields are not empty
if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($gender) || empty($dob) || empty($phonenum)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required!']);
    exit();
}

// Check if the block and lot already exist in the database (duplicate household)
$block_lot_check = mysqli_query($conn, "SELECT * FROM tblresident WHERE block = '{$block}' AND lot = '{$lot}'");
if (mysqli_num_rows($block_lot_check) > 0) {
    echo json_encode(['success' => false, 'message' => 'This household is already registered!']);
    exit();
}

// Check if the email already exists in the tblaccounts
$sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");
if (mysqli_num_rows($sql) > 0) {
    echo json_encode(['success' => false, 'message' => "$email - This email already exists!"]);
    exit();
}

// Generate a unique ID for the user
$ran_id = rand(time(), 100000000);

// Default image if none is uploaded
$default_image_path = 'default_Image.png'; 

// Use the uploaded image or default if none is uploaded
$img_name = isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $default_image_path;

// Encrypt the password
$encrypt_pass = md5($password);

// Insert personal details into tblresident
$insert_query_resident = mysqli_query($conn, "INSERT INTO tblresident (unique_id, access, first_name, middle_name, last_name, suffix, sex, age, pwd, birthday, block, lot, street_name, phone_number)
            VALUES ('{$ran_id}', 'Pending', '{$fname}', '{$mname}', '{$lname}', '', '{$gender}', '{$dob}', '{$password}', '{$dob}', '{$block}', '{$lot}', '{$street}', '{$phonenum}')");

if (!$insert_query_resident) {
    echo json_encode(['success' => false, 'message' => 'Failed to insert personal details.']);
    exit();
}

// Insert account details into tblaccounts with status "Pending"
$insert_query_account = mysqli_query($conn, "INSERT INTO tblaccounts (unique_id, email, password, img, status, role, access)
            VALUES ('{$ran_id}', '{$email}', '{$encrypt_pass}', '{$img_name}', 'Offline now', 'user', 'Pending')");

if ($insert_query_account) {
    // Generate OTP and store it in session
    $otp = rand(100000, 999999);  // Generate a 6-digit OTP
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_email'] = $email;  // Store the email for later verification
    $_SESSION['otp_expiry'] = time() + 60;  // OTP valid for 1 minute
    
    error_log("Generated OTP: " . $otp);

    // Send OTP to the user’s email using the emailer function
    if (sendOTPEmail($email, $otp)) {
        echo json_encode(['success' => true, 'message' => 'Personal details saved. OTP sent to your email.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send OTP.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create user account.']);
}
?>
