<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = intval($_GET['id']);

$res = mysqli_query($conn,"SELECT image FROM restaurant WHERE id=$id");
$row = mysqli_fetch_assoc($res);

if(!empty($row['image'])){
    @unlink("../uploads/restaurants/".$row['image']);
}

mysqli_query($conn,"DELETE FROM restaurant WHERE id=$id");
header("location: restaurant_list.php");
exit;
