<?php
session_start();
include("db.php"); // Include database connection

// Check if Admin is Logged In
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | FitLife</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        .logout { padding: 10px 20px; background: red; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Welcome to Admin Dashboard</h2>
    <p>You are successfully logged in as Admin.</p>
    <a href="admin_panel.php?logout=true" class="logout">Logout</a>
</body>
</html>
