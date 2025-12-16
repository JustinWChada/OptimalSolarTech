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