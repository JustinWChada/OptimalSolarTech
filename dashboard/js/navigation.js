const pageRoutes = {
    'add_services': 'services/add_services.php',
    'available_services': 'services/services.php',
    'edit_services': 'services/services.php',
    'services': 'services/services.php',

    'available_projects': 'projects/projects.php',
    'add_projects': 'projects/add_projects.php',
    'projects': 'projects/projects.php',

    'available_faqs': 'faqs/faqs.php',
    'add_faqs': 'faqs/faqs.php',
    'faqs': 'faqs/faqs.php',

    'messages': 'messages/messages.php',

    'quotes': 'quotes & estimates/quotes.php',
    'free_estimates': 'quotes & estimates/free_estimates.php',

    'account': 'profile/profile.php',
    'profile': 'profile/profile.php',
    'edit_profile': 'profile/edit_profile.php',

    'users': 'settings/users.php',
    'add_user': 'settings/add_user.php',

    'logout': 'logout.php',
    'signout': 'logout.php',

    'emergencies': 'emergencies/emergencies.php',

    'dashboard': 'structure/dashboard.php',
    'settings': 'settings/settings.php'
};

function getPagePath(page) {
    return pageRoutes[page] || null;
}

function getUrlParameter() {
    const url = window.location.href;
    const params = new URLSearchParams(new URL(url).search);
    const firstParam = params.keys().next().value;
    return firstParam || null;
}

function loadPage(pagePath) {
    $("#dashboardContent").html("Error loading page .");

    $.ajax({
        url: pagePath,
        method: "GET",
        data: {"request": "fetch_page"},
        success: function (data) {
            $("#dashboardContent").html(data);
        },
        error: function (xhr, status, error) {
        // Add error handling
        console.error("Error fetching profile:", status, error);
        $("#dashboardContent").html("Error loading page .");
        },
    });
}

function getUrl(){
    const url = getUrlParameter();

    if(url == "signout" || url == "logout"){

        if(confirm("Are you sure you want to sign out: This will close all data and all sessions ?")){
            document.body.innerHTML = "";
            document.body.innerHTML = "Closing all data and all sessions...";
            
            setTimeout(() => {
                 window.location.href = "session_destroy.php";
            }, 3000);
           
        }
       
        return;
    }

    if(url == "home"){
        window.location.href = "../pages/";
        return;
    }

    // logic to handle the URL
    const pagePath = getPagePath(url);

    if (pagePath != null) {
        loadPage(pagePath);
    }
}

getUrl()