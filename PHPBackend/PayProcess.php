<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$response = array();

$paydate = mysqli_real_escape_string($conn, $_POST['paydate']);
$pay = floatval(mysqli_real_escape_string($conn, $_POST['pay']));
$unique_id = mysqli_real_escape_string($conn, $_POST['UID']);

// Check if file upload is set and not empty
if (isset($_FILES["proof"]) && !empty($_FILES["proof"]["tmp_name"])) {
    $target_dir = "../Pictures/"; // Directory where the file will be saved
    $target_file = $target_dir . basename($_FILES["proof"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    $i = 1;
    while (file_exists($target_file)) {
        $filename = pathinfo($target_file, PATHINFO_FILENAME);
        $extension = pathinfo($target_file, PATHINFO_EXTENSION);
        $target_file = $target_dir . $filename . "_$i." . $extension;
        $i++;
    }

    // Continue with file upload and database update
    if (move_uploaded_file($_FILES["proof"]["tmp_name"], $target_file)) {
        // File uploaded successfully
        $proof = basename($target_file); // Get the filename

        // Check if paydate and pay are set
        if (isset($paydate) && isset($pay)) {
            $update_payment_query = mysqli_query($conn, "UPDATE payments SET money = '$pay', proof = '$proof', paydate = '$paydate' WHERE unique_id = '$unique_id'");
        } else {
            $update_payment_query = mysqli_query($conn, "UPDATE payments SET proof = '$proof' WHERE unique_id = '$unique_id'");
        }

        if ($update_payment_query) {
            // Payment updated successfully
            $response['success'] = "Payment updated successfully.";
            
        } else {
            $response['error'] = "Error updating payment: " . mysqli_error($conn);
        }
    } else {
        $response['error'] = "Sorry, there was an error uploading your file.";
    }
} else {
    $response['error'] = "Proof of payment file is required.";
}

// Return the response as JSON
echo json_encode($response);
?>
