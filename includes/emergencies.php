<div class="modal fade" id="emergencyModal" tabindex="-1" aria-labelledby="emergencyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emergencyModalLabel">Emergency Request</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <strong>Important!</strong> This is an emergency request form. Please only use this form if you require immediate assistance. 
          We will respond to your request as soon as possible, usually within a few minutes to an hour <i class="bi bi-stopwatch"></i>.
        </div>

        <form id="emergencyForm">
          <div class="mb-3">
            <label for="name" class="form-label required">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label required">Phone Number (WhatsApp and/or Callable)</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="+263 ** *** ****" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description of Emergency</label>
            <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" id="submitBtn" class="btn btn-success">Send Request</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

