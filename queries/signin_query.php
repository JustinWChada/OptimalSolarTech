<?php

require_once '../config/users_db.php';

// Sanitize and validate input
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required']);
    exit;
}

try {
    // Query to find user by username
    $query = "SELECT user_id, username, email, password_hash, first_name, last_name, is_active, is_verified 
              FROM users 
              WHERE (username = ? OR email = ?) AND is_active = TRUE";
    
    $stmt = $OstUsersConn->prepare($query);
    $stmt->bind_param("ss", $username,$username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        exit;
    }
    
    $user = $result->fetch_assoc();
    
    // Verify password
    if (!password_verify($password, $user['password_hash'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
        exit;
    }
    
    // Update last login
    $updateQuery = "UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE user_id = ?";
    $updateStmt = $OstUsersConn->prepare($updateQuery);
    $updateStmt->bind_param("i", $user['user_id']);
    $updateStmt->execute();
    
    // Return success with user data
    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'user' => [
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'is_verified' => $user['is_verified']
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>