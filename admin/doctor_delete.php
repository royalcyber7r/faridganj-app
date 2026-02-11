<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id <= 0){
    die("Invalid Doctor ID");
}

/* Optional: image delete */
$result = mysqli_query($conn, "SELECT photo FROM doctors WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if(!empty($data['photo'])){
    @unlink("../uploads/".$data['photo']);
}

/* Delete doctor */
mysqli_query($conn, "DELETE FROM doctors WHERE id=$id");

header("Location: doctor_list.php");
exit;
