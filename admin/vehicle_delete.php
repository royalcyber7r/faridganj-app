<?php
require_once "admin_guard.php";
require_once "../db.php";

// Get the ID of the vehicle to delete
$id = $_GET['id'];

// Ensure the ID exists
if (isset($id)) {
    // Delete query to remove the vehicle from the database
    $query = "DELETE FROM vehicle_rent WHERE id='$id'";

    // Execute the delete query
    if (mysqli_query($conn, $query)) {
        // Redirect back to the vehicle list page after deletion
        header("Location: vehicle_list.php");
    } else {
        die("Error deleting vehicle: " . mysqli_error($conn));
    }
}
?>
