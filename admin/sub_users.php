<?php
require_once "admin_guard.php";
require_once "../config/db.php";

/* DELETE sub admin */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM sub_admins WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: sub_users.php");
    exit();
}

/* Fetch sub admins */
$result = $conn->query("SELECT id, name, email, created_at FROM sub_admins ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sub Admin Users</title>

<style>
body{
    background:#f4f6f9;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    margin:0;
    padding:20px;
}

.card{
    max-width:900px;
    margin:auto;
    background:#fff;
    border-radius:16px;
    padding:25px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

h2{
    text-align:center;
    margin-bottom:25px;
    color:#2c3e50;
}

table{
    width:100%;
    border-collapse:collapse;
}

th, td{
    padding:12px 14px;
    text-align:left;
    border-bottom:1px solid #eee;
}

th{
    background:#f8f9fa;
    color:#555;
    font-size:14px;
}

td{
    font-size:14px;
}

.action a{
    padding:6px 10px;
    border-radius:8px;
    text-decoration:none;
    font-size:13px;
    color:#fff;
}

.delete{
    background:#e74c3c;
}

.delete:hover{
    background:#c0392b;
}

.back{
    text-align:center;
    margin-top:20px;
}

.back a{
    text-decoration:none;
    color:#555;
}
</style>
</head>

<body>

<div class="card">
    <h2>👥 Sub Admin Users</h2>

    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Action</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php $i=1; while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= $row['created_at'] ?? '—'; ?></td>
                <td class="action">
                    <a class="delete"
                       href="?delete=<?= $row['id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this sub admin?')">
                       ❌ Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">No sub admins found</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="back">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>