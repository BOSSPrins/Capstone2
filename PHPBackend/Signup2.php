<?php
session_start();
include_once "../Connect/Connection.php";
// Removed OtpEmail.php since we no longer need it

$conn = connection();

// Collect form data
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

// Check disabilities (Yes or No)
$disabilities = isset($_POST['disabilities']) ? mysqli_real_escape_string($conn, $_POST['disabilities']) : '';

// Check if required fields are not empty
if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($gender) || empty($dob) || empty($phonenum)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required!']);
    exit();
}

// Check if the block and lot already exist in the database (duplicate household)
// $block_lot_check = mysqli_query($conn, "SELECT * FROM tblresident WHERE block = '{$block}' AND lot = '{$lot}'");
// if (mysqli_num_rows($block_lot_check) > 0) {
//     echo json_encode(['success' => false, 'message' => 'This household is already registered!']);
//     exit();
// }

// Check if the email already exists in the tblaccounts
$sql = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE email = '{$email}'");
if (mysqli_num_rows($sql) > 0) {
    echo json_encode(['success' => false, 'message' => "$email - This email already exists!"]);
    exit();
}

// Function to generate unique ID and check if it exists
function generateUniqueId($conn) {
    $ran_id = rand(time(), 100000000); // Generate random ID
    // Check if the ID already exists in tblresident or tblaccounts
    $check_query = mysqli_query($conn, "SELECT * FROM tblresident WHERE unique_id = '{$ran_id}'");
    $check_account = mysqli_query($conn, "SELECT * FROM tblaccounts WHERE unique_id = '{$ran_id}'");

    if (mysqli_num_rows($check_query) > 0 || mysqli_num_rows($check_account) > 0) {
        // If the ID exists, call the function again to generate a new ID
        return generateUniqueId($conn);
    }
    return $ran_id;
}

// Generate a unique ID
$ran_id = generateUniqueId($conn);
 

// Use the uploaded image or default if none is uploaded
$default_image_path = 'default_Image.png';
$img_name = isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $default_image_path;

// Encrypt the password
$encrypt_pass = md5($password);

$pwd_id = isset($_FILES['pwdId']) && $_FILES['pwdId']['name'] != '' ? $_FILES['pwdId']['name'] : 'N/A';

// If the file is uploaded, handle the image upload process
if ($pwd_id !== 'N/A') {
    // Define the target directory for image uploads
    $target_dir = "../Pictures/"; // Adjust this path as necessary
    $target_file = $target_dir . basename($_FILES['pwdId']['name']);
    $uploadOk = 1;

    // Check if the uploaded file is a valid image (optional)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (getimagesize($_FILES['pwdId']['tmp_name']) === false) {
        echo json_encode(['success' => false, 'message' => 'File is not an image.']);
        exit();
    }

    // Check if file already exists (optional)
    // if (file_exists($target_file)) {
    //     echo json_encode(['success' => false, 'message' => 'Sorry, file already exists.']);
    //     exit();
    // }

    // Check file size (optional)
    if ($_FILES['pwdId']['size'] > 500000) { // Example size limit, adjust as needed
        echo json_encode(['success' => false, 'message' => 'Sorry, your file is too large.']);
        exit();
    }

    // Allow certain file formats (optional)
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
        echo json_encode(['success' => false, 'message' => 'Sorry, only JPG, JPEG, PNG files are allowed.']);
        exit();
    }

    // Try to upload the file
    if (move_uploaded_file($_FILES['pwdId']['tmp_name'], $target_file)) {
        // File uploaded successfully, continue with the rest of the code
        $pwd_id = basename($_FILES['pwdId']['name']); // Get the file name
    } else {
        echo json_encode(['success' => false, 'message' => 'Sorry, there was an error uploading your file.']);
        exit();
    }
}


// Insert personal details into tblresident
$insert_query_resident = mysqli_query($conn, "INSERT INTO tblresident (unique_id, access, first_name, middle_name, last_name, suffix, sex, age, pwd, pwd_id, birthday, block, lot, street_name, phone_number)
            VALUES ('{$ran_id}', 'Pending', '{$fname}', '{$mname}', '{$lname}', '{$suffix}', '{$gender}', '{$age}', '{$disabilities}', '{$pwd_id}', '{$dob}', '{$block}', '{$lot}', '{$street}', '{$phonenum}')");

if (!$insert_query_resident) {
    echo json_encode(['success' => false, 'message' => 'Failed to insert personal details.']);
    exit();
}

// Insert account details into tblaccounts with status "Pending"
$insert_query_account = mysqli_query($conn, "INSERT INTO tblaccounts (unique_id, email, password, img, status, role, access)
            VALUES ('{$ran_id}', '{$email}', '{$encrypt_pass}', '{$img_name}', 'Offline now', 'user', 'Pending')");

if ($insert_query_account) {
    // Removed OTP generation and sending
    
    echo json_encode(['success' => true, 'message' => 'Personal details saved. Account created successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create user account.']);
}
?>
