<?php
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
    header('Location: ../auth/login.php'); // Redirect to login if not authorized
    exit;
}

echo "Welcome, User!";
// User-specific operations
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Travello Anywhere</title>
</head>
<body>
    <button onclick="window.location.href='../auth/logout.php'">Log Out</button>
</body>
</html>