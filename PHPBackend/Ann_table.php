<?php 
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

$currentDate = date('Y-m-d');

$sql = "SELECT *, ABS(DATEDIFF(start_date, '$currentDate')) AS date_diff FROM announcements ORDER BY date_diff ASC";

$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output data of each row as HTML table rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . date('F d Y', strtotime($row['start_date'])) . "</td>"; 
        echo "<td>" . date('F d Y', strtotime($row['end_date'])) . "</td>";
        echo "<td>" . $row['start_time'] . "</td>";
        echo "<td>" . $row['end_time'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo '<td>';
        echo '<button class="edit-btn tb-btn" id="iditBoton" name="iditBoton" onclick="openEditModal()"> Edit </button>';
        echo '</td>';
        echo '<td>';
        echo '<button class="delete-btn tb-btn" id="dilitBoton" name="dilitBoton" onclick="openDeleteModal()"> Delete </button>';
        echo '</td>'; 
        echo "</tr>";
    }
} else {
    // If no rows were returned, output a message
    echo "<tr><td colspan='6'>No data found.</td></tr>"; // Replace N with the number of columns in your table
}

// Close connection
$conn->close();


?>