// faqs.js

$(document).ready(function() {
    // Delete FAQ
    $(document).on("click", ".delete-btn", function() {
        var faqId = $(this).data("faq-id");
        alert("Deleting FAQ ID: " + faqId);
        // Send AJAX request to delete the FAQ
        $.ajax({
            url: "faqs/query_faqs.php",
            type: "POST",
            data: { action: "delete", faqId: faqId },
            success: function(response) {
                // Refresh the FAQs section
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
});