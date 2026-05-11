<?php
header('Content-Type: application/json');
require_once '../config.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
    exit;
}

$id = $data['id'];
$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$specialty = $data['specialty'] ?? '';
$message = $data['message'] ?? '';
$classification = $data['classification'] ?? 'Não Cliente';
$status = $data['status'] ?? 'Novo';

if (empty($name)) {
    echo json_encode(['status' => 'error', 'message' => 'Nome é obrigatório']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE leads SET name = ?, email = ?, phone = ?, specialty = ?, message = ?, classification = ?, status = ? WHERE id = ?");
    $stmt->execute([$name, $email, $phone, $specialty, $message, $classification, $status, $id]);

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
