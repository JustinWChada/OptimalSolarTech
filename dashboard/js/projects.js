// projects/scripts.js

window.addEventListener('load', () => {
    const projectListContainer = document.getElementById('project-list-container');
    if (projectListContainer) {
            loadProjects();
    }
});

$("#insertProjectForm").submit(function(e) {
    e.preventDefault(); // Prevent the default form submission

    const form = e.target;

    // Simple validation for at least one team member and one image
    if (form.querySelectorAll('[name="member_name[]"]').length === 0) {
        alert('Please add at least one team member.');
        return;
    }
    if (form.querySelectorAll('[name="project_image[]"]').length === 0) {
        alert('Please add at least one project image.');
        return;
    }

    var formData = new FormData(this);
    formData.append('action', 'insert_project');
    $.ajax({
        url: 'projects/query_projects.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Project inserted successfully!');
                $('#insertProjectForm')[0].reset();
               
            } else {                
                alert('Error inserting project: ' + response.message);
               
            }
        },
        error: function(xhr, status, error) {
            alert('A network error occurred during insertion.'+error);

        }
    });
});
/**
 * Loads all projects from the database and renders them.
 */
/**
 * Optimized Card Creation using Template Literals
 */
function createProjectCard(project) {
    // Process description
    const shortDesc = project.description.length > 150 
        ? project.description.substring(0, 150) + '...' 
        : project.description;

    // Process images
    const imagesHtml = project.images.length > 0 
        ? project.images.map((img, idx) => `
            <img src="../files/uploads/projects/${img.image_path}" 
                 alt="${img.alt_text || 'Project Image'}" 
                 class="image-icon" 
                 onclick='showImageCarousel(${JSON.stringify(project.images)}, ${idx})'>
        `).join('')
        : '<small class="text-muted">No images available</small>';

    // Process team
    const teamHtml = project.team.length > 0
        ? `<h6>Team:</h6><p>${project.team.map(m => `
            <span class="badge bg-light text-dark me-1">${m.member_name} (${m.role})</span>
          `).join('')}</p>`
        : '';

    // Process Reviews
    const revCount = project.reviews.length;
    const avgRating = revCount > 0 
        ? (project.reviews.reduce((s, r) => s + parseInt(r.rating), 0) / revCount).toFixed(1) 
        : 'N/A';

    // Final Card Template
    return `
    <div class="col-lg-6 mb-4">
        <div class="card project-card h-100" data-id="${project.id}">
            <div class="project-card-header d-flex justify-content-between align-items-center p-3">
                <h5 class="mb-0">${project.title}</h5>
                <div>
                    <span class="badge bg-success me-2">${project.place}</span>
                    <span class="badge bg-light text-dark">${project.date.split(' ')[0]}</span>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">${shortDesc}</p>
                <hr>
                <div class="image-icon-container mb-3">${imagesHtml}</div>
                ${teamHtml}
                <small class="text-muted">Reviews: ${revCount} | Avg Rating: ${avgRating}/5</small>
                <div class="mt-3 d-flex justify-content-end">
                    <button class="btn btn-sm btn-outline-success me-2" onclick="editProject(${project.id})">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteProject(${project.id}, '${project.title.replace(/'/g, "\\'")}')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>`;
}

function loadProjects() {
    const container = document.getElementById('project-list-container');
    container.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary"></div></div>';

    fetch('projects/query_projects.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=load_projects'
    })
    .then(r => r.json())
    .then(data => {
        if (data.success && data.projects.length > 0) {
            // Build the entire list as one string, then inject ONCE.
            container.innerHTML = data.projects.map(p => createProjectCard(p)).join('');
        } else {
            container.innerHTML = '<div class="col-12"><div class="alert alert-info">No projects found.</div></div>';
        }
    })
    .catch(err => {
        container.innerHTML = `<div class="alert alert-danger">Error: ${err.message}</div>`;
    });
}


/**
 * Shows the image carousel modal.
 * @param {Array<object>} images - Array of image objects.
 * @param {number} startIndex - Index of the image to show first.
 */
function showImageCarousel(images, startIndex = 0) {
    const modalElement = document.getElementById('imageCarouselModal');
    const carouselInner = document.querySelector('#imageCarouselModal .carousel-inner');
    const carouselIndicators = document.querySelector('#imageCarouselModal .carousel-indicators');

    if (!modalElement || !carouselInner || !carouselIndicators) {
        alert('Modal structure not found.');
        return;
    }

    carouselInner.innerHTML = '';
    carouselIndicators.innerHTML = '';

    images.forEach((img, index) => {
        // Carousel Item
        const item = document.createElement('div');
        item.className = `carousel-item${index === startIndex ? ' active' : ''}`;
        item.innerHTML = `<img src="../files/uploads/projects/${img.image_path}" class="d-block w-100" alt="${img.alt_text}">`;
        carouselInner.appendChild(item);

        // Indicator
        const indicator = document.createElement('button');
        indicator.type = 'button';
        indicator.setAttribute('data-bs-target', '#imageCarousel');
        indicator.setAttribute('data-bs-slide-to', index);
        indicator.className = index === startIndex ? 'active' : '';
        indicator.setAttribute('aria-current', index === startIndex ? 'true' : 'false');
        indicator.setAttribute('aria-label', `Slide ${index + 1}`);
        carouselIndicators.appendChild(indicator);
    });

    const carouselModal = new bootstrap.Modal(modalElement);
    carouselModal.show();
}

/**
 * Handles the deletion of a project.
 * @param {number} id - The project ID.
 * @param {string} title - The project title for confirmation.
 */
function deleteProject(id, title) {
    if (!confirm(`Are you sure you want to delete the project: "${title}"? This action is permanent.`)) {
        return;
    }

    fetch('projects/query_projects.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=delete_project&id=${id}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`Project "${title}" deleted successfully!`);
            loadProjects(); // Reload the list
        } else {
            alert(`Error deleting project: ${data.message || 'Unknown error'}`);
        }
    })
    .catch(error => {
        console.error('Fetch error during deletion:', error);
        alert('A network error occurred during deletion.');
    });
}

/**
 * Placeholder for the Edit functionality (in a real app, this would load an edit form).
 * @param {number} id - The project ID.
 */
function editProject(id) {
    alert(`Editing project with ID: ${id}. \n\nIn a full application, this would redirect to an edit page or open an edit modal {Still working on it}.`);
    // For a real implementation: window.location.href = `edit_project.html?id=${id}`;
}

// --- Insert Page Functions ---

/**
 * Adds a new input group for team members.
 */
window.addTeamMember = function() {
    const container = document.getElementById('teamMembersContainer');
    const count = container.children.length;
    const div = document.createElement('div');
    div.className = 'row g-3 align-items-center team-member-input mb-2';
    div.innerHTML = `
        <div class="col-5">
            <input type="text" name="member_name[]" class="form-control" placeholder="Member Name" required>
        </div>
        <div class="col-5">
            <input type="text" name="member_role[]" class="form-control" placeholder="Role (e.g., Architect)" required>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.team-member-input').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
};

/**
 * Adds a new input group for image uploads.
 */
window.addImageUpload = function() {
    const container = document.getElementById('imageUploadsContainer');
    const div = document.createElement('div');
    div.className = 'row g-3 align-items-center image-upload-input mb-2';
    div.innerHTML = `
        <div class="col-5">
            <input type="file" name="project_image[]" class="form-control" required>
        </div>
        <div class="col-5">
            <input type="text" name="image_alt[]" class="form-control" placeholder="Image Alt Text (Optional)">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.image-upload-input').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
};

/**
 * Handles the form submission for inserting a new project.
 * @param {Event} e - The form submission event.
 */
function handleInsertProject(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    formData.append('action', 'insert_project');

    // Simple validation for at least one team member and one image
    if (form.querySelectorAll('[name="member_name[]"]').length === 0) {
        alert('Please add at least one team member.');
        return;
    }
    if (form.querySelectorAll('[name="project_image[]"]').length === 0) {
        alert('Please add at least one project image.');
        return;
    }

    fetch('projects/query_projects.php', {
        method: 'POST',
        body: formData // FormData handles multipart/form-data for file uploads
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Project inserted successfully! Redirecting to project list.');
            form.reset();
            window.location.href = 'index.html'; // Go back to the list
        } else {
            alert(`Error inserting project: ${data.message || 'Unknown error'}`);
        }
    })
    .catch(error => {
        console.error('Fetch error during insertion:', error);
        alert('A network error occurred during project insertion.');
    });
}

function updateSelectedServices(service_checkbox) {
    const selected_services_textbox = document.getElementById('selected_services');
    const selected_services = selected_services_textbox.value.split(',');
    const current_service_id = service_checkbox.value;
    const current_service_index = selected_services.indexOf(current_service_id);

    if (service_checkbox.checked) {
        if (current_service_index === -1) {
            selected_services.push(current_service_id);
        }
    } else {
        if (current_service_index !== -1) {
            selected_services.splice(current_service_index, 1);
        }
    }

    selected_services_textbox.value = selected_services.join(',');
}