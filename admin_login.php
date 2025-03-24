<?php
session_start();
include("db.php"); // Include database connection

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.html");
    exit();
}

// Handle Login
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    // Fetch admin credentials from database
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify password
    if ($hashed_password && hash("sha256", $admin_password) === $hashed_password) {
        $_SESSION['admin_id'] = 1;
        header("Location: ./php_dash/admin_dash.html"); // Redirect to admin dashboard
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>
