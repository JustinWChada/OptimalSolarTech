function toggleDetails(cardElement) {
  cardElement.classList.toggle("expanded");
}

function deleteQuote(quoteId) {
  if (confirm("Are you sure you want to delete this quote?")) {
    // Create an AJAX request to delete the quote
    $.ajax({
      url: "quotes & estimates/query_quotes.php",
      type: "POST",
      data: {action: "delete", quoteId: quoteId },
      success: function (response) {
        console.log("Delete response:", response); //remove
        
        location.reload();
      },
      error: function (xhr, status, error) {
        console.error("Error deleting quote:", status, error);
        alert("Failed to delete the quote. Please try again.");
      },
    });
  }
}
