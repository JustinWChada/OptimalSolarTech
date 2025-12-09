<?php
    require_once "../config/miscellanea_db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="/vite.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Service Name Here</title>
    <!-- Load Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Remix Icons (for ri-tools-line) and Bootstrap Icons (for bi-list) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- custom css -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/service_desc.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">
    
</head>
<body>
    <section class="service-container py-5">
        <div class="container">
            <?php
            // Fetch service data from URL parameter
            $serviceId = isset($_GET['id']) ? intval($_GET['id']) : 1;

            // Fetch service details
            $serviceQuery = "SELECT * FROM services WHERE service_id = ?";
            $stmt = $OstMiscellaneaConn->prepare($serviceQuery);
            $stmt->bind_param("i", $serviceId);
            $stmt->execute();
            $serviceResult = $stmt->get_result();
            $service = $serviceResult->fetch_assoc();

            // Fetch service images
            $imagesQuery = "SELECT * FROM services_images WHERE service_id = ? ORDER BY service_id ASC";
            $stmt = $OstMiscellaneaConn->prepare($imagesQuery);
            $stmt->bind_param("i", $serviceId);
            $stmt->execute();
            $imagesResult = $stmt->get_result();
            ?>

            <h2 class="section-title text-center fw-bold m-2"><?php echo htmlspecialchars($service['service_title'] ?? 'Service Title'); ?></h2>
            <br>
            <div id="serviceCarousel" class="service-carousel carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $isActive = true;
                    while ($image = $imagesResult->fetch_assoc()) {
                        $activeClass = $isActive ? 'active' : '';
                        ?>
                        <div class="carousel-item <?php echo $activeClass; ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="../files/uploads/services/<?php echo htmlspecialchars($image['service_img_path']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($image['alt_text'] ?? 'Service image'); ?>">
                                </div>
                            </div>
                        </div>
                        <?php
                        $isActive = false;
                    }
                    ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <br>
            <div class="service-description">
                <p>
                    <?php echo htmlspecialchars($service['service_description'] ?? 'Service description not available'); ?>
                </p>
            </div>
        </div>
    </section>

    <footer>
      <?php include "../includes/footer.php"; ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
      integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</body>
</html>