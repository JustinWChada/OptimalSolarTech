<?php

require_once "../config/miscellanea_db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_testimonial_status') {
    $testimonial_id = isset($_POST['testimonial_id']) ? (int)$_POST['testimonial_id'] : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    $query = "UPDATE testimonials SET status = '$status' WHERE id = $testimonial_id";
    $result = mysqli_query($OstMiscellaneaConn, $query);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Testimonial deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete testimonial.']);
    }
    
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'fetch_testimonials' ){
    $query = "SELECT id, rating, customer_email,customer_name, customer_title, description, status FROM testimonials";
    $result = mysqli_query($OstMiscellaneaConn, $query);
    $response = array();
    while ($testimonial = mysqli_fetch_assoc($result)) {
        $response[] = (object) $testimonial;
    }
    echo json_encode($response);
}

