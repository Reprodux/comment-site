setInterval(displayclock,500);

function displayclock(){
  var time = new Date();
  var hrs = time.getHours();
  var min = time.getMinutes();
  var sec = time.getSeconds();
  var m;

  if (hrs > 12){
    hrs = hrs - 12;
    m = " pm"
  }
  else{
    m = " am"
  }
  if (hrs == 0){
    hrs = 12;
  }

  if (min < 10){
    min = "0" + min;
  }

  if(sec < 10){
    sec = "0" + sec;
  }


  document.getElementById('clock').innerHTML = hrs + ":" + min + ":" +sec + m;
}
