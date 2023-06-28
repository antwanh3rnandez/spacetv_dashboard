// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
function pieBar(porcentaje, nombreColor){
if (nombreColor === "primary") {
  valorHexadecimal = "#4e73df";
  valorHexadecimalHover = "#2e59d9";
} else if (nombreColor === "success") {
  valorHexadecimal = "#1cc88a";
  valorHexadecimalHover = "#17a673";
} else if (nombreColor === "info") {
  valorHexadecimal = "#36b9cc";
  valorHexadecimalHover = "#2a8bae";
} else if (nombreColor === "warning") {
  valorHexadecimal = "#f6c23e";
  valorHexadecimalHover = "#f4b30d";
} else if (nombreColor === "danger") {
  valorHexadecimal = "#e74a3b";
  valorHexadecimalHover = "#d62c1a";
} else if (nombreColor === "secondary") {
  valorHexadecimal = "#858796";
  valorHexadecimalHover = "#6b6b6b";
} else if (nombreColor === "light") {
  valorHexadecimal = "#f8f9fc";
  valorHexadecimalHover = "#d1d3e2";
} else if (nombreColor === "dark") {
  valorHexadecimal = "#5a5c69";
  valorHexadecimalHover = "#3a3b45";
} else {
  valorHexadecimal = "#000000";
  valorHexadecimalHover = "#000000";
}
var ctx = document.getElementById("myPieChart");
var restante = 100-porcentaje;
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Porcentaje de servicio restante","Sin Servicio"],
    datasets: [{
      data: [porcentaje,restante],
      backgroundColor: [valorHexadecimal],
      hoverBackgroundColor: [valorHexadecimalHover],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
}