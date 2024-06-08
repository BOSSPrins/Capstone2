<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'getDetails') {
            $unique_id = mysqli_real_escape_string($conn, $_POST['UID']);

            $query = "SELECT money, proof FROM payments WHERE unique_id = '$unique_id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $response['money'] = $row['money'];
                    $response['proof'] = $row['proof'];
                } else {
                    $response['error'] = "No payment found for this user.";
                }
            } else {
                $response['error'] = "Query failed: " . mysqli_error($conn);
            }
        } elseif ($action == 'updatePayment') {
            $pay = mysqli_real_escape_string($conn, $_POST['userBayad']);
            $unique_id = mysqli_real_escape_string($conn, $_POST['UID']);
            $ref_no = mysqli_real_escape_string($conn, $_POST['userRefer']); 

            // Update the payments table
            $update_payment_query = mysqli_query($conn, "UPDATE payments SET money = '$pay', ref_no = '$ref_no' WHERE unique_id = '$unique_id'");

            if ($update_payment_query) {
                // Retrieve the current pending amount
                $pending_query = mysqli_query($conn, "SELECT total FROM payments WHERE unique_id = '$unique_id'");
                if ($pending_query) {
                    if(mysqli_num_rows($pending_query) > 0) {
                        $pending_row = mysqli_fetch_assoc($pending_query);
                        $current_pending = $pending_row['total'];
                        var_dump($current_pending);
                        $new_pending = $current_pending - $pay;
                
                        $update_pending_query = mysqli_query($conn, "UPDATE payments SET total = '$new_pending' WHERE unique_id = '$unique_id'");
                
                        if ($update_pending_query) {
                            $response['success'] = "Payment updated and total amount adjusted successfully.";
                        } else {
                            $response['error'] = "Error updating total amount: " . mysqli_error($conn);
                        }
                    } else {
                        $response['error'] = "No total amount found for this user.";
                    }
                } else {
                    // Log SQL query and error message for debugging
                    $response['error'] = "Error retrieving current total amount: " . mysqli_error($conn);
                    $response['sql_query'] = "SELECT total FROM payments WHERE unique_id = '$unique_id'";
                }
            } else {
                $response['error'] = "Error updating payment: " . mysqli_error($conn);
            }
        }
    }
}

// Catch any unexpected output and return it as an error
if (empty($response)) {
    $response['error'] = "Invalid request.";
}

echo json_encode($response);
?>
