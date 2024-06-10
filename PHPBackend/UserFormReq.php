<?php
session_start();
include_once "../Connect/Connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required form fields are present
    if(isset($_POST['MubAwt'], $_POST['UID'], $_POST['Fname'], $_POST['Mname'], $_POST['Lname'], $_POST['block'], $_POST['lot'], $_POST['Stats'])) {
        // Establish database connection
        $conn = connection();
        
        // Get form data
        $formName = $_POST['MubAwt'];
        $UID = $_POST['UID'];
        $firstName = $_POST['Fname'];
        $middleName = $_POST['Mname'];
        $lastName = $_POST['Lname'];
        $block = $_POST['block'];
        $lot = $_POST['lot'];
        $status = $_POST['Stats'];

        // Prepare SQL query
        $query = "INSERT INTO forms (form_name, unique_id, first_name, middle_name, last_name, block, lot, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind parameters to placeholders
            $stmt->bind_param("ssssssss", $formName, $UID, $firstName, $middleName, $lastName, $block, $lot, $status);

            // Execute the statement
            $stmt->execute();

            // Check if the insertion was successful
            if ($stmt->affected_rows > 0) {
                echo "Data inserted successfully.";
                header("Location: ../UserRequest.php");
            } else {
                echo "Failed to insert data.";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Failed to prepare statement.";
        }
    } else {
        echo "One or more form fields are missing.";
    }
}
?>
