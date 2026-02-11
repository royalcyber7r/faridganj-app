<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn, "SELECT * FROM research ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>রিসার্চ সেন্টার তালিকা</title>

<style>
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    border:1px solid #444;
    padding:8px;
    text-align:left;
}
th{
    background:#f2f2f2;
}
img{
    border-radius:6px;
}
a{
    color:#0d6efd;
    font-weight:600;
    text-decoration:none;
}
</style>
</head>

<body>

<h2>🔬 রিসার্চ সেন্টার তালিকা</h2>
<a href="research_add.php">➕ Add New Research</a>
<br><br>

<table>
<tr>
    <th>ছবি</th>
    <th>রিসার্চ সেন্টার নাম</th>
    <th>প্রধান</th>
    <th>রিসার্চ কোড</th>
    <th>মোবাইল</th>
    <th>ঠিকানা</th>
    <th>Facebook</th>
    <th>Website</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
    <td>
        <?php if(!empty($row['image'])){ ?>
            <img src="../uploads/research/<?= $row['image'] ?>" width="70">
        <?php } else { ?>
            No Image
        <?php } ?>
    </td>

    <td><?= htmlspecialchars($row['research_name']) ?></td>
    <td><?= htmlspecialchars($row['head_name']) ?></td>
    <td><?= htmlspecialchars($row['research_code']) ?></td>
    <td><?= htmlspecialchars($row['mobile']) ?></td>
    <td><?= htmlspecialchars($row['address']) ?></td>

    <td>
        <?= !empty($row['facebook'])
            ? "<a href='{$row['facebook']}' target='_blank'>Facebook</a>"
            : "-" ?>
    </td>

    <td>
        <?= !empty($row['website'])
            ? "<a href='{$row['website']}' target='_blank'>Website</a>"
            : "-" ?>
    </td>

    <td>
        <a href="research_edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="research_delete.php?id=<?= $row['id'] ?>"
           onclick="return confirm('আপনি কি নিশ্চিত?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
