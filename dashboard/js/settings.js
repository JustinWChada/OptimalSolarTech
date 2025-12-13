$("#userTokenForm").submit(function(event) {
    event.preventDefault(); // Prevent default form submission  

    let formData = {
        action: "get_user_token",
        admin_password: document.getElementById("userTokenForm").token_admin_password.value,
        user_email: document.getElementById("userTokenForm").token_user_email.value,
        user_password: document.getElementById("userTokenForm").token_user_password.value
    };

    $.ajax({
        type: 'POST',
        url: 'settings/query_settings.php',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $("#ajaxAlertUserToken").removeClass("alert-danger");
                $("#ajaxAlertUserToken").addClass("alert-success");
                $("#ajaxAlertUserToken").text(response.message + " " + response.verification_token);
                $("#ajaxAlertUserToken").removeClass("d-none");
            } else {
                $("#ajaxAlertUserToken").removeClass("alert-success");
                $("#ajaxAlertUserToken").addClass("alert-danger");
                $("#ajaxAlertUserToken").text(response.message);
                $("#ajaxAlertUserToken").removeClass("d-none");
            }
        }
    }),

    setTimeout(function() {
        $("#ajaxAlertUserToken").text("");
        $("#ajaxAlertUserToken").addClass("d-none");
    }, 14000);
});

$("#adminPasswordForm").submit(function(event) {
    event.preventDefault(); // Prevent default form submission  

    let formData = {
        action: "get_admin_password",
        admin_pass_user_email: document.getElementById("adminPasswordForm").admin_pass_user_email.value,
        admin_pass_user_password: document.getElementById("adminPasswordForm").admin_pass_user_password.value
    };

    $.ajax({
        type: 'POST',
        url: 'settings/query_settings.php',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $("#ajaxAlertAdminPassword").removeClass("alert-danger");
                $("#ajaxAlertAdminPassword").addClass("alert-success");
                $("#ajaxAlertAdminPassword").text(response.message + " " + response.admin_password);
                $("#ajaxAlertAdminPassword").removeClass("d-none");
            } else {
                $("#ajaxAlertAdminPassword").removeClass("alert-success");
                $("#ajaxAlertAdminPassword").addClass("alert-danger");
                $("#ajaxAlertAdminPassword").text(response.message);
                $("#ajaxAlertAdminPassword").removeClass("d-none");
            }
        }
    }),

    setTimeout(function() {
        $("#ajaxAlertAdminPassword").text("");
        $("#ajaxAlertAdminPassword").addClass("d-none");
    }, 14000);
});
