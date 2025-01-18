<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['email']) && isset($_SESSION['role'])) {
    // Redirect to the appropriate dashboard based on the role
    if ($_SESSION['role'] == 'user') {
        header('Location: ../pages/user-dashboard.php'); // Redirect user to user dashboard
    } elseif ($_SESSION['role'] == 'admin') {
        header('Location: ../pages/admin-dashboard.php'); // Redirect admin to admin dashboard
    }
    exit; // Prevent further execution
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
    <form action="../process/register-process.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" required>
        <br>
        <label for="address">Address</label>
        <textarea name="address" id="address" required></textarea>
        <br>
        <label for="profile_picture">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" required>
        <br>
        <div>
            <label for="role">Role</label>
            <input type="radio" name="role" id="role-user" value="user" checked>
            <label for="role-user">User</label>
            <input type="radio" name="role" id="role-admin" value="admin">
            <label for="role-admin">Admin</label>
        </div>

        <button type="submit">Register</button>
    </form>

</body>

</html>
