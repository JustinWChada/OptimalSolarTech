fetch("structure/project_services.php")
  .then((response) => response.json())
  .then((data) => {

    const ctxFrequentChart = document
      .getElementById("frequentChartProjectServices")
      .getContext("2d");
    new Chart(ctxFrequentChart, {
      type: "bar",
      data: {
        labels: data.map((item) => item.service_tag),
        datasets: [
          {
            label: "Service Frequency",
            data: data.map((item) => item.count),
            backgroundColor: Array.from(
              { length: data.length },
              (_, i) => `rgba(0, 0, 0, 0)`
            ),
            borderColor: Array.from(
              { length: data.length },
              (_, i) => `rgba(0, 0, 0, 0)`
            ),
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: "Service Frequency in Projects",
          },
          legend: {
            display: false,
          },
        },
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  });
