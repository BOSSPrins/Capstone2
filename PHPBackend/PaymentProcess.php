<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'getDetails') {
            $unique_id = mysqli_real_escape_string($conn, $_POST['UID']);
            error_log("Line 18: Fetching details for unique_id: $unique_id");

            $query = "SELECT * FROM payments WHERE unique_id = '$unique_id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $response['money'] = (float)$row['money'];
                    $response['proof'] = $row['proof'];
                    $response['total'] = (float)$row['total']; 
                    $response['unique_id'] = (float)$row['unique_id'];
                    error_log("Line 29: getDetails - total: " . $row['total']);// Debugging
                } else {
                    $response['error'] = "No payment found for this user.";
                    error_log("Line 32: No payment found for this user with unique_id: $unique_id");
                }
            } else {
                $response['error'] = "Query failed: " . mysqli_error($conn);
                error_log("Line 36: Query failed: " . mysqli_error($conn));
            }
        } elseif ($action == 'updatePayment') {
            $pay = floatval(mysqli_real_escape_string($conn, $_POST['userBayad']));
            $unique_id = mysqli_real_escape_string($conn, $_POST['UID']);
            $ref_no = mysqli_real_escape_string($conn, $_POST['userRefer']); 

            error_log("Line 43: updatePayment - unique_id: $unique_id, pay: $pay, ref_no: $ref_no");

            // Update the payments table
            $update_payment_query = mysqli_query($conn, "UPDATE payments SET money = '$pay', ref_no = '$ref_no' WHERE unique_id = '$unique_id'");

            if ($update_payment_query) {
                error_log("Line 49: Payment updated for unique_id: $unique_id");

                // Retrieve the current pending amount
                $pending_query = mysqli_query($conn, "SELECT total, money FROM payments WHERE unique_id = '$unique_id'");
                
                if (!$pending_query) {
                    error_log("Line 55: SQL Error: " . mysqli_error($conn));
                } else {
                    error_log("Line 57: SQL Query Executed: SELECT total, money FROM payments WHERE unique_id = '$unique_id'");
                }

                $num_rows = mysqli_num_rows($pending_query);
                error_log("Line 61: Number of rows returned: $num_rows");

                if ($num_rows > 0) {
                    $pending_row = mysqli_fetch_assoc($pending_query);
                    error_log("Line 65: Pending Row Data: " . print_r($pending_row, true));

                    $current_pending = (float)$pending_row['total'];
                    $current_money = (float)$pending_row['money'];
                    error_log("Line 69: updatePayment - current_pending: $current_pending, current_money: $current_money");

                    $response['current_pending'] = $current_pending;
                    $response['current_money'] = $current_money;

                    $new_pending = $current_pending - $current_money;

                    $update_pending_query = mysqli_query($conn, "UPDATE payments SET total = '$new_pending' WHERE unique_id = '$unique_id'");

                    if ($update_pending_query) {
                        $response['success'] = "Payment updated and total amount adjusted successfully.";
                        error_log("Line 80: Payment updated and total amount adjusted successfully for unique_id: $unique_id");
                    } else {
                        $response['error'] = "Error updating total amount: " . mysqli_error($conn);
                        error_log("Line 83: Error updating total amount: " . mysqli_error($conn));
                    }
                } else {
                    error_log("Line 86: No total amount found for user with unique ID: $unique_id");
                    $response['error'] = "No total amount found for this user.";
                }
            } else {
                $response['error'] = "Error updating payment: " . mysqli_error($conn);
                error_log("Line 91: Error updating payment: " . mysqli_error($conn));
            }
        }
    }
}

// Catch any unexpected output and return it as an error
if (empty($response)) {
    $response['error'] = "Invalid request.";
    error_log("Line 100: Invalid request.");
}

echo json_encode($response);
?>
