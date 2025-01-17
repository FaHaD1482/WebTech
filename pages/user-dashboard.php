<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

if ($_SESSION['role'] == 'user') {
    echo "Welcome, User!";
    // User-specific operations
}
?>
