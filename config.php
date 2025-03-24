<?php
// Database configuration
$host = "localhost"; // XAMPP default MySQL host
$username = "root"; // Default username for XAMPP MySQL
$password = ""; // No password by default
$database = "newfitlife"; // Your database name

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
