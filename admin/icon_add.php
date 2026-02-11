<?php
require_once "admin_guard.php";
require_once "../db.php";

if (isset($_POST['submit'])) {

    $title = trim($_POST['title']);
    $link  = trim($_POST['link']);

    // Check if image uploaded
    if (!empty($_FILES['image']['name'])) {

        $imageName = $_FILES['image']['name'];
        $tmp       = $_FILES['image']['tmp_name'];
        $error     = $_FILES['image']['error'];

        if ($error === 0) {

            // Create unique file name
            $ext = pathinfo($imageName, PATHINFO_EXTENSION);
            $newImageName = time() . "_" . rand(1000,9999) . "." . $ext;

            $uploadPath = "../img/icons/" . $newImageName;

            if (move_uploaded_file($tmp, $uploadPath)) {

                // Prepared Statement (Secure)
                $stmt = $conn->prepare("INSERT INTO icons (title, image, link) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $title, $newImageName, $link);

                if ($stmt->execute()) {
                    header("Location: icons.php");
                    exit;
                } else {
                    echo "Database Error!";
                }

            } else {
                echo "Image Upload Failed!";
            }

        } else {
            echo "File Upload Error!";
        }

    } else {
        echo "Please select an image!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Icon</title>
</head>
<body>

<h2>Add New Icon</h2>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Icon Name" required><br><br>
    <input type="text" name="link" placeholder="Page link (doctor.php)" required><br><br>
    <input type="file" name="image" accept="image/*" required><br><br>
    <button type="submit" name="submit">Save</button>
</form>

</body>
</html>
