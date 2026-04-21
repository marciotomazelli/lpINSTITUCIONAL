-- Comandos para adicionar colunas necessárias do upgrade

ALTER TABLE leads ADD COLUMN phone VARCHAR(20) DEFAULT '' AFTER email;
ALTER TABLE leads ADD COLUMN status VARCHAR(50) DEFAULT 'Novo' AFTER message;
