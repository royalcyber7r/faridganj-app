<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM socialorg WHERE id='$id'");

header("location: socialorg_list.php");
