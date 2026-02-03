<?php
require_once "config.php";

function redirect($path)
{
    global $BASE_URL;
    header("Location: " . $BASE_URL . $path);
    exit;
}

function sanitize($data)
{
    return htmlspecialchars(trim($data));
}
?>
