<?php

require_once '../config/miscellanea_db.php';

?>

<link rel="stylesheet" href="css/services.css" type="text/css">

<div class="container services-container">
    <div class="tab-buttons">
        <button class="tab-btn active" data-tab="available-services" onclick="switchTab('available-services')">Available Services</button>
        <button class="tab-btn" data-tab="new-service" onclick="switchTab('new-service')">New Service</button>
    </div>

    <div id="content" class="content-area">
        <!-- Services will be injected here -->
    </div>
</div>

<!-- New Service Modal -->
<div class="modal fade" id="newServiceModal" tabindex="-1" aria-labelledby="newServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="newServiceForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="newServiceModalLabel">Add New Service</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Service Title</label>
                <input type="text" name="service_title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Service Description</label>
                <textarea name="service_description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="service_status" class="form-select">
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Images (multiple allowed)</label>
                <input type="file" name="service_images[]" class="form-control" accept="image/*" multiple>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Service</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
// Include edit modal markup
require_once 'edit_services.php';
?>

<!-- Image viewer modal -->
<div class="modal fade" id="imageViewerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0 text-center">
        <img id="viewerImage" src="" alt="" class="img-fluid w-100">
      </div>
      <div class="modal-footer justify-content-between">
        <div class="text-start">
            <small id="viewerImageInfo" class="text-muted"></small>
        </div>
        <div>
            <button id="deleteImageBtn" type="button" class="btn btn-danger btn-sm">Delete Image</button>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script src= "js/services.js"></script>
