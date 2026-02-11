<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
  ONLY ADMIN ALLOWED
  Block sub_admin, user, guest
*/

if (
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin'
) {
    // security: admin page এ ঢুকতে চাইলে 404 দেখাও
    header("Location: ../admin/errors/404.php");
    exit;
}
