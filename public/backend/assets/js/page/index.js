"use strict";

var label = month.map(function (item) {
    return 'Tháng' + ' ' + item.extracted_month;
});
var total = month.map(function (item) {
    return item.moneyTotal;
});
// console.log(label);
// console.log(total);

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: label,
    datasets: [{
      label: 'Doanh số',
      data: total,
      borderWidth: 2,
      backgroundColor: '#6777ef',
      borderColor: '#6777ef',
      borderWidth: 2.5,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          drawBorder: false,
          color: '#f2f2f2',
        },
        ticks: {
          beginAtZero: true,
          stepSize: 1500000,
          callback: function(stepSize) {
            if (parseInt(stepSize) >= 1000) {
                return  stepSize.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + 'đ';
            } else {
                return stepSize+ 'đ';
            }
        },
        }
      }],
      xAxes: [{
        ticks: {
          display: false
        },
        gridLines: {
          display: false
        }
      }]

    },
  }
});



