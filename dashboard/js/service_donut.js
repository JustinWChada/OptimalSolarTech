 const servicesCounts = {};

fetch('structure/service_donut.php')
  .then(response => response.json())
  .then(data => {
    // Create chart
    const ctxService = document.getElementById("servicePieChart").getContext("2d");
    new Chart(ctxService, {
      type: "doughnut",
      data: {
        labels: data.map(item => item.service_title),
        datasets: [
          {
            label: "Service Counts",
            data: data.map(item => item.service_count),
            backgroundColor: Array.from({ length: data.length }, (_, i) => `hsl(${i * 30}, 50%, 50%)`),
            borderColor: "white",
            borderWidth: 1,
          },
        ],
      },
      options: { plugins: { legend: { position: "bottom" } } },
    });
  })
  .catch(error => console.error("Error fetching data:", error), xhr => console.error(xhr.responseText));


