<?php
require '../config/users_db.php';
require '../config/miscellanea_db.php';

function getTotalMetrics($sql,$conn){

    $query = $sql;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total'];

}

?>

<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard Overview</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary" disabled>Download Report</button>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white p-3">
                    <?php
                        $sql = "SELECT COUNT(*) as total FROM projects";
                        $totalProjects = getTotalMetrics($sql, $OstMiscellaneaConn);
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small">Total Projects</div>
                            <div class="metric-value"><?php echo $totalProjects; ?></div>
                        </div>
                        <i class="fas fa-briefcase stat-icon"></i>
                    </div>  
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white p-3">
                    <?php
                        $sql = "SELECT COUNT(*) as total FROM emergencies WHERE status = 'active'";
                        $totalEmergencies = getTotalMetrics($sql, $OstMiscellaneaConn);
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small">Active Emergencies</div>
                            <div class="metric-value"><?php echo $totalEmergencies ?></div>
                        </div>
                        <i class="fas fa-bolt stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white p-3">
                    <?php
                        $sql = "SELECT COUNT(*) as total FROM quotes";
                        $totalQuotes = getTotalMetrics($sql, $OstMiscellaneaConn);
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small">Quotes Pending</div>
                            <div class="metric-value"><?php echo $totalQuotes ?></div>
                        </div>
                        <i class="fas fa-file-invoice-dollar stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark p-3">
                    <?php
                        $sql = "SELECT COUNT(*) as total FROM services WHERE status = 'active'";
                        $totalServices = getTotalMetrics($sql, $OstMiscellaneaConn);
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-uppercase small">Active Services</div>
                            <div class="metric-value"><?php echo $totalServices ?></div>
                        </div>
                        <i class="fas fa-tools stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-8">
                <div class="card p-4">
                    <h5>Lead Trend</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="toggleMonthly" />
                        <label class="form-check-label" for="toggleMonthly">
                            Toggle Monthly
                        </label>
                    </div>
                    <canvas id="leadsChartProjects" height="200"></canvas>
                </div>
                <br>
                <div class="card p-4">
                    <h5>Services Frequency</h5>
                    <canvas id="frequentChartProjectServices" height="300"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <h5>Service Distribution</h5>
                    
                    <canvas id="servicePieChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card p-4">
            <h5>Recent Inquiries</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM (
                            SELECT 'Emergency' as type, name, description as service, created_at, 'active' as status FROM emergencies 
                            UNION ALL
                            SELECT 'Free Estimate' as type, name, service, created_at, 'active' as status FROM free_estimate 
                            UNION ALL
                            SELECT 'Quote' as type, name, service, created_at, 'active' as status FROM quotes 
                            UNION ALL
                            SELECT 'Contact' as type, name, service, created_at, 'active' as status FROM contact_form_inputs 
                        ) AS all_leads
                        ORDER BY created_at DESC
                        LIMIT 10";
                        $result = $OstMiscellaneaConn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><span class="badge <?php echo $row['type'] == 'Emergency' ? 'bg-danger' : ($row['type'] == 'Free Estimate' ? 'bg-info' : ($row['type'] == 'Quote' ? 'bg-success' : 'bg-primary') )?>"><?php echo ucwords($row['type']); ?></span></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['service']); ?></td>
                            <td><?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></td>
                            <td><span class="badge <?php echo $row['status'] == 'active' ? 'bg-success' : 'bg-warning' ?>"><?php echo ucwords($row['status']); ?></span></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="js/lead_chart_metric.js"></script>
<script src="js/service_donut.js"></script>
<script src="js/project_services.js"></script>
