<?php
// query_messages.php

require_once '../config/miscellanea_db.php';

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "delete") {
        $messageId = $_POST["messageId"];

        // Delete message from the table
        $sql = "DELETE FROM contact_form_inputs WHERE id = ?";
        $stmt = $OstMiscellaneaConn->prepare($sql);
        $stmt->bind_param("i", $messageId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting message']);
        }
    }
}
?>