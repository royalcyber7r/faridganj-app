<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$data = mysqli_query($conn,"SELECT * FROM blood ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Blood Donor List</title>

<style>
body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}
.container{
    width:95%;
    max-width:1200px;
    margin:30px auto;
    background:#fff;
    padding:20px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}
.header h2{
    color:#c0392b;
    margin:0;
}
.add-btn{
    background:#27ae60;
    color:#fff;
    padding:10px 14px;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
}
.add-btn:hover{
    background:#219150;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}
th, td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:left;
    vertical-align:top;
}
th{
    background:#e74c3c;
    color:#fff;
}
tr:hover{
    background:#f9f9f9;
}

.badge{
    padding:4px 8px;
    border-radius:6px;
    color:#fff;
    font-weight:bold;
    font-size:13px;
}
.badge.Aplus,.badge.A\+{background:#e74c3c;}
.badge.Bplus,.badge.B\+{background:#8e44ad;}
.badge.Oplus,.badge.O\+{background:#27ae60;}
.badge.Aminus,.badge.A-{background:#d35400;}
.badge.Bminus,.badge.B-{background:#2980b9;}
.badge.Ominus,.badge.O-{background:#2c3e50;}

.action a{
    text-decoration:none;
    padding:6px 10px;
    border-radius:6px;
    font-size:13px;
}
.edit{
    background:#3498db;
    color:#fff;
}
.delete{
    background:#e74c3c;
    color:#fff;
}

.fb-link{
    color:#1877f2;
    text-decoration:none;
}
.fb-link:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<div class="container">
    <div class="header">
        <h2>🩸 Blood Donor List</h2>
        <a href="blood_add.php" class="add-btn">➕ Add New Donor</a>
    </div>

    <table>
        <tr>
            <th>#</th>
            <th>নাম</th>
            <th>রক্তের গ্রুপ</th>
            <th>শেষ রক্ত দানের তারিখ</th>
            <th>ঠিকানা</th>
            <th>মোবাইল</th>
            <th>Facebook</th>
            <th>Action</th>
        </tr>

        <?php
        $i=1;
        while($r = mysqli_fetch_assoc($data)){
            $date = "";
            if(!empty($r['last_donate'])){
                $date = date("d/m/Y", strtotime($r['last_donate']));
            }
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td>
                <span class="badge <?= str_replace('+','plus',str_replace('-','minus',$r['blood_group'])) ?>">
                    <?= $r['blood_group'] ?>
                </span>
            </td>
            <td><?= $date ?: "-" ?></td>
            <td><?= nl2br(htmlspecialchars($r['address'])) ?></td>
            <td><?= htmlspecialchars($r['mobile']) ?></td>
            <td>
                <?php if(!empty($r['facebook'])){ ?>
                    <a class="fb-link" href="<?= $r['facebook'] ?>" target="_blank">Facebook</a>
                <?php } else { echo "-"; } ?>
            </td>
            <td class="action">
                <a class="edit" href="blood_edit.php?id=<?= $r['id'] ?>">Edit</a>
                <a class="delete" href="blood_delete.php?id=<?= $r['id'] ?>"
                   onclick="return confirm('আপনি কি নিশ্চিত ডিলিট করতে চান?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
