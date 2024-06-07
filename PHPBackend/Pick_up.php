<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $forms_id = htmlspecialchars($_POST['forms_id']);
    $new_status = htmlspecialchars($_POST['new_status']);

    // Update the status of the form
    $query = "UPDATE forms SET status = ? WHERE forms_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $new_status, $forms_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
