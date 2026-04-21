<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['name']) || trim($data['name']) === '') {
    echo json_encode(["status" => "error", "message" => "Name is required"]);
    exit;
}

$name = trim($data['name']);
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? ''); // ADICIONADO
$specialty = trim($data['specialty'] ?? '');
$message = trim($data['message'] ?? '');

$stmt = $pdo->prepare('INSERT INTO leads (name, email, phone, specialty, message, status) VALUES (?, ?, ?, ?, ?, ?)');
// Status default como 'Novo'
if ($stmt->execute([$name, $email, $phone, $specialty, $message, 'Novo'])) {
    echo json_encode(["status" => "success"]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Failed to save lead"]);
}
?>
