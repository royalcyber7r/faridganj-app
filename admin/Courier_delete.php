<?php
require_once "admin_guard.php";
require_once "../db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record
    $query = "DELETE FROM courier_companies WHERE id='$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: courier_list.php");
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>
