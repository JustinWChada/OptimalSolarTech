// Initialize the Chart
const leadChartCanvas = document.getElementById('leadsChartProjects');

const leadChart = new Chart(leadChartCanvas, {
    type: 'line',
    data: {
        labels: [],
        datasets: []
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: "Project Completion Trends"
            },
            legend: {
                display: true
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        // Parsing tells Chart.js where to look inside the objects in the 'data' array
        parsing: {
            xAxisKey: 'project_date',
            yAxisKey: 'project_count'
        }
    }
});

// Fetch data from the PHP backend
fetch('structure/lead_chart_metric.php')
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        // We use the raw data objects directly because we configured 'parsing' above
        const weeklyDataPoints = data.weekly;
        const monthlyDataPoints = data.monthly;

        // Set initial labels from the weekly data
        leadChart.data.labels = weeklyDataPoints.map(item => item.project_date);

        leadChart.data.datasets = [
            {
                label: "Weekly Trend",
                data: weeklyDataPoints,
                backgroundColor: "rgba(13, 110, 253, 0.2)",
                borderColor: "rgba(13, 110, 253, 1)",
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }, 
            {
                label: "Monthly Trend",
                data: monthlyDataPoints,
                backgroundColor: "rgba(25, 135, 84, 0.2)",
                borderColor: "rgba(25, 135, 84, 1)",
                borderWidth: 2,
                fill: true,
                tension: 0.3,
                hidden: true // Hidden by default
            }
        ];
        
        leadChart.update();
    })
    .catch(error => console.error('Error fetching chart metrics:', error));

// Toggle visibility logic
document.getElementById('toggleMonthly').addEventListener('click', () => {
    const isMonthlyHidden = leadChart.data.datasets[1].hidden;
    
    // Toggle hidden states
    leadChart.data.datasets[0].hidden = !isMonthlyHidden; // Weekly
    leadChart.data.datasets[1].hidden = isMonthlyHidden;  // Monthly

    // Update labels to match the visible dataset
    const visibleData = isMonthlyHidden ? leadChart.data.datasets[1].data : leadChart.data.datasets[0].data;
    leadChart.data.labels = visibleData.map(item => item.project_date);

    leadChart.update();
});