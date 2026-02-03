<?php
// core/config.php

/*
    Smart BASE_URL Detection
    Works on:
    - Localhost (XAMPP)
    - VPS Deployment (triveni.cloud/private/shopapp)
*/

/* Detect Host */
$host = $_SERVER["HTTP_HOST"];

/* Default Path (Project Folder Name) */
$projectFolder = "/shopapp";

/* VPS Path */
$vpsFolder = "/private/shopapp";

/* Localhost Setup */
if ($host === "localhost") {
    define("BASE_URL", "http://localhost" . $projectFolder);
}

/* VPS Setup */
else {
    define("BASE_URL", "https://" . $host . $vpsFolder);
}
?>
