<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $role = $_POST['role'];
    $is_validated = ($role == 'admin') ? 0 : 1;

    // Debugging role
    echo "Role selected: " . $role;

    $email_phone_check_query = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'";
    $email_phone_check_result = mysqli_query($conn, $email_phone_check_query);

    if (mysqli_num_rows($email_phone_check_result) > 0) {
        echo "<script>alert('Email or phone number already exists. Please use a different email or phone number.'); window.location.href='../pages/auth/signup.php';</script>";
        exit;
    }

    if (!preg_match("/^[a-zA-Z]+$/", $name)) {
        echo "<script>alert('Name can only contain letters.'); window.location.href='../pages/auth/signup.php';</script>";
        exit;
    }

    // Validate password strength and length
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[\W_]/", $password)) {
        echo "<script>alert('Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.'); window.location.href='../pages/auth/signup.php';</script>";
        exit;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $profile_picture = $_FILES['profile_picture'];
    $profile_picture_name = time() . '_' . $profile_picture['name'];
    $upload_dir = "../assets/Images/profiles/";
    $upload_path = $upload_dir . $profile_picture_name;

    if (!move_uploaded_file($profile_picture['tmp_name'], $upload_path)) {
        die("Profile picture upload failed.");
    }

    $profile_picture_url = "assets/Images/profiles/" . $profile_picture_name;

    $sql = "INSERT INTO users (name, email, password, phone, address, profile_picture, role, is_validated) 
            VALUES ('$name', '$email', '$hashed_password', '$phone', '$address', '$profile_picture_url', '$role', $is_validated)";

    if (mysqli_query($conn, $sql)) {
        if ($role == 'admin') {
            echo "<script>alert('Your admin account is pending validation. Please wait for approval.'); window.location.href='../pages/auth/signup.php';</script>";
        } else {
            header('Location: ../pages/auth/login.php');
        }
    } else {
        error_log("SQL Error: " . mysqli_error($conn));
        echo "<script>alert('Error saving user data.'); window.location.href='../pages/auth/signup.php';</script>";
    }
}

mysqli_close($conn);