<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
include "sub_admin_guard.php";
$result = mysqli_query($conn, "SELECT * FROM college ORDER BY id DESC");
?>


<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>কলেজ তালিকা</title>
<style>
table{width:100%;border-collapse:collapse;}
th,td{border:1px solid #444;padding:8px;}
th{background:#f2f2f2;}
img{border-radius:6px;}
a{color:#0d6efd;font-weight:600;text-decoration:none;}
</style>
</head>

<body>

<h2>🎓 কলেজ তালিকা</h2>
<a href="college_add.php">➕ Add New College</a>
<br><br>

<table>
<tr>
    <th>ছবি</th>
    <th>কলেজের নাম</th>
    <th>অধ্যক্ষ</th>
    <th>EIIN</th>
    <th>কলেজ কোড</th>
    <th>মোবাইল</th>
    <th>ঠিকানা</th>
    <th>Facebook</th>
    <th>Website</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td>
        <?php if($row['image']){ ?>
            <img src="../uploads/college/<?= $row['image'] ?>" width="70">
        <?php } else { echo "No Image"; } ?>
    </td>

    <td><?= htmlspecialchars($row['college_name']) ?></td>
    <td><?= htmlspecialchars($row['head_name']) ?></td>
    <td><?= htmlspecialchars($row['eiin']) ?></td>
    <td><?= htmlspecialchars($row['institute_code']) ?></td>
    <td><?= htmlspecialchars($row['mobile']) ?></td>
    <td><?= htmlspecialchars($row['address']) ?></td>

    <td><?= $row['facebook'] ? "<a href='{$row['facebook']}' target='_blank'>Facebook</a>" : "-" ?></td>
    <td><?= $row['website'] ? "<a href='{$row['website']}' target='_blank'>Website</a>" : "-" ?></td>

    <td>
        <a href="college_edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="college_delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>
</body>
</html>
