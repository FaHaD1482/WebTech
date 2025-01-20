<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $role = 'user'; // Default role is set to 'user'
    $is_validated = 1; // Users are validated by default

    // Check if email or phone already exists
    $email_phone_check_query = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
    $email_phone_check_result = mysqli_query($conn, $email_phone_check_query);

    if (mysqli_num_rows($email_phone_check_result) > 0) {
        echo "<script>alert('Email or phone number already exists. Please use a different email or phone number.'); window.location.href='../pages/auth/signup.php';</script>";
        exit;
    }

    // Validate name (only letters)
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo "<script>alert('Name can only contain letters and spaces.'); window.location.href='../pages/auth/signup.php';</script>";
        exit;
    }

    // Validate password strength and length
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[\W_]/", $password)) {
        echo "<script>alert('Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.'); window.location.href='../pages/auth/signup.php';</script>";
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

    // Insert user data into the database
    $sql = "INSERT INTO users (name, email, password, phone, address, profile_picture, role, is_validated) 
            VALUES ('$name', '$email', '$hashed_password', '$phone', '$address', '$profile_picture_url', '$role', $is_validated)";

    if (mysqli_query($conn, $sql)) {
        // Set session flag for success notification
        session_start();
        $_SESSION['signup_success'] = true;

        // Redirect to signup page to show success notification
        header('Location: ../pages/auth/signup.php');
        exit;
    } else {
        error_log("SQL Error: " . mysqli_error($conn));
        echo "<script>alert('Error saving user data. Please try again.'); window.location.href='../pages/auth/signup.php';</script>";
    }
}

mysqli_close($conn);
