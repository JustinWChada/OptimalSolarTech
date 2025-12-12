<?php
require '../config/miscellanea_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_emergency') {
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $active = "active";

    $errors = [];
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^[0-9+\-\s()]{6,20}$/', $phone)) {
        $errors[] = 'Phone number appears invalid.';
    }
    if (empty($description)) {
        $errors[] = 'Description is required.';
    }

    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    $sql = "INSERT INTO emergencies (name, phone, description, status) VALUES (?, ?, ?, ?)";
    $stmt = $OstMiscellaneaConn->prepare($sql);
    $stmt->bind_param('ssss', $name, $phone, $description,$active);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Your request has been received. We will contact you shortly.']);
    } else {
        echo json_encode(['success' => false, 'errors' => 'Error submitting request.']);
    }

    $stmt->close();

    exit;
}