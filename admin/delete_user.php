<?php
require_once "admin_guard.php";
require_once "../db.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete user
    $sql = "DELETE FROM users WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: users.php");
        exit;
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
?>
