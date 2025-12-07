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
                $("#rem_id").html(response.message)
                if(response.success) {
                    alert(response.message);
                    // Store user data in session storage or cookies
                    sessionStorage.setItem('user_id', response.user.user_id);
                    sessionStorage.setItem('user_name', response.user.username);
                    //sessionStorage.setItem('user_password', response.user_password);

                    // Redirect or clear form as needed
                    $.ajax({
                        type: 'POST',
                        url: '../includes/session_create.php',
                        data: {
                            user_id: response.user.user_id,
                            csrf_token: $('meta[name="csrf_token"]').attr('content')
                        },
                        success: function(data) {
                            window.location.href = '../includes/session_create.php';
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
                $("#rem_id").html(error)
            }
        });
    });
});