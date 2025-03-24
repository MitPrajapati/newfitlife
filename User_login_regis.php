<?php
session_start();  // Start the session

$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password (empty)
$dbname = "newfitlife";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ USER REGISTRATION
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password

    // Check if email already exists
    $check_email = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='register.html';</script>";
        exit();
    }
    $stmt->close();

    // Insert user into `users` table
    $sql = "INSERT INTO users (name, email, password, joined_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='register.html';</script>";
    }

    $stmt->close();
}

// ✅ USER LOGIN
if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Find user in `users` table
    $sql = "SELECT id, name, password FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($password, $row['password'])) {
        // Store user session
        $_SESSION['user'] = $row['name'];
        $_SESSION['email'] = $email;

        // Save login record to `login` table (make sure `name` exists in `login` table)
        $login_sql = "INSERT INTO login (name, email, login_time) VALUES (?, ?, NOW())";
        $login_stmt = $conn->prepare($login_sql);
        $login_stmt->bind_param("ss", $row['name'], $email);
        $login_stmt->execute();
        $login_stmt->close();

        echo "<script>alert('Login successful! Redirecting...'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Invalid email or password! Please try again.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
