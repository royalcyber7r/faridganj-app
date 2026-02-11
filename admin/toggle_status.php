<?php
session_start();
require_once "admin_guard.php";
require_once "../db.php";

// Get all users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
</head>
<body>

<h2>All Users</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <a href="delete_user.php?id=<?= $user['id'] ?>" style="color:red;">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
