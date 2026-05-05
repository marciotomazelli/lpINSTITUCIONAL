<?php
require_once 'config.php';

try {
    // 1. Create lead_statuses table
    $pdo->exec("CREATE TABLE IF NOT EXISTS lead_statuses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL UNIQUE,
        color VARCHAR(20) DEFAULT '#3b82f6',
        is_default TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // 2. Insert initial statuses if table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM lead_statuses");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO lead_statuses (name, color, is_default) VALUES 
            ('Novo', '#3b82f6', 1),
            ('Em Contato', '#f59e0b', 0),
            ('Ganho', '#10b981', 0),
            ('Perdido', '#ef4444', 0)");
    }

    // 3. Update leads table: add classification and change status to VARCHAR
    // Check if column exists first to avoid errors on re-run
    $columns = $pdo->query("SHOW COLUMNS FROM leads")->fetchAll(PDO::FETCH_COLUMN);
    
    if (!in_array('classification', $columns)) {
        $pdo->exec("ALTER TABLE leads ADD COLUMN classification VARCHAR(50) DEFAULT 'Não Cliente' AFTER status");
    }

    // Change status column type from ENUM to VARCHAR
    $pdo->exec("ALTER TABLE leads MODIFY COLUMN status VARCHAR(50) DEFAULT 'Novo'");

    echo "Migration completed successfully!";
} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage());
}
