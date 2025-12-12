    // Leads Trend Chart
    // Fetch data from database
    const servicesCounts = {};
    const fetchServicesCounts = async () => {
        const responses = await Promise.all([
            // fetch('../queries/get_services_counts.php?table=projects'),
            // fetch('../queries/get_services_counts.php?table=contact_input_form'),
            // fetch('../queries/get_services_counts.php?table=free_estimate'),
            // fetch('../queries/get_services_counts.php?table=quote'),
            // fetch('../queries/get_services_counts.php?table=emergencies')
            fetch('structure/metrics_logic.php?action=get_statistics')
        ]);

        console.log(responses)

        const servicesCountsResponses = await Promise.all(responses.map(response => response.json()));
        servicesCountsResponses.forEach(response => {
            response.forEach(service => {
                if (servicesCounts[service.service]) {
                    servicesCounts[service.service] += service.count;
                } else {
                    servicesCounts[service.service] = service.count;
                }
            });
        });

        // Create chart
        const ctxService = document.getElementById('servicePieChart').getContext('2d');
        new Chart(ctxService, {
            type: 'doughnut',
            data: {
                labels: Object.keys(servicesCounts),
                datasets: [{
                    data: Object.values(servicesCounts),
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545']
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } },maintainAspectRatio: false,
                aspectRatio: 1 }
                
        });
    };

    fetchServicesCounts();
