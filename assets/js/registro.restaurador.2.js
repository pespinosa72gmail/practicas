$(document).on('ready', function () {
    /* Página 2 */

    $('#paso_anterior_2').on('click', function (event) {
        //alert('paso por el onclick del paso anterior');
        //window.location.href = "/registro-restaurador/plan-premium/pag-1";
        $("#registro_restaurador_form2").attr("action", "/registro-restaurador/plan-premium/pag-1");
        //alert('submiteando el formulario...');
        $("#registro_restaurador_form2").submit();
    });
    $('#paso_siguiente_2').on('click', function (event) {
        //Validación del nombre del gestor
        if ($('.nombre_gestor').val() == '') {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el nombre del gestor.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación de los apellidos del gestor
        if ($('.apellidos_gestor').val() == '') {
            //alert('validacion de la callle');
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca los apellidos del gestor.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación del email del gestor
        //Expresión Regular para la validación del email
        var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
        if (!re.test($('.email_gestor').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El email tiene un formato incorrecto.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }

        var resultado = true;
        $.ajax({
            type: "POST",
            url: '/existe-email',
            async: false,
            data: {
                email: $('.email_gestor').val(),
            },
            success: function (data) {
                if (data == 'si' && $('[name="id_gestor"]').val() == '') {
                    $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Ese email ya está dado de alta.');
                    setInterval(function () {
                        $('.mensajeexito').fadeOut("slow");
                        $('.mensajeexito').fadeIn("slow");
                    }, 1000);
                    resultado = false;
                }
            },
        });

        if (resultado == false) {
            return false;

        }
        //Validación del password del gestor
        var re = /^(\d.{5,7})|(.{1}\d.{4,6})|(.{2}\d.{3,5})|(.{3}\d.{2,4})|(.{4}\d.{1,3})|(.{5}\d.{0,2})|(.{6}\d.{0,1})|(.{7}\d)$/
        if (!re.test($('.password_gestor').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos un número y entre 6 y 8 caracteres.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación del password del gestor
        var re = /^([a-zA-Z].{5,7})|(.{1}[a-zA-Z].{4,6})|(.{2}[a-zA-Z].{3,5})|(.{3}[a-zA-Z].{2,4})|(.{4}[a-zA-Z].{1,3})|(.{5}[a-zA-Z].{0,2})|(.{6}[a-zA-Z].{0,1})|(.{7}[a-zA-Z])$/
        if (!re.test($('.password_gestor').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra y entre 6 y 8 caracteres.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación del password del gestor
        var re = /^([A-Z].{5,7})|(.{1}[A-Z].{4,6})|(.{2}[A-Z].{3,5})|(.{3}[A-Z].{2,4})|(.{4}[A-Z].{1,3})|(.{5}[A-Z].{0,2})|(.{6}[A-Z].{0,1})|(.{7}[A-Z])$/
        if (!re.test($('.password_gestor').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra mayúscula y entre 6 y 8 caracteres.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación del password del gestor
        if ($('.password_gestor').val() != $('.password_gestor2').val()) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Las dos contraseñas no coinciden. Por favor, corrígelo.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
        //Validación del código postal
        var cp = /^\d{5}$/;
        if (!cp.test($('.cp_gestor').val())) {
            $('.mensajeexito').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El formato del código postal es incorrecto.');
            setInterval(function () {
                $('.mensajeexito').fadeOut("slow");
                $('.mensajeexito').fadeIn("slow");
            }, 1000);
            return false;
        }
    });
//Para que se ejecute al cargar la página
    $(".provincia_gestor option:selected").each(function () {
        provincia = $('#id_provincia').val();
        localidad = $('#id_localidad').val();
        if (provincia) {
            $.post("/completa-localidades/", {
                provincia: provincia, localidad: localidad
            }, function (data) {
                $(".municipio_gestor").html(data);
            });
        }
    });
//Para que se ejecute al cambiar la provincia
    $(".provincia_gestor").on('change', function () {
        $(".provincia_gestor option:selected").each(function () {
            provincia = $('.provincia_gestor').val();
            $.post("/completa-localidades/", {
                provincia: provincia
            }, function (data) {
                //alert(data);
                $(".municipio_gestor").html(data);
            });
        });
    });
});