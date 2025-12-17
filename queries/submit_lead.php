<?php
require_once '../config/miscellanea_db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_lead') {
    
    try {
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
        $service = trim(filter_input(INPUT_POST, 'service', FILTER_SANITIZE_STRING));
        $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
        $source = trim(filter_input(INPUT_POST, 'source', FILTER_SANITIZE_STRING));

        $errors = [];
        if (empty($name)) $errors[] = 'Name is required.';
        if (empty($phone)) $errors[] = 'Phone number is required.';
        if (empty($service)) $errors[] = 'Please select a service.';

        if (!empty($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
            exit;
        }

        // We use the existing 'quotes' table but treat it as the master lead table
        // Ensure your database has a 'source' column, or remove it from the query below if not needed yet.
        $sql = "INSERT INTO quotes (name, phone, service, description, source_ref) VALUES (?, ?, ?, ?, ?)";
        
        // Note: You might need to add `ALTER TABLE quotes ADD COLUMN source_ref VARCHAR(50);` to your DB
        // If you can't alter DB right now, remove `source_ref` from SQL and bind_param
        
        $stmt = $OstMiscellaneaConn->prepare($sql);
        $stmt->bind_param('sssss', $name, $phone, $service, $description, $source);
        
        if ($stmt->execute()) {
            echo json_encode([
                'success' => true, 
                'message' => 'Thanks, ' . htmlspecialchars($name) . '! We have received your request.'
            ]);
        } else {
            throw new Exception("Database execution failed");
        }
        $stmt->close();

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'errors' => 'System error: ' . $e->getMessage()]);
    }
}
?>