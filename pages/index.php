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
    <link href="../css/index.css" type= "text/css" rel="stylesheet">
    <link href="../css/nav.css" type= "text/css" rel="stylesheet">
    <link href="../css/nav_quote_modal.css" type= "text/css" rel="stylesheet">
    <link href="../css/index_social_control.css" type= "text/css" rel="stylesheet">
    <link href="../css/index_hero.css" type= "text/css" rel="stylesheet">
    <link href="../css/index_why_us.css" type= "text/css" rel="stylesheet">
    <link href="../css/index_services.css" type= "text/css" rel="stylesheet">
    <link href="../css/index_quotes.css" type= "text/css" rel="stylesheet">
    <link href="../css/index_testimonials.css" type= "text/css" rel="stylesheet">
    <link href="../css/index_contact.css" type= "text/css" rel="stylesheet">
    <link href="../css/footer.css" type= "text/css" rel="stylesheet">
    
  </head>

  <body>
    <nav class="navbar navbar-expand-lg">
      <?php include("../includes/nav.php"); ?>
    </nav>

    <div class="mobile-sticky-cta">
        <a href="tel:+263777000000" class="btn btn-outline-success w-50"><i class="ri-phone-fill"></i> Call</a>
        <button class="btn btn-success w-50" data-bs-toggle="modal" data-bs-target="#quoteModal">Get Quote</button>
    </div>

    <a href="https://wa.me/263777000000" target="_blank" class="whatsapp-widget" title="Chat on WhatsApp">
        <div class="whatsapp-pulse"></div>
        <i class="ri-whatsapp-line"></i>
    </a>

    <section class="container-fluid main">
      <?php 
        include "index_hero.php"; 
        include "index_why_us.php";
        include "index_services.php";

        echo '
        <div class="container my-5 reveal">
            <div class="bg-primary text-white p-5 rounded-4 text-center" style="background: linear-gradient(45deg, #0d9488, #115e59);">
                <h2>Curious about Solar Savings?</h2>
                <p>Find out how much you could save on your energy bill in seconds.</p>
                <button class="btn btn-warning btn-lg fw-bold mt-2" data-bs-toggle="modal" data-bs-target="#solarCalcModal">
                    <i class="ri-calculator-line"></i> Calculate My Savings
                </button>
            </div>
        </div>';

        include "index_quotes.php"; 
        include "index_testimonials.php";     
        include "index_contact.php";
        include "../includes/nav_quote_modal.php";     
        include "../includes/index_free_estimate_modal.php"; 
        include "../includes/solar_calculator_modal.php";    
        include "../includes/index_social_control.php";
        include "../includes/emergencies.php";
        //include "../includes/lead_modal.php";
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
      <script src="../js/contact.js" type="text/javascript"></script>
      <script src="../js/emergencies.js" type="text/javascript"></script>
      <script src="../js/main_interactions.js"></script>
  </body>
</html>












