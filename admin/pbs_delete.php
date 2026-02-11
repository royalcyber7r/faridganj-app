<?php
require_once "admin_guard.php";
require_once "../db.php";

$id=$_GET['id'];
$conn->query("DELETE FROM pbs WHERE id=$id");
header("Location: pbs_list.php");
