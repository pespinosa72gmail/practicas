function validatedate(inputText)
{
    var dateformat = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
    // Match the date format through regular expression  
    if (dateformat.test(inputText))
    {
        //document.form1.text1.focus();
        //Test which seperator is used '/' or '-'  
        var opera1 = inputText.split('/');
        var opera2 = inputText.split('-');
        lopera1 = opera1.length;
        lopera2 = opera2.length;
        // Extract the string into month, date and year  
        if (lopera1 > 1)
        {
            var pdate = inputText.split('/');
        }
        else if (lopera2 > 1)
        {
            var pdate = inputText.split('-');
        }
        var dd = parseInt(pdate[0]);
        var mm = parseInt(pdate[1]);
        var yy = parseInt(pdate[2]);
        // Create list of days of a month [assume there is no leap year by default]  
        var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (mm == 1 || mm > 2)
        {
            if (dd > ListofDays[mm - 1])
            {
                //alert('Invalid date format!');
                return false;
            }
        }
        if (mm == 2)
        {
            var lyear = false;
            if ((!(yy % 4) && yy % 100) || !(yy % 400))
            {
                lyear = true;
            }
            if ((lyear == false) && (dd >= 29))
            {
                //alert('Invalid date format!');
                return false;
            }
            if ((lyear == true) && (dd > 29))
            {
                //alert('Invalid date format!');
                return false;
            }
        }
    }
    else
    {
        //alert("Invalid date format!");
        //document.form1.text1.focus();
        return false;
    }

    return true;
}

$(document).on('ready', function () {

    /* Registro del usuario */
    $("#nombre_tlm, #email_tlm, #apellidos_tlm, #password_tlm, #cp_tlm").on('keydown', function () {
        $('#mensaje').html('');
        clearInterval(parpadeo);
    });
    var parpadeo = '';
    var tiempo = 4000;
    $("#form-1").submit(function () {

        $('#mensaje').html('');
        clearInterval(parpadeo);

        //Validación del nombre
        var re = /^[\D]+$/;
        if (!re.test($('#nombre_tlm').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato de nombre incorrecto</span>');
            parpadeo = setInterval(function () {
                //sleep(1);
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
                //$('#mensaje span').fadeToggle(2000);
            }, tiempo);
            $('#nombre_tlm').focus();
            return false;
        }

//Expresión Regular para la validación del email
        var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/

        if (!re.test($('#email_tlm').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato del email incorrecto</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#email_tlm').focus();
            return false;
        }

//Validación de los apellidos
        if ($('#apellidos_tlm').val() == '') {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce tus apellidos</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#apellidos_tlm').focus();
            return false;
        }


//Validación del password
        var re = /^(\d.{5,7})|(.{1}\d.{4,6})|(.{2}\d.{3,5})|(.{3}\d.{2,4})|(.{4}\d.{1,3})|(.{5}\d.{0,2})|(.{6}\d.{0,1})|(.{7}\d)$/
        if (!re.test($('#password_tlm').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos un número y entre 6 y 8 caracteres.</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#password_tlm').focus();
            return false;
        }
//Validación del password
        var re = /^([a-zA-Z].{5,7})|(.{1}[a-zA-Z].{4,6})|(.{2}[a-zA-Z].{3,5})|(.{3}[a-zA-Z].{2,4})|(.{4}[a-zA-Z].{1,3})|(.{5}[a-zA-Z].{0,2})|(.{6}[a-zA-Z].{0,1})|(.{7}[a-zA-Z])$/
        if (!re.test($('#password_tlm').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra y entre 6 y 8 caracteres.</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#password_tlm').focus();
            return false;
        }
//Validación del password
        var re = /^([A-Z].{5,7})|(.{1}[A-Z].{4,6})|(.{2}[A-Z].{3,5})|(.{3}[A-Z].{2,4})|(.{4}[A-Z].{1,3})|(.{5}[A-Z].{0,2})|(.{6}[A-Z].{0,1})|(.{7}[A-Z])$/
        if (!re.test($('#password_tlm').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra mayúscula y entre 6 y 8 caracteres.</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#password_tlm').focus();
            return false;
        }
//Validación de cp
        if ($('#cp_tlm').val() == '') {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce tu código postal</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#cp_tlm').focus();
            return false;
        }
        if (!validatedate($('#fecha_nacimiento_tlm').val())) {
            $('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Fecha Incorrecta</span>');
            parpadeo = setInterval(function () {
                $('#mensaje span').fadeOut("slow");
                $('#mensaje span').fadeIn("slow");
            }, tiempo);
            $('#fecha_nacimiento_tlm').focus();
            return false;
        }

        var resp_a_form = 0;
        if ($('#para_que_ocio_tlm').is(":checked")) {
            resp_a_form = 1;
        }

        var resp_b_form = 0;
        if ($('#para_que_trabajo_tlm').is(":checked")) {
            resp_b_form = 1;
        }

        var url = "registrar-usuario";
        var nombre = $('#nombre_tlm').val();
        var apellidos = $('#apellidos_tlm').val();
        var cp = $('#cp_tlm').val();
        var email = $('#email_tlm').val();
        var password = $('#password_tlm').val();
        var tlm = 1;
        var email_adicional = $('#email_adicional_tlm').val();
        var fecha_nacimiento = $('#fecha_nacimiento_tlm').val();
        var sexo = $('input:radio[name=sexo_tlm]:checked').val();
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
                tlm: tlm,
                email_adicional_usuario: email_adicional,
                fecha_nacimiento: fecha_nacimiento,
                sexo_usuario_tlm: sexo,
                respuesta_a: resp_a,
                respuesta_b: resp_b
            },
            beforeSend: function (event) {
                $('#mensaje').html("<span align='center'><img src='assets/images/loader.gif '/></span>");
            },
            success: function (data) {
                if (data == 'Registro realizado correctamente') {
                    data = data + '. Recibirá un email para completar su registro.';
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