<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newfitlife";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Fetch User Registrations
$registration_sql = "SELECT id, name, email, joined_date FROM users";
$registration_result = $conn->query($registration_sql);

if (!$registration_result) {
    die(json_encode(["error" => "Query error in users: " . $conn->error]));
}

$registrations = [];
while ($row = $registration_result->fetch_assoc()) {
    $registrations[] = $row;
}

// Fetch User Logins
$login_sql = "SELECT id, name, email, login_time FROM login";
$login_result = $conn->query($login_sql);

if (!$login_result) {
    die(json_encode(["error" => "Query error in login: " . $conn->error]));
}

$logins = [];
while ($row = $login_result->fetch_assoc()) {
    $logins[] = $row;
}

// Return JSON data
echo json_encode([
    "registrations" => $registrations,
    "logins" => $logins
]);

$conn->close();
?>
