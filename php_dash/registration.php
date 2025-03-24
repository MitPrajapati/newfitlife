<?php
session_start();
include("db.php"); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

    // Insert new user
    $query = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
    
    if (mysqli_query($conn, $query)) {
        echo "Registration successful!";
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
