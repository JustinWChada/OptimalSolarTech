

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="?available_projects"><i class="bi bi-box-seam-fill"></i> Project Portfolio</a>
            <div class="d-flex">
                <a href="?available_projects" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left-circle"></i> Back to List
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <header class="text-center mb-4">
            <h1 class="fw-bold text-dark">Add a New Project</h1>
            <p class="lead text-secondary">Fill in the details for your new portfolio entry.</p>
        </header>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <form id="insertProjectForm" method="POST" enctype="multipart/form-data">
                        
                        <h4 class="mb-3 text-success"><i class="bi bi-journal-check"></i> Project Details</h4>
                        <div class="mb-3">
                            <label for="title" class="form-label">Project Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="place" class="form-label">Location/Place</label>
                                <input type="text" class="form-control" id="place" name="place" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Completion Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>
                        
                        <hr>
                        
                        <h4 class="mb-3 text-success"><i class="bi bi-people-fill"></i> Team Members</h4>
                        <div id="teamMembersContainer">
                            <div class="row g-3 align-items-center team-member-input mb-2">
                                <div class="col-5">
                                    <input type="text" name="member_name[]" class="form-control" placeholder="Member Name" required>
                                </div>
                                <div class="col-5">
                                    <input type="text" name="member_role[]" class="form-control" placeholder="Role (e.g., Architect)" required>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-outline-danger disabled">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mb-4" onclick="addTeamMember()">
                            <i class="bi bi-person-plus-fill"></i> Add Another Team Member
                        </button>
                        
                        <hr>

                        <h4 class="mb-3 text-success"><i class="bi bi-images"></i> Project Images</h4>
                        <div id="imageUploadsContainer">
                            <div class="row g-3 align-items-center image-upload-input mb-2">
                                <div class="col-5">
                                    <input type="file" name="project_image[]" class="form-control" accept="image/*" required>
                                </div>
                                <div class="col-5">
                                    <input type="text" name="image_alt[]" class="form-control" placeholder="Image Alt Text (Optional)">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-outline-danger disabled">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mb-5" onclick="addImageUpload()">
                            <i class="bi bi-plus-circle"></i> Add Another Image
                        </button>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg btn-outline-success">
                                <i class="bi bi-cloud-upload-fill"></i> Insert Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/projects.js"></script>
