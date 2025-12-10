<link rel="stylesheet" href="css/projects.css" type="text/css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="?projects"><i class="bi bi-box-seam-fill"></i> Project Portfolio</a>
        <div class="d-flex">
            <a href="?add_projects" class="btn btn-success">
                <i class="bi bi-plus-circle-fill"></i> New Project
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <header class="text-center mb-4">
        <h1 class="display-4 fw-bold">Active Projects</h1>
        <p class="lead text-secondary">View, edit, and manage all your portfolio entries.</p>
        <hr class="w-25 mx-auto">
    </header>

    <div id="project-list-container" class="row">
    </div>
</div>

<div class="modal fade" id="imageCarouselModal" tabindex="-1" aria-labelledby="imageCarouselLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageCarouselLabel">Project Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="imageCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
                    <div class="carousel-indicators">
                        </div>
                    <div class="carousel-inner">
                        </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/projects.js"></script>
