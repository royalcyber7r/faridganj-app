<?php
session_start();

// লগইন চেক (চাও তো রাখবে)
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>সার্ভিস</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f6f8;
            margin:0;
            padding:0;
        }
        .box{
            max-width:500px;
            margin:100px auto;
            background:#fff;
            padding:40px;
            text-align:center;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }
        .box h1{
            color:#e74c3c;
        }
        .box a{
            display:inline-block;
            margin-top:20px;
            text-decoration:none;
            color:#fff;
            background:#27ae60;
            padding:10px 20px;
            border-radius:5px;
        }
    </style>
</head>
<body>

<div class="box">
    <h1>🚧 সেবা আসছে 🚧</h1>
    <p>এই সার্ভিসটি খুব শীঘ্রই চালু করা হবে।</p>

    <a href="home.php">← হোমে ফিরে যান</a>
</div>

</body>
</html>
