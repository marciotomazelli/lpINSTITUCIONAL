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

    // Modal Close Logic (Delegation)
    document.addEventListener('click', (e) => {
        if (e.target.closest('.close-modal') || e.target.classList.contains('modal')) {
            const openModals = document.querySelectorAll('.modal.active');
            openModals.forEach(modal => {
                modal.classList.remove('active');
                // If it was the value modal, we might want to reload to reset the select
                if (modal.id === 'value-modal') location.reload();
            });
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
    });

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

    // Lead Actions Delegation
    document.addEventListener('click', async (e) => {
        // Deletion
        const deleteBtn = e.target.closest('.btn-delete');
        if (deleteBtn) {
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
                    document.getElementById(`lead-${id}`).remove();
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
            const data = editBtn.dataset;
            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-name').value = data.name;
            document.getElementById('edit-email').value = data.email;
            document.getElementById('edit-phone').value = data.phone;
            document.getElementById('edit-specialty').value = data.specialty;
            document.getElementById('edit-message').value = data.message;
            document.getElementById('edit-modal').classList.add('active');
            return;
        }

        // Share
        const shareBtn = e.target.closest('.btn-share');
        if (shareBtn) {
            const data = shareBtn.dataset;
            const text = `*Novo Lead para Atendimento*\n\n` +
                         `*Nome:* ${data.name}\n` +
                         `*Telefone:* ${data.phone}\n` +
                         `*Especialidade:* ${data.specialty}\n\n` +
                         `Pode atender este cliente?`;
            
            const encodedText = encodeURIComponent(text);
            window.open(`https://wa.me/?text=${encodedText}`, '_blank');
            return;
        }
    });
});
