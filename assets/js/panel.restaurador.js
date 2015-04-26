var parpadeo;
function seleccionaRestaurante(id_restaurante) {
    alert(id_restaurante);
    $('#id_restaurante').val(id_restaurante);
    $("#buscador-restaurante-form").attr("action", "/acceso/restaurador/panel-restaurador");
    $("#buscador-restaurante-form").submit();
}

function obtenerTiposMenus() {
    var id = $('#id_restaurantes').val();
    var url = "/restaurador/obtenerTipoMenusJSON";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_restaurante: id,
        },
        beforeSend: function (event) {
            //$('.addFormTipoMenu').show();
            //$('.addFormTipoMenu').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
        },
        success: function (data) {
            var data = JSON.parse(data);
            var out = '';
            if (data.length) {
                for (var i in data) {

                    out = out + '<div class="col-md-9 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<i class="fa fa-pencil"></i>';
                    out = out + '<input name="name" id="name" type="text" value="' + data[i].nombre_menu + '" disabled>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '<div class="col-md-3 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<div class="callout-a ">';
                    out = out + '<a id="eliminar-tipo-menu-' + data[i].id_menu + '" href="#" class="button-3">Eliminar</a>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                }
            } else {
                out = out + '<div class="col-md-12 nodosfilas">';
                out = out + '<div class="form-input">';
                out = out + '<p style="text-align: center;">Actualmente no tienes ningÃºn menÃº aÃ±adido.</p>';
                out = out + '</div>';
                out = out + '</div>';
            }
            $('#listado-tipos-menu').html(out);
        },
        error: function (event) {
            setInterval(function () {
                $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al cargar los menÃºs.<br />');
            }, 3000);
        },
    });
}

function obtenerMenusCompletos() {
    var id = $('#id_restaurantes').val();
    var url = "/restaurador/obtenerMenusCompletosJSON";
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        data: {
            id_restaurante: id,
        },
        beforeSend: function (event) {
            //$('.addFormTipoMenu').show();
            //$('.addFormTipoMenu').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
        },
        success: function (data) {
            var data = JSON.parse(data);
            var out = '';
            if (data.length) {
                for (var i in data) {
                    switch (data[i].tipo_menu_id_tipo_menu) {
                        case '1':
                            out = out + '<div class="section-content">';
                            out = out + '<h4 class="accordion-title">';
                            out = out + '<a href="#">' + data[i].nombre_menu + '<i class="fa fa-plus"></i></a>';
                            out = out + '</h4>';
                            out = out + '<div class="accordion-inner">';
                            out = out + '<div class="form-generico">';
                            out = out + '<form method="post" name="platos-menus-form-' + data[i].id_menu + '" id="platos-menus-form-' + data[i].id_menu + '">';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-6 nodosfilas">';
                            out = out + '<div class="col-md-4">';
                            out = out + '<label>Fecha</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-8 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-calendar"></i>';
                            out = out + '<input name="calendario" id="calendario-menu-' + data[i].id_menu + '" type="text" value="';
                            if (data[i].fecha_dia_menu) {
                                out = out + data[i].fecha_dia_menu
                            }
                            out = out + '" placeholder="dd/mm/aaaa">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-6 nodosfilas">';
                            out = out + '<div class="col-md-4">';
                            out = out + '<label>Precio</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-8 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-eur"></i>';
                            out = out + '<input name="precio_menu" id="precio-menu-' + data[i].id_menu + '" type="text" value="';
                            if (data[i].precio_menu) {
                                out = out + data[i].precio_menu
                            }
                            out = out + '" placeholder="">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<hr class="bordepunteadogris">';
                            out = out + '<div class="alerts">';
                            out = out + '<i class="fa fa-star"></i>';
                            out = out + '<div>';
                            out = out + '<h3>SelecciÃ³n de menÃºs habituales</h3>';
                            out = out + '<p>Si lo prefieres, puedes seleccionar uno de tus menÃºs guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>';
                            out = out + '<div id="listado-menu-habituales-' + data[i].id_menu + '" class="row">';
                            if (data[i].menus_habituales.length) {
                                for (var j in data[i].menus_habituales) {
                                    out = out + '<div class="col-md-6">';
                                    out = out + '<label>';
                                    out = out + '<a href="" id="btnSelectMenuHabitual-' + data[i].menus_habituales[j].id_menu_habitual + '-' + data[i].id_menu + '">';
                                    out = out + data[i].menus_habituales[j].nombre_menu_habitual + '&nbsp;';
                                    out = out + '<i class="fa fa-check-circle"></i>';
                                    out = out + '</a>&nbsp;';
                                    out = out + '<a href="#" id="btnDeleteMenuHabitual-' + data[i].menus_habituales[j].id_menu_habitual + '-' + data[i].id_menu + '">';
                                    out = out + '<i class="fa fa-times-circle"></i>';
                                    out = out + '</a>';
                                    //out = out + '<input type="hidden" name="id_menu_habitual" id="id_menu_habitual" class="id_menu_habitual" value="' + data[i].menus_habituales[j].id_menu_habitual + '" />';
                                    out = out + '</label>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="col-md-6">';
                                out = out + '<p>Actualmente no tienes ningÃºn menÃº dado de alta.</p>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="row derecha">';
                            out = out + '<input name="borrar-cajas-' + data[i].id_menu + '" id="borrar-cajas-' + data[i].id_menu + '" class="button-3 botonpeq" type="button" value="Borrar cajas y escribir de nuevo">';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-6 dosfilas">';
                            out = out + '<h5>PRIMEROS</h5>';
                            out = out + '<div id="contenedorPlatos-' + data[i].id_menu + '" class="contenedorPlatos">';
                            if (data[i].primeros.length) {
                                for (var k in data[i].primeros) {
                                    out = out + '<div class="row contenedor" id="1">';
                                    out = out + '<div class="col-md-10 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<i class="fa fa-cutlery"></i>';
                                    out = out + '<input value="' + data[i].primeros[k].nombre_primeros_menu + '" name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '<div class="col-md-2 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="callout-a">';
                                    out = out + '<a id="primero-' + data[i].id_menu + '" href="#" class="button-3 eliminar">X</a>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="row contenedor" id="1">';
                                out = out + '<div class="col-md-10 nodosfilas">';
                                //out = out + '<div class="row contenedor" id="1">';
                                out = out + '<div class="form-input">';
                                out = out + '<i class="fa fa-cutlery"></i>';
                                out = out + '<input name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '<div class="col-md-2 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="callout-a">';
                                out = out + '<a id="primeros-' + data[i].id_menu + '" href="#" class="button-3 eliminar">X</a>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '<div class="clear"></div>';
                            out = out + '<div class="enlacesencillo">';
                            out = out + '<a href="#" name="addInputPrimeros-' + data[i].id_menu + '" id="addInputPrimeros-' + data[i].id_menu + '">AÃ±adir mÃ¡s primeros<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                            out = out + '</div>';
                            out = out + '<input type="hidden" name="primeros_platos_menu" id="primeros_platos_menu">';
                            out = out + '</div>';
                            out = out + '<div class="col-md-6 dosfilas">';
                            out = out + '<h5>SEGUNDOS</h5>';
                            out = out + '<div id="contenedorPlatos2-' + data[i].id_menu + '">';
                            if (data[i].segundos.length) {
                                for (var l in data[i].segundos) {
                                    out = out + '<div class="row">';
                                    out = out + '<div class="col-md-10 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<i class="fa fa-cutlery"></i>';
                                    out = out + '<input value="' + data[i].segundos[l].nombre_segundo_menu + '" name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '<div class="col-md-2 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="callout-a ">';
                                    out = out + '<a id="segundo-' + data[i].id_menu + '" href="#" class="button-3 eliminar">X</a>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="row">';
                                out = out + '<div class="col-md-10 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<i class="fa fa-cutlery"></i>';
                                out = out + '<input name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '<div class="col-md-2 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="callout-a ">';
                                out = out + '<a id="segundo-' + data[i].id_menu + '" href="#" class="button-3 eliminar">X</a>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '<div class="clear"></div>';
                            out = out + '<div class="enlacesencillo">';
                            out = out + '<a href="#" name="addInputSegundos-' + data[i].id_menu + '" id="addInputSegundos-' + data[i].id_menu + '">AÃ±adir mÃ¡s segundos<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<hr class="bordepunteadogris">';
                            out = out + '<div class="separadorgrande"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].postre_menu == 1) {
                                out = out + '<input type="checkbox" name="postre_menu_' + data[i].id_menu + '" id="postre_menu_' + data[i].id_menu + '" checked><label>Con postre</label>';
                            } else {
                                out = out + '<input type="checkbox" name="postre_menu_' + data[i].id_menu + '" id="postre_menu_' + data[i].id_menu + '"><label>Con postre</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].cafe_menu == 1) {
                                out = out + '<input type="checkbox" name="cafe_menu_' + data[i].id_menu + '" id="cafe_menu_' + data[i].id_menu + '"checked><label>Con cafÃ©</label>';
                            } else {
                                out = out + '<input type="checkbox" name="cafe_menu_' + data[i].id_menu + '" id="cafe_menu_' + data[i].id_menu + '"><label>Con cafÃ©</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].pan_menu == 1) {
                                out = out + '<input type="checkbox" name="pan_menu_' + data[i].id_menu + '" id="pan_menu_' + data[i].id_menu + '" checked><label>Con pan</label>';
                            } else {
                                out = out + '<input type="checkbox" name="pan_menu_' + data[i].id_menu + '" id="pan_menu_' + data[i].id_menu + '"><label>Con pan</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].bebida_menu == 1) {
                                out = out + '<input type="checkbox" name="bebida_menu_' + data[i].id_menu + '" id="bebida_menu_' + data[i].id_menu + '" checked><label>Con bebida</label>';
                            } else {
                                out = out + '<input type="checkbox" name="bebida_menu_' + data[i].id_menu + '" id="bebida_menu_' + data[i].id_menu + '"><label>Con bebida</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-3">';
                            out = out + '<label>Observaciones</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-9 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-pencil"></i>';
                            out = out + '<textarea maxlength="255" name="observaciones_menu_' + data[i].id_menu + '" id="observaciones_menu_' + data[i].id_menu + '" type="text">';
                            if (data[i].observaciones_menu) {
                                out = out + data[i].observaciones_menu;
                            }
                            out = out + '</textarea>';
                            out = out + '<strong><div id="contador"></div></strong>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<br />';
                            out = out + '<div class="row">';
                            out = out + '<p class="reducirfila">Â¿Este menÃº lo vas a reutilizar a menudo? Ponle un nombre y dale a "Guardar como menÃº habitual"</p>';
                            out = out + '<div class="col-md-8 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-cutlery"></i>';
                            out = out + '<input name="nombre_menu_habitual" id="nombre_menu_habitual_' + data[i].id_menu + '" type="text" placeholder="Ej. MenÃº de los lunes, MenÃº arroces, etc...">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-4 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<div class="callout-a ">';
                            out = out + '<a href="#" id="btnAddMenuHabitual-' + data[i].id_menu + '" class="button-3">Guardar como menÃº habitual</a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row centrar reducirfila">';
                            out = out + '<input class="button-3 botonpeq" name="btnAddPlateMenu2-' + data[i].id_menu + '" id="btnAddPlateMenu2-' + data[i].id_menu + '" type="button" value="Actualizar menÃº">';
                            out = out + '</div>';
                            out = out + '</br>';
                            out = out + '<div id="mensajeMenu-' + data[i].id_menu + '"></div>';
                            out = out + '<input type="hidden" name="id_menu_' + data[i].id_menu + '" id="id_menu" value="' + data[i].id_menu + '" />';
                            out = out + '</form>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            break;
                        case '2':

                            out = out + '<div class="section-content">';
                            out = out + '<h4 class="accordion-title">';
                            out = out + '<a href="#">' + data[i].nombre_menu + '<i class="fa fa-plus"></i></a>';
                            out = out + '</h4>';
                            out = out + '<div class="accordion-inner">';
                            out = out + '<div class="form-generico">';
                            out = out + '<form method="post" name="platos-menus-form-' + data[i].id_menu + '" id="platos-menus-form-' + data[i].id_menu + '">';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-6 nodosfilas">';
                            out = out + '<div class="col-md-4">';
                            out = out + '<label>Fecha</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-8 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-calendar"></i>';
                            out = out + '<input name="calendario" id="calendario-menu-' + data[i].id_menu + '" type="text" value="';
                            if (data[i].fecha_dia_menu) {
                                out = out + data[i].fecha_dia_menu;
                            }
                            out = out + '" placeholder="dd/mm/aaaa">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-6 nodosfilas">';
                            out = out + '<div class="col-md-4">';
                            out = out + '<label>Precio</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-8 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-eur"></i>';
                            out = out + '<input name="precio_menu" id="precio-menu-' + data[i].id_menu + '" type="text" value="';
                            if (data[i].precio_menu) {
                                out = out + data[i].precio_menu;
                            }
                            out = out + '" placeholder="">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<hr class="bordepunteadogris">';
                            out = out + '<div class="alerts">';
                            out = out + '<i class="fa fa-star"></i>';
                            out = out + '<div>';
                            out = out + '<h3>SelecciÃ³n de menÃºs habituales</h3>';
                            out = out + '<p>Si lo prefieres, puedes seleccionar uno de tus menÃºs guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>';
                            out = out + '<div id="listado-menu-habituales-' + data[i].id_menu + '" class="row">';
                            if (data[i].menus_habituales.length) {
                                for (var j in data[i].menus_habituales) {
                                    out = out + '<div class="col-md-6">';
                                    out = out + '<label>';
                                    out = out + '<a href="" id="btnSelectMenuHabitual-' + data[i].menus_habituales[j].id_menu_habitual + '-' + data[i].id_menu + '">';
                                    out = out + data[i].menus_habituales[j].nombre_menu_habitual + '&nbsp;';
                                    out = out + '<i class="fa fa-check-circle"></i>';
                                    out = out + '</a>&nbsp;';
                                    out = out + '<a href="" id="btnDeleteMenuHabitual' + data[i].menus_habituales[j].id_menu_habitual + '-' + data[i].id_menu + '">';
                                    out = out + '<i class="fa fa-times-circle"></i>';
                                    out = out + '</a>';
                                    alert(data[i].menus_habituales[j].id_menu_habitual);
                                    //out = out + '<input type="hidden" name="id_menu_habitual" id="id_menu_habitual" class="id_menu_habitual" value="' + data[i].menus_habituales[j].id_menu_habitual + '" />';
                                    out = out + '</label>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="col-md-6">';
                                out = out + '<p>Actualmente no tienes ningÃºn menÃº dado de alta.</p>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="row derecha">';
                            out = out + '<input name="borrar-cajas-' + data[i].id_menu + '" id="borrar-cajas-' + data[i].id_menu + '" class="button-3 botonpeq" type="button" value="Borrar cajas y escribir de nuevo">';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-6 dosfilas">';
                            out = out + '<h5>ENTRANTES</h5>';
                            out = out + '<div id="contenedorPlatosEntrantes-' + data[i].id_menu + '" class="contenedorPlatos">';
                            if (data[i].entrantes.length) {
                                for (var k in data[i].entrantes) {
                                    out = out + '<div class="row">';
                                    out = out + '<div class="col-md-10 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<i class="fa fa-cutlery"></i>';
                                    out = out + '<input value="' + data[i].entrantes[k].nombre_entrante_menu + '" name="entrantes_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '<div class="col-md-2 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="callout-a">';
                                    out = out + '<a id="entrante-' + data[i].id_menu + '" href="#" class="button-3 eliminar">X</a>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="row contenedor" id="1">';
                                out = out + '<div class="col-md-10 nodosfilas">';
                                //out = out + '<div class="row contenedor" id="1">';
                                out = out + '<div class="form-input">';
                                out = out + '<i class="fa fa-cutlery"></i>';
                                out = out + '<input name="entrantes_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '<div class="col-md-2 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="callout-a">';
                                out = out + '<a id="entrante-' + data[i].id_menu + '" href="#" class="button-3 eliminar">X</a>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '<div class="clear"></div>';
                            out = out + '<div class="enlacesencillo">';
                            out = out + '<a href="#" name="addInputEntrantes-' + data[i].id_menu + '" id="addInputEntrantes-' + data[i].id_menu + '">AÃ±adir mÃ¡s entrantes<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                            //out = out + '<input type="hidden" name="primeros_platos_menu" id="primeros_platos_menu">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-6 dosfilas">';
                            out = out + '<h5>PRIMEROS</h5>';
                            out = out + '<div id="contenedorPlatos-' + data[i].id_menu + '">';
                            if (data[i].primeros.length) {
                                for (var l in data[i].primeros) {
                                    out = out + '<div class="row">';
                                    out = out + '<div class="col-md-10 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<i class="fa fa-cutlery"></i>';
                                    out = out + '<input value="' + data[i].primeros[l].nombre_primeros_menu + '" name="primeros_menu_estructura_' + data[i].id_menu + '[]" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '<div class="col-md-2 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="callout-a ">';
                                    out = out + '<a id="primero" href="#" class="button-3">X</a>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="row">';
                                out = out + '<div class="col-md-10 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<i class="fa fa-cutlery"></i>';
                                out = out + '<input name="primeros_menu_estructura_' + data[i].id_menu + '[]" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '<div class="col-md-2 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="callout-a ">';
                                out = out + '<a href="#" class="button-3">X</a>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '<div class="clear"></div>';
                            out = out + '<div class="enlacesencillo">';
                            out = out + '<a href="#" name="addInputPrimeros-' + data[i].id_menu + '" id="addInputPrimeros-' + data[i].id_menu + '">Añadir más primeros<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-6 dosfilas">';
                            out = out + '<h5>SEGUNDOS</h5>';
                            out = out + '<div id="contenedorPlatos2-' + data[i].id_menu + '">';
                            if (data[i].segundos.length) {
                                for (var l in data[i].segundos) {
                                    out = out + '<div class="row">';
                                    out = out + '<div class="col-md-10 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<i class="fa fa-cutlery"></i>';
                                    out = out + '<input value="' + data[i].segundos[l].nombre_segundo_menu + '" name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '<div class="col-md-2 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="callout-a ">';
                                    out = out + '<a href="#" class="button-3">X</a>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';

                                }
                            } else {
                                out = out + '<div class="row">';
                                out = out + '<div class="col-md-10 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<i class="fa fa-cutlery"></i>';
                                out = out + '<input name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '<div class="col-md-2 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="callout-a ">';
                                out = out + '<a href="#" class="button-3">X</a>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '<div class="clear"></div>';
                            out = out + '<div class="enlacesencillo">';
                            out = out + '<a href="#" name="addInputSegundos-' + data[i].id_menu + '" id="addInputSegundos-' + data[i].id_menu + '">Añadir más segundos<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<hr class="bordepunteadogris">';
                            out = out + '<div class="separadorgrande"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].postre_menu == 1) {
                                out = out + '<input type="checkbox" name="postre_menu_' + data[i].id_menu + '" id="postre_menu_' + data[i].id_menu + '" checked><label>Con postre</label>';
                            } else {
                                out = out + '<input type="checkbox" name="postre_menu_' + data[i].id_menu + '" id="postre_menu_' + data[i].id_menu + '"><label>Con postre</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].cafe_menu == 1) {
                                out = out + '<input type="checkbox" name="cafe_menu_' + data[i].id_menu + '" id="cafe_menu_' + data[i].id_menu + '"checked><label>Con café</label>';
                            } else {
                                out = out + '<input type="checkbox" name="cafe_menu_' + data[i].id_menu + '" id="cafe_menu_' + data[i].id_menu + '"><label>Con café</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].pan_menu == 1) {
                                out = out + '<input type="checkbox" name="pan_menu_' + data[i].id_menu + '" id="pan_menu_' + data[i].id_menu + '" checked><label>Con pan</label>';
                            } else {
                                out = out + '<input type="checkbox" name="pan_menu_' + data[i].id_menu + '" id="pan_menu_' + data[i].id_menu + '"><label>Con pan</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].bebida_menu == 1) {
                                out = out + '<input type="checkbox" name="bebida_menu_' + data[i].id_menu + '" id="bebida_menu_' + data[i].id_menu + '" checked><label>Con bebida</label>';
                            } else {
                                out = out + '<input type="checkbox" name="bebida_menu_' + data[i].id_menu + '" id="bebida_menu_' + data[i].id_menu + '"><label>Con bebida</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-3">';
                            out = out + '<label>Observaciones</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-9 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-pencil"></i>';
                            out = out + '<textarea maxlength="255" name="observaciones_menu_' + data[i].id_menu + '" id="observaciones_menu_' + data[i].id_menu + '" type="text">';
                            if (data[i].observaciones_menu) {
                                out = out + data[i].observaciones_menu;
                            }
                            out = out + '</textarea>';
                            out = out + '<strong><div id="contador"></div></strong>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            //out = out + '<br />';
                            out = out + '<div class="row">';
                            out = out + '<p class="reducirfila">Â¿Este menÃº lo vas a reutilizar a menudo? Ponle un nombre y dale a "Guardar como menÃº habitual"</p>';
                            out = out + '<div class="col-md-8 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-cutlery"></i>';
                            out = out + '<input name="nombre_menu_habitual" id="nombre_menu_habitual_' + data[i].id_menu + '" type="text" placeholder="Ej. MenÃº de los lunes, MenÃº arroces, etc...">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-4 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<div class="callout-a ">';
                            out = out + '<a href="#" id="btnAddMenuHabitual-' + data[i].id_menu + '" class="button-3">Guardar como menÃº habitual</a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row centrar reducirfila">';
                            out = out + '<input class="button-3 botonpeq" name="btnAddPlateMenu2-' + data[i].id_menu + '" id="btnAddPlateMenu2-' + data[i].id_menu + '" type="button" value="Actualizar menÃº">';
                            out = out + '</div>';
                            out = out + '</br>';
                            out = out + '<div id="mensajeMenu-' + data[i].id_menu + '"></div>';
                            out = out + '<input type="hidden" name="id_menu_' + data[i].id_menu + '" id="id_menu" value="' + data[i].id_menu + '" />';
                            out = out + '</form>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            break;
                        case '3':
                            out = out + '<div class="section-content">';
                            out = out + '<h4 class="accordion-title">';
                            out = out + '<a href="#">' + data[i].nombre_menu + '<i class="fa fa-plus"></i></a>';
                            out = out + '</h4>';
                            out = out + '<div class="accordion-inner">';
                            out = out + '<div class="form-generico">';
                            out = out + '<form method="post" name="platos-menus-form-' + data[i].id_menu + '" id="platos-menus-form-' + data[i].id_menu + '">';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-6 nodosfilas">';
                            out = out + '<div class="col-md-4">';
                            out = out + '<label>Fecha</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-8 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-calendar"></i>';
                            out = out + '<input name="calendario" id="calendario-menu-' + data[i].id_menu + '" type="text" value="';
                            if (data[i].fecha_dia_menu) {
                                out = out + data[i].fecha_dia_menu;
                            }
                            out = out + '" placeholder="dd/mm/aaaa">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-6 nodosfilas">';
                            out = out + '<div class="col-md-4">';
                            out = out + '<label>Precio</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-8 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-eur"></i>';
                            out = out + '<input name="precio_menu" id="precio-menu-' + data[i].id_menu + '" type="text" value="';
                            if (data[i].precio_menu) {
                                out = out + data[i].precio_menu;
                            }
                            out = out + '" placeholder="">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<hr class="bordepunteadogris">';
                            out = out + '<div class="alerts">';
                            out = out + '<i class="fa fa-star"></i>';
                            out = out + '<div>';
                            out = out + '<h3>SelecciÃ³n de menÃºs habituales</h3>';
                            out = out + '<p>Si lo prefieres, puedes seleccionar uno de tus menÃºs guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>';
                            out = out + '<div id="listado-menu-habituales-' + data[i].id_menu + '" class="row">';
                            if (data[i].menus_habituales.length) {
                                for (var j in data[i].menus_habituales) {
                                    out = out + '<div class="col-md-6">';
                                    out = out + '<label>';
                                    out = out + '<a href="" id="btnSelectMenuHabitual-' + data[i].menus_habituales[j].id_menu_habitual + '-' + data[i].id_menu + '">';
                                    out = out + data[i].menus_habituales[j].nombre_menu_habitual + '&nbsp;';
                                    out = out + '<i class="fa fa-check-circle"></i>';
                                    out = out + '</a>&nbsp;';
                                    out = out + '<a href="" id="btnDeleteMenuHabitual-' + data[i].menus_habituales[j].id_menu_habitual + '-' + data[i].id_menu + '">';
                                    out = out + '<i class="fa fa-times-circle"></i>';
                                    out = out + '</a>';
                                    //out = out + '<input type="hidden" name="id_menu_habitual" id="id_menu_habitual" class="id_menu_habitual" value="' + data[i].menus_habituales[j].id_menu_habitual + '" />';
                                    out = out + '</label>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="col-md-6">';
                                out = out + '<p>Actualmente no tienes ningÃºn menÃº dado de alta.</p>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="row derecha">';
                            out = out + '<input name="borrar-cajas-' + data[i].id_menu + '" id="borrar-cajas-' + data[i].id_menu + '" class="button-3 botonpeq" type="button" value="Borrar cajas y escribir de nuevo">';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-6 dosfilas">';
                            out = out + '<h5>ENTRANTES</h5>';
                            out = out + '<div id="contenedorPlatos-' + data[i].id_menu + '">';
                            if (data[i].primeros.length) {
                                for (var k in data[i].primeros) {
                                    out = out + '<div class="row">';
                                    out = out + '<div class="col-md-10 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<i class="fa fa-cutlery"></i>';
                                    out = out + '<input value="' + data[i].primeros[k].nombre_primeros_menu + '" name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '<div class="col-md-2 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="callout-a">';
                                    out = out + '<a href="#" id="primero-' + data[i].id_menu + '" class="button-3 eliminar">X</a>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="row contenedor" id="1">';
                                out = out + '<div class="col-md-10 nodosfilas">';
                                //out = out + '<div class="row contenedor" id="1">';
                                out = out + '<div class="form-input">';
                                out = out + '<i class="fa fa-cutlery"></i>';
                                out = out + '<input name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '<div class="col-md-2 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="callout-a">';
                                out = out + '<a href="#" id="primero-' + data[i].id_menu + '" class="button-3 eliminar">X</a>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                            }
                            out = out + '</div>';
                            out = out + '<div class="clear"></div>';
                            out = out + '<div class="enlacesencillo">';
                            out = out + '<a href="#" name="addInputPrimeros-' + data[i].id_menu + '" id="addInputPrimeros-' + data[i].id_menu + '">AÃ±adir mÃ¡s entrantes<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                            out = out + '<input type="hidden" name="entrantes_menu" id="entrantes_menu">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-6 dosfilas">';
                            out = out + '<h5>PLATO PRINCIPAL</h5>';
                            out = out + '<div id="contenedorPlatos2-' + data[i].id_menu + '">';
                            if (data[i].segundos.length) {
                                for (var l in data[i].segundos) {
                                    out = out + '<div class="row">';
                                    out = out + '<div class="col-md-10 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<i class="fa fa-cutlery"></i>';
                                    out = out + '<input value="' + data[i].segundos[l].nombre_segundo_menu + '" name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '<div class="col-md-2 nodosfilas">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="form-input">';
                                    out = out + '<div class="callout-a ">';
                                    out = out + '<a href="#" id="segundo-' + data[i].id_menu + '" class="button-3 eliminar">X</a>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                    out = out + '</div>';
                                }
                            } else {

                                out = out + '<div class="row">';
                                out = out + '<div class="col-md-10 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<i class="fa fa-cutlery"></i>';
                                out = out + '<input name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '<div class="col-md-2 nodosfilas">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="form-input">';
                                out = out + '<div class="callout-a ">';
                                out = out + '<a href="#" id="segundo-' + data[i].id_menu + '" class="button-3 eliminar">X</a>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';
                                out = out + '</div>';

                            }
                            out = out + '</div>';
                            out = out + '<div class="clear"></div>';
                            out = out + '<div class="enlacesencillo">';
                            out = out + '<a href="#" name="addInputSegundos-' + data[i].id_menu + '" id="addInputSegundos-' + data[i].id_menu + '">AÃ±adir mÃ¡s segundos<span><i class="fa fa-arrow-circle-right"></i></span></a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<hr class="bordepunteadogris">';
                            out = out + '<div class="separadorgrande"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].postre_menu == 1) {
                                out = out + '<input type="checkbox" name="postre_menu_' + data[i].id_menu + '" id="postre_menu_' + data[i].id_menu + '" checked><label>Con postre</label>';
                            } else {
                                out = out + '<input type="checkbox" name="postre_menu_' + data[i].id_menu + '" id="postre_menu_' + data[i].id_menu + '"><label>Con postre</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].cafe_menu == 1) {
                                out = out + '<input type="checkbox" name="cafe_menu_' + data[i].id_menu + '" id="cafe_menu_' + data[i].id_menu + '"checked><label>Con cafÃ©</label>';
                            } else {
                                out = out + '<input type="checkbox" name="cafe_menu_' + data[i].id_menu + '" id="cafe_menu_' + data[i].id_menu + '"><label>Con cafÃ©</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].pan_menu == 1) {
                                out = out + '<input type="checkbox" name="pan_menu_' + data[i].id_menu + '" id="pan_menu_' + data[i].id_menu + '" checked><label>Con pan</label>';
                            } else {
                                out = out + '<input type="checkbox" name="pan_menu_' + data[i].id_menu + '" id="pan_menu_' + data[i].id_menu + '"><label>Con pan</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-3">';
                            out = out + '<div class="form-input">';
                            if (data[i].bebida_menu == 1) {
                                out = out + '<input type="checkbox" name="bebida_menu_' + data[i].id_menu + '" id="bebida_menu_' + data[i].id_menu + '" checked><label>Con bebida</label>';
                            } else {
                                out = out + '<input type="checkbox" name="bebida_menu_' + data[i].id_menu + '" id="bebida_menu_' + data[i].id_menu + '"><label>Con bebida</label>';
                            }
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row">';
                            out = out + '<div class="col-md-3">';
                            out = out + '<label>Observaciones</label>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-9 nodosfilas convertir12">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-pencil"></i>';
                            out = out + '<textarea maxlength="255" name="observaciones_menu_' + data[i].id_menu + '" id="observaciones_menu_' + data[i].id_menu + '" type="text">';
                            if (data[i].observaciones_menu) {
                                out = out + data[i].observaciones_menu;
                            }
                            out = out + '</textarea>';
                            out = out + '<strong><div id="contador"></div></strong>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            //out = out + '<br />';
                            out = out + '<div class="row">';
                            out = out + '<p class="reducirfila">Â¿Este menÃº lo vas a reutilizar a menudo? Ponle un nombre y dale a "Guardar como menÃº habitual"</p>';
                            out = out + '<div class="col-md-8 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-cutlery"></i>';
                            out = out + '<input name="nombre_menu_habitual" id="nombre_menu_habitual_' + data[i].id_menu + '" type="text" placeholder="Ej. MenÃº de los lunes, MenÃº arroces, etc...">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-4 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<div class="callout-a ">';
                            out = out + '<a href="#" id="btnAddMenuHabitual-' + data[i].id_menu + '" class="button-3">Guardar como menÃº habitual</a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row centrar reducirfila">';
                            out = out + '<input class="button-3 botonpeq" name="btnAddPlateMenu2-' + data[i].id_menu + '" id="btnAddPlateMenu2-' + data[i].id_menu + '" type="button" value="Actualizar menÃº">';
                            out = out + '</div>';
                            out = out + '</br>';
                            out = out + '<div id="mensajeMenu-' + data[i].id_menu + '"></div>';
                            out = out + '<input type="hidden" name="id_menu_' + data[i].id_menu + '" id="id_menu" value="' + data[i].id_menu + '" />';
                            out = out + '</form>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                    }

                }
            } else {
                out = out + '<div class="col-md-12 nodosfilas">';
                out = out + '<div class="form-input">';
                out = out + '<p style="text-align: center;">Actualmente no tienes ningÃºn menÃº aÃ±adido.</p>';
                out = out + '</div>';
                out = out + '</div>';
            }

            $('#listado-menus').html(out);
        },
        error: function (event) {
            setInterval(function () {
                $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al cargar los menusenÃƒÆ’Ã‚Âº.<br />');
            }, 3000);
        },
    });
}


function obtenerMenusHabituales(id_menu) {
    //var id = $('#id_menu').val();
    var url = "/restaurador/obtenerMenusHabitualesJSON";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_menu: id_menu,
        },
        beforeSend: function (event) {
            //$('.addFormTipoMenu').show();
            //$('.addFormTipoMenu').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
        },
        success: function (data) {
            var data = JSON.parse(data);
            var out = '';
            if (data.length) {
                for (var i in data) {
                    out = out + '<div class="col-md-6">';
                    out = out + '<label>';
                    out = out + '<a href="" id="btnSelectMenuHabitual-' + data[i].id_menu_habitual + '-' + id_menu + '">';
                    out = out + data[i].nombre_menu_habitual + '&nbsp;';
                    out = out + '<i class="fa fa-check-circle"></i>';
                    out = out + '</a>&nbsp;';
                    out = out + '<a href="" id="btnDeleteMenuHabitual-' + data[i].id_menu_habitual + '-' + id_menu + '">';
                    out = out + '<i class="fa fa-times-circle"></i>';
                    out = out + '</a>';
                    //out = out + '<input type="hidden" name="id_menu_habitual" id="id_menu_habitual" class="id_menu_habitual" value="' + data[i].id_menu_habitual + '" />';
                    out = out + '</label>';
                    out = out + '</div>';
                }
            } else {
                out = out + '<div class="col-md-6">';
                out = out + '<p>Actualmente no tienes ningÃºn menÃº dado de alta.</p>';
                out = out + '</div>';
            }
            $("#listado-menu-habituales-" + id_menu).html(out);
        }
    });
}




//Desplegables de los menÃƒÆ’Ã‚Âºs
$(document).on("click", ".accordion .accordion-title", function (event) {
    if (jQuery(this).parent().parent().parent().hasClass("toggle-accordion")) {
        jQuery(this).parent().find("li:first .accordion-title").addClass("active");
        jQuery(this).parent().find("li:first .accordion-title").next(".accordion-inner").addClass("active");
        jQuery(this).toggleClass("active");
        jQuery(this).next(".accordion-inner").slideToggle().toggleClass("active");
        jQuery(this).find("i").toggleClass("fa-minus").toggleClass("fa-plus");
    } else {
        if (jQuery(this).next().is(":hidden")) {
            jQuery(this).parent().parent().find(".accordion-title").removeClass("active").next().slideUp(200);
            jQuery(this).parent().parent().find(".accordion-title").next().removeClass("active").slideUp(200);
            jQuery(this).toggleClass("active").next().slideDown(200);
            jQuery(this).next(".accordion-inner").toggleClass("active");
            jQuery(this).parent().parent().find("i").removeClass("fa-plus").addClass("fa-minus");
            jQuery(this).find("i").removeClass("fa-minus").addClass("fa-plus");
        }
    }
    return false;
});
/* Eliminar Tipo de MenÃƒÆ’Ã‚Âº */

$(document).on("click", "a[id*='eliminar-tipo-menu-']", function (event) {

//Obtenemos el id_menu del id del objeto
    var array = this.id.split('-');
    url = '/acceso/restaurador/eliminar-tipo-menu';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_menu: array[3]
        },
        success: function () {
            obtenerTiposMenus();
            obtenerMenusCompletos();
        }
    })
    return false;
});
/*
 var MaxInputs = 50;
 var FieldCount;
 var x = $("#contenedorPlatos").length + 1;
 alert('contenedorPlatos.lenght ' + $("#contenedorPlatos").length)
 alert('contenedorPlatos2.lenght ' + $("#contenedorPlatos2").length)
 alert('x ' + x)
 var FieldCount = x - 1;
 alert('FielCount ' + FieldCount);
 */

/* Eliminar */
$("body").on("click", ".eliminar", function (e) {

    var array = this.id.split('-');
    alert('voy a borrar' + window.primeros[array[1]])
    alert(array[0] + '  ' + array[1]);
    alert('voy a borrar' + window.segundos[array[1]])
    if (window.primeros[array[1]] > 1 && array[0] == 'primero') {
        $(this).parent('div').parent().parent().parent().parent().remove();
        window.primeros[array[1]]--;
    }
    if (window.segundos[array[1]] > 1 && array[0] == 'segundo') {
        $(this).parent('div').parent().parent().parent().parent().remove();
        window.segundos[array[1]]--;
    }
    if (window.entrantes[array[1]] > 1 && array[0] == 'entrante') {
        $(this).parent('div').parent().parent().parent().parent().remove();
        window.entrantes[array[1]]--;
    }
    return false;
});

//AÃƒÂ±adir inputs
$(document).on("click", "a[id^=addInputEntrantes-]", function (event) {
    var array = this.id.split('-');
    var id_menu = array[1];
    if (window.entrantes[id_menu] <= MaxInputs) {
        window.FieldCountEntrantes[id_menu]++;
        $('#contenedorPlatosEntrantes-' + id_menu + '').append('<div class="row contenedor" id="' + window.FieldCount + '"><div class="col-md-10 nodosfilas"><div class="form-input"><i class="fa fa-cutlery"></i> <input name="entrantes_menu_estructura_' + id_menu + '[]" id="entrantes_menu_estructura" class="input-class" type="text" placeholder="AÃ±adir plato"></div></div><div class="col-md-2 nodosfilas"><div class="form-input"><div class="form-input"><div class="callout-a"><a id="entrante-' + id_menu + '" href="#" class="button-3 eliminar">X</a></div></div></div></div></div>');
        window.entrantes[id_menu]++;
    }
    return false;
});

$(document).on("click", "a[name^=addInputPrimeros-]", function (event) {
    var array = this.id.split('-');
    var id_menu = array[1];

    if (window.primeros[id_menu] <= MaxInputs) {
        window.FieldCountPrimeros[id_menu]++;
        $('#contenedorPlatos-' + id_menu + '').append('<div class="row contenedor" id="' + window.FieldCount + '"><div class="col-md-10 nodosfilas"><div class="form-input"><i class="fa fa-cutlery"></i> <input name="primeros_menu_estructura_' + id_menu + '[]" id="primeros_menu_estructura" class="input-class" type="text" placeholder="AÃ±adir plato"></div></div><div class="col-md-2 nodosfilas"><div class="form-input"><div class="form-input"><div class="callout-a"><a id="primero-' + id_menu + '" href="#" class="button-3 eliminar">X</a></div></div></div></div></div>');
        window.primeros[id_menu]++;
    }
    return false;
});
$(document).on("click", "a[name^=addInputSegundos-]", function (event) {
    var array = this.id.split('-');
    var id_menu = array[1];
    if (window.segundos[id_menu] <= window.MaxInputs) {
        window.FieldCountSegundos[id_menu]++;
        $('#contenedorPlatos2-' + id_menu + '').append('<div class="row contenedor" id="' + window.FieldCount + '"><div class="col-md-10 nodosfilas"><div class="form-input"><i class="fa fa-cutlery"></i> <input name="segundos_menu_estructura_' + id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato"></div></div><div class="col-md-2 nodosfilas"><div class="form-input"><div class="form-input"><div class="callout-a"><a id="segundo-' + id_menu + '" href="#" class="button-3 eliminar">X</a></div></div></div></div></div>');
        window.segundos[id_menu]++;
    }
    return false;
});
$(document).on("click", 'input[name^=borrar-cajas-]', function (event)
{
    var array = this.id.split('-');
    $("input[name^=primeros_menu_estructura_" + array[2] + "]").each(function () {
        $(this).val('');
    })

    $("input[name^=segundos_menu_estructura_" + array[2] + "]").each(function () {
        $(this).val('');
    })

    $("input[name^=entrantes_menu_estructura_" + array[2] + "]").each(function () {
        $(this).val('');
    })

})

//Submit del formulario de menÃƒÂºs
$(document).on('submit', 'form[name^=platos-menus-form-]', function (event) {
    alert('entro aquÃ­');
    event.preventDefault;
    return false;
})

/* Platos */
/*
 //var primeros = $('input[name="primeros_menu_estructura[]"]').val();
 $(primeros).each(function (index, valor) {
 $('#primeros_platos_menu').append(valor.value + " ");
 });
 return false;
 var segundos = $('#segundos_menu_estructura').serialize();
 $(segundos).each(function (index, valor) {
 //console.log(value);
 return true;
 });
 */
/* Compruebo si tienen postre */
$(document).on("click", 'input[name^=btnAddPlateMenu2-]', function (event)
{

    var array = this.id.split('-');

    //ValidaciÃ³n
    if ($('#calendario-menu-' + array[1]).val() == "") {
        $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca la fecha del menÃº.');
        setInterval(function () {
            $('#mensajeMenu-' + array[1]).fadeOut("slow");
            $('#mensajeMenu-' + array[1]).fadeIn("slow");
        }, 1000);
        return false;
    }

    var url = "/acceso/restaurador/anadir-platos-tipo-menu";
    //var id_menu = $('#id_menu').val();
    var id_menu = array[1];
    //alert('id_menu' + id_menu)
    var id_restaurante = $('#id_restaurantes').val();
    //alert('id_restaurante' + id_restaurante);
    var calendario_menu = $('#calendario-menu-' + array[1]).val();
    //alert('calendario' + calendario_menu);
    var precio_menu = $('#precio-menu-' + array[1]).val();
    //alert('precio' + precio_menu)
    var primeros = $('input[name="primeros_menu_estructura_' + array[1] + '[]"]').serialize();
    //alert(primeros);
    var segundos = $('input[name="segundos_menu_estructura_' + array[1] + '[]"]').serialize();
    //alert(segundos);
    var entrantes = $('input[name="entrantes_menu_estructura_' + array[1] + '[]"]').serialize();
    //alert(entrantes);
    if ($('input[name="postre_menu_' + array[1] + '"]').is(':checked')) {
        var postre_menu = 1;
    } else {
        var postre_menu = 0;
    }
    //alert('postre' + postre_menu);
    /* Compruebo si ponen cafÃƒÆ’Ã‚Â© */
    if ($('input[name="cafe_menu_' + array[1] + '"]').is(':checked')) {
        var cafe_menu = 1;
    } else {
        var cafe_menu = 0;
    }
    //alert('cafe' + cafe_menu);
    /* Compruebo si tienen pan */
    if ($('input[name="pan_menu_' + array[1] + '"]').is(':checked')) {
        var pan_menu = 1;
    } else {
        var pan_menu = 0;
    }
    //alert('pan' + pan_menu);
    /* Compruebo si tienen bebida */
    if ($('input[name="bebida_menu_' + array[1] + '"]').is(':checked')) {
//        alert('paso por aquÃ­1')
        var bebida_menu = 1;
    } else {
        //              alert('paso por aquÃ­0')
        var bebida_menu = 0;
    }
    //alert('bebida' + bebida_menu);
    var observaciones = $("#observaciones_menu_" + array[1]).val();
    //alert('observaciones' + observaciones);
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_menu: id_menu,
            id_restaurante: id_restaurante,
            calendario_menu: calendario_menu,
            precio_menu: precio_menu,
            primeros: primeros,
            segundos: segundos,
            entrantes: entrantes,
            postre_menu: postre_menu,
            cafe_menu: cafe_menu,
            pan_menu: pan_menu,
            bebida_menu: bebida_menu,
            observaciones: observaciones
        },
        beforeSend: function (event) {
            $('#mensajeMenu-' + array[1]).show();
            $('#mensajeMenu-' + array[1]).html("<span align='center'><img src='./../../assets/images/loader.gif ' /></span>");
        },
        success: function (event) {
            $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con Ã©xito.<br />');
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('#mensajeMenu-' + array[1]).fadeOut("slow");
                $('#mensajeMenu-' + array[1]).fadeIn("slow");
            }, 3000);
            false;
        },
        error: function (event) {
            setInterval(function () {
                $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />').delay(1500).fadeOut();
            }, 3000);
        }
    });
    return false;
});
/* Guardamos el menÃƒÂº como habitual */
$(document).on('click', 'a[id^=btnAddMenuHabitual-]', function (event) {
    event.preventDefault;
    var array = this.id.split('-');
    if ($('#nombre_menu_habitual_' + array[1]).val() == "") {
        $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el nombre del menÃº habitual.');
        clearInterval(parpadeo);
        parpadeo = setInterval(function () {
            $('#mensajeMenu-' + array[1]).fadeOut("slow");
            $('#mensajeMenu-' + array[1]).fadeIn("slow");
        }, 3000);
        return false;
    }

    var url = "/acceso/restaurador/anadir-menu-habitual";
    //var id_menu = $('#id_menu').val();
    var id_menu = array[1];
    var nombre = $('#nombre_menu_habitual_' + array[1]).val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_menu: id_menu,
            nombre_menu_habitual: nombre,
        },
        beforeSend: function (event) {
            $('#mensajeMenu-' + array[1]).show();
            $('#mensajeMenu-' + array[1]).html("<span align='center'><img src='./../../assets/images/loader.gif ' /></span>");
        },
        success: function (event) {
            $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con Ã©xito.<br />');
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('#mensajeMenu-' + array[1]).fadeOut("slow");
                $('#mensajeMenu-' + array[1]).fadeIn("slow");
            }, 3000);
            obtenerMenusHabituales(id_menu);
        },
        error: function (event) {
            $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('#mensajeMenu-' + array[1]).fadeOut("slow");
                $('#mensajeMenu-' + array[1]).fadeIn("slow");
            }, 3000);
        }
    });
    return false;
});
//EliminaciÃƒÂ³n de menÃƒÂºs habituales
$(document).on('click', "a[id*='btnDeleteMenuHabitual-']", function (event) {

    event.preventDefault;
    var array = this.id.split('-');
    url = '/acceso/restaurador/eliminar-menu-habitual';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_menu_habitual: array[1]
        },
        beforeSend: function (event) {
        },
        success: function (event) {
            obtenerMenusHabituales(array[2]);
        },
        error: function (event) {
        }
    });
    return false;
})

//EliminaciÃƒÂ³n de menÃƒÂºs habituales
$(document).on('click', "a[id*='btnSelectMenuHabitual-']", function (event) {

    event.preventDefault;
    var array = this.id.split('-');
    //var id_menu = $("input[id='id_menu']").val();
    var id_menu = array[2];
    url = '/acceso/restaurador/seleccionar-menu-habitual';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            id_menu_habitual: array[1]
        },
        beforeSend: function (event) {
        },
        success: function (data) {
            var data = JSON.parse(data);
            //        alert(data);
            $("#calendario-menu-" + id_menu).val(data.fecha_dia_menu);
            $("#precio-menu-" + id_menu).val(data.precio_menu);

            //Entrantes
            out = '';
            if (data.entrantes.length) {
                for (var i in data.entrantes) {
                    out = out + '<div class="row">';
                    out = out + '<div class="col-md-10 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<i class="fa fa-cutlery"></i>';
                    out = out + '<input value="' + data.entrantes[i].nombre_entrante_menu + '" name="entrantes_menu_estructura_' + id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '<div class="col-md-2 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<div class="form-input">';
                    out = out + '<div class="callout-a">';
                    out = out + '<a id="entrante-' + id_menu + '" href="#" class="button-3 eliminar">X</a>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                }
            } else {
                out = out + '<div class="row contenedor" id="1">';
                out = out + '<div class="col-md-10 nodosfilas">';
                //out = out + '<div class="row contenedor" id="1">';
                out = out + '<div class="form-input">';
                out = out + '<i class="fa fa-cutlery"></i>';
                out = out + '<input name="entrantes_menu_estructura_' + id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '<div class="col-md-2 nodosfilas">';
                out = out + '<div class="form-input">';
                out = out + '<div class="form-input">';
                out = out + '<div class="callout-a">';
                out = out + '<a id="entrante-' + id_menu + '" href="#" class="button-3 eliminar">X</a>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
            }
            $('#contenedorPlatosEntrantes-' + id_menu).html(out);

            //Primeros Platos
            out = '';
            if (data.primeros.length) {
                for (var i in data.primeros) {
                    out = out + '<div class="row contenedor" id="1">';
                    out = out + '<div class="col-md-10 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<i class="fa fa-cutlery"></i>';
                    out = out + '<input value="' + data.primeros[i].nombre_primeros_menu + '" name="primeros_menu_estructura_' + id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '<div class="col-md-2 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<div class="form-input">';
                    out = out + '<div class="callout-a">';
                    out = out + '<a id="primero-' + id_menu + '" href="#" class="button-3 eliminar">X</a>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                }
            } else {
                out = out + '<div class="row contenedor" id="1">';
                out = out + '<div class="col-md-10 nodosfilas">';
                //out = out + '<div class="row contenedor" id="1">';
                out = out + '<div class="form-input">';
                out = out + '<i class="fa fa-cutlery"></i>';
                out = out + '<input name="primeros_menu_estructura_' + id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '<div class="col-md-2 nodosfilas">';
                out = out + '<div class="form-input">';
                out = out + '<div class="form-input">';
                out = out + '<div class="callout-a">';
                out = out + '<a href="#" id="primero-' + id_menu + '" class="button-3 eliminar">X</a>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
            }
            $('#contenedorPlatos-' + id_menu).html(out);

            //Segundos
            //out = out + '<div id="contenedorPlatos2">';
            out = '';
            if (data.segundos.length) {
                for (var i in data.segundos) {
                    out = out + '<div class="row">';
                    out = out + '<div class="col-md-10 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<i class="fa fa-cutlery"></i>';
                    out = out + '<input value="' + data.segundos[i].nombre_segundo_menu + '" name="segundos_menu_estructura_' + id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '<div class="col-md-2 nodosfilas">';
                    out = out + '<div class="form-input">';
                    out = out + '<div class="form-input">';
                    out = out + '<div class="callout-a ">';
                    out = out + '<a id="segundo-' + id_menu + '" href="#" class="button-3 eliminar">X</a>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                    out = out + '</div>';
                }
            } else {
                out = out + '<div class="row">';
                out = out + '<div class="col-md-10 nodosfilas">';
                out = out + '<div class="form-input">';
                out = out + '<i class="fa fa-cutlery"></i>';
                out = out + '<input name="segundos_menu_estructura_' + id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '<div class="col-md-2 nodosfilas">';
                out = out + '<div class="form-input">';
                out = out + '<div class="form-input">';
                out = out + '<div class="callout-a ">';
                out = out + '<a id="segundo-' + id_menu + '" href="#" class="button-3 eliminar">X</a>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
                out = out + '</div>';
            }
            $('#contenedorPlatos2-' + id_menu).html(out);
            //          alert(data.postre_menu)
            //Postre
            if (data.postre_menu == '1') {
                $('#postre_menu_' + id_menu).prop('checked', true);
            } else {
                $('#postre_menu_' + id_menu).prop('checked', false);
            }
//alert(data.cafe_menu);
            //CafÃƒÂ©
            if (data.cafe_menu == '1') {
                $('#cafe_menu_' + id_menu).prop('checked', true);
            } else {
                $('#cafe_menu_' + id_menu).prop('checked', false);
            }
//alert(data.pan_menu)
            //Pan
            if (data.pan_menu == '1') {
                $('#pan_menu_' + id_menu).prop('checked', true);
            } else {
                $('#pan_menu_' + id_menu).prop('checked', false);
            }
//alert(data.bebida_menu)
            //Bebida
            if (data.bebida_menu == '1') {
                $('#bebida_menu_' + id_menu).prop('checked', true);
            } else {
                $('#bebida_menu_' + id_menu).prop('checked', false);
            }

            //Observaciones
            $('#observaciones_menu_' + id_menu).val(data.observaciones_menu);
        },
        error: function (event) {
            setInterval(function () {
                $('#mensajeMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />').delay(1500).fadeOut();
            }, 3000);
        }
    });
    return false;
})


$(document).on('ready', function () {
    /*****************************************************************************************/
    /*****************************************************************************************/
    /*************** TODO LO RELACIONADO CON EL RESTAURADOR Y SUS RESTAURANTES ***************/
    /*****************************************************************************************/
    /*****************************************************************************************/

//Cargas de elementos dinÃƒÆ’Ã‚Â¡micos
    obtenerTiposMenus();
    obtenerMenusCompletos();
//Variables para los inputs de los platos
    window.MaxInputs = 50;
    window.entrantes = [];
    window.primeros = [];
    window.segundos = [];
    window.FieldCountEntrantes = [];
    window.FieldCountPrimeros = [];
    window.FieldCountSegundos = [];
    //window.FieldCount;
    var id = $('#id_restaurantes').val();
    var url = "/restaurador/obtenerTipoMenusJSON";
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        data: {
            id_restaurante: id
        },
        beforeSend: function (event) {
        },
        success: function (data) {
            var data = JSON.parse(data);
            if (data.length) {
                for (var i in data) {
                    window.entrantes[data[i].id_menu] = $("#contenedorPlatosEntrantes-" + data[i].id_menu).children().length;
                    window.primeros[data[i].id_menu] = $("#contenedorPlatos-" + data[i].id_menu).children().length;
                    window.segundos[data[i].id_menu] = $("#contenedorPlatos2-" + data[i].id_menu).children().length;
                    window.FieldCountEntrantes[data[i].id_menu] = window.entrantes[data[i].id_menu] - 1;
                    window.FieldCountPrimeros[data[i].id_menu] = window.primeros[data[i].id_menu] - 1;
                    window.FieldCountSegundos[data[i].id_menu] = window.segundos[data[i].id_menu] - 1;
                }
            }
        },
        error: function (event) {
        }
    });
    /* Desplegamos lo del usuario TLM en la vista /registro-usuario */         $('#abrir-cerrar-buscador').on('click', function (event) {
        event.preventDefault();
        if ($('#buscador-restaurante').css("display") == 'none') {
            $('#buscador-restaurante').show("slide", {
                direction: "down"
            }, 1500);
        } else {
            $('#buscador-restaurante').hide("slide", {
                direction: "up"
            }, 1500);
        }

    });
    $('#buscador-restaurante-form').submit(function (event) {
        event.preventDefault();
        var url = "/restaurador/buscarRestaurantesPropietariosJSON";
        var nombre_restaurante = $('#nombre_restaurante_buscar').val();
        var id_propietario = $('#id_propietario').val();
        if (nombre_restaurante == '') {
            return false;
        }
        $.ajax({
            type: "POST",
            url: url,
            //async: false,
            data: {
                nombre_restaurante: nombre_restaurante,
                id_propietario: id_propietario
            },
            beforeSend: function (event) {
                $('#resultado-buscador').html('<div align="center"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                var data = JSON.parse(data);
                var out = '';
                for (var i in data) {
                    out = out + "<li>";
                    out = out + "<div class='row'>";
                    out = out + "<div class='col-md-2 nodosfilas ocultar'><img alt='' src='" + data[i].logo + "assets/images/restaurantes/00002_Restaurante02/principal.jpg'></div>";
                    out = out + "<div class='col-md-6 nodosfilas convertir8'>";
                    out = out + "<div><strong>Nombre</strong>:" + data[i].nombre_restaurante + "</div>";
                    out = out + "<div><strong>Municipio</strong>: " + data[i].municipio + "</div>";
                    out = out + "<div><strong>CategorÃƒÆ’Ã‚Â­a</strong>: " + data[i].categoria + "</div>";
                    out = out + "<div><strong>Precio medio</strong>: " + data[i].precio_medio + "</div>";
                    out = out + "</div>";
                    out = out + "<div class='col-md-4 nodosfilas'>";
                    out = out + "<div class='enlacesencillo'>";
                    out = out + "<a id='seleccionar-restaurante' href='javascript:seleccionaRestaurante(" + data[i].id_restaurante + ");'>Seleccionar<span><i class='fa fa-arrow-circle-right'></i></span></a>";
                    out = out + "</div></div></div></li>";
                }
                $('#resultado-buscador').html(out);
            }
            ,
            error: function (event) {
                $('#resultado-buscador').html('<div class="clear"></div><div class="col-md-12"><span><i class="fa fa-info-circle"></i>&nbsp;Error</span></div>');
            }
        });
        return false;
    });
    //Programamos el botÃƒÆ’Ã‚Â³n tipo <a>
    $('#buscarRestaurante').click(function (event) {
        $("#buscador-restaurante-form").submit();
        return false;
    });
    /* Guardar Tipo de MenÃƒÆ’Ã‚Âº. Para la secciÃƒÆ’Ã‚Â³n Tipos de MenÃƒÆ’Ã‚Âºs */
    $('input#btnAddTipoMenu').on('click', function (event) {

        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/anadir-tipo-menu";
        var nombre = $('#nombre_menu').val();
        var estructura = $('input:checked#estructura_menu').val();
        if (nombre == "") {

            $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el nombre del menÃº.');
            setInterval(function () {
                $('.addFormTipoMenu').fadeOut("slow");
                $('.addFormTipoMenu').fadeIn("slow");
            }, 1000);
            return false;
            /*
             $('.addFormTipoMenu').show();
             $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Falta el nombre del menÃƒÆ’Ã‚Âº<br />');
             //$('#nombre_menu').after('<span id="error_restaurante" class="form-description required-error">Falta el nombre del menÃƒÆ’Ã‚Âº</span>');
             return false;
             */
        }
        if (!$('input[name=estructura_menu]').is(':checked')) {
//$('#estructura_menu').after('<span id="error_restaurante" class="form-description required-error">Selecciona un campo</span>'); $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccion el tipo de menÃº.');
            setInterval(function () {
                $('.addFormTipoMenu').fadeOut("slow");
                $('.addFormTipoMenu').fadeIn("slow");
            }, 1000);
            //$('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Falta la estructura del menÃƒÆ’Ã‚Âº<br />');
            return false;
        }
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurantes: id,
                nombre_menu: nombre,
                estructura_menu: estructura,
            },
            beforeSend: function (event) {
                //$('.addFormTipoMenu').show();
                //$('.addFormTipoMenu').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El menÃº se ha aÃ±adido correctamente.');
                setInterval(function () {
                    $('.addFormTipoMenu').fadeOut("slow");
                    $('.addFormTipoMenu').fadeIn("slow");
                }, 1000);
                //Actualizamos los menÃƒÆ’Ã‚Âºs
                obtenerTiposMenus();
                obtenerMenusCompletos();
                //alert('todo bien')
            },
            error: function (event) {
                setInterval(function () {
                    $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar el menÃº.<br />');
                }, 3000);
            },
        });
        return false;
    });
    /* AÃƒÆ’Ã‚Â±adimos los platos al menÃƒÆ’Ã‚Âº - OpciÃƒÆ’Ã‚Â³n 1 */
    /* Pendiente */



    /* Caracteres del textarea de observaciones - Dentro de gestiÃƒÆ’Ã‚Â³n de MenÃƒÆ’Ã‚Âºs */
    var max_character = 255;
    $('#contador').html(max_character + ' MÃ¡ximos caracteres permitidos');
    $('#observaciones_menu').on('keyup', function (event)
    {
        var caracteres = $(this).val().length;
        var diff = max_character - caracteres;
        $('#contador').html(diff + ' MÃƒÂ¡ximos caracteres permitidos');
    });
    var parpadeo = '';
    var tiempo = 4000;
    //Modificar el nombre del propietario
    $('a#btnEditNombrePropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var nombre_propietario = $('#nombre_propietario').val();
        if (!nombre_propietario) {
            $('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el nombre del propietario</div>');
            $('#mensaje_nombre').css({display: "block"});
            $('#nombre_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'nombre_propietario',
                contenido: nombre_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_nombre').css({display: "block"});
                $('#mensaje_nombre').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_nombre').css({display: "block"});
                $('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Nombre modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_nombre').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    //Modificar el nombre del propietario
    $('a#btnEditApellidosPropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var apellidos_propietario = $('#apellidos_propietario').val();
        if (!apellidos_propietario) {
            $('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce los apellidos del propietario</div>');
            $('#mensaje_apellidos').css({display: "block"});
            $('#apellidos_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'apellidos_propietario',
                contenido: apellidos_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_apellidos').css({display: "block"});
                $('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_apellidos').css({display: "block"});
                $('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Apellidos modificados correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_apellidos').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    //Modificar el nombre del propietario
    $('a#btnEditEmailPropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var email_propietario = $('#email_propietario').val();
        if (!email_propietario) {
            $('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el email del propietario</div>');
            $('#mensaje_email').css({display: "block"});
            $('#email_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var email_actual = $('#email_actual').val();
        if (email_propietario == email_actual) {
            $('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El email no ha cambiado.</div>');
            $('#mensaje_email').css({display: "block"});
            $('#email_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'nuevo_email_propietario',
                contenido: email_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_email').css({display: "block"});
                $('#mensaje_email').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_email').css({display: "block"});
                $('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Email modificado correctamente.</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_email').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    //Modificar el nombre del propietario
    $('a#btnEditPasswordPropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var password_propietario = $('#password_propietario').val();
        if (password_propietario) {

            var re = /^(\d.{5,7})|(.{1}\d.{4,6})|(.{2}\d.{3,5})|(.{3}\d.{2,4})|(.{4}\d.{1,3})|(.{5}\d.{0,2})|(.{6}\d.{0,1})|(.{7}\d)$/
            if (!re.test(password_propietario)) {
                $('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos un nÃºmero y entre 6 y 8 caracteres.</div>');
                $('#mensaje_pass').css({display: "block"});
                $('#password_propietario').focus();
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
                return false;
            }
            ;
            //ValidaciÃ³n del password del gestor
            var re = /^([a-zA-Z].{5,7})|(.{1}[a-zA-Z].{4,6})|(.{2}[a-zA-Z].{3,5})|(.{3}[a-zA-Z].{2,4})|(.{4}[a-zA-Z].{1,3})|(.{5}[a-zA-Z].{0,2})|(.{6}[a-zA-Z].{0,1})|(.{7}[a-zA-Z])$/
            if (!re.test($('.password_gestor').val())) {
                $('.mensaje_pass').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra y entre 6 y 8 caracteres.');
                $('#mensaje_pass').css({display: "block"});
                $('#password_propietario').focus();
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
                return false;
            }
//ValidaciÃ³n del password del gestor
            var re = /^([A-Z].{5,7})|(.{1}[A-Z].{4,6})|(.{2}[A-Z].{3,5})|(.{3}[A-Z].{2,4})|(.{4}[A-Z].{1,3})|(.{5}[A-Z].{0,2})|(.{6}[A-Z].{0,1})|(.{7}[A-Z])$/
            if (!re.test($('.password_gestor').val())) {
                $('#mensaje_pass').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra mayÃºscula y entre 6 y 8 caracteres.');
                $('#mensaje_pass').css({display: "block"});
                $('#password_propietario').focus();
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
                return false;
            }

        } else {
            $('#mensaje_pass').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password estÃ¡ vacÃ­o.');
            $('#mensaje_pass').css({display: "block"});
            $('#password_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'pass_propietario',
                contenido: password_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_pass').css({display: "block"});
                $('#mensaje_pass').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (daata) {
                $('#mensaje_pass').css({display: "block"});
                $('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Password modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    //Modificar el telefono del propietario
    $('a#btnEditTelefonoPropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var telefono_propietario = $('#telefono_propietario').val();
        if (!telefono_propietario) {
            $('#mensaje_tel').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el telÃ©fono del propietario</div>');
            $('#mensaje_tel').css({display: "block"});
            $('#telefono_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'telefono_propietario',
                contenido: telefono_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_tel').css({display: "block"});
                $('#mensaje_tel').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_tel').css({display: "block"});
                $('#mensaje_tel').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;TelÃ©fono modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_tel').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    //Modificar el telefono del propietario
    $('a#btnEditCPPropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var cp_propietario = $('#cp_propietario').val();
        var cp = /^\d{5}$/;
        if (!cp.test($('#cp_propietario').val())) {
            $('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El formato del cÃ³digo postal es incorrecto</div>');
            $('#mensaje_cp').css({display: "block"});
            $('#cp_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'cp_propietario',
                contenido: cp_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_cp').css({display: "block"});
                $('#mensaje_cp').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_cp').css({display: "block"});
                $('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;CÃ³digo Postal modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
//Para que se ejecute al cargar la pÃ¡gina
    $("#provincia_propietario option:selected").each(function () {
        provincia = $('#id_provincia').val();
        localidad = $('#id_localidad').val();
        //if (provincia) {
        $.post("/completa-localidades/", {
            provincia: provincia, localidad: localidad
        }, function (data) {
            $("#localidad_propietario").html(data);
        });
        //}
    });
//Para que se ejecute al cambiar la provincia
    $("#provincia_propietario").on('change', function () {
        $("#provincia_propietario option:selected").each(function () {
            provincia = $('#provincia_propietario').val();
            $.post("/completa-localidades/", {
                provincia: provincia
            }, function (data) {
                //alert(data);
                $("#localidad_propietario").html(data);
            });
        });
    });
    //Provincia del propietario
    $('a#btnEditProvinciaPropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_provincia').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var provincia_propietario = $('#provincia_propietario').val();
        if (!provincia_propietario) {
            $('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, selecciona la provincia</div>');
            $('#mensaje_provincia').css({display: "block"});
            $('#provincia_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'provincias_id_provincia',
                contenido: provincia_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_provincia').css({display: "block"});
                $('#mensaje_provincia').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_provincia').css({display: "block"});
                $('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Provincia modificada correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_provincia').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    //Localidad del propietario
    $('a#btnEditLocalidadPropietario').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre').css({display: "none"});
        $('#mensaje_apellidos').css({display: "none"});
        $('#mensaje_email').css({display: "none"});
        $('#mensaje_pass').css({display: "none"});
        $('#mensaje_tel').css({display: "none"});
        $('#mensaje_localidad').css({display: "none"});
        $('#mensaje_provincia').css({display: "none"});
        $('#mensaje_cp').css({display: "none"});
        var localidad_propietario = $('#localidad_propietario').val();
        if (!localidad_propietario) {
            $('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, selecciona la localidad</div>');
            $('#mensaje_localidad').css({display: "block"});
            $('#localidad_propietario').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarDatosPropietario";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_propietario: $("#id_propietario").val(),
                campo: 'localidades_id_localidad',
                contenido: localidad_propietario
            },
            beforeSend: function (event) {
                $('#mensaje_localidad').css({display: "block"});
                $('#mensaje_localidad').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_localidad').css({display: "block"});
                $('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Localidad modificada correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_localidad').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    /* Datos del Restaurante */
    //Nombre del restaurante
    $('a#btnModificarNombreRestaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var nombre_restaurante = $('#nombre_restaurante2').val();
        if (!nombre_restaurante) {
            $('#mensaje_nombre_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el nombre del restaurante</div>');
            $('#mensaje_nombre_restaurante').css({display: "block"});
            $('#nombre_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }
        ;
        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'nombre_restaurante',
                contenido: nombre_restaurante
            },
            beforeSend: function (event) {
                $('#mensaje_nombre_restaurante').css({display: "block"});
                $('#mensaje_nombre_restaurante').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_nombre_restaurante').css({display: "block"});
                $('#mensaje_nombre_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Nombre modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_nombre_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });
    //Web del restaurante
    $('a#btnModificarWebRestaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var web_restaurante = $('#web_restaurante').val();
        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'web_restaurante',
                contenido: web_restaurante
            },
            beforeSend: function (event) {
                $('#mensaje_web').css({display: "block"});
                $('#mensaje_web').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_web').css({display: "block"});
                $('#mensaje_web').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Web modificada correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_web').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });
        return false;
    });

    //Calle del restaurante
    $('a#btnModificarCalleRestaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var calle_restaurante = $('#calle_restaurante').val();
        if (!calle_restaurante) {
            $('#mensaje_calle').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca la calle del restaurante</div>');
            $('#mensaje_calle').css({display: "block"});
            $('#calle_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'direccion_restaurante',
                contenido: calle_restaurante
            },
            beforeSend: function (event) {
                $('#mensaje_calle').css({display: "block"});
                $('#mensaje_calle').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_calle').css({display: "block"});
                $('#mensaje_calle').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Calle modificada correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_calle').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        //LocalizaciÃ³n de la direcciÃ³n
        var geocoder = new google.maps.Geocoder();
        var address = $("#calle_restaurante").val() + ', ' + $("#numero_restaurante").val() + ', ' + $("#cp_restaurante").val();
        //var address = $(".calle_restaurante").val();

        //alert(address);
        //buscamos en la region de espaÃ±a
        geocoder.geocode({'address': address, 'region': 'es'}, function (results, status) {
            if (status == 'OK') {
                //alert('DirecciÃ³n reconocida');
                //Calle
                if (results[0].address_components[1]) {
                    //alert(results[0].address_components[1].long_name);
                    $('#calle_restaurante').val(results[0].address_components[1].long_name);
                } else {
                    //alert('Componente1 vacÃ­o');
                }
                //CÃ³digo Postal
                if (results[0].address_components[7]) {
                    //alert(results[0].address_components[7].long_name);
                    $('#cp_restaurante').val(results[0].address_components[7].long_name);
                } else {
                    //alert('Componente7 vacÃ­o');
                }
                //Localidad o municipio
                if (results[0].address_components[2]) {
                    //alert(results[0].address_components[2].long_name);
                    $('#localidad_restaurante').val(results[0].address_components[2].long_name);
                } else {
                    //alert('Componente2 vacÃ­o');
                }
                //La provincia la sacamos del componente 4
                if (results[0].address_components[4]) {
                    $('#provincia_restaurante').val(results[0].address_components[4].long_name);
                }

                var url = "/restaurador/editarRestaurante";
                $.ajax({
                    type: "POST",
                    url: url,
                    async: false,
                    data: {
                        id_restaurante: $("#id_restaurantes").val(),
                        campo: 'lat_long_restaurante',
                        contenido: results[0].geometry.location.toString()
                    },
                    beforeSend: function (event) {
                    },
                    success: function (data) {
                    },
                    error: function (event) {
                    }
                });

                $('#municipio_restaurante').prop('disabled', false);
                $('#provincia_restaurante').prop('disabled', false);
            }

        });

        return false;
    });
    //NÃºmero de la calle del restaurante
    $('a#btnModificarNumeroRestaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var numero_restaurante = $('#numero_restaurante').val();
        if (!numero_restaurante) {
            $('#mensaje_numero').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca la calle del restaurante</div>');
            $('#mensaje_numero').css({display: "block"});
            $('#numero_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'numero_restaurante',
                contenido: numero_restaurante
            },
            beforeSend: function (event) {
                $('#mensaje_numero').css({display: "block"});
                $('#mensaje_numero').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_numero').css({display: "block"});
                $('#mensaje_numero').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;NÃºmero modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_numero').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        //LocalizaciÃ³n de la direcciÃ³n
        var geocoder = new google.maps.Geocoder();
        var address = $("#calle_restaurante").val() + ', ' + $("#numero_restaurante").val() + ', ' + $("#cp_restaurante").val();

        //buscamos en la region de espaÃ±a
        geocoder.geocode({'address': address, 'region': 'es'}, function (results, status) {
            if (status == 'OK') {
                //alert('DirecciÃ³n reconocida');
                //Calle
                if (results[0].address_components[1]) {
                    //alert(results[0].address_components[1].long_name);
                    $('#calle_restaurante').val(results[0].address_components[1].long_name);
                } else {
                    //alert('Componente1 vacÃ­o');
                }
                //CÃ³digo Postal
                if (results[0].address_components[7]) {
                    //alert(results[0].address_components[7].long_name);
                    $('#cp_restaurante').val(results[0].address_components[7].long_name);
                } else {
                    //alert('Componente7 vacÃ­o');
                }
                //Localidad o municipio
                if (results[0].address_components[2]) {
                    //alert(results[0].address_components[2].long_name);
                    $('#localidad_restaurante').val(results[0].address_components[2].long_name);
                } else {
                    //alert('Componente2 vacÃ­o');
                }
                //La provincia la sacamos del componente 4
                if (results[0].address_components[4]) {
                    $('#provincia_restaurante').val(results[0].address_components[4].long_name);
                }

                /*
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
                 //CÃ³digo postal
                 if (results[0].address_components[7]) {
                 completeAddress = completeAddress + ' ' + results[0].address_components[7].long_name;
                 }
                 completeAddress = completeAddress + ' (' + $('#provincia_restaurante').val() + ')';
                 */
                var url = "/restaurador/editarRestaurante";
                $.ajax({
                    type: "POST",
                    url: url,
                    async: false,
                    data: {
                        id_restaurante: $("#id_restaurantes").val(),
                        campo: 'lat_long_restaurante',
                        contenido: results[0].geometry.location.toString()
                    },
                    beforeSend: function (event) {
                    },
                    success: function (data) {
                    },
                    error: function (event) {
                    }
                });

                $('#municipio_restaurante').prop('disabled', false);
                $('#provincia_restaurante').prop('disabled', false);
            }

        });

        return false;
    });

    //NÃºmero de la calle del restaurante
    $('a#btnModificarCPRestaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var cp_restaurante = $('#cp_restaurante').val();
        var cp = /^\d{5}$/;
        if (!cp.test($('#cp_propietario').val())) {
            $('#mensaje_cp_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el cÃ³digo postal del restaurante</div>');
            $('#mensaje_cp_restaurante').css({display: "block"});
            $('#cp_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'cp_restaurante',
                contenido: cp_restaurante
            },
            beforeSend: function (event) {
                $('#mensaje_cp_restaurante').css({display: "block"});
                $('#mensaje_cp_restaurante').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_cp_restaurante').css({display: "block"});
                $('#mensaje_cp_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;CÃ³digo Postal modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_cp_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        //LocalizaciÃ³n de la direcciÃ³n
        var geocoder = new google.maps.Geocoder();
        var address = $("#calle_restaurante").val() + ', ' + $("#numero_restaurante").val() + ', ' + $("#cp_restaurante").val();
        //var address = $(".calle_restaurante").val();

        //alert(address);
        //buscamos en la region de espaÃ±a
        geocoder.geocode({'address': address, 'region': 'es'}, function (results, status) {
            if (status == 'OK') {
                //alert('DirecciÃ³n reconocida');
                //Calle
                if (results[0].address_components[1]) {
                    //alert(results[0].address_components[1].long_name);
                    $('#calle_restaurante').val(results[0].address_components[1].long_name);
                } else {
                    //alert('Componente1 vacÃ­o');
                }
                //CÃ³digo Postal
                if (results[0].address_components[7]) {
                    //alert(results[0].address_components[7].long_name);
                    $('#cp_restaurante').val(results[0].address_components[7].long_name);
                } else {
                    //alert('Componente7 vacÃ­o');
                }
                //Localidad o municipio
                if (results[0].address_components[2]) {
                    //alert(results[0].address_components[2].long_name);
                    $('#localidad_restaurante').val(results[0].address_components[2].long_name);
                } else {
                    //alert('Componente2 vacÃ­o');
                }
                //La provincia la sacamos del componente 4
                if (results[0].address_components[4]) {
                    $('#provincia_restaurante').val(results[0].address_components[4].long_name);
                }
//alert(results[0].geometry.location.toString());
                var url = "/restaurador/editarRestaurante";
                $.ajax({
                    type: "POST",
                    url: url,
                    async: false,
                    data: {
                        id_restaurante: $("#id_restaurantes").val(),
                        campo: 'lat_long_restaurante',
                        contenido: results[0].geometry.location.toString()
                    },
                    beforeSend: function (event) {
                    },
                    success: function (data) {
                    },
                    error: function (event) {
                    }
                });

                $('#municipio_restaurante').prop('disabled', false);
                $('#provincia_restaurante').prop('disabled', false);
            }

        });


        return false;
    });

    //Barrio del restaurante
    $('a#btnModificarBarrio').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var barrio_restaurante = $('#barrio_restaurante').val();

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'barrio_restaurante',
                contenido: barrio_restaurante
            },
            beforeSend: function (event) {
                $('#mensaje_barrio').css({display: "block"});
                $('#mensaje_barrio').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_barrio').css({display: "block"});
                $('#mensaje_barrio').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Barrio modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_barrio').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        return false;
    });


    //Barrio del restaurante
    $('a#btnModificarPrecio').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var precio_restaurante = $('#precio_medio_restaurante').val();
        if (precio_restaurante=='Selecciona rango de precios') {
            $('#mensaje_cp_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un rango</div>');
            $('#mensaje_cp_restaurante').css({display: "block"});
            $('#cp_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'precio_carta_restaurante',
                contenido: precio_restaurante
            },
            beforeSend: function (event) {
                $('#mensaje_precio').css({display: "block"});
                $('#mensaje_precio').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_precio').css({display: "block"});
                $('#mensaje_precio').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Precio modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_precio').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        return false;
    });

    /* Guardamos la carta del restaurante - Tiene validaciÃƒÆ’Ã‚Â³n, con lo que si no se cumple, no se subirÃƒÆ’Ã‚Â¡ el fichero. */
    $('a#btnUploadCartaRestaurante').on('click', function (event) {

        var formData = new FormData();
        var nombre_fichero = document.getElementById("file").files[0];
        var extensiones = new Array('pdf', 'jpg', 'doc', 'docs');
        var documento = $('#file')[0].files[0];
        //Obtenemos el nombre del documento
        var fileName = documento.name;
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
//ExtensiÃƒÆ’Ã‚Â³n
        var fileType = documento.type;
        //Obtenemos el peso del documento
        var fileSize = documento.size;
        if (fileSize > 5242880) {
            $('#mensaje_carta').css({display: "block"});
            $('#mensaje_carta').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;El peso del documento tiene que ser menos de 5MB</div>');
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);

            return false;
        }

        if (fileExtension != extensiones[0] && fileExtension != extensiones[1] && fileExtension != extensiones[2] && fileExtension != extensiones[3])
        {
            $('#mensaje_carta').css({display: "block"});
            $('#mensaje_carta').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;El formato del documento tiene que ser ' + extensiones + '</div>');
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);

            return false;
        }
        else
        {
            console.log('Formato permitido');
        }



        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/actualizar-pdf-restaurante?id_restaurantes" + id;
        formData.append('file', nombre_fichero);
        formData.append('id_restaurantes', id);
        $.ajax({
            type: "POST",
            url: url,
            processData: false,
            contentType: false,
            data: formData,
            beforeSend: function (event)
            {
                $('#mensaje_carta').css({display: "block"});
                $('#mensaje_carta').html('<div align="center" class="efecto-fade"><img src="/assets/images/loader.gif" /></div>');
            },
            success: function (data)
            {
                $('#mensaje_carta').css({display: "block"});
                $('#mensaje_carta').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Carta subida correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);

                $("#mostrar_carta").html(data);
            },
            error: function (event)
            {
                $('#mensaje_carta').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
        return false;
    });


    //Barrio del restaurante
    $('#parking_restaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var parking_restaurante = $('#parking_restaurante').val();
        //alert(parking_restaurante);
        if (parking_restaurante==='1'){
            parking_restaurante=0;
            $('#parking_restaurante').val(0);
        } else {
            parking_restaurante=1;
            $('#parking_restaurante').val(1);
        }
        //alert(parking_restaurante);

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'parking_restaurante',
                contenido: parking_restaurante
            },
            beforeSend: function (event) {
            },
            success: function (data) {
                //alert('success. '+data);
            },
            error: function (event) {
            }
        });

        //return false;
    });

    $('#tarjetas_restaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var tarjetas_restaurante = $('#tarjetas_restaurante').val();
        //alert('antes: '+tarjetas_restaurante);
        if (tarjetas_restaurante==='1'){
            tarjetas_restaurante=0;
            $('#tarjetas_restaurante').val(0);
        } else {
            tarjetas_restaurante=1;
            $('#tarjetas_restaurante').val(1);
        }
        //alert(tarjetas_restaurante);

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'tarjetas_restaurante',
                contenido: tarjetas_restaurante
            },
            beforeSend: function (event) {
            },
            success: function (data) {
                //alert('success. '+data);
            },
            error: function (event) {
            }
        });

        //return false;
    });

    $('#reservas_restaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var reservas_restaurante = $('#reservas_restaurante').val();
        //alert(parking_restaurante);
        if (reservas_restaurante==='1'){
            reservas_restaurante=0;
            $('#reservas_restaurante').val(0);
        } else {
            reservas_restaurante=1;
            $('#reservas_restaurante').val(1);
        }
        //alert(parking_restaurante);

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'reservas_restaurante',
                contenido: reservas_restaurante
            },
            beforeSend: function (event) {
            },
            success: function (data) {
                //alert('success. '+data);
            },
            error: function (event) {
            }
        });

        //return false;
    });

    $('#visible_restaurante').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var visible_restaurante = $('#visible_restaurante').val();
        //alert(parking_restaurante);
        if (visible_restaurante==='1'){
            visible_restaurante=0;
            $('#visible_restaurante').val(0);
        } else {
            visible_restaurante=1;
            $('#visible_restaurante').val(1);
        }
        //alert(parking_restaurante);

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'visible_restaurante',
                contenido: visible_restaurante
            },
            beforeSend: function (event) {
            },
            success: function (data) {
                //alert('success. '+data);
            },
            error: function (event) {
            }
        });

        //return false;
    });

    $('a#btnModificarCategoria').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});

        var primera_categoria = $('#primera_categoria_restaurante').val();
        if (primera_categoria=='Selecciona categoría') {
            $('#mensaje_categoria').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una categoría</div>');
            $('#mensaje_categoria').css({display: "block"});
            $('#primera_categoria_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'categorias_id_categoria',
                contenido: primera_categoria
            },
            beforeSend: function (event) {
                $('#mensaje_categoria').css({display: "block"});
                $('#mensaje_categoria').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                //alert(data+'... success')
                $('#mensaje_categoria').css({display: "block"});
                $('#mensaje_categoria').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Categoria modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_categoria').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        return false;
    });

    $('a#btnModificarCategoria2').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});
        $('#mensaje_categoria').css({display: "none"});
        $('#mensaje_categoria3').css({display: "none"});

        var segunda_categoria = $('#segunda_categoria_restaurante').val();
        if (segunda_categoria=='Selecciona categoría') {
            $('#mensaje_categoria2').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una categoría</div>');
            $('#mensaje_categoria2').css({display: "block"});
            $('#segunda_categoria_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'segunda_categoria_restaurante',
                contenido: segunda_categoria
            },
            beforeSend: function (event) {
                $('#mensaje_categoria2').css({display: "block"});
                $('#mensaje_categoria2').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_categoria2').css({display: "block"});
                $('#mensaje_categoria2').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Categoria modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_categoria2').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        return false;
    });

    $('a#btnModificarCategoria3').on('click', function (event) {
        event.preventDefault;
        $('#mensaje_nombre_restaurante').css({display: "none"});
        $('#mensaje_web').css({display: "none"});
        $('#mensaje_calle').css({display: "none"});
        $('#mensaje_numero').css({display: "none"});
        $('#mensaje_cp_restaurante').css({display: "none"});
        $('#mensaje_barrio').css({display: "none"});
        $('#mensaje_precio').css({display: "none"});
        $('#mensaje_categoria').css({display: "none"});
        $('#mensaje_categoria2').css({display: "none"});

        var tercera_categoria = $('#tercera_categoria_restaurante').val();
        if (tercera_categoria=='Selecciona categoría') {
            $('#mensaje_categoria3').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una categoría</div>');
            $('#mensaje_categoria3').css({display: "block"});
            $('#tercera_categoria_restaurante').focus();
            clearInterval(parpadeo);
            parpadeo = setInterval(function () {
                $('.efecto-fade').fadeOut("slow");
                $('.efecto-fade').fadeIn("slow");
            }, tiempo);
            return false;
        }

        var url = "/restaurador/editarRestaurante";
        $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: {
                id_restaurante: $("#id_restaurantes").val(),
                campo: 'tercera_categoria_restaurante',
                contenido: tercera_categoria
            },
            beforeSend: function (event) {
                $('#mensaje_categoria3').css({display: "block"});
                $('#mensaje_categoria3').html('<div align="center" class="efecto-fade"><img src="assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                $('#mensaje_categoria3').css({display: "block"});
                $('#mensaje_categoria3').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Categoria modificado correctamente</div>');
                clearInterval(parpadeo);
                parpadeo = setInterval(function () {
                    $('.efecto-fade').fadeOut("slow");
                    $('.efecto-fade').fadeIn("slow");
                }, tiempo);
            },
            error: function (event) {
                $('#mensaje_categoria3').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            }
        });

        return false;
    });








    /* Este cÃƒÆ’Ã‚Â³digo de aki abajo no se utiliza, ya que no funciona correctamente, no obstante, no borrar, ya que se puede utilizar en un futuro. */
    $('input#btnAddPlateMenu').on('click', function (event)
    {
        var url = "/acceso/restaurador/anadir-platos-tipo-menu";
        var id = $('#id_menu').val();
        var restaurantes = $('#id_restaurantes').val();
        var calendario = $('input[name=calendario]').val();
        var precio = $('#precio').val();
        /* Platos */
        var primeros = $('#primeros_menu_estructura').serialize();
        //var primeros = $('input[name="primeros_menu_estructura[]"]').val();
        $(primeros).each(function (index, valor) {
            $('#primeros_platos_menu').append(valor.value + " ");
        });
        return false;
        var segundos = $('#segundos_menu_estructura').serialize();
        $(segundos).each(function (index, valor) {
            //console.log(value);
            return true;
        });
        /* Compruebo si tienen postre */
        if ($('input[name=postre_menu]').is(':checked')) {
            var postre_menu = 1;
        } else {
            var postre_menu = 0;
        }

        /* Compruebo si ponen cafÃƒÆ’Ã‚Â© */
        if ($('input[name=cafe_menu]').is(':checked')) {
            var cafe_menu = 1;
        } else {
            var cafe_menu = 0;
        }

        /* Compruebo si tienen pan */
        if ($('input[name=pan_menu]').is(':checked')) {
            var pan_menu = 1;
        } else {
            var pan_menu = 0;
        }
        /* Compruebo si tienen bebida */
        if ($('input[name=bebida_menu]').is(':checked')) {
            var bebida_menu = 1;
        } else {
            var bebida_menu = 0;
        }
        $.ajax({
            type: "POST",
            url: url,
            dataType: "html",
            data: {
                id_menu: id,
                id_restaurantes: restaurantes,
                calendario: calendario,
                precio: precio,
                primeros_menu_estructura: primeros,
                segundos_menu_estructura: segundos,
                postre_menu: postre_menu,
                cafe_menu: cafe_menu,
                pan_menu: pan_menu,
                bebida_menu: bebida_menu,
            },
            beforeSend: function (event) {
                $('.addFormPlateMenu').show();
                $('.addFormPlateMenu').html("<span align='center'><img src='./../../assets/images/loader.gif ' /></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('.addFormPlateMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con Ã©xito.<br />');
                    location.reload();
                }, 3000);
                return false;
            },
            error: function (event) {
                setInterval(function () {
                    $('.addFormPlateMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
                }, 3000);
            }
        });
        return false;
    }); /* Propietarios == Restaurador */
    $('a#btnEditPropertyForm').on('click', function (event) {
        var nombre = $('#nombre_propietario').val();
        var apellidos = $('#apellidos_propietario').val();
        var email = $('#email_propietario').val();
        var clave = $('#pass_propietario').val();
        var dni = $('#dni_propietario').val();
        var telefono = $('#telefono_propietario').val();
        var cp = $('#cp_propietario').val();
        var url = "./actualizar-restaurador";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                nombre_propietario: nombre,
                apellidos_propietario: apellidos,
                email_propietario: email,
                pass_propietario: clave,
                dni_propietario: dni,
                telefono_propietario: telefono,
                cp_propietario: cp
            }, beforeSend: function (event) {
                $('.editFormProperties').show();
                $('.editFormProperties').html("<span align='center'><img src='./../../assets/images/loader.gif ' /></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('.editFormProperties').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con Ã©xito.<br />');
                    location.reload();
                }, 3000);
                return false;
            },
            error: function (event) {
                setInterval(function () {
                    $('.editFormProperties').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
                }, 3000);
            }
        });
        return false;
    });



    /* El restaurador actualiza un restaurante. El restaurante que se muestra en el panel, es el ÃƒÆ’Ã‚Âºltimo actualizado. */
    $('a#btnEditRestaurantForm').on('click', function (event) {
        var id = $('#id_restaurante').val();
        var nombre = $('#nombre_restaurante').val();
        var web_restaurante = $('#web_restaurante').val();
        var direccion_restaurante = $('#direccion_restaurante').val();
        var numero_restaurante = $('#numero_restaurante').val();
        var cp_restaurante = $('#cp_restaurante').val();
        var barrio_restaurante = $('#barrio_restaurante').val();
        var precio_medio_restaurante = $('#precio_medio_restaurante').val();
        var parking_restaurante = $('#parking_restaurante').val();
        var tarjetas_restaurante = $('#tarjetas_restaurante').val();
        var reservas_restaurante = $('#reservas_restaurante').val();
        var visible_restaurante = $('#visible_restaurante').val();
        /* Compruebo si hay parking o no */
        if ($('input[name=parking_restaurante]').is(':checked')) {
            var parking_restaurante = 1;
        } else {
            var parking_restaurante = 0;
        }

        /* Compruebo si se aceptan tarjetas o no */
        if ($('input[name=tarjetas_restaurante]').is(':checked')) {
            var tarjetas_restaurante = 1;
        } else {
            var tarjetas_restaurante = 0;
        }

        /* Compruebo si se permiten reservas */
        if ($('input[name=reservas_restaurante]').is(':checked')) {
            var reservas_restaurante = 1;
        } else {
            var reservas_restaurante = 0;
        }
        /* Compruebo si el restaurante es visible o no -> Visible hace referencia a si el restaurante es facil de ver. */
        if ($('input[name=visible_restaurante]').is(':checked')) {
            var visible_restaurante = 1;
        } else {
            var visible_restaurante = 0;
        }
        var url = "/acceso/restaurador/actualizar-restaurante";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurante: id,
                nombre_restaurante: nombre,
                web_restaurante: web_restaurante,
                direccion_restaurante: direccion_restaurante,
                numero_restaurante: numero_restaurante,
                barrio_restaurante: barrio_restaurante,
                precio_medio_restaurante: precio_medio_restaurante,
                parking_restaurante: parking_restaurante,
                tarjetas_restaurante: tarjetas_restaurante,
                reservas_restaurante: reservas_restaurante,
                visible_restaurante: visible_restaurante,
                cp_restaurante: cp_restaurante
            },
            beforeSend: function (event) {
                $('.editFormRestaurant').show();
                $('.editFormRestaurant').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('.editFormRestaurant').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con Ã©xito.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.editFormRestaurant').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
                }, 3000);
            },
        });
        return false;
    });

    /* Guardamos la carta del restaurante - Tiene validaciÃƒÆ’Ã‚Â³n, con lo que si no se cumple, no se subirÃƒÆ’Ã‚Â¡ el fichero. */
    /*
     $('a#btnUploadCartaRestaurante').on('click', function (event) {
     
     var formData = new FormData();
     var nombre_fichero = document.getElementById("file").files[0];
     var extensiones = new Array('pdf', 'jpg', 'doc', 'docs');
     var documento = $('#file')[0].files[0];
     //Obtenemos el nombre del documento
     var fileName = documento.name;
     var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
     //ExtensiÃƒÆ’Ã‚Â³n
     var fileType = documento.type;
     //Obtenemos el peso del documento
     var fileSize = documento.size;
     if (fileSize > 5242880) {
     alert('El peso del documento tiene que ser menos que 5MB');
     return false;
     }
     
     if (fileExtension != extensiones[0] && fileExtension != extensiones[1] && fileExtension != extensiones[2] && fileExtension != extensiones[3])
     {
     alert('El formato del documento tiene que ser ' + extensiones);
     return false;
     }
     else
     {
     console.log('Formato permitido');
     }
     
     
     
     var id = $('#id_restaurantes').val();
     var url = "/acceso/restaurador/actualizar-pdf-restaurante?id_restaurantes" + id;
     formData.append('file', nombre_fichero);
     formData.append('id_restaurantes', id);
     $.ajax({
     type: "POST",
     url: url,
     processData: false,
     contentType: false,
     data: formData,
     beforeSend: function (event)
     {
     $('#mensajePDF').show();
     $('#mensajePDF').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
     },
     success: function (event)
     {
     setInterval(function () {
     $('#mensajePDF').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Carta subida con Ã©xito.<br />').delay(3000).fadeOut();
     }, 3000);
     },
     error: function (event)
     {
     setInterval(function () {
     $('#mensajePDF').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al subir la carta.<br />').delay(3000).fadeOut();
     }, 3000);
     },
     });
     return false;
     });
     */


// Actualizamos las categorias de los restaurantes
    $('a#btnEditCategoryForm').on('click', function (event) {
        var id = $('#id_restaurante').val();
        var primera_categoria_restaurante = $('#primera_categoria_restaurante').val();
        var segunda_categoria_restaurante = $('#segunda_categoria_restaurante').val();
        var tercera_categoria_restaurante = $('#tercera_categoria_restaurante').val();
        var url = "/acceso/restaurador/actualizar-categorias";
        console.log("Datos: " + primera_categoria_restaurante);
        //return false;

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id_restaurante: id,
                primera_categoria_restaurante: primera_categoria_restaurante,
                segunda_categoria_restaurante: segunda_categoria_restaurante,
                tercera_categoria_restaurante: tercera_categoria_restaurante
            },
            beforeSend: function (event) {
                $('.editFormCategory').show();
                $('.editFormCategory').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('.editFormCategory').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con Ã©xito.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.editFormCategory').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
                }, 3000);
            },
        });
        return false;
    });
    /* Especialidades */
    $('a#btnAddEspecialtiesForm').on('click', function (event) {
        var select_nombre_especialidad = $('#select_nombre_especialidad').val();
        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/anadir-especialidad";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id,
                select_nombre_especialidad: select_nombre_especialidad,
            },
            beforeSend: function (event) {
                $('.editFormEspecialidades').show();
                $('.editFormEspecialidades').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('.editFormEspecialidades').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con Ã©xito.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.editFormEspecialidades').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
                }, 3000);
            },
        });
        return false;
    }); /****************** Puntos de interÃƒÆ’Ã‚Â©s ******************/
    $('a#btnAddPuntoInteres').on('click', function (event) {
        var nombre_punto_cercano = $('#select_nombre_punto_cercano').val();
        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/anadir-puntos-interes";
        /*
         console.log(nombre_punto_cercano);
         return false;
         */

        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id,
                select_nombre_punto_cercano: nombre_punto_cercano,
            },
            beforeSend: function (event) {
                $('.editFormPuntoInteres').show();
                $('.editFormPuntoInteres').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {

                    $('.editFormPuntoInteres').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Punto cercano aÃ±adido correctamente.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.editFormPuntoInteres').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
                }, 3000);
            },
        });
        return false;
    }); /* Datos de facturaciÃƒÆ’Ã‚Â³n */
    $('a#btnEditBillingData').on('click', function (event) {
        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/editar-razon-social";
        var razon_social = $('#razon_social_facturacion').val();
        var direccion = $('#direccion_facturacion').val();
        var numero = $('#numero_facturacion').val();
        var cp = $('#cp_facturacion').val();
        var email = $('#email_facturacion').val();
        var periodo = $('#periodo_facturacion').val();
        var numero_cuenta = $('#num_cuenta_facturacion').val();
        var cif = $('#cif_facturacion').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id,
                razon_social_facturacion: razon_social,
                direccion_facturacion: direccion,
                numero_facturacion: numero,
                cp_facturacion: cp,
                email_facturacion: email,
                periodo_facturacion: periodo,
                num_cuenta_facturacion: numero_cuenta,
                cif_facturacion: cif,
            },
            beforeSend: function (event) {
                $('.editFormRazonSocial').show();
                $('.editFormRazonSocial').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('.editFormRazonSocial').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Datos modificados correctamente.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.editFormRazonSocial').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al modificar los datos.<br />');
                }, 3000);
            },
        });
        return false;
    }); /* Dentro del panel de Datos de FacturaciÃƒÆ’Ã‚Â³n - Cambiamos el plan contratado */
    /* El va asociado al Restaurante */
    $('a#btnEditPlanContratado').on('click', function (event) {

        var url = "/acceso/restaurador/editar-plan-contratado";
        var id = $('#id_restaurantes').val();
        var plan = $('#plan_contratado').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id,
                plan_contratado: plan,
            },
            beforeSend: function (event) {
                $('.editFormRazonSocial').show();
                $('.editFormRazonSocial').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {

                    $('.editFormRazonSocial').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Datos modificados correctamente.<br />');
                    location.reload();
                }, 3000);
            }, error: function (event) {
                setInterval(function () {
                    $('.editFormRazonSocial').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al modificar los datos.<br />');
                }, 3000);
            },
        });
        return false;
    });
    /* Seccion Cupones de descuento */
    /* AÃƒÆ’Ã‚Â±adir cupÃƒÆ’Ã‚Â³n */
    $('#btnAddCupon').on('click', function (event) {

        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/anadir-cupon";
        var titulo = $('#titulo_cupon').val();
        var descripcion = $('#descripcion_cupon').val();
        var fecha_inicio = $('#fecha_inicio_cupon').val();
        var fecha_fin = $('#fecha_fin_cupon').val();
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id,
                titulo_cupon: titulo,
                descripcion_cupon: descripcion,
                fecha_inicio_cupon: fecha_inicio,
                fecha_fin_cupon: fecha_fin,
            },
            beforeSend: function (event) {
                $('.addFormCupon').show();
                $('.addFormCupon').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {

                    $('.addFormCupon').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;CupÃ³n aÃ±adido correctamente.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.addFormCupon').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar el cupÃ³n.<br />');
                }, 3000);
            },
        });
        return false;
    });
    /* Editar cupÃƒÆ’Ã‚Â³n */
    /*
     $('input#btnEditCupon').on('click', function (event){
     
     //var id = $('#clave_cupon').val();
     //var id = $('input[name=clave_cupon]').serialize();
     
     var url = "/acceso/restaurador/editar-cupon?clave_cupon="+id;
     
     var titulo = $('#select_titulo_cupon').val();
     var descripcion = $('#select_descripcion_cupon').val();
     var fecha_inicio = $('#select_fecha_inicio_cupon').val();
     var fecha_fin = $('#select_fecha_fin_cupon').val();
     
     $.ajax({
     type: "POST",
     url: url,
     data: {
     clave_cupon: id,
     select_titulo_cupon: titulo,
     select_descripcion_cupon: descripcion,
     select_fecha_inicio_cupon: fecha_inicio,
     select_fecha_fin_cupon: fecha_fin,
     },
     
     beforeSend: function (event){
     $('.editFormCupon').show();
     $('.editFormCupon').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
     },
     
     success: function (event){
     setInterval(function(){
     
     $('.editFormCupon').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;CupÃƒÆ’Ã‚Â³n editado correctamente.<br />');
     location.reload();
     
     }, 3000);
     },
     error: function (event){
     setInterval(function(){
     $('.editFormCupon').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al editar el cupÃƒÆ’Ã‚Â³n.<br />');
     }, 3000);
     },
     });
     return false;
     });
     */







    /* Alta restaurantes - Comprobar campos vacÃƒÆ’Ã‚Â­o */
    $('input#btnAddRestaurante').on('click', function (event) {

        var nombre_restaurante = $('#nombre_restaurante').val();
        var web_restaurante = $('#web_restaurante').val();
        var direccion_restaurante = $('#direccion_restaurante').val();
        var numero_restaurante = $('#numero_restaurante').val();
        var cp_restaurante = $('#cp_restaurante').val();
        var precio_medio_restaurante = $('#precio_medio_restaurante').val();
        if (nombre_restaurante == "") {
            var mensaje = '<span id="error_restaurante" class="form-description required-error">Escribe el nombre de tu restaurante.</span>';
            $("#nombre_restaurante").after(mensaje);
            $("#nombre_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $("#error_restaurante").hide();
        }

        if (web_restaurante == "") {
            var mensaje = '<span id="error_web" class="form-description required-error">Escribe la pÃƒÆ’Ã‚Â¡gina web de tu restaurante.</span>';
            $("#web_restaurante").after(mensaje);
            $("#web_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_web').hide();
        }

        if (direccion_restaurante == "") {
            var mensaje = '<span id="error_direccion" class="form-description required-error">Escribe la direcciÃƒÆ’Ã‚Â³n de tu restaurante.</span>';
            $("#direccion_restaurante").after(mensaje);
            $("#direccion_restaurante").attr({placeholder: ''
            });
            return false;
        } else {
            $('#error_direccion').hide();
        }

        if (numero_restaurante == "") {
            var mensaje = '<span id="error_numero" class="form-description required-error">Escribe nÃƒÆ’Ã‚Âºmero de tu restaurante.</span>';
            $("#numero_restaurante").after(mensaje);
            $("#numero_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_numero').hide();
        }

        if (cp_restaurante == "") {
            var mensaje = '<span id="error_cp" class="form-description required-error">Escribe la direcciÃƒÆ’Ã‚Â³n de tu restaurante.</span>';
            $("#cp_restaurante").after(mensaje);
            $("#cp_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_cp').hide();
        }

        if (precio_medio_restaurante == "") {
            var mensaje = '<span id="error_precio_medio" class="form-description required-error">Escribe la direcciÃƒÆ’Ã‚Â³n de tu restaurante.</span>';
            $("#precio_medio_restaurante").after(mensaje);
            $("#precio_medio_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_precio_medio').hide();
        }

    });
    /* Obtener el cÃƒÆ’Ã‚Â³digo postal de un restaurante - Solo cuando se dÃƒÆ’Ã‚Â¡ de alta el restaurante. */
    $('input#cp_restaurante').on('keyup', function (evento) {
        evento.preventDefault();
        var info = $(this).val();
        var url = "/obtener-cp";
        $.post(url, {
            info: info
        }, function (data) {
            if (data != "") {
                //console.log(data);
                $('#localidad_restaurante').attr({
                    placeholder: data
                });
            } else {
                $('#localidad_restaurante').attr({
                    placeholder: 'No existe localidad'
                });
            }
        });
        return false;
    });
    $('input#cp_restaurante').on('keyup', function (evento) {
        evento.preventDefault();
        var info = $(this).val();
        var url = "/obtener-provincia";
        $.post(url, {
            info: info
        }, function (data) {
            if (data != "") {
                //console.log(data);
                $('#provincia_restaurante').attr({
                    placeholder: data
                });
            } else {
                $('#provincia_restaurante').attr({
                    placeholder: 'No existe provincia'
                });
            }
        });
        return false;
    });
    /* Obtener municipio/localidad y provincia en base al CP - Solo cuando se dÃƒÆ’Ã‚Â¡ de alta el restaurante. */
    $('input#cp_facturacion').on('keyup', function () {
        var info = $(this).val();
        var url = "/obtener-cp";
        $.post(url, {
            info: info
        }, function (data) {
            if (data != "") {
                console.log(data);
                $('#localidad_facturacion').attr({
                    placeholder: data
                });
            } else {
                $('#localidad_facturacion').attr({
                    placeholder: 'No existe localidad'
                });
            }
        });
        return false;
    });
    $('input#cp_facturacion').on('keyup', function () {
        var info = $(this).val();
        var url = "/obtener-provincia";
        $.post(url, {
            info: info
        }, function (data) {
            if (data != "") {
                console.log(data);
                $('#provincia_facturacion').attr({
                    placeholder: data
                });
            } else {
                $('#provincia_facturacion').attr({
                    placeholder: 'No existe provincia'
                });
            }
        });
        return false;
    });
    /* Obtener Localidad y Provincia del cÃƒÆ’Ã‚Â³digo postal introducido. */
    /* 
     En este caso, hay que hacer una comprobaciÃƒÆ’Ã‚Â³n de si el CP escrito en el input, coincide con el asignado por el administrador. 
     */
    $('input#cp_propietario').on('keyup', function () {

        var info = $(this).val();
        var url = "/obtener-cp";
        $.post(url, {
            info: info
        }, function (data) {
            if (data != "") {
                $('#localidad_propietario').attr({
                    placeholder: data
                });
            } else {
                $('#localidad_propietario').attr({
                    placeholder: 'No existe localidad'
                });
            }
        });
        return false;
    });
    $('input#cp_propietario').on('keyup', function () {
        var info = $(this).val();
        var url = "/obtener-provincia";
        $.post(url, {
            info: info
        }, function (data) {
            if (data != "") {
                $('#provincia_propietario').attr({
                    placeholder: data
                });
            } else {
                $('#provincia_propietario').attr({
                    placeholder: 'No existe provincia'
                });
            }
        });
        return false;
    });
    /* Alta restaurantes - AÃƒÆ’Ã‚Â±adir especiliadades */
    var MaxInputs = 50;
    var x = $("#contenedorEspecialidades").length + 1;
    var FieldCount = x - 1;
    $('a#btnAddEspecialidadAltaRestaurante').on('click', function (event) {
        if (x <= MaxInputs)
        {
            FieldCount++;
            $('#contenedorEspecialidades').append('<div class="form-input" id="anadiElementoEspecialidad"><i class="fa fa-map-marker"></i><input name="especialidades_restaurante[]" id="especialidades_restaurante" type="text" placeholder="Introduce una especialidad, Ej. Carne a la brasa"></div>');
            x++;
        }
        return false;
    });
    /* Alta restaurantes - AÃƒÆ’Ã‚Â±adir mÃƒÆ’Ã‚Â¡s puntos de interÃƒÆ’Ã‚Â©s */
    var MaxInputs = 50;
    var x = $("#contenedorPuntosInteres").length + 1;
    var FieldCount = x - 1;
    $('a#btnAddPuntoInteresAltaRestaurante').on('click', function (event) {
        if (x <= MaxInputs)
        {
            FieldCount++;
            $('#contenedorPuntosInteres').append('<div class="form-input" id="contenedorPuntosInteres"><i class="fa fa-map-marker"></i><input name="puntos_interes[]" id="puntos_interes" type="text" value="" placeholder="Introduce un punto de interÃƒÆ’Ã‚Â©s, Ej. Puerta de AlcalÃƒÆ’Ã‚Â¡"></div>');
            x++;
        }
        return false;
    });
    /* Alta restaurantes - AÃƒÆ’Ã‚Â±adir mÃƒÆ’Ã‚Â¡s estaciones de metro */
    var MaxInputs = 50;
    var x = $("#contenedorEstaciones").length + 1;
    var FieldCount = x - 1;
    $('a#btnAddEstacionesAltaRestaurante').on('click', function (event) {
        if (x <= MaxInputs)
        {
            FieldCount++;
            $('#contenedorEstaciones').append('<i class="fa fa-map-marker"></i><select name="estaciones_metro[]" id="estaciones_metro"><option selected>Seleccionar</option><?php foreach ($listadoEstaciones as $key => $value) { ?><option> <?=$value->nombre_estacion ?> </option><?php } ?>');
            x++;
        }
        return false;
    });
    /* Alta restaurantes - Registrar segundos datos de los restaurantes */
    $('#btnGuardarDatosRestaurante2').on('click', function (e) {

        /* Primer validamos los datos antes de enviarlos */
        var razon_social = $('#razon_social_facturacion').val();
        var calle_facturacion = $('#calle_facturacion').val();
        var numero_facturacion = $('#numero_facturacion').val();
        var cp_facturacion = $('#cp_facturacion').val();
        var email_facturacion = $('#email_facturacion').val();
        var cuenta_bancaria_facturacion = $('#cuenta_bancaria_facturacion').val();
        var opc1_categoria_restaurante = $('#opc1_categoria_restaurante').val();
        var opc2_categoria_restaurante = $('#opc2_categoria_restaurante').val();
        var opc3_categoria_restaurante = $('#opc3_categoria_restaurante').val();
        var especialidades_restaurantes = $('#especialidades_restaurantes').val();
        var punto_interes = $('#punto_interes').val();
        var estaciones_metro = $('#estaciones_metro').val();
        if (razon_social == "") {
            var mensaje = '<span id="error_razon_social" class="form-description required-error">Campo obligatorio.</span>';
            $("#razon_social_facturacion").after(mensaje);
            $("#razon_social_facturacion").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_razon_social').hide();
        }


        if (calle_facturacion == "") {
            var mensaje = '<span id="error_calle_facturacion" class="form-description required-error">Campo obligatorio.</span>';
            $("#calle_facturacion").after(mensaje);
            $("#calle_facturacion").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_calle_facturacion').hide();
        }


        if (numero_facturacion == "") {
            var mensaje = '<span id="error_numero_facturacion" class="form-description required-error">Campo obligatorio.</span>';
            $("#numero_facturacion").after(mensaje);
            $("#numero_facturacion").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_numero_facturacion').hide();
        }


        if (cp_facturacion == "") {
            var mensaje = '<span id="error_cp_facturacion" class="form-description required-error">Campo obligatorio.</span>';
            $("#cp_facturacion").after(mensaje);
            $("#cp_facturacion").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_cp_facturacion').hide();
        }


        if (email_facturacion == "") {
            var mensaje = '<span id="error_email_facturacion" class="form-description required-error">Campo obligatorio.</span>';
            $("#email_facturacion").after(mensaje);
            $("#email_facturacion").attr({
                placeholder: ''});
            return false;
        } else {
            $('#error_email_facturacion').hide();
        }


        if (cuenta_bancaria_facturacion == "") {
            var mensaje = '<span id="error_cuenta_bancaria" class="form-description required-error">Campo obligatorio.</span>';
            $("#cuenta_bancaria_facturacion").after(mensaje);
            $("#cuenta_bancaria_facturacion").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_cuenta_bancaria').hide();
        }

        if (opc1_categoria_restaurante == "") {
            var mensaje = '<span id="error_opc1" class="form-description required-error">Campo obligatorio.</span>';
            $("#opc1_categoria_restaurante").after(mensaje);
            $("#opc1_categoria_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_opc1').hide();
        }


        if (opc2_categoria_restaurante == "") {
            var mensaje = '<span id="error_opc2" class="form-description required-error">Campo obligatorio.</span>';
            $("#opc2_categoria_restaurante").after(mensaje);
            $("#opc2_categoria_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_opc2').hide();
        }


        if (opc3_categoria_restaurante == "") {
            var mensaje = '<span id="error_opc3" class="form-description required-error">Campo obligatorio.</span>';
            $("#opc3_categoria_restaurante").after(mensaje);
            $("#opc3_categoria_restaurante").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_opc3').hide();
        }


        if (especialidades_restaurantes == "") {
            var mensaje = '<span id="error_especialidades" class="form-description required-error">Campo obligatorio.</span>';
            $("#especialidades_restaurantes").after(mensaje);
            $("#especialidades_restaurantes").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_especialidades').hide();
        }


        if (punto_interes == "") {
            var mensaje = '<span id="error_punto_interes" class="form-description required-error">Campo obligatorio.</span>';
            $("#punto_interes").after(mensaje);
            $("#punto_interes").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_punto_interes').hide();
        }


        if (estaciones_metro == "") {
            var mensaje = '<span id="error_estaciones_metro" class="form-description required-error">Campo obligatorio.</span>';
            $("#estaciones_metro").after(mensaje);
            $("#estaciones_metro").attr({
                placeholder: ''
            });
            return false;
        } else {
            $('#error_estaciones_metro').hide();
        }

    }); /* Bajas restaurantes - AÃƒÆ’Ã‚Â±adir especiliadades */
    $('a#btnDeleteRestaurant').on('click', function (event) {

        var id = $(this).parent().parent().attr("id");
        $('#showMessageDeleteRestaurant_' + id).show();
        $('a#btnDeleteRestaurant').hide();
        return false;
    });
    $('a#btnDeleteRest2').on('click', function (event) {

        $('.oculto').hide();
        $('a#btnDeleteRestaurant').show();
        return false;
    });
    /* Registros y Bajas de las estaciones asociadas al Restaurante */
    $('a#btnAddEstacion').on('click', function (event) {
        event.preventDefault();
        var nombre = $('#nombre_estacion').val();
        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/registro-metro";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id,
                nombre_estacion: nombre,
            }, beforeSend: function (event) {
                $('.addFormEstacion').show();
                $('.addFormEstacion').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {

                    $('.addFormEstacion').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;EstaciÃ³n aÃ±adida correctamente.<br />');
                    location.reload();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('.addFormEstacion').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar los datos.<br />');
                }, 3000);
            },
        });
        return false;
    });
    $('input#btnSendEmailContacto').on('click', function (e) {

        var nombre = $('#nombre_contacto').val();
        var email = $('#email_contacto').val();
        var telefono = $('#telefono_contacto').val();
        var mensaje = $('#mensaje_contacto').val();
        var url = "/email-contacto";
        $.ajax({
            type: "POST",
            url: url,
            data: {nombre_contacto: nombre,
                email_contacto: email,
                telefono_contacto: telefono,
                mensaje_contacto: mensaje, },
            beforeSend: function (event) {
                $('#mensaje').show();
                $('#mensaje').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('#mensaje').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Mensaje enviado correctamente.<br />').delay(3000).fadeOut();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('#mensaje').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se ha podido enviar el mensaje.<br />').delay(3000).fadeOut();
                }, 3000);
            },
        });
        return false;
    });
    /* Mensaje soporte tÃƒÆ’Ã‚Â©cnico desde Panel Restaurado */
    $('input#btnSubmitMessageSupport').on('click', function (event) {

        event.preventDefault();
        var mensaje = $('#mensaje_soporte').val();
        var url = "/acceso/restaurador/mensaje-soporte-tecnico";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                mensaje_soporte: mensaje,
            },
            beforeSend: function (event) {
                $('#sendMessageSupport').show();
                $('#sendMessageSupport').html("<span align='center'><img src='./../../assets/images/loader.gif '/></span>");
            },
            success: function (event) {
                setInterval(function () {
                    $('#sendMessageSupport').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Mensaje enviado con ÃƒÆ’Ã‚Â©xito.<br />').delay(3000).fadeOut();
                }, 3000);
            },
            error: function (event) {
                setInterval(function () {
                    $('#sendMessageSupport').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al enviar el mensaje.<br />').delay(3000).fadeOut();
                }, 3000);
            },
        });
        return false;
    });
});
    