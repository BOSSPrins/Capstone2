<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:\xampp\apache\logs\error.log');

error_log('Received POST data: ' . print_r($_POST, true)); 

header('Content-Type: application/json');
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

function handleError($errno, $errstr, $errfile, $errline) {
  echo json_encode(['success' => false, 'error' => "$errstr in $errfile on line $errline"]);
  exit();
}

set_error_handler('handleError');

// Function to close the connection and send a JSON response
function closeConnectionAndRespond($conn, $response) {
  $conn->close();
  echo json_encode($response);
  exit();
}


error_log('Debugging started.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log('POST request received.');

    // Log exact value of 'action' and its length
    $action = isset($_POST['action']) ? trim($_POST['action']) : null;

    // Debugging: Output the action variable and log it
    var_dump($action); // Outputs the exact string and its details
    error_log('Var dump of action: ' . var_export($action, true));

    error_log('Exact value of action parameter: "' . $action . '" with length: ' . strlen($action));

    // Log full POST data to verify it is being sent correctly
    error_log('Full POST data: ' . print_r($_POST, true));

    if (strcasecmp($action, 'declare_winner') === 0) {
        error_log('Action parameter is correct.');

        // SQL to update the top 9 candidates by votes to "winner"
        $sql = "UPDATE user_votes
                SET status = 'Winner'
                WHERE unique_id IN (
                    SELECT unique_id 
                    FROM (
                        SELECT unique_id 
                        FROM user_votes 
                        ORDER BY votes DESC 
                        LIMIT 9
                    ) AS TopCandidates
                )";

        if ($conn->query($sql) === TRUE) {
            $response = ['success' => true];
            error_log('Query successful.');
        } else {
            error_log("SQL Error: " . $conn->error);
            $response = ['success' => false, 'error' => "Database error occurred"];
        }

        closeConnectionAndRespond($conn, $response);
    } else {
        error_log('Invalid action parameter: "' . $action . '" with length: ' . strlen($action));
        $response = ['success' => false, 'error' => 'Invalid request'];
        closeConnectionAndRespond($conn, $response);
    }
} else {
    error_log('Invalid request method: ' . $_SERVER['REQUEST_METHOD']);
    $response = ['success' => false, 'error' => 'Invalid request method'];
    closeConnectionAndRespond($conn, $response);
}
echo "PHP script is working.";
echo 'Error log path: ' . ini_get('error_log');
?>