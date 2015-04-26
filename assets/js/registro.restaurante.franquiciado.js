$(document).on('ready', function () {
								  
	baseUrl();
	listarRestaurantes();
	
	var parpadeo = '';
	var tiempo = 4000;	
	
	//Para que se ejecute al volver a la página
	$("#provincia_propietario option:selected").each(function () {
		provincia = $('#provincia_propietario').val();
		$.post("/completa-localidades/", {
			provincia: provincia
			}, function (data) {
				$("#municipio_propietario").html(data);
			});
	});
	//Para que se ejecute al cambiar la provincia
    $("#provincia_propietario").on('change', function () {
        $("#provincia_propietario option:selected").each(function () {
            provincia = $('#provincia_propietario').val();
            $.post("/completa-localidades/", {
                provincia: provincia
				}, function (data) {
					$("#municipio_propietario").html(data);
				});
        });
    });

	function scrollMensaje(){
		$('html, body').animate({
			scrollTop: 230
		}, 2000);			 
		
		$('#mensaje_facturacion').css({display:"block"});
	};

	function borrarMensaje(){
		$('#mensaje_validacion').css({display:"none"});
	};
	
	$("#nombre_propietario, #apellidos_propietario, #email_propietario, #password_propietario, #password_repetido, #telefono_propietario").on('keydown', function () {
		borrarMensaje();
		if(event.keyCode == 13){
			validar();
		};
	});
	$("#provincia_propietario, #municipio_propietario").on('change', function () {
		borrarMensaje();
	});
	
	$("#cp_propietario").on('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8) && !(event.keyCode == 9)) return false;
		borrarMensaje();
		if(event.keyCode == 13){
			validar();
		};
	});

	$("#btnValidar").on('click', function () {
		borrarMensaje();
		validar();
	});
					
	function validar(){
		
		function parpadeoOn(){
			$('#mensaje_validacion').css({display:"block"});
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			scrollMensaje();
		};
		
		if(!$('#nombre_propietario').val()){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un nombre de propietario</div>');
			$('#nombre_propietario').focus();
			parpadeoOn();
			return false;
		};
		
		if(!$('#apellidos_propietario').val()){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce los apellidos de propietario</div>');
			$('#apellidos_propietario').focus();
			parpadeoOn();
			return false;
		};
		
		if(!$('#email_propietario').val()){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un correo electrónico</div>');
			$('#email_propietario').focus();
			parpadeoOn();
			return false;
		};
	
		var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
		if(!re.test($('#email_propietario').val())){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, formato de correo electrónico incorrecto</div>');
			$('#email_propietario').focus();
			parpadeoOn();
			return false;
		};
		
    	if($('#password_propietario').val().length < 8){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña debe ser de 8 o más caracteres</div>');
			$('#password_propietario').focus();
			parpadeoOn();
			return false;
		};
		
    	if($('#password_repetido').val().length < 8){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña repetida debe ser de 8 o más caracteres</div>');
			$('#password_repetido').focus();
			parpadeoOn();
			return false;
		};
	
		if ($('#password_propietario').val() != $('#password_repetido').val()) {
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña no coincide con la contraseña repetida</div>');
			parpadeoOn();
			return false;
		};
		
		if(!$('#telefono_propietario').val()){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un teléfono</div>');
			$('#telefono_propietario').focus();
			parpadeoOn();
			return false;
		};
	
		if (!$('#cp_propietario').val()) {
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
			$('#cp_propietario').focus();
			parpadeoOn();
			return false;
		};
		
		if(isNaN($('#cp_propietario').val())){
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
			$('#cp_propietario').focus();
			parpadeoOn();
			return false;
		};
	
		if ($('#provincia_propietario').val() == -1) {
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una provincia</div>');
			parpadeoOn();
			return false;
		};
	
		if ($('#municipio_propietario').val() == 'Municipio') {
			$('#mensaje_validacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un municipio</div>');
			parpadeoOn();
			return false;
		};
		
		$("#reg-propietario-franquiciado").submit();
	
	};
	
});

	
// BAJA DE RESTAURANTES

function baseUrl(){
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
};

function listarRestaurantes(){
	
	$('#baja_restaurantes').html('<div class="row"><p align="center"><img src="' + base_url + 'assets/images/loader.gif"/></p></div>');
	
	var url = "/franquiciado/listadoBajaRestaurantesFranquiciado";
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
		},
		beforeSend: function (event) {
			$('#baja_restaurantes').html('<div class="row"><p align="center"><img src="' + base_url + 'assets/images/loader.gif"/></p></div>');
		},
		success: function (data) {
            if (data) {
				var data = JSON.parse(data);
				var out = '';
                for (var i in data) {
                	out = out + '<li>';
                	out = out + '	<div class="row">';
                	out = out + '		<div class="col-md-2 nodosfilas ocultar">';
                	out = out + '			<img alt="" src="' + base_url + 'assets/images/restaurantes/00001_Restaurante01/principal.jpg">';
                	out = out + '		</div>';
                	out = out + '		<div class="col-md-6 nodosfilas convertir8">';
                	out = out + '			<div>';
                	out = out + '				<strong>Restaurante</strong>: ' + data[i].nombre_restaurante;
                	out = out + '			</div>';
                	out = out + '			<div>';
                	out = out + '				<strong>Municipio</strong>: ' + data[i].nombre_localidad;
                	out = out + '			</div>';
                	out = out + '			<div>';
                	out = out + '				<strong>Propietario</strong>: ' + data[i].nombre_propietario;
                	out = out + '			</div>';
                	out = out + '			<div>';
                	out = out + '				<strong>Apellidos</strong>: ' + data[i].apellidos_propietario;
                	out = out + '			</div>';
                	out = out + '		</div>';
                	out = out + '		<div class="col-md-4 nodosfilas" id="' + data[i].id_restaurante + '">';
                	out = out + '			<div class="enlacesencillo" id="deleteRestaurant">';
                	out = out + '				<a href="javascript:mostrarEliminarRestaurante(' + data[i].id_restaurante + ')">Eliminar<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                	out = out + '			</div>';
                	out = out + '		</div>';
					
                	out = out + '		<div id="showMessageDeleteRestaurant_' + data[i].id_restaurante + '" class="oculto" style="display: none;">';
                	out = out + '			<div class="col-md-12">';
                	out = out + '				<div class="callout callout-3">';
                	out = out + '					<h6>¿Estás seguro de que quieres eliminar el restaurante?</h6>';
                	out = out + '					<div class="row">';
                	out = out + '						<div class="col-md-8">';
                	out = out + '							<p>La acción no se puede deshacer. Se eliminarán también todos los menús asociados.</p>';
                	out = out + '						</div>';
                	out = out + '						<div class="col-md-2 nodosfilas">';
                	out = out + '							<div class="callout-a ">';
                	out = out + '								<a href="javascript:eliminarRestaurante(' + data[i].id_restaurante + ');" class="button-4">&nbsp;&nbsp;Sí&nbsp;&nbsp;</a>';
                	out = out + '							</div>';
                	out = out + '						</div>';
                	out = out + '						<div class="col-md-2 nodosfilas">';
                	out = out + '							<div class="callout-a ">';
                	out = out + '								<a href="javascript:ocultarEliminar(' + data[i].id_restaurante + ')" class="button-4">&nbsp;&nbsp;No&nbsp;&nbsp;</a>';
                	out = out + '							</div>';
                	out = out + '						</div>';
                	out = out + '					</div>';
                	out = out + '				</div>';
                	out = out + '			</div>';
                	out = out + '		</div>';
					
                	out = out + '	</div>';
                	out = out + '</li>';
				};
			}else{
            	out = '<div class="row"><p align="center"><b>Actualmente no tienes registrado ningún restaurante.</b></p></div>';
			};
			$("#baja_restaurantes").html(out);
		},
		error: function (event) {
			$('#baja_restaurantes').html('<div class="row"><p align="center"><b><i class="fa fa-info-circle"></i>&nbsp;Error</b></p></div>');
		}
	});
	
};

function mostrarEliminarRestaurante(id_restaurante){
	$('#showMessageDeleteRestaurant_'+id_restaurante).show();
};

function ocultarEliminar(id_restaurante){
	$('#showMessageDeleteRestaurant_'+id_restaurante).hide();
};

function eliminarRestaurante(id_restaurante){
	
	var url = "/franquiciado/eliminarRestaurantesFranquiciado";
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_restaurante: id_restaurante
		},
		beforeSend: function (event) {
			$('#baja_restaurantes').html('<div class="row"><p align="center"><img src="' + base_url + 'assets/images/loader.gif"/></p></div>');
		},
		success: function (data) {
            if (data == 1) {
				listarRestaurantes();
			}else{
            	$("#baja_restaurantes").html('<div class="row"><p align="center"><b>No se pudo eliminar el restaurante.</b></p></div>');
			};
		},
		error: function (event) {
			$('#baja_restaurantes').html('<div class="row"><p align="center"><b><i class="fa fa-info-circle"></i>&nbsp;Error</b></p></div>');
		}
	});
	
};