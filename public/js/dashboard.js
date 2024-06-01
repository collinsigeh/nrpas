window.onload = function(){
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



    // counter things begin
    const counters = document.querySelectorAll('.counter');
    const speed = 200; // The lower the slower

    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;

        // Lower inc to slow and higher to slow
        const inc = target / speed;

        // console.log(inc);
        // console.log(count);

        // Check if target is reached
        if (count < target) {
          // Add inc to count and output in counter
          counter.innerText = Math.ceil(count + inc);
          // Call function every ms
          setTimeout(updateCount, 1);
        } else {
          counter.innerText = target;
        }
      };

      updateCount();
    });
    // counter things have ended.
  };