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
function loadProjects() {
    const container = document.getElementById('project-list-container');
    container.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

    fetch('projects/query_projects.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=load_projects'
    })
    .then(response => response.json())
    
    .then(data => {
        container.innerHTML = '';
       
        if (data.success && data.projects.length > 0) {
            data.projects.forEach(project => {
                container.appendChild(createProjectCard(project));
            });
        } else {
            container.innerHTML = '<div class="col-12"><div class="alert alert-info" role="alert">No projects found.</div></div>';
        }
    })
    .catch(error => {
        console.error('Error loading projects:', error); //remove
        alert(error.message) //remove
        container.innerHTML = '<div class="col-12"><div class="alert alert-danger" role="alert">Failed to load projects.</div></div>'+error;
    });
}

/**
 * Creates the HTML element for a single project card.
 * @param {object} project - The project data.
 * @returns {HTMLElement} The created card element.
 */
function createProjectCard(project) {
    const col = document.createElement('div');
    col.className = 'col-lg-6 mb-4';
    
    const card = document.createElement('div');
    card.className = 'card project-card h-100';
    card.setAttribute('data-id', project.id);
    
    // Header
    const cardHeader = document.createElement('div');
    cardHeader.className = 'project-card-header d-flex justify-content-between align-items-center';
    cardHeader.innerHTML = `
        <h5 class="mb-0">${project.title}</h5>
        <div>
            <span class="badge bg-success me-2">${project.place}</span>
            <span class="badge bg-light text-dark">${project.date.split(' ')[0]}</span>
        </div>
    `;

    // Body
    const cardBody = document.createElement('div');
    cardBody.className = 'card-body';
    
    const description = document.createElement('p');
    description.className = 'card-text';
    description.textContent = project.description.substring(0, 150) + (project.description.length > 150 ? '...' : '');

    // Image Icons
    const imageContainer = document.createElement('div');
    imageContainer.className = 'image-icon-container';
    if (project.images && project.images.length > 0) {
        project.images.forEach((img, index) => {
            true_img_path = "../files/uploads/projects/" + img.image_path; // Adjust path as needed
            const imgIcon = document.createElement('img');
            imgIcon.src = true_img_path;
            imgIcon.alt = img.alt_text || 'Project Image';
            imgIcon.className = 'image-icon';
            imgIcon.addEventListener('click', () => showImageCarousel(project.images, index));
            imageContainer.appendChild(imgIcon);
        });
    } else {
        imageContainer.innerHTML = '<small class="text-muted">No images available</small>';
    }

    // Team Members
    let teamHtml = '';
    if (project.team && project.team.length > 0) {
        teamHtml = `<h6>Team:</h6><p>${project.team.map(m => `<span class="badge bg-light text-dark me-1">${m.member_name} (${m.role})</span>`).join('')}</p>`;
    }

    // Reviews (simple count)
    const reviewCount = project.reviews ? project.reviews.length : 0;
    const rating = project.reviews && reviewCount > 0 ? (project.reviews.reduce((sum, r) => sum + parseInt(r.rating), 0) / reviewCount).toFixed(1) : 'N/A';
    const reviewHtml = `<small class="text-muted">Reviews: ${reviewCount} | Avg Rating: ${rating}/5</small>`;

    // Action Buttons
    const actionContainer = document.createElement('div');
    actionContainer.className = 'mt-3 d-flex justify-content-end';
    actionContainer.innerHTML = `
        <button class="btn btn-sm btn-outline-success me-2" onclick="editProject(${project.id})">
            <i class="bi bi-pencil-square"></i> Edit
        </button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteProject(${project.id}, '${project.title}')">
            <i class="bi bi-trash"></i> Delete
        </button>
    `;

    cardBody.appendChild(description);
    cardBody.appendChild(document.createElement('hr'));
    cardBody.appendChild(imageContainer);
    cardBody.insertAdjacentHTML('beforeend', teamHtml);
    cardBody.insertAdjacentHTML('beforeend', reviewHtml);
    cardBody.appendChild(actionContainer);
    
    card.appendChild(cardHeader);
    card.appendChild(cardBody);
    col.appendChild(card);
    return col;
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
        item.innerHTML = `<img src="${img.image_path}" class="d-block w-100" alt="${img.alt_text}">`;
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
    alert('Submitting project... Please wait.');
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