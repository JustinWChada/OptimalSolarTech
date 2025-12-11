<?php
session_start();
require_once '../config/users_db.php';

$user_id = $_GET['user_id'] ?? $_SESSION['user_id'];

?>

<link rel="stylesheet" href="css/edit_profile.css">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="?dashboard"><i class="bi bi-box-seam-fill"></i> Dashboard</a>
            <a href="?profile" class="btn btn-outline-light">
                <i class="bi bi-arrow-left-circle"></i> Back to Profile
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="edit-profile-container">

                    <header class="text-center mb-4">
                        <h1 class="fw-bold text-dark">Update Profile</h1>
                        <p class="lead text-secondary">Fill in the details for updating your profile.</p>
                    </header>
                    <?php

                        // Fetch the user data from the database
                        $sql = "SELECT * FROM users WHERE user_id = ?";
                        $stmt = $OstUsersConn->prepare($sql);
                        $stmt->bind_param("i", $user_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $user = $result->fetch_assoc();
                        if (!$user) {
                            echo "<div class='alert alert-danger'>User not found.</div>";
                            exit;
                        }else{
                        ?>

                        <form id="updateProfileForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="update_profile">

                            <div class="form-group">
                                <label for="username">
                                    <i class="bi bi-person-check"></i> Username:
                                </label>
                                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="username">
                                    <i class="bi bi-envelope"></i> Email:
                                </label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="username">
                                    <i class="bi bi-lock"></i> Password:
                                </label>
                                <input type="password" class="form-control" name="password" placeholder="Leave empty if no password change">
                            </div>    

                            <div class="form-group">
                                <label for="username">
                                    <i class="bi bi-person"></i> First Name:
                                </label>
                                <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                            </div>  
                            
                            <div class="form-group">
                                <label for="username">
                                    <i class="bi bi-person"></i> Last Name:
                                </label>
                                <input type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                            </div>  

                            <div class="form-group">
                                <label for="user_phone">
                                    <i class="bi bi-phone"></i> Phone:
                                </label>
                                <input type="text" class="form-control" name="user_phone" value="<?php echo htmlspecialchars($user['user_phone']); ?>" required>
                            </div>  

                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-arrow-counterclockwise"></i> Update Profile
                            </button>

                        </form>
                        <?php } ?> 
                </div>
            </div>
        </div>
    </div>

<script src="js/edit_profile.js"></script>