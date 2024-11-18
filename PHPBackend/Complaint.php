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
        $ComplaintStatus = "Pending"; // Default status
        $complaint = isset($_POST['complaint']) ? trim($_POST['complaint']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;

        if (!$ComplaineeAddress || !$complaint || !$description) {
            $response = ['success' => false, 'error' => 'Please fill in all required fields.'];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        // Handle file upload
        $proofFiles = [];
        if (isset($_FILES['proofFiles']) && count($_FILES['proofFiles']['name']) > 0) {
            $fileNames = $_FILES['proofFiles']['name'];  // Get the original file names
            $tempPaths = $_FILES['proofFiles']['tmp_name'];  // Get the temporary file paths
            $targetDirectory = "../Pictures/";  // Directory where files will be stored

            foreach ($fileNames as $index => $fileName) {
                $targetFilePath = $targetDirectory . basename($fileName);  // Use original file name
                if (move_uploaded_file($tempPaths[$index], $targetFilePath)) {
                    $proofFiles[] = $fileName;  // Add file name to array if uploaded successfully
                }
            }
        }

        // Convert file names array to JSON string
        $proofFilesJson = json_encode($proofFiles);

        // Insert complaint into the database
        $sql = "INSERT INTO complaints (complaint_number, complaint_type, complainee, complaint, description, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status, proof) 
                VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters and execute query
            $complaint_number = rand(time(), 100000000);  // Generate complaint number
            $ComplaintType = 'Direct Complaint';  // Default complaint type

            $stmt->bind_param("sssssssssss", $complaint_number, $ComplaintType, $complainee, $complaint, $description, $ComplaineeAddress, $ComplainantUID, $ComplainantName, $ComplainantAddress, $ComplaintStatus, $proofFilesJson);

            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Complaint submitted successfully.'];
                error_log(json_encode($response));  // Log success response
            } else {
                $response = ['success' => false, 'error' => 'Failed to insert complaint.'];
                error_log(json_encode($response));  // Log error response
            }

            $stmt->close();
        } else {
            $response = ['success' => false, 'error' => 'Failed to prepare statement.'];
            error_log(json_encode($response));  // Log error response
        }

        // Respond with JSON and exit the script to prevent further output
        echo json_encode($response);
        exit;

    } elseif ($action === 'submit_GEN_complaint') {

        error_log(print_r($_POST, true)); // Log all POST data
    error_log(print_r($_FILES, true)); // Log all FILES data

        // Get the input values from the POST request
        $GENComplainantUID = isset($_POST['GENComplainantUID']) ? trim($_POST['GENComplainantUID']) : null;
        $GENComplainantName = isset($_POST['GENComplainantName']) ? trim($_POST['GENComplainantName']) : null;
        $GENComplainantAddress = isset($_POST['GENComplainantAddress']) ? trim($_POST['GENComplainantAddress']) : null;
        $selectGenComplaintInput = isset($_POST['selectGenComplaintInput']) ? trim($_POST['selectGenComplaintInput']) : null;
        $DescriptionGen = isset($_POST['DescriptionGen']) ? trim($_POST['DescriptionGen']) : null;

        if (!$GENComplainantUID) {
            error_log('GENComplainantUID is missing or empty.');
        }
        if (!$GENComplainantName) {
            error_log('GENComplainantName is missing or empty.');
        }
        if (!$GENComplainantAddress) {
            error_log('GENComplainantAddress is missing or empty.');
        }
        if (!$selectGenComplaintInput) {
            error_log('selectGenComplaintInput is missing or empty.');
        }
        if (!$DescriptionGen) {
            error_log('DescriptionGen is missing or empty.');
        }

        if (!$GENComplainantUID || !$GENComplainantName || !$GENComplainantAddress || !$selectGenComplaintInput || !$DescriptionGen) {
            $response = ['success' => false, 'error' => 'Please fill in all required fielders.'];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        // Handle file uploads
        $GENproofFiles = [];
        if (isset($_FILES['GENproofFiles'])) {
            $targetDirectory = "../Pictures/";
            foreach ($_FILES['GENproofFiles']['name'] as $index => $fileName) {
                $tempPath = $_FILES['GENproofFiles']['tmp_name'][$index];
                $targetFilePath = $targetDirectory . basename($fileName);
                if (move_uploaded_file($tempPath, $targetFilePath)) {
                    $GENproofFiles[] = $fileName;
                }
            }
        }

        // Insert data into the database
        $proofFilesJson = json_encode($GENproofFiles);
        $sql = "INSERT INTO complaints (complaint_number, complaint_type, complaint, description, filed_date, complainantUID, complainantName, complainantAddress, status, proof) 
                VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $GENcomplaint_number = rand(time(), 100000000); // Generate unique number
            $GENComplaintType = 'General Complaint';
            $GENComplaintStatus = "Pending";

            $stmt->bind_param("sssssssss", $GENcomplaint_number, $GENComplaintType, $selectGenComplaintInput, $DescriptionGen, $GENComplainantUID, $GENComplainantName, $GENComplainantAddress, $GENComplaintStatus, $proofFilesJson);

            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Complaint submitted successfully.'];
            } else {
                $response = ['success' => false, 'error' => 'Database insertion failed.'];
            }
            $stmt->close();
        } else {
            $response = ['success' => false, 'error' => 'Database preparation failed.'];
        }

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
        
    } elseif ($action === 'get_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_number, complaint, filed_date, status 
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
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['proof'] = trim($row['proof'], '"');
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'update_complaint') {
        $complaint_id = $_POST['complaint_id'];
        $status = $_POST['status'];
    
        // Update the complaint record in the database
        $sql = "UPDATE complaints SET status = ?, processed_date = NOW() WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $complaint_id);
    
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
        $sql = "SELECT complaint_number, complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status 
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
    
        $sql = "SELECT complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, status
                FROM complaints
                WHERE complaint_number = ?";
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
        $sql = "UPDATE complaints SET status = ?, status1 = ?, Remark1 = ?, RemarkBy1 = ?, RemarkDate1 = NOW() WHERE complaint_number = ?";
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
        $sql = "SELECT complaint_number, complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status 
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
                Remark1, RemarkBy1, status1, RemarkDate1, Remark2, RemarkBy2, status2, RemarkDate2
                FROM complaints
                WHERE complaint_number = ?";
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
        $sql = "SELECT complaint_number, complainee, complaint, description, proof, filed_date, complaineeAddress, complainantUID, complainantName, complainantAddress, status 
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
                WHERE complaint_number = ?";
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
    
    // } elseif ($action === 'update_Escalated') {
    //     $complaint_id = $_POST['complaint_id'];
    //     $status = $_POST['status'];
    //     $remark = $_POST['remark'];
    //     $role = $_POST['role'];
    
    //     // Update the complaint record in the database
    //     $sql = "UPDATE complaints SET status = ?, status3 = ?, Remark3 = ?, RemarkBy3 = ?, RemarkDate3 = NOW() WHERE complaint_id = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("ssssi", $status, $status, $remark, $role, $complaint_id);
    
    //     if ($stmt->execute()) {
    //         echo json_encode(['success' => true]);
    //     } else {
    //         echo json_encode(['success' => false, 'error' => 'Failed to update complaint.']);
    //     }
    
    //     $stmt->close();
    //     $conn->close();
    //     exit;

    // }

    } elseif ($action === 'get_complaint_counts') {
        // SQL query to count complaints by status
        $sql = "
            SELECT 
                SUM(status = 'In-Process') AS in_process_count,
                SUM(status = 'Escalated') AS escalated_count
            FROM complaints
        ";

        $result = $conn->query($sql);

        if ($result) {
            $counts = $result->fetch_assoc();
            echo json_encode([
                'success' => true,
                'in_process' => $counts['in_process_count'],
                'escalated' => $counts['escalated_count']
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to fetch complaint counts.']);
        }
        $conn->close();
        exit;

    } elseif ($action === 'user_get_complaints') {

        $userUID = $_POST['userUID'];

        // Fetch complaints from the database
        $sql = "SELECT complaint_number, complaint, filed_date, complainantUID, status 
                FROM complaints 
                WHERE complainantUID = ? 
                ORDER BY filed_date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userUID); // Use "s" if userUID is a string
        $stmt->execute();
        $result = $stmt->get_result();
    
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
    
    } elseif ($action === 'UserfetchDetails') {
        $complaint_id = $_POST['complaint_id'];
    
        $sql = "SELECT complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, status
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['proof'] = trim($row['proof'], '"');
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
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


<!-- if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        if ($ComplaineeAddress && $ComplainantUID && $ComplainantAddress && $ComplaintStatus && $complaint && $description && $proof) {
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
    
    } 

} -->