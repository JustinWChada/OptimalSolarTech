fetch("structure/project_services.php")
  .then((response) => {
    // 1. Check if the network response was actually successful
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json();
  })
  .then((data) => {
    // 2. Validate data is actually an array
    if (!Array.isArray(data)) {
      console.error("Data format error: Expected an array", data);
      return;
    }

    const canvasId = "frequentChartProjectServices";
    const ctxFrequentChart = document.getElementById(canvasId).getContext("2d");

    // 3. AUTO-DESTROY: Check if a chart already exists on this canvas and destroy it
    // This prevents the "Canvas is already in use" error.
    const existingChart = Chart.getChart(canvasId);
    if (existingChart) {
      existingChart.destroy();
    }

    // 4. Create the new chart
    new Chart(ctxFrequentChart, {
      type: "bar",
      data: {
        labels: data.map((item) => item.service_tag),
        datasets: [
          {
            label: "Service Frequency",
            data: data.map((item) => item.frequency),
            // Improved color logic (slightly darker border for contrast)
            backgroundColor: data.map((_, i) => `hsl(${i * 30}, 60%, 60%)`),
            borderColor: data.map((_, i) => `hsl(${i * 30}, 60%, 40%)`), 
            borderWidth: 1, // Now the border is actually visible
            borderRadius: 4, // Optional: adds modern rounded corners
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false, // Prevents chart from looking squashed
        plugins: {
          title: {
            display: true,
            text: "Service Frequency in Projects",
            font: { size: 16 }
          },
          legend: {
            display: false,
          },
          tooltip: {
            enabled: true // Ensure tooltips are explicitly on
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1 // Forces integers if you are counting frequency
            }
          },
        },
      },
    });
  })
  .catch((error) => {
    // 5. Catch network or parsing errors
    console.error("Error fetching chart data:", error);
  });