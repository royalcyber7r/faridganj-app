<?php
require_once "sub_admin_guard.php";
require_once "../db.php";

if(isset($_POST['save'])){

    $title = $_POST['title'];
    $url   = $_POST['video_url'];
    $type  = $_POST['video_type'];

    /* =========================
       MP4 Upload Handling
    ========================= */
    if($type === "mp4" && !empty($_FILES['video_file']['name'])){

        // video folder path
        $videoDir = "../uploads/video/";

        // folder না থাকলে create করবে
        if(!is_dir($videoDir)){
            mkdir($videoDir, 0777, true);
        }

        // unique file name
        $fileName = time() . "_" . basename($_FILES['video_file']['name']);
        $target   = $videoDir . $fileName;

        if(move_uploaded_file($_FILES['video_file']['tmp_name'], $target)){
            // DB path (relative)
            $url = "uploads/video/" . $fileName;
        }
    }

    mysqli_query($conn,"INSERT INTO videos(title, video_type, video_url)
                        VALUES('$title','$type','$url')");

    header("Location: video_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Video</title>

<style>
body{
    background:#f4f6f9;
    font-family: Arial, sans-serif;
}
.container{
    width:420px;
    margin:60px auto;
    background:#fff;
    padding:25px;
    border-radius:8px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}
.container h2{
    text-align:center;
    margin-bottom:20px;
    color:#333;
}
.form-group{
    margin-bottom:15px;
}
.form-group label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
    color:#555;
}
.form-group input,
.form-group select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:4px;
    font-size:14px;
}
.form-group input[type="file"]{
    padding:6px;
}
.btn{
    width:100%;
    padding:10px;
    background:#007bff;
    border:none;
    color:#fff;
    font-size:15px;
    border-radius:4px;
    cursor:pointer;
}
.btn:hover{
    background:#0056b3;
}
.back-link{
    text-align:center;
    margin-top:15px;
}
.back-link a{
    text-decoration:none;
    color:#007bff;
    font-size:14px;
}
</style>
</head>

<body>

<div class="container">
    <h2>Add New Video</h2>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label>Video Title</label>
            <input type="text" name="title" placeholder="Enter video title" required>
        </div>

        <div class="form-group">
            <label>Video Type</label>
            <select name="video_type" onchange="toggleInput(this.value)">
                <option value="youtube">YouTube Link</option>
                <option value="embed">Any Embed URL</option>
                <option value="mp4">Upload MP4</option>
            </select>
        </div>

        <div class="form-group" id="urlBox">
            <label>Video URL</label>
            <input type="text" name="video_url" placeholder="Paste video URL">
        </div>

        <div class="form-group" id="fileBox" style="display:none;">
            <label>Upload MP4 File</label>
            <input type="file" name="video_file" accept="video/mp4">
        </div>

        <button type="submit" name="save" class="btn">Save Video</button>
    </form>

    <div class="back-link">
        <a href="video_list.php">← Back to Video List</a>
    </div>
</div>

<script>
function toggleInput(type){
    if(type === "mp4"){
        document.getElementById("fileBox").style.display = "block";
        document.getElementById("urlBox").style.display = "none";
    }else{
        document.getElementById("fileBox").style.display = "none";
        document.getElementById("urlBox").style.display = "block";
    }
}
</script>

</body>
</html>
