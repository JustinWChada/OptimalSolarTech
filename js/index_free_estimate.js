$(function () {
  var $form = $("#freeEstimateForm");
  var $submit = $("#submitBtn");
  var $alert = $("#ajaxAlert");

  $("#freeEstimateForm").on("submit", function (e) {
    e.preventDefault();
    $alert.hide().removeClass("alert-success alert-danger").text("");
    $submit.prop("disabled", true).text("Sending...");

    // Collect form data
    var data = {
      action: "submit_free_estimate",
      name: document.getElementById("freeEstimateForm").name.value,
      phone: document.getElementById("freeEstimateForm").phone.value,
      service: document.getElementById("freeEstimateForm").service.value,
      description: document.getElementById("freeEstimateForm").description.value,
    };

    $.ajax({
      type: "POST",
      url: "../queries/index_free_estimate_modal_query.php", // same page handles POST
      data: data,
      dataType: "json",
      success: function (resp) {
        if (resp && resp.success) {
          $alert
            .addClass("alert-success")
            .text(resp.message || "Request sent.")
            .show();
          $form[0].reset();
          setTimeout(function () {
            var modal = bootstrap.Modal.getInstance(
              document.getElementById("freeEstimateModal")
            );
            if (modal) modal.hide();
            $alert.hide();
          }, 1500);
        } else {
          var msg = "Please correct the errors and try again.";
          if (resp && resp.errors && resp.errors.length) {
            msg = resp.errors.join(" ");
          }
          $alert.addClass("alert-danger").text(msg).show();
        }
      },
      error: function (xhr, status, error) {
        $alert
          .addClass("alert-danger")
          .text("An error occurred. Please try again later.")
          .show();
          console.log("AJAX Error:", status, error);
      },
      complete: function () {
        $submit.prop("disabled", false).text("Submit Request");
      },
    });
  });

  // Reset alert when modal opens
  $("#freeEstimateModal").on("show.bs.modal", function () {
    $alert.hide().removeClass("alert-success alert-danger").text("");
  });
});
