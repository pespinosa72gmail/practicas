$(document).on('ready', function () {
    /* Registro del restaurador */
    $("#comprobar_ubicacion").on('click', function () {
        //Validación del nombre
        if ($('#nombre_restaurante_form').val() == '') {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el nombre comercial del restaurante.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación del nombre
        if ($('#calle_restaurante').val() == '') {
            //alert('validacion de la callle');
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca la calle del restaurante.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación del número
        if ($('#numero_restaurante').val() == '') {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el número del restaurante.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        if (isNaN($('#numero_restaurante').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El número no es correcto.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }

        //Validación del codigo postal
        if ($('#cp_restaurante').val() == '') {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el código postal del restaurante.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        var cp = /^\d{5}$/;
        if (!cp.test($('#cp_restaurante').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El formato del código postal es incorrecto.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }

        var geocoder = new google.maps.Geocoder();
        var address = $("#calle_restaurante").val() + ', ' + $("#numero_restaurante").val() + ', ' + $("#cp_restaurante").val();
        //var address = $(".calle_restaurante").val();

        //alert(address);
        //buscamos en la region de españa
        geocoder.geocode({'address': address, 'region': 'es'}, function (results, status) {
            if (status == 'OK') {
                //alert('Dirección reconocida');
                //Calle
                if (results[0].address_components[1]) {
                    //alert(results[0].address_components[1].long_name);
                    $('#calle_restaurante').val(results[0].address_components[1].long_name);
                } else {
                    //alert('Componente1 vacío');
                }
                //Código Postal
                if (results[0].address_components[7]) {
                    //alert(results[0].address_components[7].long_name);
                    $('#cp_restaurante').val(results[0].address_components[7].long_name);
                } else {
                    //alert('Componente7 vacío');
                }
                //Localidad o municipio
                if (results[0].address_components[2]) {
                    //alert(results[0].address_components[2].long_name);
                    $('#municipio_restaurante').val(results[0].address_components[2].long_name);
                } else {
                    //alert('Componente2 vacío');
                }
                //La provincia la sacamos del componente 4
                if (results[0].address_components[4]) {
                    $('#provincia_restaurante').val(results[0].address_components[4].long_name);
                }

                //alert(results[0].geometry.location);
                $('#latlong_restaurante').val(results[0].geometry.location);
                $('#municipio_restaurante').prop('disabled', false);
                $('#provincia_restaurante').prop('disabled', false);
                //alert(results[0].address_components[1]);
                //alert(results[0].address_components[0]);
                //alert(results[0].address_components[2]);
                //alert(results[0].address_components[7]);
                //alert(results[0].address_components[1].long_name + ', ' + results[0].address_components[0].long_name + ', ' + results[0].address_components[2].long_name + ' ' + results[0].address_components[7].long_name + ' (' + $('.provincia_restaurante').val() + ')');
                //var completeAddress = results[0].address_components[1].long_name + ', ' + results[0].address_components[0].long_name + ', ' + results[0].address_components[2].long_name + ' ' + results[0].address_components[7].long_name + ' (' + $('.provincia_restaurante').val() + ')';
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
                completeAddress = completeAddress + ' (' + $('.provincia_restaurante').val() + ')';
                $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;Google ha reconocido la siguiente dirección: ' + completeAddress);
                setInterval(function () {
                    $('.mensajeexito').fadeOut("slow");
                    $('.mensajeexito').fadeIn("slow");
                }, 1000);
                $('.button-3').show();
                //return false;

                //var LatLong = results[0].geometry.location.toString();
                //var TablaLatLong = LatLong.split(',');
                //alert('latitud: "'+LatLong[0]+'"');
                //alert('longitud: "'+LatLong[1]+'"');                
            } else {
                $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;Google no reconoce la dirección. Por favor rectifique la misma.');
                setInterval(function () {
                    $('.mensajeexito').fadeOut("slow");
                    $('.mensajeexito').fadeIn("slow");
                }, 1000);
                //               return false;

            }

            /*
             //Resultado de la consulta OK o ERROR
             alert('status '+status);
             //Latitud y Longitud
             alert('latlong '+results[0].geometry.location);
             //Dirección completa
             alert('direccion completa'+results[0].formatted_address);
             //Numero de calle
             alert('Numero de la calle [0].long_name: ' + results[0].address_components[0].long_name);
             alert('Numero de la calle [0].short_name: ' + results[0].address_components[0].short_name);
             alert('Numero de la calle [0].types: ' + results[0].address_components[0].types[0]);
             //Calle
             alert('Calle [1].long_name: ' + results[0].address_components[1].long_name);
             alert('Calle [1].short_name: ' + results[0].address_components[1].short_name);
             alert('Calle [1].types: ' + results[0].address_components[1].types[0]);
             //Localidad
             alert('Localidad [2].long_name: ' + results[0].address_components[2].long_name);
             alert('Localidad [2].short_name: ' + results[0].address_components[2].short_name);
             alert('Localidad [2].types: ' + results[0].address_components[2].types[0]);
             //Ayuntamiento
             alert('Provincia [3].long_name: ' + results[0].address_components[3].long_name);
             alert('Provincia [3].short_name: ' + results[0].address_components[3].short_name);
             alert('Provincia [3].types: ' + results[0].address_components[3].types[0]);
             //Provincia
             alert('administrativo [4].long_name: ' + results[0].address_components[4].long_name);
             alert('administrativo [4].short_name: ' + results[0].address_components[4].short_name);
             alert('administrativo [4].types: ' + results[0].address_components[4].types[0]);
             //Comunidad Autonoma
             alert('Com. Autónoma [5].long_name: ' + results[0].address_components[5].long_name);
             alert('Com. Autónoma [5].short_name: ' + results[0].address_components[5].short_name);
             alert('Com. Autónoma [5].types: ' + results[0].address_components[5].types[0]);
             //Pais
             alert('País [6].long_name: ' + results[0].address_components[6].long_name);
             alert('País [6].short_name: ' + results[0].address_components[6].short_name);
             alert('País [6].types: ' + results[0].address_components[6].types[0]);
             //Código Postal
             alert('cp [7].long_name: ' + results[0].address_components[7].long_name);
             alert('cp [7].short_name: ' + results[0].address_components[7].short_name);
             alert('cp [7].types: ' + results[0].address_components[7].types[0]);
             */

        });
        return false;
    });
    /*
     $('#paso_siguiente_pag1').on('click', function (event) {
     
     var nombre_restaurante = $('#nombre_restaurante_form').val();
     var calle_restaurante = $('#calle_restaurante').val();
     var numero_restaurante = $('#numero_restaurante').val();
     var cp_restaurante = $('#cp_restaurante').val();
     var municipio_restaurante = $('#municipio_restaurante').val();
     var provincia_restaurante = $('#provincia_restaurante').val();
     var id_plan = $('#id_plan').val();
     var latlong_restaurante = $('#latlong_restaurante').val();
     
     
     var url = "/restaurador/guarda-restaurante";
     $.ajax({
     type: "POST",
     url: url,
     data: {
     nombre_restaurante: nombre_restaurante,
     calle_restaurante: calle_restaurante,
     numero_restaurante: numero_restaurante,
     cp_restaurante: cp_restaurante,
     municipio_restaurante: municipio_restaurante,
     provincia_restaurante: provincia_restaurante,
     id_plan: id_plan,
     latlong_restaurante: latlong_restaurante
     },
     beforeSend: function (event) {
     //alert('enviando...' + url);
     }
     
     }).done(function (ok) {
     alert('ok... ' + ok);
     $('#id_restaurante').val(ok);
     
     $('[name="id_restaurante"]').val(ok);
     alert('id_restaurante... ' + $('#id_restaurante').val());
     alert('id_restaurante... ' + $('[name="id_restaurante"]').val());
     $('#id_restaurante').focus();
     }).fail(function (ko, txt) {
     alert(ko + txt);
     $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;No se ha podido guardar el restaurante. Inténtelo de nuevo.');
     setInterval(function () {
     $('.mensajeexito').fadeOut("slow");
     $('.mensajeexito').fadeIn("slow");
     }, 1000);
     //return false;
     });
     return false;
     });
     */
});