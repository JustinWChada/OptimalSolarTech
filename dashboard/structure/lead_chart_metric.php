<?php

require '../config/miscellanea_db.php';

//if (isset($_GET['action']) && $_GET['action'] == 'get_lead_chart_metrics') {
        header('Content-Type: application/json');

        // Fetch weekly project counts
        $weeklySql = "SELECT DATE_FORMAT(created_at, '%Y-%m-%d') as project_date, COUNT(*) as project_count 
                    FROM projects 
                    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK) 
                    GROUP BY DATE_FORMAT(created_at, '%Y-%m-%d')
                    ORDER BY project_date ASC";

        // Fetch monthly project counts
        $monthlySql = "SELECT DATE_FORMAT(created_at, '%Y-%m') as project_date, COUNT(*) as project_count 
                    FROM projects 
                    WHERE created_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH) 
                    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                    ORDER BY project_date ASC";

        $weeklyResult = $OstMiscellaneaConn->query($weeklySql);
        $monthlyResult = $OstMiscellaneaConn->query($monthlySql);

        $weeklyData = [];
        $monthlyData = [];

        if ($weeklyResult && $weeklyResult->num_rows > 0) {
            while ($row = $weeklyResult->fetch_assoc()) {
                $weeklyData[] = [
                    'project_date' => $row['project_date'], 
                    'project_count' => (int)$row['project_count']
                ];
            }
        }

        if ($monthlyResult && $monthlyResult->num_rows > 0) {
            while ($row = $monthlyResult->fetch_assoc()) {
                $monthlyData[] = [
                    'project_date' => $row['project_date'], 
                    'project_count' => (int)$row['project_count']
                ];
            }
        }

echo json_encode(['weekly' => $weeklyData, 'monthly' => $monthlyData]);
//}
