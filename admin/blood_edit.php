<?php
require_once "admin_guard.php";
require_once "../db.php";

$id = $_GET['id'] ?? 0;

// ডাটা আনা
$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM blood WHERE id='$id'"));
if(!$d){
    die("Invalid ID");
}

/* ---------- DB date → DD/MM/YYYY ---------- */
$display_date = "";
if(!empty($d['last_donate'])){
    $display_date = date("d/m/Y", strtotime($d['last_donate']));
}

/* ---------- Update ---------- */
if(isset($_POST['update'])){

    // DD/MM/YYYY → YYYY-MM-DD
    $last_donate = "";
    if(!empty($_POST['last_donate'])){
        $dt = DateTime::createFromFormat("d/m/Y", $_POST['last_donate']);
        if($dt){
            $last_donate = $dt->format("Y-m-d");
        }
    }

    mysqli_query($conn,"UPDATE blood SET
        name        = '$_POST[name]',
        blood_group = '$_POST[blood_group]',
        last_donate = '$last_donate',
        address     = '$_POST[address]',
        mobile      = '$_POST[mobile]',
        facebook    = '$_POST[facebook]'
        WHERE id='$id'
    ");

    header("location:blood_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit Blood Donor</title>

<style>
body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}
.container{
    max-width:600px;
    margin:40px auto;
    background:#fff;
    padding:25px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
h2{
    text-align:center;
    color:#c0392b;
    margin-bottom:25px;
}
.form-group{
    margin-bottom:15px;
}
label{
    display:block;
    font-weight:bold;
    margin-bottom:6px;
}
input, textarea, select{
    width:100%;
    padding:11px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}
textarea{
    resize:vertical;
}
input:focus, textarea:focus, select:focus{
    border-color:#c0392b;
    outline:none;
}
.btn-group{
    display:flex;
    gap:10px;
    margin-top:20px;
}
.btn{
    flex:1;
    padding:12px;
    border:none;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
}
.update{
    background:#27ae60;
    color:#fff;
}
.back{
    background:#7f8c8d;
    color:#fff;
    text-decoration:none;
    text-align:center;
    line-height:42px;
}
</style>
</head>

<body>

<div class="container">
    <h2>✏️ রক্তদাতা তথ্য আপডেট</h2>

    <form method="post">

        <div class="form-group">
            <label>নাম</label>
            <input name="name" value="<?= htmlspecialchars($d['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>রক্তের গ্রুপ</label>
            <select name="blood_group" required>
                <?php
                $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];
                foreach($groups as $g){
                    $selected = ($d['blood_group'] == $g) ? "selected" : "";
                    echo "<option value='$g' $selected>$g</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>শেষ রক্ত দানের তারিখ</label>
            <input 
                type="text" 
                name="last_donate" 
                placeholder="DD/MM/YYYY"
                value="<?= $display_date ?>"
            >
        </div>

        <div class="form-group">
            <label>ঠিকানা</label>
            <textarea name="address"><?= htmlspecialchars($d['address']) ?></textarea>
        </div>

        <div class="form-group">
            <label>মোবাইল</label>
            <input name="mobile" value="<?= htmlspecialchars($d['mobile']) ?>">
        </div>

        <div class="form-group">
            <label>Facebook Link</label>
            <input name="facebook" value="<?= htmlspecialchars($d['facebook']) ?>">
        </div>

        <div class="btn-group">
            <button class="btn update" name="update">✅ Update</button>
            <a class="btn back" href="blood_list.php">⬅ Back</a>
        </div>

    </form>
</div>

</body>
</html>
