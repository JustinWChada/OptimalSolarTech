<link rel="stylesheet" href="css/add_user.css">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card modern-card">
                
                <div class="card-header text-center py-3">
                    <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i> Create New User Account</h4>
                </div>

                <div class="card-body p-4">
                    
                    <div id="feedbackMessage" class="alert d-none" role="alert">
                    </div>

                    <form id="userCreationForm">
                        <div class="mb-3">
                            <label for="admin_password" class="form-label fw-bold">Admin Password (Required for Submission)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                                <input type="password" class="form-control" id="admin_password" placeholder="Enter admin password" required>
                            </div>
                            <div class="form-text">This is for administrative control over user creation.</div>
                        </div>
                        
                        <hr>

                        <div id="userDetails">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                    <input type="text" class="form-control" id="username" placeholder="Unique Username" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" class="form-control" id="email" placeholder="Unique Email" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password_hash" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                    <input type="password" class="form-control" id="password_hash" placeholder="Secure Password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control" id="first_name" placeholder="First Name (Optional)">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name (Optional)">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="user_phone" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                    <input type="tel" class="form-control" id="user_phone" placeholder="User Phone (Optional)">
                                </div>
                            </div>

                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" id="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    <i class="bi bi-toggle-on text-success"></i> Is Active?
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-save-fill me-2"></i> Create User
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/add_user.js"></script>
<script>
   
</script>
