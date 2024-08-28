<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['loginpassword']);

function closeConnectionAndRespond($conn, $response) {
    $conn->close();
    echo json_encode($response);
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

        if ($row['access'] == 'Pending'){
            echo "Please wait for confirmation";
            exit();
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


                // Check if role exists before setting the session
                if (isset($row['role'])) {
                    $_SESSION['role'] = $row['role'];
                } else {
                    // Handle case where role is empty (e.g., assign default role)
                    $_SESSION['role'] = 'default_role';  // Replace with your desired default role
                    echo "User role not found. Assigned default role.";
                }
                echo $row['role']; // Return only the session role (modified)
            } else {
                echo "Something went wrong. Please try again!";
            }
        } else {
            echo "Password is Incorrect!";
        }
    } else {
        echo "$email - This email does not exist!";
    }
} else {
    echo "All input fields are required!";
}


// $sql = "SELECT * FROM tblaccounts";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     $accounts = [];
//     while ($row = $result->fetch_assoc()) {
//         $accounts[] = $row;
//     }
//     closeConnectionAndRespond($conn, ['success' => true, 'accounts' => $accounts]);
// } else {
//     closeConnectionAndRespond($conn, ['success' => false, 'error' => 'No accounts found']);
// }
?>
