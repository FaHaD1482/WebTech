<?php
session_start();

// Check if the admin is logged in and has the correct role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Redirect to login if not authorized
    exit;
}

echo "Welcome, Admin!";
// Admin-specific operations
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Travello Anywhere</title>
</head>
<body>
    <button onclick="window.location.href='../pages/logout.php'">Log Out</button>
</body>
</html>
