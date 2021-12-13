jQuery(document).ready(function(){

  //Get Location
  navigator.geolocation.getCurrentPosition(success,error);

  function success(pos){
    var lat = pos.coords.latitude;
    var long = pos.coords.longitude;
    weather(lat,long)
    weekcast(lat,long)
  }

  function error(){
    console.log('error');
  }


  function weather(lat,long){
    var URL = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${long}&appid=d94601353a64a5fb2128ab4ac54617bd&units=metric`;

    jQuery.getJSON(URL,function(data){
      console.log(data);
      updateDOM(data);
    })
  }


  function updateDOM(data){
    var city = data.name;
    var temp = Math.round(data.main.temp);
    var desc = data.weather[0].description;
    var icon = data.weather[0].icon;

    jQuery('#city').html(city);
    jQuery("#temp").html(temp);
    jQuery('#desc').html(desc);
    jQuery('#icon').attr('src',"https://openweathermap.org/img/wn/" + icon + ".png");

  }




  function weekcast(lat,long){
    var URL  = `https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${long}&appid=d94601353a64a5fb2128ab4ac54617bd&units=metric`;

    jQuery.getJSON(URL,function(data){
      console.log(data);
      updateWeekcast(data)
    })
  }

  function updateWeekcast(data){
    var num = 1;
    for(var i = 7; i < 40; i = i+8){
      var date = data.list[i].dt_txt;
      day = dayofweek(date);


      var degree = Math.round(data.list[i].main.temp);
      var icon = data.list[i].weather[0].icon;
      var desc = data.list[i].weather[0].main;

      jQuery('#day'+ num).html(day);
      jQuery('#day' + num + '-degree').html(degree);
      jQuery('#day' + num + '-icon').attr('src',"https://openweathermap.org/img/wn/" + icon + ".png")
      jQuery('#day' + num + '-desc').html(desc);
      num = num + 1


    }
  }


  function dayofweek(date){
    var dt = new Date(date);

    var week = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
    return week[dt.getDay()];
  }









})
