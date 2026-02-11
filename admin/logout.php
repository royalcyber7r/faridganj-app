<?php
session_start();

$_SESSION = [];
session_destroy();

/* project base auto detect */
$base = dirname(dirname($_SERVER['SCRIPT_NAME']));

header("Location: $base/admin/");
exit;