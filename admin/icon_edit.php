<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM icons WHERE id=$id")
);

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $link  = $_POST['link'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../img/icons/".$image);

        mysqli_query($conn,
            "UPDATE icons SET title='$title', link='$link', image='$image' WHERE id=$id"
        );
    } else {
        mysqli_query($conn,
            "UPDATE icons SET title='$title', link='$link' WHERE id=$id"
        );
    }

    header("Location: icons.php");
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" value="<?= $data['title']; ?>" required><br><br>
    <input type="text" name="link" value="<?= $data['link']; ?>" required><br><br>

    <img src="../img/icons/<?= $data['image']; ?>" width="60"><br><br>
    <input type="file" name="image"><br><br>

    <button name="update">Update</button>
</form>
