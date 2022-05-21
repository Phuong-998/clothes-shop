// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var qtySucces =  document.getElementById('myPieChart').getAttribute('data-succes')
var qtyFail =  document.getElementById('myPieChart').getAttribute('data-fail')

var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Đơn hàng thành công", "Đơn hàng bị hủy"],
    datasets: [{
      data: [qtySucces, qtyFail],
      backgroundColor: ['#007bff', '#dc3545'],
    }],
  },
});
