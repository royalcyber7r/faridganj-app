<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM hotel WHERE id='$id'");

header("location: hotel_list.php");
