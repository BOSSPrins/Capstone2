<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();


header('Content-Type: application/json');

if (isset($_POST['click_DocsModal']) && $_POST['click_DocsModal'] == true) {
    $forms_id = $_POST['forms_id'];

    // Assuming $conn is your database connection
    $query = "SELECT * FROM forms WHERE forms_id = '$forms_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode([$data]);
    } else {
        echo json_encode(['error' => 'No data found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>