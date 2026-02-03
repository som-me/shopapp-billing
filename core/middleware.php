<?php
// core/middleware.php
session_start();

require_once "config.php";

function requireLogin()
{
    global $BASE_URL;

    if (!isset($_SESSION["admin"])) {
        header("Location: " . $BASE_URL . "/index.php");
        exit;
    }
}
?>
