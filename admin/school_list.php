<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn, "SELECT * FROM school ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>শিক্ষা প্রতিষ্ঠান তালিকা</title>

<style>
table{
    width:100%;
    border-collapse:collapse;
}
th, td{
    border:1px solid #444;
    padding:8px;
    text-align:left;
    vertical-align:middle;
}
th{
    background:#f2f2f2;
}
img{
    border-radius:6px;
}
a{
    color:#0d6efd;
    text-decoration:none;
    font-weight:600;
}
a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<h2>🏫 শিক্ষা প্রতিষ্ঠান তালিকা</h2>
<a href="school_add.php">➕ Add New School</a>

<br><br>

<table>
<tr>
    <th>ছবি</th>
    <th>নাম</th>
    <th>প্রধান শিক্ষক</th>
    <th>EIIN</th>
    <th>কোড</th>
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
            <img src="../uploads/school/<?= htmlspecialchars($row['image']) ?>" width="70">
        <?php }else{ ?>
            No Image
        <?php } ?>
    </td>

    <td><?= htmlspecialchars($row['school_name']) ?></td>
    <td><?= htmlspecialchars($row['head_name']) ?></td>
    <td><?= htmlspecialchars($row['eiin']) ?></td>
    <td><?= htmlspecialchars($row['institute_code']) ?></td>
    <td><?= htmlspecialchars($row['mobile']) ?></td>
    <td><?= htmlspecialchars($row['address']) ?></td>

    <td>
        <?php if(!empty($row['facebook'])){ ?>
            <a href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">Facebook</a>
        <?php }else{ echo "-"; } ?>
    </td>

    <td>
        <?php if(!empty($row['website'])){ ?>
            <a href="<?= htmlspecialchars($row['website']) ?>" target="_blank">Website</a>
        <?php }else{ echo "-"; } ?>
    </td>

    <td>
    <a href="school_edit.php?id=<?= $row['id'] ?>">Edit</a> |
    <a href="school_delete.php?id=<?= $row['id'] ?>" 
       onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>
<?php } ?>

</table>

</body>
</html>
