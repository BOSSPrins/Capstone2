<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if (isset($_POST['role'])) {
    $stmt = $conn->prepare("SELECT name, img FROM officials WHERE roles = ?");
    $stmt->bind_param("s", $_POST['role']);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = array();
    if ($row = $result->fetch_assoc()) {
        $response['name'] = $row['name'];
        $response['image_url'] = $row['img'];
    }

    $stmt->close();
    $conn->close();

    echo json_encode($response);
}
?>
