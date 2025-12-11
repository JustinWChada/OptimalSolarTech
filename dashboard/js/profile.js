

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
                    <button class="btn-small mb-0 px-4 ${profile.is_active ? 'btn btn-success' : 'btn btn-danger'}" onclick="toggleAccountState(${profile.user_id})">${profile.is_active ? 'Active' : 'Not Active'}</button>
                    <button class="btn-small mb-0 px-4 ${profile.is_verified ? 'btn btn-success' : 'btn btn-danger'}" data-bs-toggle="modal" data-bs-target="#verificationTokenModal" >${profile.is_verified ? "Verified" : "Not Verified"} </button>
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

function toggleAccountState() {
    // Implement the logic to toggle account state
    
    if(!confirm("Are you sure you want to toggle the account state?")) return; //confirm

    $.ajax({
        url: 'profile/query_profile.php',
        type: 'POST',
        data: { action: 'toggle_account_state', userId: "" },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                //alert('Account state updated successfully.'); //uncomment if you want an alert
                loadProfile(); // Reload profile to reflect changes
            } else {
                alert('Error: ' + (data.message || 'Could not update account state.'));
            }
        },
        error: function(xhr, status, error) {
            console.error('Error toggling account state:', status, error);
            alert('A network error occurred.'); 
            console.log(xhr.responseText);
            console.log(error);
        }
    });

}   

$("#verification_token_form").submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    let token  = document.getElementById("verification_token_form").verification_token.value;  

    toggleAccountVerification(token);
});

function toggleAccountVerification(token) {
    
    if(!confirm("Are you sure you want to toggle the account verification?")) return; //confirm

    $.ajax({
        url: 'profile/query_profile.php',
        type: 'POST',
        data: { action: 'toggle_account_verification', userId: "" , token: token },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.success) {
                $("#verificationTokenModal").modal('hide');
                loadProfile(); // Reload profile to reflect changes
            } else {
                alert('Error: ' + (data.message || 'Could not update account verification.'));
            }
        },
        error: function(xhr, status, error) {
            alert('A network error occurred.'); 
            console.error(xhr.responseText);
        }
    })
}