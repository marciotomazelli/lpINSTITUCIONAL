<?php
require_once 'config.php';
try {
    // Tenta adicionar a coluna. Se já existir, o MySQL retornará erro, que será capturado no catch.
    try {
        $pdo->exec("ALTER TABLE leads ADD COLUMN sale_value DECIMAL(10,2) DEFAULT 0.00;");
    } catch (PDOException $e) {
        // Ignora erro de "coluna duplicada" (1060)
        if ($e->getCode() != '42S21' && strpos($e->getMessage(), '1060') === false) {
            throw $e;
        }
    }

    $pdo->exec("ALTER TABLE leads MODIFY COLUMN status ENUM('Novo', 'Em Contato', 'Ganho', 'Perdido') DEFAULT 'Novo';");
    
    echo "<h1>Migração concluída com sucesso!</h1><p>O banco de dados foi atualizado. Você já pode excluir este arquivo (migration.php).</p><a href='crm.php'>Ir para o CRM</a>";
} catch (PDOException $e) {
    echo "<h1>Erro na migração:</h1> " . $e->getMessage();
}
?>
