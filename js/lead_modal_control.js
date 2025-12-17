document.addEventListener("DOMContentLoaded", function() {
    
    // 1. EVENT LISTENER FOR OPENING MODAL
    // This allows any button with class 'open-lead-modal' to open this modal
    // AND pre-fill the service if data-service="Solar" is present on the button.
    document.body.addEventListener('click', function(e) {
        if (e.target.matches('.open-lead-modal') || e.target.closest('.open-lead-modal')) {
            const btn = e.target.closest('.open-lead-modal');
            const service = btn.getAttribute('data-service');
            
            const modalEl = document.getElementById('leadModal');
            const select = document.getElementById('leadServiceSelect');
            
            // Pre-select service if defined
            if(service && select) {
                select.value = service;
            }

            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    });

    // 2. FORM SUBMISSION AJAX
    const form = document.getElementById('leadForm');
    const alertBox = document.getElementById('leadAjaxAlert');
    const submitBtn = document.getElementById('leadSubmitBtn');

    if(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // UI Loading State
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
            alertBox.classList.add('d-none');

            const formData = new FormData(form);
            formData.append('action', 'submit_lead'); // Unified action name

            fetch('../queries/submit_lead.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alertBox.classList.remove('d-none');
                if (data.success) {
                    alertBox.className = 'alert alert-success';
                    alertBox.innerHTML = '<i class="ri-check-circle-line"></i> ' + data.message;
                    form.reset();
                    // Close modal after 2 seconds
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('leadModal'));
                        modal.hide();
                        alertBox.classList.add('d-none');
                    }, 2500);
                } else {
                    alertBox.className = 'alert alert-danger';
                    alertBox.innerHTML = '<i class="ri-error-warning-line"></i> ' + (Array.isArray(data.errors) ? data.errors.join('<br>') : data.errors);
                }
            })
            .catch(error => {
                alertBox.className = 'alert alert-danger';
                alertBox.classList.remove('d-none');
                alertBox.innerHTML = 'Connection error. Please try again.';
                console.error('Error:', error);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="ri-send-plane-fill me-2"></i> Send Request';
            });
        });
    }
});