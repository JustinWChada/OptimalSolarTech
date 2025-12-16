$(document).ready(function() {
    $('.form-signin').on('submit', function(e) {
        e.preventDefault();
       
        var formData = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: '../queries/signin_query.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    // Store user data in session storage or cookies
                    var expires = "expires=" + new Date(Date.now() + 60 * 1000 * 60 * 24 * 1).toUTCString();
                    document.cookie = "user_id=" + response.user.user_id + ";" + expires + "; path=/";
                    document.cookie = "user_name=" + response.user.username + ";" + expires + "; path=/";
                    
                    // Redirect or clear form as needed
                    $.ajax({
                        type: 'POST',
                        url: '../includes/session_create.php',
                        data: {
                            user_id: response.user.user_id,
                            csrf_token: $('meta[name="csrf_token"]').attr('content')
                        },
                        success: function(session_response) {
                            if(JSON.parse(session_response).success){

                                var expires = "expires=" + new Date(Date.now() + 60 * 1000 * 60 * 24 * 1).toUTCString();
                                document.cookie = "session_id=" + JSON.parse(session_response).session_id + ";" + expires + "; path=/";
                                
                                window.location.href = '../dashboard/dashboard?' + JSON.parse(session_response).session_id;
                            } else {
                                alert(JSON.parse(session_response).message);
                            }
                            
                        },
                        error: function(xhr, status, error) {
                            alert('Session creation failed: ' + error);
                        }
                    });

                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });
});