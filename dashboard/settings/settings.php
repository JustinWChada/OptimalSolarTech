<link rel="stylesheet" href="css/settings.css" type="text/css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="?settings"><i class="bi bi-box-seam-fill"></i> Settings Portfolio</a>
        <div class="d-flex">
            <a href="?users" class="btn btn-success mx-1">
                <i class="bi bi-plus-circle-fill"></i> System Users
            </a>
            <a href="#settings" class="btn btn-success mx-1" data-bs-toggle='modal' data-bs-target='#userTokenModal'>
                <i class="bi bi-plus-circle-fill"></i> Get User Token
            </a>
            <a href="#settings" class="btn btn-success mx-1" data-bs-toggle='modal' data-bs-target='#adminPasswordModal' >
                <i class="bi bi-plus-circle-fill"></i> Get Admin Password
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <header class="text-center mb-4">
        <h1 class="display-4 fw-bold">Settings Portfolio</h1>
        <p class="lead text-secondary">View, edit, and manage all your administrations.</p>
        <hr class="w-25 mx-auto">
    </header>

    <div id="project-list-container" class="row">
    </div>
</div>

<!-- User Token Modal -->
<div class="modal fade" id="userTokenModal" tabindex="-1" aria-labelledby="userTokenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userTokenModalLabel">Enter Requisite Credentials</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="ajaxAlertUserToken" class="alert alert-dismissible fade show" role="alert"></div>
            <form id="userTokenForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Admin Password:</label>
                        <input type="password" class="form-control" id="admin_password" name="token_admin_password" placeholder="" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_email" class="form-label">User Email:</label>
                        <input type="email" class="form-control" id="user_email" name="token_user_email" placeholder="username@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_password" class="form-label">User Password:</label>
                        <input type="password" class="form-control" id="user_password" name="token_user_password" placeholder="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Admin Pass Modal -->
<div class="modal fade" id="adminPasswordModal" tabindex="-1" aria-labelledby="adminPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminPasswordModalLabel">Enter Requisite Credentials</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="ajaxAlertAdminPassword" class="alert alert-dismissible fade show" role="alert"></div>
            <form id="adminPasswordForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_email" class="form-label">Your User Email:</label>
                        <input type="email" class="form-control" id="admin_pass_user_email" name="admin_pass_user_email" placeholder="username@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_password" class="form-label">Your User Password:</label>
                        <input type="password" class="form-control" id="admin_pass_user_password" name="admin_pass_user_password" placeholder="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="js/settings.js"></script>