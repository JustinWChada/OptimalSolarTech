<!-- Edit service modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="editServiceForm" enctype="multipart/form-data">
        <input type="hidden" name="service_id" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
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
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Add Images</label>
                <input type="file" name="service_images[]" class="form-control" accept="image/*" multiple>
            </div>
            <div class="mb-3">
                <label class="form-label">Existing Images</label>
                <div id="existingImagesContainer" class="d-flex flex-wrap"></div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>
