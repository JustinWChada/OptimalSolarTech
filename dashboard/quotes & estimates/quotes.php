<link rel="stylesheet" href="css/quotes_free_estimates.css" type="text/css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="?quotes"><i class="bi bi-box-seam-fill"></i> Quotes</a>
        <div class="d-flex">
            <a href="?free_estimates" class="btn btn-success">
                <i class="bi bi-plus-circle-fill"></i> Free Estimates
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <header class="text-center mb-4">
        <h1 class="display-4 fw-bold">Active Quotes</h1>
        <p class="lead text-secondary">View and manage all your quote entries.</p>
        <hr class="w-25 mx-auto">
    </header>

    <div id="quotes-list-container">
        <?php

        require_once '../config/miscellanea_db.php';

        // Fetch data from the quotes table
        $stmt = $OstMiscellaneaConn->prepare("SELECT * FROM quotes");
        $stmt->execute();
        $result = $stmt->get_result();

        // Display the data
        while ($row = $result->fetch_assoc()) {
            echo "<div class='fq-card position-relative' onclick='toggleDetails(this)'>";
            echo "<div class='card-header'>";
            echo "<div class='primary-info'>";
            echo "<span class='name'>" . $row['name'] . "</span>";
            echo "<span class='phone'>" . $row['phone'] . "</span>";
            echo "<div class='delete-button' onclick='deleteQuote(" . $row['id'] . ")'>";
            echo "<i class='bi bi-trash delete-icon'></i>";
            echo "</div>";
            echo "</div>";
            echo "<i class='expand-icon'></i>";
            echo "</div>";
            echo "<div class='card-details'>";
            echo "<p><strong>Service:</strong> " . $row['service'] . "</p>";
            echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
            echo "<p><strong>Created:</strong> " . date('F j, Y, g:i a', strtotime($row['created_at'])) . "</p>";
            echo "</div>";
            echo "</div>";
        }

        $stmt->close();
        $OstMiscellaneaConn->close();
        ?>
    </div>
</div>

<script src="js/quotes.js"></script>
