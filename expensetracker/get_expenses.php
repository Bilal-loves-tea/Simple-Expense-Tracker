<?php
session_start();
require '../config.php';
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    die(json_encode(["error" => "Not authenticated"]));
}

$stmt = $conn->prepare("SELECT id, amount, description, type, date FROM expenses WHERE user_id = ? ORDER BY date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$expenses = [];
while ($row = $result->fetch_assoc()) {
    $expenses[] = $row;
}

header('Content-Type: application/json');
echo json_encode($expenses);