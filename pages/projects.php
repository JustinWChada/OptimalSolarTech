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
                
            <?php

                $projects = array();
                $query = "SELECT id, title, place, date, description FROM projects ORDER BY date DESC, id DESC";
                $results = $OstMiscellaneaConn->query($query);

                while ($row = $results->fetch_assoc()) {
                    $id = $row['id'];

                    $projects[$id] = [
                        'id' => $id,
                        'title' => $row['title'],
                        'place' => $row['place'],
                        'date' => $row['date'],
                        'description' => $row['description'],
                        'images' => array(),
                        'team' => array(),
                        'reviews' => array()
                    ];

                    // Fetch images
                    $query = "SELECT image_path, alt_text FROM project_images WHERE project_id = ? ORDER BY project_id ASC";
                    $stmt = $OstMiscellaneaConn->prepare($query);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $imagesResult = $stmt->get_result();
                    while ($imagesRow = $imagesResult->fetch_assoc()) {
                        $projects[$id]['images'][] = [
                            'image_path' => $imagesRow['image_path'],
                            'alt_text' => $imagesRow['alt_text']
                        ];
                    }

                    // Fetch team members
                    $query = "SELECT member_name, role FROM project_team_members WHERE project_id = ? ORDER BY project_id ASC";
                    $stmt = $OstMiscellaneaConn->prepare($query);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $teamResult = $stmt->get_result();
                    while ($teamRow = $teamResult->fetch_assoc()) {
                        $projects[$id]['team'][] = [
                            'member_name' => $teamRow['member_name'],
                            'role' => $teamRow['role']
                        ];
                    }

                    // Fetch reviews
                    $query = "SELECT SUM(rating) as total_rating, COUNT(rating) as review_count FROM project_reviews WHERE project_id = ?";
                    $stmt = $OstMiscellaneaConn->prepare($query);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $reviewsResult = $stmt->get_result();
                    $reviewsRow = $reviewsResult->fetch_assoc();
                    $projects[$id]['total_rating'] = $reviewsRow['total_rating'];
                    $projects[$id]['review_count'] = $reviewsRow['review_count'];

                    if ($projects[$id]['review_count'] > 0) {
                        $projects[$id]['average_rating'] = $projects[$id]['total_rating'] / $projects[$id]['review_count'];
                    } else {
                        $projects[$id]['average_rating'] = 0;
                    }

                    echo "<div class='project-card row g-2 my-5'>";
                    echo "<div class='project-img-container col-md-6'>";
                    // Display the images in a carousel
                    echo "<div id='projectCarousel" . $id . "' class='project-carousel carousel slide' data-bs-ride='carousel'>";
                    echo "<div class='carousel-inner'>";
                    $active = "active";
                    if (!empty($projects[$id]['images'])) {
                        $images = $projects[$id]['images'];
                        foreach ($images as $image) {
                            echo "<div class='carousel-item $active'>";
                            echo "<div class='rowx'>";
                            echo "<div class='col-md-12'>";
                            echo "<img src='../files/uploads/projects/" . $image['image_path'] . "' class='d-block w-100' alt='" . $image['alt_text'] . "'>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            $active = "";
                        }
                    } else {
                        echo "<div class='carousel-item'>";
                        echo "<div class='row'>";
                        echo "<div class='col-md-12'>";
                        echo "<img src='../images/placeholder.png' class='d-block w-100' alt='Alt'>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                    ?>
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <?php
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='project-content col-md-6'>";
                    echo "<div class='project-details'>";
                    echo "<h4 class='project-title'>" . $projects[$id]['title'] . "</h4>";
                    echo "<h4 class='project-place'>" . $projects[$id]['place'] . "</h4>";
                    echo "<h4>Project Date: " . $projects[$id]['date'] . "</h4>";
                    echo "<h4>Project Reviews:". $projects[$id]['review_count']." &nbsp;&nbsp;";
                    for ($i = 1; $i <= 5; $i++) {
                        if ($projects[$id]['average_rating'] >= $i) {
                            echo "<i class='bi bi-star-fill text-warning' id='star" . $i . "' data-rating='" . $i . "'></i>";
                        } else {
                            echo "<i class='bi bi-star' id='star" . $i . "' data-rating='" . $i . "'></i>";
                        }
                    }
                    echo "</h4>";
                    echo "<h4>Project Core Team</h4>";
                    echo "</div>";
                    echo "<p>" . $projects[$id]['description'] . "</p>";
                    echo "<div class='project-controls p-2 m-2'>";
                    echo "<button class='btn btn-outline-warning m-1' data-bs-toggle='modal' data-bs-target='#reviewModal' data-project-id='" . $id . "' onclick=\"document.getElementById('projectId').value = '" . $id . "';\"><i class='bi bi-star-fill star-icon'></i></button>";
                    echo "<button class='btn btn-outline-primary m-1'><i class='bi bi-phone star-icon'></i></button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                }
            ?>
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

        <!-- Modal -->
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
                            <input type="hidden" id="projectId" name="projectId">
                            <label for="">Select:</label>
                            <div class="rating-stars">
                                <input type="hidden" id="rating" name="rating" value ="5">
                                <i class="bi bi-star-fill text-warning" id="star1" data-rating="1"></i>
                                <i class="bi bi-star-fill text-warning" id="star2" data-rating="2"></i>
                                <i class="bi bi-star-fill text-warning" id="star3" data-rating="3"></i>
                                <i class="bi bi-star-fill text-warning" id="star4" data-rating="4"></i>
                                <i class="bi bi-star-fill text-warning" id="star5" data-rating="5"></i>
                            </div>
                            <br>
                            <textarea class="form-control" id="reviewText" name="reviewText" rows="3" placeholder="Your review..."></textarea>
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
      <script src="../js/index_social_control.js" type="text/javascript"></script>
      <script src="../js/projects.js" type="text/javascript"></script>
      <script src="../js/emergencies.js"></script>
</body>

</html>
