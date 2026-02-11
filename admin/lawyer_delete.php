<?php
require_once "admin_guard.php";
require_once "../db.php";

$id=$_GET['id'];

$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT photo FROM lawyers WHERE id=$id"));
if($data['photo']){
    unlink("../uploads/lawyers/".$data['photo']);
}

mysqli_query($conn,"DELETE FROM lawyers WHERE id=$id");
header("Location: lawyer_list.php");
