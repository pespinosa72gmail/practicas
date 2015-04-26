$(document).on('ready', function () {
    /****************************************************************/
    /*************** Registro de usuario desde la web ***************/

    /* Desplegamos lo del usuario TLM en la vista /registro-usuario */
    $('#tlm_usuario').on('click', function (event) {

        if ($('input[name=tlm_usuario]').is(':checked')) {
            $('#registro_usuario_tlm_oculto').show("slide", {
                direction: "up"
            }, 1500);
        } else {
            $('#registro_usuario_tlm_oculto').hide("slide", {
                direction: "down"
            }, 1500);
        }

    });

    /* Registro del usuario */
    $("#nombre_usuario, #email_usuario, #apellidos_usuario, #password_usuario, #cp_usuario").on('keydown', function () {
        $('#mensaje').html('');
        clearInterval(parpadeo);
    });
    var parpadeo = '';
    var tiempo = 4000;
    $("#form-1").submit(function () {
// $('#registro_usuario').on('click', function (event){

        $('#mensaje').html('');
        clearInterval(parpadeo);
        //Validación del nombre
        var re=/^[\D]+$/;
        if (!re.test($('#nombre_usuario').val())) {
//$('#mensaje').show();
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato de nombre incorrecto</span>');
            parpadeo = setInterval(function () {
                //sleep(1);
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
                //$('#mensaje span').fadeToggle(2000);
            }, tiempo);
            $('#nombre_usuario').focus();
            return false;
        }

//Expresión Regular para la validación del email
        var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/

        if (!re.test($('#email_usuario').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato del email incorrecto</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#email_usuario').focus();
            return false;
        }

//Validación de los apellidos
        if ($('#apellidos_usuario').val() == '') {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce tus apellidos</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#apellidos_usuario').focus();
            return false;
        }
//Validación del password
        var re = /^(\d.{5,7})|(.{1}\d.{4,6})|(.{2}\d.{3,5})|(.{3}\d.{2,4})|(.{4}\d.{1,3})|(.{5}\d.{0,2})|(.{6}\d.{0,1})|(.{7}\d)$/
        if (!re.test($('#password_usuario').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos un número y entre 6 y 8 caracteres.</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#password_usuario').focus();
            return false;
        }
//Validación del password
        var re = /^([a-zA-Z].{5,7})|(.{1}[a-zA-Z].{4,6})|(.{2}[a-zA-Z].{3,5})|(.{3}[a-zA-Z].{2,4})|(.{4}[a-zA-Z].{1,3})|(.{5}[a-zA-Z].{0,2})|(.{6}[a-zA-Z].{0,1})|(.{7}[a-zA-Z])$/
        if (!re.test($('#password_usuario').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra y entre 6 y 8 caracteres.</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#password_usuario').focus();
            return false;
        }
//Validación del password
        var re = /^([A-Z].{5,7})|(.{1}[A-Z].{4,6})|(.{2}[A-Z].{3,5})|(.{3}[A-Z].{2,4})|(.{4}[A-Z].{1,3})|(.{5}[A-Z].{0,2})|(.{6}[A-Z].{0,1})|(.{7}[A-Z])$/
        if (!re.test($('#password_usuario').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra mayúscula y entre 6 y 8 caracteres.</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#password_usuario').focus();
            return false;
        }
//Validación de cp
        if ($('#cp_usuario').val() == '') {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce tu código postal</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#cp_usuario').focus();
            return false;
        }

        //Si el usuario ha seleccionado el check de Club TLM, validamos el resto de campos
        if ($('#tlm_usuario').is(":checked")) {
//Validación del día del nacimiento
            if ($('#dia_usuario_nacimiento').val() == 'Día') {
                $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el día de tu nacimiento</span>');
                parpadeo = setInterval(function () {
                    $('#mensaje span').fadeOut("slow");
                    $('#mensaje span').fadeIn("slow");
                }, tiempo);
                $('#dia_usuario_nacimiento').focus();
                return false;
            }
//Validación del mes del nacimiento
            if ($('#mes_usuario_nacimiento').val() == 'Mes') {
                $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el mes de tu nacimiento</span>');
                parpadeo = setInterval(function () {
                    $('#mensaje span').fadeOut("slow");
                    $('#mensaje span').fadeIn("slow");
                }, tiempo);
                $('#mes_usuario_nacimiento').focus();
                return false;
            }
//Validación del año del nacimiento
            if ($('#ano_usuario_nacimiento').val() == 'Año') {
                $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el año de tu nacimiento</span>');
                parpadeo = setInterval(function () {
                    $('#mensaje span').fadeOut("slow");
                    $('#mensaje span').fadeIn("slow");
                }, tiempo);
                $('#ano_usuario_nacimiento').focus();
                return false;
            }

        }

        var tlm_usuario_form=0;
        if ($('#tlm_usuario').is(":checked")){
            tlm_usuario_form=1;
        }

        var resp_a_form=0;
        if ($('#respuesta_a').is(":checked")){
            resp_a_form=1;
        }

        var resp_b_form=0;
        if ($('#respuesta_b').is(":checked")){
            resp_b_form=1;
        }

        var url = "registrar-usuario";
        var nombre = $('#nombre_usuario').val();
        var apellidos = $('#apellidos_usuario').val();
        var cp = $('#cp_usuario').val();
        var email = $('#email_usuario').val();
        var password = $('#password_usuario').val();
        var tlm_usuario = tlm_usuario_form;
        var email_adicional = $('#email_adicional_usuario').val();
        var dia_nacimiento = $('#dia_usuario_nacimiento').val();
        var mes_nacimiento = $('#mes_usuario_nacimiento').val();
        var ano_nacimiento = $('#ano_usuario_nacimiento').val();
        var sexo = $('input:radio[name=sexo_usuario_tlm]:checked').val();
        var resp_a = resp_a_form;
        var resp_b = resp_b_form;
        $.ajax({
            type: "POST",
            url: url,
            data: {
                nombre_usuario: nombre,
                apellidos_usuario: apellidos,
                cp_usuario: cp,
                email_usuario: email,
                password_usuario: password,
                tlm: tlm_usuario,
                email_adicional_usuario: email_adicional,
                dia_usuario_nacimiento: dia_nacimiento,
                mes_usuario_nacimiento: mes_nacimiento,
                ano_usuario_nacimiento: ano_nacimiento,
                sexo_usuario_tlm: sexo,
                respuesta_a: resp_a,
                respuesta_b: resp_b
            },
            beforeSend: function (event) {
                $('#mensaje').html("<span align='center'><img src='assets/images/loader.gif '/></span>");
            },
            success: function (data) {
                if (data=='Registro realizado correctamente'){
                    data=data+'. Recibirá un email para completar su registro.';
                }
                $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;' + data + '</span>');
                parpadeo = setInterval(function () {
                    $('#mensaje span').fadeOut("slow");
                    $('#mensaje span').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se ha podido enviar el formulario</span>');
                parpadeo = setInterval(function () {
                    $('#mensaje span').fadeOut("slow");
                    $('#mensaje span').fadeIn("slow");
                }, tiempo);
            }
        });
        return false;
    });
});