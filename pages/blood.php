<?php
session_start();
include "../db.php";

/* =========================
   POST → REDIRECT → GET
========================= */
if(isset($_POST['search'])){
    $_SESSION['blood_group'] = $_POST['blood_group'] ?? "";
    header("Location: blood.php");
    exit;
}

/* Clear */
if(isset($_GET['clear'])){
    unset($_SESSION['blood_group']);
    header("Location: blood.php");
    exit;
}

/* Selected group */
$selectedGroup = $_SESSION['blood_group'] ?? "";

/* Query */
if(!empty($selectedGroup)){
    $group = mysqli_real_escape_string($conn,$selectedGroup);
    $result = mysqli_query(
        $conn,
        "SELECT * FROM blood WHERE blood_group='$group' ORDER BY id DESC"
    );
}else{
    $result = mysqli_query($conn,"SELECT * FROM blood ORDER BY id DESC");
}

/* Date format */
function formatDateDMY($date){
    if(!$date || $date=='0000-00-00'){
        return "N/A";
    }
    return date("d/m/Y", strtotime($date));
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>রক্ত সেবা</title>

<style>
body{
    margin:0;
    font-family:Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}
.container{
    width:95%;
    margin:auto;
    padding:25px 0;
}
.page-title{
    font-size:26px;
    font-weight:bold;
    margin-bottom:15px;
}
.search-box{
    max-width:520px;
    margin:0 auto 30px;
    display:flex;
    gap:10px;
}
.search-box select,
.search-box button,
.search-box a{
    padding:12px;
    border-radius:10px;
    border:1px solid #ccc;
    font-size:15px;
}
.search-box select{flex:1;}
.search-btn{
    background:#e74c3c;
    color:#fff;
    border:none;
    cursor:pointer;
}
.clear-btn{
    background:#7f8c8d;
    color:#fff;
    text-decoration:none;
    display:flex;
    align-items:center;
    justify-content:center;
}
.blood-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:20px;
}
.blood-card{
    background:#fff;
    padding:18px;
    border-radius:16px;
    text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
}
.blood-group{
    width:70px;
    height:70px;
    border-radius:50%;
    background:#e74c3c;
    color:#fff;
    font-size:20px;
    font-weight:bold;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 12px;
}
.name{font-weight:bold;}
.addr{font-size:13px;color:#666;}
.mobile{font-weight:bold;}
.fb{color:#1877f2;font-weight:bold;text-decoration:none;}
</style>
</head>

<body>

<div class="container">
    <div class="page-title">🩸 রক্ত সেবা</div>

    <!-- SEARCH -->
    <form class="search-box" method="post">
        <select name="blood_group">
            <option value="">🔍 রক্তের গ্রুপ নির্বাচন করুন</option>
            <?php
            $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];
            foreach($groups as $g){
                $sel = ($selectedGroup==$g) ? "selected" : "";
                echo "<option value='$g' $sel>$g</option>";
            }
            ?>
        </select>
        <button class="search-btn" name="search">Search</button>
        <a class="clear-btn" href="?clear=1">Clear</a>
    </form>

    <!-- RESULT -->
    <div class="blood-grid">
    <?php
    if(mysqli_num_rows($result)){
        while($row=mysqli_fetch_assoc($result)){
    ?>
        <div class="blood-card">
            <div class="blood-group"><?= htmlspecialchars($row['blood_group']) ?></div>
            <div class="name"><?= htmlspecialchars($row['name']) ?></div>
            <div class="addr"><?= htmlspecialchars($row['address']) ?></div>
            <div class="mobile">📞 <?= htmlspecialchars($row['mobile']) ?></div>
            <div>🗓️ শেষ রক্ত দান: <?= formatDateDMY($row['last_donate']) ?></div>
            <?php if($row['facebook']){ ?>
                <a class="fb" href="<?= htmlspecialchars($row['facebook']) ?>" target="_blank">Facebook</a>
            <?php } ?>
        </div>
    <?php }}else{
        echo "<p style='grid-column:1/-1;text-align:center;color:red;font-weight:bold;'>কোনো ডোনার পাওয়া যায়নি</p>";
    } ?>
    </div>
</div>

</body>
</html>
