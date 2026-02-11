<?php
require_once "admin_guard.php";
require_once "../db.php";

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = (int)$_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM videos WHERE id=$id");
if (mysqli_num_rows($result) == 0) {
    die("Video not found");
}

$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $video_type = $_POST['video_type'];

    $video_url = $data['video_url']; // default

    /* MP4 upload */
    if ($video_type == "mp4" && !empty($_FILES['video_file']['name'])) {

        $folder = "../uploads/videos/";
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $filename = time() . "_" . $_FILES['video_file']['name'];
        move_uploaded_file($_FILES['video_file']['tmp_name'], $folder . $filename);

        $video_url = "uploads/videos/" . $filename;
    }

    /* YouTube link */
    if ($video_type == "youtube") {
        $video_url = mysqli_real_escape_string($conn, $_POST['video_url']);
    }

    mysqli_query($conn, "
        UPDATE videos 
        SET title='$title', video_url='$video_url', video_type='$video_type'
        WHERE id=$id
    ");

    header("Location: video_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Video</title>
<style>
body{font-family:Arial}
.box{width:350px;border:2px solid red;padding:15px}
</style>
</head>
<body>

<div class="box">
<h2>Edit Video</h2>

<form method="post" enctype="multipart/form-data">

<label>Title</label><br>
<input type="text" name="title"
       value="<?= htmlspecialchars($data['title']); ?>" required>
<br><br>

<label>Video Type</label><br>
<select name="video_type" id="video_type" onchange="toggleFields()" required>
    <option value="mp4" <?= $data['video_type']=="mp4"?"selected":"" ?>>MP4 Upload</option>
    <option value="youtube" <?= $data['video_type']=="youtube"?"selected":"" ?>>YouTube Link</option>
</select>
<br><br>

<!-- Existing MP4 preview -->
<?php if($data['video_type']=="mp4"){ ?>
<video width="250" controls>
    <source src="../<?= $data['video_url']; ?>" type="video/mp4">
</video>
<br><br>
<?php } ?>

<!-- MP4 upload -->
<div id="mp4_box">
    <label>New Video Upload</label><br>
    <input type="file" name="video_file" accept="video/mp4">
</div>

<!-- YouTube URL -->
<div id="youtube_box">
    <label>YouTube URL</label><br>
    <input type="text" name="video_url"
           value="<?= $data['video_type']=="youtube" ? htmlspecialchars($data['video_url']) : "" ?>">
</div>

<br>
<button type="submit" name="update">Update</button>

</form>
</div>

<script>
function toggleFields(){
    let type = document.getElementById("video_type").value;
    document.getElementById("mp4_box").style.display = (type === "mp4") ? "block" : "none";
    document.getElementById("youtube_box").style.display = (type === "youtube") ? "block" : "none";
}
toggleFields(); // page load
</script>

</body>
</html>
