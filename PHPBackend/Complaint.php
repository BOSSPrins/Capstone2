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
        $ComplaineeAddress = isset($_POST['ComplaineeAddress']) ? trim($_POST['ComplaineeAddress']) : null;

        $ComplainantUID = isset($_POST['ComplainantUID']) ? trim($_POST['ComplainantUID']) : null;
        $ComplainantName = isset($_POST['ComplainantName']) ? trim($_POST['ComplainantName']) : null;
        $ComplainantAddress = isset($_POST['ComplainantAddress']) ? trim($_POST['ComplainantAddress']) : null;
        $ComplaintStatus = "Pending";

        $complaint = isset($_POST['complaint']) ? trim($_POST['complaint']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;

        // Check if a file was uploaded
        if (isset($_FILES['proofFileName']) && $_FILES['proofFileName']['error'] === UPLOAD_ERR_OK) {
            $proof = $_FILES['proofFileName']['name']; // Get the file name
            $proofTempPath = $_FILES['proofFileName']['tmp_name'];

            // Optional: Move the uploaded file to a designated directory
            $targetDirectory = "../Pictures/";
            $targetFilePath = $targetDirectory . basename($proof);
            if (!move_uploaded_file($proofTempPath, $targetFilePath)) {
                $response = ['success' => false, 'error' => 'Failed to save uploaded file.'];
                closeConnectionAndRespond($conn, $response);
                exit;
            }
        } else {
            $proof = null;
        }

        // Validate that required fields are provided
        if ($complainee && $ComplaineeAddress && $ComplainantUID && $ComplainantAddress && $ComplaintStatus && $complaint && $description && $proof) {
            // SQL query to insert the complaint data into the database along with the filed timestamp
            $sql = "INSERT INTO complaints (complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status) VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind the parameters to the SQL query
                $stmt->bind_param("sssssssss", $complainee, $complaint, $description, $proof, $ComplaineeAddress, $ComplainantUID, $ComplainantName, $ComplainantAddress, $ComplaintStatus);
                
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

        // Server-side ng Pending
    } elseif ($action === 'get_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_id, complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status 
        FROM complaints 
        WHERE status = 'Pending' 
        ORDER BY filed_date DESC";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $complaints = [];
            while ($row = $result->fetch_assoc()) {
                $complaints[] = $row;
            }
            echo json_encode(['success' => true, 'data' => $complaints]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No complaints found']); 
        }
    
        $conn->close();
        exit;
    
    } elseif ($action === 'fetchDetails') {
        $complaint_id = $_POST['complaint_id'];
    
        $sql = "SELECT complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, status
                FROM complaints
                WHERE complaint_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $row]); // Return the complaint details with success
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'update_complaint') {
        $complaint_id = $_POST['complaint_id'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $role = $_POST['role'];
    
        // Update the complaint record in the database
        $sql = "UPDATE complaints SET status = ?, status1 = ?, Remark1 = ?, RemarkBy1 = ?, RemarkDate1 = NOW() WHERE complaint_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $status, $status, $remark, $role, $complaint_id);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update complaint.']);
        }
    
        $stmt->close();
        $conn->close();
        exit;

        // Server-side ng In-process
    } elseif ($action === 'In-process_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_id, complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status 
        FROM complaints 
        WHERE status = 'In-Process' 
        ORDER BY filed_date DESC";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $complaints = [];
            while ($row = $result->fetch_assoc()) {
                $complaints[] = $row;
            }
            echo json_encode(['success' => true, 'data' => $complaints]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No complaints found']); 
        }
    
        $conn->close();
        exit;
    
    } elseif ($action === 'fetch_In-process') {
        $complaint_id = $_POST['complaint_id'];
    
        $sql = "SELECT complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, status,
                Remark1, RemarkBy1, status1, RemarkDate1
                FROM complaints
                WHERE complaint_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $row]); // Return the complaint details with success
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'update_In-process') {
        $complaint_id = $_POST['complaint_id'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $role = $_POST['role'];
    
        // Update the complaint record in the database
        $sql = "UPDATE complaints SET status = ?, status2 = ?, Remark2 = ?, RemarkBy2 = ?, RemarkDate2 = NOW() WHERE complaint_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $status, $status, $remark, $role, $complaint_id);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update complaint.']);
        }
    
        $stmt->close();
        $conn->close();
        exit;


     // Server-side ng Resolved
    } elseif ($action === 'Resolved_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_id, complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status 
        FROM complaints 
        WHERE status = 'Resolved' 
        ORDER BY filed_date DESC";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $complaints = [];
            while ($row = $result->fetch_assoc()) {
                $complaints[] = $row;
            }
            echo json_encode(['success' => true, 'data' => $complaints]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No complaints found']); 
        }
    
        $conn->close();
        exit;
    
    } elseif ($action === 'fetch_Resolved') {
        $complaint_id = $_POST['complaint_id'];
    
        $sql = "SELECT complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, status,
                Remark1, RemarkBy1, status1, RemarkDate1, Remark2, RemarkBy2, status2, RemarkDate2, Remark3, RemarkBy3, status3, RemarkDate3
                FROM complaints
                WHERE complaint_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $row]); // Return the complaint details with success
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }
    
        $stmt->close();
        $conn->close();
        exit;

     // Server-side ng Escalated
    } elseif ($action === 'Escalated_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_id, complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status 
        FROM complaints 
        WHERE status = 'Escalated' 
        ORDER BY filed_date DESC";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $complaints = [];
            while ($row = $result->fetch_assoc()) {
                $complaints[] = $row;
            }
            echo json_encode(['success' => true, 'data' => $complaints]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No complaints found']); 
        }
    
        $conn->close();
        exit;
    
    } elseif ($action === 'fetch_Escalated') {
        $complaint_id = $_POST['complaint_id'];
    
        $sql = "SELECT complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, status,
                Remark1, RemarkBy1, status1, RemarkDate1, Remark2, RemarkBy2, status2, RemarkDate2
                FROM complaints
                WHERE complaint_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['success' => true, 'data' => $row]); // Return the complaint details with success
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'update_Escalated') {
        $complaint_id = $_POST['complaint_id'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $role = $_POST['role'];
    
        // Update the complaint record in the database
        $sql = "UPDATE complaints SET status = ?, status3 = ?, Remark3 = ?, RemarkBy3 = ?, RemarkDate3 = NOW() WHERE complaint_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $status, $status, $remark, $role, $complaint_id);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update complaint.']);
        }
    
        $stmt->close();
        $conn->close();
        exit;

    }

} else {
    // Handle invalid request method
    $response = ['success' => false, 'error' => 'Invalid request method.'];
    closeConnectionAndRespond($conn, $response);
}
?>
