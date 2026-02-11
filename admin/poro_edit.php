<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM poro_services WHERE id='$id'");
$data = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {
    $mayor_name = $_POST['mayor_name'];
    $mayor_mobile = $_POST['mayor_mobile'];
    // Update other fields...

    // Update data in the database
    mysqli_query($conn, "UPDATE poro_services SET mayor_name='$mayor_name', mayor_mobile='$mayor_mobile' WHERE id='$id'");
    header("location: poro_list.php");
}
?>

<form method="post">
    <input type="text" name="mayor_name" value="<?= $data['mayor_name'] ?>" required><br><br>
    <input type="text" name="mayor_mobile" value="<?= $data['mayor_mobile'] ?>" required><br><br>
    <!-- Update other fields similarly -->
    <button name="update">Update</button>
</form>
