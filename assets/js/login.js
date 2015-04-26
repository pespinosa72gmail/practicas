$(document).on('ready', function () {
    $('input[name=email_user], input[name=pass_user]').on('keydown', function () {
        $('#mensaje_login').html('');
        clearInterval(parpadeo);
    });
    var parpadeo;
    $('#submit_form_login').on('click', function (event) {

        $('#mensaje_login').html('');
        clearInterval(parpadeo);

        //Validamos el email
        var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
        if (!re.test($('input[name=email_user]').val())) {
            $('#mensaje_login').html('Email incorrecto');
            parpadeo = setInterval(function () {
                $('#mensaje_login').fadeOut("slow");
                $('#mensaje_login').fadeIn("slow");
            }, 1000);
            $('input[name=email_user]').focus();
            return false;
        }

        /*
         * Si el usuario quiere recordar la contraseña, se le manda un mail
         if ($('#recordar-password').is(":checked")) {
         var resultado = true;
         $.ajax({
         type: "POST",
         url: '/recordar-password',
         async: false,
         data: {
         email_user: $('input[name=email_user]').val(),
         },
         success: function (data) {
         if (data == 'OK') {
         $('#mensaje_login').html('Contraseña enviada al email');
         parpadeo = setInterval(function () {
         $('#mensaje_login').fadeOut("slow");
         $('#mensaje_login').fadeIn("slow");
         }, 1000);
         }
         if (data == 'KO') {
         $('#mensaje_login').html('No se ha encontrado el email');
         parpadeo = setInterval(function () {
         $('#mensaje_login').fadeOut("slow");
         $('#mensaje_login').fadeIn("slow");
         }, 1000);
         }
         resultado = false;
         },
         });
         if (!resultado) {
         return false;
         }
         }
         */
        if ($('input[name=pass_user]').val() == '') {
            $('#mensaje_login').html('Introduce tu password');
            parpadeo = setInterval(function () {
                $('#mensaje_login').fadeOut("slow");
                $('#mensaje_login').fadeIn("slow");
            }, 1000);
            $('input[name=pass_user]').focus();
            return false;
        }
        var resultado = true;
        $.ajax({
            type: "POST",
            url: '/login',
            async: false,
            data: {
                email_user: $('input[name=email_user]').val(),
                pass_user: $('input[name=pass_user]').val(),
                remember: $('#recordar-password').is(":checked")
            },
            beforeSend: function () {
            },
            success: function (data) {
                if (data == 'KO') {
                    $('#mensaje_login').html('Email o password no validos');
                    parpadeo = setInterval(function () {
                        $('#mensaje_login').fadeOut("slow");
                        $('#mensaje_login').fadeIn("slow");
                    }, 1000);
                    resultado = false;
                } else {
                    $('#mensaje_login').html('Entrando...');
                    parpadeo = setInterval(function () {
                        $('#mensaje_login').fadeOut("slow");
                        $('#mensaje_login').fadeIn("slow");
                    }, 1000);
                    resultado = data;
                }
            }
        });
        if (!resultado) {
            return false;
        }

        if (resultado == 1) {
            $("#form_login").attr("action", "/panel-usuario");
        }
        if (resultado == 2) {
            $("#form_login").attr("action", "/acceso/restaurador/panel-restaurador");
        }
        if (resultado == 3) {
            $("#form_login").attr("action", "/acceso/franquiciado/panel-franquiciado");
        }
    });

});