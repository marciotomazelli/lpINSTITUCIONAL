<?php
// CRM EstéticaBio - v1.0.1 - Filters and Clean URLs
require_once 'config.php';
session_start();

$authenticated = false;

if (isset($_POST['password']) && $_POST['password'] === ADMIN_PASSWORD) {
    $_SESSION['admin_logged_in'] = true;
}

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    $authenticated = true;
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: crm');
    exit;
}

// Fetch leads if authenticated
$leads = [];
$error = null;
if ($authenticated) {
    try {
        $where = [];
        $params = [];

        if (!empty($_GET['status'])) {
            $where[] = "status = :status";
            $params[':status'] = $_GET['status'];
        }
        
        if (!empty($_GET['start_date'])) {
            $where[] = "created_at >= :start_date";
            $params[':start_date'] = $_GET['start_date'] . ' 00:00:00';
        }
        
        if (!empty($_GET['end_date'])) {
            $where[] = "created_at <= :end_date";
            $params[':end_date'] = $_GET['end_date'] . ' 23:59:59';
        }
        
        if (!empty($_GET['search'])) {
            $where[] = "(name LIKE :search OR email LIKE :search OR phone LIKE :search)";
            $params[':search'] = '%' . $_GET['search'] . '%';
        }

        $query = "SELECT * FROM leads";
        if ($where) {
            $query .= " WHERE " . implode(" AND ", $where);
        }
        $query .= " ORDER BY created_at DESC";

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $leads = $stmt->fetchAll();

        // Fetch dynamic statuses
        $stmtStatus = $pdo->query("SELECT * FROM lead_statuses ORDER BY id ASC");
        $all_statuses = $stmtStatus->fetchAll();
    } catch (PDOException $e) {
        $error = "Erro ao carregar leads: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM EstéticaBio — Painel de Leads</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { background-color: var(--muted); }
        .login-card {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 2.5rem;
            border-radius: var(--radius);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .crm-container { max-width: 1200px; margin: 20px auto; padding: 0 15px; }
        
        .admin-header { padding: 1rem 0; background: white; border-bottom: 1px solid var(--border); }
        .admin-header .container { flex-direction: column; gap: 1rem; align-items: flex-start; }
        @media (min-width: 768px) {
            .admin-header .container { flex-direction: row; align-items: center; }
            .crm-container { margin: 40px auto; padding: 0 20px; }
        }

        .leads-table-container { 
            background: transparent; 
            border: none; 
            border-radius: 0; 
            overflow: visible; 
        }

        @media (min-width: 768px) {
            .leads-table-container { 
                background: white; 
                border: 1px solid var(--border); 
                border-radius: var(--radius); 
                overflow: hidden; 
            }
        }
        
        .btn-action {
            width: 2.25rem;
            height: 2.25rem;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-action i, .btn-action svg {
            width: 14px;
            height: 14px;
            pointer-events: none;
        }

        /* Mobile Table to Card Transformation */
        @media (max-width: 767px) {
            table, thead, tbody, th, td, tr { display: block; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }
            tr { 
                background: white; 
                margin-bottom: 2rem; 
                border-radius: var(--radius); 
                box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                border: 1px solid var(--border);
                position: relative;
                padding: 1rem;
                overflow: hidden;
            }
            td { 
                border: none; 
                border-bottom: 1px solid #f8f8f8; 
                position: relative; 
                padding: 1rem 0 1rem 40%; 
                text-align: right;
                min-height: 3.5rem;
                display: block;
                width: 100%;
            }
            td:last-child { border-bottom: 0; }
            td:before { 
                position: absolute; 
                top: 50%;
                transform: translateY(-50%);
                left: 0; 
                width: 35%; 
                padding-right: 10px; 
                white-space: wrap; 
                text-align: left; 
                font-weight: 700;
                font-size: 0.7rem;
                color: var(--muted-foreground);
                text-transform: uppercase;
                letter-spacing: 0.05em;
                pointer-events: none; /* Prevents label from blocking clicks on inputs/buttons */
            }
            td:nth-of-type(1):before { content: "Data"; }
            td:nth-of-type(2):before { content: "Cliente"; }
            td:nth-of-type(3):before { content: "Especialidade"; }
            td:nth-of-type(4):before { content: "Mensagem"; }
            td:nth-of-type(5):before { content: "Status"; }
            td:nth-of-type(6):before { content: "Valor"; }
            td:nth-of-type(7):before { content: "Ações"; }
            
            /* Specific cell styles for better stacking */
            td strong { display: block; font-size: 1rem; margin-bottom: 0.25rem; }
            td span { display: block; line-height: 1.2; }
            td a { display: inline-block; word-break: break-all; margin-top: 0.25rem; }
            
            .status-select { width: 100% !important; margin-top: 0.5rem; }
            
            td:last-of-type {
                display: flex;
                justify-content: space-around;
                gap: 1rem;
                padding: 1.25rem !important;
                align-items: center;
                background: #fafafa;
                border-top: 1px solid var(--border);
                margin: 1rem -1rem -1rem -1rem;
                width: calc(100% + 2rem);
                border-radius: 0 0 var(--radius) var(--radius);
                position: relative;
                z-index: 5;
            }
            td:last-of-type:before {
                display: none !important;
            }
            
            .btn-action {
                width: 3rem !important;
                height: 3rem !important;
                border-radius: 50% !important;
                -webkit-tap-highlight-color: transparent;
                touch-action: manipulation;
            }
            .btn-action:active {
                transform: scale(0.92);
                opacity: 0.8;
            }
            .btn-action i {
                width: 1.25rem !important;
                height: 1.25rem !important;
            }
        }

        /* Filter bar */
        .filter-bar { 
            background: white; 
            padding: 1.5rem; 
            border-radius: var(--radius); 
            border: 1px solid var(--border);
            margin-bottom: 1.5rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
        }
        .filter-group { flex: 1; min-width: 150px; }
        .filter-group label { display: block; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--muted-foreground); text-transform: uppercase; }
        .filter-group .input, .filter-group .select { height: 2.5rem; font-size: 0.875rem; }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            padding: 1rem;
            justify-content: center;
            align-items: center;
        }
        .modal.active { display: flex; }
        .modal-content {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radius);
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-height: 90vh;
            overflow-y: auto;
        }
        @media (min-width: 768px) {
            .modal-content { padding: 2rem; }
        }
        .modal-header { margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; }
        .modal-header h3 { font-size: 1.25rem; font-weight: 700; }
        .close-modal { cursor: pointer; color: var(--muted-foreground); transition: color 0.2s; }
        .close-modal:hover { color: var(--foreground); }

        /* Status Pills in Management */
        .status-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            background: #f9fafb;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .status-pill {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
        }
    </style>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

<?php if (!$authenticated): ?>
    <div class="login-card">
        <h2 class="text-center" style="margin-bottom: 1.5rem;">CRM EstéticaBio</h2>
        <p class="text-center" style="color: var(--muted-foreground); margin-bottom: 2rem; font-size: 0.9rem;">Insira a senha de acesso</p>
        <form method="POST">
            <input type="password" name="password" class="input" placeholder="Senha" required autofocus style="margin-bottom: 1rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Entrar</button>
        </form>
        <?php if (isset($_POST['password'])): ?>
            <p style="color: red; font-size: 0.8rem; margin-top: 1rem; text-align: center;">Senha incorreta.</p>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="admin-header">
        <div class="container flex justify-between items-center">
            <div>
                <h1 style="font-size: 1.5rem; font-weight: 700;">Painel de Leads</h1>
                <p style="font-size: 0.875rem; color: var(--muted-foreground);">Gestão de contatos recebidos</p>
            </div>
            <div class="flex gap-2">
                <button id="manage-statuses-btn" class="btn btn-primary" style="display: flex; align-items: center; gap: 0.5rem;">
                    <i data-lucide="settings-2" style="width: 16px; height: 16px;"></i>
                    Gerenciar Status
                </button>
                <a href="./" class="btn btn-outline">Ver Site</a>
                <a href="?logout=1" class="btn btn-outline" style="color: red;">Sair</a>
            </div>
        </div>
    </div>

    <div class="crm-container">
        <!-- Filters -->
        <form method="GET" class="filter-bar">
            <div class="filter-group" style="flex: 2; min-width: 200px;">
                <label>Pesquisar</label>
                <input type="text" name="search" class="input" placeholder="Nome, email ou telefone..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
            </div>
            
            <div class="filter-group">
                <label>Status</label>
                <select name="status" class="select">
                    <option value="">Todos os Status</option>
                    <?php if (empty($all_statuses)): ?>
                        <option disabled>Nenhum status cadastrado</option>
                    <?php else: ?>
                        <?php foreach ($all_statuses as $st): ?>
                            <option value="<?php echo htmlspecialchars($st['name']); ?>" <?php echo ($_GET['status'] ?? '') === $st['name'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($st['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label>Desde</label>
                <input type="date" name="start_date" class="input" value="<?php echo htmlspecialchars($_GET['start_date'] ?? ''); ?>">
            </div>
            
            <div class="filter-group">
                <label>Até</label>
                <input type="date" name="end_date" class="input" value="<?php echo htmlspecialchars($_GET['end_date'] ?? ''); ?>">
            </div>
            
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary" style="height: 2.5rem; padding: 0 1.5rem;">Filtrar</button>
                <a href="crm" class="btn btn-outline" style="height: 2.5rem; display: flex; items-center: center;">Limpar</a>
            </div>
        </form>

        <?php if ($error): ?>
            <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: var(--radius); margin-bottom: 2rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="leads-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Classificação</th>
                        <th>Especialidade</th>
                        <th>Mensagem</th>
                        <th>Status</th>
                        <th>Valor (R$)</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($leads)): ?>
                        <tr><td colspan="7" class="text-center" style="padding: 3rem;">Nenhum lead encontrado.</td></tr>
                    <?php else: ?>
                        <?php foreach ($leads as $lead): ?>
                            <tr id="lead-<?php echo $lead['id']; ?>">
                                <td style="white-space: nowrap; font-size: 0.75rem;"><?php echo date('d/m/Y H:i', strtotime($lead['created_at'])); ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($lead['name']); ?></strong><br>
                                    <span style="font-size: 0.75rem; opacity: 0.7;"><?php echo htmlspecialchars($lead['email']); ?></span><br>
                                    <a href="https://wa.me/<?php echo preg_replace('/\D/', '', $lead['phone']); ?>" target="_blank" style="font-size: 0.75rem; font-weight: 600; color: var(--primary); text-decoration: underline;">
                                        <?php echo htmlspecialchars($lead['phone']); ?>
                                    </a>
                                </td>
                                <td style="font-size: 0.8rem;">
                                    <span class="status-pill" style="background: #f1f5f9; color: #475569; padding: 0.2rem 0.5rem; border-radius: 4px; border: 1px solid #e2e8f0;">
                                        <?php echo htmlspecialchars($lead['classification']); ?>
                                    </span>
                                </td>
                                <td style="font-size: 0.8rem;"><?php echo htmlspecialchars($lead['specialty']); ?></td>
                                <td style="max-width: 250px; font-size: 0.8rem; opacity: 0.8;"><?php echo nl2br(htmlspecialchars($lead['message'])); ?></td>
                                <td>
                                    <select class="select status-select" data-id="<?php echo $lead['id']; ?>" style="padding: 0.4rem; font-size: 0.75rem; height: auto; min-width: 120px;">
                                        <?php foreach ($all_statuses as $st): ?>
                                            <option value="<?php echo htmlspecialchars($st['name']); ?>" <?php echo $lead['status'] === $st['name'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($st['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td style="font-weight: 700; color: var(--primary);">
                                    <?php echo $lead['sale_value'] > 0 ? 'R$ ' . number_format($lead['sale_value'], 2, ',', '.') : '-'; ?>
                                </td>
                                <td>
                                    <div class="flex gap-4">
                                        <button type="button" class="btn btn-outline btn-edit btn-action" 
                                                data-id="<?php echo $lead['id']; ?>" 
                                                data-name="<?php echo htmlspecialchars($lead['name']); ?>"
                                                data-email="<?php echo htmlspecialchars($lead['email']); ?>"
                                                data-phone="<?php echo htmlspecialchars($lead['phone']); ?>"
                                                data-classification="<?php echo htmlspecialchars($lead['classification']); ?>"
                                                data-specialty="<?php echo htmlspecialchars($lead['specialty']); ?>"
                                                data-message="<?php echo htmlspecialchars($lead['message']); ?>"
                                                title="Editar">
                                            <i data-lucide="pencil"></i>
                                        </button>
                                        
                                        <button type="button" class="btn btn-whatsapp btn-share btn-action" 
                                                data-name="<?php echo htmlspecialchars($lead['name']); ?>"
                                                data-phone="<?php echo htmlspecialchars($lead['phone']); ?>"
                                                data-specialty="<?php echo htmlspecialchars($lead['specialty']); ?>"
                                                title="Enviar para Vendedor">
                                            <i data-lucide="share-2"></i>
                                        </button>
 
                                        <button type="button" class="btn btn-outline btn-delete btn-action" data-id="<?php echo $lead['id']; ?>" style="color: red;" title="Excluir">
                                            <i data-lucide="trash-2"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Edit Modal -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Editar Contato</h3>
                <i data-lucide="x" class="close-modal" id="close-modal"></i>
            </div>
            <form id="edit-form" class="flex flex-col gap-4">
                <input type="hidden" name="id" id="edit-id">
                <div class="grid gap-1">
                    <label style="font-size: 0.75rem; font-weight: 700;">Nome</label>
                    <input type="text" name="name" id="edit-name" class="input" required>
                </div>
                <div class="grid gap-1">
                    <label style="font-size: 0.75rem; font-weight: 700;">Email</label>
                    <input type="email" name="email" id="edit-email" class="input">
                </div>
                <div class="grid gap-1">
                    <label style="font-size: 0.75rem; font-weight: 700;">Telefone</label>
                    <input type="text" name="phone" id="edit-phone" class="input">
                </div>
                <div class="grid gap-1">
                    <label style="font-size: 0.75rem; font-weight: 700;">Classificação</label>
                    <select name="classification" id="edit-classification" class="select" required>
                        <option value="Não Cliente">Não Cliente</option>
                        <option value="Cliente">Já é Cliente</option>
                        <option value="Suporte">Suporte</option>
                        <option value="Parceiro">Parceiro</option>
                    </select>
                </div>
                <div class="grid gap-1">
                    <label style="font-size: 0.75rem; font-weight: 700;">Especialidade</label>
                    <select name="specialty" id="edit-specialty" class="select" required>
                        <option value="Biomédico">Biomédico</option>
                        <option value="Dentista">Dentista</option>
                        <option value="Farmacêutico">Farmacêutico</option>
                        <option value="Enfermeiro">Enfermeiro</option>
                        <option value="Fisioterapeuta">Fisioterapeuta</option>
                        <option value="Biólogo">Biólogo</option>
                        <option value="Esteticista">Esteticista</option>
                        <option value="Médico">Médico</option>
                        <option value="Outras">Outras</option>
                    </select>
                </div>
                <div class="grid gap-1">
                    <label style="font-size: 0.75rem; font-weight: 700;">Mensagem</label>
                    <textarea name="message" id="edit-message" class="textarea"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <!-- Sale Value Modal -->
    <div id="value-modal" class="modal">
        <div class="modal-content" style="max-width: 400px;">
            <div class="modal-header">
                <h3 id="value-modal-title">Valor da Venda</h3>
                <i data-lucide="x" class="close-modal" id="close-value-modal"></i>
            </div>
            <form id="value-form" class="flex flex-col gap-4">
                <input type="hidden" id="value-id">
                <input type="hidden" id="value-status">
                <div class="grid gap-1">
                    <label id="value-label" style="font-size: 0.75rem; font-weight: 700;">Digite o valor (R$):</label>
                    <input type="number" step="0.01" id="sale-value-input" class="input" placeholder="0,00" required autofocus>
                </div>
                <button type="submit" class="btn btn-primary">Confirmar e Salvar</button>
            </form>
        </div>
    <!-- Manage Statuses Modal -->
    <div id="status-modal" class="modal">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h3>Gerenciar Status do Atendimento</h3>
                <i data-lucide="x" class="close-modal" id="close-status-modal"></i>
            </div>
            
            <form id="add-status-form" class="flex gap-2" style="margin-bottom: 1.5rem; background: #f8fafc; padding: 1rem; border-radius: var(--radius); border: 1px solid var(--border);">
                <div style="flex: 2;">
                    <label style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Novo Status</label>
                    <input type="text" id="new-status-name" class="input" placeholder="Ex: Aguardando Documentos" required>
                </div>
                <div style="flex: 1;">
                    <label style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Cor</label>
                    <input type="color" id="new-status-color" class="input" value="#3b82f6" style="padding: 2px; height: 2.5rem;">
                </div>
                <button type="submit" class="btn btn-primary" style="align-self: flex-end; height: 2.5rem;">Adicionar</button>
            </form>

            <div id="status-list-container">
                <p class="text-center" style="padding: 1rem; color: var(--muted-foreground);">Carregando status...</p>
            </div>
            
            <p style="font-size: 0.7rem; color: var(--muted-foreground); margin-top: 1rem;">
                * Status em uso por leads não podem ser excluídos.
            </p>
        </div>
    </div>
    
    <script>
        lucide.createIcons();
    </script>
    <script src="assets/js/crm.js"></script>
<?php endif; ?>

</body>
</html>
