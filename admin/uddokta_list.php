<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = $conn->query("SELECT * FROM uddokta ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>উদ্যোক্তা তালিকা</title>

<style>
body{
    font-family:Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    margin:0;
}
.container{
    max-width:1200px;
    margin:30px auto;
    padding:0 15px;
}
h2{
    margin-bottom:15px;
}
.add-btn{
    display:inline-block;
    margin-bottom:15px;
    padding:8px 14px;
    background:#009688;
    color:#fff;
    border-radius:6px;
    text-decoration:none;
    font-size:14px;
}
table{
    width:100%;
    background:#fff;
    border-collapse:collapse;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
}
th, td{
    padding:10px;
    border-bottom:1px solid #eee;
    font-size:13px;
    vertical-align:top;
}
th{
    background:#fafafa;
    font-weight:600;
}
img{
    width:55px;
    height:55px;
    border-radius:50%;
    object-fit:cover;
    border:1px solid #ddd;
}
.btn{
    padding:5px 10px;
    border-radius:6px;
    color:#fff;
    text-decoration:none;
    font-size:12px;
    margin-right:4px;
    display:inline-block;
}
.edit{background:#009688;}
.del{background:#e53935;}
.link{
    color:#1565c0;
    text-decoration:none;
    font-size:12px;
    word-break:break-all;
}
.empty{
    text-align:center;
    padding:30px;
    color:#777;
}
</style>
</head>

<body>

<div class="container">

<h2>👤 উদ্যোক্তা তালিকা</h2>

<a href="uddokta_add.php" class="add-btn">+ নতুন যোগ</a>

<table>
<tr>
    <th>ছবি</th>
    <th>নাম</th>
    <th>ফেইজের নাম</th>
    <th>ঠিকানা</th>
    <th>মোবাইল</th>
    <th>ফেসবুক</th>
    <th>ওয়েবসাইট</th>
    <th>Action</th>
</tr>

<?php if($result && $result->num_rows > 0): ?>
<?php while($d = $result->fetch_assoc()): ?>
<tr>

    <td>
        <?php if(!empty($d['image']) && file_exists("../uploads/uddokta/".$d['image'])): ?>
            <img src="../uploads/uddokta/<?= htmlspecialchars($d['image']) ?>">
        <?php else: ?>
            —
        <?php endif; ?>
    </td>

    <td><?= htmlspecialchars($d['name'] ?? '') ?></td>

    <td><?= htmlspecialchars($d['Page_name'] ?? '—') ?></td>

    <td><?= !empty($d['address']) ? nl2br(htmlspecialchars($d['address'])) : '—' ?></td>

    <td><?= htmlspecialchars($d['mobile'] ?? '—') ?></td>

    <td>
        <?php if(!empty($d['facebook'])): ?>
            <a class="link" href="<?= htmlspecialchars($d['facebook']) ?>" target="_blank">Facebook</a>
        <?php else: ?>
            —
        <?php endif; ?>
    </td>

    <td>
        <?php if(!empty($d['website'])): ?>
            <a class="link" href="<?= htmlspecialchars($d['website']) ?>" target="_blank">Website</a>
        <?php else: ?>
            —
        <?php endif; ?>
    </td>

    <td>
        <a class="btn edit" href="uddokta_edit.php?id=<?= (int)$d['id'] ?>">Edit</a>
        <a class="btn del" onclick="return confirm('ডিলিট করতে চান?')" href="uddokta_delete.php?id=<?= (int)$d['id'] ?>">Delete</a>
    </td>

</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="8" class="empty">কোনো তথ্য পাওয়া যায়নি</td>
</tr>
<?php endif; ?>

</table>

</div>

</body>
</html>
