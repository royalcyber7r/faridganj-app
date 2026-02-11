<?php
require_once "admin_guard.php";
require_once "../db.php";


$message = "";
$editData = null;

/* ================= DELETE ================= */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $res = $conn->query("SELECT image FROM home_items WHERE id=$id");
    if ($res->num_rows > 0) {
        $data = $res->fetch_assoc();
        $imgPath = "../uploads/home_items/" . $data['image'];
        if (file_exists($imgPath)) unlink($imgPath);
    }

    $conn->query("DELETE FROM home_items WHERE id=$id");
    header("Location: home_items_adds.php?msg=deleted");
    exit();
}

/* ================= EDIT LOAD ================= */
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM home_items WHERE id=$id");
    if ($res->num_rows > 0) {
        $editData = $res->fetch_assoc();
    }
}

/* ================= ADD / UPDATE ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $link  = trim($_POST['link']);
    $id    = isset($_POST['id']) ? intval($_POST['id']) : 0;

    $uploadDir = "../uploads/home_items/";
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    if ($id > 0) {

        if (!empty($_FILES['image']['name'])) {

            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $newName = time() . "_" . rand(1000,9999) . "." . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $newName);

            $old = $conn->query("SELECT image FROM home_items WHERE id=$id")->fetch_assoc();
            if (file_exists($uploadDir.$old['image'])) unlink($uploadDir.$old['image']);

            $stmt = $conn->prepare("UPDATE home_items SET title=?, link=?, image=? WHERE id=?");
            $stmt->bind_param("sssi", $title, $link, $newName, $id);

        } else {
            $stmt = $conn->prepare("UPDATE home_items SET title=?, link=? WHERE id=?");
            $stmt->bind_param("ssi", $title, $link, $id);
        }

        $stmt->execute();
        header("Location: home_items_adds.php?msg=updated");
        exit();
    } else {

        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $newName = time() . "_" . rand(1000,9999) . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $newName);

        $stmt = $conn->prepare("INSERT INTO home_items (title, image, link) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $newName, $link);
        $stmt->execute();

        header("Location: home_items_adds.php?msg=added");
        exit();
    }
}

/* ================= MESSAGE ================= */
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "added") $message = "Item Added Successfully!";
    if ($_GET['msg'] == "deleted") $message = "Item Deleted Successfully!";
    if ($_GET['msg'] == "updated") $message = "Item Updated Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Home Items</title>

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    background:#f2f4f8;
}
.container{
    width:95%;
    margin:auto;
}

/* ========= FORM ========= */

.form-wrapper{
    max-width:450px;
    margin:20px auto 40px;
}
.card{
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}
label{
    font-size:13px;
    font-weight:600;
}
input[type="text"],
input[type="file"]{
    width:100%;
    padding:8px 10px;
    margin-top:5px;
    margin-bottom:12px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:13px;
}
button{
    padding:8px 16px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    font-size:13px;
}
.btn-add{
    background:#28a745;
    color:#fff;
}
.btn-add:hover{
    opacity:.9;
}

/* ========= ITEMS ========= */

.items{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(180px,1fr));
    gap:25px;
}

.item-box{
    background:#ffffff;
    padding:25px 15px;
    border-radius:18px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    transition:0.3s;
}
.item-box:hover{
    transform:translateY(-5px);
}

.circle{
    width:120px;
    height:120px;
    margin:auto;
    border-radius:50%;
    border:4px solid #ddd;
    overflow:hidden;
}
.circle img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.image-link{
    display:block;
}

.item-title{
    margin-top:12px;
    font-size:15px;
    font-weight:600;
}

.actions{
    margin-top:12px;
}

.btn-edit{
    background:#007bff;
    color:#fff;
    padding:5px 10px;
    border-radius:5px;
    text-decoration:none;
    font-size:12px;
}

.btn-delete{
    background:#dc3545;
    color:#fff;
    padding:5px 10px;
    border-radius:5px;
    text-decoration:none;
    font-size:12px;
}

.success{
    background:#d4edda;
    padding:10px;
    border-radius:6px;
    margin-bottom:20px;
    font-weight:600;
}
</style>

</head>
<body>

<div class="container">

<h2>Manage Home Items</h2>

<?php if($message) echo "<div class='success'>$message</div>"; ?>

<div class="form-wrapper">
<div class="card">
<form method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">

    <label>Item Name</label>
    <input type="text" name="title"
        value="<?php echo $editData['title'] ?? ''; ?>" required>

    <label>Item URL</label>
    <input type="text" name="link"
        value="<?php echo $editData['link'] ?? ''; ?>" required>

    <label>Upload Image</label>
    <input type="file" name="image">

    <button type="submit" class="btn-add">
        <?php echo $editData ? "Update Item" : "Add Item"; ?>
    </button>

</form>
</div>
</div>

<h3>All Items</h3>

<div class="items">
<?php
$result = $conn->query("SELECT * FROM home_items ORDER BY id ASC");
while($row = $result->fetch_assoc()){
?>
    <div class="item-box">

        <!-- IMAGE CLICK = GO TO LINK (Same Tab) -->
        <a href="<?php echo htmlspecialchars($row['link']); ?>" class="image-link">
            <div class="circle">
                <img src="../uploads/home_items/<?php echo htmlspecialchars($row['image']); ?>">
            </div>
        </a>

        <div class="item-title">
            <?php echo htmlspecialchars($row['title']); ?>
        </div>

        <div class="actions">
            <a href="?edit=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
            <a href="?delete=<?php echo $row['id']; ?>"
               onclick="return confirm('Are you sure?')"
               class="btn-delete">Delete</a>
        </div>
    </div>
<?php } ?>
</div>

</div>
</body>
</html>
