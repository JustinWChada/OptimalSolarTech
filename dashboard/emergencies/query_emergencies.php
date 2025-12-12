<?php

require "../config/miscellanea_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete' ) {
    $emergency_id = isset($_POST['emergencyId']) ? (int)$_POST['emergencyId'] : 0;
    
    // Prepare and execute the delete statement
    $stmt = $OstMiscellaneaConn->prepare("UPDATE emergencies SET status = 'deleted' WHERE id = ?");
    $stmt->bind_param("i", $emergency_id);
    $stmt->execute();

    if($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Emergency deleted successfully.'.$emergency_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete emergency.'.$emergency_id]);
    }

    $stmt->close();
 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'count' ) {
    $sql = "SELECT COUNT(*) AS count FROM emergencies WHERE status = 'active'";
    $result = $OstMiscellaneaConn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'count' => $row['count']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to count unattended emergencies.']);
    }
    $result->close();
}

// $sql = "SELECT e.id, e.name, e.phone, e.description, TIMESTAMPDIFF(MINUTE, e.created_at, NOW()) AS time_since_emergency
// FROM emergencies e
// ORDER BY e.created_at DESC";