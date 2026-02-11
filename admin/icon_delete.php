<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT image FROM icons WHERE id=$id")
);

if ($data && file_exists("../img/icons/".$data['image'])) {
    unlink("../img/icons/".$data['image']);
}

mysqli_query($conn, "DELETE FROM icons WHERE id=$id");

header("Location: icons.php");
