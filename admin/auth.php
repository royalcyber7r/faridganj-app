<?php
session_start(); // Ensure session_start is at the very top
include("../db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php"); // Redirect to the login page
    exit;
}
?>
