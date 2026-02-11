<?php
require_once "admin_guard.php";
require_once "../db.php";
$id = $_GET['id'];
mysqli_query($conn,"UPDATE notices SET status = IF(status=1,0,1) WHERE id=$id");
header("Location: notices.php");