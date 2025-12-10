$(function () {
  var $form = $("#quoteForm");
  var $submit = $("#submitBtn");
  var $alert = $("#ajaxAlert");

  $form.on("submit", function (e) {
    e.preventDefault();
    $alert.hide().removeClass("alert-success alert-danger").text("");
    $submit.prop("disabled", true).text("Sending...");

    form = document.getElementById("quoteForm");

    // Collect form data
    var data = {
      action: "submit_quote",
      name: document.getElementById("quoteForm").name.value,
      phone: document.getElementById("quoteForm").phone.value,
      service: document.getElementById("quoteForm").service.value,
      description: document.getElementById("quoteForm").description.value,
    };

    $.ajax({
      type: "POST",
      url: "../queries/nav_quote_modal_query.php", // same page handles POST
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
              document.getElementById("quoteModal")
            );
            if (modal) modal.hide();
            $alert.hide();
          }, 1500);
        } else {
          var msg = "Please correct the errors and try again.";
          if (resp && resp.errors && resp.errors.length) {
            msg = resp.errors;//.join(" ");
          }
          $alert.addClass("alert-danger").text(msg).show();
        }
      },
      error: function (xhr, status, error) {
        $alert
          .addClass("alert-danger")
          .text("An error occurred. Please try again later."+error)
          .show();
      },
      complete: function () {
        $submit.prop("disabled", false).text("Submit Request");
      },
    });
  });

  // Reset alert when modal opens
  $("#quoteModal").on("show.bs.modal", function () {
    $alert.hide().removeClass("alert-success alert-danger").text("");
  });
});
