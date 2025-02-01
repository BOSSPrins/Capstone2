<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['loginpassword']);

function closeConnectionAndRespond($conn, $status, $message) {
    $conn->close();
    echo json_encode(["status" => $status, "message" => $message]);
    exit();
}

if (!empty($email) && !empty($password)) {
                        $sql = mysqli_query($conn, "SELECT tblaccounts.*, tblaccounts.user_id AS acc_userID, tblresident.user_id AS res_userID, tblresident.first_name, tblresident.middle_name, tblresident.last_name, tblresident.block, tblresident.lot
                        FROM tblaccounts 
                        INNER JOIN tblresident ON tblaccounts.unique_id = tblresident.unique_id
                        WHERE tblaccounts.email = '{$email}'");
    

    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $enc_pass = $row['password'];

        if ($row['otp'] != 'Verified') {
            closeConnectionAndRespond($conn, "error", "Verify your account first.");
        }

        if ($row['access'] == 'Pending') {
            closeConnectionAndRespond($conn, "error", "Please wait for your account confirmation.");
        }

       
        if (md5($password) === $enc_pass) {
            $status = "Active now";
            $sql2 = mysqli_query($conn, "UPDATE tblaccounts SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id'];
                $_SESSION['res_userID'] = $row['res_userID'];
                $_SESSION['acc_userID'] = $row['acc_userID'];
                $_SESSION['block'] = $row['block'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['block'] = $row['block'];
                $_SESSION['lot'] = $row['lot'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['img'] = $row['img'];



                
                // Check if role exists before setting the session
                $_SESSION['role'] = $row['role'] ?? 'default_role';

                // Start session management logic
                mysqli_begin_transaction($conn);

                try {
                    $current_session = session_id();
                    $unique_id = $row['unique_id'];

                    // Logout all other active sessions for this user
                    $existing_session_sql = "UPDATE tbl_sessions SET status = 'inactive' WHERE unique_id = {$unique_id} AND status = 'active'";
                    mysqli_query($conn, $existing_session_sql);

                    // Check if the current session already exists in the database
                    $check_session_sql = "SELECT * FROM tbl_sessions WHERE session_id = '{$current_session}'";
                    $check_session_result = mysqli_query($conn, $check_session_sql);

                    if (mysqli_num_rows($check_session_result) > 0) {
                        // Update the existing session
                        $update_sql = "UPDATE tbl_sessions 
                                       SET unique_id = {$unique_id}, device_ip = '{$_SERVER['REMOTE_ADDR']}', status = 'active' 
                                       WHERE session_id = '{$current_session}'";
                        mysqli_query($conn, $update_sql);
                    } else {
                        // Insert a new session
                        $insert_sql = "INSERT INTO tbl_sessions (session_id, unique_id, device_ip, status) 
                                       VALUES ('{$current_session}', {$unique_id}, '{$_SERVER['REMOTE_ADDR']}', 'active')";
                        mysqli_query($conn, $insert_sql);
                    }

                    mysqli_commit($conn); // Commit transaction
                    closeConnectionAndRespond($conn, "success", $row['role']); // Send JSON response with role

                } catch (Exception $e) {
                    mysqli_rollback($conn); // Rollback transaction
                    closeConnectionAndRespond($conn, "error", "Error: " . $e->getMessage());
                }
            } else {
                closeConnectionAndRespond($conn, "error", "Something went wrong. Please try again!");
            }
        } else {
            closeConnectionAndRespond($conn, "error", "Password is Incorrect!");
        }
    } else {
        closeConnectionAndRespond($conn, "error", "Please Signup First.");
    }
} else {
    closeConnectionAndRespond($conn, "error", "All input fields are required!");
}
?>
