<?php
session_start();

/* login check */
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

/* admin-only page protection */
if (isset($adminOnly) && $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/home.php");
    exit;
}