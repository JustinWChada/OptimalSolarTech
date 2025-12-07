<?php
// /c:/xampp/htdocs/OptimalSolarTech/pages/index_free_quote.php

// Simple AJAX handler for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_quote') {
    header('Content-Type: application/json; charset=utf-8');

    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $service = trim(filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING));
    $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));

    $errors = [];

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($phone === '') {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^[0-9+\-\s()]{6,20}$/', $phone)) {
        $errors[] = 'Phone number appears invalid.';
    }
    $allowed_services = ['solar_installation', 'maintenance', 'battery_storage', 'consultation'];
    if ($service === '' || !in_array($service, $allowed_services, true)) {
        $errors[] = 'Please select a valid service.';
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    // Example: here you would save to DB or send an email.
    // For demo, we just return success.
    echo json_encode([
        'success' => true,
        'message' => 'Your request has been received. We will contact you shortly.'
    ]);
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Free Quote - Optimal Solar Tech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (v5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom modal form tweaks */
        .modal-header {
            background: linear-gradient(90deg,#0d6efd,#0b5ed7);
            color: #fff;
        }
        .required::after {
            content: " *";
            color: #dc3545;
        }
        .form-note {
            font-size: .9rem;
            color: #6c757d;
        }
        .ajax-alert {
            display: none;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-center">
        <button id="openQuoteBtn" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#quoteModal">
            Request a Free Quote
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quoteModalLabel">Free Quote Request</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="quoteForm" novalidate>
        <div class="modal-body">
            <div id="ajaxAlert" class="alert ajax-alert" role="alert"></div>

            <div class="mb-3">
                <label for="name" class="form-label required">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label required">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="+1 (555) 555-5555" required>
                <div class="form-text form-note">Include country code if outside your country.</div>
            </div>

            <div class="mb-3">
                <label for="service" class="form-label required">Service</label>
                <select class="form-select" id="service" name="service" required>
                    <option value="">Choose a service...</option>
                    <option value="air-conditioning">
                    Air Conditioning Installation
                  </option>
                  <option value="ac-repair">Aircon Troubleshooting</option>
                  <option value="vehicle-ac">Vehicle Air Conditioning</option>
                  <option value="ac-servicing">Aircon Servicing</option>
                  <option value="solar">Solar Installation</option>
                  <option value="plumbing">Borehole Plumbing</option>
                  <option value="electrical">House Wiring</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description / Notes</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Project details, address, preferred timeline..."></textarea>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="submitBtn" class="btn btn-primary">Submit Request</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery (for AJAX) and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(function(){
    var $form = $('#quoteForm');
    var $submit = $('#submitBtn');
    var $alert = $('#ajaxAlert');

    $form.on('submit', function(e){
        e.preventDefault();
        $alert.hide().removeClass('alert-success alert-danger').text('');
        $submit.prop('disabled', true).text('Sending...');

        // Collect form data
        var data = {
            action: 'submit_quote',
            name: $('#name').val(),
            phone: $('#phone').val(),
            service: $('#service').val(),
            description: $('#description').val()
        };

        $.ajax({
            url: '', // same page handles POST
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(resp){
                if (resp && resp.success) {
                    $alert.addClass('alert-success').text(resp.message || 'Request sent.').show();
                    $form[0].reset();
                    setTimeout(function(){
                        var modal = bootstrap.Modal.getInstance(document.getElementById('quoteModal'));
                        if (modal) modal.hide();
                        $alert.hide();
                    }, 1500);
                } else {
                    var msg = 'Please correct the errors and try again.';
                    if (resp && resp.errors && resp.errors.length) {
                        msg = resp.errors.join(' ');
                    }
                    $alert.addClass('alert-danger').text(msg).show();
                }
            },
            error: function(xhr){
                $alert.addClass('alert-danger').text('An error occurred. Please try again later.').show();
            },
            complete: function(){
                $submit.prop('disabled', false).text('Submit Request');
            }
        });
    });

    // Reset alert when modal opens
    $('#quoteModal').on('show.bs.modal', function(){
        $alert.hide().removeClass('alert-success alert-danger').text('');
    });
});
</script>
</body>
</html>