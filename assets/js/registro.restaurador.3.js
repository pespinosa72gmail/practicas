$(document).on('ready', function () {

    function validaCuenta(ccc) {
        if (ccc.length !== 20) {
            return false;
        }
//	 Formato deseado de los parámetros:
//	 - entidad (4)
//	 - oficina (4)
//	 - digito (2)
//	 - cuenta (10)

        var entidad = ccc.substr(0, 4);
        var oficina = ccc.substr(4, 4);
        var digito = ccc.substr(8, 2);
        var cuenta = ccc.substr(10, 10);
        var total, cociente, resto;
        if (entidad.length != 4 || oficina.length != 4 || digito.length != 2 || cuenta.length != 10)
            return false;
        total = (entidad.charAt(0) * 4) + (entidad.charAt(1) * 8) + (entidad.charAt(2) * 5) + (entidad.charAt(3) * 10) + (oficina.charAt(0) * 9) + (oficina.charAt(1) * 7) + (oficina.charAt(2) * 3) + (oficina.charAt(3) * 6);
        // busco el resto de dividir total entre 11
        cociente = Math.floor(total / 11);
        resto = total - (cociente * 11);
        total = 11 - resto;
        if (total == 11)
            total = 0;
        if (total == 10)
            total = 1;
        if (total != digito.charAt(0))
            return false;
        //hemos validado la entidad y oficina
        total = (cuenta.charAt(0) * 1) + (cuenta.charAt(1) * 2) + (cuenta.charAt(2) * 4) + (cuenta.charAt(3) * 8) + (cuenta.charAt(4) * 5) + (cuenta.charAt(5) * 10) + (cuenta.charAt(6) * 9) + (cuenta.charAt(7) * 7) + (cuenta.charAt(8) * 3) + (cuenta.charAt(9) * 6);
        // busco el resto de dividir total entre 11
        cociente = Math.floor(total / 11);
        resto = total - (cociente * 11);
        total = 11 - resto;
        if (total == 11) {
            total = 0;
        }
        if (total == 10) {
            total = 1;
        }

        if (total != digito.charAt(1))
            return false;
        return true;
    }

    $('#paso_anterior_3').on('click', function (event) {
        $("#registro_restaurador_form3").attr("action", "/registro-restaurador/plan-premium/pag-2");
        $("#registro_restaurador_form3").submit();
    });
    $('#finalizar_3').on('click', function (event) {
//Validación del nombre del gestor
        if ($('#razon_social_facturacion').val() == '') {
            $('#mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca la razón social.');
            setInterval(function () {
                $('#mensajeexito').fadeOut("slow");
                $('#mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
//Validación de los apellidos del gestor
        if ($('#direccion_facturacion').val() == '') {
//alert('validacion de la callle');
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca la dirección de facturación.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
//Validación de los apellidos del gestor
        if ($('#numero_facturacion').val() == '') {
//alert('validacion de la callle');
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el número de la dirección de facturación.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
//Validación del código postal
        var cp = /^\d{5}$/;
        if (!cp.test($('#cp_facturacion').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El formato del código postal es incorrecto.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
//Validación de la provincia
        if ($('#provincia_facturacion').val() == 'Provincia') {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, selecciona una provincia.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
//Validación del municipio del gestor
        if ($('#municipio_facturacion').val() == 'Municipio') {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, selecciona tu municipio.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
//Validación del email de facturación. Es un campo opcional. Sólo se valida si el usuario introduce algo
//Expresión Regular para la validación del email
        var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
        if ($('#email_facturacion').val() != '') {
            if (!re.test($('#email_facturacion').val())) {
                $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El email tiene un formato incorrecto. Es un campo opcional.');
                setInterval(function () {
                    $('.mensajeexito').fadeOut("slow");
                    $('.mensajeexito').fadeIn("slow");
                }, 1000);
                return false;
            }
        }
//Validación del municipio del gestor: la validamos sólo si el plan no es el gratuito
        if ($("#plan_restaurante option:selected").val() == 2 || $("#plan_restaurante option:selected").val() == 3) {
            if (!validaCuenta($('#cuenta_facturacion').val())) {
                $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El formato de la cuenta no es correcto.');
                setInterval(function () {
                    $('.mensajeexito').fadeOut("slow");
                    $('.mensajeexito').fadeIn("slow");
                }, 1000);
                return false;
            }
        }

    });
//Para que se ejecute al cambiar la provincia
    $("#provincia_facturacion").on('change', function () {
//alert('cambiando...');
        $("#provincia_facturacion option:selected").each(function () {
            provincia = $('#provincia_facturacion').val();
            //alert('each provincia '+provincia);
            $.post("/completa-localidades/", {
                provincia: provincia
            }, function (data) {
                //alert(data);
                $("#municipio_facturacion").html(data);
            });
        });
    });
//Para que se ejecute al cargar la página
    $("#provincia_facturacion option:selected").each(function () {
        var provincia = $(this).val();
        var localidad = $('#id_localidad').val();
        //alert(provincia);alert(localidad);
        if (provincia) {
            $.post("/completa-localidades/", {
                provincia: provincia, localidad: localidad
            }, function (data) {
//alert(data);
                $("#municipio_facturacion").html(data);
            });
        }
    });
    $('#cuenta_facturacion').prop('disabled', true);
//Para que se ejecute al cambiar el plan
    $("#plan_restaurante").on('change', function () {
        $("#plan_restaurante option:selected").each(function () {
            switch ($(this).val()) {
                case '1':
                    $('#cuenta_facturacion').prop('disabled', true);
                    break;
                case '2':
                case '3':
                    $('#cuenta_facturacion').prop('disabled', false);
            }
        });
    });
//Para que se ejecute al cargar la página
    $("#plan_restaurante option:selected").each(function () {
        switch ($(this).val()) {
            case '1':
                $('#cuenta_facturacion').prop('disabled', true);
                break;
            case '2':
            case '3':
                $('#cuenta_facturacion').prop('disabled', false);
        }
    });

});
