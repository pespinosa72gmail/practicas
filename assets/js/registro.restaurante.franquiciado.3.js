$(document).on('ready', function () {
						
	$("#nueva_especialidad").on('keydown', function () {
		$('#mensaje_especialidades').css({display:"none"});
		if(event.keyCode == 13){
			addEspecialidad();
		};
	});
	$('a#btnAddEspecialidad').on('click', function (e){
		e.preventDefault();
		addEspecialidad();
	});
	var numEspe = 0;
	function addEspecialidad(){
		if(!$('#nueva_especialidad').val()){
			$('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una nueva especialidad</div>');
			$('#mensaje_especialidades').css({display:"block"});
			$('#nueva_especialidad').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		numEspe = numEspe + 1;
		comillaSimple = "'especialidad" + numEspe + "'";
		
		var pinta = '';
		pinta = pinta + '<div id="especialidad' + numEspe + '">';
		pinta = pinta + '	<div class="form-input" style="float: left; margin-right: 10px; width: 700px;">';
		pinta = pinta + '		<i class="fa fa-cutlery"></i>';
		pinta = pinta + '		<input type="text" value="' + $('#nueva_especialidad').val() + '" disabled>';
		pinta = pinta + '		<input name="nombre_especialidad[]" type="hidden" value="' + $('#nueva_especialidad').val() + '">';
		pinta = pinta + '	</div>';
		pinta = pinta + '	<div class="form-input" style="float: left;>';
		pinta = pinta + '		<div class="callout-a"><a href="javascript:eliminarEspecialidad(' + comillaSimple + ');" class="button-3" style=" width: 93px; text-align: center;">Eliminar</a></div>';
		pinta = pinta + '	</div>';
		pinta = pinta + '</div>';
		$('#especialidades').append(pinta);
		
		$('#nueva_especialidad').val('');
	};
					
					
	$("#nuevo_interes").on('keydown', function () {
		$('#mensaje_interes').css({display:"none"});
		if(event.keyCode == 13){
			addInteres();
		};
	});
	$('a#btnAddPuntoInteres').on('click', function (e){
		e.preventDefault();
		addInteres();
	});
	var numInteres = 0;
	function addInteres(){
		if(!$('#nuevo_interes').val()){
			$('#mensaje_interes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un nuevo punto de interés</div>');
			$('#mensaje_interes').css({display:"block"});
			$('#nuevo_interes').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		numInteres = numInteres + 1;
		comillaSimple = "'interes" + numInteres + "'";
		
		var pinta = '';
		pinta = pinta + '<div id="interes' + numInteres + '">';
		pinta = pinta + '	<div class="form-input" style="float: left; margin-right: 10px; width: 700px;">';
		pinta = pinta + '		<i class="fa fa-map-marker"></i>';
		pinta = pinta + '		<input type="text" value="' + $('#nuevo_interes').val() + '" disabled>';
		pinta = pinta + '		<input name="puntos_interes[]" type="hidden" value="' + $('#nuevo_interes').val() + '">';
		pinta = pinta + '	</div>';
		pinta = pinta + '	<div class="form-input" style="float: left;>';
		pinta = pinta + '		<div class="callout-a"><a href="javascript:eliminarInteres(' + comillaSimple + ');" class="button-3" style=" width: 93px; text-align: center;">Eliminar</a></div>';
		pinta = pinta + '	</div>';
		pinta = pinta + '</div>';
		$('#puntosInteres').append(pinta);
		
		$('#nuevo_interes').val('');
	};
					
					
	$("#nueva_estacion").on('change', function () {
		$('#mensaje_metro').css({display:"none"});
	});
	$('a#btnAddEstaciones').on('click', function (e){
		e.preventDefault();
		addMetro();
	});
	var numEstacion = 0;
	function addMetro(){
		if($('#nueva_estacion').val() == -1){
			$('#mensaje_metro').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una estación de metro</div>');
			$('#mensaje_metro').css({display:"block"});
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		numEstacion = numEstacion + 1;
		comillaSimple = "'estacion" + numEstacion + "'";
		
		var pinta = '';
		pinta = pinta + '<div id="estacion' + numEstacion + '">';
		pinta = pinta + '	<div class="form-input" style="float: left; margin-right: 10px; width: 700px;">';
		pinta = pinta + '		<i class="fa fa-map-marker"></i>';
		pinta = pinta + '		<input type="text" value="' + $('#nueva_estacion option:selected').html() + '" disabled>';
		pinta = pinta + '		<input name="nombre_estacion[]" type="hidden" value="' + $('#nueva_estacion option:selected').html() + '">';
		pinta = pinta + '		<input name="id_estacion[]" type="hidden" value="' + $('#nueva_estacion option:selected').val() + '">';
		pinta = pinta + '	</div>';
		pinta = pinta + '	<div class="form-input" style="float: left;>';
		pinta = pinta + '		<div class="callout-a"><a href="javascript:eliminarEstacion(' + comillaSimple + ');" class="button-3" style=" width: 93px; text-align: center;">Eliminar</a></div>';
		pinta = pinta + '	</div>';
		pinta = pinta + '</div>';
		$('#estacionesMetro').append(pinta);
		
		$("#nueva_estacion option[value=-1]").attr("selected",true);
	};
	
	
	//Para que se ejecute al volver a la página
	$("#provincia_facturacion option:selected").each(function () {
		provincia = $('#provincia_facturacion').val();
		$.post("/completa-localidades/", {
			provincia: provincia
			}, function (data) {
				$("#municipio_facturacion").html(data);
			});
	});
	//Para que se ejecute al cambiar la provincia
    $("#provincia_facturacion").on('change', function () {
        $("#provincia_facturacion option:selected").each(function () {
            provincia = $('#provincia_facturacion').val();
            $.post("/completa-localidades/", {
                provincia: provincia
				}, function (data) {
					$("#municipio_facturacion").html(data);
				});
        });
    });
	
					
	$("#razon_social_facturacion, #cif_facturacion, #direccion_facturacion, #email_facturacion, #cuenta_facturacion").on('keydown', function () {
		borrarMensajes();
		if(event.keyCode == 13){
			validarDatos();
		};
	});
	
	$("#numero_facturacion, #cp_facturacion").on('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8) && !(event.keyCode == 9)) return false;
		if(event.keyCode == 13){
			validarDatos();
		};
	});
	
	$("#provincia_facturacion, #municipio_facturacion").on('change', function () {
		borrarMensajes();
	});
	
	$('input#btnAddOtrosDatosRestaurante').on('click', function (e){
		e.preventDefault();
		validarDatos();
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


var comillaSimple = '';
	
function eliminarEspecialidad(borrarEspe){
	$('#'+borrarEspe).remove();
};

function eliminarInteres(borrarInteres){
	$('#'+borrarInteres).remove();
};

function eliminarEstacion(borrarEstacion){
	$('#'+borrarEstacion).remove();
};


var parpadeo = '';
var tiempo = 4000;	


function borrarMensajes(){		 
	$('#mensaje_facturacion').css({display:"none"});		 
	$('#mensaje_resultado').css({display:"none"});
};

function scrollMensaje(){
    $('html, body').animate({
        scrollTop: 250
    }, 2000);			 
	
	$('#mensaje_facturacion').css({display:"block"});		 
	$('#mensaje_resultado').css({display:"block"});
};

function validarDatos(){
	
	function parpadeoOn(){
		clearInterval(parpadeo);
		parpadeo = setInterval(function () {
			$('.efecto-fade').fadeOut("slow");
			$('.efecto-fade').fadeIn("slow");
		}, tiempo);
		scrollMensaje();
	};
	
	if(!$('#razon_social_facturacion').val()){
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una razón social</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una razón social</div>');
		$('#razon_social_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if(!$('#cif_facturacion').val()){
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un cif/nif</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un cif/nif</div>');
		$('#cif_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if(!$('#direccion_facturacion').val()){
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una calle</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una calle</div>');
		$('#direccion_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if (!$('#numero_facturacion').val()) {
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un número</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un número</div>');
        $('#numero_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if(isNaN($('#numero_facturacion').val())){
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un número</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un número</div>');
        $('#numero_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if (!$('#cp_facturacion').val()) {
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
        $('#cp_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if(isNaN($('#cp_facturacion').val())){
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
        $('#cp_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if ($('#provincia_facturacion').val() == -1) {
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una provincia</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una provincia</div>');
		parpadeoOn();
		return false;
	};
	
	if ($('#municipio_facturacion').val() == 'Municipio') {
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un municipio</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un municipio</div>');
		parpadeoOn();
		return false;
	};
	
	if (!$('#email_facturacion').val()) {
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un correo electrónico</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un correo electrónico</div>');
        $('#email_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
    var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
	if (!re.test($('#email_facturacion').val())) {
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un correo electrónico</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un correo electrónico</div>');
        $('#email_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	if (!$('#cuenta_facturacion').val()) {
		$('#mensaje_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una cuenta bancaria</div>');
		$('#mensaje_resultado').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una cuenta bancaria</div>');
        $('#cuenta_facturacion').focus();
		parpadeoOn();
		return false;
	};
	
	alta_restaurante_franquiciado_3.submit();
	
};


