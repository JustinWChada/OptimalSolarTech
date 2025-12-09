const fileInput = document.getElementById("service_images");
const fileList = document.getElementById("file-list");

fileInput.addEventListener("change", updateFileList);

function updateFileList() {
  fileList.innerHTML = "";
  Array.from(fileInput.files).forEach((file, index) => {
    const fileItem = document.createElement("div");
    fileItem.className = "file-item";
    fileItem.innerHTML = `
            <span class="file-item-name">
                <i class="bi bi-file-image"></i> ${file.name}
            </span>
            <button type="button" class="btn-remove" onclick="removeFile(${index})">Remove</button>
        `;
    fileList.appendChild(fileItem);
  });
}

function removeFile(index) {
  const dt = new DataTransfer();
  Array.from(fileInput.files).forEach((file, i) => {
    if (i !== index) dt.items.add(file);
  });
  fileInput.files = dt.files;
  updateFileList();
}

$("#sserviceForm").on("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  $.ajax({
    url: "services/query_services.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      alert("Service added successfully!");
      // $('#serviceForm')[0].reset();
      // fileList.innerHTML = '';

      window.location.href = "?add_services";
    },
    error: function (xhr, status, error) {
      alert("An error occurred while adding the service.");
    },
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const alertElement = document.getElementById("successAlert");
  if (alertElement) {
    setTimeout(() => {
      alertElement.classList.remove("show");
      alertElement.addEventListener("transitionend", () =>
        alertElement.remove()
      );
    }, 3000);
  }
});
