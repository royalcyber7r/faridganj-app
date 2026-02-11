<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int)$_GET['id'];

// আগের ছবি নাও
$data = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT image FROM college WHERE id=$id")
);

if(!empty($data['image'])){
    @unlink("../uploads/college/".$data['image']);
}

// ডাটা ডিলিট
mysqli_query($conn,"DELETE FROM college WHERE id=$id");

// লিস্টে ফেরত
header("Location: college_list.php");
exit;
