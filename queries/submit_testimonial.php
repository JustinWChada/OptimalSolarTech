<?php

require "../config/miscellanea_db.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') { //assuming the only post is for testimonials 😂
    $review_rating = $_POST['review_rating'];
    $customer_email = $_POST['customer_email'];
    $review_text = $_POST['review_text'];
    $customer_name = $_POST['customer_name'];
    $customer_title = $_POST['customer_title'];

    $sql = "INSERT INTO testimonials (rating,customer_email,customer_name,customer_title,description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $OstMiscellaneaConn->prepare($sql);
    $stmt->bind_param("issss", $review_rating, $customer_email, $customer_name, $customer_title, $review_text);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Testimonial submitted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error submitting testimonial.']);
    }
}