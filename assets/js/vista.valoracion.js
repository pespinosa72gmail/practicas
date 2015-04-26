$(document).on('ready', function () {
	
    var parpadeo = '';
    var tiempo = 4000;
	
    $('input#btnEnviarValoracion').on('click', function (event) {
        var global = $('input:radio[name=valoracion_global]:checked').val();
        var servicio = $('input:radio[name=valoracion_servicio]:checked').val();
        var comida = $('input:radio[name=valoracion_comida]:checked').val();
        var calidad_precio = $('input:radio[name=valoracion_calidad_precio]:checked').val();
        var id = $('#id_restaurante').val();
        var url = "/valoraciones/valorar";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurante: id,
                valoracion_global: global,
                valoracion_servicio: servicio,
                valoracion_comida: comida,
                valoracion_calidad_precio: calidad_precio,
            },
            beforeSend: function (event) {
                $('#mensaje').html("<span align='center'><img src='/assets/images/loader.gif '/></span>");
                //console.log('Enviando');
            },
            success: function (data) {
                if (data == 1){
					$('#mensaje').html('<span><i class="fa fa-info-circle"></i>&nbsp;Valoraci&oacute;n realizada correctamente</span>');
					parpadeo = setInterval(function () {
						$('#mensaje span').fadeOut("slow");
						$('#mensaje span').fadeIn("slow");
					}, tiempo);
                }
                //console.log('Enviado');
            },
            error: function (event) {
                //console.log('Error');
            },
        });
        return false;
    });

});