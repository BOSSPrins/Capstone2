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

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_POST['action'] ?? $_GET['action'] ?? '';

    if (empty($action)) {
        $data = json_decode(file_get_contents('php://input'), true);
        $action = $data['action'] ?? '';
    }

    error_log("Action received: $action");


    if ($action === 'create_post') {
        // Retrieve form data and remove "T" from date-time
        $startDate = str_replace('T', ' ', $_POST['start_date']);
        $endTime = str_replace('T', ' ', $_POST['end_time']);
        $title = $_POST['title_name'] ?? '';
        $description = $_POST['description_name'] ?? '';

        // Log the processed data for debugging
        error_log("Processed Data: Start Date: $startDate, End Date: $endTime, Title: $title, Description: $description");

        // Validate required fields
        if (empty($startDate) || empty($endTime) || empty($title) || empty($description)) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'All fields are required.']);
        }

        // Handle file uploads
        $uploadedFiles = [];
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                $fileName = basename($_FILES['images']['name'][$key]); // Get only the file name
                $targetPath = '../Pictures/' . $fileName; // Ensure the 'Pictures' directory exists
                if (move_uploaded_file($tmpName, $targetPath)) {
                    $uploadedFiles[] = $fileName; // Store only the file name
                } else {
                    closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Failed to upload file: ' . $fileName]);
                }
            }
        }

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO announcements (start_date, end_date, title, description, images) VALUES (?, ?, ?, ?, ?)");
        $images = implode(',', $uploadedFiles); // Save file names as a comma-separated string
        $stmt->bind_param('sssss', $startDate, $endTime, $title, $description, $images);

        if ($stmt->execute()) {
            closeConnectionAndRespond($conn, ['success' => true]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Database error: ' . $conn->error]);
        }

    } elseif ($action === 'get_announcements') {
            $sql = "SELECT news_id, title, start_date FROM announcements ORDER BY start_date DESC";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $announcements = [];
                while ($row = $result->fetch_assoc()) {
                    $formattedDate = date("F d, Y \a\\t h:i A", strtotime($row['start_date'])); // Format date with "at"
                    $announcements[] = [
                        'news_id' => $row['news_id'],
                        'title' => $row['title'],
                        'date_posted' => $formattedDate,
                    ];
                }
                closeConnectionAndRespond($conn, ['success' => true, 'data' => $announcements]);
            } else {
                closeConnectionAndRespond($conn, ['success' => false, 'message' => 'No announcements found']);
            }
    
    } elseif ($action === 'get_announcement_details') {
        $news_id = $data['news_id'] ?? '';
    
        if (empty($news_id)) {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'news_id is required.']);
        }
    
        $stmt = $conn->prepare("SELECT news_id, start_date, end_date, title, description, images FROM announcements WHERE news_id = ?");
        $stmt->bind_param('i', $news_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            $row['images'] = explode(',', $row['images']); // Convert image list to array if stored as CSV
            closeConnectionAndRespond($conn, ['success' => true, 'announcement' => $row]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Announcement not found.']);
        }

    } elseif ($action === 'update_announcement') {
        $news_id = $_POST['news_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $existing_images = json_decode($_POST['existing_images'], true) ?? [];
        $removed_images = json_decode($_POST['removed_images'], true) ?? [];

        // Remove images from storage (if applicable) and database
        foreach ($removed_images as $image) {
            $imagePath = "../Pictures/$image";
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file from the server
            }
        }

        // Update the images in the database
        $updatedImages = implode(',', $existing_images); // Convert back to CSV format
        $stmt = $conn->prepare("UPDATE announcements SET title = ?, description = ?, start_date = ?, end_date = ?, images = ? WHERE news_id = ?");
        $stmt->bind_param('sssssi', $title, $description, $start_date, $end_date, $updatedImages, $news_id);

        if ($stmt->execute()) {
            // Handle new images upload
            if (!empty($_FILES['new_images']['name'][0])) {
                foreach ($_FILES['new_images']['tmp_name'] as $key => $tmp_name) {
                    $fileName = $_FILES['new_images']['name'][$key];
                    $fileTmp = $_FILES['new_images']['tmp_name'][$key];
                    $targetPath = "../Pictures/" . $fileName;
                    if (move_uploaded_file($fileTmp, $targetPath)) {
                        $existing_images[] = $fileName; // Add new image to existing list
                    }
                }

                // Update the images again with the new ones
                $finalImages = implode(',', $existing_images);
                $stmt = $conn->prepare("UPDATE announcements SET images = ? WHERE news_id = ?");
                $stmt->bind_param('si', $finalImages, $news_id);
                $stmt->execute();
            }

            closeConnectionAndRespond($conn, ['success' => true]);
        } else {
            closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Failed to update announcement.']);
        }

    } elseif ($action == "get_all") {
        // Fetch all announcements
        $query = "SELECT * FROM announcements ORDER BY start_date DESC";
        $result = $conn->query($query);
    
        $announcements = [];
        while ($row = $result->fetch_assoc()) {
            $announcements[] = $row;
        }
    
        echo json_encode($announcements);

    } elseif ($action == "get_one" && isset($_GET['id'])) {
        // Fetch a single announcement
        $news_id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM announcements WHERE news_id = ?");
        $stmt->bind_param("i", $news_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "Announcement not found"]);
        }
    
    } else {
        closeConnectionAndRespond($conn, ['success' => false, 'error' => 'Invalid action.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
?>
