<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int) $_GET['id'];

// আগের ছবি বের করা
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT image FROM cosingcenter WHERE id=$id")
);

// ছবি থাকলে ডিলিট
if(!empty($data['image'])){
    @unlink("../uploads/cosingcenter/" . $data['image']);
}

// ডাটা ডিলিট
mysqli_query($conn, "DELETE FROM cosingcenter WHERE id=$id");

// লিস্ট পেইজে রিডাইরেক্ট
header("Location: cosingcenter_list.php");
exit;
