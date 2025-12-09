const pageRoutes = {
    'add_services': 'services/add_services.php',
    'available_services': 'services/services.php',
    'edit_services': 'services/services.php',
    'services': 'services/services.php',

    'dashboard': 'pages/dashboard.php',
    'settings': 'pages/settings.php'
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

    // logic to handle the URL
    const pagePath = getPagePath(url);

    if (pagePath != null) {
        loadPage(pagePath);
    }
}

getUrl()