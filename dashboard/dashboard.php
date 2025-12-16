<?php
session_start();

require "verify.php";

// Check if user is authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: session_destroy.php');
    exit();
}

// $id = $_SESSION['user_id'];

// // require "config/users_db.php";

// // $query = "SELECT is_active, is_verified FROM users WHERE user_id = ?";
// // $stmt = $OstUsersConn->prepare($query);
// // $stmt->bind_param("i", $id);
// // $stmt->execute();
// // $result = $stmt->get_result();
// // $user = $result->fetch_assoc();


// // if ($user['is_active'] != 1 || $user['is_verified'] != 1) {
// //     //header("location: ?profile");
// // }



?>

<!DOCTYPE html>
  <html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Dashboard - Optimal Solar Tech</title>
    <!-- Load Inter font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Load Remix Icons (for ri-tools-line) and Bootstrap Icons (for bi-list) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- custom css -->
    <link href="css/dashboard.css" type= "text/css" rel="stylesheet">
    <link href="css/sidebar.css" type= "text/css" rel="stylesheet">
    <link href="css/navbar.css" type= "text/css" rel="stylesheet">
  </head>

  <body>
    <section class="container-fluid g-0">
      <div class="row g-0">
        <div class="col-md-2 g-0 m-0 sidebar-container">
          <?php include 'structure/sidebar.php'; ?>
        </div>
        <div class="col-md-10 g-0 position-relative p-0">
          <div class="row g-0">
            <?php include 'structure/navbar.php'; ?>
          </div>
          <div class="row g-0 dashboard-content" id="dashboardContent">
            <!-- Data will be shown here -->
          </div>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
      integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="js/dashboard.js"></script>
    <script src="js/navigation.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/sidebar.js"></script>
  </body>
</html>












