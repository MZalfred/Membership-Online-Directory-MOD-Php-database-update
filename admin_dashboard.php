<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

echo "Welcome to the Admin Dashboard!";
// Here you would add links to manage members, view reports, etc.
?>
