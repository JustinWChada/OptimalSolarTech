<?php
require_once '../config/miscellanea_db.php';

header('Content-Type: application/json; charset=utf-8');

$upload_dir = __DIR__ . '/../../files/uploads/services/'; // server filesystem path
$web_path_prefix = '../../files/uploads/services/'; // for client image src

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$action = $_REQUEST['action'] ?? ($_SERVER['REQUEST_METHOD'] === 'POST' ? 'save' : null);

// helper to send JSON and exit
function respond($success, $data = [], $message = '') {
    echo json_encode(['success'=>$success, 'data'=>$data, 'message'=>$message]);
    exit;
}

// sanitize simple string
function str_post($k){ return isset($_POST[$k]) ? trim($_POST[$k]) : ''; }

try {
    if ($action === 'load') {
        $services = [];
        $res = $OstMiscellaneaConn->query("SELECT * FROM services ORDER BY date_uploaded DESC");
        while ($row = $res->fetch_assoc()) {
            $sid = (int)$row['service_id'];
            // fetch images
            $images = [];
            $imgRes = $OstMiscellaneaConn->prepare("SELECT service_img_path FROM services_images WHERE service_id = ?");
            $imgRes->bind_param("i", $sid);
            $imgRes->execute();
            $imgRes->bind_result($imgpath);
            while ($imgRes->fetch()) { $images[] = $imgpath; }
            $imgRes->close();

            $services[] = [
                'service_id' => $sid,
                'service_title' => $row['service_title'],
                'service_description' => $row['service_description'],
                'status' => $row['status'],
                'date_uploaded' => $row['date_uploaded'],
                'images' => $images
            ];
        }
        respond(true, $services);
    }

    if ($action === 'get') {
        $id = (int)($_GET['id'] ?? 0);
        if (!$id) respond(false, [], 'Invalid id');
        $stmt = $OstMiscellaneaConn->prepare("SELECT service_id, service_title, service_description, status, date_uploaded FROM services WHERE service_id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        if (!$row) respond(false, [], 'Service not found');
        // images
        $images = [];
        $imgRes = $OstMiscellaneaConn->prepare("SELECT service_img_path FROM services_images WHERE service_id = ?");
        $imgRes->bind_param("i", $id);
        $imgRes->execute();
        $imgRes->bind_result($imgpath);
        while ($imgRes->fetch()) { $images[] = $imgpath; }
        $imgRes->close();
        $row['images'] = $images;
        respond(true, $row);
    }

    if ($action === 'save') {
        // create new service
        $service_title = htmlspecialchars(str_post('service_title'));
        $service_description = htmlspecialchars(str_post('service_description'));
        $service_status = htmlspecialchars($_POST['service_status'] ?? 'active');

        if (empty($service_title) || empty($service_description)) respond(false, [], 'Title and description required');

        $stmt = $OstMiscellaneaConn->prepare("INSERT INTO services (service_title, service_description, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $service_title, $service_description, $service_status);
        if (!$stmt->execute()) respond(false, [], 'DB insert failed: '.$stmt->error);
        $service_id = $stmt->insert_id;
        $stmt->close();

        // handle uploads
        if (!empty($_FILES['service_images']['name'][0])) {
            foreach ($_FILES['service_images']['tmp_name'] as $k => $tmp_name) {
                if ($_FILES['service_images']['error'][$k] === UPLOAD_ERR_OK) {
                    $fname = uniqid() . '_' . basename($_FILES['service_images']['name'][$k]);
                    $dest = $upload_dir . $fname;
                    if (move_uploaded_file($tmp_name, $dest)) {
                        $ins = $OstMiscellaneaConn->prepare("INSERT INTO services_images (service_id, service_img_path) VALUES (?, ?)");
                        $ins->bind_param("is", $service_id, $fname);
                        $ins->execute();
                        $ins->close();
                    }
                }
            }
        }

        respond(true, ['id'=>$service_id], 'Service added');
    }

    if ($action === 'edit') {
        $service_id = (int)str_post('service_id');
        if (!$service_id) respond(false, [], 'Invalid service id');

        $service_title = htmlspecialchars(str_post('service_title'));
        $service_description = htmlspecialchars(str_post('service_description'));
        $service_status = htmlspecialchars($_POST['service_status'] ?? 'active');

        $stmt = $OstMiscellaneaConn->prepare("UPDATE services SET service_title=?, service_description=?, status=? WHERE service_id=?");
        $stmt->bind_param("sssi", $service_title, $service_description, $service_status, $service_id);
        if (!$stmt->execute()) respond(false, [], 'Update failed: '.$stmt->error);
        $stmt->close();

        // handle newly uploaded images (append)
        if (!empty($_FILES['service_images']['name'][0])) {
            foreach ($_FILES['service_images']['tmp_name'] as $k => $tmp_name) {
                if ($_FILES['service_images']['error'][$k] === UPLOAD_ERR_OK) {
                    $fname = uniqid() . '_' . basename($_FILES['service_images']['name'][$k]);
                    $dest = $upload_dir . $fname;
                    if (move_uploaded_file($tmp_name, $dest)) {
                        $ins = $OstMiscellaneaConn->prepare("INSERT INTO services_images (service_id, service_img_path) VALUES (?, ?)");
                        $ins->bind_param("is", $service_id, $fname);
                        $ins->execute();
                        $ins->close();
                    }
                }
            }
        }
        respond(true, [], 'Service updated');
    }

    if ($action === 'delete') {
        $id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);
        if (!$id) respond(false, [], 'Invalid id');

        // fetch images to delete files
        $imgs = [];
        $imgRes = $OstMiscellaneaConn->prepare("SELECT service_img_path FROM services_images WHERE service_id = ?");
        $imgRes->bind_param("i", $id);
        $imgRes->execute();
        $imgRes->bind_result($imgpath);
        while ($imgRes->fetch()) $imgs[] = $imgpath;
        $imgRes->close();

        // delete DB row (ON DELETE CASCADE removes images rows)
        $del = $OstMiscellaneaConn->prepare("DELETE FROM services WHERE service_id = ?");
        $del->bind_param("i", $id);
        if (!$del->execute()) respond(false, [], 'Delete failed: '.$del->error);
        $del->close();

        // remove files
        foreach ($imgs as $f) {
            $fp = $upload_dir . $f;
            if (file_exists($fp)) @unlink($fp);
        }
        respond(true, [], 'Deleted');
    }

    if ($action === 'toggle_status') {
        $id = (int)($_POST['id'] ?? 0);
        $status = ($_POST['status'] ?? ($_GET['status'] ?? 'active'));
        if (!$id) respond(false, [], 'Invalid id');
        $stmt = $OstMiscellaneaConn->prepare("UPDATE services SET status = ? WHERE service_id = ?");
        $stmt->bind_param("si", $status, $id);
        if (!$stmt->execute()) respond(false, [], 'Toggle failed: '.$stmt->error);
        $stmt->close();
        respond(true, [], 'Status updated');
    }

    if ($action === 'delete_image') {
        $service_id = (int)($_POST['service_id'] ?? $_GET['service_id'] ?? 0);
        $img = ($_POST['img'] ?? $_GET['img'] ?? '');
        if (!$service_id || !$img) respond(false, [], 'Missing parameters');

        // delete db row(s) matching the filename and service
        $del = $OstMiscellaneaConn->prepare("DELETE FROM services_images WHERE service_id = ? AND service_img_path = ?");
        $del->bind_param("is", $service_id, $img);
        if (!$del->execute()) respond(false, [], 'Delete image failed: '.$del->error);
        $del->close();

        // remove file
        $fp = $upload_dir . $img;
        if (file_exists($fp)) @unlink($fp);

        respond(true, [], 'Image deleted');
    }

    // default
    respond(false, [], 'No action provided');

} catch (Exception $e) {
    respond(false, [], 'Exception: '.$e->getMessage());
}


/*
<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $service_title = htmlspecialchars($_POST['service_title'] ?? '');
    $service_description = htmlspecialchars($_POST['service_description'] ?? '');
    $service_status = htmlspecialchars($_POST['service_status'] ?? 'active');
    
    // TODO: Add database insert logic here
    // Validate inputs
    if (empty($service_title) || empty($service_description)) {
        die('Error: Service title and description are required.');
    }

    // Include database connection
    require_once '../config/miscellanea_db.php';

    try {
        // Insert into services table
        $stmt = $OstMiscellaneaConn->prepare("INSERT INTO services (service_title,service_description, status) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $service_title, $service_description, $service_status);
        
        if (!$stmt->execute()) {
            throw new Exception("Error inserting service: " . $stmt->error);
        }
        
        $service_id = $stmt->insert_id;
        $stmt->close();

        // Handle file uploads if present
        if (!empty($_FILES['service_images']['name'][0])) {
            $upload_dir = '../../files/uploads/services/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            foreach ($_FILES['service_images']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['service_images']['error'][$key] === UPLOAD_ERR_OK) {
                    $file_name = uniqid() . '_' . basename($_FILES['service_images']['name'][$key]);
                    $file_path = $upload_dir . $file_name;

                    if (move_uploaded_file($tmp_name, $file_path)) {
                        $stmt = $OstMiscellaneaConn->prepare("INSERT INTO services_images (service_id, service_img_path) VALUES (?, ?)");
                        $stmt->bind_param("is", $service_id, $file_name);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            }
        }
        // Redirect with success message
        header("Location: " . $_SERVER['HTTP_REFERER'] . "&services_added=1");
    
        exit;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    // TODO: Handle file upload for service images
}
    */