<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$crm_password = 'crmesteticabio';

if (!isset($data['password']) || $data['password'] !== $crm_password) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Senha incorreta"]);
    exit;
}

if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "ID não fornecido"]);
    exit;
}

$stmt = $pdo->prepare('DELETE FROM leads WHERE id = ?');
if ($stmt->execute([$data['id']])) {
    echo json_encode(["status" => "success"]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Falha ao apagar"]);
}
?>
