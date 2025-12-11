<?php

require_once '../config/users_db.php';

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized access. Please log in.']);
    exit;
}


if (!isset($_POST['action'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No action specified.']);
    exit;
}

$action = $_POST['action'];

switch ($action) {
    case 'load_profile':
        loadProfile($_SESSION['user_id']); 
        break;
    
    case 'toggle_account_state':
        toggleAccountState();
        break;

    case 'toggle_account_verification':
        toggleAccountVerification();
        break;

    case 'update_profile':
        updateProfile();    
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

function toggleAccountState() {

    header('Content-Type: application/json');

    require '../config/users_db.php';
    
    if (!isset($_POST['userId'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No user ID specified.']);
        exit;
    }

    $user_id = $_SESSION['user_id']; //$_POST['userId'];

    try {
        $sql = "UPDATE users SET is_active = NOT is_active WHERE user_id = ?";
        $stmt = $OstUsersConn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Account state toggled successfully.']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => "User with ID $user_id not found."]);
        }

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Error toggling account state: " . $e->getMessage()]);
    }
}

function toggleAccountVerification() {

    header('Content-Type: application/json');

    require '../config/users_db.php';
    
    if (!isset($_POST['userId']) || !isset($_POST['token'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No user ID or token specified.']);
        exit;
    }

    $user_id = $_SESSION['user_id']; //$_POST['userId'];
    $token = $_POST['token'];


    try {
        $sql = "UPDATE users SET is_verified = NOT is_verified WHERE user_id = ? AND verification_token = ?";
        $stmt = $OstUsersConn->prepare($sql);
        $stmt->bind_param('is', $user_id,$token);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Account verification toggled successfully.']);
        } else {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => "User with ID $user_id not found."]);
        }

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Error toggling account verification: " . $e->getMessage()]);
    }
}

function updateProfile() {
    require '../config/users_db.php';

    $user_id = $_SESSION['user_id'];

    try {
       
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $user_phone = $_POST['user_phone'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if (empty($password)) {
            $sql = "UPDATE users SET username = ?, email = ?, first_name = ?, last_name = ?, user_phone = ? WHERE user_id = ?";
            $stmt = $OstUsersConn->prepare($sql);
            $stmt->bind_param("sssssi", $username, $email, $first_name, $last_name, $user_phone, $user_id);
        } else {
            $sql = "UPDATE users SET username = ?, email = ?, password_hash = ?, first_name = ?, last_name = ?, user_phone = ? WHERE user_id = ?";
            $stmt = $OstUsersConn->prepare($sql);
            $stmt->bind_param("ssssssi", $username, $email, $hashed_password, $first_name, $last_name, $user_phone, $user_id);
        }
        
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode (['success' => true, 'message' => 'Profile updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update profile.']);
        }

        $stmt->close();

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Error updating profile: " . $e->getMessage()]);
    }
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function generatePasswordResetToken($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

function generateVerificationToken($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

function sendVerificationEmail($email, $token) {
    $subject = "Account Verification";
    $message = "Please use the following token to verify your account: $token";

    mail($email, $subject, $message);
}
?>