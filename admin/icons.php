<?php
require_once "admin_guard.php";
require_once "../db.php";

$result = mysqli_query($conn, "SELECT * FROM icons ORDER BY id DESC");

if(!$result){
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>All Icons</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 20px;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.page-header h2 {
    margin: 0;
    color: #333;
}

.add-btn {
    text-decoration: none;
    background: #007bff;
    color: #fff;
    padding: 8px 14px;
    border-radius: 4px;
    font-size: 14px;
}

.add-btn:hover {
    background: #0056b3;
}

.table-wrapper {
    background: #fff;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background: #343a40;
    color: #fff;
}

th, td {
    padding: 12px 10px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

tbody tr:hover {
    background: #f1f5ff;
}

.icon-img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.action a {
    text-decoration: none;
    font-size: 13px;
    padding: 5px 8px;
    border-radius: 4px;
    margin: 0 2px;
}

.edit-btn {
    background: #ffc107;
    color: #000;
}

.delete-btn {
    background: #dc3545;
    color: #fff;
}

.edit-btn:hover {
    background: #e0a800;
}

.delete-btn:hover {
    background: #c82333;
}
</style>
</head>

<body>

<div class="page-header">
    <h2>📌 All Icons</h2>
    <a href="icon_add.php" class="add-btn">➕ Add New Icon</a>
</div>

<div class="table-wrapper">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Icon</th>
            <th>Link</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['title']); ?></td>
            <td>
                <img src="../img/icons/<?= $row['image']; ?>" class="icon-img">
            </td>
            <td><?= htmlspecialchars($row['link']); ?></td>
            <td class="action">
                <a class="edit-btn" href="icon_edit.php?id=<?= $row['id']; ?>">✏ Edit</a>
                <a class="delete-btn"
                   href="icon_delete.php?id=<?= $row['id']; ?>"
                   onclick="return confirm('Are you sure?')">🗑 Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>

</body>
</html>
