<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/apache/logs/error.log');

// Set content type to JSON
header('Content-Type: application/json');

// Start session and include database connection
session_start();
include_once "../Connect/Connection.php"; // Adjust the path to your Connection file
$conn = connection();

// Error handler function
function handleError($errno, $errstr, $errfile, $errline) {
    echo json_encode(['success' => false, 'error' => "$errstr in $errfile on line $errline"]);
    exit();
}

// Set custom error handler
set_error_handler('handleError');

// Function to close connection and respond with JSON
function closeConnectionAndRespond($conn, $response) {
    $conn->close();
    echo json_encode($response);
    exit();
}

// Handle the POST or GET request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : null;

    if ($action === 'submit_complaint') {
        // Get the input values from the POST request
        $complainee = isset($_POST['complainee']) ? trim($_POST['complainee']) : null;
        $complaint = isset($_POST['complaint']) ? trim($_POST['complaint']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;
        $proof = isset($_POST['proof']) ? trim($_POST['proof']) : null; // Assuming 'proof' is the file name
        
        // Validate that required fields are provided
        if ($complainee && $complaint && $description && $proof) {
            // SQL query to insert the complaint data into the database along with the filed timestamp
            $sql = "INSERT INTO complaints (complainee, complaint, description, proof, filed_date) VALUES (?, ?, ?, ?, NOW())";

            if ($stmt = $conn->prepare($sql)) {
                // Bind the parameters to the SQL query
                $stmt->bind_param("ssss", $complainee, $complaint, $description, $proof);
                
                // Execute the query and check if successful
                if ($stmt->execute()) {
                    $response = ['success' => true, 'message' => 'Complaint submitted successfully.'];
                    error_log('Complaint submitted successfully.');
                } else {
                    // Log and respond with a database error
                    error_log("SQL Error: " . $stmt->error);
                    $response = ['success' => false, 'error' => 'Database error occurred.'];
                }
                $stmt->close();
            } else {
                // Log and respond with a SQL preparation error
                error_log("SQL Error: " . $conn->error);
                $response = ['success' => false, 'error' => 'Database error occurred.'];
            }
        } else {
            // Respond with an error if any required field is missing
            $response = ['success' => false, 'error' => 'Missing complainee, complaint, description, or proof.'];
        }

        // Close connection and send JSON response
        closeConnectionAndRespond($conn, $response);
    
    } else {
        // Handle invalid action for POST requests
        $response = ['success' => false, 'error' => 'Invalid action.'];
        closeConnectionAndRespond($conn, $response);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? $_GET['action'] : null;

    if ($action === 'fetch_complaints') {
        // SQL query to fetch complaints data
        $sql = "SELECT complainee, complaint, description, filed_date FROM complaints ORDER BY filed_date DESC";
        $result = $conn->query($sql);

        // Prepare the response
        $response = [];

        if ($result->num_rows > 0) {
            // Fetch each row of data
            while ($row = $result->fetch_assoc()) {
                $response[] = [
                    'complainee' => $row['complainee'],
                    'complaint' => $row['complaint'],
                    'description' => $row['description'],
                    'filed_date' => $row['filed_date']
                ];
            }
            echo json_encode(['success' => true, 'data' => $response]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No complaints found.']);
        }

        // Close connection
        $conn->close();
    } else {
        // Handle invalid action for GET requests
        $response = ['success' => false, 'error' => 'Invalid action.'];
        closeConnectionAndRespond($conn, $response);
    }

} else {
    // Handle invalid request method
    $response = ['success' => false, 'error' => 'Invalid request method.'];
    closeConnectionAndRespond($conn, $response);
}
?>
