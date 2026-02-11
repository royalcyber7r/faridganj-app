<?php
require_once "admin_guard.php";
require_once "../db.php";

$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM blood WHERE id='$id'");
header("location:blood_list.php");
