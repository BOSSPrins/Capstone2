<?php
session_start();
include_once "../Connect/Connection.php";
$conn = connection();

if (isset($_POST['action'])) {
    
    $action = $_POST['action'];
    
    // Search residents based on the search query and filter option
    if ($action == 'search_residents') {
        $searchQuery = $_POST['search_query'];
        $filterOption = $_POST['filter_option'];
        
        $query = "SELECT * FROM tblresident WHERE access != 'Pending' AND access = 'Approved'";
        
        if (!empty($filterOption) && $filterOption != 'All') {
            $query .= " AND block = '" . mysqli_real_escape_string($conn, $filterOption) . "'";
        }
        
        if (!empty($searchQuery)) {
            $query .= " AND (CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%' 
                        OR block LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%' 
                        OR lot LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%'
                        OR phone_number LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%')";
        }

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td class='user_id' hidden>" . $row['user_id'] . "</td>
                        <td>" . $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'] . "</td>
                        <td>Block " . $row['block'] . " Lot " . $row['lot'] . "</td>
                        <td>" . $row['phone_number'] . "</td>
                        <td>
                            <button class='ResidentsViewBtn BiyuModal'>View</button>
                        </td>
                      </tr>";
            }
        } else {
            echo '<tr><td colspan="4">No data found.</td></tr>';
        }
    }
    
    // Fetch user data when the modal is clicked
    if ($action == 'fetch_user_data') {
        $id = $_POST['user_id'];
        $arrayresult = [];
        
        $retrieve_query = mysqli_query($conn,"SELECT * FROM tblresident WHERE user_id = '$id'");
        
        if (mysqli_num_rows($retrieve_query) > 0) {
            while ($row = mysqli_fetch_assoc($retrieve_query)) {
                array_push($arrayresult, $row);
            }
            header('Content-Type: application/json');
            echo json_encode($arrayresult);
        } else {
            echo json_encode(['message' => 'No Data Found']);
        }
    }
}
?>
