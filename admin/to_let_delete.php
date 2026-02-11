<?php
require_once "admin_guard.php";
require_once "../db.php";

$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM to_let WHERE id=$id");
header("Location: to_let_list.php");
