
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
    <link rel="stylesheet" href="../css/projects.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <?php include "../includes/nav.php"; ?>
    </nav>
 
        <!-- Project Section -->
        <section class="projects-section">
            <h2>Our Recent Projects</h2>
                
            <div class="project-card row g-2">
                <div class="project-img-container col-md-6">
                    <div id="projectCarousel" class="project-carousel carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="rowx">
                                    <div class="col-md-12">
                                        <img src="../images/pic1-home.PNG" class="d-block w-100"
                                            alt="Alt">
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="../images/pic2-services.PNG" class="d-block w-100"
                                            alt="Alt">
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="../images/pic3.PNG" class="d-block w-100"
                                            alt="Alt">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="recent-project-title">OOPS! An Error Occurred</h3>
                                                <p>Unfortunatle No Image For This Project Is Available</p>
                                            </div>
                                        </div>
                            </div>
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="project-content col-md-6">
                    <div class="project-details">
                        <h4 class="project-title">Project Title: Title 101</h4>
                        <h4 class="">Project Place: This is the place</h4>
                        <h4>Project Date: 2025-10-01 13:34:00</h4>
                        <h4>Project Reviews:  None</h4>
                        <h4>Project Core Team</h4>
                    </div>
                    <p>  
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    
                    </p>
                    <div class="project-controls p-2 m-2">
                        <button class="btn btn-outline-warning"><i class="bi bi-star-fill star-icon"></i></button>
                        <button class="btn btn-outline-primary"><i class="bi bi-phone star-icon"></i></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- More -->
        <section class="more-work">
            <div class="container">
                <h2 class="text-center">More of Our Work</h2>

                <!-- Placeholder Message -->
                <div class="text-center">
                    <p>We are currently building our project portfolio. Please check back soon for updates!</p>
                </div>
            </div>
        </section>

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
      <script src="../js/index_social_control.js" type="text/javascript"></script>
</body>

</html>
