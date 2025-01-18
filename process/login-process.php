<?php
session_start();
include('../config/db.php');

// Check if user is already logged in
if (isset($_SESSION['email']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'user') {
        header('Location: ../pages/user-dashboard.php');
        exit;
    } elseif ($_SESSION['role'] == 'admin') {
        header('Location: ../pages/admin-dashboard.php');
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role']; // Role selected in the login form

    // Prepare SQL query to check email, password, and role
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $sql->bind_param("ss", $email, $role);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Check admin validation if role is admin
            if ($role == 'admin' && $user['is_validated'] == 0) {
                echo "<script>alert('Admin account is pending validation.'); window.location.href='../pages/login.php';</script>";
                exit;
            }

            // Create session variables
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect to the appropriate dashboard
            if ($role == 'user') {
                header('Location: ../pages/user-dashboard.php');
            } elseif ($role == 'admin') {
                header('Location: ../pages/admin-dashboard.php');
            }
        } else {
            echo "<script>alert('Invalid email or password.'); window.location.href='../pages/login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid email, password, or role.'); window.location.href='../pages/login.php';</script>";
    }
}

// Close database connection
$conn->close();
?>