$(document).on('ready', function () {	
	platosPreferidos();	
	cpFavoritos();			
	restaurantesFavoritos();
	
	$("#nombre_nuevo_plato").live('keydown', function () {
		$('#mensaje_platos').css({display:"none"});
	});
	
	$("#nuevo_cp").live('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8)) return false;
		$('#mensaje_cps').css({display:"none"});
	});
	
	$("#nombre_usuario").on('keydown', function () {
		borrarMensajesDP();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarNombre();
		};
	});
	
	$("#buscar_restaurante").live('keydown', function () {
		$('#mensaje_restaurantes').css({display:"none"});
	});
	
	$("#apellidos_usuario").on('keydown', function () {
		borrarMensajesDP();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarApellidos();
		};
	});
	
	$("#correo_usuario").on('keydown', function () {
		borrarMensajesDP();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarCorreo();
		};
	});
	
	$("#pass_usuario, #repetir_pass").on('keydown', function () {
		borrarMensajesDP();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarPass();
		};
	});
	
	$("#localidad_usuario").on('keydown', function () {
		borrarMensajesDP();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarLocalidad();
		};
	});
	
	$("#cp_usuario").on('keydown', function () {
		borrarMensajesDP();
		clearInterval(parpadeo);
		if(event.keyCode == 13){
			modificarCP();
		};
	});
	
	$("#email_usuario_tlm").on('keydown', function () {
		$('#mensaje_tlm').css({display:"none"});
	});
	
	$("#dia_cumpleanos_usuario, #mes_cumpleanos_usuario, #ano_cumpleanos_usuario, #sexo_usuario_tlm, #pregunta_tlm_a, #pregunta_tlm_b").on('change', function () {
		$('#mensaje_tlm').css({display:"none"});
	});
	
	$("#texto_mensaje_soporte").on('keydown', function () {
		$('#mensaje_soporte').css({display:"none"});
	});
});

/* ----------- PLATOS FAVORITOS ----------- */

var platos_duplicados = '';
function platosPreferidos(){
	var url = "/usuario/platosPreferidos";
	
	$('#mensaje_platos').css({display:"none"});
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			//id_usuario: id_usuario
		},
		beforeSend: function (event) {
			$('#platos-favoritos').html('<div align="center"><img src="assets/images/loader.gif"/></div>');
		},
		success: function (data) {
			var datos = data.split("separadorsplit");
			$('#platos-favoritos').html(datos[0]);
			platos_duplicados = datos[1];
			platos_duplicados = platos_duplicados.toLowerCase();
			$('#anadir-platos').html(datos[2]);
		},
		error: function (event) {
			$('#platos-favoritos').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};

$('#btnAddPlatoFavorito').live('click', function(e) {
	e.preventDefault();
	$('#addPlatoFavorito').submit();
});
$("#addPlatoFavorito").live('submit', function () {
	var url = "/usuario/anadirPlatoFavorito";
	
	var nombre_plato = $('#nombre_nuevo_plato').val();
	$('#mensaje_platos').css({display:"none"});
	
	if(nombre_plato == ''){
		$('#mensaje_platos').css({display:"block"});
		$('#mensaje_platos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Introduzca un nuevo plato favorito</div>');
        $('#nombre_nuevo_plato').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	nombre_plato_minusculas = nombre_plato.toLowerCase();
	if(platos_duplicados.indexOf('-r-' + nombre_plato_minusculas + '-r-') != -1){
		$('#mensaje_platos').css({display:"block"});
		$('#mensaje_platos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Ya tiene ese plato seleccionado como favorito</div>');
        $('#nombre_nuevo_plato').focus();
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
			nombre_plato: nombre_plato
		},
		beforeSend: function (event) {
			$('#mensaje_platos').html('<div align="center"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				platosPreferidos();
			}else{
				$('#mensaje_platos').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;No se pudo a&ntilde;adir el plato</div>');
			};
		},
		error: function (event) {
			$('#mensaje_platos').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
	return false;
});	 

function eliminarPlato(id_preferido){
	var url = "/usuario/eliminarPlatoFavorito";
	
	$('#mensaje_platos').css({display:"none"});
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_preferido: id_preferido
		},
		beforeSend: function (event) {
			$('#mensaje_platos').html('<div align="center"><img src="assets/images/loader.gif"/></div>');
		},
		success: function (data) {
			if(data == 1){
				platosPreferidos();
			}else{
				$('#mensaje_platos').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;No se pudo borrar el plato</div>');
			};
		},
		error: function (event) {
			$('#mensaje_platos').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};

/* ----------- CP FAVORITOS ----------- */

var parpadeo = '';
var tiempo = 4000;		

var cp_duplicados = '';
function cpFavoritos(){
	var url = "/usuario/cpFavoritos";
	
	$('#mensaje_cps').css({display:"none"});
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
		},
		beforeSend: function (event) {
			$('#mensaje_cps').html('<div align="center"><img src="assets/images/loader.gif"/></div>');
		},
		success: function (data) {
			var datos = data.split("separadorsplit");
			$('#cp-favoritos').html(datos[0]);
			cp_duplicados = datos[1];
			$('#anadir-cp').html(datos[2]);
		},
		error: function (event) {
			$('#mensaje_cps').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};

$('#btnAnadirCPFavorito').live('click', function(e) {
	e.preventDefault();
	$('#addCPFavorito').submit();
});
$("#addCPFavorito").live('submit', function () {
	var url = "/usuario/anadirCPFavorito";
	
	var nuevo_cp = $('#nuevo_cp').val();
	$('#mensaje_cps').css({display:"none"});
	
	if(nuevo_cp == ''){
		$('#mensaje_cps').css({display:"block"});
		$('#mensaje_cps').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca un nuevo Código Postal favorito</div>');
		$('#mensaje_cps').css({display:"block"});
        $('#nuevo_cp').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	if(isNaN(nuevo_cp)){
		$('#mensaje_cps').css({display:"block"});
		$('#mensaje_cps').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El Código Postal debe ser numérico</div>');
		$('#mensaje_cps').css({display:"block"});
        $('#nuevo_cp').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	if(cp_duplicados.indexOf('-r-' + nuevo_cp + '-r-') != -1){
		$('#mensaje_cps').css({display:"block"});
		$('#mensaje_cps').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Ya tiene ese código postal como favorito</div>');
        $('#nuevo_cp').focus();
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
			nuevo_cp: nuevo_cp
		},
		beforeSend: function (event) {
			$('#mensaje_cps').html('<div align="center"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				cpFavoritos();
			}else{
				$('#mensaje_cps').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;No se pudo a&ntilde;adir el CP</div>');
			};
		},
		error: function (event) {
			$('#mensaje_cps').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
	return false;
});	 

function eliminarCP(id_cp){
	var url = "/usuario/eliminarCPFavorito";
	
	$('#mensaje_cps').css({display:"none"});
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_cp: id_cp
		},
		beforeSend: function (event) {
			$('#mensaje_cps').html('<div align="center"><img src="assets/images/loader.gif"/></div>');
		},
		success: function (data) {
			if(data == 1){
				cpFavoritos();
			}else{
				$('#mensaje_cps').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;No se pudo borrar el CP</div>');
			};
		},
		error: function (event) {
			$('#mensaje_cps').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};

/* ----------- RESTAURANTES FAVORITOS ----------- */

var restaurantes_duplicados = '';
function restaurantesFavoritos(){
	var url = "/usuario/restaurantesFavoritos";
	
	$('#mensaje_restaurantes').css({display:"none"});
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
		},
		beforeSend: function (event) {
			$('#mensaje_restaurantes').html('<div align="center"><img src="assets/images/loader.gif"/></div>');
		},
		success: function (data) {
			var datos = data.split("separadorsplit");
			$('#restaurantes-favoritos').html(datos[0]);
			restaurantes_duplicados = datos[1]
			$('#buscador-restaurantes').html(datos[2]);
			$('#listado-restaurantes').html('');
		},
		error: function (event) {
			$('#mensaje_restaurantes').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};

function borrarRestFav(id_rest_fav){
	var url = "/usuario/eliminarRestauranteFavorito";
	
	$('#mensaje_restaurantes').css({display:"none"});
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_rest_fav: id_rest_fav
		},
		beforeSend: function (event) {
			$('#mensaje_restaurantes').html('<div align="center"><img src="assets/images/loader.gif"/></div>');
		},
		success: function (data) {
			if(data == 1){
				restaurantesFavoritos();
			}else{
				$('#mensaje_restaurantes').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;No se pudo borrar el Restaurante</div>');
			};
		},
		error: function (event) {
			$('#mensaje_restaurantes').html('<span><i class="fa fa-info-circle"></i>&nbsp;Error</span>');
		}
	});
};

$('#btnBuscarRestaurantes').live('click', function(e) {
	e.preventDefault();
	$('#buscarRestauranteFavorito').submit();
});
$("#buscarRestauranteFavorito").live('submit', function () {
	var url = "/usuario/buscarRestauranteFavorito";
	
	$('#mensaje_restaurantes').css({display:"none"});
	
	var buscar_restaurante = $('#buscar_restaurante').val();
	
	if(buscar_restaurante == ''){
		$('#mensaje_restaurantes').css({display:"block"});
		$('#mensaje_restaurantes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, escriba un nombre de restaurante a buscar</div>');
        $('#buscar_restaurante').focus();
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
			buscar_restaurante: buscar_restaurante
		},
		beforeSend: function (event) {
			$('#listado-restaurantes').html('<div align="center"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			$('#listado-restaurantes').html(data);
		},
		error: function (event) {
			$('#mensaje_restaurantes').html('<div class="clear"></div><div class="col-md-12"><span><i class="fa fa-info-circle"></i>&nbsp;Error</span></div>');
		}
	});
	return false;
});	 

function addRestFav(id_rest_fav) {
	var url = "/usuario/anadirRestauranteFavorito";
	
	$('#mensaje_restaurantes').css({display:"none"});
	//alert(restaurantes_duplicados+'------'+id_rest_fav);
	if(restaurantes_duplicados.indexOf('-r-' + id_rest_fav + '-r-') != -1){
		$('#mensaje_restaurantes').css({display:"block"});
		$('#mensaje_restaurantes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Ya tiene ese restaurante como favorito</div>');
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
			id_rest_fav: id_rest_fav
		},
		beforeSend: function (event) {
			$('#restaurantes-favoritos').html('<div align="center"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				restaurantesFavoritos();
			}else{
				$('#mensaje_restaurantes').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;No se pudo a&ntilde;adir el restaurante</div>');
			};
		},
		error: function (event) {
			$('#mensaje_restaurantes').html('<div align="center"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
	return false;
};	

/* ----------- DATOS PERSONALES ----------- */

function borrarMensajesDP(){
	$('#mensaje_nombre').css({display:"none"});
	$('#mensaje_apellidos').css({display:"none"});
	$('#mensaje_correo').css({display:"none"});
	$('#mensaje_pass').css({display:"none"});
	$('#mensaje_localidad').css({display:"none"});
	$('#mensaje_cp').css({display:"none"});
}

$('#btnEditUser').live('click', function(e) {
	e.preventDefault();
	modificarNombre();
});
function modificarNombre(){
	borrarMensajesDP();
	var nombre_usuario = $('#nombre_usuario').val();
	
	if(!nombre_usuario){
		$('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce tu nombre</div>');
		$('#mensaje_nombre').css({display:"block"});
        $('#nombre_usuario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/usuario/editarDatosUsuario";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'nombre_usuario',
			contenido: nombre_usuario
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

$('#btnEditApellidos').live('click', function(e) {
	e.preventDefault();
	modificarApellidos();
});
function modificarApellidos(){
	borrarMensajesDP();
	var apellidos_usuario = $('#apellidos_usuario').val();
	
	if(!apellidos_usuario){
		$('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce tus apellidos</div>');
		$('#mensaje_apellidos').css({display:"block"});
        $('#apellidos_usuario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/usuario/editarDatosUsuario";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'apellidos_usuario',
			contenido: apellidos_usuario
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

$('#btnEditCorreo').live('click', function(e) {
	e.preventDefault();
	modificarCorreo();
});
function modificarCorreo(){
	borrarMensajesDP();
	var correo_usuario = $('#correo_usuario').val();
	
        var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
	if (!re.test(correo_usuario)) {
		$('#mensaje_correo').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato del email incorrecto</div>');
		$('#mensaje_correo').css({display:"block"});
        $('#correo_usuario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/usuario/modificarCorreo";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			correo_usuario: correo_usuario
		},
		beforeSend: function (event) {
			$('#mensaje_correo').css({display:"block"});
			$('#mensaje_correo').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data){
				$('#mensaje_correo').css({display:"block"});
				$('#mensaje_correo').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;'+data+'</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_correo').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar el correo electrónico</div>');
			};
		},
		error: function (event) {
			$('#mensaje_correo').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditPass').live('click', function(e) {
	e.preventDefault();
	modificarPass();
});
function modificarPass(){
	borrarMensajesDP();
	var pass_usuario = $('#pass_usuario').val();
	var repetir_pass = $('#repetir_pass').val();
	
    if (pass_usuario.length < 8) {
		$('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña debe ser de 8 o más caracteres</div>');
		$('#mensaje_pass').css({display:"block"});
        $('#pass_usuario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    if (repetir_pass.length < 8) {
		$('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña repetida debe ser de 8 o más caracteres</div>');
		$('#mensaje_pass').css({display:"block"});
        $('#repetir_pass').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
    if (repetir_pass != pass_usuario) {
		$('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;La contraseña no coincide con la contraseña repetida</div>');
		$('#mensaje_pass').css({display:"block"});
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/usuario/editarDatosUsuario";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'pass_usuario',
			contenido: pass_usuario
		},
		beforeSend: function (event) {
			$('#mensaje_pass').css({display:"block"});
			$('#mensaje_pass').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_pass').css({display:"block"});
				$('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Contraseña modificada correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar la contraseña</div>');
			};
		},
		error: function (event) {
			$('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
};

$('#btnEditLocalidad').live('click', function(e) {
	e.preventDefault();
	modificarLocalidad();
});
function modificarLocalidad(){
	borrarMensajesDP();
	var localidad_usuario = $('#localidad_usuario').val();
	
	if(!localidad_usuario){
		$('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce tu municipio</span>');
		$('#mensaje_localidad').css({display:"block"});
        $('#localidad_usuario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/usuario/editarDatosUsuario";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'localidad_usuario',
			contenido: localidad_usuario
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

$('#btnEditCP').live('click', function(e) {
	e.preventDefault();
	modificarCP();
});
function modificarCP(){
	borrarMensajesDP();
	var cp_usuario = $('#cp_usuario').val();
	
	if(isNaN(cp_usuario)){
		$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Tu código postal debe ser numérico</span>');
		$('#mensaje_cp').css({display:"block"});
        $('#cp_usuario').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	var url = "/usuario/editarDatosUsuario";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			campo: 'cp_usuario',
			contenido: cp_usuario
		},
		beforeSend: function (event) {
			$('#mensaje_cp').css({display:"block"});
			$('#mensaje_cp').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_cp').css({display:"block"});
				$('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Código postal modificado correctamente</div>');
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

/* ----------- CLUB TLM ----------- */

$('#btnEditarDatosTlmUsuario').live('click', function() {
	$('#mensaje_tlm').css({display:"none"});
	
	email_usuario_tlm = $('#email_usuario_tlm').val();
	dia_cumpleanos_usuario = $('#dia_cumpleanos_usuario option:selected').val();
	mes_cumpleanos_usuario = $('#mes_cumpleanos_usuario option:selected').val();
	ano_cumpleanos_usuario = $('#ano_cumpleanos_usuario option:selected').val();
	sexo_usuario_tlm = $('#sexo_usuario_tlm:checked').val();
	var pregunta_tlm_a=0;
	if ($('#pregunta_tlm_a').is(":checked")){
		pregunta_tlm_a=1;
	}
	var pregunta_tlm_b=0;
	if ($('#pregunta_tlm_b').is(":checked")){
		pregunta_tlm_b=1;
	}
	
    var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
	if (!re.test(email_usuario_tlm) & email_usuario_tlm != '') {
		$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato del email incorrecto</div>');
		$('#mensaje_tlm').css({display:"block"});
        $('#email_usuario_tlm').focus();
    	clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	};
	
	if(dia_cumpleanos_usuario == 0){
		$('#mensaje_tlm').css({display:"block"});
		$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, seleccione su día de nacimiento</div>');
		clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	}
	
	if(mes_cumpleanos_usuario == 0){
		$('#mensaje_tlm').css({display:"block"});
		$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, seleccione su mes de nacimiento</div>');
		clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	}
	
	if(ano_cumpleanos_usuario == 0){
		$('#mensaje_tlm').css({display:"block"});
		$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, seleccione su año de nacimiento</div>');
		clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	}
	
	if(!sexo_usuario_tlm){
		$('#mensaje_tlm').css({display:"block"});
		$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, seleccione su sexo</div>');
		clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		return false;
	}
	
	var url = "/usuario/editarDatosTLMUsuario";
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			email_usuario_tlm: email_usuario_tlm,
			dia_cumpleanos_usuario: dia_cumpleanos_usuario,
			mes_cumpleanos_usuario: mes_cumpleanos_usuario,
			ano_cumpleanos_usuario: ano_cumpleanos_usuario,
			sexo_usuario_tlm: sexo_usuario_tlm,
			pregunta_tlm_a: pregunta_tlm_a,
			pregunta_tlm_b: pregunta_tlm_b
		},
		beforeSend: function (event) {
			$('#mensaje_tlm').css({display:"block"});
			$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
		},
		success: function (data) {
			if(data == 1){
				$('#mensaje_tlm').css({display:"block"});
				$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Datos del Club TLM guardados correctamente</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			}else{
				$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;No se pudo modificar los datos</div>');
			};
		},
		error: function (event) {
			$('#mensaje_tlm').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
		}
	});
});

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
	
	var url = "/usuario/mensajeSoporteTecnico";
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


