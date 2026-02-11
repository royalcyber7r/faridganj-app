<?php
require_once "admin_guard.php";
require_once "../db.php";

$id=(int)$_GET['id'];
$data=$conn->query("SELECT image FROM uddokta WHERE id=$id")->fetch_assoc();

if($data && $data['image']){
    unlink("../uploads/uddokta/".$data['image']);
}

$conn->query("DELETE FROM uddokta WHERE id=$id");
header("Location: uddokta_list.php");
exit;
