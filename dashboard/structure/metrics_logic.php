<?php
require "../config/miscellanea_db.php";
require "../config/users_db.php";

// Assuming $conn is your database connection
function getMetricsCounts() {
    require "../config/miscellanea_db.php";
    require "../config/users_db.php";
    // 1. Get total projects
    $projectCount = $OstMiscellaneaConn->query("SELECT COUNT(*) FROM projects")->fetch_row()[0];

    // 2. Get total leads
    $allLeadsQuery = "
        SELECT COUNT(*) as count 
        FROM (
            SELECT 'Emergency' as type FROM emergencies
            UNION ALL
            SELECT 'Estimate' as type FROM free_estimate
            UNION ALL
            SELECT 'Quote' as type FROM quotes
            UNION ALL
            SELECT 'Contact' as type FROM contact_form_inputs
        ) AS all_leads
    ";
    $totalLeadsCount = $OstMiscellaneaConn->query($allLeadsQuery)->fetch_row()[0];

    // 3. Get total services
    $totalServicesCount = $OstMiscellaneaConn->query("SELECT COUNT(*) FROM contact_form_inputs")->fetch_row()[0];

    return array(
        "projectCount" => $projectCount,
        "totalLeadsCount" => $totalLeadsCount,
        "totalServicesCount" => $totalServicesCount
    );
}

//if(isset($_GET['action']) && $_POST['action'] == 'get_statistics') {
    $metricsCounts = getMetricsCounts();
    echo json_encode($metricsCounts);
//}
?>