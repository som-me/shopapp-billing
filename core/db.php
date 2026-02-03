<?php
// core/db.php

$conn = new mysqli("localhost", "root", "", "shopapp_db");

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}
?>
