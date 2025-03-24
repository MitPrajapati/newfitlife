<?php
require_once __DIR__ . '/../config.php'; // Adjust path if needed

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['trainer_id'])) {
    echo json_encode(["success" => false, "error" => "Trainer ID is required"]);
    exit;
}

$trainer_id = intval($data['trainer_id']);

// Delete trainer from database
$sql = "DELETE FROM trainers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $trainer_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Failed to delete trainer"]);
}

$stmt->close();
$conn->close();
?>
