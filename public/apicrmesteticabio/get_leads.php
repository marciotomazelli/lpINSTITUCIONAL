<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$crm_password = 'crmesteticabio'; // Senha do CRM que configurou

if (!isset($data['password']) || $data['password'] !== $crm_password) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Senha incorreta"]);
    exit;
}

$stmt = $pdo->query('SELECT * FROM leads ORDER BY created_at DESC');
$leads = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["status" => "success", "data" => $leads]);
?>
