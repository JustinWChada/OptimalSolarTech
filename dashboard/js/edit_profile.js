
$("#updateProfileForm").submit(function(event) {
    event.preventDefault(); // Prevent default form submission  

    let formData = {
        action: document.getElementById("updateProfileForm").action.value,
        username: document.getElementById("updateProfileForm").username.value,
        email: document.getElementById("updateProfileForm").email.value,
        password: document.getElementById("updateProfileForm").password.value,
        user_phone: document.getElementById("updateProfileForm").user_phone.value,
        first_name: document.getElementById("updateProfileForm").first_name.value,
        last_name: document.getElementById("updateProfileForm").last_name.value
    };

    $.ajax({
        type: 'POST',
        url: 'profile/query_profile.php',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Profile updated successfully!');
            } else {
                alert('Error updating profile: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error updating profile: An error occurred while processing the request.');
            console.error(xhr.responseText);
            //console.log(status + ":" + error)
        }
    });
});