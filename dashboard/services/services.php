<?php

require_once '../config/miscellanea_db.php';

?>

    <style>
        .services-container {
            padding: 20px;
        }
        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }
        .tab-btn {
            background: none;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s;
        }
        .tab-btn.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
            margin-bottom: -13px;
        }
        .content-area {
            min-height: 400px;
        }
        .service-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>

    <!-- New Service Modal -->
    <div class="modal fade" id="newServiceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            
        </div>
    </div>

   
    <script>
        let currentTab = 'new-service';
        const modal = new bootstrap.Modal(document.getElementById('newServiceModal'));

        function switchTab(tab) {
            currentTab = tab;
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`[data-tab="${tab}"]`).classList.add('active');

            if (tab === 'available-services') {
                loadServices();
            } else if (tab === 'new-service') {
                modal.show();
            }
        }

        function loadServices() {
            fetch('ajax/loadServices.php')
                .then(response => response.json())
                .then(data => displayServices(data))
                .catch(error => console.error('Error:', error));
        }

        function displayServices(services) {
            let html = '<div class="row g-4">';
            services.forEach(service => {
                html += `
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <img src="${service.image_path || 'placeholder.png'}" class="card-img-top" alt="${service.service_title}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">${service.service_title}</h5>
                                <p class="card-text text-muted">${service.service_description}</p>
                            </div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
            document.getElementById('content').innerHTML = html;
        }

        function saveService() {
            const form = document.getElementById('serviceForm');
            const formData = new FormData(form);

            fetch('ajax/saveService.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Service saved successfully!');
                    form.reset();
                    modal.hide();
                    switchTab('available-services');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Load services on page load
        window.addEventListener('DOMContentLoaded', loadServices);
    </script>
