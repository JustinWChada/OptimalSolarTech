<?php

require_once '../config/miscellanea_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_quote') {
    
    try {
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
        $service = trim(filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING));
        $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));

        $errors = [];
        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        if (empty($phone)) {
            $errors[] = 'Phone number is required.';
        }
        if (empty($service)) {
            $errors[] = 'Service is required.';
        }
        if (empty($description)) {
            $errors[] = 'Description is required.';
        }

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            exit;
        }

        $sql = "INSERT INTO quotes (name, phone, service, description) VALUES (?, ?, ?, ?)";
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