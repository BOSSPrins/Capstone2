<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

// Check if the form is submitted
if (isset($_POST['update_news'])) {
    // Retrieve the form data
    $news_id = $_POST['news_id'];
    $start_date = $_POST['start_date'];
    $start_time = $_POST['start_time'];
    $end_date = $_POST['end_date'];
    $end_time = $_POST['end_time'];
    $title = $_POST['title'];
    $context = $_POST['context'];

    // Handle file uploads
    $targetDirectory = "Pictures/";
    $uploadedFiles = array();
    foreach ($_FILES['images']['name'] as $key => $name) {
        $targetFilePath = $targetDirectory . basename($_FILES['images']['name'][$key]);
        if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $targetFilePath)) {
            $uploadedFiles[] = $targetFilePath;
        } else {
            // Handle file upload error
            echo "Failed to upload file: " . $_FILES['images']['error'][$key];
        }
    }

    // Prepare and execute update query
    $stmt = $mysqli->prepare("UPDATE announcements SET start_date=?, start_time=?, end_date=?, end_time=?, title=?, context=? WHERE news_id=?");

    // Bind parameters
    $stmt->bind_param("ssssssi", $start_date, $start_time, $end_date, $end_time, $title, $context, $news_id);

    // Execute the statement
    $stmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0) {
        // Query executed successfully
        echo json_encode(["success" => true]);
    } else {
        // Query failed
        echo json_encode(["error" => "Failed to update record"]);
    }

    // Close statement
    $stmt->close();
}

?>