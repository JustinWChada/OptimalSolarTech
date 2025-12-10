<link rel="stylesheet" href="css/faqs.css" type="text/css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="?faqs"><i class="bi bi-box-seam-fill"></i> FAQs Portfolio</a>
        <div class="d-flex">
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#FAQsModal">
                <i class="bi bi-plus-circle-fill"></i> New FAQ
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <header class="text-center mb-4">
        <h1 class="display-4 fw-bold">Active FAQs</h1>
        <p class="lead text-secondary">View, edit, and manage all your FAQ entries.</p>
        <hr class="w-25 mx-auto">
    </header>

    <div id="faqs-list-container" class="row">
    </div>
</div>

<div class="modal fade" id="FAQsModal" tabindex="-1" aria-labelledby="FAQsModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageCarouselLabel">Add New FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form action="faqs/query_faqs.php" method="post" enctype="multipart/form-data" id="faqForm">
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question" required>
                        <input type="text" class="form-control" id="question" name="action" value="insert" hidden required>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="js/faqs.js"></script>


<?php
require_once '../config/miscellanea_db.php';

$sql = "SELECT * FROM faqs WHERE status = 'active'";
$result = $OstMiscellaneaConn->query($sql);

if ($result->num_rows > 0) {
    // Output each FAQ as a card with a delete feature
    while ($row = $result->fetch_assoc()) {
        $faq_id = $row["faq_id"];
        $question = $row["question"];
        $answer = $row["answer"];

        // Display the FAQ as a card
        echo '<div class="faq-card bg-success border border-success rounded-lg p-4">';
        echo '<h3 class="text-white">' . $question . '</h3>';
        echo '<p class="text-white">' . $answer . '</p>';
        echo '<a href="faqs/query_faqs.php?action=delete&faqId=' . $faq_id . '" class="delete-btn btn btn-danger btn-sm" data-faq-id="' . $faq_id . '">Delete</a>';
        echo '</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">No FAQs found.</div>';
}

$OstMiscellaneaConn->close();