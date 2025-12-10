<?php

require_once '../config/miscellanea_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_free_estimate') {
    header('Content-Type: application/json; charset=utf-8');

    try{
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
        //$allowed_services = ['solar_installation', 'maintenance', 'battery_storage', 'consultation'];
        if ($service === '') { // || !in_array($service, $allowed_services, true)
            $errors[] = 'Please select a valid service.';
        }

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            exit;
        }

        $sql = "INSERT INTO free_estimate (name, phone, service, description) VALUES (?, ?, ?, ?)";
        $stmt = $OstMiscellaneaConn->prepare($sql);
        $stmt->bind_param('ssss', $name, $phone, $service, $description);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Your request has been received. We will contact you shortly.']);
        } else {
            echo json_encode(['success' => false, 'errors' => 'Error submitting request.']);
        }

        $stmt->close();

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'errors' => 'Database connection error.'.$e->getMessage()]);
        exit;
    }
}   