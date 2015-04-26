/* Código para el calendario */

var opcionesCalendario = {
        dateFormat: 'dd/mm/yy',
        daynames: ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"],
        dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sá"],
        monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        firstDay: 1,
        //defaultDate: new Date(1980, 01, 01)
    }

$(function () {
    $(document).on("focus","input[name='calendario']", function (event){
                $(this).datepicker(opcionesCalendario);
    })
});

/*$(function () {
    $(document).on("focus","input[name='calendario-cupon']", function (event){
                $(this).datepicker(opcionesCalendario);
    })
});*/

$(function () {
    $(document).on("focus","#calendario_menu2", function (event){
                $("#calendario_menu2").datepicker(opcionesCalendario);
    })
});

$(function () {
    $(document).on("focus","#calendario_menu3", function (event){
                $("#calendario_menu3").datepicker(opcionesCalendario);
    })
});


$(function () {
    $("input[name=calendario]").datepicker({
        dateFormat: 'dd/mm/yy'
    });
});
$(function () {
    $("#calendario_2").datepicker({
        dateFormat: 'dd/mm/yy'
    }).val();
});
/* Calendario cupones panel restaurador */

$(function () {
    $(document).on("focus","input[name='select_fecha_inicio_cupon']", function (event){
                $(this).datepicker(opcionesCalendario);
    })
});
/*$(function () {
    $("input[name=select_fecha_inicio_cupon]").datepicker({
        dateFormat: 'dd/mm/yy'
    }).val();
});*/
$(function () {
    $(document).on("focus","input[name='select_fecha_fin_cupon']", function (event){
                $(this).datepicker(opcionesCalendario);
    })
});
/*$(function () {
    $("input[name=select_fecha_fin_cupon]").datepicker({
        dateFormat: 'dd/mm/yy'
    }).val();
});*/
$(function () {
    $("input[name=fecha_inicio_cupon]").datepicker({
        dateFormat: 'dd/mm/yy'
    }).val();
});
$(function () {
    $("input[name=fecha_fin_cupon]").datepicker({
        dateFormat: 'dd/mm/yy'
    }).val();
});
/* Calendario usuario */
$(function () {
    $("input[name=user_calendario]").datepicker({
        dateFormat: 'dd/mm/yy'
    }).val();
});