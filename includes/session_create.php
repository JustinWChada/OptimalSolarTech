<?php
session_start();

// Prevent direct access - only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit('Forbidden Access');
}

// // Validate referrer and origin
// $allowed_host = $_SERVER['HTTP_HOST'];
// if (!empty($_SERVER['HTTP_REFERER'])) {
//     $referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
//     if ($referer !== $allowed_host) {
//         http_response_code(403);
//         exit('Forbidden HTTP Host');
//     }
// }

// Implement CSRF token validation: better way to prevent CSRF attacks
// if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
//     http_response_code(403);
//     exit('Forbidden CSRF Token');
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id']; //intval($_POST['user_id']);
    
    // Create session variables
    $_SESSION['user_id'] = $user_id;
    $_SESSION['session_id'] = session_id();
    
    // Redirect to dashboard with session ID in URL (optional)
    //header('Location: ../dashboard/dashboard.php?session_id=' . session_id());

    echo json_encode(
        [
            'success' => true,
            'message' => 'Session created successfully',
            'session_id' => $_SESSION['session_id']
        ]
        );

    exit();
} else {
    //header('Location: ../signin.php');
    http_response_code(400);
    echo json_encode(
        [
            'success' => false,
            'message' => 'Invalid request: Failed to Log In'
        ]
    );

    exit();
}
?>