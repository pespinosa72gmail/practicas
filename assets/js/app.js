$(document).on('ready', function () {

    /* Esta redirección se encuentra dentro del menú de los restauradores */
    $('a#altaRestaurante').on('click', function (event) {
        var url = "./alta-restaurante";
        $(location).attr("href", url);
    });

    /* Autocargo las imágenes de los restaurantes -> Cuando subes las imágenes */
    var auto_refresh = setInterval(function () {
        $('#listadoImagen').load('/acceso/restaurador/cargar-imagenes-ajax').fadeIn();
    }, 1000);
    
    
    $("#provincia_2").on('change', function () {
        $("#provincia_2 option:selected").each(function () {
            provincia = $('#provincia_2').val();
            $.post("/home/completaLocalidades", {
                provincia: provincia
            }, function (data) {
                $("#localidad_2").html(data);
            });
        });
    });
    
    /* Autocompletado del formulario */
    $(".autocompletar").keyup(function () {
        var info = $(this).val();
        $.post('/buscador/autocompletarLocalidad', {
            info: info
        }, function (data) {
            if (data != '')
            {
                $(".contenedor").html(data);
                //console.log('Entro'); 
            } else {
                $(".contenedor").html('');
                //console.log('Nada');              
            }
        })
    });
    
    $(".contenedor").find("a").live('click', function (e) {
        e.preventDefault();
        $('.autocompletar').attr("value", $(this).html());
        $('.contenedor p').hide();
    });
    /* Mostramos el select de cada página */
    var cambio = false;
    $('li a').each(function (index) {
        if (this.href.trim() == window.location) {
            $(this).parent().addClass("current_page_item");
            cambio = true;
        } else {
            cambio = false;
        }
    });

    /* Comprobamos los campos vacíos del primer formulario */
    $('#btnSendFormPlato').on('click', function (event) {
        var thisform = $(this);
        $('.required-error', thisform).remove();
        var nombre_plato_1 = $("#nombre_plato_1").val();
        /*
         console.log(nombre_plato_1);
         return false;
         */
        /*
         if (nombre_plato_1 == "") {
         var mensaje = '<span class="form-description required-error">Introduce un plato</span>';
         $("#nombre_plato_1").after(mensaje);
         $("#nombre_plato_1").attr({
         placeholder: ''
         });
         return false;
         } else {
         return true;
         }
         */
    });
    
    /* Comprobamos los campos vacíos del segundo formulario */
    $('#form-home-2').on('submit', function (event) {
        var thisform = $(this);
        $('.required-error', thisform).remove();
        /*
         var codigo_postal = $('#cp_2').val();
         if (codigo_postal == "") {
         var mensaje = '<span class="form-description required-error">Nos dices el cp??</span>';
         $("#cp_2").after(mensaje);
         $("#cp_2").attr({
         placeholder: ''
         });
         return false;
         } else {
         return true;
         }
         */
    });
    /* Comprobamos los campos vacíos del tercer formulario */








    /* Miro si la variable de session del botón de geolocalización esta activada o desactvada */
    /*
     $.post("buscador/geolocalizacionSession", {}, function (data)
     {
     if (data != '')
     {
     //alert(data);
     //console.log('Entro'); 
     if (data == 'on')
     {
     config_geo();
     $("#activar_geo").attr('checked', true);
     } else {
     $('#geo_1').attr({value: null});
     $('#geo_2').attr({value: null});
     $('#geo_3').attr({value: null});
     }
     } else {
     //alert("nada");
     //console.log('Nada');              
     }
     })
     */

    $.ajax({
        type: "POST",
        url: 'buscador/geolocalizacionSession',
        async: false,
        success: function (data) {
            if (data != '')
            {
                //alert(data);
                //console.log('Entro'); 
                if (data == 'on')
                {
                    config_geo();
                    $("#activar_geo").attr('checked', true);
                } else {
                    $('#geo_1').attr({value: null});
                    $('#geo_2').attr({value: null});
                    $('#geo_3').attr({value: null});
                }
            } else {
                //alert("nada");
                //console.log('Nada');              
            }

        },
    });

    $('#activar_geo').on('click', function (event) {
        config_geo();
    })

    /* Comprobamos si está activado o no la geolocalización */
    function config_geo() {

        var geolocalizacion = $('#activar_geo').val();
        //alert('geolocalizacion, activar_geo: ' + geolocalizacion);
        if (geolocalizacion == 0) {

            $.ajax({
                type: "POST",
                url: 'buscador/geolocalizacionSession',
                async: false,
                data: {
                    valor: 'on'
                },
                success: function (data) {
                    if (data != '')
                    {
                        //alert('1: ' + data);
                        //console.log('Entro'); 
                    } else {
                        //alert("nada");
                        //console.log('Nada');              
                    }
                },
            });

            $('#activar_geo').addClass('activado');
            $('#activar_geo').attr({
                value: "1"
            });
            $('#activar_geo').removeClass('desactivado');
            var geolocalizacion = $('#activar_geo').val();
            if (navigator.geolocation)
            {
                //navigator.geolocation.getCurrentPosition(function(objPosition)
                var user_position = navigator.geolocation.watchPosition(function (objPosition)
                {
                    //alert('leo lat y long');
                    var lat = objPosition.coords.latitude;
                    var lon = objPosition.coords.longitude;
                    $('#geo_1').attr({value: lat + ", " + lon});
                    $('#geo_2').attr({value: lat + ", " + lon});
                    $('#geo_3').attr({value: lat + ", " + lon});
                    //alert(lat);
                    //alert(lon);
                    //alert($('#geo').val());
                    act_des_campos_geo(false);
                }, function (objPositionError)
                {
                    switch (objPositionError.code)
                    {
                        case objPositionError.PERMISSION_DENIED:
                            console.log('No se ha permitido el acceso a la posición del usuario.');
                            break;
                        case objPositionError.POSITION_UNAVAILABLE:
                            console.log('No se ha podido acceder a la información de su posición.');
                            break;
                        case objPositionError.TIMEOUT:
                            console.log('El servicio ha tardado demasiado tiempo en responder.');
                            break;
                        default:
                            console.log('Error desconocido.');
                    }
                }, {
                    maximumAge: 75000,
                    timeout: 15000
                });
            }//if (navigator.geolocation)
            else
            {
                console.log("Su navegador no soporta la API de geolocalización.");
            }

            //if (geolocalizacion==0)
            //geolocalizacion = 1 (desactivar)
        } else {

            $.ajax({
                type: "POST",
                url: 'buscador/geolocalizacionSession',
                async: false,
                data: {
                    valor: 'off'
                },
                success: function (data) {
                    if (data != '')
                    {
                        //alert('2: ' + data);
                        //console.log('Entro'); 
                    } else {
                        //alert("nada");
                        //console.log('Nada');              
                    }

                },
            });

            $('#geo_1').attr({value: null});
            $('#geo_2').attr({value: null});
            $('#geo_3').attr({value: null});
            $('#activar_geo').addClass('desactivado');
            $('#activar_geo').attr({
                value: "0"
            });
            $('#activar_geo').removeClass('activado');
            //alert($('#geo').val());
            act_des_campos_geo(true);
            navigator.geolocation.clearWatch(user_position);
        }

    }
    ;
    // Función para activar o desactivar los campos del buscador al activar o desactivar la geolocalización
    function act_des_campos_geo(accion) {
        var texto_campo_desactivado = 'Desactive la geolocalización si desea introducir datos de localización manualmente';
        if (accion) {
            //alert("activar");

            // Formulario 1
            $('#localidad_1').removeAttr("readonly");
            $('#localidad_1').removeAttr("title");
            $("#localidad_1").css({
                background: "#ffffff"
            });
            $('#zona_1').removeAttr("readonly");
            $('#zona_1').removeAttr("title");
            $("#zona_1").css({
                background: "#ffffff"
            });
            // Formulario 2
            $('#provincia_2').removeAttr("disabled");
            $('#provincia_2').removeAttr("title");
            $("#provincia_2").css({
                background: "#ffffff"
            });
            $('#localidad_2').removeAttr("disabled");
            $('#localidad_2').removeAttr("title");
            $("#localidad_2").css({
                background: "#ffffff"
            });
            $('#cp_2').removeAttr("readonly");
            $('#cp_2').removeAttr("title");
            $("#cp_2").css({
                background: "#ffffff"
            });
            $('#direccion_2').removeAttr("readonly");
            $('#direccion_2').removeAttr("title");
            $("#direccion_2").css({
                background: "#ffffff"
            });
            $('#zona_2').removeAttr("readonly");
            $('#zona_2').removeAttr("title");
            $("#zona_2").css({
                background: "#ffffff"
            });
            $('#punto_interes_2').removeAttr("readonly");
            $('#punto_interes_2').removeAttr("title");
            $("#punto_interes_2").css({
                background: "#ffffff"
            });
            $('#metro_2').removeAttr("disabled");
            $('#metro_2').removeAttr("title");
            $("#metro_2").css({
                background: "#ffffff"
            });
            // Formulario 3
            $('#municipio').removeAttr("readonly");
            $('#municipio').removeAttr("title");
            $("#municipio").css({
                background: "#ffffff"
            });
            $('#zona_3').removeAttr("readonly");
            $('#zona_3').removeAttr("title");
            $("#zona_3").css({
                background: "#ffffff"
            });
        }
        ;
        if (!accion) {
            //alert("desactivar");

            // Formulario 1
            $('#localidad_1').attr("readonly", true);
            $('#localidad_1').attr("title", texto_campo_desactivado);
            $("#localidad_1").css({
                background: "#aaffaa"
            });
            $('#zona_1').attr("readonly", true);
            $('#zona_1').attr("title", texto_campo_desactivado);
            $("#zona_1").css({
                background: "#aaffaa"
            });
            // Formulario 2
            $('#provincia_2').attr("disabled", 'disabled');
            $('#provincia_2').attr("title", texto_campo_desactivado);
            $("#provincia_2").css({
                background: "#aaffaa"
            });
            $('#localidad_2').attr("disabled", 'disabled');
            $('#localidad_2').attr("title", texto_campo_desactivado);
            $("#localidad_2").css({
                background: "#aaffaa"
            });
            $('#cp_2').attr("readonly", true);
            $('#cp_2').attr("title", texto_campo_desactivado);
            $("#cp_2").css({
                background: "#aaffaa"
            });
            $('#direccion_2').attr("readonly", true);
            $('#direccion_2').attr("title", texto_campo_desactivado);
            $("#direccion_2").css({
                background: "#aaffaa"
            });
            $('#zona_2').attr("readonly", true);
            $('#zona_2').attr("title", texto_campo_desactivado);
            $("#zona_2").css({
                background: "#aaffaa"
            });
            $('#punto_interes_2').attr("readonly", true);
            $('#punto_interes_2').attr("title", texto_campo_desactivado);
            $("#punto_interes_2").css({
                background: "#aaffaa"
            });
            $('#metro_2').attr("disabled", 'disabled');
            $('#metro_2').attr("title", texto_campo_desactivado);
            $("#metro_2").css({
                background: "#aaffaa"
            });
            // Formulario 3
            $('#municipio').attr("readonly", true);
            $('#municipio').attr("title", texto_campo_desactivado);
            $("#municipio").css({
                background: "#aaffaa"
            });
            $('#zona_3').attr("readonly", true);
            $('#zona_3').attr("title", texto_campo_desactivado);
            $("#zona_3").css({
                background: "#aaffaa"
            });
        }
        ;
    }
    ;
    //Fin geolocalización











    /* Formulario Añadir Plato Favorito */
    $('a#btnAnadirPlatoFavorito').on('click', function (event) {
        //event.preventDefault();
        var url = "/anadir-plato";
        var datas = $('#nombre_plato').val();
        if (datas != "") {

            var datos = $.ajax({
                type: "POST",
                url: url,
                data: $('#nombre_plato').serialize(),
                success: function (data) {
                    location.reload();
                    //$('input#mostrar_plato_favorito').html(data);
                }
            });
            return false;
        } else {
            $('#nombre_plato').attr({
                placeholder: ''
            });
            $('#nombre_plato').after('<span class="form-description required-error">Introduce un nuevo plato</span>');
        }
    });
    /* Formulario para buscar Restaurantes Favoritos */
    $('#btnBuscarRestauranteFavorito').on('click', function (event) {
        //event.preventDefault();
        var url = "/buscar-restaurante-favorito";
        var datas = $('#nombre_restaurante').val();
        var datos = $('#nombre_restaurante').serialize();
        //console.log(datos);

        if (datas != "") {
            $.ajax({
                type: "POST",
                url: url,
                data: datos,
                dataType: 'html',
                beforeSend: function (evento) {
                    $("#resultado").html("<p align='center'><img src='./assets/images/loader.gif' /></p>");
                },
                success: function (data) {
                    $("#resultado").hide();
                    $('div#mostrarDatosRestaurantes').html(data);
                },
                error: function (data) {
                    console.log('Error');
                }
            });
            return false;
        } else {
            $('input#nombre_restaurante').attr({
                placeholder: ''
            });
            $('input#nombre_restaurante').after('<span class="form-description required-error">Pon el nombre de un Restaurante</span>');
            return false;
        }
    });
    /* Formulario Añadir Restaurante Favorito */
    $('a#addRestauranteFavorito').on('click', function (event) {
        var url = "/anadir-restaurante-favorito";
        var id_restaurante = $('#addRestauranteFavorito').serialize();
        $.ajax({
            type: "GET",
            url: url,
            data: {
                id: id_restaurante
            },
            beforeSend: function (evento) {
                $("#cargando").html("<p align='center'><img src='./assets/images/loader.gif' /></p>");
            },
            success: function (data) {
                $("#resultado").html("Restaurante añadido");
                location.reload();
            },
            error: function (data) {
                $("#resultado").html("No se ha añadido el restaurante");
            }
        });
        return false;
    });
    /* Modificación de los datos del usuario */
    $('a#btnEditUserForm').on('click', function (event) {

        var url = "./usuario/editarDatosUsuario";
        var nombre = $('#nombre_usuario').val();
        var apellidos = $('#apellidos_usuario').val();
        var email = $('#email_usuario').val();
        var localidad = $('#localidad_usuario').val();
        var cp = $('#cp_usuario').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                nombre_usuario: nombre,
                apellidos_usuario: apellidos,
                email_usuario: email,
                localidad_usuario: localidad,
                cp_usuario: cp
            },
            beforeSend: function (event) {
                $('.mensajeexito').fadeIn();
                $('.mensajeexito').html("<span align='center'><img src='./assets/images/loader.gif' /></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('.mensajeexito').fadeIn();
                    $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.mensajeexito').fadeIn();
                    $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al actualizar los datos</div><br />');
                }, 3000);
            }
        });
        return false;
    });


    /* Usuario añade CP favoritos */
    $('a#btnAddCPUsuario').on('click', function (event) {

        var url = "/anadir-cp-favorito";
        var nombre_cp = $('#nombre_cp_favorito').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                nombre_cp_favorito: nombre_cp,
            },
            beforeSend: function (event) {
                $('#cp_anadido').show();
                $('#cp_anadido').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('#cp_anadido').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Código Postal añadido correctamente.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('#cp_anadido').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al añadir el Código Postal.<br />').delay(3000).fadeOut();
                }, 3000);
            },
        });
        return false;
    });
    /* Editamos datos TLM del usuario */
    $('input#btnEditarDatosTlmUsuario').on('click', function (event) {

        var url = "/editar-datos-usuario-tlm";
        var email_user_tlm = $('#email_usuario_tlm').val();
        var dia_fecha_user_tlm = $('#dia_cumpleanos_usuario').val();
        var mes_fecha_user_tlm = $('#mes_cumpleanos_usuario').val();
        var ano_fecha_user_tlm = $('#ano_cumpleanos_usuario').val();
        //var sexo_user_tlm = $('#sexo_usuario_tlm').val();         var sexo_user_tlm = $('input:radio[name=sexo_usuario_tlm]:checked').val();
        //var tlm_a = $('#pregunta_tlm_a').val();
        if ($('input[name=pregunta_tlm_a]').is(':checked')) {
            var tlm_a = 1;
        } else {
            var tlm_a = 0;
        }

        //var tlm_b = $('#pregunta_tlm_b').val();
        if ($('input[name=pregunta_tlm_b]').is(':checked')) {
            var tlm_b = 1;
        } else {
            var tlm_b = 0;
        }


        $.ajax({
            type: "POST",
            url: url,
            data: {
                email_usuario_tlm: email_user_tlm,
                dia_cumpleanos_usuario: dia_fecha_user_tlm,
                mes_cumpleanos_usuario: mes_fecha_user_tlm,
                ano_cumpleanos_usuario: ano_fecha_user_tlm,
                sexo_usuario_tlm: sexo_user_tlm,
                pregunta_tlm_a: tlm_a,
                pregunta_tlm_b: tlm_b,
            },
            beforeSend: function (event)
            {
                $('#messageDatosTlm').show();
                $('#messageDatosTlm').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event)
            {
                setInterval(function () {
                    $('#messageDatosTlm').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Datos modificados correctamente.<br />').delay(3000).fadeOut();
                }, 3000);
            },
            error: function (event)
            {
                setInterval(function () {
                    $('#messageDatosTlm').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al editar tus datos del club TLM.<br />').delay(3000).fadeOut();
                }, 3000);
            },
        });
        return false;
    });
    /* Usuario envía correo */     $('input#btnSendEmailSupportUser').on('click', function (event) {

        var url = "/mensaje-usuario-soporte-tecnico";
        var mensaje = $('#message_suppot_user').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                message_suppot_user: mensaje,
            },
            beforeSend: function (event)
            {
                $('#messageUserSupport').show();
                $('#messageUserSupport').html();
            },
            success: function (event)
            {
                $('#messageUserSupport').html().delay(3000).fadeOut();
            },
            error: function (event)
            {
                $('#messageUserSupport').html().delay(3000).fadeOut();
            },
        });
        return false;
    });
    /*****************************************************************************************/
    /*****************************************************************************************/

    /* Envío de reservas */
    $('input#btnSendEmail').on('click', function (event) {

        var nombre = $('#nombre_reserva').val();
        var email = $('#email_reserva').val();
        var telefono = $('#telefono_reserva').val();
        var fecha = $('#fecha_reserva').val();
        var personas = $('#personas_reserva').val();
        var mensaje = $('#mensaje_reserva').val();
        var email_rest = $('#email_restaurante').val();
        var url = "./reservar";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                nombre_reserva: nombre,
                email_reserva: email, telefono_reserva: telefono,
                fecha_reserva: fecha,
                personas_reserva: personas,
                mensaje_reserva: mensaje,
                email_restaurante: email_rest,
            },
            beforeSend: function (event) {
                console.log('Enviando');
            },
            success: function (event) {
                console.log('Enviado');
            },
            error: function (event) {
                console.log('Error');
            },
        });
        return false;
    });
    /* Marcamos un Restaurante como Favorito */
    $('a#btnAddRestFavorito').on('click', function (event) {

        var id = $(this).parent().attr("id");
        var rest = $('input[name=restaurante]').val();
        var url = "/anadir-home-restaurante-favorito";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                restaurante: id,
            },
            beforeSend: function (event) {
                console.log('Enviando datos');
            },
            success: function (event) {
                console.log('Datos enviados correctamente');
                location.reload();
            },
            error: function (event) {
                console.log('Error al enviar los datos');
            },
        });
        return false;
    });
});