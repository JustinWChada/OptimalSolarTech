<?php

require '../config/users_db.php';
require '../config/miscellanea_db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'check_verification') {
    $user_id = $_POST['user_id'];
    $one = 1;

    $query = "SELECT username FROM users WHERE user_id = ? AND is_active = ? AND is_verified = ?";
    $stmt = $OstUsersConn->prepare($query);
    $stmt->bind_param("iii", $user_id,$one,$one);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        echo json_encode(['success' => true, 'message' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => false]);
    }

    $stmt->close();
}
