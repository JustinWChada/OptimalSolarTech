function toggleDetails(cardElement) {
  cardElement.classList.toggle("expanded");
}

function deleteFreeEstimate(freeEstimate) {
    if (confirm("Are you sure you want to delete this free estimate?")) {
        // Create an AJAX request to delete the free estimate
        $.ajax({
            url: "quotes & estimates/query_free_estimates.php",
            type: "POST",
            data: { action: "delete", freeEstimateId: freeEstimate },
            success: function (response) {
                console.log("Delete response:", response); //remove
                
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Error deleting free estimate:", status, error);
                alert("Failed to delete the free estimate. Please try again.");
            },
        });
    }
}