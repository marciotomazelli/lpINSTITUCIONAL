<?php
header('Content-Type: application/json');
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido']);
    exit;
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['name'])) {
    echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO leads (name, email, phone, specialty, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        trim($data['name']),
        trim($data['email'] ?? ''),
        trim($data['phone'] ?? ''),
        trim($data['specialty'] ?? ''),
        trim($data['message'] ?? '')
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Lead salvo com sucesso']);
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar no banco de dados']);
}
?>
