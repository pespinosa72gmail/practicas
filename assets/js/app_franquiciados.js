$(document).on('ready', function (){

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





	/* Cambiamos los datos del Franquiciado */
	$('a#btnEditDataFranquiciado').on('click', function (event){

		var url = "/acceso/franquiciado/editar-datos-franquiciado";

		var nombre = $('#nombre_franquiciado').val();
		var apellidos = $('#apellidos_franquiciado').val();
		var cif = $('#cif_franquiciado').val();
		var email = $('#email_franquiciado').val();
		var telefono = $('#telefono_franquiciado').val();
		var cp = $('#cp_franquiciado').val();


		$.ajax({
			type: "POST",
			url: url,
			data: {
				nombre_franquiciado: nombre,
				apellidos_franquiciado: apellidos,
				cif_franquiciado: cif,
				email_franquiciado: email,
				telefono_franquiciado: telefono,
				cp_franquiciado: cp,
			},
			beforeSend: function (event)
			{
				$('.mensajeexito').show();
				$('.mensajeexito').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
			},
			success: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />').delay(3000).fadeOut();
        }, 3000);
			},
			error: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al modificar tus datos.<br />').delay(3000).fadeOut();
        }, 3000);
			},
		});
		return false; //Para que no recargue la página.
	});


	/* Editamos la clave del Franquiciado */
	$('a#btnEditPasswordFranquiciado').on('click', function (event){

		var url = "/acceso/franquiciado/editar-password-franquiciado";
		var clave = $('#password_franquiciado').val();

		$.ajax({
			type: "POST",
			url: url,
			data: {
				password_franquiciado: clave,
			},
			beforeSend: function (event)
			{
				$('.mensajeexito').show();
				$('.mensajeexito').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
			},
			success: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />').delay(3000).fadeOut();
        }, 3000);
			},
			error: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al modificar tus datos.<br />').delay(3000).fadeOut();
        }, 3000);
			},
		});
		return false;
	});



	/* El franquiciado edita los datos del propietario. */
	$('a#btnEditDataPropieratiosFranquiciado').on('click', function (event){

		var url = "/acceso/franquiciado/editar-datos-propietario-franquiciado";
		var id = $('#id_propietario').val();
		var nombre = $('#nombre_propietario').val();
		var apellidos = $('#apellidos_propietario').val();
		var email = $('#email_propietario').val();
		var telefono = $('#telefono_propietario').val();
		var cp = $('#cp_propietario').val();

		$.ajax({
			type: "POST",
			url: url,
			data: {
				id_propietario: id,
				nombre_propietario: nombre,
				apellidos_propietario: apellidos,
				email_propietario: email,
				telefono_propietario: telefono,
				cp_propietario: cp,
			},
			beforeSend: function (event)
			{
				$('.mensajeexito').show();
				$('.mensajeexito').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
			},
			success: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />').delay(3000).fadeOut();
        }, 3000);
			},
			error: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al modificar tus datos.<br />').delay(3000).fadeOut();
        }, 3000);
			},
		});
		return false;
	});



	/* Editamos la clave del Propietario */
	$('a#btnEditPasswordPropietario').on('click', function (event){

		var url = "/acceso/franquiciado/editar-password-franquiciado-propietario";
		var id = $('#id_propietario').val();
		var clave = $('#password_propietario').val();

		$.ajax({
			type: "POST",
			url: url,
			data: {
				id_propietario: id,
				password_propietario: clave,
			},
			beforeSend: function (event)
			{
				$('.mensajeexito').show();
				$('.mensajeexito').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
			},
			success: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />').delay(3000).fadeOut();
        }, 3000);
			},
			error: function (event)
			{
				setInterval(function(){
          $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al modificar tus datos.<br />').delay(3000).fadeOut();
        }, 3000);
			},
		});
		return false;
	});




	/* Buscamos un propietario */
	$('a#btnSearchUser').on('click', function (event)
	{
		var url = "/acceso/franquiciado/buscar-propietario-franquiciado";
		var nombre = $('#search_nombre_propietario').val();

		$.ajax({
			type: "POST",
			url: url,
			data: {
				search_nombre_propietario: nombre,
			},
			beforeSend: function (event)
			{
				$('.mensajeexito').show();
				$('.mensajeexitoSearch').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
			},
			success: function (event)
			{
				setInterval(function(data){
					$('.mensajeexito').hide();
					$('#listadoPropietarios').hide();
					//$('#listadoBuscadoPropietarios').show();
					$('#listadoBuscadoPropietarios').css({display: "block"});
          $('#listadoBuscadoPropietarios').html(event);
        }, 3000);
			},
			error: function (event)
			{
				setInterval(function(){
          $('.mensajeexitoSearch').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al modificar tus datos.<br />').delay(3000).fadeOut();
        }, 3000);
			},
		});
		return false;
	});








	/* El franquiciado registra un restaurante */
  $('input#btnAltaFranquiciadoRestaurante').on('click', function (event){
    var id = $('#id_propietario').val();

    var nombre_select = $('#nombre_select_restaurante').val(); //Tipo de establecimiento
    var nombre = $('#nombre_restaurante').val();


    var plan = $('#clave_plan').val(); //Clave que hace referencia al Plan que se ha contratado
    var clave_rest = $('#clave_restaurante').val();

    
    var web = $('#web_restaurante').val();
    /*
    if(web == ""){
    	web = "www.nada.com";
    }else{
    	return true;
    }
    */
		

    var email = $('#email_restaurante').val();
    var direccion = $('#direccion_restaurante').val();
    var numero = $('#numero_restaurante').val();
    var cp = $('#cp_restaurante').val();
    var barrio = $('#barrio_restaurante').val();
    var precio_medio = $('#precio_medio_restaurante').val();
    var parking = $('#parking_restaurante').val();
    var tarjetas = $('#tarjetas_restaurante').val();
    var reservas = $('#reservas_restaurante').val();
    var visible = $('#visible_restaurante').val();



    var cadena = web.substring(web.length-7, web.length);
    var web_final = "";

    if(cadena != "http://"){
    	web_final = "http://"+web;
    }else{
    	web_final = web;
    }



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

    var url = "/acceso/franquiciado/registro-propietario-franquiciado-2";

    $.ajax({
      type: "POST",
      url: url,
      data: {
      	id_propietario: id,
      	nombre_select_restaurante: nombre_select,
				nombre_restaurante: nombre,
				web_restaurante: web_final,
				email_restaurante: email,
				direccion_restaurante: direccion,
				numero_restaurante: numero,
				barrio_restaurante: barrio,
				precio_medio_restaurante: precio_medio,
				parking_restaurante: parking,
				tarjetas_restaurante: tarjetas,
				reservas_restaurante: reservas,
				visible_restaurante: visible,
				cp_restaurante: cp,
				clave_plan: plan,
				clave_restaurante: clave_rest,
			},

      beforeSend: function (event){
        $('.mensajeexito').show();
        $('.altaFranquiciadoRestaurante').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
      },

      success: function (event){
        setInterval(function(){
          $('.altaFranquiciadoRestaurante').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Restaurante añadido con éxito.<br />');

          var url = "/acceso/franquiciado/alta-propietario-franquiciado-3?clave_rest="+clave_rest+"&clave_plan="+plan;
        	$(location).attr('href',url);
        }, 3000);
        
      },

      error: function (event){
        setInterval(function(){
          $('.altaFranquiciadoRestaurante').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
        }, 3000);
      },

    });
    return false;
  });




	/* Tercera parte del registro de un Restaurante */

	$('input#btnAddOtrosDatosRestaurante').on('click', function (event){

		/* Recogemos los datos de Facturación */
		var razon_social = $('#razon_social_facturacion').val();
		var cif = $('#cif_facturacion').val();
		var direccion = $('#direccion_facturacion').val();
		var numero = $('#numero_facturacion').val();
		var cp = $('#cp_facturacion').val();
		var email = $('#email_facturacion').val();
		var num_cuenta = $('#cuenta_facturacion').val();

		/* Recogemos los datos de las Categorías */
		var primera_categoria = $('#primera_select_categoria').val();
		var segunda_categoria = $('#segunda_select_categoria').val();
		var tercera_categoria = $('#tercera_select_categoria').val();



		/* Recogemos el listado de Especialidades */
		var especialidades = $('#nombre_especialidad').val();


		/* Recogemos el listado de Puntos de Interés */
		var puntos_interes = $('#puntos_interes').val();


		/* Recogemos el listado de Estaciones de Metro */
		var estaciones = $('#nombre_estacion').val();


		var clave_rest = $('#clave_restaurante').val();
		var url = "/acceso/franquiciado/registro-propietario-franquiciado-3";




/*

		$.ajax({
			type: "POST",
			url: url,
			dataType: "json",
			data: {
				clave_restaurante: clave_rest,
				razon_social_facturacion: razon_social,
				cif_facturacion: cif,
				direccion_facturacion: direccion,
				numero_facturacion: numero,
				cp_facturacion: cp,
				email_facturacion: email,
				cuenta_facturacion: num_cuenta,
				primera_select_categoria: primera_categoria,
				segunda_select_categoria: segunda_categoria,
				tercera_select_categoria: tercera_categoria,
				nombre_especialidad: especialidades,
				puntos_interes: puntos_interes,
				nombre_estacion: estaciones,
			},

			beforeSend: function (event){
        $('.mensajeexito').show();
        $('#mensaje').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
      },

      success: function (event){
        setInterval(function(){
          $('#mensaje').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Datos guardados correctamente.');

          //var url = "/acceso/franquiciado/alta-propietario-franquiciado-3?clave_rest="+clave_rest+"  ";
        	//$(location).attr('href',url);
        }, 3000);
      },

      error: function (event){
        setInterval(function(){
          $('#mensaje').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.');
        }, 3000);
      },

		});
		return false;
		*/



	});















	/* Añadimos input Especialidades */
	$('a#btnAddEspecialidad').on('click', function (event){
		$('#especialidades').append('<div class="form-input"><i class="fa fa-map-marker"></i><input name="nombre_especialidad[]" id="nombre_especialidad" type="text" placeholder="Introduce una especialidad, Ej. Carne a la brasa"></div>');
		return false;
	});


	$('a#btnAddPuntoInteresA').on('click', function (event){
		$('#puntosInteres').append('<div class="form-input"><i class="fa fa-map-marker"></i><input name="puntos_interes[]" id="puntos_interes" type="text" placeholder="Introduce un punto de interés, Ej. Puerta de Alcalá"></div>');
		return false;
	});

	$('a#btnAddEstaciones').on('click', function (event){

			var listadoEstacion = '<div class="col-md-12 nodosfilas"><div class="form-input"><i class="fa fa-map-marker"></i><select name="nombre_estacion[]" id="nombre_estacion" class="listadoEstaciones"><option selecteSeleccionar</option><option value="Pinar de Chamartín">Pinar de Chamartín</option><option value="Bambú">Bambú</option><option value="Chamartín">Chamartín</option><option value="Plaza de Castilla">Plaza de Castilla</option><option value="Valdeacederas">Valdeacederas</option><option value="Tetuán">Tetuán</option><option value="Estrecho">Estrecho</option><option value="Alvarado">Alvarado</option><option value="Cuatro Caminos">Cuatro Caminos</option><option value="Ríos Rosas">Ríos Rosas</option><option value="Iglesia">Iglesia</option><option value="Bilbao">Bilbao</option><option value="Tribunal">Tribunal</option><option value="Gran Vía">Gran Vía</option><option value="Vodafone Sol">Vodafone Sol</option><option value="Tirso de Molina">Tirso de Molina</option><option value="Antón Martín">Antón Martín</option><option value="Atocha">Atocha</option><option value="Atocha Renfe">Atocha Renfe</option><option value="Menéndez Pelayo">Menéndez Pelayo</option><option value="Pacífico">Pacífico</option><option value="Puente de Vallecas">Puente de Vallecas</option><option value="Nueva Numancia">Nueva Numancia</option><option value="Portazgo">Portazgo</option><option value="Buenos Aires">Buenos Aires</option><option value="Alto del Arenal">Alto del Arenal</option><option value="Miguel Hernández">Miguel Hernández</option><option value="Sierra de Guadalupe">Sierra de Guadalupe</option><option value="Villa de Vallecas">Villa de Vallecas</option><option value="Congosto">Congosto</option><option value="La Gavia">La Gavia</option><option value="Las Suertes">Las Suertes</option><option value="Valdecarros">Valdecarros</option><option value="Las Rosas">Las Rosas</option><option value="Avenida de Guadalajara">Avenida de Guadalajara</option><option value="Alsacia">Alsacia</option><option value="La Almudena">La Almudena</option><option value="La Elipa">La Elipa</option><option value="Ventas">Ventas</option><option value="Manuel Becerra">Manuel Becerra</option><option value="Goya">Goya</option><option value="Príncipe de Vergara">Príncipe de Vergara</option><option value="Retiro">Retiro</option><option value="Banco de España">Banco de España</option><option value="Sevilla">Sevilla</option><option value="Ópera">Ópera</option><option value="Santo Domingo">Santo Domingo</option><option value="Noviciado">Noviciado</option><option value="San Bernardo">San Bernardo</option><option value="Quevedo">Quevedo</option><option value="Canal">Canal</option><option value="Villaverde Alto">Villaverde Alto</option><option value="San Cristobal">San Cristobal</option><option value="Villaverde Bajo Cruce">Villaverde Bajo Cruce</option><option value="Ciudad de los Ángeles">Ciudad de los Ángeles</option><option value="San Fermín-Orcasur">San Fermín-Orcasur</option><option value="Hospital 12 de Octubre">Hospital 12 de Octubre</option><option value="Almendrales">Almendrales</option><option value="Legazpi">Legazpi</option><option value="Palos de la Frontera">Palos de la Frontera</option><option value="Embajadores">Embajadores</option><option value="Lavapiés">Lavapiés</option><option value="Callao">Callao</option><option value="Plaza de España">Plaza de España</option><option value="Ventura Rodríguez">Ventura Rodríguez</option><option value="Argüelles">Argüelles</option><option value="Moncloa">Moncloa</option><option value="Alonso Martínez">Alonso Martínez</option><option value="Colón">Colón</option><option value="Serrano">Serrano</option><option value="Velázquez">Velázquez</option><option value="Lista">Lista</option><option value="Diego de León">Diego de León</option><option value="Avenida de América">Avenida de América</option><option value="Prosperidad">Prosperidad</option><option value="Alfonso XIII">Alfonso XIII</option><option value="Avenida de la Paz">Avenida de la Paz</option><option value="Arturo Soria">Arturo Soria</option><option value="Esperanza">Esperanza</option><option value="Canillas">Canillas</option><option value="Mar de Cristal">Mar de Cristal</option><option value="San Lorenzo">San Lorenzo</option><option value="Parque de Santa María">Parque de Santa María</option><option value="Hortaleza">Hortaleza</option><option value="Manoteras">Manoteras</option><option value="Alameda de Osuna">Alameda de Osuna</option><option value="El Capricho">El Capricho</option><option value="Canillejas">Canillejas</option><option value="Torres Arias">Torres Arias</option><option value="Suanzes">Suanzes</option><option value="Ciudad Lineal">Ciudad Lineal</option><option value="Pueblo Nuevo">Pueblo Nuevo</option><option value="Quintana">Quintana</option><option value="El Carmen">El Carmen</option><option value="Núñez de Balboa">Núñez de Balboa</option><option value="Rubén Darío">Rubén Darío</option><option value="Chueca">Chueca</option><option value="Callao">Callao</option><option value="La Latina">La Latina</option><option value="Puerta de Toledo">Puerta de Toledo</option><option value="Acacias">Acacias</option><option value="Pirámides">Pirámides</option><option value="Marqués de Vadillo">Marqués de Vadillo</option><option value="Urgel">Urgel</option><option value="Oporto">Oporto</option><option value="Vista Alegre">Vista Alegre</option><option value="Carabanchel">Carabanchel</option><option value="Eugenia de Montijo">Eugenia de Montijo</option><option value="Aluche">Aluche</option><option value="Empalme">Empalme</option><option value="Campamento">Campamento</option><option value="Casa de Campo">Casa de Campo</option><option value="Laguna">Laguna</option><option value="Carpetana">Carpetana</option><option value="Opañel">Opañel</option><option value="Plaza Elíptica">Plaza Elíptica</option><option value="Usera">Usera</option><option value="Arganzuela-Planetario">Arganzuela-Planetario</option><option value="Méndez Álvaro">Méndez Álvaro</option><option value="Conde de Casal">Conde de Casal</option><option value="Sainz de Baranda">Sainz de Baranda</option><option value="O Donnell">O Donnell</option><option value="República Argentina">República Argentina</option><option value="Nuevos Ministerios">Nuevos Ministerios</option><option value="Guzmán el Bueno">Guzmán el Bueno</option><option value="Metropolitano">Metropolitano</option><option value="Ciudad Universitaria">Ciudad Universitaria</option><option value="Argüelles">Argüelles</option><option value="Príncipe Pío">Príncipe Pío</option><option value="Puerta del Ángel">Puerta del Ángel</option><option value="Alto de Extremadura">Alto de Extremadura</option><option value="Lucero">Lucero</option><option value="Hospital del Henares">Hospital del Henares</option><option value="Henares">Henares</option><option value="Jarama">Jarama</option><option value="San Fernando">San Fernando</option><option value="La Rambla">La Rambla</option><option value="Coslada Central">Coslada Central</option><option value="Barrio del Puerto">Barrio del Puerto</option><option value="Estadio Olímpico">Estadio Olímpico</option><option value="Las Musas">Las Musas</option><option value="San Blas">San Blas</option><option value="Simancas">Simancas</option><option value="García Noblejas">García Noblejas</option><option value="Ascao">Ascao</option><option value="Barrio de la Concepción">Barrio de la Concepción</option><option value="Parque de las Avenidas">Parque de las Avenidas</option><option value="Cartagena">Cartagena</option><option value="Gregorio Marañón">Gregorio Marañón</option><option value="Alonso Cano">Alonso Cano</option><option value="Islas Filipinas">Islas Filipinas</option><option value="Francos Rodríguez">Francos Rodríguez</option><option value="Valdezarza">Valdezarza</option><option value="Antonio Machado">Antonio Machado</option><option value="Peñagrande">Peñagrande</option><option value="Avenida de la Ilustración">Avenida de la Ilustración</option><option value="Lacoma">Lacoma</option><option value="Pitis">Pitis</option><option value="Colombia">Colombia</option><option value="Pinar del Rey">Pinar del Rey</option><option value="Campo de las Naciones">Campo de las Naciones</option><option value="Aeropuerto T1-T2-T3">Aeropuerto T1-T2-T3</option><option value="Barajas">Barajas</option><option value="Aeropuerto T4">Aeropuerto T4</option><option value="Mirasierra">Mirasierra</option><option value="Herrera Oria">Herrera Oria</option><option value="Barrio del Pilar">Barrio del Pilar</option><option value="Ventilla">Ventilla</option><option value="Duque de Pastrana">Duque de Pastrana</option><option value="Pío XII">Pío XII</option><option value="Concha Espina">Concha Espina</option><option value="Cruz del Rayo">Cruz del Rayo</option><option value="Ibiza">Ibiza</option><option value="Estrella">Estrella</option><option value="Vinateros">Vinateros</option><option value="Artilleros">Artilleros</option><option value="Pavones">Pavones</option><option value="Valdebernardo">Valdebernardo</option><option value="Vicálvaro">Vicálvaro</option><option value="San Cipriano">San Cipriano</option><option value="Puerta de Arganda">Puerta de Arganda</option><option value="Rivas Urbanizaciones">Rivas Urbanizaciones</option><option value="Rivas Futura">Rivas Futura</option><option value="Rivas Vaciamadrid">Rivas Vaciamadrid</option><option value="La Poveda">La Poveda</option><option value="Arganda del Rey">Arganda del Rey</option><option value="Hospital Infanta Sofía">Hospital Infanta Sofía</option><option value="Reyes Católicos">Reyes Católicos</option><option value="Baunatal">Baunatal</option><option value="Manuel de Falla">Manuel de Falla</option><option value="Marqués de la Valdavia">Marqués de la Valdavia</option><option value="La Moraleja">La Moraleja</option><option value="La Granja">La Granja</option><option value="Ronda de la Comunicación">Ronda de la Comunicación</option><option value="Las Tablas">Las Tablas</option><option value="Montecarmelo">Montecarmelo</option><option value="Tres Olivos">Tres Olivos</option><option value="Fuencarral">Fuencarral</option><option value="Begoña">Begoña</option><option value="Cuzco">Cuzco</option><option value="Santiago Bernabéu">Santiago Bernabéu</option><option value="Lago">Lago</option><option value="Batán">Batán</option><option value="Colonia Jardín">Colonia Jardín</option><option value="Aviación Española">Aviación Española</option><option value="Cuatro Vientos">Cuatro Vientos</option><option value="Joaquín Vilumbrales">Joaquín Vilumbrales</option><option value="Puerta del Sur">Puerta del Sur</option><option value="Abrantes">Abrantes</option><option value="Pan Bendito">Pan Bendito</option><option value="San Francisco">San Francisco</option><option value="Carabanchel Alto">Carabanchel Alto</option><option value="La Peseta">La Peseta</option><option value="La Fortuna">La Fortuna</option><option value="Parque Lisboa">Parque Lisboa</option><option value="Alcorcón Central">Alcorcón Central</option><option value="Parque Oeste">Parque Oeste</option><option value="Universidad Rey Juan Carlos">Universidad Rey Juan Carlos</option><option value="Móstoles Central">Móstoles Central</option><option value="Pradillo">Pradillo</option><option value="Hospital de Móstoles">Hospital de Móstoles</option><option value="Manuela Malasaña">Manuela Malasaña</option><option value="Loranca">Loranca</option><option value="Hospital de Fuenlabrada">Hospital de Fuenlabrada</option><option value="Parque Europa">Parque Europa</option><option value="Fuenlabrada Central">Fuenlabrada Central</option><option value="Parque de los Estados">Parque de los Estados</option><option value="Arroyo Culebro">Arroyo Culebro</option><option value="Conservatorio">Conservatorio</option><option value="Alonso de Mendoza">Alonso de Mendoza</option><option value="Getafe Central">Getafe Central</option><option value="Juan de la Cierva">Juan de la Cierva</option><option value="El Casar">El Casar</option><option value="Los Espartales">Los Espartales</option><option value="El Bercial">El Bercial</option><option value="El Carrascal">El Carrascal</option><option value="Julián Besteiro">Julián Besteiro</option><option value="Casa del Reloj">Casa del Reloj</option><option value="Hospital Severo Ochoa">Hospital Severo Ochoa</option><option value="Leganés Central">Leganés Central</option><option value="San Nicasio">San Nicasio</option><option value="Fuente de la Mora">Fuente de la Mora</option><option value="Virgen del Cortijo">Virgen del Cortijo</option><option value="Antonio Saura">Antonio Saura</option><option value="Álvarez de Villamil">Álvarez de Villamil</option><option value="Blasco Ibáñez">Blasco Ibáñez</option><option value="María Tudor">María Tudor</option><option value="Palas de Rey">Palas de Rey</option><option value="Prado de la Vega">Prado de la Vega</option><option value="Colonia de los Ángeles">Colonia de los Ángeles</option><option value="Prado del Rey">Prado del Rey</option><option value="Somosaguas Sur">Somosaguas Sur</option><option value="Somosaguas Centro">Somosaguas Centro</option><option value="Pozuelo Oeste">Pozuelo Oeste</option><option value="Bélgica">Bélgica</option><option value="Dos Castillas">Dos Castillas</option><option value="Campus de Somosaguas">Campus de Somosaguas</option><option value="Avenida de Europa">Avenida de Europa</option><option value="Berna">Berna</option><option value="Estación de Aravaca">Estación de Aravaca</option><option value="Ciudad de la Imagen">Ciudad de la Imagen</option><option value="José Isbert">José Isbert</option><option value="Ciudad del Cine">Ciudad del Cine</option><option value="Cocheras">Cocheras</option><option value="Retamares">Retamares</option><option value="Montepríncipe">Montepríncipe</option><option value="Ventorro del Cano">Ventorro del Cano</option><option value="Prado del Espino">Prado del Espino</option><option value="Cantabria">Cantabria</option><option value="Ferial de Boadilla">Ferial de Boadilla</option><option value="Boadilla Centro">Boadilla Centro</option><option value="Nuevo Mundo">Nuevo Mundo</option><option value="Siglo XXI">Siglo XXI</option><option value="Infante Don Luís">Infante Don Luís</option><option value="Puerta de Boadilla">Puerta de Boadilla</option></select></div><div id="estaciones"></div></div>';

		//$('#estaciones').clone().appendTo(listadoEstacion);
		$('#estaciones').append(listadoEstacion);
		return false;
	});


});