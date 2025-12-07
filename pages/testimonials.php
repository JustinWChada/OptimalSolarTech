<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Optimal Solar Tech</title>
    <!-- Load Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Remix Icons (for ri-tools-line) and Bootstrap Icons (for bi-list) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../css/index.css" type= "text/css">
    <link rel="stylesheet" href="../css/nav.css" type= "text/css">
    <link rel="stylesheet" href="../css/nav_quote_modal.css" type= "text/css">
    <link rel="stylesheet" href="../css/index_social_control.css" type= "text/css">
    <link rel="stylesheet" href="../css/footer.css" type= "text/css">
    <link rel="stylesheet" href="../css/testimonials.css" type= "text/css">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <?php include("../includes/nav.php"); ?>
  </nav>

  <!-- Hero Section with Background Image -->
  <div class="relative hero-section">
      <div class="hero-content">
          <div class="hero-text-inner">
              <h1>Testimonials</h1>
              <p >
                  Get inspired and assurance from some testimonials from satified clients who love our services.
              </p>
          </div>
      </div>
  </div>
            
            <div class="relative container testimonial-container my-5">
              <!-- Testimonial Card 1 -->
              <div class="testimonial-card">
                <div class="star-rating">
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                </div>
                <p class="quote-text">
                  "Excellent service! They installed our new AC unit quickly and
                  professionally. The team was courteous and cleaned up after
                  themselves. Highly recommended!"
                </p>
                <div class="customer-info">
                  <img
                    alt="Sarah Johnson"
                    class="customer-avatar"
                    src="https://placehold.co/48x48/C1E1C1/000?text=SJ"
                  />
                  <div>
                    <h4 class="customer-name">Sarah Johnson</h4>
                    <p class="customer-title">Homeowner</p>
                  </div>
                </div>
              </div>

              <!-- Testimonial Card 2 -->
              <div class="testimonial-card">
                <div class="star-rating">
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                </div>
                <p class="quote-text">
                  "Optimal Solar Tech handled our commercial solar installation perfectly.
                  Great communication throughout the project and excellent workmanship.
                  Very satisfied with the results."
                </p>
                <div class="client-info">
                  <img
                    alt="Michael Chen"
                    class="client-avatar"
                    src="https://placehold.co/48x48/C1E1C1/000?text=MC"
                  />
                  <div>
                    <h4 class="client-name">Michael Chen</h4>
                    <p class="client-title">Business Owner</p>
                  </div>
                </div>
              </div>

              <!-- Testimonial Card 3 -->
              <div class="testimonial-card">
                <div class="star-rating">
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                  <i class="ri-star-fill star-icon"></i>
                </div>
                <p class="quote-text">
                  "We use Optimal Solar Tech for all our electrical and plumbing needs across
                  multiple properties. They are reliable, professional, and always
                  deliver quality work on time."
                </p>
                <div class="client-info">
                  <img
                    alt="Emily Rodriguez"
                    class="client-avatar"
                    src="https://placehold.co/48x48/C1E1C1/000?text=ER"
                  />
                  <div>
                    <h4 class="client-name">Emily Rodriguez</h4>
                    <p class="client-title">Property Manager</p>
                  </div>
                </div>
              </div>

            </div>

    <?php 
        include "../includes/nav_quote_modal.php";
        include "../includes/index_social_control.php";     
    ?>

    <footer>
      <?php include "../includes/footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
      integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <script src="../js/nav_quote_modal.js" type="text/javascript"></script>
      <script src="../js/index_free_estimate.js" type="text/javascript"></script>
      <script src="../js/index_social_control.js" type="text/javascript"></script>

</body>
</html>
