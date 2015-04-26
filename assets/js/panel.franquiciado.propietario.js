$(document).on('ready', function () {
	baseUrl();
	seleccionPropietario();
	propietariosFranquiciados();
	
	$("#search_nombre_propietario").on('keydown', function () {
		$('#mensaje_buscador').css({display:"none"});
		if(event.keyCode == 13){
			propietariosFranquiciados('buscar');
		};
	});

	/* ----------- DATOS DE PROPIETARIO ----------- */
	
	$("#nombre_propietario").on('keydown', function () {
		borrarMensajesDP();
		if(event.keyCode == 13){
			modificarNombre();
		};
	});
	
	$("#apellidos_propietario").on('keydown', function () {
		borrarMensajesDP();
		if(event.keyCode == 13){
			modificarApellidos();
		};
	});
	
	$("#email_propietario").on('keydown', function () {
		borrarMensajesDP();
		if(event.keyCode == 13){
			modificarCorreo();
		};
	});
	
	$("#password_propietario, #repetir_password").on('keydown', function () {
		borrarMensajesDP();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarPassword();
		};
	});
	
	$("#telefono_propietario").on('keydown', function () {
		borrarMensajesDP();
		if(event.keyCode == 13){
			modificarTelefono();
		};
	});
	
	$("#cp_propietario").on('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8)) return false;
		borrarMensajesDP();
		if(event.keyCode == 13){
			modificarCP();
		};
	});
	
	$("#provincia_propietario, #municipio_propietario").on('change', function () {
		borrarMensajesDP();
	});
	
	// Para que se ejecute al cambiar la provincia
    $("#provincia_propietario").on('change', function () {
        $("#provincia_propietario option:selected").each(function () {
            provincia = $('#provincia_propietario').val();
            $.post("/completa-localidades/", {
                provincia: provincia
            }, function (data) {
                //alert(data);
                $("#municipio_propietario").html(data);
            });
        });
    });
});

var parpadeo = '';
var tiempo = 4000;	
var base_url = '';
var id_propietario_seleccionado = '';

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

/* ----------- SELECCION DE PROPIETARIO ----------- */

function seleccionPropietario(id_propietario){
	borrarMensajesDP();
	
	var url = "/franquiciado/seleccionPropietario";
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_propietario: id_propietario
		},
		beforeSend: function (event) {
			$('.restauranteseleccionado').html('<div align="center"><img src="../../assets/images/loader.gif"/></div>');
		},
		success: function (data) {
            if (data) {
				var data = JSON.parse(data);				
				$('#restauranteseleccionado').html(data.nombre_propietario);
				$('#propietario').css({
                	display: "block"
            	});
				id_propietario_seleccionado = data.id_propietario;
				$('#nombre_propietario').val(data.nombre_propietario);
				$('#apellidos_propietario').val(data.apellidos_propietario);
				$('#email_propietario').val(data.email_propietario);cp_propietario
				$('#telefono_propietario').val(data.telefono_propietario);
				$('#cp_propietario').val(data.cp_propietario);
				
				mensaje = '';
				mensaje = mensaje + '<a href="' + base_url  + 'acceso/franquiciado/alta-propietario-restaurante-plan/' + data.clave_propietario + '">';
				mensaje = mensaje + '	Asignar nuevo restaurante al propietario';
				mensaje = mensaje + '	<span><i class="fa fa-arrow-circle-right"></i></span>';
				mensaje = mensaje + '</a>';
				$('#alta_propietario').html(mensaje);
	
				provincia = data.provincias_id_provincia;
				localidad = data.localidades_id_localidad;
				if (provincia) {
					$("#provincia_propietario option[value="+ provincia +"]").attr("selected",true);
					
					// Para que se ejecute al cargar la página
					$("#provincia_propietario option:selected").each(function () {
						$.post("/completa-localidades/", {
							provincia: provincia, localidad: localidad
						}, function (data) {
							$("#municipio_propietario").html(data);
						});
					});		
				}else{
					$('#provincia_propietario option[selected="selected"]').each( function() { $(this).removeAttr('selected'); } );
					$("#provincia_propietario option:first").attr('selected','selected');
					$('#municipio_propietario option[selected="selected"]').each( function() { $(this).removeAttr('selected'); } );
					$("#municipio_propietario option:first").attr('selected','selected');					
				};
			}else{
				$('#restauranteseleccionado').html('Actualmente no tienes ningún propietario dado de alta.');
				$('#restauranteseleccionado').css({
                	textAlign: "center"
            	});
				$('#propietario').css({
                	display: "none"
            	});
			};
		},
		error: function (event) {
			$('#listadoPropietarios').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};


$('#btnSearchPropietario').live('click', function(e) {
	e.preventDefault();	
	propietariosFranquiciados('buscar');
});
function propietariosFranquiciados(accion){
	var url = "/franquiciado/buscadorPropietariosFranquiciado";
	
	$('#mensaje_buscador').css({display:"none"});
	
	var search_nombre_propietario = $('#search_nombre_propietario').val();
	
	if(!search_nombre_propietario & accion == 'buscar'){
		$('#mensaje_buscador').css({display:"block"});
		$('#mensaje_buscador').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, escriba un nombre de propietario a buscar</div>');
        $('#search_nombre_propietario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			search_nombre_propietario: search_nombre_propietario
		},
		beforeSend: function (event) {
			$('#listadoPropietarios').html('<div align="center"><img src="../../assets/images/loader.gif"/></div>');
		},
		success: function (data) {
            if (data) {
				var data = JSON.parse(data);
				var out = '';
                for (var i in data) {
                	out = out + '<li>';
                	out = out + '	<div class="row">';
                	out = out + '		<div class="col-md-2 nodosfilas ocultar">';
                	out = out + '			<img alt="usuario" width="70" height="70" src="' + base_url + 'assets/images/usuario.png">';
                	out = out + '		</div>';
                	out = out + '		<div class="col-md-6 nodosfilas convertir8">';
                	out = out + '			<div>';
                	out = out + '				<strong>Nombre</strong>: ' + data[i].nombre_propietario;
                	out = out + '			</div>';
                	out = out + '			<div>';
                	out = out + '				<strong>Apellidos</strong>: ' + data[i].apellidos_propietario;
                	out = out + '			</div>';
                	out = out + '			<div>';
					if(data[i].nombre_restaurante){
                		out = out + '				<strong>Restaurante</strong>: ' + data[i].nombre_restaurante;
					}else{
                		out = out + '				<strong>Restaurante</strong>: <span style="color: #F00; font-weight: bold;">(propietario sin restaurante asignado)</span>';
					};
                	out = out + '			</div>';
                	out = out + '		</div>';
                	out = out + '		<div class="col-md-4 nodosfilas">';
                	out = out + '			<div class="enlacesencillo">';
                	out = out + '				<a href="javascript:seleccionPropietario(' + data[i].id_propietario + ')">Seleccionar<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                	out = out + '			</div>';
                	out = out + '		</div>';
                	out = out + '	</div>';
                	out = out + '</li>';
				};
			}else{
				if(accion == 'buscar'){
            		out = '<p style="text-align: center;">No se han encontrado propietarios con ese nombre.</p>';
				}else{
            		out = '<p style="text-align: center;">Actualmente no tienes ningún propietario dado de alta.</p>';
				};
			};
			$('#listadoPropietarios').html(out);
		},
		error: function (event) {
			$('#listadoPropietarios').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};

/* ----------- DATOS DE PROPIETARIO ----------- */

var mensaje_realizado = '';
var mensaje_no_realizado = '';

function borrarMensajesDP(){
	clearInterval(parpadeo);
	
	$('#mensaje_nombre').css({display:"none"});
	$('#mensaje_apellidos').css({display:"none"});
	$('#mensaje_correo').css({display:"none"});
	$('#mensaje_password').css({display:"none"});
	$('#mensaje_telefono').css({display:"none"});
	$('#mensaje_cp').css({display:"none"});
	$('#mensaje_provincia').css({display:"none"});
	$('#mensaje_municipio').css({display:"none"});
};

function modificarDatosPropietario(campo, contenido, zona_mensaje){
	var url = "/franquiciado/editarDatosPropietarioFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_propietario_seleccionado: id_propietario_seleccionado,
			campo: campo,
			contenido: contenido
		},
		beforeSend: function (event) {
			$('#' + zona_mensaje).css({display:"block"});
			$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#' + zona_mensaje).css({display:"block"});
				$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;' + mensaje_realizado + '</div>');
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
				propietariosFranquiciados();
			}else{
				$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;' + mensaje_no_realizado + '</div>');
			};
		},
		error: function (event) {
			$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditNombrePropieratioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarNombre();
});
function modificarNombre(){
	borrarMensajesDP();
	var nombre_propietario = $('#nombre_propietario').val();
	
	if(!nombre_propietario){
		$('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el nombre del propietario</div>');
		$('#mensaje_nombre').css({display:"block"});
        $('#nombre_propietario').focus();
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Nombre modificado correctamente';
	mensaje_no_realizado = 'No se pudo modificar el nombre';
	
	modificarDatosPropietario('nombre_propietario', nombre_propietario, 'mensaje_nombre');
};

$('#btnEditApellidosPropieratioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarApellidos();
});
function modificarApellidos(){
	borrarMensajesDP();
	var apellidos_propietario = $('#apellidos_propietario').val();
	
	if(!apellidos_propietario){
		$('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce los apellidos del propietario</div>');
		$('#mensaje_apellidos').css({display:"block"});
        $('#apellidos_propietario').focus();
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Apellidos modificados correctamente';
	mensaje_no_realizado = 'No se pudieron modificar los apellidos';
	
	modificarDatosPropietario('apellidos_propietario', apellidos_propietario, 'mensaje_apellidos');
};

$('#btnEditCorreoPropieratioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarCorreo();
});
function modificarCorreo(){
	borrarMensajesDP();
	var email_propietario = $('#email_propietario').val();
	
	if (!email_propietario) {
		$('#mensaje_correo').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introuzca un correo electrónico</div>');
		$('#mensaje_correo').css({display:"block"});
        $('#email_propietario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
	if (!re.test(email_propietario)) {
		$('#mensaje_correo').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato de correo electrónico incorrecto</div>');
		$('#mensaje_correo').css({display:"block"});
        $('#email_propietario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Correo electrónico modificado correctamente';
	mensaje_no_realizado = 'No se pudo modificar el correo electrónico';
	
	modificarDatosPropietario('email_propietario', email_propietario, 'mensaje_correo');
};

$('#btnEditPasswordPropietarioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarPassword();
});
function modificarPassword(){
	borrarMensajesDP();
	var password_propietario = $('#password_propietario').val();
	var repetir_password = $('#repetir_password').val();
	
    if (password_propietario.length < 8) {
		$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña debe ser de 8 o más caracteres</div>');
		$('#mensaje_password').css({display:"block"});
        $('#password_propietario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    if (repetir_password.length < 8) {
		$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña repetida debe ser de 8 o más caracteres</div>');
		$('#mensaje_password').css({display:"block"});
        $('#repetir_password').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    if (password_propietario != repetir_password) {
		$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña no coincide con la contraseña repetida</div>');
		$('#mensaje_password').css({display:"block"});
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Contraseña modificada correctamente';
	mensaje_no_realizado = 'No se pudieron modificar la contraseña';
	
	modificarDatosPropietario('pass_propietario', password_propietario, 'mensaje_password');
};

$('#btnEditTelefonoPropieratioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarTelefono();
});
function modificarTelefono(){
	borrarMensajesDP();
	var telefono_propietario = $('#telefono_propietario').val();
	
	if(!telefono_propietario){
		$('#mensaje_telefono').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce los apellidos del propietario</div>');
		$('#mensaje_telefono').css({display:"block"});
        $('#telefono_propietario').focus();
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Teléfono modificado correctamente';
	mensaje_no_realizado = 'No se pudo modificar el teléfono';
	
	modificarDatosPropietario('telefono_propietario', telefono_propietario, 'mensaje_telefono');
};

$('#btnEditCpPropieratioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarCP();
});
function modificarCP(){
	borrarMensajesDP();
	var cp_propietario = $('#cp_propietario').val();
	
	if(!cp_propietario){
		$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
		$('#mensaje_cp').css({display:"block"});
        $('#cp_propietario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	if(isNaN(cp_propietario)){
		$('#mensaje_cp').css({display:"block"});
		$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El Código Postal debe ser numérico</div>');
		$('#mensaje_cp').css({display:"block"});
        $('#cp_propietario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Código postal modificado correctamente';
	mensaje_no_realizado = 'No se pudo modificar el código postal';
	
	modificarDatosPropietario('cp_propietario', cp_propietario, 'mensaje_cp');
};


$('#btnEditProvinciaPropieratioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarProvincia();
});
function modificarProvincia(){
	borrarMensajesDP();
	var provincia_propietario = $('#provincia_propietario').val();
	
	if(provincia_propietario == -1){
		$('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una provincia</div>');
		$('#mensaje_provincia').css({display:"block"});
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Provincia modificada correctamente';
	mensaje_no_realizado = 'No se pudo modificar la provincia';
	
	modificarDatosPropietario('provincias_id_provincia', provincia_propietario, 'mensaje_provincia');
};


$('#btnEditMunicipioPropieratioFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarMunicipio();
});
function modificarMunicipio(){
	borrarMensajesDP();
	var municipio_propietario = $('#municipio_propietario').val();
	
	if(municipio_propietario == 'Municipio'){
		$('#mensaje_municipio').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un municipio</div>');
		$('#mensaje_municipio').css({display:"block"});
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	mensaje_realizado = 'Municipio modificada correctamente';
	mensaje_no_realizado = 'No se pudo modificar el municipio';
	
	modificarDatosPropietario('localidades_id_localidad', municipio_propietario, 'mensaje_municipio');
};
