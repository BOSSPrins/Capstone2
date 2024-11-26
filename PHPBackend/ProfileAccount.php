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
      $sql = "SELECT * FROM tblresident WHERE unique_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $unique_id);
      $stmt->execute();
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
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
              'pwd' => $row['pwd'] ?? null
          ]);
      } else {
          echo json_encode(['success' => false, 'message' => 'No data found for this user.']);
      }
      $stmt->close();

  } elseif ($action === 'update_user_data') {
      
        $unique_id = $_POST['unique_id'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $suffix = $_POST['suffix'];
        $bday = $_POST['bday'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $contact_number = $_POST['contNum'];
        $block = $_POST['blk'];
        $lot = $_POST['lot'];
        $street = $_POST['street'];
        $ec_name = $_POST['ecName'];
        $ec_phone_number = $_POST['ecPhoneNum'];
        $ec_relationship = $_POST['relasyon'];
        $ec_address = $_POST['ecAddress'];
       
        // Check if password (PWD) status is provided and set it accordingly
        $pwd = isset($_POST['pwd_yes']) ? 'Yes' : (isset($_POST['pwd_no']) ? 'No' : 'Walang laman');

        // Prepare the UPDATE SQL query
        $sql = "UPDATE tblresident SET 
                    first_name = ?, middle_name = ?, last_name = ?, suffix = ?, 
                    birthday = ?, age = ?, sex = ?, phone_number = ?, 
                    block = ?, lot = ?, street_name = ?, ec_name = ?, 
                    ec_phone_num = ?, ec_relship = ?, ec_address = ?, pwd = ?
                WHERE unique_id = ?";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param(
            "sssssisiiississss", 
            $fname, $mname, $lname, $suffix, $bday, $age, $sex, $contact_number, 
            $block, $lot, $street, $ec_name, $ec_phone_number, $ec_relationship, $ec_address, $pwd, $unique_id
        );

        // Execute the update query
        if ($stmt->execute()) {
          echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
        } else {
          error_log('Error executing SQL query: ' . $stmt->error);
          echo json_encode(['success' => false, 'message' => 'Error updating profile: ' . $stmt->error]);
        }

        $stmt->close();

      } elseif ($action === 'updateEmail') {
      // Get the old and new email from the POST request
      $oldEmail = $_POST['oldEmail'];
      $newEmail = $_POST['newEmail'];
      var_dump($oldEmail, $newEmail);
  
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

  } else {
      error_log('Failed to prepare SQL query: ' . $conn->error);
      error_log('Action not recognized');
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
