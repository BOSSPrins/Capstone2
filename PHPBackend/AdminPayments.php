<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$due_date = mysqli_real_escape_string($conn, $_POST['Ddate']);
// $over_date = mysqli_real_escape_string($conn, $_POST['Ovdate']);
$month_due = floatval(mysqli_real_escape_string($conn, $_POST['MDue']));
$water_bill = floatval(mysqli_real_escape_string($conn, $_POST['WBill'])); 
$totalAmount = floatval(mysqli_real_escape_string($conn, $_POST['totalAmount']));      //Getting Inputs For Admin Residents data
$unique_id = mysqli_real_escape_string($conn, $_POST['UID']);

if (!empty($due_date) && empty($over_date) && !empty($month_due) && !empty($water_bill) && !empty($totalAmount) && !empty($unique_id)) {
    // Check if the unique_id already exists in the payments table
    $check_query = mysqli_query($conn, "SELECT * FROM payments WHERE unique_id = '$unique_id'");
    if (mysqli_num_rows($check_query) > 0) {
        // Unique ID already exists, so update the record
        $update_query = mysqli_query($conn, "UPDATE payments SET month_due = '$month_due', water_bill = '$water_bill', due_date = '$due_date', total = '$totalAmount' WHERE unique_id = '$unique_id'");
        if ($update_query) {
            echo "success";
        } else {
            echo "Error updating payment: " . mysqli_error($conn);
        }
    } else {
        // Unique ID does not exist, so insert a new record
        $insert_query = mysqli_query($conn, "INSERT INTO payments (unique_id, month_due, water_bill, due_date, total, overdue) VALUES ('$unique_id', '$month_due', '$water_bill', '$due_date', '$totalAmount', '$over_date')");
        if ($insert_query) {
            echo "success";
        } else {
            echo "Error inserting payment: " . mysqli_error($conn);
        }
    }
} else {
    echo "All input is required!";
}
?>
