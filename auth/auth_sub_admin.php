<?php
session_start();

if (!isset($_SESSION['sub_admin_id']) || $_SESSION['role'] !== 'sub_admin') {
    header("Location: ../auth/sub_admin_login.php");
    exit();
}