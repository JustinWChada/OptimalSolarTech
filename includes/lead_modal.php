<div class="modal fade" id="leadModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      
      <div class="modal-header text-white" style="background: linear-gradient(135deg, var(--primary-color), #0f766e);">
        <div>
          <h5 class="modal-title fw-bold" id="leadModalLabel">
            <i class="ri-rocket-line me-2"></i> Start Your Project
          </h5>
          <p class="mb-0 small opacity-75">Get a free, no-obligation estimate today.</p>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="leadForm" novalidate>
        <div class="modal-body p-4">
            <div id="leadAjaxAlert" class="alert d-none" role="alert"></div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-uppercase text-muted">Full Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="ri-user-line"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-uppercase text-muted">Phone <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="ri-phone-line"></i></span>
                        <input type="tel" class="form-control" name="phone" placeholder="+263..." required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Service Required <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="ri-tools-line"></i></span>
                    <select class="form-select" id="leadServiceSelect" name="service" required>
                        <option value="" selected disabled>Select a service...</option>
                        <?php
                          require_once '../config/miscellanea_db.php';
                          // Optimized query to get active services
                          $sql = "SELECT service_title FROM services WHERE status = 'active' ORDER BY service_title ASC";
                          $result = $OstMiscellaneaConn->query($sql);
                          if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($row['service_title']) . '">' . htmlspecialchars($row['service_title']) . '</option>';
                            }
                          }
                        ?>
                        <option value="Other">Other / General Inquiry</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small text-uppercase text-muted">Project Details</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Describe your issue or project needs..."></textarea>
            </div>
            
            <div class="mb-3">
                 <label class="form-label fw-bold small text-uppercase text-muted">How did you find us?</label>
                 <select class="form-select form-select-sm" name="source">
                    <option value="Google">Google Search</option>
                    <option value="Social Media">Social Media</option>
                    <option value="Referral">Referral</option>
                    <option value="Other">Other</option>
                 </select>
            </div>

        </div>
        <div class="modal-footer bg-light">
            <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" id="leadSubmitBtn" class="btn btn-primary fw-bold px-4">
                <i class="ri-send-plane-fill me-2"></i> Send Request
            </button>
        </div>
      </form>
    </div>
  </div>
</div>