<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if (isset($_POST['click_DocsModal'])) {

    $id = $_POST['forms_id'];
    $arrayresult = [];

    $retrieve_query = mysqli_query($conn,"SELECT * FROM forms WHERE forms_id = '$id'");

    if (mysqli_num_rows($retrieve_query) > 0 ){ 
        // Set header outside the loop
        header('content-type: application/json');

        while ($row = mysqli_fetch_assoc($retrieve_query)) {
            array_push($arrayresult, $row);
        }
        
        // Send JSON data
        echo json_encode($arrayresult);
        exit(); // Exit after sending JSON data
    } else {
        echo '<h4>No Data Found</h4>';
    }
}
?>
