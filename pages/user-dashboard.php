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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travello Anywhere</title>
</head>
<body>
    <button onclick="window.location.href='../pages/logout.php'">Log Out</button>
</body>
</html>
