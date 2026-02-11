<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
  ALLOW:
  - admin
  - sub_admin

  BLOCK:
  - normal user
  - guest
*/

if (
    !isset($_SESSION['role']) ||
    !in_array($_SESSION['role'], ['admin', 'sub_admin'])
) {
    header("Location: ../auth/sub_admin_login.php");
    exit;
}
