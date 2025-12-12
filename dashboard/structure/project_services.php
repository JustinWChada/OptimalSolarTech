<?php

require '../config/miscellanea_db.php';

$sql = "
    SELECT 
        TRIM(service) AS service_tag, 
        COUNT(*) AS frequency 
    FROM (
        SELECT 
            -- Extracts the N-th element from the comma-separated string
            SUBSTRING_INDEX(
                SUBSTRING_INDEX(p.service_tags, ',', numbers.n), 
                ',', 
                -1
            ) AS service
        FROM 
            projects p
        CROSS JOIN 
        (
            -- Generates a temporary numbers table (1 to 255)
            SELECT (@row := @row + 1) AS n
            FROM (SELECT @row := 0) r, projects p2 
            LIMIT 255
        ) AS numbers
        -- Condition: join rows where the number of tags is >= n
        WHERE 
            numbers.n <= LENGTH(p.service_tags) - LENGTH(REPLACE(p.service_tags, ',', '')) + 1
            AND p.service_tags IS NOT NULL 
            AND p.service_tags != ''
    ) AS sub
    WHERE TRIM(service) != '' -- Exclude any empty strings resulting from multiple commas
    GROUP BY service_tag
    ORDER BY frequency DESC
";

$result = $OstMiscellaneaConn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
$data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'service_tag' => htmlspecialchars($row['service_tag']),
            'frequency' => htmlspecialchars($row['frequency'])
        );
    }
    echo json_encode($data);

    }

}