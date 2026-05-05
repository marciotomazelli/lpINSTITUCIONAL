<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
    exit;
}

$id = $data['id'];
$name = $data['name'];
$email = $data['email'];
$phone = $data['phone'];
$specialty = $data['specialty'];
$message = $data['message'];
$classification = $data['classification'] ?? 'Não Cliente';

try {
    $stmt = $pdo->prepare("UPDATE leads SET name = ?, email = ?, phone = ?, specialty = ?, message = ?, classification = ? WHERE id = ?");
    $stmt->execute([$name, $email, $phone, $specialty, $message, $classification, $id]);

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
