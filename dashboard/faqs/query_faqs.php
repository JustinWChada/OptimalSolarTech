<?php
// query_faqs.php

require_once '../config/miscellanea_db.php';


// Delete FAQ
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "delete") {
        $faqId = $_POST["faqId"];

        // Delete the FAQ from the database
        $sql = "DELETE FROM faqs WHERE faq_id = ?";
        $stmt = $OstMiscellaneaConn->prepare($sql);
        $stmt->bind_param("i", $faqId);
        $stmt->execute();
        $stmt->close();
        
    }
}

// Insert FAQ
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "insert") {
        $question = $_POST["question"];
        $answer = $_POST["answer"];

        // Insert the FAQ into the database
        $sql = "INSERT INTO faqs (question, answer) VALUES (?, ?)";
        $stmt = $OstMiscellaneaConn->prepare($sql);
        $stmt->bind_param("ss", $question, $answer);
        $stmt->execute();
        $stmt->close();

        header("Location:".$_SERVER['HTTP_REFERER']);
    }
}
