// Initialize Bootstrap tooltips (requires Bootstrap JS to be loaded on the page)
document.addEventListener("DOMContentLoaded", function () {
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  tooltipTriggerList.forEach(function (el) {
    if (typeof bootstrap !== "undefined") {
      new bootstrap.Tooltip(el);
    }
  });
});
