<?php
$conn = mysqli_connect("localhost", "root", "", "faridganj");

if (!$conn) {
    die("DB not connected");
}

/* ===== BASE URL AUTO DETECT ===== */
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define('BASE_URL', '/faridganj-app/');
} else {
    define('BASE_URL', '/');
}
?>
