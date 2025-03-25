<?php
require_once __DIR__ . '/../config.php';

if (!$conn) {
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit();
}

$sql = "SELECT 
            classes.id, 
            classes.class_name, 
            COALESCE(trainers.trainer_name, 'N/A') AS trainer_name, 
            classes.schedule, 
            classes.duration, 
            classes.capacity, 
            classes.location, 
            classes.status, 
            classes.created_at 
        FROM classes 
        LEFT JOIN trainers ON classes.trainer_id = trainers.id";

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(["success" => false, "error" => $conn->error]);
    exit();
}

$classes = [];
while ($row = $result->fetch_assoc()) {
    $classes[] = $row;
}

header('Content-Type: application/json');
echo json_encode(["success" => true, "data" => $classes], JSON_PRETTY_PRINT);
?>
