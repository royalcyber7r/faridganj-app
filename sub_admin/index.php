<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 'sub_admin') {
    header("Location: ../admin/sub_dashboard.php");
    exit();
}

header("Location: sub_admin_login.php");
exit();
