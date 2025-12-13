$.ajax({
  type: 'POST',
  url: 'testimonials/query_testimonials.php',
  data: { action: 'fetch_testimonials' },
  dataType: 'json',
  success: function (response) {
    let html = '';
    // console.log(response) //remove this commented or not
    response.forEach(testimonial => {
      let stars = '';
      for (let i = 1; i <= 5; i++) {
        if (i <= testimonial.rating) {
          stars += '<i class="bi bi-star-fill text-warning"></i>';
        } else {
          stars += '<i class="bi bi-star-fill text-secondary"></i>';
        }
      }
      let statusOptions = `
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="testimonialStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            ${testimonial.status.charAt(0).toUpperCase() + testimonial.status.slice(1)}
          </button>
          <ul class="dropdown-menu" aria-labelledby="testimonialStatusDropdown">
            <li><a class="dropdown-item" href="#" data-status="pending" onclick="updateTestimonialStatus(${testimonial.id}, 'pending')">Pending</a></li>
            <li><a class="dropdown-item" href="#" data-status="accepted" onclick="updateTestimonialStatus(${testimonial.id}, 'accepted')">Accept</a></li>
            <li><a class="dropdown-item" href="#" data-status="rejected" onclick="updateTestimonialStatus(${testimonial.id}, 'rejected')">Reject</a></li>
          </ul>
        </div>
      `;
      html += `
        <div class="testimonial-card">
          <div class="rating">
            ${stars}
          </div>
          <p class="testimonial-description">${testimonial.description}</p>
          <div class="testimonial-info">
            <p>${testimonial.customer_name} - ${testimonial.customer_title}</p>
            <p>${testimonial.customer_email}</p>
          </div>
          ${statusOptions}
        </div>
      `;
    });

    $('#testimonials-list-container').html(html);
  },
  error: function (xhr, status, error) {
    console.error('Error fetching testimonials:', xhr.responseText);
  }
});

function updateTestimonialStatus(testimonialId, status) {
  $.ajax({
    type: 'POST',
    url: 'testimonials/query_testimonials.php',
    data: { action: 'update_testimonial_status', testimonial_id: testimonialId, status: status },
    dataType: 'json',
    success: function (response) {
      if (response.success) {
        alert(`Testimonial ${testimonialId} status updated to ${status}`);
      } else {
        alert(`Error updating testimonial ${testimonialId} status:`, response.message);
      }
    },
    error: function (xhr, status, error) {
      console.error('Error updating testimonial status:', xhr.responseText);
    }
  });
}
