<?php
require_once "admin_guard.php";
require_once "../db.php";
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM police WHERE docid='$id'");
header("location: police_list.php");
