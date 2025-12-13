var $alert = $("#ajaxAlert");
var $form = $("#reviewForm");
var $submit = $("#submitBtn");

$(function () {
  // Initialize variables
  
 

  // Handle star rating
  $(".rating-stars .btn").on("click", function () {
    var rating = $(this).data("rating");
    $("#rating").val(rating);
    $(".rating-stars .btn").each(function () {
      if ($(this).data("rating") <= rating) {
        $(this).addClass("btn-warning active").removeClass("");
      } else {
        $(this).removeClass("btn-warning active").addClass("");
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

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "../queries/submit_testimonial.php",
      data: formData,
      dataType: "json",
      success: function (response,xhr) {
        if (response.success) {
          $alert.addClass("alert-success").text(response.message+ "We will process your review shortly").show();
          $submit.prop("disabled", false).text("Submit");
        } else {
          $alert.addClass("alert-danger").text(response.message).show();
          $submit.prop("disabled", false).text("Submit");
        }
      },
      error: function (xhr, status, error) {
        $alert.addClass("alert-danger").text("Error submitting testimonial: " + error).show();
        $submit.prop("disabled", false).text("Submit");
        console.error(xhr.responseText);
      }
    });
  });
