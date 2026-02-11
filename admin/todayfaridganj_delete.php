<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int)$_GET['id'];
$conn->query("DELETE FROM today_faridganj WHERE id=$id");
header("location: todayfaridganj_list.php");
