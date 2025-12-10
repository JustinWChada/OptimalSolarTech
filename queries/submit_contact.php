<?php

require_once '../config/miscellanea_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_contact') {
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $service = trim(filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING));
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING));

    $errors = array();

    // Validate name
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    // Validate email
    if (empty($email)) {
        $errors[] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email address appears invalid.';
    }

    // Validate phone
    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^[0-9+\-\s()]{6,20}$/', $phone)) {
        $errors[] = 'Phone number appears invalid.';
    }

    // Validate service
    if (empty($service)) {
        $errors[] = 'Please select a valid service.';
    }

    // Return errors if any
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'errors'  => $errors
        ]);
        exit;
    }


    $stmt = $OstMiscellaneaConn->prepare("INSERT INTO contact_form_inputs (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $service, $message);
    $stmt->execute();
    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Your message has been sent. We will contact you shortly.'
    ]);
    exit;
} else {
    echo json_encode(['success' => false, 'errors' => ['Invalid request method.']]);
    exit;
}
