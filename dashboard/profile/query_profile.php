<?php

require_once '../config/users_db.php';

// -----------------------------------------------------------------------------
// Main Handler
// -----------------------------------------------------------------------------
header('Content-Type: application/json');

if (!isset($_POST['action'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No action specified.']);
    exit;
}

$action = $_POST['action'];

switch ($action) {
    case 'load_profile':
        loadProfile(1); 
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}

// -----------------------------------------------------------------------------
// Functions
// -----------------------------------------------------------------------------

/**
 * Loads a specific profile by ID.
 * @param int $id The profile ID to fetch.
 */
function loadProfile($id) {
    require '../config/users_db.php';

    try {
        $sql = "SELECT user_id, username, email, password_hash, first_name, last_name, user_phone, created_at, updated_at, last_login, is_active, is_verified FROM users WHERE user_id = ?";
        $stmt = $OstUsersConn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $profile = $stmt->get_result() ?? null;

        $p_profile = $profile->fetch_assoc();
        $profile = $p_profile ? [
            'user_id' => $p_profile['user_id'],
            'username' => $p_profile['username'],
            'email' => $p_profile['email'],
            'password_hash' => $p_profile['password_hash'],
            'first_name' => $p_profile['first_name'],
            'last_name' => $p_profile['last_name'],
            'user_phone' => $p_profile['user_phone'],
            'created_at' => $p_profile['created_at'],
            'updated_at' => $p_profile['updated_at'],
            'last_login' => $p_profile['last_login'],
            'is_active' => $p_profile['is_active'],
            'is_verified' => $p_profile['is_verified']
        ] : null;

        if ($profile) {
            echo json_encode(['success' => true, 'profile' => $profile]);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => "Profile with ID $id not found."]);
        }

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Error loading profile: " . $e->getMessage()]);
    }
}
?>