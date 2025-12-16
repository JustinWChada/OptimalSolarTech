$(function () {
  // Initialize variables
  var $form = $("#reviewForm");
  var $submit = $("#submitBtn");
  var $alert = $("#ajaxAlert");

  // Handle star rating
  $(".rating-stars i").on("click", function () {
    var rating = $(this).data("rating");
    $("#rating").val(rating);
    $(".rating-stars i").each(function () {
      if ($(this).data("rating") <= rating) {
        $(this).addClass("bi-star-fill").removeClass("bi-star");
      } else {
        $(this).removeClass("bi-star-fill").addClass("bi-star");
      }
    });
  });

  // Reset alert when modal opens
  $("#reviewModal").on("show.bs.modal", function () {
    $alert.hide().removeClass("alert-success alert-danger").text("");
  });
});

// Handle form submission
$("#reviewForm").on("submit", function (e) {
  e.preventDefault();

  var $form = $("#reviewForm");
  var $alert = $("#ajaxAlert");
  var $submit = $("#submitBtn");

  $alert.hide().removeClass("alert-success alert-danger").text("");
  $submit.prop("disabled", true).text("Sending...");

  // Collect form data
  var form_data = {
    action: "submit_review",
    projectId: $("#projectId").val(),
    rating: $("#rating").val(),
    reviewText: $("#reviewText").val(),
  };


  $.ajax({
    type: "POST",
    url: "../queries/submit_review.php", // URL to handle the form submission
    data: form_data,
    dataType: "json",
    success: function (resp) {
      if (resp.success) {
        $alert.addClass("alert-success").text("Review submitted successfully!");
        $form.trigger("reset");
        $("#reviewModal").modal("hide");
      } else {
        $alert
          .addClass("alert-danger")
          .text("Error: " + (resp.message || "Unknown"));
      }
      $submit.prop("disabled", false).text("Submit");
    },
    error: function () {
      $alert.addClass("alert-danger").text("Request failed");
      $submit.prop("disabled", false).text("Submit");
    },
  });
});
