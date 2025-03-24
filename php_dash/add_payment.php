<?php
header("Content-Type: application/json");
require_once "db_connection.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["name"], $data["email"], $data["plan"], $data["amount"], $data["payment_date"])) {
    echo json_encode(["success" => false, "error" => "Missing required fields"]);
    exit();
}

$name = $data["name"];
$email = $data["email"];
$plan = $data["plan"];
$amount = $data["amount"];
$payment_date = $data["payment_date"];

$sql = "INSERT INTO payments (name, email, plan, amount, payment_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $plan, $amount, $payment_date);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $conn->error]);
}

$stmt->close();
$conn->close();
?>
