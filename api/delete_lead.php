<?php
header('Content-Type: application/json');
require_once '../config.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['status' => 'error', 'message' => 'Não autorizado']);
    exit;
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID não informado']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM leads WHERE id = ?");
    $stmt->execute([$data['id']]);
    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
