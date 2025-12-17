<?php
    require "../config/users_db.php";
?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="?add_user"><i class="bi bi-box-seam-fill"></i> Users Portfolio</a>
        <div class="d-flex">
            <a href="?add_user" class="btn btn-success">
                <i class="bi bi-plus-circle-fill"></i> Add User
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <header class="text-center mb-4">
        <h1 class="display-4 fw-bold">Active Users</h1>
        <p class="lead text-secondary">View all your active user entries.</p>
        <hr class="w-25 mx-auto">
    </header>

    <div id="project-list-container" class="row">
        <div class="table-responsive">
            <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Is Active</th>
                    <th>Is Verified</th>
                    <th>Created At</th>
                    <th>Last Login</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $result = $OstUsersConn->query($sql);
            if ($result->num_rows > 0) {
                while ($user = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['user_phone']); ?></td>
                        <td><?php echo $user['is_active'] ? '<i class="bi bi-check-circle text-success"></i>' : '<i class="bi bi-x-circle text-danger"></i>'; ?></td>
                        <td><?php echo $user['is_verified'] ? '<i class="bi bi-check-circle text-success"></i>' : '<i class="bi bi-x-circle text-danger"></i>'; ?></td>
                        <td><?php echo date('F j, Y, g:i a', strtotime($user['created_at'])); ?></td>
                        <td><?php echo date('F j, Y, g:i a', strtotime($user['last_login'])); ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
