document.addEventListener('DOMContentLoaded', () => {
    // Global Select Change Delegation
    document.addEventListener('change', async (e) => {
        const select = e.target.closest('.status-select');
        if (!select) return;

        const id = select.dataset.id;
        const newStatus = select.value;
        const valueModal = document.getElementById('value-modal');

        if (newStatus === 'Ganho' || newStatus === 'Perdido') {
            document.getElementById('value-id').value = id;
            document.getElementById('value-status').value = newStatus;
            document.getElementById('value-modal-title').innerText = newStatus === 'Ganho' ? 'Venda Ganha' : 'Venda Perdida';
            document.getElementById('value-label').innerText = newStatus === 'Ganho' ? 'Digite o valor da venda (R$):' : 'Digite o valor perdido (R$):';
            document.getElementById('sale-value-input').value = '0.00';
            valueModal.classList.add('active');
            
            // Focus after a short delay for mobile compatibility
            setTimeout(() => document.getElementById('sale-value-input').focus(), 300);
            return;
        }

        updateStatus(id, newStatus, 0);
    });

    // Global Click Event Delegation
    document.addEventListener('click', async (e) => {
        // Modal Close Logic
        if (e.target.closest('.close-modal') || e.target.classList.contains('modal')) {
            const openModals = document.querySelectorAll('.modal.active');
            openModals.forEach(modal => {
                modal.classList.remove('active');
                if (modal.id === 'value-modal') location.reload();
            });
            return;
        }

        // Deletion
        const deleteBtn = e.target.closest('.btn-delete');
        if (deleteBtn) {
            e.preventDefault();
            if (!confirm('Deseja realmente excluir este lead?')) return;
            const id = deleteBtn.dataset.id;
            try {
                const response = await fetch('api/delete_lead.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                });
                const result = await response.json();
                if (result.status === 'success') {
                    const row = document.getElementById(`lead-${id}`);
                    if (row) row.remove();
                    else location.reload();
                } else {
                    alert('Erro ao excluir lead');
                }
            } catch (error) {
                alert('Erro de conexão');
            }
            return;
        }

        // Edit
        const editBtn = e.target.closest('.btn-edit');
        if (editBtn) {
            e.preventDefault();
            const data = editBtn.dataset;
            document.getElementById('edit-id').value = data.id || '';
            document.getElementById('edit-name').value = data.name || '';
            document.getElementById('edit-email').value = data.email || '';
            document.getElementById('edit-phone').value = data.phone || '';
            document.getElementById('edit-classification').value = data.classification || 'Não Cliente';
            document.getElementById('edit-specialty').value = data.specialty || '';
            document.getElementById('edit-message').value = data.message || '';
            document.getElementById('edit-modal').classList.add('active');
            return;
        }

        // Manage Statuses
        if (e.target.id === 'manage-statuses-btn') {
            document.getElementById('status-modal').classList.add('active');
            fetchStatuses();
            return;
        }

        // Delete Status
        const deleteStatusBtn = e.target.closest('.btn-delete-status');
        if (deleteStatusBtn) {
            const id = deleteStatusBtn.dataset.id;
            if (!confirm('Deseja excluir este status?')) return;
            try {
                const response = await fetch('api/manage_statuses.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'delete', id })
                });
                const result = await response.json();
                if (result.status === 'success') {
                    fetchStatuses();
                } else {
                    alert(result.message || 'Erro ao excluir status');
                }
            } catch (error) {
                alert('Erro de conexão');
            }
        }

        // Share
        const shareBtn = e.target.closest('.btn-share');
        if (shareBtn) {
            e.preventDefault();
            const data = shareBtn.dataset;
            const text = `*Novo Lead para Atendimento*\n\n` +
                         `*Nome:* ${data.name}\n` +
                         `*Telefone:* ${data.phone}\n` +
                         `*Especialidade:* ${data.specialty}\n\n` +
                         `Pode atender este cliente?`;
            
            const encodedText = encodeURIComponent(text);
            const waUrl = `https://wa.me/?text=${encodedText}`;
            window.location.href = waUrl;
            return;
        }
    });

    // Form Submissions (Delegation)
    document.addEventListener('submit', async (e) => {
        if (e.target.id === 'value-form') {
            e.preventDefault();
            const id = document.getElementById('value-id').value;
            const status = document.getElementById('value-status').value;
            const val = document.getElementById('sale-value-input').value;
            const saleValue = parseFloat(val.replace(',', '.')) || 0;
            updateStatus(id, status, saleValue);
        }

        if (e.target.id === 'edit-form') {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch('api/update_lead.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                if (result.status === 'success') {
                    location.reload();
                } else {
                    alert('Erro ao atualizar contato');
                }
            } catch (error) {
                alert('Erro de conexão');
            }
        }

        if (e.target.id === 'add-status-form') {
            e.preventDefault();
            const name = document.getElementById('new-status-name').value;
            const color = document.getElementById('new-status-color').value;

            try {
                const response = await fetch('api/manage_statuses.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'save', name, color })
                });
                const result = await response.json();
                if (result.status === 'success') {
                    document.getElementById('add-status-form').reset();
                    fetchStatuses();
                } else {
                    alert(result.message || 'Erro ao adicionar status');
                }
            } catch (error) {
                alert('Erro de conexão');
            }
        }
    });

    async function fetchStatuses() {
        const container = document.getElementById('status-list-container');
        try {
            const response = await fetch('api/manage_statuses.php?action=list');
            const result = await response.json();
            if (result.status === 'success') {
                container.innerHTML = `
                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 0.5rem; font-weight: 700; font-size: 0.7rem; color: var(--muted-foreground); text-transform: uppercase; margin-bottom: 0.5rem; padding: 0 0.5rem;">
                        <span>Nome do Status</span>
                        <span>Ação</span>
                    </div>
                    ${result.data.map(st => `
                        <div class="status-item">
                            <span class="status-pill" style="background: ${st.color}">${st.name}</span>
                            <button class="btn btn-outline btn-delete-status" data-id="${st.id}" style="color: red; padding: 0.25rem 0.5rem; height: auto; border-radius: 4px;">
                                <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                            </button>
                        </div>
                    `).join('')}
                `;
                lucide.createIcons();
            }
        } catch (error) {
            container.innerHTML = '<p class="text-center">Erro ao carregar status.</p>';
        }
    }

    async function updateStatus(id, status, saleValue) {
        try {
            const response = await fetch('api/update_status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, status, sale_value: saleValue })
            });
            const result = await response.json();
            if (result.status === 'success') {
                location.reload();
            } else {
                alert('Erro ao atualizar status');
                location.reload();
            }
        } catch (error) {
            alert('Erro de conexão');
            location.reload();
        }
    }

});
