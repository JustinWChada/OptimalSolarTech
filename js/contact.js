$(document).ready(function() {
    $("#contact-form").submit(function(e) {
        e.preventDefault();
        
        let form = $(this);
        let name = form.find('input[name="name"]').val();
        let email = form.find('input[name="email"]').val();
        let message = form.find('textarea[name="message"]').val();
        let service = form.find('select[name="service"]').val();
        let phone = form.find('input[name="phone"]').val();

        let data = {
            name: name,
            email: email,
            message: message,
            service: service,
            phone: phone,
            action: 'submit_contact'
        };

        $.ajax({
            type: "POST",
            url: "../queries/submit_contact.php",
            data:data,
            dataType: "json",
            success: function(response) {
               
                if (response.success) {
                    alert(response.message);
                } else {
                    alert("Error submitting form: " + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log(error)
                alert('Error submitting form: ' + error);
            }
        });
    });
});

