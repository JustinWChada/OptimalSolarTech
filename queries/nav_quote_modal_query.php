<?php
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