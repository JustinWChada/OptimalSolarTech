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
                    
                </div>
            </div>
        </div>
    </div>

<?php
session_start();
require_once '../config/users_db.php';

// Start the form
echo '<form action="profile/update_profile.php" method="POST" enctype="multipart/form-data">';
echo '<input type="hidden" name="action" value="update_profile">';

// Get the user ID from the URL or session
$user_id = $_GET['user_id'] ?? $_SESSION['user_id'];

// Fetch the user data from the database
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $OstUsersConn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Display the form fields
echo '<label for="username">Username:</label>';
echo '<input type="text" name="username" value="' . htmlspecialchars($user['username']) . '" required>';
echo '<br>';

echo '<label for="email">Email:</label>';
echo '<input type="email" name="email" value="' . htmlspecialchars($user['email']) . '" required>';
echo '<br>';

echo '<label for="password">Password:</label>';
echo '<input type="password" name="password" required>';


echo '<label for="first_name">First Name:</label>';
echo '<input type="text" name="first_name" value="' . htmlspecialchars($user['first_name']) . '" required>';
echo '<br>';

echo '<label for="last_name">Last Name:</label>';
echo '<input type="text" name="last_name" value="' . htmlspecialchars($user['last_name']) . '" required>';
echo '<br>';

// Add more form fields as needed

// Submit button
echo '<input type="submit" value="Update Profile">';
echo '</form>';
?>