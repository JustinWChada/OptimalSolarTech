<?php
require '../config/miscellanea_db.php';

$sql = "SELECT s.service_id, s.service_title, COUNT(q.service) as quotes_count, COUNT(f.service) as free_estimate_count, COUNT(c.service) as contact_form_count
FROM services s
LEFT JOIN quotes q ON q.service = s.service_id
LEFT JOIN free_estimate f ON f.service = s.service_id
LEFT JOIN contact_form_inputs c ON c.service = s.service_id
GROUP BY s.service_id, s.service_title
ORDER BY quotes_count DESC, free_estimate_count DESC, contact_form_count DESC";

$result = $OstMiscellaneaConn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $final_result[] = array(
            'service_title' => htmlspecialchars($row['service_title']),
            'service_count' => htmlspecialchars($row['quotes_count'] + $row['free_estimate_count'] + $row['contact_form_count'])
        );
    }
} else {
    $final_result[] = array(
        'service_title' => '',
        'service_count' => 0
    );
}

echo json_encode($final_result);

