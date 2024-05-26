const charts = document.querySelectorAll(".chart");

charts.forEach(function (chart) {
  var ctx = chart.getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [
        {
          label: "# of Votes",
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});

$(document).ready(function () {
  $(".data-table").each(function (_, table) {
    $(table).DataTable();
  });
});

window.onload = function(){
  // var masterPage = document.getElementById('main-body');

  // let newheight = (window.innerHeight - 250) < 550 ? 550 : (window.innerHeight - 250);
  // masterPage.style.minHeight =  newheight +'px';
  var today = document.getElementById('today');

  const date = new Date();

  let day = date.getDate();
  let month = date.getMonth() + 1;
  let year = date.getFullYear();

  if(month == 1) {
    month = 'January';
  }
  else if(month == 2) {
    month = 'February';
  }
  else if(month == 3) {
    month = 'March';
  }
  else if(month == 4) {
    month = 'April';
  }
  else if(month == 5) {
    month = 'May';
  }
  else if(month == 6) {
    month = 'June';
  }
  else if(month == 7) {
    month = 'July';
  }
  else if(month == 8) {
    month = 'August';
  }
  else if(month == 9) {
    month = 'September';
  }
  else if(month == 10) {
    month = 'October';
  }
  else if(month == 11) {
    month = 'November';
  }
  else if(month == 12) {
    month = 'December';
  }

  today.innerText = day + ' of ' + month + ' ' + year;
};

function doIncrement(maxVaue)
{
  var daysRemaining = document.getElementById('days_remaining');
  var thisValue = daysRemaining.innerHTML;
  while(maxVaue > thisValue)
  {
    thisValue++;
    daysRemaining.innerHTML = thisValue;
  }
}
