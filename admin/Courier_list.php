<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

// Fetch all couriers from the database
$query = "SELECT * FROM courier_companies";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die('Query failed: ' . mysqli_error($conn)); // Output the SQL error
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>কুরিয়ার সার্ভিস তালিকা (এডমিন)</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
	
    <style>
        body{
            background: #f4f6f9 !important;
        }

        .page-center{
            width:100%;
            text-align:center;
            margin-top:30px;
        }

        .total-courier{
            font-size:16px;
        }

        .page-title{
            font-size:26px;
            margin-bottom:30px;
        }

        .courier-grid{
            display:flex;
            justify-content:center;
        }

        .courier-card{
            text-align:center;
        }

        .courier-grid img{
            width:120px;
            height:120px;
            border-radius:50%;
            object-fit:cover;
            border:3px solid #ddd;
            display:block;
            margin:0 auto 10px;
        }

        .action-btns{
            display:flex;
            justify-content:center;
            gap:10px;
            margin-top:10px;
        }

        .edit-btn{
            background:#3498db;
            color:#fff;
            padding:5px 10px;
            text-decoration:none;
            border-radius:4px;
        }

        .delete-btn{
            background:#e74c3c;
            color:#fff;
            padding:5px 10px;
            text-decoration:none;
            border-radius:4px;
        }
    </style>

</head>

<body>

<!-- Add New Courier button -->
<div class="add-new-box">
    <a href="courier_add.php" class="add-new-btn">
        ➕ Add New Courier
    </a>
</div>

<h2 style="text-align:center;">কুরিয়ার সার্ভিস ম্যানেজমেন্ট</h2>

<div class="courier-grid">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
    <div style="border:1px solid #ccc; width:220px; padding:10px; text-align:center; display:inline-block;">
        <img src="../uploads/courier/<?= $row['photo'] ?>" width="120"><br>

        <b><?= $row['name'] ?></b><br>

        <p><?= $row['address']; ?></p>
        <p><?= $row['mobile']; ?></p>
        <p><?= $row['email']; ?></p>
        <p><a href="<?= $row['facebook_link'] ?>" target="_blank">Facebook</a></p>

        <a href="courier_edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a> |
        <a href="courier_delete.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure to delete this?')">Delete</a>
    </div>
<?php } ?>
</div>

</body>
</html>
