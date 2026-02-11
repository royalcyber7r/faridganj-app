<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$row = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT image FROM hospitals WHERE id=$id")
);

if($row['image'] && file_exists("../uploads/hospital/".$row['image'])){
    unlink("../uploads/hospital/".$row['image']);
}

mysqli_query($conn,"DELETE FROM hospitals WHERE id=$id");
header("Location: hospital_list.php");
