<?php
require_once "admin_guard.php";
require_once "../db.php";


if(isset($_POST['save'])){
$title = $_POST['title'];
$message = $_POST['message'];


mysqli_query($conn, "INSERT INTO notices (title,message) VALUES ('$title','$message')");
}
?>


<form method="post">
<input type="text" name="title" placeholder="Notice Title" required><br><br>
<textarea name="message" placeholder="Notice Message" required></textarea><br><br>
<button name="save">Save Notice</button>
</form>