<?php
require "../config.php";
$selectedItem = $_POST['selectedItem'];
$amount = $_POST['amount'];
$description = $_POST['description'];

echo "Successfully Sent Data \nGot: $selectedItem, $amount and $description";

$typeMap = [
    "BuyingSomething" => "BS",
    "Income"          => "inc",
    "BoughtFood"      => "food",
    "HealthCare"      => "health",
    "Subscription"    => "service",
    "Clothings"       => "clothing",
    "Maintenance"     => "maintainence",
    "Entertainment"   => "fun",
    "Transport"       => "transport",
    "Utilities"       => "utilities",
    "Repayment"       => "debt",
    "Loan"            => "loan",
    "GiftIncome"      => "gfinc",
];

// --- 2. Pull raw input ---
$rawType        = $_POST['selectedItem'] ?? '';
$rawAmount      = $_POST['amount'] ?? '';
$rawDescription = $_POST['description'] ?? '';

// --- 3. Validate type against whitelist (reject anything not mapped) ---
if (!array_key_exists($rawType, $typeMap)) {
    http_response_code(400);
    die("Invalid category.");
}
$type = $typeMap[$rawType];

// --- 4. Validate amount is actually numeric, cast to float ---
if (!is_numeric($rawAmount)) {
    http_response_code(400);
    die("Invalid amount.");
}
$amount = (float) $rawAmount;

// --- 5. Trim + length-check description (column is VARCHAR(100)) ---
$description = trim($rawDescription);
if ($description === '' || mb_strlen($description) > 100) {
    http_response_code(400);
    die("Invalid description.");
}

// --- 6. user_id must come from session, NEVER from client input ---
session_start();
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(401);
    die("Not authenticated.");
}

// --- 7. Prepared statement ---
$stmt = $conn->prepare("INSERT INTO expenses (user_id, amount, description, type) VALUES (?, ?, ?, ?)");
$stmt->bind_param("idss", $user_id, $amount, $description, $type);
$stmt->execute();

echo "Saved.";