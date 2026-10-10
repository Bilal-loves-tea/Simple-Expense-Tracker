<?php
session_start();
require '../config.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    die(json_encode(["error" => "Not authenticated"]));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(["error" => "POST only"]));
}

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    die(json_encode(["error" => "Invalid id"]));
}

// user_id in the WHERE clause stops one user from deleting another user's rows
$stmt = $conn->prepare("DELETE FROM expenses WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["success" => true]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Expense not found"]);
}

$stmt->close();
$conn->close();