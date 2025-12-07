$(function () {
  var $form = $("#freeEstimateForm");
  var $submit = $("#submitBtn");
  var $alert = $("#ajaxAlert");

  $form.on("submit", function (e) {
    e.preventDefault();
    $alert.hide().removeClass("alert-success alert-danger").text("");
    $submit.prop("disabled", true).text("Sending...");

    // Collect form data
    var data = {
      action: "submit_free_estimate",
      name: $("#name").val(),
      phone: $("#phone").val(),
      service: $("#service").val(),
      description: $("#description").val(),
    };

    $.ajax({
      url: "", // same page handles POST
      method: "POST",
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
      error: function (xhr) {
        $alert
          .addClass("alert-danger")
          .text("An error occurred. Please try again later.")
          .show();
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
