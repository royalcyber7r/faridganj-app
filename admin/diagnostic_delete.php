<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM diagnostic WHERE id='$id'");

header("location: diagnostic_list.php");
