<div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quoteModalLabel">Free Quote Request</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="quoteForm" novalidate>
        <div class="modal-body">
            <div id="ajaxAlert" class="alert ajax-alert" role="alert"></div>

            <div class="mb-3">
                <label for="name" class="form-label required">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label required">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="+263 ** *** ****" required>
                <div class="form-text form-note">Include country code if outside your country.</div>
            </div>

            <div class="mb-3">
                <label for="service" class="form-label required">Service</label>
                <select class="form-select" id="service" name="service" required>
                    <option value="">Choose a service...</option>
                    <option value="air-conditioning">
                    Air Conditioning Installation
                  </option>
                  <option value="ac-repair">Aircon Troubleshooting</option>
                  <option value="vehicle-ac">Vehicle Air Conditioning</option>
                  <option value="ac-servicing">Aircon Servicing</option>
                  <option value="solar">Solar Installation</option>
                  <option value="plumbing">Borehole Plumbing</option>
                  <option value="electrical">House Wiring</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description / Notes</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Project details, address, preferred timeline..."></textarea>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> Cancel <i class="bi bi-x"></i> </button>
            <button type="submit" id="submitBtn" class="btn btn-outline-primary"> Send <i class="bi bi-telegram"></i> </button>
        </div>
      </form>
    </div>
  </div>
</div>