$(document).on('ready', function () {
						
	$("#nombre_restaurante_2, #web_restaurante, #email_restaurante, #calle_restaurante, #municipio_restaurante, #provincia_restaurante, #barrio_restaurante").on('keydown', function () {
		$('#mensaje_resultado').css({display:"none"});
		if(event.keyCode == 13){
			camino();
		};
	});
	
	$("#numero_restaurante").on('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8) && !(event.keyCode == 9)) return false;
		$('#mensaje_resultado').css({display:"none"});
		if(event.keyCode == 13){
			camino();
		};
	});
	
	$("#cp_restaurante").on('change', function () {
		$('#mensaje_resultado').css({display:"none"});
	});
	
	$('input#comprobar_ubicacion').on('click', function (event){
		validarDatos('ubicacion');
	});
	
	$('input#paso_siguiente_pag').on('click', function (event){
		validarDatos('guardar');
	});
	
});

/*function baseUrl(){
	var url = "/franquiciado/baseURL";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
		},
		success: function (data) {
			base_url = data;
		}
	});
};*/

var parpadeo = '';
var tiempo = 4000;	

var latlong_restaurante = '';
  
function camino(){
	if($('#paso_siguiente_pag').is(':visible')){
		validarDatos('guardar');
	}else{
		validarDatos('ubicacion');
	};
};

function scrollMensaje(){
    $('html, body').animate({
        scrollTop: $("#mensaje_resultado").offset().top
    }, 2000);
};

function validarDatos(accion){
	
	$('#mensaje_resultado').css({display:"block"});
	
	function parpadeoOn(){
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		scrollMensaje();
	};
	
	if(!$('#nombre_restaurante_2').val()){
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el nombre del restaurante</div>');
		$('#mensaje_resultado').css({display:"block"});
        $('#nombre_restaurante_2').focus();
		parpadeoOn();
		return false;
	};
	
	if (!$('#email_restaurante').val() && $('#clave_plan').val() != 'eJ6RW7aD') {
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca un correo electrónico</div>');
        $('#email_restaurante').focus();
		parpadeoOn();
		return false;
	};
	
    var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
	if (!re.test($('#email_restaurante').val()) && $('#clave_plan').val() != 'eJ6RW7aD') {
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato de correo electrónico incorrecto</div>');
        $('#email_restaurante').focus();
		parpadeoOn();
		return false;
	};
	
	if (!$('#calle_restaurante').val()) {
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca una calle</div>');
        $('#calle_restaurante').focus();
		parpadeoOn();
		return false;
	};
	
	if (!$('#numero_restaurante').val()) {
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca un número</div>');
        $('#numero_restaurante').focus();
		parpadeoOn();
		return false;
	};
	
	if(isNaN($('#numero_restaurante').val())){
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El número de la dirección debe ser numérico</div>');
        $('#numero_restaurante').focus();
		parpadeoOn();
		return false;
	};
	
	if ($('#cp_restaurante').val() == -1) {
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca un código postal</div>');
		parpadeoOn();
		return false;
	};
	
	if(accion == 'guardar'){
		if (!$('#municipio_restaurante').val()) {
			$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca un municipio</div>');
			$('#municipio_restaurante').focus();
			parpadeoOn();
			return false;
		};
		
		if (!$('#provincia_restaurante').val()) {
			$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca una provincia</div>');
			$('#provincia_restaurante').focus();
			parpadeoOn();
			return false;
		};
	};
	
	if (!$('#barrio_restaurante').val()) {
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca un barrio</div>');
		$('#barrio_restaurante').focus();
		parpadeoOn();
		return false;
	};
	
	if ($('#precio_medio_restaurante').val() == -1) {
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un precio medio de la carta</div>');
		parpadeoOn();
		return false;
	};
	
	if(accion == 'ubicacion'){
		comprobarUbicacion();
	}else{
		guardarDatos();
	};
};
  
function comprobarUbicacion(){
	var geocoder = new google.maps.Geocoder();
	var address = $("#calle_restaurante").val() + ', ' + $("#numero_restaurante").val() + ', ' + $("#cp_restaurante").val();
	
	//buscamos en la region de españa
	geocoder.geocode({'address': address, 'region': 'es'}, function (results, status) {
		if (status == 'OK') {
			//Calle
			if (results[0].address_components[1]) {
				$('#calle_restaurante').val(results[0].address_components[1].long_name);
			} else {
				//alert('Componente1 vacío');
			}
			//Código Postal
			if (results[0].address_components[7]) {
				//$('#cp_restaurante').val(results[0].address_components[7].long_name);
			} else {
				//alert('Componente7 vacío');
			}
			//Localidad o municipio
			if (results[0].address_components[2]) {
				$('#municipio_restaurante').val(results[0].address_components[2].long_name);
			} else {
				//alert('Componente2 vacío');
			}
			//La provincia la sacamos del componente 4
			if (results[0].address_components[4]) {
				$('#provincia_restaurante').val(results[0].address_components[4].long_name);
			}
	
			latlong_restaurante = results[0].geometry.location;
			$('#municipio_restaurante').prop('disabled', false);
			$('#provincia_restaurante').prop('disabled', false);
			
			var completeAddress;
			//Nombre de la calle
			if (results[0].address_components[1]) {
				completeAddress = results[0].address_components[1].long_name;
			}
			//Numero de la calle
			if (results[0].address_components[0]) {
				completeAddress = completeAddress + ', ' + results[0].address_components[0].long_name;
			}
			//Localidad
			if (results[0].address_components[2]) {
				completeAddress = completeAddress + ' ' + results[0].address_components[2].long_name;
			}
			//Código postal
			if (results[0].address_components[7]) {
				completeAddress = completeAddress + ' ' + results[0].address_components[7].long_name;
			}
			completeAddress = completeAddress + ' (' + $('#provincia_restaurante').val() + ')';
			
			$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;Google ha reconocido la siguiente dirección: ' + completeAddress + '</div>');
			
   			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			
			$('.button-3').show(); 
			
		} else {
			$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;Google no reconoce la dirección. Por favor rectifique la misma.</div>');

   			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
	
		}
	
	});
};
  
function guardarDatos(){
													
    $('#mensaje_resultado').html('');			  												
	$('#mensaje_resultado').css({display:"block"});
	

    var nombre = $('#nombre_restaurante_2').val();
    var nombre_select = $('#nombre_select_restaurante').val(); //Tipo de establecimiento
    var direccion = $('#calle_restaurante').val();
    var numero = $('#numero_restaurante').val();
    var municipio = $('#municipio_restaurante').val();

    var plan = $('#clave_plan').val(); //Clave que hace referencia al Plan que se ha contratado		
    var email = $('#email_restaurante').val();
    var cp = $('#cp_restaurante').val();
    var barrio = $('#barrio_restaurante').val();
    var precio_medio = $('#precio_medio_restaurante').val();
    var parking = $('#parking_restaurante').val();
    var tarjetas = $('#tarjetas_restaurante').val();
    var reservas = $('#reservas_restaurante').val();
    var visible = $('#visible_restaurante').val();
    var id = $('#id_propietario').val();
	
	var web = $('#web_restaurante').val();
	var web_final = '';
	if(web){
		var cadena = web.substring(web.length-7, web.length);
	
		if(cadena != "http://"){
			web_final = "http://"+web;
		}else{
			web_final = web;
		};
	};



    /* Compruebo si hay parking o no */
    if($('input[name=parking_restaurante]').is(':checked')){
      var parking = 1;
    }else{
      var parking = 0;
    }

    /* Compruebo si se aceptan tarjetas o no */
    if($('input[name=tarjetas_restaurante]').is(':checked')){
      var tarjetas = 1;
    }else{
      var tarjetas = 0;
    }

    /* Compruebo si se permiten reservas */
    if($('input[name=reservas_restaurante]').is(':checked')){
      var reservas = 1;
    }else{
      var reservas = 0;
    }

    /* Compruebo si el restaurante es visible o no -> Visible hace referencia a si el restaurante es facil de ver. */
    if($('input[name=visible_restaurante]').is(':checked')){
      var visible = 1;
    }else{
      var visible = 0;
    }

    clearInterval(parpadeo);
	
    var url = "/franquiciado/altaPropietariosFranquiciado2";

	/* --- Si no se pone esto da error al enviar --- */
	latlong_restaurante = latlong_restaurante + '';
	/* --- Si no se pone esto da error al enviar --- */
	
    $.ajax({
      type: "POST",
      url: url,
	  async: false,
      data: {
		// Ordenado por el orden de la tabla de la base de datos
		nombre_restaurante: nombre,
      	nombre_select_restaurante: nombre_select,
		direccion_restaurante: direccion,
		numero_restaurante: numero,
		latlong_restaurante: latlong_restaurante,
		barrio_restaurante: barrio,
		web_restaurante: web_final,
		email_restaurante: email,
		cp_restaurante: cp,
		precio_medio_restaurante: precio_medio,
		reservas_restaurante: reservas,
		parking_restaurante: parking,
		tarjetas_restaurante: tarjetas,
		visible_restaurante: visible,
		localidad: municipio,
		clave_plan: plan,
      	id_propietario: id,
		//localidad: municipio,
	  },

      beforeSend: function (event){
        $('#mensaje_resultado').html('<div align="center"><img src="../../../../assets/images/loader.gif" /></div>');
      },

      success: function (data){
		  
		var datos = data.split("separadorsplit");
		
		if(datos[0] == 1){
			
			/*$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Restaurante añadido con éxito</div>');
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);*/
			
         	//var url = "/acceso/franquiciado/alta-propietario-franquiciado-3?clave_rest="+clave_rest+"&clave_plan="+plan;
			if($('#nuevo_propietario').val() == 1){
         		var url = "/acceso/franquiciado/alta-propietario-franquiciado-3/" + plan + "/nuevo-propietario-" + datos[1];
			}else{
         		var url = "/acceso/franquiciado/alta-propietario-franquiciado-3/" + plan + "/" + datos[1];
			};
        	$(location).attr('href',url);
			
		}else{
			$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudieron guardar los datos. - '+data+'</div>');
		};
      },

      error: function (event){
          $('#mensaje_resultado').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.</div>');
      },

    });
    return false;
};


