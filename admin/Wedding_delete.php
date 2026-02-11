<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM Wedding WHERE id='$id'");

header("location: Wedding_list.php");
