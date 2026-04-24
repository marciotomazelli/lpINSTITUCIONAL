<?php
// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'este7915_crmesteticabio');
define('DB_USER', 'este7915_crmesteticabio');
define('DB_PASS', 'crmesteticabio');

// Configurações do Sistema
define('ADMIN_PASSWORD', 'crmesteticabio'); // Altere para uma senha forte

// Conexão PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Em produção, não exiba o erro detalhado
    // die("Erro na conexão com o banco de dados.");
    error_log($e->getMessage());
}
?>