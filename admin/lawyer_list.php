<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = mysqli_query($conn,"SELECT * FROM lawyers ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Lawyer List (Admin)</title>

<style>
*{box-sizing:border-box}
body{
    margin:0;
    font-family:Segoe UI,Arial;
    background:#f4f6f9;
    padding:25px;
}

/* header */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.header h2{
    margin:0;
    color:#2c3e50;
}
.add-btn{
    background:#27ae60;
    color:#fff;
    padding:10px 16px;
    border-radius:10px;
    text-decoration:none;
    font-size:14px;
}
.add-btn:hover{background:#1f8f4f}

/* table */
.table-box{
    background:#fff;
    border-radius:14px;
    box-shadow:0 15px 35px rgba(0,0,0,.08);
    overflow:hidden;
}

table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

th{
    background:#ecf0f1;
    text-align:left;
    padding:12px;
    color:#34495e;
    white-space:nowrap;
}

td{
    padding:12px;
    border-top:1px solid #eee;
    vertical-align:middle;
}

tr:hover{
    background:#fafafa;
}

/* photo */
.photo{
    width:55px;
    height:55px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid #3498db;
}

/* action buttons */
.btn{
    padding:7px 12px;
    border-radius:8px;
    text-decoration:none;
    color:#fff;
    font-size:13px;
    display:inline-block;
}
.edit{background:#3498db}
.delete{background:#e74c3c}
.edit:hover{background:#2c80b4}
.delete:hover{background:#c0392b}

/* facebook link */
.fb-link{
    color:#1877f2;
    font-weight:600;
    text-decoration:none;
}
.fb-link:hover{text-decoration:underline}

/* small text */
.small{
    color:#666;
    font-size:13px;
}

/* responsive */
@media(max-width:900px){
    table{font-size:13px}
    .hide-mobile{display:none}
}
</style>
</head>

<body>

<div class="header">
    <h2>⚖️ Lawyer List</h2>
    <a class="add-btn" href="lawyer_add.php">➕ Add Lawyer</a>
</div>

<div class="table-box">
<table>
<tr>
    <th>Photo</th>
    <th>Name</th>
    <th>Designation</th>
    <th>Mobile</th>
    <th class="hide-mobile">Chamber</th>
    <th class="hide-mobile">Email</th>
    <th class="hide-mobile">Facebook</th>
    <th>Action</th>
</tr>

<?php if(mysqli_num_rows($result)==0){ ?>
<tr>
    <td colspan="8" style="text-align:center;color:#999;">No lawyer found</td>
</tr>
<?php } ?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
    <td>
        <img class="photo"
        src="<?= $row['photo'] 
            ? '../uploads/lawyers/'.$row['photo'] 
            : '../assets/no-user.png' ?>">
    </td>

    <td>
        <strong><?= htmlspecialchars($row['name']) ?></strong>
    </td>

    <td class="small">
        <?= htmlspecialchars($row['designation']) ?>
    </td>

    <td>
        <?= htmlspecialchars($row['mobile']) ?>
    </td>

    <td class="small hide-mobile">
        <?= htmlspecialchars($row['chamber_address']) ?>
    </td>

    <td class="small hide-mobile">
        <?= htmlspecialchars($row['email']) ?>
    </td>

    <td class="hide-mobile">
        <?php if(!empty($row['facebook_link'])){ ?>
            <a class="fb-link"
               href="<?= htmlspecialchars($row['facebook_link']) ?>"
               target="_blank">
               🔗 Facebook
            </a>
        <?php } else { ?>
            <span style="color:#999;">—</span>
        <?php } ?>
    </td>

    <td>
        <a class="btn edit" href="lawyer_edit.php?id=<?= $row['id'] ?>">Edit</a>
        <a class="btn delete"
           onclick="return confirm('Are you sure you want to delete this lawyer?')"
           href="lawyer_delete.php?id=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
