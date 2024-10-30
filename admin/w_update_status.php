<?php
// w_update_status.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a database connection
    include('./include/config.php');

    $db = new ConnectionDB();
    $conn = $db->getConnection();

    // Sanitize input data
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 0;

    // Validate the input parameters
    if ($id > 0 && ($status !== 0)) {

        if($status == 0){
            $status = 2;
        }
        // Use proper prepared statements to prevent SQL injection
        if ($conn) {
            $updateQuery = "UPDATE bz_withdrwal SET bz_status = ? WHERE bz_withdrwal_id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ii", $status, $id);

            if ($stmt->execute()) {
                // Status updated successfully
                echo "Status updated successfully!";
                echo $status;
            } else {
                // Error in executing the update query
                echo "Error updating status: " . $stmt->error;
            }

            $stmt->close();
            mysqli_close($conn);
        } else {
            // Error connecting to the database
            echo "Error connecting to the database";
        }
    } else {
        // Invalid or missing parameters
        echo "Invalid or missing parameters";
    }
} else {
    // Invalid request method
    echo "Invalid request method";
}
?>
