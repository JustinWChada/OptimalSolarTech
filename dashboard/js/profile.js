

function loadProfile() {
    const container = document.getElementById('profile-container');
    
    fetch('profile/query_profile.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=load_profile'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Profile data received:', data); //remove
        if (data.success && data.profile) {
            container.innerHTML = createProfileCard(data.profile);
        } else {
            container.innerHTML = '<div class="alert alert-danger text-center" role="alert">Error: ' + (data.message || 'Profile data could not be fetched.') + '</div>';
        }
    })
    .catch(error => {
        console.error('Error loading profile:', error);
        container.innerHTML = `<div class="alert alert-danger text-center" role="alert">Failed to load profile due to a network or server error. (${error.message})</div>`;
    });
}

/**
 * Creates the HTML structure for the profile card.
 * @param {object} profile - The profile data.
 * @returns {string} The HTML string for the profile card.
 */
function createProfileCard(profile) {
    const defaultPic = '../images/placeholder.png'; // Placeholder for missing image
    const picPath = profile.profile_picture_path && profile.profile_picture_path !== '' 
                    ? profile.profile_picture_path 
                    : defaultPic;

    return `
        <div class="card profile-card">
            <div class="profile-header"></div>
            
            <div class="card-body text-center">
                <img src="${picPath}" class="profile-picture" alt="Profile Picture">
                
                <h2 class="mt-3 fw-bold text-primary">${profile.first_name + " " + profile.last_name} : <i>${ profile.username }</i></h2>
                <h5 class="text-muted mb-4">${profile.email}</h5>

                <div class="row justify-content-center mb-1">
                    <div class="col-md-5">
                        <p class="mb-0"><i class="bi bi-phone text-info me-2"></i><strong>Phone:</strong> ${profile.user_phone || 'N/A'}</p>
                        
                    </div>
                    <div class="col-md-5">
                        <p class="mb-0"><i class="bi bi-calendar-check text-info me-2"></i><strong>Created on:</strong> ${profile.created_at ? new Date(profile.created_at).toLocaleDateString() : 'N/A'}</p>
                    </div>
                </div>
                <br>
                <div class="text-start p-2 bg-light rounded shadow-sm">
                    <h5 class="text-secondary"><i class="bi bi-hourglass-split me-2"></i>Account State:</h5>
                    <p class="mb-0 px-4"><strong>Active</strong> ${profile.is_active ? '<i class="bi bi-person-check text-success"></i>' : '<i class="bi bi-person-slash-fill text-danger"></i>' || 'N/A'}</p>
                    <p class="mb-0 px-4"><strong>Verified</strong> ${profile.is_verified ? '<i class="bi bi-person-fill-check text-success"></i>' : '<i class="bi bi-person-fill-exclamation text-danger"></i>' || 'N/A'}</p>
                </div>

                <div class="text-start p-2 bg-light rounded shadow-sm">
                    <h5 class="text-secondary"><i class="bi bi-clock-history me-2"></i>Account History:</h5>
                    <p class="mb-0 px-4"><strong>Last Login:</strong> ${profile.last_login || 'First Login'}</p>
                    <p class="mb-0 px-4"><strong>Last Update:</strong> ${profile.updated_at || 'N/A'}</p>
                </div>

                <div class="mt-4">
                    <a href="?edit_profile" class="btn btn-outline-success"><i class="bi bi-pencil-square"></i> Edit Profile</a>
                </div>
            </div>
        </div>
    `;
}

loadProfile();