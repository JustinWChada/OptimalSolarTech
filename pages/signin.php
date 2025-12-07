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
    <link href="../css/signin.css" type= "text/css" rel="stylesheet">
    <link href="../css/index.css" type= "text/css" rel="stylesheet">
    <link href="../css/footer.css" type= "text/css" rel="stylesheet">
  </head>

  <body>
    <main class="main"> 
        <form class="form-signin w-100 m-auto" auto-complete="off"> 
            <img class="mb-4" src="../images/lights.jpg" alt="" width="72" height="57"> 
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1> 
            <div class="form-floating"> 
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" auto-complete="off"> 
                <label for="floatingInput">Email address</label> 
            </div> 
            <div class="form-floating"> 
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" auto-complete="off"> 
                <label for="floatingPassword">Password</label> 
            </div> 
            <div class="form-check text-start my-3"> 
                <input class="form-check-input" type="checkbox" value="remember-me" id="checkDefault"> 
                <label class="form-check-label" for="checkDefault">Remember me</label> 
            </div> 
            <button class="btn btn-submit w-100 py-2" type="submit">Sign in</button> 
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2025</p> 
        </form> 
    </main>

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

  </body>
</html>

