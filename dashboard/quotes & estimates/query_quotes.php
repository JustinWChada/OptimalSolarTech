<?php

require_once '../config/miscellanea_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' ) {
    $quote_id = isset($_POST['quoteId']) ? (int)$_POST['quoteId'] : 0; //intval($_POST['quoteId']);
    // isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['quote_id'])

    // Prepare and execute the delete statement
    $stmt = $OstMiscellaneaConn->prepare("DELETE FROM quotes WHERE id = ?");
    $stmt->bind_param("i", $quote_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Quote deleted successfully.'.$quote_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete quote.']);
    }

    $stmt->close();
    $OstMiscellaneaConn->close();
    exit;
}
?>