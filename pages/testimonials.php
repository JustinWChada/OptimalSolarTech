<?php
  require "../config/miscellanea_db.php";
?>

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

              <!-- Testimonial Cards -->
              <?php
              $sql = "SELECT rating, customer_email, customer_name, customer_title, description FROM testimonials WHERE status = 'accepted'";
              $result = $OstMiscellaneaConn->query($sql);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $name = $row['customer_name'];
                    $first_name_initial = substr($name[0], 0, 1);
                    $last_name_initial = substr($name[1], 0, 1);
                          
                      ?>
                      <div class="testimonial-card">
                        <div class="star-rating">
                          <?php
                          for ($i = 1; $i <= 5; $i++) {
                              if ($row['rating'] >= $i) {
                                  echo "<i class='ri-star-fill star-icon'></i>";
                              } else {
                                  echo "<i class='ri-star star-icon'></i>";
                              }
                          }
                          ?>
                        </div>
                        <p class="quote-text">
                          <?php echo $row['description']; ?>
                        </p>
                        <div class="client-info">
                          <img
                            alt="<?php echo $row['customer_name']; ?>"
                            class="customer-avatar"
                            src="https://placehold.co/48x48/C1E1C1/000?text=<?php echo $first_name_initial.$last_name_initial; ?>"
                          />
                        
                          <div class="mx-2>
                            <h4 class="client-name"><?php echo $row['customer_name']; ?></h4>
                            <p class="client-title"><?php echo $row['customer_title']; ?></p>
                          </div>
                        </div>
                      </div>
                      <?php
                  }
              }
              ?>

            </div>

            <header class="text-center mb-4">
                <h1 class="display-4 fw-bold">Leave us a review</h1>
                <p class="lead text-secondary">If you have been satisfied with our services kidly leave us a review. If not please let us know (through a <a href="#testimonials" data-bs-toggle='modal' data-bs-target='#reviewModal'>review</a> or contact us <a href="../pages/#contact">here</a>).</p>
                <hr class="w-25 mx-auto">
                <a href="#testimonials" data-bs-toggle='modal' data-bs-target='#reviewModal' class="btn btn-outline-success">Leave a Review</a>
            </header>

            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="reviewModalLabel">Leave a Review</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div id="ajaxAlert" class="alert alert-dismissible fade show" role="alert"></div>
                      <form id="reviewForm">
                          <div class="modal-body">
                              <input type="hidden" id="projectId" name="projectId" value = "5">
                              <label for="">Select:</label>
                              <div class="rating-stars">
                                  <input type="hidden" id="rating" name="review_rating" value ="5">
                                  <button type="button" class="btn btn-small" id="star1" data-rating="1"><i class="bi bi-star text-warning"></i></button>
                                  <button type="button" class="btn btn-small" id="star2" data-rating="2"><i class="bi bi-star text-warning"></i></button>
                                  <button type="button" class="btn btn-small" id="star3" data-rating="3"><i class="bi bi-star text-warning"></i></button>
                                  <button type="button" class="btn btn-small" id="star4" data-rating="4"><i class="bi bi-star text-warning"></i></button>
                                  <button type="button" class="btn btn-small" id="star5" data-rating="5"><i class="bi bi-star text-warning"></i></button>
                              </div>
                              <br>
                              <textarea class="form-control" id="reviewText" name="review_text" rows="3" placeholder="Your review..." required></textarea>
                              <br>
                              
                              <div class="mb-3">
                                  <label for="customer_email" class="form-label">Your Email:</label>
                                  <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="etc. johndoe123@gmail.com" required>
                              </div>
                              <div class="mb-3">
                                  <label for="customer_name" class="form-label">Your Name:</label>
                                  <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="etc. John Doe" required>
                              </div>
                              <div class="mb-3">
                                  <label for="customer_title" class="form-label">Your Title</label>
                                  <input type="text" class="form-control" id="customer_title" name="customer_title" placeholder="etc. Manager, Home Owner" required>
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>

    <?php 
        include "../includes/nav_quote_modal.php";
        include "../includes/index_social_control.php";   
        include "../includes/emergencies.php";  
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
      <script src="../js/emergencies.js"></script>
      <script src="../js/testimonials.js"></script>
      
</body>
</html>
