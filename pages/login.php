<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travello Anywhere</title>
    <link rel="stylesheet" href="">
</head>

<body>
    <div id="form-container">
        <form id="login-form" method="POST" action="login.php">
            <h2>Login</h2>
            <label for="login-email">Email:</label>
            <input type="email" id="login-email" name="email" required>

            <label for="login-password">Password:</label>
            <input type="password" id="login-password" name="password" required>

            <button type="submit">Login</button>
            <p>Don't have an account? <a href="signup.php" id="switch-to-signup">Register Now</a></p>
        </form>
</body>

</html>