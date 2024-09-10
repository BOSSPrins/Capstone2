<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:\xampp\apache\logs\error.log');

header('Content-Type: text/xml; charset=UTF-8');
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

// SQL to fetch the top 9 candidates by votes where status is 'winner'
$sql = "SELECT v.candidate_name, v.img, v.unique_id
        FROM voting v
        INNER JOIN user_votes uv ON v.unique_id = uv.unique_id
        WHERE uv.status = 'Winner'
        ORDER BY uv.votes DESC
        LIMIT 9";

$result = $conn->query($sql);

// Start the XML output
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<winners>';

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<winner>';
        echo '<candidate_name>' . htmlspecialchars($row['candidate_name'], ENT_XML1, 'UTF-8') . '</candidate_name>';
        echo '<img>' . htmlspecialchars($row['img'], ENT_XML1, 'UTF-8') . '</img>';
        echo '<unique_id>' . htmlspecialchars($row['unique_id'], ENT_XML1, 'UTF-8') . '</unique_id>';
        echo '</winner>';
    }
} else {
    // If no winners are found, return an empty winners tag
    echo '<winner>';
    echo '<candidate_name>No winners found</candidate_name>';
    echo '<img></img>';
    echo '<unique_id></unique_id>';
    echo '</winner>';
}

echo '</winners>';

$conn->close();
?>
