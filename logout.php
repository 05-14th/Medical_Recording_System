<?php
include 'config.php';
session_start();

// Clear session variables
$_SESSION["userId"] = null;
session_destroy();

// Prevent caching of sensitive pages
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Redirect to index page
header("Location: index.php");
exit;
?>
