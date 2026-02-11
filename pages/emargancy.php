<?php
include "../db.php";
$data = $conn->query("SELECT * FROM emargency ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>জরুরী সেবা</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    margin:0;
}
.container{
    max-width:1200px;
    margin:30px auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}
h2{
    margin-bottom:20px;
}

/* table */
table{
    width:100%;
    border-collapse:collapse;
}
th, td{
    border:1px solid #ddd;
    padding:12px;
    vertical-align:middle;
}
th{
    background:#f1f1f1;
    text-align:center;
}

/* center columns */
.logo,
.website,
.hotline{
    text-align:center;
}

/* logo image */
.logo img{
    width:80px;
    display:block;
    margin:0 auto;
}

/* description */
.description{
    text-align:left;
    line-height:1.6;
}

a{
    color:#0066cc;
    text-decoration:none;
    word-break:break-all;
}

/* responsive */
@media(max-width:768px){
    table,thead,tbody,tr,td,th{
        display:block;
    }
    th{
        display:none;
    }
    td{
        border:none;
        border-bottom:1px solid #ddd;
    }
}
</style>
</head>

<body>

<div class="container">
<h2>জরুরী সেবা</h2>

<table>
<thead>
<tr>
    <th>লোগো</th>
    <th>ওয়েবসাইট</th>
    <th>হটলাইন</th>
    <th>বিস্তারিত</th>
</tr>
</thead>

<tbody>
<?php while($row = $data->fetch_assoc()): ?>
<tr>
    <td class="logo">
        <?php if(!empty($row['logo'])): ?>
            <img src="../uploads/emargency/<?= htmlspecialchars($row['logo']) ?>">
        <?php endif; ?>
    </td>

    <td class="website">
        <?php if(!empty($row['website'])): ?>
        <a href="<?= htmlspecialchars($row['website']) ?>" target="_blank">
            <?= htmlspecialchars($row['website']) ?>
        </a>
        <?php endif; ?>
    </td>

    <td class="hotline">
        <?= htmlspecialchars($row['hotline']) ?>
    </td>

    <td class="description">
        <?= nl2br(htmlspecialchars($row['description'])) ?>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

</div>

</body>
</html>
