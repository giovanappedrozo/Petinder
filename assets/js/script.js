function showPosition(position){        
  var latitude = document.getElementById("latitude");
  var longitude = document.getElementById("longitude");

  latitude = latitude.value = position.coords.latitude;
  longitude = longitude.value = position.coords.longitude;
}
    
function showError(error){
  switch(error.code) {
    case error.PERMISSION_DENIED:
      check = document.getElementById('localizacao');
      check.checked = false;
      break;
    case error.POSITION_UNAVAILABLE:
      window.alert("Localização indisponível.");
      break;
    case error.TIMEOUT:
      window.alert("A requisição expirou.");
      break;
    case error.UNKNOWN_ERROR:
      window.alert("Algum erro desconhecido aconteceu.");
      break;
  }
}

function getLocation(){
  if (navigator.geolocation){
    navigator.geolocation.getCurrentPosition(showPosition,showError);
  }
  else{x.innerHTML="Seu browser não suporta Geolocalização.";}
}

$('#chat_area').animate({
  scrollTop: $(this).height() 
}, 300);

setInterval(function(){
  load_not_msg();
}, 1000);

setInterval(function(){
  load_notifications();
}, 1000);

function racas(){
  var especie = $("#reg-especie option:selected").val();
  $.ajax({
          url:"https://petinderapp.azurewebsites.net/index.php/animais/racas",
          method:"POST",
          data: {especie: especie},
          dataType: 'json',
          success:function(data){
                  var output = '';
                  if(data.length > 0)
                  {
                    console.log();
                          for(var count = 0; count < data.length; count++)
                          {
                            if(count == 0 && window.location.href == 'https://petinderapp.azurewebsites.net/index.php/animais/register')
                              output += '<option value="'+data[count].id_raca+'" disabled>'+data[count].raca+'</option>';
                            else
                              output += '<option value="'+data[count].id_raca+'">'+data[count].raca+'</option>';
                          }
                  }
                  $('#reg-raca').html(output);
          }
  });
}
