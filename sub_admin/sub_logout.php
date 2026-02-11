<?php
session_start();

$_SESSION = [];
session_destroy();

header("Location: ../sub_admin/");
exit();
