<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:\xampp\apache\logs\error.log');

header('Content-Type: application/json');
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

function handleError($errno, $errstr, $errfile, $errline) {
    http_response_code(500); // Internal Server Error
    echo json_encode(['success' => false, 'error' => "$errstr in $errfile on line $errline"]);
    exit();
}

set_error_handler('handleError');

// Function to close the connection and send a JSON response
function closeConnectionAndRespond($conn, $response) {
    if ($conn) {
        $conn->close();
    }
    echo json_encode($response);
    exit();
}

// Decode JSON payload if available
$jsonData = json_decode(file_get_contents("php://input"), true);

// Check if data is coming from $_POST (multipart/form-data) or JSON
$action = isset($_POST['action']) ? trim($_POST['action']) : ($jsonData['action'] ?? null);
error_log('Action received: ' . $action);

// Debugging: log both $_POST and JSON data
error_log('POST Data: ' . print_r($_POST, true));
error_log('JSON Data: ' . print_r($jsonData, true));
error_log('FILES Data: ' . print_r($_FILES, true));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$action) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Action is missing']);
    }

    if ($action === 'getWinners') {
        $query = "SELECT vote_id, unique_id, candidate_name, img, won_date, position
                  FROM voting
                  WHERE status = 'Winner'
                  AND status2 != 'Deleted'
                  ORDER BY won_date DESC
                  LIMIT 9";

        $result = $conn->query($query);

        if ($result) {
            $winners = [];
            while ($row = $result->fetch_assoc()) {
                $winners[] = $row;
            }
            closeConnectionAndRespond($conn, ['success' => true, 'data' => $winners]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Failed to fetch winners']);
        }

    } elseif ($action === 'fetchNewOfficials') {
        $winnerUID = $_POST['winnerUID'] ?? $jsonData['winnerUID'] ?? null;

        $query = "SELECT position, candidate_name, img, unique_id 
                  FROM voting 
                  WHERE unique_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $winnerUID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            closeConnectionAndRespond($conn, ['success' => true, 'data' => $row]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Candidate not found']);
        }

    } elseif ($action === 'updateOfficial') {
    // Extract data from $_POST or JSON
    $position = $_POST['position'] ?? $jsonData['position'] ?? null;
    $name = $_POST['name'] ?? $jsonData['name'] ?? null;
    $winnerUID = $_POST['winnerUID'] ?? $jsonData['winnerUID'] ?? null;

    if (!$position || !$name || !$winnerUID) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Missing required fields']);
    }

    // Handle file upload
    $img = null;
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $imgTmp = $_FILES['img']['tmp_name'];
        $imgName = $_FILES['img']['name'];
        $imgDestination = '../Pictures/' . $imgName;

        if (move_uploaded_file($imgTmp, $imgDestination)) {
            $img = $imgName; // Save new filename to the database
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Image upload failed']);
        }
    }

    // Retrieve current image if no new image is uploaded
    if (!$img) {
        $query = "SELECT img FROM voting WHERE unique_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $winnerUID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $img = $row['img']; // Retain the current image
        }
    }

    // Update the database
    $query = "UPDATE voting SET position = ?, candidate_name = ?, img = ? WHERE unique_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $position, $name, $img, $winnerUID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        closeConnectionAndRespond($conn, [
            'success' => true,
            'message' => 'Record updated successfully',
            'updated_data' => [
                'position' => $position,
                'name' => $name,
                'img' => $img
            ]
        ]);
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Update failed']);
    }

} elseif ($action === 'deleteWinner') {
    // Extract HoaUID from the POST data
    $HoaUID = $_POST['HoaUID'] ?? null;
    
    if (!$HoaUID) {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Missing HoaUID']);
        exit;
    }
    
    // Update the 'status2' column to 'Deleted' for the specified HoaUID
    $query = "UPDATE voting SET status2 = 'Deleted' WHERE unique_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $HoaUID); // Bind HoaUID parameter
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        closeConnectionAndRespond($conn, ['success' => true, 'message' => 'Winner marked as deleted']);
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Update failed or no matching record']);
    }

} else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid action']);
    }
} else {
    closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid request method']);
}
