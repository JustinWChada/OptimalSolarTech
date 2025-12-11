function toggleDetails(cardElement) {
  cardElement.classList.toggle("expanded");
}

function deleteQuote(quoteId) {
  if (confirm("Are you sure you want to delete this quote?"+quoteId)) {
    // Create an AJAX request to delete the quote
    $.ajax({
      url: "quotes & estimates/query_quotes.php",
      type: "POST",
      data: {action: "delete", quoteId: quoteId },
      success: function (response) {
        console.log("Delete response:", response);
        // On success, remove the quote card from the UI
        //alert(response.message); //remove
        location.reload(); // Reload the page to reflect changes
      },
      error: function (xhr, status, error) {
        console.error("Error deleting quote:", status, error);
        alert("Failed to delete the quote. Please try again.");
      },
    });
  }
}

// $(document).ready(function () {
//   $(".delete-button").on("click", function (event) {
//     event.stopPropagation();
//     var quoteId = $(this).data("quote-id");
//     deleteQuote(quoteId);
//   });
// });
