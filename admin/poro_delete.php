<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$query = "DELETE FROM poro_services WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    header("Location: poro_list.php");
} else {
    die("Error deleting data: " . mysqli_error($conn));
}
?>
