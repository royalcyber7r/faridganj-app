<?php
require_once "admin_guard.php";
require_once "../db.php";

/*
|--------------------------------------------------------------------------
| DELETE DATA
|--------------------------------------------------------------------------
*/
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    mysqli_query($conn, "DELETE FROM ambulance WHERE id = $id");
}

header("Location: ambulance_list.php");
exit();