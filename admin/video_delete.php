<?php
require_once "admin_guard.php";
require_once "../db.php";

// 🔒 ID validation
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    header("Location: video_list.php");
    exit;
}

$id = (int) $_GET['id'];

// 🔥 Delete query
$sql = "DELETE FROM videos WHERE id = $id";
$query = mysqli_query($conn, $sql);

// 🔁 Redirect back to list
header("Location: video_list.php");
exit;
