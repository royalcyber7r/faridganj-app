<?php
require_once "sub_admin_guard.php";
require_once "../db.php";
$result = $conn->query("SELECT * FROM pbs ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>PBS Office List</title>

<style>
*{ box-sizing:border-box; }
body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}

.container{
    max-width:1400px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:18px;
    box-shadow:0 12px 30px rgba(0,0,0,.12);
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.header h2{
    margin:0;
    color:#009688;
}
.add-btn{
    text-decoration:none;
    background:#009688;
    color:#fff;
    padding:10px 18px;
    border-radius:10px;
    font-weight:bold;
}
.add-btn:hover{ background:#007f73; }

table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

thead{
    background:#009688;
    color:#fff;
}
th, td{
    padding:12px 10px;
    font-size:14px;
    vertical-align:top;
}
th{
    text-align:center;
    white-space:nowrap;
}

tbody tr{
    border-bottom:1px solid #eee;
}
tbody tr:hover{
    background:#f1fafa;
}

.img-box{
    text-align:center;
}
.img-box img{
    width:55px;
    height:55px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid #009688;
}

.office-name{
    font-weight:bold;
    color:#004d40;
}

.designation{
    color:#555;
    font-size:13px;
    font-style:italic;
}

.address{
    max-width:260px;
    line-height:1.4;
    word-break:break-word;
}

.email{
    color:#00695c;
    font-size:13px;
    word-break:break-all;
}

.action{
    text-align:center;
    white-space:nowrap;
}
.action a{
    text-decoration:none;
    padding:6px 12px;
    border-radius:8px;
    font-size:13px;
    margin:3px;
    display:inline-block;
}
.edit{ background:#ffc107; color:#000; }
.delete{ background:#e53935; color:#fff; }
.edit:hover,.delete:hover{ opacity:.85; }

.no-data{
    text-align:center;
    padding:25px;
    color:#777;
    font-size:15px;
}
</style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>⚡ PBS Office List</h2>
        <a class="add-btn" href="pbs_add.php">➕ Add New</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Office Name</th>
                <th>Person Name</th>
                <th>Designation</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php if($result && $result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ ?>
            <tr>

                <td class="img-box">
                    <?php if(!empty($row['image'])){ ?>
                        <img src="../uploads/pbs/<?= htmlspecialchars($row['image']) ?>">
                    <?php } else { ?>
                        <img src="../assets/no-image.png">
                    <?php } ?>
                </td>

                <td class="office-name">
                    <?= htmlspecialchars($row['office_name']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['name']) ?>
                </td>

                <td class="designation">
                    <?= htmlspecialchars($row['designation']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['mobile']) ?>
                </td>

                <td class="address">
                    <?= nl2br(htmlspecialchars($row['address'])) ?>
                </td>

                <td class="email">
                    <?= htmlspecialchars($row['email']) ?>
                </td>

                <td class="action">
                    <a class="edit" href="pbs_edit.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="delete"
                       href="pbs_delete.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Delete this PBS office?')">
                       Delete
                    </a>
                </td>

            </tr>
        <?php } } else { ?>
            <tr>
                <td colspan="8" class="no-data">No PBS office found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
