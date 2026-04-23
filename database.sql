CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(50),
    specialty VARCHAR(100),
    message TEXT,
    status ENUM('Novo', 'Em Contato', 'Ganho', 'Perdido') DEFAULT 'Novo',
    sale_value DECIMAL(10,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Índice para busca rápida no CRM
CREATE INDEX idx_created_at ON leads(created_at DESC);
