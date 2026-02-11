<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($id <= 0){
    die("Invalid Worker ID");
}

/* Optional: image delete */
$result = mysqli_query($conn, "SELECT photo FROM Workers WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if(!empty($data['photo'])){
    @unlink("../uploads/".$data['photo']);
}

/* Delete Worker */
mysqli_query($conn, "DELETE FROM Workers  WHERE id=$id");

header("Location: Worker_list.php");
exit;
