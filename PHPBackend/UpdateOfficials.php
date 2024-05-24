<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if (isset($_POST['role']) && isset($_POST['name'])) {
    $role = $_POST['role'];
    $name = $_POST['name'];

    $image_url = null;
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        // Handle file upload
        $targetDir = "../Pictures/";
        $image_url = basename($_FILES['image_url']['name']);
        $targetFilePath = $targetDir . $image_url;

        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $targetFilePath)) {
            // File upload successful
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
            exit;
        }
    }

    // Prepare and bind the update query
    if ($image_url) {
        $stmt = $conn->prepare("UPDATE officials SET name = ?, img = ? WHERE roles = ?");
        $stmt->bind_param("sss", $name, $image_url, $role);
    } else {
        $stmt = $conn->prepare("UPDATE officials SET name = ? WHERE roles = ?");
        $stmt->bind_param("ss", $name, $role);
    }
    
    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update data']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}
?>
