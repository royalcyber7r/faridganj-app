<?php
require_once "admin_guard.php";
require_once "../db.php";

$id=$_GET['id'];
$conn->query("DELETE FROM emargency WHERE id=$id");
header("Location: emargency_list.php");
