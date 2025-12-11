
<link rel="stylesheet" href="css/profile.css">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html"><i class="bi bi-box-seam-fill"></i> Dashboard</a>
            <a href="?projects" class="btn btn-outline-light">
                <i class="bi bi-arrow-left-circle"></i> Back to Projects
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="profile-container">
                    <div class="text-center p-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading profile...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verification Token Modal -->
    <div class="modal fade" id="verificationTokenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verification Token</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="verification_token_form">
                        <div class="mb-3">
                            <label for="verification-token" class="form-label">Verification Token</label>
                            <input type="text" class="form-control" id="verification-token" name="verification_token" required>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="js/profile.js"></script>