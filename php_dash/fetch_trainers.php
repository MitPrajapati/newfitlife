<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../config.php'; // Check if config.php path is correct

header('Content-Type: application/json');

$sql = "SELECT * FROM trainers";
$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["success" => false, "error" => $conn->error]);
    exit;
}

$trainers = [];
while ($row = $result->fetch_assoc()) {
    $trainers[] = $row;
}

echo json_encode(["success" => true, "data" => $trainers]);
?>
