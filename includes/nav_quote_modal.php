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
                <div class="form-text form-note">Include country code if outside Zimbabwe.</div>
            </div>

            <div class="mb-3">
                <label for="service" class="form-label required">Service</label>
                <select class="form-select" id="service" name="service" required>
                    <option value="">Choose a service...</option>
                    <?php
                      require '../config/miscellanea_db.php';

                      $sql = "SELECT service_id, service_title FROM services WHERE status = 'active'";
                      $result = $OstMiscellaneaConn->query($sql);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['service_title']) . '">' . htmlspecialchars($row['service_title']) . '</option>';
                        }
                      }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description / Notes</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Project details, address, preferred timeline..."></textarea>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> Cancel <i class="bi bi-x"></i> </button>
            <button type="submit" id="submitBtn" class="btn btn-outline-success"> Send <i class="bi bi-telegram"></i> </button>
        </div>
      </form>
    </div>
  </div>
</div>