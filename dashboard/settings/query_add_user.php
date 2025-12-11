<?php

require "../config/users_db.php";
require "../config/miscellanea_db.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'add_user':
            addUser();
            break;

        case 'verify_admin_password':
            verifyAdminPassword();
            break;

        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
            exit;
    }

} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No action specified or invalid request method.']);
    exit;
}

function verifyAdminPassword(){
    require "../config/miscellanea_db.php";

    $adminPass = $_POST['verify_admin_password'];

    $sql = "SELECT admin_password FROM admin_password";
    $result = $OstMiscellaneaConn->query($sql);
    $trueAdminPass = $result->fetch_assoc()['admin_password'];

    if ($adminPass === $trueAdminPass) {
        echo json_encode(['success' => true, 'message' => 'Admin password is correct.', 'status' => 200]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Admin password is incorrect.', 'status' => 400]);
    }
}

function addUser(){
    require "../config/users_db.php";
    require "../config/miscellanea_db.php";

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_hash = $_POST['password_hash'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_phone = $_POST['user_phone'];
    $is_active = $_POST['is_active'];

    $admin_password = $_POST['admin_password'];

    if (empty($admin_password)) {
        echo json_encode(['success' => false, 'message' => 'Admin password is required for user creation.', 'status' => 400]);
        exit;
    }

    $result = $OstMiscellaneaConn->query("SELECT admin_password FROM admin_password");
    $trueAdminPass = $result->fetch_assoc()['admin_password'];

    if ($admin_password !== $trueAdminPass) {
        echo json_encode(['success' => false, 'message' => 'Admin password is incorrect.', 'status' => 400]);
        exit;
    }

    $hashed_password = password_hash($password_hash, PASSWORD_BCRYPT);
    $verification_token = generateVerificationToken(8);

    $sql = "INSERT INTO users (username, email, password_hash, first_name, last_name, user_phone, is_active, verification_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $OstUsersConn->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $email, $hashed_password, $first_name, $last_name, $user_phone, $is_active, $verification_token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'User added successfully.', 'status' => 200]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add user.', 'status' => 400]);
    }
}

function generateVerificationToken($length) {
    return bin2hex(random_bytes($length / 2));
}