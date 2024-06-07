<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $forms_id = htmlspecialchars($_POST['forms_id']);

    // Update the status of the form
    $query = "UPDATE forms SET status = 'Verifying' WHERE forms_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $forms_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
