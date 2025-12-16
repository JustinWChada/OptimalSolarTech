// faqs.js

$(document).ready(function () {
  // Delete FAQ
  $(document).on("click", ".delete-btn", function () {
    var faqId = $(this).data("faq-id");
    // Send AJAX request to delete the FAQ
    if (confirm("Deleting FAQ ID: " + faqId)) {
      $.ajax({
        url: "faqs/query_faqs.php",
        type: "POST",
        data: { action: "delete", faqId: faqId },
        success: function (response) {
          // Refresh the FAQs section
          location.reload();
        },
        error: function (xhr, status, error) {
          console.log("Error: " + error);
        },
      });
    }
  });
});
