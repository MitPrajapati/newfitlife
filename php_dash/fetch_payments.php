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
    die(json_encode(["success" => false, "error" => "Database connection failed: " . $conn->connect_error]));
}

if (!$conn->query("SHOW TABLES LIKE 'payments'")->num_rows) {
    die(json_encode(["success" => false, "error" => "Table 'payments' does not exist"]));
}

$sql = "SELECT id, name, email, plan, amount, payment_date FROM payments";
$result = $conn->query($sql);

if (!$result) {
    die(json_encode(["success" => false, "error" => "SQL query failed: " . $conn->error]));
}

$payments = [];
while ($row = $result->fetch_assoc()) {
    $payments[] = $row;
}

echo json_encode(["success" => true, "data" => $payments], JSON_PRETTY_PRINT);
$conn->close();
?>
