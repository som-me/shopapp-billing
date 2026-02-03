<?php
require_once "../core/config.php";

session_start();
session_destroy();

/* Redirect Back to Login */
header("Location: " . BASE_URL . "/index.php");
exit;
?>
