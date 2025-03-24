<?php
session_start();
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newfitlife";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit();
}

// Get form data
$name = $_POST["name"] ?? '';
$email = $_POST["email"] ?? '';
$plan = $_POST["plan"] ?? '';
$card = $_POST["card"] ?? '';
$expiry = $_POST["expiry"] ?? '';
$cvv = $_POST["cvv"] ?? '';

// Define plan prices
$planPrices = [
    "Basic" => 999,
    "Standard" => 1999,
    "Premium" => 3999
];

// Validate plan & set amount
if (!isset($planPrices[$plan])) {
    echo json_encode(["success" => false, "error" => "Invalid plan selected"]);
    exit();
}
$amount = $planPrices[$plan];
$payment_date = date("Y-m-d H:i:s");

// Insert into database using prepared statements
$sql = "INSERT INTO payments (name, email, plan, amount, payment_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssds", $name, $email, $plan, $amount, $payment_date);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Payment successful"]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$stmt->close();
$conn->close();
?>
