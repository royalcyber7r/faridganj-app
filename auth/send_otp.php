<?php
session_start();
require "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $mobile = trim($_POST['mobile']);
    $mobile = str_replace([' ', '-', '+'], '', $mobile);

    if (strlen($mobile) == 13 && substr($mobile,0,2) == '88') {
        $mobile = substr($mobile,2);
    }

    $otp = rand(100000, 999999);
    $expire = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    $update = mysqli_query($conn,"
        UPDATE users 
        SET otp='$otp', otp_expire='$expire'
        WHERE mobile='$mobile'
    ");

    if (mysqli_affected_rows($conn) == 0) {
        die("Mobile number not found!");
    }

    // GreenWeb SMS
    $token = "YOUR_GREENWEB_TOKEN";
    $msg = "GreenWeb OTP: $otp\nExpire in 5 minutes.";

    $url = "http://api.greenweb.com.bd/api.php";
    $data = [
        'token' => $token,
        'to' => $mobile,
        'message' => $msg
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ]
    ];

    file_get_contents($url, false, stream_context_create($options));

    $_SESSION['otp_mobile'] = $mobile;
    header("Location: verify_otp.php");
    exit;
}
