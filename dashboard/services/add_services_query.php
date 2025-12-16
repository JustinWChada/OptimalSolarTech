
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
        header("Location: ../dashboard?add_services&services_added=1");
    
        exit;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
    // TODO: Handle file upload for service images
}

header("Location: ../dashboard?add_services&services_added=1");