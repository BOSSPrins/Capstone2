<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

function returnError($message) {
    echo json_encode(array('error' => $message));
    exit();
}

function fetchAnnouncementData($conn, $news_id) {
    // Use prepared statement to prevent SQL injection
    $retrieve_query = mysqli_prepare($conn, "SELECT * FROM announcements WHERE news_id = ?");
    mysqli_stmt_bind_param($retrieve_query, "s", $news_id);
    mysqli_stmt_execute($retrieve_query);
    $result = mysqli_stmt_get_result($retrieve_query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $images = explode(',', $row['img']);
        $row['img'] = $images;
        return $row;
    } else {
        returnError('No Data Found');
    }
}

function uploadImages($files) {
    $uploadDir = '../Pictures/';
    $uploadedFiles = [];

    foreach ($files['images']['name'] as $key => $name) {
        $fileName = basename($name);
        $filePath = $uploadDir . $fileName;
        if (move_uploaded_file($files['images']['tmp_name'][$key], $filePath)) {
            $uploadedFiles[] = $fileName;
        } else {
            returnError('Failed to upload one or more images');
        }
    }

    return $uploadedFiles;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['click_SaModal'])) {
        $news_id = $_POST['news_id'];
        $announcementData = fetchAnnouncementData($conn, $news_id);
        echo json_encode($announcementData);
    } elseif (isset($_POST['update_SaModal'])) {
        $news_id = $_POST['news_id'];
        $start_date = $_POST['start_date'];
        $start_time = $_POST['start_time'];
        $end_date = $_POST['end_date'];
        $end_time = $_POST['end_time'];
        $title = $_POST['title'];
        $context = $_POST['context'];
        $remaining_images = json_decode($_POST['remaining_images'], true);
        $initial_images = json_decode($_POST['initial_images'], true);

        $new_images = [];
        if (!empty($_FILES['images']['name'][0])) {
            $new_images = uploadImages($_FILES);
        }

        // Combine remaining images and new images
        $all_images = array_merge($remaining_images, $new_images);
        $images_string = implode(',', $all_images);

        // Use prepared statement to prevent SQL injection
        $update_query = mysqli_prepare($conn, "UPDATE announcements SET start_date = ?, start_time = ?, end_date = ?, end_time = ?, title = ?, context = ?, img = ? WHERE news_id = ?");
        mysqli_stmt_bind_param($update_query, "ssssssss", $start_date, $start_time, $end_date, $end_time, $title, $context, $images_string, $news_id);
        mysqli_stmt_execute($update_query);

        if (mysqli_stmt_affected_rows($update_query) > 0) {
            echo json_encode(array('success' => 'Data updated successfully'));
        } else {
            returnError('Failed to update data');
        }
    } else {
        returnError('Invalid Request');
    }
} else {
    returnError('Invalid Request Method');
}
?>
