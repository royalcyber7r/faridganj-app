<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];

// 🔹 পুরোনো ছবি বের করা
$data = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT image FROM school WHERE id='$id'")
);

// 🔹 ছবি থাকলে ডিলিট
if(!empty($data['image'])){
    @unlink("../uploads/college/".$data['image']);
}

// 🔹 ডাটাবেজ থেকে কলেজ ডিলিট
mysqli_query($conn,"DELETE FROM school WHERE id='$id'");

// 🔹 লিস্ট পেইজে রিডাইরেক্ট
header("Location: school_list.php");
exit;
