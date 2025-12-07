$(document).ready(function () {

  setInterval(function () {
    $("#emergencyMessages").toggleClass("active");
  }, 2000);

  $("#sidebarToggle").click(function () {
    $(".sidebar").toggleClass("open");
  });

  $(document).click(function (event) {
    if (!$(event.target).closest('.sidebar, #sidebarToggle').length) {
      $(".sidebar").removeClass("open");
    }
  });

});
