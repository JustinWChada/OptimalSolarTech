<?php
require "../config/miscellanea_db.php";
?>

<link rel="stylesheet" href="css/emergencies.css" type="text/css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="?projects"><i class="bi bi-box-seam-fill"></i> Emergency Requests</a>
        <div class="d-flex">
            <a href="?messages" class="btn btn-success">
                <i class="bi bi-plus-circle-fill"></i> Inquiries
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <header class="text-center mb-4">
        <h1 class="display-4 fw-bold">Unattended Emergencies</h1>
        <p class="lead text-secondary">View, edit, and manage all your pending emergencies.</p>
        <hr class="w-25 mx-auto">
    </header>

    <div id="project-list-container" class="row">
    <?php
    $sql = "SELECT e.id, e.name, e.phone, e.description, e.status, TIMESTAMPDIFF(MINUTE, e.created_at, NOW()) AS time_since_emergency
    FROM emergencies e
    ORDER BY e.created_at DESC";

    $result = $OstMiscellaneaConn->query($sql);

    if ($result->num_rows > 0) {
       

        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-sm table-hover">';
        echo '<thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Description</th>
                    <th>Time Since Emergency</th>
                    <th>Status</th>
                    <th>Marked</th>
                </tr>
            </thead>
            <tbody>';
        while ($row = $result->fetch_assoc()) {
            
            $status = $row['status'];
            $marked = "N/A";

            $statusClass = 'N/A';

            if ($status === 'active') {
                $statusClass = '<a href="#" class="btn btn-primary" onclick=deleteEmergency(' . $row['id'] . ')>Mark as Attended</a>';
                $marked = "<i class='bi bi-x-circle-fill text-danger'></i>";
            } elseif ($status === 'deleted') {
                $statusClass = '<div class="text-light bg-success">Attended</div>';
                $marked = "<i class='bi bi-check-circle-fill text-success'></i>";
            }

            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td>';
            if($status == "active"){
                if ($row['time_since_emergency'] < 30) {
                    echo '<i class="bi bi-check-circle-fill text-success"></i> Safe';
                } elseif ($row['time_since_emergency'] >= 30 && $row['time_since_emergency'] < 60) {
                    echo '<i class="bi bi-exclamation-triangle-fill text-warning"></i> Urgent';
                } else {
                    echo '<i class="bi bi-exclamation-circle-fill text-danger"></i> Critical';
                }
            }else{
                echo '<span class="bi text-success">Success</span>';
            }
            
            echo '</td>';
            echo '<td>'.$statusClass.'</td>';
            echo '<td>'.$marked.'</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
    ?>
    </div>
</div>

<script src="js/emergencies.js"></script>