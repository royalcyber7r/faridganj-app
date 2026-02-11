<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = (int) $_GET['id'];

// আগের ছবি বের করা
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT image FROM madrasha WHERE id=$id")
);

// ছবি থাকলে ডিলিট
if(!empty($data['image'])){
    @unlink("../uploads/madrasha/" . $data['image']);
}

// ডাটা ডিলিট
mysqli_query($conn, "DELETE FROM madrasha WHERE id=$id");

// লিস্ট পেইজে রিডাইরেক্ট
header("Location: madrasha_list.php");
exit;
