<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newfitlife";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit();
}

// Get JSON data
$data = json_decode(file_get_contents("php://input"), true);
$payment_id = $data["payment_id"] ?? null;

if (!$payment_id) {
    echo json_encode(["success" => false, "error" => "Invalid payment ID"]);
    exit();
}

$sql = "DELETE FROM payments WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $payment_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to delete payment"]);
}

$stmt->close();
$conn->close();
?>
