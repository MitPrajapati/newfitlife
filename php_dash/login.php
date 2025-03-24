<?php
session_start();
include("db.php"); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Get user IP address
        $ip_address = $_SERVER['REMOTE_ADDR'];

        // Insert login record
        $insert_query = "INSERT INTO login (user_id, ip_address) VALUES ('{$user['id']}', '$ip_address')";
        mysqli_query($conn, $insert_query);

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
