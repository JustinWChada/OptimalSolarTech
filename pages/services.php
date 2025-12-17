<?php
    require_once "../config/miscellanea_db.php";
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
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/nav_quote_modal.css" type= "text/css">
    <link href="../css/index_social_control.css" type= "text/css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../css/services_animation.css"> -->
    <link rel="stylesheet" href="../css/services.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <?php include "../includes/nav.php"; ?>
    </nav>

    
    <main>
        <!-- Hero Section ie animation
        <section class="bg-gray-50 m-0 p-0 overflow-hidden">
            <?php //include "services_animation.php" ?>
        </section> -->

        <!-- Services Section -->
        <section class="services-section">
            <div class="container">
                <h2 class="text-center">What We Offer</h2>
                <div class="row g-4">

                    <!-- Fetching services in addition to previously existing services -->
                    <?php
                        $service_query = "SELECT service_id, service_title, service_description FROM services WHERE status = 'active' ";
                        $service_result = $OstMiscellaneaConn->query($service_query);

                        if ($service_result->num_rows > 0) {
                            while ($service_row = $service_result->fetch_assoc()) {
                                $service_id = $service_row['service_id'];
                                $service_title = $service_row['service_title'];
                                $service_description = $service_row['service_description'];
                                echo '
                                    <div class="col-md-6">
                                        <div class="service-card">
                                            <h3 class="service-card-title">
                                                ' . htmlspecialchars($service_title) . '
                                            </h3>
                                            <p class="service-card-description">
                                                <small class="small-desc">Short Description:</small> <br/>
                                                ' . htmlspecialchars($service_description) . '
                                            </p>
                                            <a href="services_desc?' . urlencode($service_title) . '&id='.urlencode($service_id).'" class="card-link service-learn-more">
                                                Learn More →
                                            </a>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
        </section>

        <!-- Sectors Section -->
        <section class="sectors-section">
            <div class="container">
                <h2 class="text-center">Sectors We Serve</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="sector-card">
                            <i class="bi bi-house-door-fill"></i>
                            <h3>Domestic</h3>
                            <p>Comprehensive electrical services for residential properties, ensuring safety and
                                efficiency.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sector-card">
                            <i class="bi bi-shop"></i>
                            <h3>Commercial</h3>
                            <p>Tailored electrical solutions for businesses of all sizes, from offices to retail spaces.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sector-card">
                            <i class="bi bi-buildings"></i>
                            <h3>Industrial</h3>
                            <p>Specialized electrical services for industrial facilities, ensuring reliability and
                                compliance
                                with industry standards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
      <script src="../js/index_social_control.js" type="text/javascript"></script>
      <script src="../js/emergencies.js"></script>
</body>

</html>