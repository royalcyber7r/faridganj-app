<?php
session_start();
require_once "admin_guard.php";
require_once "../db.php";

/* DELETE USER */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: users.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Users List</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',system-ui,sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(135deg,#eef2ff,#f8fafc);
    padding:50px 20px;
}

/* CARD */
.card{
    max-width:1200px;
    margin:auto;
    background:#ffffff;
    border-radius:20px;
    box-shadow:0 30px 60px rgba(0,0,0,.12);
    padding:30px;
}

.card h2{
    display:flex;
    align-items:center;
    gap:12px;
    font-size:26px;
    color:#111827;
    margin-bottom:25px;
}

/* TABLE */
.table-wrap{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:separate;
    border-spacing:0 14px;
}

thead th{
    background:linear-gradient(135deg,#020617,#0f172a);
    color:#fff;
    padding:16px;
    font-size:14px;
    border-radius:12px;
    text-transform:uppercase;
}

tbody tr{
    background:#fff;
    box-shadow:0 12px 30px rgba(0,0,0,.06);
    transition:.25s;
}

tbody tr:hover{
    transform:translateY(-3px);
}

tbody td{
    padding:16px;
    font-size:15px;
    color:#374151;
    vertical-align:middle;
}

tbody tr td:first-child{
    border-radius:14px 0 0 14px;
}
tbody tr td:last-child{
    border-radius:0 14px 14px 0;
}

/* USER FLEX */
.user-flex{
    display:flex;
    align-items:center;
    gap:12px;
}

/* IMAGE AVATAR (FIXED SIZE) */
.avatar-img{
    width:40px;
    height:40px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid #e5e7eb;
}

/* LETTER AVATAR */
.avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:linear-gradient(135deg,#6366f1,#22d3ee);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
    text-transform:uppercase;
}

/* DELETE BUTTON */
.delete-btn{
    background:linear-gradient(135deg,#ff4d4d,#dc2626);
    color:#fff;
    padding:8px 20px;
    border-radius:30px;
    text-decoration:none;
    font-size:14px;
    box-shadow:0 8px 20px rgba(255,0,0,.35);
}

.delete-btn:hover{
    opacity:.9;
}

/* EMPTY */
.empty{
    text-align:center;
    padding:40px;
    color:#6b7280;
}
</style>
</head>

<body>

<div class="card">
    <h2>👥 All Users</h2>

    <div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php if(mysqli_num_rows($result)>0){ ?>
            <?php while($row=mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?= $row['id']; ?></td>

                <td>
                    <div class="user-flex">
                        <?php 
                        $photoPath = "../uploads/users/" . $row['photo'];
                        if(!empty($row['photo']) && file_exists($photoPath)){ 
                        ?>
                            <img src="<?= $photoPath ?>" class="avatar-img">
                        <?php } else { ?>
                            <div class="avatar">
                                <?= strtoupper(substr($row['name'],0,1)); ?>
                            </div>
                        <?php } ?>
                        <strong><?= htmlspecialchars($row['name']); ?></strong>
                    </div>
                </td>

                <td><?= htmlspecialchars($row['username']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['mobile']); ?></td>

                <td>
                    <a class="delete-btn"
                       href="users.php?delete=<?= $row['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this user?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="empty">No users found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
</div>

</body>
</html>
