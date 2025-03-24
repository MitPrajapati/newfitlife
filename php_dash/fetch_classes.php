<?php
require_once __DIR__ . '/../config.php';

// Ensure database connection is established
if (!$conn) {
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit();
}

// SQL query to fetch class details with trainer names
$sql = "SELECT 
            classes.id, 
            classes.class_name, 
            COALESCE(trainers.name, 'N/A') AS trainer_name, 
            classes.schedule, 
            classes.duration, 
            classes.capacity, 
            classes.location, 
            classes.status, 
            classes.created_at 
        FROM classes 
        LEFT JOIN trainers ON classes.trainer_id = trainers.id";

$result = $conn->query($sql);

// Handle SQL execution errors
if (!$result) {
    echo json_encode(["success" => false, "error" => $conn->error]);
    exit();
}

// Fetch data and store it in an array
$classes = [];
while ($row = $result->fetch_assoc()) {
    $classes[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode(["success" => true, "data" => $classes], JSON_PRETTY_PRINT);
?>
