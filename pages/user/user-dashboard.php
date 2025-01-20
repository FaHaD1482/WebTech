<?php
    session_start();

    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
        header('Location: ../../auth/login.php');
        exit;
    }

    include('../../config/db.php');

    // Fetch packages from the database
    $sql = "SELECT * FROM travel_packages";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/user-dashboard.css">
</head>
<body>
    <header>
        <h1>Welcome to Travello Anywhere</h1>
        <nav>
            <ul>
                <li><a href="user-dashboard.php">Dashboard</a></li>
                <li><a href="packages.php">Packages</a></li>
                <li><a href="resorts.php">Resorts</a></li>
                <li><a href="transportation.php">Transportation</a></li>
                <li><a href="settings.php">Profile Setting</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content Section -->
    <main>
        <h2>Available Packages</h2>
        <div class="packages-container">
            <div class="package-image">
                <img src="../../assets/Images/logo.png" alt="Package Image">
            </div>
            <div class="caption">
                <p class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </p>
                <p class="title">Package-1</p>

            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Travello Anywhere. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
