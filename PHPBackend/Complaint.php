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
include_once "../Connect/Connection.php"; // Adjust the path to your Connection file // Include the emailer
$conn = connection();

include_once '../Emailer/ComplaintsEmail.php';
include_once '../Emailer/ResolvedEmail.php';
include_once '../Emailer/EscalatedEmail.php';
include_once '../Emailer/BrngyEmail.php';
include_once '../Emailer/EmailComplainee.php';
// include_once '../Emailer/In-ProcessComplainee.php';
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

    if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        // If the request is JSON, decode the input
        $input = json_decode(file_get_contents('php://input'), true);
    } else {
        // Otherwise, use regular POST data
        $input = $_POST;
    }

    $action = $input['action'] ?? null;
    if (!$action) {
        echo json_encode(['error' => 'Action not provided']);
        exit;
    }

    if ($action === 'submit_complaint') {

        // Get the input values from the POST request
        $complainee = isset($_POST['complainee']) ? trim($_POST['complainee']) : null;
        $ComplaineeEmail = isset($_POST['ComplaineeEmail']) ? trim($_POST['ComplaineeEmail']) : null;
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
        if (empty($proofFiles)) {
            $response = ['success' => false, 'error' => 'Please upload at least one proof image.'];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    
        $pdfFiles = [];
        if (isset($_FILES['DIRproof']) && count($_FILES['DIRproof']['name']) > 0) {
            $fileNames = $_FILES['DIRproof']['name'];  // Get the original file names
            $tempPaths = $_FILES['DIRproof']['tmp_name'];  // Get the temporary file paths
            $targetDirectory = "../PDF_Reports/";  // Directory where files will be stored
        
             // Array to store original file names
        
            foreach ($fileNames as $index => $fileName) {
                $targetFilePath = $targetDirectory . basename($fileName);  // Use the original file name
                if (move_uploaded_file($tempPaths[$index], $targetFilePath)) {
                    $pdfFiles[] = $fileName;  // Add the original file name to the array if uploaded successfully
                }
            }
        }
        

        // Convert file names array to JSON string
        $proofFilesJson = json_encode($proofFiles);
        $pdfFilesJson = empty($pdfFiles) ? "" : json_encode($pdfFiles);

        // Insert complaint into the database
        $sql = "INSERT INTO complaints (complaint_number, complaint_type, complainee, complaint, description, filed_date, complaineeAddress, ComplaineeEmail, complainantUID, complainantName, complainantAddress, status, proof, pdf) 
                VALUES (?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters and execute query
            $complaint_number = rand(time(), 100000000);  // Generate complaint number
            $ComplaintType = 'Direct Complaint';  // Default complaint type

            $stmt->bind_param("sssssssssssss", $complaint_number, $ComplaintType, $complainee, $complaint, $description, $ComplaineeAddress, $ComplaineeEmail, $ComplainantUID, $ComplainantName, $ComplainantAddress, $ComplaintStatus, $proofFilesJson, $pdfFilesJson);

            if ($stmt->execute()) {
                $emailSent = sendEmailToComplainee($ComplaineeEmail, $complaint);

                if ($emailSent) {
                    // If the email is sent successfully
                    $response = [
                        'success' => true,
                        'message' => 'Complaint submitted successfully!',
                    ];
                } else {
                    // If the email sending fails
                    $response = [
                        'success' => true,  // Complaint submission is still successful
                        'message' => 'Complaint submitted, but email could not be sent.',
                    ];
                } // Log success response
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
        if (isset($_FILES['GENproofFiles']) && count($_FILES['GENproofFiles']['name']) > 0) {
            $targetDirectory = "../Pictures/";
            foreach ($_FILES['GENproofFiles']['name'] as $index => $fileName) {
                $tempPath = $_FILES['GENproofFiles']['tmp_name'][$index];
                $targetFilePath = $targetDirectory . basename($fileName);
                if (move_uploaded_file($tempPath, $targetFilePath)) {
                    $GENproofFiles[] = $fileName;
                }
            }
        }
        
        if (empty($GENproofFiles)) {
            $response = ['success' => false, 'error' => 'Please upload at least one proof image.'];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
        
        // Handle file uploads for PDFGENproof (PDF Files)
        $PDFGENproof = [];
        if (isset($_FILES['PDFGENproof']) && count($_FILES['PDFGENproof']['name']) > 0) {
            $targetDirectory = "../PDF_Reports/";
            foreach ($_FILES['PDFGENproof']['name'] as $index => $fileName) {
                $tempPath = $_FILES['PDFGENproof']['tmp_name'][$index];
                $targetFilePath = $targetDirectory . basename($fileName);
                if (move_uploaded_file($tempPath, $targetFilePath)) {
                    $PDFGENproof[] = $fileName;
                }
            }
        }
        
        // Convert file arrays to JSON strings or null if empty
        $proofFilesJson = !empty($GENproofFiles) ? json_encode($GENproofFiles) : '';
        $pdfFilesJson = !empty($PDFGENproof) ? json_encode($PDFGENproof) : '';
        
        // Prepare SQL statement with optional file data
        $sql = "INSERT INTO complaints (complaint_number, complaint_type, complaint, description, filed_date, complainantUID, complainantName, complainantAddress, status, proof, pdf) 
                VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $GENcomplaint_number = rand(time(), 100000000); // Generate unique number
            $GENComplaintType = 'General Complaint';
            $GENComplaintStatus = "Pending";
        
            $stmt->bind_param("ssssssssss", $GENcomplaint_number, $GENComplaintType, $selectGenComplaintInput, $DescriptionGen, $GENComplainantUID, $GENComplainantName, $GENComplainantAddress, $GENComplaintStatus, $proofFilesJson, $pdfFilesJson);
        
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
    
        $sql = "SELECT complainantUID, complaint_number, complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, pdf, status, ComplaineeEmail
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['proof'] = trim($row['proof'], '"');

            $pdf_files = json_decode($row['pdf'], true);  // Assuming 'proof' stores the PDF filenames as a JSON array

            $row['pdf_files'] = $pdf_files;  // Add the array to the response
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
        $sql = "SELECT complaint_number, complaint, filed_date, status  
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
    
        $sql = "SELECT complainantUID, complaint_number, complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, pdf, status, processed_date, ComplaineeEmail
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pdf_files = json_decode($row['pdf'], true);  // Assuming 'proof' stores the PDF filenames as a JSON array

            $row['pdf_files'] = $pdf_files; 
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
        $generatedFileName = $_POST['generatedFileName'];
    
        // Update the complaint record in the database
        $sql = "UPDATE complaints SET status = ?, status1 = ?, Remark1 = ?, RemarkBy1 = ?, RemarkDate1 = NOW(), escaLetter = ? WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $status, $status, $remark, $role, $generatedFileName, $complaint_id);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update complaint.']);
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'update_naughty_list') {
        $ComplaineeEmail = $_POST['ComplaineeEmail'];
    
        // Increment naughty_list for the given ComplaineeEmail
        $sql = "UPDATE tblaccounts SET naughty_list = naughty_list + 1 WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ComplaineeEmail);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update naughty list.']);
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'Resolved_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_number, complaint, filed_date, status 
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
    
        $sql = "SELECT complaint_number, complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, pdf, status, processed_date, Remark1, RemarkBy1, status1, RemarkDate1, Remark2, RemarkBy2, status2, RemarkDate2, resolveLetter
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $pdf_files = json_decode($row['pdf'], true);  // Assuming 'proof' stores the PDF filenames as a JSON array
            $brngy_report_files = $row['resolveLetter'];

            $row['pdf_files'] = $pdf_files;
            $row['brngy_report_files'] = $brngy_report_files;  
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
        $sql = "SELECT complaint_number, complaint, filed_date, status 
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
    
        $sql = "SELECT complaint_number, complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, pdf, status, processed_date, Remark1, RemarkBy1, status1, RemarkDate1, Remark2, RemarkBy2, status2, RemarkDate2
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $pdf_files = json_decode($row['pdf'], true);  // Assuming 'proof' stores the PDF filenames as a JSON array

            $row['pdf_files'] = $pdf_files;  // Add the array to the response
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
    
        $sql = "SELECT complaint_number, complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, pdf, status, processed_date, Remark1, RemarkBy1, status1, RemarkDate1, Remark2, RemarkBy2, status2, RemarkDate2
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['proof'] = trim($row['proof'], '"');
            $pdf_files = json_decode($row['pdf'], true);  // Assuming 'proof' stores the PDF filenames as a JSON array

            $row['pdf_files'] = $pdf_files;  // Add the array to the response
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'brngy_get_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_number, complaint, filed_date, status 
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
    
    } elseif ($action === 'BRNGYfetchDetails') {
        $complaint_id = $_POST['complaint_id'];
    
        $sql = "SELECT complainantUID, complaint_number, complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, pdf, status, processed_date, Remark1, RemarkBy1, status1, RemarkDate1, escaLetter, ComplaineeEmail
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['proof'] = trim($row['proof'], '"');
            $pdf_files = json_decode($row['pdf'], true);  // Assuming 'proof' stores the PDF filenames as a JSON array
            $hoa_report_files = $row['escaLetter'];  // Assuming 'hoa_report_files' stores the HOA report PDF filenames as a JSON array

            $row['pdf_files'] = $pdf_files;  // Add the array to the response
            $row['hoa_report_files'] = $hoa_report_files;  // Add HOA Report files to the response
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }
    
        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'brngy_get_badge') {
        // SQL query to count complaints by status
        $sql = "
            SELECT 
                SUM(status = 'Escalated') AS escalated_count
            FROM complaints
        ";

        $result = $conn->query($sql);

        if ($result) {
            $counts = $result->fetch_assoc();
            echo json_encode([
                'success' => true,
                'escalated' => $counts['escalated_count']
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to fetch complaint counts.']);
        }
        $conn->close();
        exit;

    } elseif ($action === 'update_barangay') {
        $complaint_id = $_POST['complaint_id'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $role = $_POST['role'];
        $generatedFileName = $_POST['generatedFileName'];
    
        // Update the complaint record in the database
        $sql = "UPDATE complaints SET status = ?, status2 = ?, Remark2 = ?, RemarkBy2 = ?, RemarkDate2 = NOW(), resolveLetter = ? WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $status, $status, $remark, $role, $generatedFileName, $complaint_id);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update complaint.']);
        }
    
        $stmt->close();
        $conn->close();
        exit;


     // Server-side ng Resolved
    } elseif ($action === 'brngyHistory_get_badge') {
        // SQL query to count complaints by status
        $sql = "
            SELECT 
                SUM(status = 'Escalated') AS escalated_count
            FROM complaints
        ";

        $result = $conn->query($sql);

        if ($result) {
            $counts = $result->fetch_assoc();
            echo json_encode([
                'success' => true,
                'escalated' => $counts['escalated_count']
            ]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to fetch complaint counts.']);
        }
        $conn->close();
        exit;

    } elseif ($action === 'brngyHistory_get_complaints') {
        // Fetch complaints from the database
        $sql = "SELECT complaint_number, complaint, filed_date, status, status1
        FROM complaints 
        WHERE status = 'Resolved' AND status1 = 'Escalated'
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

    } elseif ($action === 'HISTORYfetchDetails') {
        $complaint_id = $_POST['complaint_id'];

        $sql = "SELECT complaint_number, complainee, complaineeAddress, complainantName, complainantAddress, filed_date, complaint, description, proof, pdf, status, processed_date, Remark1, RemarkBy1, status1, RemarkDate1, escaLetter, Remark2, RemarkBy2, status2, RemarkDate2
                FROM complaints
                WHERE complaint_number = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $complaint_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['proof'] = trim($row['proof'], '"');
            $pdf_files = json_decode($row['pdf'], true);  // Assuming 'proof' stores the PDF filenames as a JSON array
            $hoa_report_files = $row['escaLetter'];  // Assuming 'hoa_report_files' stores the HOA report PDF filenames as a JSON array

            $row['pdf_files'] = $pdf_files;  // Add the array to the response
            $row['hoa_report_files'] = $hoa_report_files;
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Complaint not found']); // Return an error if no details are found
        }

        $stmt->close();
        $conn->close();
        exit;

    } elseif ($action === 'save_pdf') {
        // Directory where the PDF files will be stored (now inside the 'save_pdf' block)
        $targetDirectory = '../PDF_Reports/';

        // Check if the PDF file is being uploaded
        if (isset($_FILES['pdfFile'])) {
            error_log(print_r($_FILES['pdfFile'], true));
            $pdfFile = $_FILES['pdfFile'];
            $fileName = basename($pdfFile['name']);
            $targetFilePath = $targetDirectory . $fileName;
        
            // Move the uploaded file to the target directory
            if (move_uploaded_file($pdfFile['tmp_name'], $targetFilePath)) {
                echo json_encode(['success' => true, 'message' => 'PDF saved successfully!']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving PDF.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No PDF file uploaded.']);
        }

    } elseif ($action === 'brngy_save_pdf') {
        // Directory where the PDF files will be stored (now inside the 'save_pdf' block)
        $targetDirectory = '../PDF_Reports/';

        // Check if the PDF file is being uploaded
        if (isset($_FILES['pdfFile'])) {
            error_log(print_r($_FILES['pdfFile'], true));
            $pdfFile = $_FILES['pdfFile'];
            $fileName = basename($pdfFile['name']);
            $targetFilePath = $targetDirectory . $fileName;
        
            // Move the uploaded file to the target directory
            if (move_uploaded_file($pdfFile['tmp_name'], $targetFilePath)) {
                echo json_encode(['success' => true, 'message' => 'PDF saved successfully!']);
                exit;
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving PDF.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No PDF file uploaded.']);
        }

    } elseif ($action === 'fetchBLOCKnLOT') {
        // Get block and lot from the request
        $block = $input['block'] ?? null;
        $lot = $input['lot'] ?? null;

        // Ensure block and lot are provided
        if ($block && $lot) {
            // Prepare the SQL query to fetch the unique_id
            $stmt = $conn->prepare("SELECT unique_id FROM tblresident WHERE block = ? AND lot = ?");
            $stmt->bind_param("ss", $block, $lot);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a result is found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Return the success response with the unique_id
                echo json_encode(['success' => true, 'unique_id' => $row['unique_id']]);
            } else {
                // If no resident found, return an error response
                echo json_encode(['success' => false, 'error' => 'No resident found']);
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            // If block or lot are missing, return an error response
            echo json_encode(['success' => false, 'error' => 'Invalid block or lot']);
        }
    }
     elseif ($action === 'fetch_email') {
    // Fetch email based on unique_id
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['unique_id'])) {
            $unique_id = $data['unique_id'];

            // Query to get the email from tblaccounts
            $sql = "SELECT email FROM tblaccounts WHERE unique_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $unique_id);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->fetch();
            
            if ($email) {
                echo json_encode(['email' => $email]);
            } else {
                echo json_encode(['email' => null]);
            }

            $stmt->close();
        } else {
            echo json_encode(['error' => 'Invalid unique_id']);
        }
    } else {
        error_log("Unrecognized action: " . $action . "\n", 3, "error_log.txt");
        echo json_encode(['error' => 'Invalid actioners' . $action]);
    }


} else {
    // Handle invalid request method
    $response = ['success' => false, 'error' => 'Invalid request method.'];
    closeConnectionAndRespond($conn, $response);
};
?>