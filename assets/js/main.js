document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu
    const menuToggle = document.getElementById('menuToggle');
    const mobileNav = document.getElementById('mobileNav');
    
    if (menuToggle && mobileNav) {
        menuToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('active');
        });
        
        // Close menu when clicking links
        mobileNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileNav.classList.remove('active');
            });
        });
    }

    // Form Handling
    const leadForm = document.getElementById('leadForm');
    const btnSubmit = document.getElementById('btnSubmit');

    if (leadForm) {
        leadForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(leadForm);
            const data = Object.fromEntries(formData.entries());
            
            btnSubmit.disabled = true;
            btnSubmit.textContent = 'Enviando...';

            try {
                const response = await fetch('api/save_lead.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.status === 'success') {
                    alert('Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.');
                    leadForm.reset();
                } else {
                    alert('Ocorreu um erro ao enviar sua mensagem: ' + (result.message || 'Erro desconhecido'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Erro de conexão com o servidor. Tente novamente mais tarde.');
            } finally {
                btnSubmit.disabled = false;
                btnSubmit.textContent = 'Enviar Mensagem';
            }
        });
    }
});
