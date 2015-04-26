$(document).on('ready', function () {	
	/* Redirecciones URLs */
	$('a#btnUrlGestionPropietarios').on('click', function (event){
		event.preventDefault();
		var url = "/acceso/franquiciado/panel-franquiciado-gestion-propietarios";
    $(location).attr("href", url);
	});
	$('a#btnUrlGestionRestaurantes').on('click', function (event){
		event.preventDefault();
		var url = "/acceso/franquiciado/panel-franquiciado-gestion-restaurantes";
    $(location).attr("href", url);
	});
	
	$("#nombre_franquiciado").on('keydown', function () {
		borrarMensajesDF();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarNombre();
		};
	});
	$("#apellidos_franquiciado").on('keydown', function () {
		borrarMensajesDF();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarApellidos();
		};
	});
	$("#cif_franquiciado").on('keydown', function () {
		borrarMensajesDF();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarCif();
		};
	});
	$("#email_franquiciado").on('keydown', function () {
		borrarMensajesDF();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarEmail();
		};
	});
	$("#password_franquiciado, #repetir_pass_franquiciado").on('keydown', function () {
		borrarMensajesDF();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarPassword();
		};
	});
	$("#telefono_franquiciado").on('keydown', function () {
		borrarMensajesDF();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarTelefono();
		};
	});
	$("#cp_franquiciado").on('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8)) return false;
		borrarMensajesDF();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarCP();
		};
	});
	$("#provincia_franquiciado, #municipio_franquiciado").on('change', function () {
		borrarMensajesDF();
		clearInterval(parpadeo);
	});
//Para que se ejecute al cargar la página
    $("#provincia_franquiciado option:selected").each(function () {
        provincia = $('#provincia_franquiciado').val();
        localidad = $('#id_localidad').val();
        if (provincia) {
            $.post("/completa-localidades/", {
                provincia: provincia, localidad: localidad
            }, function (data) {
                $("#municipio_franquiciado").html(data);
            });
        }
    });
//Para que se ejecute al cambiar la provincia
    $("#provincia_franquiciado").on('change', function () {
        $("#provincia_franquiciado option:selected").each(function () {
            provincia = $('#provincia_franquiciado').val();
            $.post("/completa-localidades/", {
                provincia: provincia
            }, function (data) {
                //alert(data);
                $("#municipio_franquiciado").html(data);
            });
        });
    });
	$("#message_support_franquiciado").on('keydown', function () {
		$('#mensaje_soporte').css({display:"none"});
	});
});

var parpadeo = '';
var tiempo = 4000;	

/* ----------- DATOS FANQUICIADO ----------- */

function borrarMensajesDF(){
	$('#mensaje_nombre').css({display:"none"});
	$('#mensaje_apellidos').css({display:"none"});
	$('#mensaje_cif').css({display:"none"});
	$('#mensaje_email').css({display:"none"});
	$('#mensaje_password').css({display:"none"});
	$('#mensaje_telefono').css({display:"none"});
	$('#mensaje_cp').css({display:"none"});
	$('#mensaje_provincia').css({display:"none"});
	$('#mensaje_localidad').css({display:"none"});
}

$('#btnEditNombreFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarNombre();
});
function modificarNombre(){
	borrarMensajesDF();
	var nombre_franquiciado = $('#nombre_franquiciado').val();
	
	if(!nombre_franquiciado){
		$('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un nombre</div>');
		$('#mensaje_nombre').css({display:"block"});
        $('#nombre_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'nombre_franquiciado',
			contenido: nombre_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_nombre').css({display:"block"});
			$('#mensaje_nombre').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_nombre').css({display:"block"});
				$('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Nombre modificado correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar el nombre</div>');
			};
		},
		error: function (event) {
			$('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditApellidosFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarApellidos();
});
function modificarApellidos(){
	borrarMensajesDF();
	var apellidos_franquiciado = $('#apellidos_franquiciado').val();
	
	if(!apellidos_franquiciado){
		$('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce los apellidos</div>');
		$('#mensaje_apellidos').css({display:"block"});
        $('#apellidos_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'apellidos_franquiciado',
			contenido: apellidos_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_apellidos').css({display:"block"});
			$('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_apellidos').css({display:"block"});
				$('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Apellidos modificados correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar los apellidos</div>');
			};
		},
		error: function (event) {
			$('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditCifFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarCif();
});
function modificarCif(){
	borrarMensajesDF();
	var cif_franquiciado = $('#cif_franquiciado').val();
	
	if(!cif_franquiciado){
		$('#mensaje_cif').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce CIF / NIF</div>');
		$('#mensaje_cif').css({display:"block"});
        $('#cif_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'cif_franquiciado',
			contenido: cif_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_cif').css({display:"block"});
			$('#mensaje_cif').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_cif').css({display:"block"});
				$('#mensaje_cif').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;CIF / NIF modificado correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_cif').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar el CIF / NIF</div>');
			};
		},
		error: function (event) {
			$('#mensaje_cif').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditEmailFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarEmail();
});
function modificarEmail(){
	borrarMensajesDF();
	var email_franquiciado = $('#email_franquiciado').val();
	
	if(!email_franquiciado){
		$('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un correo electrónico</div>');
		$('#mensaje_email').css({display:"block"});
        $('#email_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
	if (!re.test(email_franquiciado)) {
		$('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato del email incorrecto</div>');
		$('#mensaje_email').css({display:"block"});
        $('#email_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'email_franquiciado',
			contenido: email_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_email').css({display:"block"});
			$('#mensaje_email').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_email').css({display:"block"});
				$('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Correo electrónico modificado correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar el correo electrónico</div>');
			};
		},
		error: function (event) {
			$('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditPasswordFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarPassword();
});
function modificarPassword(){
	borrarMensajesDF();
	var password_franquiciado = $('#password_franquiciado').val();
	var repetir_pass_franquiciado = $('#repetir_pass_franquiciado').val();
	
    if (password_franquiciado.length < 8) {
		$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña debe ser de 8 o más caracteres</div>');
		$('#mensaje_password').css({display:"block"});
        $('#password_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    if (repetir_pass_franquiciado.length < 8) {
		$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña repetida debe ser de 8 o más caracteres</div>');
		$('#mensaje_password').css({display:"block"});
        $('#repetir_pass_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    if (repetir_pass_franquiciado != password_franquiciado) {
		$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña no coincide con la contraseña repetida</div>');
		$('#mensaje_password').css({display:"block"});
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'password_franquiciado',
			contenido: password_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_password').css({display:"block"});
			$('#mensaje_password').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_password').css({display:"block"});
				$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Contraseña modificada correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar la contraseña</div>');
			};
		},
		error: function (event) {
			$('#mensaje_password').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditTelefonoFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarTelefono();
});
function modificarTelefono(){
	borrarMensajesDF();
	var telefono_franquiciado = $('#telefono_franquiciado').val();
	
	if(!telefono_franquiciado){
		$('#mensaje_telefono').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un teléfono</div>');
		$('#mensaje_telefono').css({display:"block"});
        $('#telefono_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'telefono_franquiciado',
			contenido: telefono_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_telefono').css({display:"block"});
			$('#mensaje_telefono').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_telefono').css({display:"block"});
				$('#mensaje_telefono').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Teléfono modificado correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_telefono').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar el telefono</div>');
			};
		},
		error: function (event) {
			$('#mensaje_telefono').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditCPFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarCP();
});
function modificarCP(){
	borrarMensajesDF();
	var cp_franquiciado = $('#cp_franquiciado').val();
	
	if(!cp_franquiciado){
		$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
		$('#mensaje_cp').css({display:"block"});
        $('#cp_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	if(isNaN(cp_franquiciado)){
		$('#mensaje_cp').css({display:"block"});
		$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El Código Postal debe ser numérico</div>');
		$('#mensaje_cp').css({display:"block"});
        $('#cp_franquiciado').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'cp_franquiciado',
			contenido: cp_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_cp').css({display:"block"});
			$('#mensaje_cp').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_cp').css({display:"block"});
				$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Código Postal modificado correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar el código postal</div>');
			};
		},
		error: function (event) {
			$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditProvinciaFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarProvincia();
});
function modificarProvincia(){
	borrarMensajesDF();
	var provincia_franquiciado = $('#provincia_franquiciado').val();
	
	if(provincia_franquiciado == -1){
		$('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una provincia</div>');
		$('#mensaje_provincia').css({display:"block"});
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'provincias_id_provincia',
			contenido: provincia_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_provincia').css({display:"block"});
			$('#mensaje_provincia').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_provincia').css({display:"block"});
				$('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Provincia modificada correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar la provincia</div>');
			};
		},
		error: function (event) {
			$('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditLocalidadFranquiciado').live('click', function(e) {
	e.preventDefault();
	modificarLocalidad();
});
function modificarLocalidad(){
	borrarMensajesDF();
	var municipio_franquiciado = $('#municipio_franquiciado').val();
	
	if(municipio_franquiciado == 'Municipio'){
		$('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un municipio</div>');
		$('#mensaje_localidad').css({display:"block"});
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/franquiciado/editarDatosFranquiciado";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'localidades_id_localidad',
			contenido: municipio_franquiciado
		},
		beforeSend: function (event) {
			$('#mensaje_localidad').css({display:"block"});
			$('#mensaje_localidad').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_localidad').css({display:"block"});
				$('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Municipio modificado correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar el municipio</div>');
			};
		},
		error: function (event) {
			$('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

/* ----------- E-MAIL A SOPORTE TÉCNICO ----------- */

$('#btnEmailSoporte').live('click', function() {
	$('#mensaje_soporte').css({display:"none"});
	
	texto_mensaje_soporte = $('#texto_mensaje_soporte').val();
	
	if(!texto_mensaje_soporte){
		$('#mensaje_soporte').css({display:"block"});
		$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, escriba un mensaje</div>');
		clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	}
	
	texto_mensaje_soporte = "<pre>" + texto_mensaje_soporte + "<pre>";
	
	var url = "/franquiciado/mensajeSoporteTecnico";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			texto_mensaje_soporte: texto_mensaje_soporte
		},
		beforeSend: function (event) {
			$('#mensaje_soporte').css({display:"block"});
			$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			$('#mensaje_soporte').css({display:"block"});
			$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;' + data + '</div>');
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
		},
		error: function (event) {
			$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
});