let currentTab = "available-services";

const newServiceModal = new bootstrap.Modal(
  document.getElementById("newServiceModal")
);

const imageViewerModal = new bootstrap.Modal(
  document.getElementById("imageViewerModal")
);

$(function () {
  loadServices();

  // New service submit
  $("#newServiceForm").on("submit", function (e) {
    e.preventDefault();
    let fd = new FormData(this);
    fd.append("action", "save");
    $.ajax({
      url: "services/query_services.php",
      method: "POST",
      data: fd,
      contentType: false,
      processData: false,
      dataType: "json",
    })
      .done(function (resp) {
        if (resp.success) {
          alert("Service saved");
          $("#newServiceForm")[0].reset();
          newServiceModal.hide();
          loadServices();
        } else {
          alert("Error: " + (resp.message || "Unknown"));
        }
      })
      .fail(function () {
        alert("Request failed");
      });
  });
});

function switchTab(tab) {
  currentTab = tab;
  $(".tab-btn").removeClass("active");
  $(`.tab-btn[data-tab="${tab}"]`).addClass("active");
  if (tab === "new-service") newServiceModal.show();
  if (tab === "available-services") loadServices();
}

function loadServices() {
  $("#content").html(
    '<div class="text-center py-5"><div class="spinner-border" role="status"></div></div>'
  );
  $.getJSON("services/query_services.php", { action: "load" }, function (resp) {
    if (!resp.success) {
      $("#content").html(
        '<div class="alert alert-danger">Failed to load services</div>'
      );
      return;
    }
    let services = resp.data;
    if (services.length === 0) {
      $("#content").html(
        '<div class="alert alert-info">No services found.</div>'
      );
      return;
    }
    let html = '<div class="row g-4">';
    services.forEach((s) => {
      const statusBadge =
        s.status === "active"
          ? '<span class="badge bg-success">Active</span>'
          : '<span class="badge bg-secondary">Inactive</span>';
      // thumbnails
      let thumbs = '<div class="service-thumbs">';
      (s.images || []).forEach((img) => {
        const url = img
          ? "../files/uploads/services/" + img
          : "images/placeholder.png";
        thumbs += `<img src="${url}" class="service-thumb" alt="" data-service="${s.service_id}" data-img="${img}">`;
      });
      thumbs += "</div>";

      html += `
                <div class="col-md-6 col-lg-4">
                
                  <div class="card service-card h-100">
                    <div class="card-body d-flex flex-column">
                      ${thumbs}
                      <h5 class="card-title mt-2">${escapeHtml(
                        s.service_title
                      )} ${statusBadge}</h5>
                      <p class="card-text text-muted flex-grow-1">${escapeHtml(
                        s.service_description
                      )}</p>
                      <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="card-actions">
                          <button class="btn btn-sm btn-outline-primary" onclick="editService(${
                            s.service_id
                          })">Edit</button>
                          <button class="btn btn-sm ${
                            s.status === "active"
                              ? "btn-outline-warning"
                              : "btn-outline-success"
                          }" onclick="toggleStatus(${s.service_id}, '${
        s.status
      }')">
                            ${
                              s.status === "active"
                                ? "Set Inactive"
                                : "Set Active"
                            }
                          </button>
                          <button class="btn btn-sm btn-outline-danger" onclick="deleteService(${
                            s.service_id
                          })">Delete</button>
                        </div>
                        <small class="text-muted">${s.date_uploaded}</small>
                      </div>
                    </div>
                  </div>
                </div>
                `;
    });
    html += "</div>";
    $("#content").html(html);

    // attach click to thumbnails
    $(".service-thumb")
      .off("click")
      .on("click", function () {
        const img = $(this).data("img");
        const sid = $(this).data("service");
        $("#viewerImage").attr("src", "../files/uploads/services/" + img);
        $("#viewerImageInfo").text(`Service: ${sid} — ${img}`);
        $("#deleteImageBtn").data("service", sid).data("img", img).show();
        imageViewerModal.show();
      });
  }).fail(function () {
    $("#content").html(
      '<div class="alert alert-danger">Failed to load services</div>'
    );
  });
}

// utility to escape HTML
function escapeHtml(text) {
  if (!text) return "";
  return $("<div>").text(text).html();
}

// Delete image from modal
$("#deleteImageBtn").on("click", function () {
  const service = $(this).data("service");
  const img = $(this).data("img");
  if (!confirm("Delete this image?")) return;
  $.post(
    "services/query_services.php",
    { action: "delete_image", service_id: service, img: img },
    function (resp) {
      if (resp.success) {
        imageViewerModal.hide();
        loadServices();
      } else alert("Error: " + (resp.message || "Unknown"));
    },
    "json"
  );
});

function editService(id) {
  $.getJSON(
    "services/query_services.php",
    { action: "get", id: id },
    function (resp) {
      if (!resp.success) {
        alert("Failed to load service");
        return;
      }
      const s = resp.data;
      // populate edit form in edit modal
      $('#editServiceForm [name="service_id"]').val(s.service_id);
      $('#editServiceForm [name="service_title"]').val(s.service_title);
      $('#editServiceForm [name="service_description"]').val(
        s.service_description
      );
      $('#editServiceForm [name="service_status"]').val(s.status);
      // show existing images
      let list = "";
      (s.images || []).forEach((img) => {
        const url = "../files/uploads/services/" + img;
        list += `<div class="me-2 mb-2 d-inline-block text-center">
                    <img src="${url}" class="service-thumb" style="width:72px;height:72px;"><br>
                    <small class="text-muted">${img}</small>
                </div>`;
      });
      $("#existingImagesContainer").html(
        list || '<small class="text-muted">No images</small>'
      );
      // show modal
      const editModal = new bootstrap.Modal(
        document.getElementById("editServiceModal")
      );
      editModal.show();
    }
  ).fail(function () {
    alert("Failed to load");
  });
}

// Edit form submission
$("#editServiceForm").on("submit", function (e) {
  e.preventDefault();
  let fd = new FormData(this);
  fd.append("action", "edit");
  $.ajax({
    url: "services/query_services.php",
    method: "POST",
    data: fd,
    contentType: false,
    processData: false,
    dataType: "json",
  })
    .done(function (resp) {
      if (resp.success) {
        alert("Service updated");
        const editModalEl = document.getElementById("editServiceModal");
        const editModal = bootstrap.Modal.getInstance(editModalEl);
        editModal.hide();
        loadServices();
      } else alert("Error: " + (resp.message || "Unknown"));
    })
    .fail(function () {
      alert("Request failed");
    });
});

function deleteService(id) {
  if (!confirm("Delete this service and all its images?")) return;
  $.post(
    "services/query_services.php",
    { action: "delete", id: id },
    function (resp) {
      if (resp.success) {
        alert("Deleted");
        loadServices();
      } else alert("Error: " + (resp.message || "Unknown"));
    },
    "json"
  );
}

function toggleStatus(id, current) {
  const newStatus = current === "active" ? "inactive" : "active";
  $.post(
    "services/query_services.php",
    { action: "toggle_status", id: id, status: newStatus },
    function (resp) {
      if (resp.success) loadServices();
      else alert("Error: " + (resp.message || "Unknown"));
    },
    "json"
  );
}
