<section id="contact" class="contact-section">
  
    <div class="section-header">
      <h2>
        Get In Touch
      </h2>
      <p>
        Ready to start your project? Contact us for a free consultation and quote
      </p>
    </div>
    <div class="content-grid">
      <!-- Contact Form -->
      <div class="form-card">
        <h3>
          Send us a message
        </h3>
        <form id="contact-form" data-readdy-form="true" class="form-body">
          <div class="input-row">
            <div class="input-group">
              <label for="name" class="input-label">
                Full Name *
              </label>
              <input
                id="name"
                required=""
                class="input-field"
                placeholder="Your full name"
                type="text"
                value=""
                name="name"
              />
            </div>
            <div class="input-group">
              <label for="email" class="input-label">
                Email Address *
              </label>
              <input
                id="email"
                required=""
                class="input-field"
                placeholder="your@email.com"
                type="email"
                value=""
                name="email"
              />
            </div>
          </div>
          <div class="input-row">
            <div class="input-group">
              <label for="phone" class="input-label">
                Phone Number
              </label>
              <input
                id="phone"
                class="input-field"
                placeholder="+263 ** *** ****"
                type="tel"
                value=""
                name="phone"
              />
            </div>
            <div class="input-group">
              <label for="service" class="input-label">
                Service Needed
              </label>
              <div class="select-wrapper">
                <select
                  id="service"
                  name="service"
                  class="input-field select-field"
                  required
                >
                  <option value="">Select a service</option>
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
                <i
                  class="ri-arrow-down-s-line select-icon"
                ></i>
              </div>
            </div>
          </div>
          <div class="input-group">
            <label for="message" class="input-label">
              Message
            </label>
            <textarea
              id="message"
              name="message"
              rows="4"
              maxlength="500"
              class="input-field textarea-field"
              placeholder="Tell us about your project..."
            ></textarea>
            <p class="char-count">0/500 characters</p>
          </div>
          <button
            type="submit"
            class="submit-button"
          >
            Send Message
          </button>
        </form>
      </div>

      <!-- Contact Info & Map -->
      <div>
        <h3 class="info-heading">
          Contact Information
        </h3>
        <div class="info-group">
          <!-- Contact Items -->
          <div class="contact-item">
            <div class="icon-box">
              <i class="ri-map-pin-line icon-text"></i>
            </div>
            <div class="contact-text-content">
              <h4 class="contact-title">Our Location</h4>
              <p class="contact-detail">
                Clansman Business Address
              </p>
            </div>
          </div>
          <div class="contact-item">
            <div class="icon-box">
              <i class="ri-phone-line icon-text"></i>
            </div>
            <div class="contact-text-content">
              <h4 class="contact-title">Phone Number</h4>
              <p class="contact-detail">Clansman Phone</p>
              <p class="contact-sub-detail">24/7 Emergency Service</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="icon-box">
              <i class="ri-mail-line icon-text"></i>
            </div>
            <div class="contact-text-content">
              <h4 class="contact-title">Email Address</h4>
              <p class="contact-detail">Clansman Email</p>
            </div>
          </div>
          <div class="contact-item">
            <div class="icon-box">
              <i class="ri-time-line icon-text"></i>
            </div>
            <div class="contact-text-content">
              <h4 class="contact-title">Business Hours</h4>
              <p class="contact-detail">
                Monday - Friday: 8:00 AM - 6:00 PM<br />Saturday: 9:00 AM - 4:00
                PM<br />Sunday: Emergency calls only
              </p>
            </div>
          </div>
        </div>
        <!-- Map -->
        <div class="map-wrapper">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.123456789!2d-74.0059413!3d40.7127753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQyJzQ2LjAiTiA3NMKwMDAnMjEuNCJX!5e0!3m2!1sen!2sus!4v1234567890"
            width="100%"
            height="100%"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            style="border: 0px"
          ></iframe>
        </div>
      </div>
    </div>
</section>
