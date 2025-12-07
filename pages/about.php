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
    <link href="../css/about.css" type= "text/css" rel="stylesheet">
    <link href="../css/footer.css" type= "text/css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <?php include '../includes/nav.php'; ?>
    </nav>


    <!-- About Section -->
    <section class="about-section">
        <!-- <div class="wave-container">
            <div class="wave"></div>
            <div class="wave"></div>
        </div> -->
        <div class="container">
            <h1 class="text-center">About Optimal Solar Tech</h1>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="about-image">
                        <img src="../images/wave.png" alt="About Us Image" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-content">
                        <p>Welcome to Optimal Solar Tech ! We are a team of dedicated and experienced
                            electricians committed to providing top-notch electrical services to our community. With
                            years of experience under our belts, we've built a reputation for reliability,
                            professionalism, and exceptional customer service.</p>
                        <p>Our mission is simple: to provide safe, efficient, and affordable electrical solutions
                            for
                            residential, commercial, and industrial clients. Whether you need a simple repair, a
                            complex installation, or a complete electrical overhaul, we've got you covered.</p>
                        <p>We pride ourselves on our commitment to safety, quality, and customer satisfaction. Our
                            licensed and insured electricians adhere to the highest industry standards and are
                            equipped
                            with the latest tools and technology to get the job done right, the first time.</p>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 class="text-center">Meet Our Expert Team</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="team-member">
                        <img src="../images/wave.png" alt="Team Member 1">
                        <h3>Clansman Mukuvari</h3>
                        <p>Technician</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-member">
                        <img src="../images/lights.jpg" alt="Team Member 2">
                        <h3>Othe Team Member</h3>
                        <p>Other Post</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <h2 class="text-center">Our Mission</h2>
            <p class="text-center">At Optimal Solar Tech, our mission is to provide reliable, safe, and
                innovative electrical solutions that exceed our clients' expectations. We strive to be the leading
                electrical service provider in our community, known for our commitment to quality, integrity, and
                customer satisfaction.</p>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <h2 class="text-center">Our Core Values</h2>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <ul>
                        <li><strong>Safety:</strong> We prioritize safety above all else, ensuring a secure
                            environment
                            for our employees and clients.</li>
                        <li><strong>Quality:</strong> We are committed to delivering exceptional workmanship and
                            using
                            the highest quality materials.</li>
                        <li><strong>Integrity:</strong> We conduct our business with honesty, transparency, and
                            ethical
                            practices.</li>
                        <li><strong>Customer Satisfaction:</strong> We are dedicated to providing friendly,
                            responsive,
                            and reliable service that meets or exceeds our clients' needs.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <?php
        include "../includes/nav_quote_modal.php";   
        include "../includes/index_social_control.php"; 
    ?>

    <footer>
        <?php include '../includes/footer.php'; ?>
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