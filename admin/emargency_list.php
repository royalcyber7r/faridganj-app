<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$data = $conn->query("SELECT * FROM emargency ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Emergency List</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
}
.container{
    max-width:1200px;
    margin:30px auto;
    background:#fff;
    padding:20px;
    border-radius:8px;
}
h2{
    margin-bottom:15px;
}
.add-btn{
    display:inline-block;
    margin-bottom:15px;
    padding:8px 14px;
    background:#007bff;
    color:#fff;
    text-decoration:none;
    border-radius:5px;
    font-weight:bold;
}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    border:1px solid #ddd;
    padding:10px;
    vertical-align:top;
}
th{
    background:#f1f1f1;
}
img{
    width:70px;
    border-radius:6px;
}

/* ACTION BUTTON STYLE */
.action{
    text-align:center;
    white-space:nowrap;
}
.btn{
    display:inline-block;
    padding:6px 12px;
    font-size:14px;
    border-radius:5px;
    text-decoration:none;
    color:#fff;
    margin:2px;
}
.btn-edit{
    background:#17a2b8;
}
.btn-edit:hover{
    background:#138496;
}
.btn-delete{
    background:#dc3545;
}
.btn-delete:hover{
    background:#bd2130;
}
</style>
</head>

<body>
<div class="container">

<h2>🚨 Emergency Service List</h2>
<a class="add-btn" href="emargency_add.php">➕ Add New</a>

<table>
<thead>
<tr>
    <th>Logo</th>
    <th>Website</th>
    <th>Hotline</th>
    <th>Description</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
<?php while($r = $data->fetch_assoc()): ?>
<tr>
    <td>
        <?php if(!empty($r['logo'])): ?>
            <img src="../uploads/emargency/<?= htmlspecialchars($r['logo']) ?>">
        <?php endif; ?>
    </td>

    <td>
        <a href="<?= htmlspecialchars($r['website']) ?>" target="_blank">
            <?= htmlspecialchars($r['website']) ?>
        </a>
    </td>

    <td><?= htmlspecialchars($r['hotline']) ?></td>

    <td><?= nl2br(htmlspecialchars($r['description'])) ?></td>

    <td class="action">
        <a class="btn btn-edit" href="emargency_edit.php?id=<?= $r['id'] ?>">✏️ Edit</a>
        <a class="btn btn-delete"
           onclick="return confirm('Are you sure to delete this service?')" 
           href="emargency_delete.php?id=<?= $r['id'] ?>">🗑️ Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

</div>
</body>
</html>
