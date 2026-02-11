<?php
require_once "admin_guard.php";
require_once "../db.php";

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = (int) $_GET['id'];

/* ===== MAIN DATA ===== */
$stmt = $conn->prepare("SELECT * FROM to_let WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    die("Data not found");
}

/* ===== IMAGES ===== */
$images = $conn->query("SELECT * FROM to_let_images WHERE to_let_id=$id");

/* ===== UPDATE ===== */
if (isset($_POST['update'])) {

    $stmt = $conn->prepare(
        "UPDATE to_let SET 
            house_type=?, 
            area=?, 
            rooms=?, 
            washroom=?, 
            rent=?, 
            phone=?, 
            address=?, 
            google_map_link=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "ssssssssi",
        $_POST['house_type'],
        $_POST['area'],
        $_POST['rooms'],
        $_POST['washroom'],
        $_POST['rent'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['google_map_link'],
        $id
    );

    $stmt->execute();

    /* ===== IMAGE REPLACE ===== */
    if (!empty($_FILES['images'])) {
        foreach ($_FILES['images']['name'] as $imgId => $imgName) {

            if ($imgName != "") {

                $tmp  = $_FILES['images']['tmp_name'][$imgId];
                $ext  = pathinfo($imgName, PATHINFO_EXTENSION);
                $new  = time() . "_" . rand(100,999) . "." . $ext;

                move_uploaded_file($tmp, "../uploads/" . $new);

                $stmtImg = $conn->prepare(
                    "UPDATE to_let_images SET image=? WHERE id=? AND to_let_id=?"
                );
                $stmtImg->bind_param("sii", $new, $imgId, $id);
                $stmtImg->execute();
            }
        }
    }

    header("Location: to_let_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Edit To Let</title>

<style>
body{
    font-family:Arial;
    background:#f4f6f9;
    padding:30px;
}
.box{
    max-width:900px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}
h2{
    color:#009688;
    margin-bottom:20px;
}
h3{
    margin:30px 0 15px;
}
.grid{
    display:grid;
    grid-template-columns: repeat(2,1fr);
    gap:15px;
}
.field{
    display:flex;
    flex-direction:column;
    gap:6px;
}
label{
    font-size:14px;
    color:#555;
}
input, textarea{
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:14px;
}
textarea{
    resize:none;
    min-height:90px;
}
.images{
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(140px,1fr));
    gap:15px;
}
.image-box{
    text-align:center;
    background:#fafafa;
    padding:10px;
    border-radius:10px;
}
.image-box img{
    width:100%;
    height:120px;
    object-fit:cover;
    border-radius:8px;
    margin-bottom:8px;
}
button{
    width:100%;
    margin-top:30px;
    padding:14px;
    background:#009688;
    color:#fff;
    border:none;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
}
</style>
</head>

<body>

<div class="box">
<h2>✏️ বাসার তথ্য আপডেট</h2>

<form method="post" enctype="multipart/form-data">

<div class="grid">

    <div class="field">
        <label>বাসার ধরন</label>
        <input name="house_type" value="<?= htmlspecialchars($data['house_type']) ?>">
    </div>

    <div class="field">
        <label>আয়তন (sqft)</label>
        <input name="area" value="<?= htmlspecialchars($data['area']) ?>">
    </div>

    <div class="field">
        <label>রুম সংখ্যা</label>
        <input name="rooms" value="<?= htmlspecialchars($data['rooms']) ?>">
    </div>

    <div class="field">
        <label>বাথরুম</label>
        <input name="washroom" value="<?= htmlspecialchars($data['washroom']) ?>">
    </div>

    <div class="field">
        <label>ভাড়া</label>
        <input name="rent" value="<?= htmlspecialchars($data['rent']) ?>">
    </div>

    <div class="field">
        <label>মোবাইল নাম্বার</label>
        <input name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
    </div>

</div>

<div class="field" style="margin-top:20px">
    <label>ঠিকানা</label>
    <textarea name="address"><?= htmlspecialchars($data['address']) ?></textarea>
</div>

<div class="field" style="margin-top:15px">
    <label>Google Map Link</label>
    <input 
        name="google_map_link"
        placeholder="https://maps.google.com/..."
        value="<?= htmlspecialchars($data['google_map_link']) ?>">
</div>

<h3>📷 ছবি পরিবর্তন (যেটা চাইবেন সেটাই)</h3>

<div class="images">
<?php while($img = $images->fetch_assoc()){ ?>
    <div class="image-box">
        <img src="../uploads/<?= htmlspecialchars($img['image']) ?>">
        <input type="file" name="images[<?= $img['id'] ?>]">
    </div>
<?php } ?>
</div>

<button name="update">✅ Update Now</button>
</form>
</div>

</body>
</html>
