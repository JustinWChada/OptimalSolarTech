<!-- <?php
// session_start();
// header('Content-Type: application/json');

// Check if user is authenticated
// if (!isset($_SESSION['user_id'])) {
//     http_response_code(401);
//     echo json_encode(['error' => 'Unauthorized']);
//     exit;
// }

// // Get POST data
// $data = json_decode(file_get_contents('php://input'), true);

// // Validate required fields
// if (!isset($data['name']) || !isset($data['description'])) {
//     http_response_code(400);
//     echo json_encode(['error' => 'Missing required fields']);
//     exit;
// }

// try {
//     // Database connection
//     $pdo = new PDO('mysql:host=localhost;dbname=optimal_solar', 'root', '');
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//     // Insert service
//     $stmt = $pdo->prepare('INSERT INTO services (name, description, created_at) VALUES (?, ?, NOW())');
//     $stmt->execute([$data['name'], $data['description']]);
    
//     echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
// } catch (Exception $e) {
//     http_response_code(500);
//     echo json_encode(['error' => $e->getMessage()]);
// }
?> -->

he is tex 