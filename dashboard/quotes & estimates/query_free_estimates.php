<?php

require_once '../config/miscellanea_db.php';

// Fetch data from the quotes table

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' ) {
    $free_estimate_id = isset($_POST['freeEstimateId']) ? (int)$_POST['freeEstimateId'] : 0; 
    
    // Prepare and execute the delete statement
    $stmt = $OstMiscellaneaConn->prepare("DELETE FROM free_estimate WHERE id = ?");
    $stmt->bind_param("i", $free_estimate_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Free Estimate deleted successfully.'.$free_estimate_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete free estimate.']);
    }

    $stmt->close();
    $OstMiscellaneaConn->close();
    exit;
}