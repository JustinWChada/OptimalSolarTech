<?php

require_once '../config/miscellanea_db.php';

header('Content-Type: application/json; charset=utf-8');

$action = $_POST['action'] ?? '';
if ($action !== 'submit_review') {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    exit;
}   

$projectId = isset($_POST['projectId']) ? (int)$_POST['projectId'] : 0;
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
$reviewText = isset($_POST['reviewText']) ? trim($_POST['reviewText']) : '';

if ($projectId === 0 || $rating === 0 || empty($reviewText)) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

try {
    $stmt = $OstMiscellaneaConn->prepare("INSERT INTO project_reviews (project_id,review_text, rating ) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $projectId, $reviewText, $rating);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['success' => true, 'message' => 'Review submitted successfully.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error submitting review: ' . $e->getMessage()]);    
    
}