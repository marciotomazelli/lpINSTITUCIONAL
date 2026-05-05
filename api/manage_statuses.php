<?php
require_once '../config.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? $_GET['action'] ?? '';

header('Content-Type: application/json');

try {
    switch ($action) {
        case 'list':
            $stmt = $pdo->query("SELECT * FROM lead_statuses ORDER BY id ASC");
            echo json_encode(['status' => 'success', 'data' => $stmt->fetchAll()]);
            break;

        case 'save':
            $id = $data['id'] ?? null;
            $name = $data['name'] ?? '';
            $color = $data['color'] ?? '#3b82f6';
            
            if (empty($name)) {
                echo json_encode(['status' => 'error', 'message' => 'Nome é obrigatório']);
                break;
            }

            if ($id) {
                $stmt = $pdo->prepare("UPDATE lead_statuses SET name = ?, color = ? WHERE id = ?");
                $stmt->execute([$name, $color, $id]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO lead_statuses (name, color) VALUES (?, ?)");
                $stmt->execute([$name, $color]);
            }
            echo json_encode(['status' => 'success']);
            break;

        case 'delete':
            $id = $data['id'] ?? null;
            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'ID não informado']);
                break;
            }
            
            // Check if it's being used by any lead
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM leads WHERE status = (SELECT name FROM lead_statuses WHERE id = ?)");
            $stmt->execute([$id]);
            if ($stmt->fetchColumn() > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Este status está em uso e não pode ser excluído']);
                break;
            }

            $stmt = $pdo->prepare("DELETE FROM lead_statuses WHERE id = ?");
            $stmt->execute([$id]);
            echo json_encode(['status' => 'success']);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
