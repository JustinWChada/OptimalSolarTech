<?php
require '../config/miscellanea_db.php';

$sql = "SELECT service_title FROM services";
$result = $OstMiscellaneaConn->query($sql);

$final_result = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $service_title = htmlspecialchars($row['service_title']);
        $sql = "SELECT COUNT(*) FROM quotes WHERE service='$service_title'";
        $quotes_result = $OstMiscellaneaConn->query($sql);
        $quotes_count = $quotes_result->fetch_assoc()['COUNT(*)'];

        $sql = "SELECT COUNT(*) FROM free_estimate WHERE service='$service_title'";
        $free_estimates_result = $OstMiscellaneaConn->query($sql);
        $free_estimates_count = $free_estimates_result->fetch_assoc()['COUNT(*)'];

        $sql = "SELECT COUNT(*) FROM contact_form_inputs WHERE service='$service_title'";
        $contact_form_result = $OstMiscellaneaConn->query($sql);
        $contact_form_count = $contact_form_result->fetch_assoc()['COUNT(*)'];

        $final_result[] = array(
            'service_title' => $service_title,
            'service_count' => $quotes_count + $free_estimates_count + $contact_form_count
        );
    }
}

echo json_encode($final_result);

