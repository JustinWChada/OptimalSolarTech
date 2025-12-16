<?php

require '../config/miscellanea_db.php';

// File Upload Configuration
$upload_dir = '../../files/uploads/projects/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

header('Content-Type: application/json');

if (!isset($_POST['action'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No action specified.']);
    exit;
}

$action = $_POST['action'];

switch ($action) {
    case 'load_projects':
        loadProjects();
        break;
    case 'insert_project':
        insertProject();
        break;
    case 'delete_project':
        deleteProject();
        break;
    // case 'update_project': // Would be handled here
    //     updateProject();
    //     break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
}

function loadProjects() {
    require '../config/miscellanea_db.php';

    // Fetch all projects
    $query = "SELECT id, title, place, date, description FROM projects ORDER BY date DESC, id DESC";
    $results = $OstMiscellaneaConn->query($query);
    
    $projects = [];
    $ids = [];
    while ($row = $results->fetch_assoc()) {
        $id = $row['id'];
        $ids[] = $id;
        $projects[$id] = $row;
        $projects[$id]['images'] = [];
        $projects[$id]['team'] = [];
        $projects[$id]['reviews'] = [];
    }

    if (!empty($ids)) {
        $idList = implode(',', $ids);

        // Batch fetch images
        $imgRes = $OstMiscellaneaConn->query("SELECT * FROM project_images WHERE project_id IN ($idList)");
        while($img = $imgRes->fetch_assoc()) $projects[$img['project_id']]['images'][] = $img;

        // Batch fetch team
        $teamRes = $OstMiscellaneaConn->query("SELECT * FROM project_team_members WHERE project_id IN ($idList)");
        while($m = $teamRes->fetch_assoc()) $projects[$m['project_id']]['team'][] = $m;

        // Batch fetch reviews
        $revRes = $OstMiscellaneaConn->query("SELECT * FROM project_reviews WHERE project_id IN ($idList)");
        while($r = $revRes->fetch_assoc()) $projects[$r['project_id']]['reviews'][] = $r;
    }

    echo json_encode(['success' => true, 'projects' => array_values($projects)]);
}

/**
 * Inserts a new project, its team members, and images.
 */
function insertProject() {
    // $pdo = getDBConnection();
    // $pdo->beginTransaction();

    try {
        require '../config/miscellanea_db.php';

        // 1. Insert into projects table
        $sql = "INSERT INTO projects (title, place, date, description, service_tags) VALUES (?, ?, ?, ?, ?)";
        $stmt = $OstMiscellaneaConn->prepare($sql);
        
        $stmt->bind_param("sssss", $_POST['title'], $_POST['place'], $_POST['date'], $_POST['description'], $_POST['selected_services']);
        if (!$stmt->execute()) respond(false, [], 'DB insert failed: '.$stmt->error);
        $project_id = $stmt->insert_id;
        $stmt->close();

        // $stmt = $OstMiscellaneaConn->prepare("INSERT INTO services (service_title, service_description, status) VALUES (?, ?, ?)");
        // $stmt->bind_param("sss", $service_title, $service_description, $service_status);
        // if (!$stmt->execute()) respond(false, [], 'DB insert failed: '.$stmt->error);
        // $service_id = $stmt->insert_id;
        // $stmt->close();

        // 2. Insert into project_team_members table
        if (!empty($_POST['member_name']) && is_array($_POST['member_name'])) {
            $team_names = $_POST['member_name'];
            $team_roles = $_POST['member_role'];
            $sql = "INSERT INTO project_team_members (project_id, member_name, role) VALUES (?, ?, ?)";
            $stmt_members = $OstMiscellaneaConn->prepare($sql);
            
            foreach ($team_names as $i => $name) {
                $stmt_members->bind_param("sss", $project_id, $name, $team_roles[$i]);
                if (!$stmt_members->execute()) respond(false, [], 'DB insert failed (IN project_team_members): '.$stmt_members->error);

            }
            $stmt_members->close();
        }

        // 3. Handle file uploads and insert into project_images table
        if (!empty($_FILES['project_image']['name'][0])) {
            $image_alts = $_POST['image_alt'] ?? [];
            $sql = "INSERT INTO project_images (project_id, image_path, alt_text, display_order) VALUES (?, ?, ?, ?)";
            $stmt_images = $OstMiscellaneaConn->prepare($sql);
            
            $upload_dir = '../../files/uploads/projects/';
            
            foreach ($_FILES['project_image']['name'] as $i => $filename) {
                // Basic validation
                if ($_FILES['project_image']['error'][$i] !== UPLOAD_ERR_OK) {
                    throw new Exception("File upload error on image " . ($i + 1));
                }
                
                $temp_name = $_FILES['project_image']['tmp_name'][$i];
                $new_filename = uniqid('img_') . '_' . basename($filename);
                $target_path = $upload_dir . $new_filename;

                if (move_uploaded_file($temp_name, $target_path)) {
                    $image_path = $target_path;
                    $alt_text = isset($image_alts[$i]) ? $image_alts[$i] : null;
                    $display_order = $i + 1;
                    $stmt_images->bind_param("sssi", $project_id, $new_filename, $alt_text, $display_order);
                    if (!$stmt_images->execute()) respond(false, [], 'DB insert failed (IN project_images): '.$stmt_images->error);

                } else {
                    throw new Exception("Failed to move uploaded file for image " . ($i + 1));
                }
            }
            $stmt_images->close();
        }

        echo json_encode(['success' => true, 'message' => 'Project created successfully.', 'id' => $project_id]);

    } catch (Exception $e) {
        
        // Clean up any partially moved files if an error occurred during image processing
        echo json_encode(['success' => false, 'message' => "Insert failed: " . $e->getMessage()]);
    }
}

// /**
//  * Deletes a project and all related data (cascade delete handled by foreign keys).
//  */
function deleteProject() {

    require '../config/miscellanea_db.php';

    $project_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$project_id) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid project ID.']);
        return;
    }

    try {
        // Find and delete the image files from the server first
        $stmt_images = $OstMiscellaneaConn->prepare("SELECT image_path FROM project_images WHERE project_id = ?");
        $stmt_images->bind_param("i", $project_id);
        $stmt_images->execute();
        $images = $stmt_images->get_result();
        $image_paths = [];
        while ($img = $images->fetch_assoc()) {
            $image_paths[] = $img['image_path'];
        }

        // Delete the project (and related records via ON DELETE CASCADE)
        $stmt_delete = $OstMiscellaneaConn->prepare("DELETE FROM projects WHERE id = ?");
        $stmt_delete->execute([$project_id]);

        if ($stmt_delete->rowCount() > 0) {
            // Delete project team members
            $stmt_delete_team_members = $OstMiscellaneaConn->prepare("DELETE FROM project_team_members WHERE project_id = ?");
            $stmt_delete_team_members->execute([$project_id]);

             // Delete project reviews
            $stmt_delete_reviews = $OstMiscellaneaConn->prepare("DELETE FROM project_reviews WHERE project_id = ?");
            $stmt_delete_reviews->execute([$project_id]);

            // // Delete actual files after successful DB deletion
            foreach ($image_paths as $path) {
                $true_path = __DIR__ . "/../../files/uploads/projects/" . $path;
                if (file_exists($true_path)) {
                    unlink($true_path);
                }
            }
            echo json_encode(['success' => true, 'message' => 'Project and all related data deleted.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Project not found or already deleted.']);
        }

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => "Error deleting project: " . $e->getMessage()]);
    }
}

