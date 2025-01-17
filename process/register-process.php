<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $is_validated = ($role == 'admin') ? 0 : 1;

    // Email existence check
    $email_check_query = "SELECT * FROM users WHERE email = '$email'";
    $email_check_result = mysqli_query($conn, $email_check_query);
    if (mysqli_num_rows($email_check_result) > 0) {
        echo "<script>alert('Email already exists. Please use a different email.'); window.location.href='../pages/register.php';</script>";
        exit;
    }

    // Validate name (letters only)
    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        echo "<script>alert('Name can only contain letters.'); window.location.href='../pages/register.php';</script>";
        exit;
    }

    // Validate password strength and length
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password)) {
        echo "<script>alert('Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.'); window.location.href='../pages/register.php';</script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Handle profile picture upload
    $profile_picture = $_FILES['profile_picture'];
    $profile_picture_name = time() . '_' . $profile_picture['name'];
    $upload_dir = "../assets/Images/profiles/";
    $upload_path = $upload_dir . $profile_picture_name;

    if (!move_uploaded_file($profile_picture['tmp_name'], $upload_path)) {
        die("Profile picture upload failed.");
    }

    $profile_picture_url = "assets/Images/profiles/" . $profile_picture_name;

    // Insert data using simpler syntax
    $sql = "INSERT INTO users (name, email, password, phone, address, profile_picture, role, is_validated) 
            VALUES ('$name', '$email', '$hashed_password', '$phone', '$address', '$profile_picture_url', '$role', $is_validated)";

    if (mysqli_query($conn, $sql)) {
        if ($role == 'admin') {
            echo "<script>alert('Your admin account is pending validation. Please wait for approval.'); window.location.href='../pages/register.php';</script>";
        } else {
            header('Location: ../pages/login.php');
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>