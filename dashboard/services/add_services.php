
<link rel="stylesheet" href="css/add_services.css" type="text/css">

<?php
$success_message = '';
if (isset($_GET['services_added']) && $_GET['services_added'] == 1) {
    $success_message = 'Service added successfully!';
}
?>

<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="?available_services"><i class="bi bi-box-seam-fill"></i> Service Portfolio</a>
            <div class="d-flex">
                <a href="?available_services" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left-circle"></i> Back to List
                </a>
            </div>
        </div>
    </nav>

<div class="form-container my-5">
    <header class="text-center mb-4">
        <h1 class="fw-bold text-dark">Add a New Service</h1>
        <p class="lead text-secondary">Fill in the details for your new service entry.</p>
    </header>

    <?php if ($success_message != ''): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
        <i class="bi bi-check-circle"></i> <?php echo $success_message; ?>
    </div>

    <?php endif; ?> 
    

    <form action="services/query_services.php" method="POST" enctype="multipart/form-data" id="serviceForm">
        <!-- Service Title -->
        <div class="form-group">
            <label for="service_title">
                <i class="bi bi-pencil-square"></i> Service Title
            </label>
            <input type="text" class="form-control" id="service_title" name="service_title" placeholder="Enter service title" required>
        </div>
        <!-- Service Description -->
        <div class="form-group">
            <label for="service_description">
                <i class="bi bi-file-text"></i> Service Description
            </label>
            <textarea class="form-control" id="service_description" name="service_description" placeholder="Enter detailed service description" required></textarea>
        </div>
        <!-- Service Status -->
        <div class="form-group">
            <label for="service_status">
                <i class="bi bi-toggle2-on"></i> Service Status
            </label>
            <select class="form-select" id="service_status" name="service_status" required>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="draft">Draft</option>
            </select>
        </div>
        <!-- Service Images Section -->
        <div class="file-upload-section">
            <label class="form-label">
                <i class="bi bi-images"></i> Service Images
            </label>
            <div class="file-input-wrapper">
                <input type="file" id="service_images" name="service_images[]" accept="image/*" multiple>
                <label for="service_images" class="file-upload-label">
                    <i class="bi bi-cloud-upload" style="font-size: 24px; color: #667eea;"></i>
                    <span>Click to upload or drag and drop<br><small>PNG, JPG, GIF up to 5MB</small></span>
                </label>
            </div>
            <div id="file-list"></div>
        </div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-submit">
            <i class="bi bi-check-circle"></i> Add Service
        </button>
    </form>

    <a href="?services" class="btn btn-outline-secondary w-100 mt-3">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

    
<script src="js/add_services.js"></script>
