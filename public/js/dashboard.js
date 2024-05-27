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