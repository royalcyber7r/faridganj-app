<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$data = mysqli_query($conn, "SELECT * FROM hospitals ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Hospital List</title>

<style>
body{
    background:#f4f6f9;
    font-family:Arial, sans-serif;
    margin:0;
    padding:0;
}

.container{
    max-width:1100px;
    margin:40px auto;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.header h2{
    margin:0;
}

.add-btn{
    padding:10px 18px;
    background:#009688;
    color:#fff;
    text-decoration:none;
    border-radius:8px;
    font-size:14px;
}
.add-btn:hover{
    background:#00796b;
}

/* TABLE */
.table-box{
    background:#fff;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.12);
    overflow:hidden;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#009688;
    color:#fff;
}

thead th{
    padding:12px;
    font-size:14px;
    text-align:left;
}

tbody td{
    padding:12px;
    font-size:14px;
    border-bottom:1px solid #eee;
    vertical-align:middle;
}

tbody tr:hover{
    background:#f9fdfc;
}

/* IMAGE */
.hospital-img{
    width:60px;
    height:60px;
    border-radius:10px;
    object-fit:cover;
    border:1px solid #ddd;
}

/* ACTION */
.action a{
    text-decoration:none;
    padding:6px 10px;
    border-radius:6px;
    font-size:13px;
    margin-right:5px;
}

.edit{
    background:#2196f3;
    color:#fff;
}
.delete{
    background:#e53935;
    color:#fff;
}

.edit:hover{ background:#1976d2; }
.delete:hover{ background:#c62828; }

/* EMPTY */
.empty{
    text-align:center;
    padding:40px;
    color:#777;
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>🏥 Hospital List</h2>
        <a class="add-btn" href="hospital_add.php">➕ Add New Hospital</a>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ছবি</th>
                    <th>হাসপাতাল নাম</th>
                    <th>ঠিকানা</th>
                    <th>মোবাইল</th>
                    <th>ইমেইল</th>
                    <th>ফেসবুক</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php if(mysqli_num_rows($data) > 0){ ?>
                <?php while($row = mysqli_fetch_assoc($data)){ ?>
                <tr>
                    <td>
                        <?php if(!empty($row['image'])){ ?>
                            <img class="hospital-img"
                                 src="../uploads/hospital/<?= $row['image'] ?>">
                        <?php } else { ?>
                            <span>—</span>
                        <?php } ?>
                    </td>

                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['mobile']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>

                    <td>
                        <?php if($row['facebook']){ ?>
                            <a href="<?= $row['facebook'] ?>" target="_blank">🔗 Link</a>
                        <?php } else { ?>
                            —
                        <?php } ?>
                    </td>

                    <td class="action">
                        <a class="edit"
                           href="hospital_edit.php?id=<?= $row['id'] ?>">✏ Edit</a>

                        <a class="delete"
                           onclick="return confirm('এই হাসপাতালটি ডিলিট করতে চান?')"
                           href="hospital_delete.php?id=<?= $row['id'] ?>">🗑 Delete</a>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" class="empty">
                        😔 কোনো হাসপাতাল পাওয়া যায়নি
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
