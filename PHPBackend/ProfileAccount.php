<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/apache/logs/error.log');

// Set content type to JSON
header('Content-Type: application/json');

// Start session and include database connection
session_start();
include_once "../Connect/Connection.php"; // Adjust the path to your Connection file
$conn = connection();

// Error handler function
function handleError($errno, $errstr, $errfile, $errline) {
    echo json_encode(['success' => false, 'error' => "$errstr in $errfile on line $errline"]);
    exit();
}

// Set custom error handler
set_error_handler('handleError');

// Function to close connection and respond with JSON
function closeConnectionAndRespond($conn, $response) {
    $conn->close();
    echo json_encode($response);
    exit();
}


// Handle the POST or GET request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = isset($_POST['action']) ? $_POST['action'] : null;
   if ($action === 'fetch_user_data') {
      $unique_id = $_POST['unique_id'];

      // Your database code to fetch data for the unique_id
      // For example:
      $sql = "
            SELECT tblresident.*, tblaccounts.img 
            FROM tblresident 
            INNER JOIN tblaccounts 
            ON tblresident.unique_id = tblaccounts.unique_id 
            WHERE tblresident.unique_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $unique_id);
      $stmt->execute();
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {  
          $row = $result->fetch_assoc();

          $pwd_value = $row['pwd'] ?? 'No';

          echo json_encode([
              'success' => true,
              'fname' => $row['first_name'] ?? null,
              'mname' => $row['middle_name'] ?? null,
              'lname' => $row['last_name'] ?? null,
              'suffix' => $row['suffix'] ?? null,
              'bday' => $row['birthday'] ?? null,
              'age' => $row['age'] ?? null,
              'sex' => $row['sex'] ?? null,
              'contact_number' => $row['phone_number'] ?? null,
              'block' => $row['block'] ?? null,
              'lot' => $row['lot'] ?? null,
              'street' => $row['street_name'] ?? null,
              'ec_name' => $row['ec_name'] ?? null,
              'ec_phone_number' => $row['ec_phone_num'] ?? null,
              'relationship' => $row['ec_relship'] ?? null,
              'ec_address' => $row['ec_address'] ?? null,
              'img' => $row['img'] ?? 'default_Image.png',
              'pwd' => $pwd_value
              
          ]);
          error_log('Fetched PWD value: ' . $row['pwd']);
          error_log('PWD Yes: ' . ($_POST['pwd_yes'] ?? 'not set'));
            error_log('PWD No: ' . ($_POST['pwd_no'] ?? 'not set'));


      } else {
          echo json_encode(['success' => false, 'message' => 'No data found for this user.']);
      }
      $stmt->close();

    } elseif ($action === 'update_user_data') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        $unique_id = $_POST['unique_id'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $suffix = $_POST['suffix'];
        $bday = $_POST['bday'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $contact_number = $_POST['contNum'];
        $ec_name = $_POST['ecName'];
        $ec_phone_number = $_POST['ecPhoneNum'];
        $ec_relationship = $_POST['relasyon'];
        $ec_address = $_POST['ecAddress'];
    
        $pwd = isset($_POST['pwd_yes']) ? 'Yes' : (isset($_POST['pwd_no']) ? 'No' : 'Walang laman');
    
        // Debug unique_id and form variables
        error_log("Unique ID: $unique_id");
        error_log("First Name: $fname, Last Name: $lname");
    
        // Debug FILES data
        error_log("FILES: " . print_r($_FILES, true));
    
        $image_filename = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_name = $_FILES['image']['name']; // Get the original file name
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_filename = basename($image_name); // Extract only the filename
    
            $image_path = '../Pictures/' . $image_filename;
    
            error_log("Image Name: $image_name");
            error_log("Temporary Path: $image_tmp_name");
            error_log("Target Path: $image_path");
    
            // Move the uploaded file to the target directory
            if (!move_uploaded_file($image_tmp_name, $image_path)) {
                error_log('File upload failed.');
                echo json_encode(['success' => false, 'message' => 'Error uploading image.']);
                exit;
            }
        } else {
            error_log('No image uploaded or file upload error.');
        }
    
        $sql_resident = "UPDATE tblresident SET 
                            first_name = ?, middle_name = ?, last_name = ?, suffix = ?, 
                            birthday = ?, age = ?, sex = ?, phone_number = ?, 
                            ec_name = ?, ec_phone_num = ?, ec_relship = ?, ec_address = ?, pwd = ?
                        WHERE unique_id = ?";
        $stmt_resident = $conn->prepare($sql_resident);
        $stmt_resident->bind_param(
            "sssssisissssss",
            $fname, $mname, $lname, $suffix, $bday, $age, $sex, $contact_number,
            $ec_name, $ec_phone_number, $ec_relationship, $ec_address, $pwd, $unique_id
        );
    
        if ($stmt_resident->execute()) {
            error_log("tblresident updated successfully for Unique ID: $unique_id");
        } else {
            error_log("Error updating tblresident: " . $stmt_resident->error);
            echo json_encode(['success' => false, 'message' => 'Error updating resident data.']);
            exit;
        }
        $stmt_resident->close();
    
        // If the image was uploaded, update the tblaccounts table with only the filename
        if ($image_filename) {
            $sql_accounts = "UPDATE tblaccounts SET img = ? WHERE unique_id = ?";
            $stmt_accounts = $conn->prepare($sql_accounts);
            $stmt_accounts->bind_param("ss", $image_filename, $unique_id); // Store only the filename
    
            if ($stmt_accounts->execute()) {
                error_log("tblaccounts updated successfully for Unique ID: $unique_id with Image: $image_filename");
            } else {
                error_log("Error updating tblaccounts: " . $stmt_accounts->error);
                echo json_encode(['success' => false, 'message' => 'Error updating image.']);
                exit;
            }
            $stmt_accounts->close();
        } else {
            error_log("Image not uploaded. tblaccounts update skipped.");
        }
    
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
    }
    
    
     elseif ($action === 'updateEmail') {
    // Get the old and new email from the POST request
    $oldEmail = $_POST['oldEmail'];
    $newEmail = $_POST['newEmail'];
    

    // Validate the new email to ensure it ends with '@gmail.com'
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL) || !str_ends_with($newEmail, '@gmail.com')) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid Gmail email address.']);
        exit();
    }

    // Check if the old email matches the one in the session
    if ($oldEmail === $_SESSION['email']) {
        // Sanitize the new email to avoid SQL injection
        $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);

        // Prepare the update query
        $sql = "UPDATE tblaccounts SET email = ? WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters: s = string
            $stmt->bind_param('ss', $newEmail, $oldEmail);

            // Execute the statement
            if ($stmt->execute()) {
                // If successful, update the session email
                $_SESSION['email'] = $newEmail;
                $response = array('success' => true, 'message' => 'Email updated successfully!');
                echo json_encode($response);
                exit; 
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating email: ' . $stmt->error]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'The old email does not match the current email.']);
    }

    } elseif ($action === 'changePassword') {
        // Retrieve old and new passwords
        $oldPass = $_POST['oldPass'] ?? '';
        $newPass = $_POST['newPass'] ?? '';
       

        // Check if user is logged in
        if (!isset($_SESSION['unique_id'])) {
            echo json_encode(['success' => false, 'message' => 'You must be logged in to change your password.']);
            exit();
        }

        $unique_id = $_SESSION['unique_id'];
       
        // Fetch the current MD5 hashed password from the database
        $sql = "SELECT password FROM tblaccounts WHERE unique_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $unique_id);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        if ($stmt->fetch()) {
            error_log("Fetched password: $hashedPassword"); // Log fetched password
        } else {
            error_log("No password found for email: $email"); // Log missing password
            echo json_encode(['success' => false, 'message' => 'Failed to verify your password.']);
            exit();
        }
        $stmt->close();

        // Verify the old password using MD5
        if (md5($oldPass) !== $hashedPassword) {
            error_log("Old password does not match."); // Log mismatch
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect.']);
            exit();
        }

        // Validate the new password
        if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{6,}$/', $newPass)) {
            error_log("New password does not meet criteria.");
            echo json_encode(['success' => false, 'message' => 'New password does not meet the required criteria.']);
            exit();
        }

        // Hash the new password with MD5 (not secure; consider upgrading)
        $newHashedPass = md5($newPass);
        error_log("New hashed password: $newHashedPass");

        // Update the password in the database
        $updateSql = "UPDATE tblaccounts SET password = ? WHERE unique_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        if (!$updateStmt) {
            error_log("Failed to prepare update statement: " . $conn->error); // Log SQL error
            echo json_encode(['success' => false, 'message' => 'Failed to process your request.']);
            exit();
        }
        $updateStmt->bind_param('ss', $newHashedPass, $unique_id);

        if ($updateStmt->execute()) {
            // error_log("Password updated successfully for $email."); // Log success
            echo json_encode(['success' => true, 'message' => 'Password updated successfully!']);
        } else {
            error_log("Failed to update password: " . $updateStmt->error);
            echo json_encode(['success' => false, 'message' => 'Failed to update password.']);
        }

        $updateStmt->close();
        
    } else {
        error_log('Failed to prepare SQL query: ' . $conn->error);
        error_log('Action not recognized');
        error_log("Invalid action: $action");
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
