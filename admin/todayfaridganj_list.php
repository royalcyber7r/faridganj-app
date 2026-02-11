<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$data = $conn->query("SELECT * FROM today_faridganj ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>আজকের ফরিদগঞ্জ (Admin)</title>

<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    margin:0;
    padding:20px;
}
h2{
    margin-bottom:10px;
}
.add-btn{
    display:inline-block;
    margin-bottom:15px;
    background:#4CAF50;
    color:#fff;
    padding:8px 15px;
    text-decoration:none;
    border-radius:5px;
}
.table-box{
    background:#fff;
    padding:15px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,.15);
}
table{
    width:100%;
    border-collapse:collapse;
}
th, td{
    padding:10px;
    border-bottom:1px solid #ddd;
    vertical-align:top;
}
th{
    background:#009688;
    color:#fff;
    text-align:left;
}
img{
    max-width:120px;
    border-radius:6px;
}
.action a{
    text-decoration:none;
    padding:5px 8px;
    border-radius:4px;
    color:#fff;
    font-size:13px;
}
.action .edit{
    background:#2196F3;
}
.action .delete{
    background:#f44336;
}
.desc{
    max-width:350px;
    font-size:14px;
}
</style>
</head>

<body>

<h2>আজকের ফরিদগঞ্জ (Admin)</h2>
<a class="add-btn" href="todayfaridganj_add.php">➕ নতুন যোগ</a>

<div class="table-box">
<table>
<tr>
    <th>ID</th>
    <th>শিরোনাম</th>
    <th>বিস্তারিত</th>
    <th>ছবি</th>
    <th>Action</th>
</tr>

<?php if($data->num_rows > 0): ?>
<?php while($d = $data->fetch_assoc()): ?>
<tr>
    <td><?= $d['id'] ?></td>
    <td><?= htmlspecialchars($d['title']) ?></td>
    <td class="desc"><?= nl2br(htmlspecialchars($d['description'])) ?></td>
    <td>
        <?php if($d['image']): ?>
            <img src="../uploads/today/<?= $d['image'] ?>">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </td>
    <td class="action">
        <a class="edit" href="todayfaridganj_edit.php?id=<?= $d['id'] ?>">Edit</a>
        <a class="delete" href="todayfaridganj_delete.php?id=<?= $d['id'] ?>"
           onclick="return confirm('আপনি কি নিশ্চিত?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
<td colspan="5">কোনো তথ্য পাওয়া যায়নি</td>
</tr>
<?php endif; ?>

</table>
</div>

</body>
</html>
