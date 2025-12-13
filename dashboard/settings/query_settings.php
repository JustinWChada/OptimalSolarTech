<?php
require_once '../config/users_db.php';
require_once '../config/miscellanea_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_user_token') {
    $admin_password = $_POST['admin_password'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "SELECT admin_password FROM admin_password";
    $stmt = $OstMiscellaneaConn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $trueAdminPass = $result->fetch_assoc()['admin_password'];

    if ($admin_password !== $trueAdminPass) {
        echo json_encode(['success' => false, 'message' => 'Admin password is incorrect.', 'status' => 400]);
        exit;
    }

    $query = "SELECT password_hash, verification_token FROM users WHERE email = ?";
    $stmt = $OstUsersConn->prepare($query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if (password_verify($user_password, $user['password_hash'])) {
        echo json_encode(['success' => true, 'message' => 'User Verification Token:', 'verification_token' => $user['verification_token'], 'status' => 200]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password', 'status' => 400]);
        exit;
    }

    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password', 'status' => 400]);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'get_admin_password') {
    $user_email = $_POST['admin_pass_user_email'];
    $password = $_POST['admin_pass_user_password'];

    $query = "SELECT user_email, password FROM privileged_users WHERE user_email = ? AND password = ?";
    $stmt = $OstUsersConn->prepare($query);
    $stmt->bind_param("ss", $user_email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $query = "SELECT admin_password FROM admin_password";
        $stmt = $OstMiscellaneaConn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin_password = $result->fetch_assoc()['admin_password'];

        echo json_encode(['success' => true, 'message' => 'Admin password:', 'admin_password' => $admin_password, 'status' => 200]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password', 'status' => 400]);
        exit;
    }
}
