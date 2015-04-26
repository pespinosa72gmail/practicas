var parpadeo;
function seleccionaRestaurante(id_restaurante) {
    //alert(id_restaurante);
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
                out = out + '<p style="text-align: center;">Actualmente no tienes ningún menú añadido.</p>';
                out = out + '</div>';
                out = out + '</div>';
            }
            $('#listado-tipos-menu').html(out);
        },
        error: function (event) {
            setInterval(function () {
                $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al cargar los menús.<br />');
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
                            out = out + '<h3>Selección de menús habituales</h3>';
                            out = out + '<p>Si lo prefieres, puedes seleccionar uno de tus menús guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>';
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
                                out = out + '<p>Actualmente no tienes ningún menú dado de alta.</p>';
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
                                    out = out + '<input value="' + data[i].primeros[k].nombre_primeros_menu + '" name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">';
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
                                out = out + '<input name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">';
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
                            out = out + '<a href="#" name="addInputPrimeros-' + data[i].id_menu + '" id="addInputPrimeros-' + data[i].id_menu + '">Añadir más primeros<span><i class="fa fa-arrow-circle-right"></i></span></a>';
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
                                    out = out + '<input value="' + data[i].segundos[l].nombre_segundo_menu + '" name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
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
                                out = out + '<input name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
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
                            out = out + '<br />';
                            out = out + '<div class="row">';
                            out = out + '<p class="reducirfila">Â¿Este menú lo vas a reutilizar a menudo? Ponle un nombre y dale a "Guardar como menú habitual"</p>';
                            out = out + '<div class="col-md-8 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-cutlery"></i>';
                            out = out + '<input name="nombre_menu_habitual" id="nombre_menu_habitual_' + data[i].id_menu + '" type="text" placeholder="Ej. Menú de los lunes, Menú arroces, etc...">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-4 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<div class="callout-a ">';
                            out = out + '<a href="#" id="btnAddMenuHabitual-' + data[i].id_menu + '" class="button-3">Guardar como menú habitual</a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row centrar reducirfila">';
                            out = out + '<input class="button-3 botonpeq" name="btnAddPlateMenu2-' + data[i].id_menu + '" id="btnAddPlateMenu2-' + data[i].id_menu + '" type="button" value="Actualizar menú">';
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
                            out = out + '<h3>Selección de menús habituales</h3>';
                            out = out + '<p>Si lo prefieres, puedes seleccionar uno de tus menús guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>';
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
                                    //alert(data[i].menus_habituales[j].id_menu_habitual);
                                    //out = out + '<input type="hidden" name="id_menu_habitual" id="id_menu_habitual" class="id_menu_habitual" value="' + data[i].menus_habituales[j].id_menu_habitual + '" />';
                                    out = out + '</label>';
                                    out = out + '</div>';
                                }
                            } else {
                                out = out + '<div class="col-md-6">';
                                out = out + '<p>Actualmente no tienes ningún menú dado de alta.</p>';
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
                                    out = out + '<input value="' + data[i].entrantes[k].nombre_entrante_menu + '" name="entrantes_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="Añadir plato">';
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
                                out = out + '<input name="entrantes_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="Añadir plato">';
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
                            out = out + '<a href="#" name="addInputEntrantes-' + data[i].id_menu + '" id="addInputEntrantes-' + data[i].id_menu + '">Añadir más entrantes<span><i class="fa fa-arrow-circle-right"></i></span></a>';
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
                                    out = out + '<input value="' + data[i].primeros[l].nombre_primeros_menu + '" name="primeros_menu_estructura_' + data[i].id_menu + '[]" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">';
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
                                out = out + '<input name="primeros_menu_estructura_' + data[i].id_menu + '[]" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">';
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
                            out = out + '<p class="reducirfila">Â¿Este menú lo vas a reutilizar a menudo? Ponle un nombre y dale a "Guardar como menú habitual"</p>';
                            out = out + '<div class="col-md-8 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-cutlery"></i>';
                            out = out + '<input name="nombre_menu_habitual" id="nombre_menu_habitual_' + data[i].id_menu + '" type="text" placeholder="Ej. Menú de los lunes, Menú arroces, etc...">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-4 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<div class="callout-a ">';
                            out = out + '<a href="#" id="btnAddMenuHabitual-' + data[i].id_menu + '" class="button-3">Guardar como menú habitual</a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row centrar reducirfila">';
                            out = out + '<input class="button-3 botonpeq" name="btnAddPlateMenu2-' + data[i].id_menu + '" id="btnAddPlateMenu2-' + data[i].id_menu + '" type="button" value="Actualizar menú">';
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
                            out = out + '<h3>Selección de menús habituales</h3>';
                            out = out + '<p>Si lo prefieres, puedes seleccionar uno de tus menús guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>';
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
                                out = out + '<p>Actualmente no tienes ningún menú dado de alta.</p>';
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
                                    out = out + '<input value="' + data[i].primeros[k].nombre_primeros_menu + '" name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="Añadir plato">';
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
                                out = out + '<input name="primeros_menu_estructura_' + data[i].id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">';
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
                            out = out + '<a href="#" name="addInputPrimeros-' + data[i].id_menu + '" id="addInputPrimeros-' + data[i].id_menu + '">Añadir más entrantes<span><i class="fa fa-arrow-circle-right"></i></span></a>';
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
                                    out = out + '<input value="' + data[i].segundos[l].nombre_segundo_menu + '" name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
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
                                out = out + '<input name="segundos_menu_estructura_' + data[i].id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
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
                            out = out + '<p class="reducirfila">Â¿Este menú lo vas a reutilizar a menudo? Ponle un nombre y dale a "Guardar como menú habitual"</p>';
                            out = out + '<div class="col-md-8 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<i class="fa fa-cutlery"></i>';
                            out = out + '<input name="nombre_menu_habitual" id="nombre_menu_habitual_' + data[i].id_menu + '" type="text" placeholder="Ej. Menú de los lunes, Menú arroces, etc...">';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="col-md-4 nodosfilas">';
                            out = out + '<div class="form-input">';
                            out = out + '<div class="callout-a ">';
                            out = out + '<a href="#" id="btnAddMenuHabitual-' + data[i].id_menu + '" class="button-3">Guardar como menú habitual</a>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '</div>';
                            out = out + '<div class="separadorpeq"></div>';
                            out = out + '<div class="row centrar reducirfila">';
                            out = out + '<input class="button-3 botonpeq" name="btnAddPlateMenu2-' + data[i].id_menu + '" id="btnAddPlateMenu2-' + data[i].id_menu + '" type="button" value="Actualizar menú">';
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
                out = out + '<p style="text-align: center;">Actualmente no tienes ningún menú añadido.</p>';
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
                out = out + '<p>Actualmente no tienes ningún menú dado de alta.</p>';
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
    //alert('voy a borrar' + window.primeros[array[1]])
    //alert(array[0] + '  ' + array[1]);
    //alert('voy a borrar' + window.segundos[array[1]])
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
        $('#contenedorPlatosEntrantes-' + id_menu + '').append('<div class="row contenedor" id="' + window.FieldCount + '"><div class="col-md-10 nodosfilas"><div class="form-input"><i class="fa fa-cutlery"></i> <input name="entrantes_menu_estructura_' + id_menu + '[]" id="entrantes_menu_estructura" class="input-class" type="text" placeholder="Añadir plato"></div></div><div class="col-md-2 nodosfilas"><div class="form-input"><div class="form-input"><div class="callout-a"><a id="entrante-' + id_menu + '" href="#" class="button-3 eliminar">X</a></div></div></div></div></div>');
        window.entrantes[id_menu]++;
    }
    return false;
});

$(document).on("click", "a[name^=addInputPrimeros-]", function (event) {
    var array = this.id.split('-');
    var id_menu = array[1];

    if (window.primeros[id_menu] <= MaxInputs) {
        window.FieldCountPrimeros[id_menu]++;
        $('#contenedorPlatos-' + id_menu + '').append('<div class="row contenedor" id="' + window.FieldCount + '"><div class="col-md-10 nodosfilas"><div class="form-input"><i class="fa fa-cutlery"></i> <input name="primeros_menu_estructura_' + id_menu + '[]" id="primeros_menu_estructura" class="input-class" type="text" placeholder="Añadir plato"></div></div><div class="col-md-2 nodosfilas"><div class="form-input"><div class="form-input"><div class="callout-a"><a id="primero-' + id_menu + '" href="#" class="button-3 eliminar">X</a></div></div></div></div></div>');
        window.primeros[id_menu]++;
    }
    return false;
});
$(document).on("click", "a[name^=addInputSegundos-]", function (event) {
    var array = this.id.split('-');
    var id_menu = array[1];
    if (window.segundos[id_menu] <= window.MaxInputs) {
        window.FieldCountSegundos[id_menu]++;
        $('#contenedorPlatos2-' + id_menu + '').append('<div class="row contenedor" id="' + window.FieldCount + '"><div class="col-md-10 nodosfilas"><div class="form-input"><i class="fa fa-cutlery"></i> <input name="segundos_menu_estructura_' + id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato"></div></div><div class="col-md-2 nodosfilas"><div class="form-input"><div class="form-input"><div class="callout-a"><a id="segundo-' + id_menu + '" href="#" class="button-3 eliminar">X</a></div></div></div></div></div>');
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
    //alert('entro aquÃ­');
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

    //Validación
    if ($('#calendario-menu-' + array[1]).val() == "") {
        $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca la fecha del menú.');
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
            $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />');
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
        $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el nombre del menú habitual.');
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
            $('#mensajeMenu-' + array[1]).html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />');
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
                    out = out + '<input value="' + data.entrantes[i].nombre_entrante_menu + '" name="entrantes_menu_estructura_' + id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="Añadir plato">';
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
                out = out + '<input name="entrantes_menu_estructura_' + id_menu + '[]" class="input-class" id="entrantes_menu_estructura" type="text" placeholder="Añadir plato">';
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
                    out = out + '<input value="' + data.primeros[i].nombre_primeros_menu + '" name="primeros_menu_estructura_' + id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">';
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
                out = out + '<input name="primeros_menu_estructura_' + id_menu + '[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">';
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
                    out = out + '<input value="' + data.segundos[i].nombre_segundo_menu + '" name="segundos_menu_estructura_' + id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
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
                out = out + '<input name="segundos_menu_estructura_' + id_menu + '[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">';
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

	// Botones del menú lateral
    $('a#altaRestaurantePlan').on('click', function (event) {
        var url = "./alta-restaurante-plan";
        $(location).attr("href", url);
    });


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
    /* Desplegamos lo del usuario TLM en la vista /registro-usuario */
	$('#abrir-cerrar-buscador').on('click', function (event) {
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
    //Programamos el boón tipo <a>
    $('#buscarRestaurante').click(function (e) {
        e.preventDefault();
        buscarRestaurantes();
    });
	$("#nombre_restaurante_buscar").on('keydown', function () {
		if(event.keyCode == 13){
			buscarRestaurantes();
			return false;
		};
	});
    function buscarRestaurantes(){
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
                    out = out + "<div><strong>Categoría</strong>: " + data[i].categoria + "</div>";
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
    };
    /* Guardar Tipo de MenÃƒÆ’Ã‚Âº. Para la secciÃƒÆ’Ã‚Â³n Tipos de MenÃƒÆ’Ã‚Âºs */
    $('input#btnAddTipoMenu').on('click', function (event) {

        var id = $('#id_restaurantes').val();
        var url = "/acceso/restaurador/anadir-tipo-menu";
        var nombre = $('#nombre_menu').val();
        var estructura = $('input:checked#estructura_menu').val();
        if (nombre == "") {

            $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el nombre del menú.');
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
//$('#estructura_menu').after('<span id="error_restaurante" class="form-description required-error">Selecciona un campo</span>'); $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccion el tipo de menú.');
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
                $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El menú se ha añadido correctamente.');
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
                    $('.addFormTipoMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error al guardar el menú.<br />');
                }, 3000);
            },
        });
        return false;
    });
    /* AÃƒÆ’Ã‚Â±adimos los platos al menÃƒÆ’Ã‚Âº - OpciÃƒÆ’Ã‚Â³n 1 */
    /* Pendiente */



    /* Caracteres del textarea de observaciones - Dentro de gestiÃƒÆ’Ã‚Â³n de MenÃƒÆ’Ã‚Âºs */
    var max_character = 255;
    $('#contador').html(max_character + ' Máximos caracteres permitidos');
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
                $('#mensaje_pass').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos un número y entre 6 y 8 caracteres.</div>');
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
            //Validación del password del gestor
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
//Validación del password del gestor
            var re = /^([A-Z].{5,7})|(.{1}[A-Z].{4,6})|(.{2}[A-Z].{3,5})|(.{3}[A-Z].{2,4})|(.{4}[A-Z].{1,3})|(.{5}[A-Z].{0,2})|(.{6}[A-Z].{0,1})|(.{7}[A-Z])$/
            if (!re.test($('.password_gestor').val())) {
                $('#mensaje_pass').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password debe tener al menos una letra mayúscula y entre 6 y 8 caracteres.');
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
            $('#mensaje_pass').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;El password está vacÃ­o.');
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
            $('#mensaje_tel').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce el teléfono del propietario</div>');
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
                $('#mensaje_tel').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Teléfono modificado correctamente</div>');
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
            $('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El formato del código postal es incorrecto</div>');
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
                $('#mensaje_cp').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Código Postal modificado correctamente</div>');
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
//Para que se ejecute al cargar la página
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

        //Localización de la dirección
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
                    //alert('Componente1 vacÃ­o');
                }
                //Código Postal
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
    //Número de la calle del restaurante
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
                $('#mensaje_numero').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Número modificado correctamente</div>');
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

        //Localización de la dirección
        var geocoder = new google.maps.Geocoder();
        var address = $("#calle_restaurante").val() + ', ' + $("#numero_restaurante").val() + ', ' + $("#cp_restaurante").val();

        //buscamos en la region de españa
        geocoder.geocode({'address': address, 'region': 'es'}, function (results, status) {
            if (status == 'OK') {
                //alert('Dirección reconocida');
                //Calle
                if (results[0].address_components[1]) {
                    //alert(results[0].address_components[1].long_name);
                    $('#calle_restaurante').val(results[0].address_components[1].long_name);
                } else {
                    //alert('Componente1 vacÃ­o');
                }
                //Código Postal
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
                 //Código postal
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

    //Número de la calle del restaurante
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
            $('#mensaje_cp_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca el código postal del restaurante</div>');
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
                $('#mensaje_cp_restaurante').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Código Postal modificado correctamente</div>');
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

        //Localización de la dirección
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
                    //alert('Componente1 vacÃ­o');
                }
                //Código Postal
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
            $('#mensaje_precio').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un rango</div>');
            $('#mensaje_precio').css({display: "block"});
            $('#precio_medio_restaurante').focus();
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
                campo: 'precio_medio_restaurante',
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
        var nombre_fichero = document.getElementById("archivo_carta").files[0];
        var extensiones = new Array('pdf', 'jpg', 'doc', 'docs');
        var documento = $('#archivo_carta')[0].files[0];
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
        formData.append('archivo_carta', nombre_fichero);
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
                    $('.addFormPlateMenu').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />');
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
                    $('.editFormProperties').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />');
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
                    $('.editFormRestaurant').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />');
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
     $('#mensajePDF').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Carta subida con éxito.<br />').delay(3000).fadeOut();
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
                    $('.editFormCategory').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.<br />');
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
	var duplicados_especialidad = '';
	function listarEspecialidades(){
		
        var id_restaurante = $('#id_restaurantes').val();
		
        var url = "/restaurador/obtenerEspecialidadesJSON";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurante: id_restaurante
            },
            beforeSend: function (event) {
                $('#listado_especialidades').html('<div align="center" class="efecto-fade"><img src="./../../assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                if(data != '[]'){
					var data = JSON.parse(data);
					var out = '';
					for (var i in data) {
						out = out + '<div class="col-md-9 nodosfilas">';
						out = out + '	<div class="form-input">';
						out = out + '		<i class="fa fa-cutlery"></i>';
						out = out + '		<input type="text" value="' + data[i].nombre_especialidad + '" disabled>';
						out = out + '	</div>';
						out = out + '</div>';
						out = out + '<div class="col-md-3 nodosfilas">';
						out = out + '	<div class="form-input">';
						out = out + '		<div class="callout-a ">';
						out = out + '			<a id="borrar_especialidad-' + data[i].id_especialidad + '" href="#" class="button-3">Eliminar</a>';
						out = out + '		</div>';
						out = out + '	</div>';
						out = out + '</div>';
						
						duplicados_especialidad = duplicados_especialidad + 'nodup' + data[i].nombre_especialidad + 'nodup';
					};
				}else{
					var out = '';
					out = out + '<div class="col-md-9 nodosfilas">';
					out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
					out = out + '		<p>Actualmente no has añadido ninguna especialidad a tu restaurante</p>';
					out = out + '	</div>';
					out = out + '</div>';
				};
                $('#listado_especialidades').html(out);
            },
            error: function (event) {
                $('#listado_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
		
	};
	listarEspecialidades();
	
    $('a#btnAddEspecialtiesForm').on('click', function (e) {
		e.preventDefault();
		addEspecialidad();
	});
	$("#nueva_especialidad").on('keydown', function () {
		$('#mensaje_especialidades').css({display:"none"});
		if(event.keyCode == 13){
			addEspecialidad();
		};
	});
	
    function addEspecialidad(){
		
        $('#mensaje_especialidades').css({display: "none"});
		
        var nueva_especialidad = $('#nueva_especialidad').val();
        var id_restaurante = $('#id_restaurantes').val();
		
		if(!nueva_especialidad){
			$('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una nueva especialidad</div>');
			$('#mensaje_especialidades').css({display:"block"});
			$('#nueva_especialidad').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		if(duplicados_especialidad.toLowerCase().indexOf('nodup' + nueva_especialidad.toLowerCase() + 'nodup') > -1){
			$('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Ya tiene esta especialidad</div>');
			$('#mensaje_especialidades').css({display:"block"});
			$('#nueva_especialidad').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
        var url = "/restaurador/anadirEspecialidad";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id_restaurante,
                select_nombre_especialidad: nueva_especialidad,
            },
            beforeSend: function (event) {
                $('#mensaje_especialidades').show();
				var out = '';
				out = out + '<div class="col-md-9 nodosfilas">';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="./../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
				out = out + '</div>';
                $('#mensaje_especialidades').html(out);
            },
            success: function (data) {
				$('#mensaje_especialidades').css({display:"none"});
        		$('#nueva_especialidad').val('');
				listarEspecialidades();
                /*if(data == 1){
					listarEspecialidades();
				}else{
					$('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo añadir la especialidad</div>');
					$('#mensaje_especialidades').css({display:"block"});
					clearInterval(parpadeo);
					parpadeo = setInterval(function () {
						$('.efecto-fade').fadeOut("slow");
						$('.efecto-fade').fadeIn("slow");
					}, tiempo);
				};*/
            },
            error: function (event) {
                $('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
        return false;
    };
	
	$(document).on('click', "a[id*='borrar_especialidad-']", function (event) {

		var array = this.id.split('-');
		
        var url = "/restaurador/borrarEspecialidad";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_especialidad: array[1]
            },
            beforeSend: function (event) {
                $('#mensaje_especialidades').show();
				var out = '';
				out = out + '<div class="col-md-9 nodosfilas">';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="./../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
				out = out + '</div>';
                $('#mensaje_especialidades').html(out);
            },
            success: function (data) {
                if(data == 1){
					$('#mensaje_especialidades').css({display:"none"});
					listarEspecialidades();
				}else{
					$('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo eliminar la especialidad</div>');
					$('#mensaje_especialidades').css({display:"block"});
					clearInterval(parpadeo);
					parpadeo = setInterval(function () {
						$('.efecto-fade').fadeOut("slow");
						$('.efecto-fade').fadeIn("slow");
					}, tiempo);
				};
            },
            error: function (event) {
                $('.mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
        return false;
	});
	
	
	/****************** Puntos de interés ******************/
	
	var duplicados_punto_interes = '';
	function listarPuntosInteres(){
		
        var id_restaurante = $('#id_restaurantes').val();
		
        var url = "/restaurador/listadoPuntosInteresJSON";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurante: id_restaurante
            },
            beforeSend: function (event) {
                $('#listado_punto_interes').html('<div align="center" class="efecto-fade"><img src="./../../assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                if(data != '[]'){
					var data = JSON.parse(data);
					var out = '';
					for (var i in data) {
						out = out + '<div class="col-md-9 nodosfilas">';
						out = out + '	<div class="form-input">';
						out = out + '		<i class="fa fa-cutlery"></i>';
						out = out + '		<input type="text" value="' + data[i].nombre_punto_cercano + '" disabled>';
						out = out + '	</div>';
						out = out + '</div>';
						out = out + '<div class="col-md-3 nodosfilas">';
						out = out + '	<div class="form-input">';
						out = out + '		<div class="callout-a ">';
						out = out + '			<a id="borrar_punto_interes-' + data[i].id_punto_cercano + '" href="#" class="button-3">Eliminar</a>';
						out = out + '		</div>';
						out = out + '	</div>';
						out = out + '</div>';
						
						duplicados_punto_interes = duplicados_punto_interes + 'nodup' + data[i].nombre_punto_cercano + 'nodup';
					};
				}else{
					var out = '';
					out = out + '<div class="col-md-9 nodosfilas">';
					out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
					out = out + '		<p>Actualmente no has añadido ningún punto de interés</p>';
					out = out + '	</div>';
					out = out + '</div>';
				};
                $('#listado_punto_interes').html(out);
            },
            error: function (event) {
                $('#listado_punto_interes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
		
	};
	listarPuntosInteres();
	
    $('a#btnAddPuntoInteres').on('click', function (e) {
		e.preventDefault();
		addPuntoInteres();
	});
	$("#nuevo_punto_interes").on('keydown', function () {
		$('#mensaje_punto_interes').css({display:"none"});
		if(event.keyCode == 13){
			addPuntoInteres();
		};
	});
	
    function addPuntoInteres(){
		
        $('#mensaje_punto_interes').css({display: "none"});
		
        var nuevo_punto_interes = $('#nuevo_punto_interes').val();
        var id_restaurante = $('#id_restaurantes').val();
		
		if(!nuevo_punto_interes){
			$('#mensaje_punto_interes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un nuevo punto de interés</div>');
			$('#mensaje_punto_interes').css({display:"block"});
			$('#nuevo_punto_interes').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		if(duplicados_punto_interes.toLowerCase().indexOf('nodup' + nuevo_punto_interes.toLowerCase() + 'nodup') > -1){
			$('#mensaje_punto_interes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Ya tiene ese punto de interés</div>');
			$('#mensaje_punto_interes').css({display:"block"});
			$('#nuevo_punto_interes').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
        var url = "/restaurador/anadirPuntoInteres";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id_restaurante,
                select_nombre_punto_cercano: nuevo_punto_interes,
            },
            beforeSend: function (event) {
                $('#mensaje_punto_interes').show();
				var out = '';
				out = out + '<div class="col-md-9 nodosfilas">';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="./../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
				out = out + '</div>';
                $('#mensaje_punto_interes').html(out);
            },
            success: function (data) {
				$('#mensaje_punto_interes').css({display:"none"});
        		$('#nuevo_punto_interes').val('');
				listarPuntosInteres();
                /*if(data == 1){
					listarEspecialidades();
				}else{
					$('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo añadir la especialidad</div>');
					$('#mensaje_especialidades').css({display:"block"});
					clearInterval(parpadeo);
					parpadeo = setInterval(function () {
						$('.efecto-fade').fadeOut("slow");
						$('.efecto-fade').fadeIn("slow");
					}, tiempo);
				};*/
            },
            error: function (event) {
                $('#mensaje_punto_interes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
        return false;
    };
	
	$(document).on('click', "a[id*='borrar_punto_interes-']", function (event) {

		var array = this.id.split('-');
		
        var url = "/restaurador/borrarPuntoInteres";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_punto_interes: array[1]
            },
            beforeSend: function (event) {
                $('#mensaje_punto_interes').show();
				var out = '';
				out = out + '<div class="col-md-9 nodosfilas">';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="./../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
				out = out + '</div>';
                $('#mensaje_punto_interes').html(out);
            },
            success: function (data) {
                if(data == 1){
					$('#mensaje_punto_interes').css({display:"none"});
					listarPuntosInteres();
				}else{
					$('#mensaje_punto_interes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo eliminar el punto de interés</div>');
					$('#mensaje_punto_interes').css({display:"block"});
					clearInterval(parpadeo);
					parpadeo = setInterval(function () {
						$('.efecto-fade').fadeOut("slow");
						$('.efecto-fade').fadeIn("slow");
					}, tiempo);
				};
            },
            error: function (event) {
                $('#mensaje_punto_interes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
        return false;
	});
	
	
	/****************** Estaciones de Metro ******************/
	
	var duplicados_estaciones_metro = '';
	function listarEstacionesMetro(){
		
        var id_restaurante = $('#id_restaurantes').val();
		
        var url = "/restaurador/listadoEstacionesMetroJSON";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurante: id_restaurante
            },
            beforeSend: function (event) {
                $('#listado_estaciones_metro').html('<div align="center" class="efecto-fade"><img src="./../../assets/images/loader.gif" /></div>');
            },
            success: function (data) {
                if(data != '[]'){
					var data = JSON.parse(data);
					var out = '';
					for (var i in data) {
						out = out + '<div class="col-md-9 nodosfilas">';
						out = out + '	<div class="form-input">';
						out = out + '		<i class="fa fa-cutlery"></i>';
						out = out + '		<input type="text" value="' + data[i].nombre_estacion + '" disabled>';
						out = out + '	</div>';
						out = out + '</div>';
						out = out + '<div class="col-md-3 nodosfilas">';
						out = out + '	<div class="form-input">';
						out = out + '		<div class="callout-a ">';
						out = out + '			<a id="borrar_estacion_metro-' + data[i].id_rel_estacion_restaurante + '" href="#" class="button-3">Eliminar</a>';
						out = out + '		</div>';
						out = out + '	</div>';
						out = out + '</div>';
						
						duplicados_estaciones_metro = duplicados_estaciones_metro + 'nodup' + data[i].nombre_estacion + 'nodup';
					};
				}else{
					var out = '';
					out = out + '<div class="col-md-9 nodosfilas">';
					out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
					out = out + '		<p>Actualmente no has añadido ninguna estación de metro</p>';
					out = out + '	</div>';
					out = out + '</div>';
				};
                $('#listado_estaciones_metro').html(out);
            },
            error: function (event) {
                $('#listado_estaciones_metro').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
		
	};
	listarEstacionesMetro();
	
    $('a#addEstacionMetro').on('click', function (e) {
		e.preventDefault();
		addEstacionMetro();
	});
	
	$("#nueva_estacion_metro").on('change', function () {
		$('#mensaje_estaciones_metro').css({display:"none"});
	});
	
    function addEstacionMetro(){
		
        $('#mensaje_estaciones_metro').css({display: "none"});
		
        var id_estacion_metro = $('#nueva_estacion_metro').val();
        var nombre_estacion_metro = $('#nueva_estacion_metro option:selected').html();
        var id_restaurante = $('#id_restaurantes').val();
		
		if(id_estacion_metro < 0){
			$('#mensaje_estaciones_metro').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una nueva estación de metro</div>');
			$('#mensaje_estaciones_metro').css({display:"block"});
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		if(duplicados_estaciones_metro.toLowerCase().indexOf('nodup' + nombre_estacion_metro.toLowerCase() + 'nodup') > -1){
			$('#mensaje_estaciones_metro').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Ya tiene esa estación de metro</div>');
			$('#mensaje_estaciones_metro').css({display:"block"});
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
        var url = "/restaurador/addEstacionMetro";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurante: id_restaurante,
                nombre_estacion_metro: nombre_estacion_metro,
                id_estacion_metro: id_estacion_metro
            },
            beforeSend: function (event) {
                $('#mensaje_estaciones_metro').show();
				var out = '';
				out = out + '<div class="col-md-9 nodosfilas">';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="./../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
				out = out + '</div>';
                $('#mensaje_estaciones_metro').html(out);
            },
            success: function (data) {
                if(data == 1){
					$("#nueva_estacion_metro option[value=-2]").attr("selected",true);
					$('#mensaje_estaciones_metro').css({display:"none"});
					listarEstacionesMetro();
				}else{
					$('#mensaje_especialidades').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo añadir la estación de metro</div>');
					$('#mensaje_especialidades').css({display:"block"});
					clearInterval(parpadeo);
					parpadeo = setInterval(function () {
						$('.efecto-fade').fadeOut("slow");
						$('.efecto-fade').fadeIn("slow");
					}, tiempo);
				};
            },
            error: function (event) {
                $('#mensaje_estaciones_metro').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
        return false;
    };
	
	$(document).on('click', "a[id*='borrar_estacion_metro-']", function (event) {

		var array = this.id.split('-');
		
        var url = "/restaurador/borrarEstacionMetro";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_estacion_metro: array[1]
            },
            beforeSend: function (event) {
                $('#mensaje_estaciones_metro').show();
				var out = '';
				out = out + '<div class="col-md-9 nodosfilas">';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="./../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
				out = out + '</div>';
                $('#mensaje_estaciones_metro').html(out);
            },
            success: function (data) {
                if(data == 1){
					$('#mensaje_estaciones_metro').css({display:"none"});
					listarEstacionesMetro();
				}else{
					$('#mensaje_estaciones_metro').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo eliminar la estación de metro</div>');
					$('#mensaje_estaciones_metro').css({display:"block"});
					clearInterval(parpadeo);
					parpadeo = setInterval(function () {
						$('.efecto-fade').fadeOut("slow");
						$('.efecto-fade').fadeIn("slow");
					}, tiempo);
				};
            },
            error: function (event) {
                $('#mensaje_estaciones_metro').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
        return false;
	});
	
	
	/* Datos de facturación */
	
	var mensaje_realizado = '';
	var mensaje_no_realizado = '';
	
	$("#provincia_facturacion, #municipio_facturacion, #plan_contratado").on('change', function () {
		borrarMensajesDF();
	});
	
	function borrarMensajesDF(){
		clearInterval(parpadeo);
		
		$('#mensaje_razon_facturacion').css({display:"none"});
		$('#mensaje_cif_facturacion').css({display:"none"});
		$('#mensaje_calle_facturacion').css({display:"none"});
		$('#mensaje_numero_facturacion').css({display:"none"});
		$('#mensaje_cp_facturacion').css({display:"none"});
		$('#mensaje_provincia_facturacion').css({display:"none"});
		$('#mensaje_municipio_facturacion').css({display:"none"});
		$('#mensaje_email_facturacion').css({display:"none"});
		$('#mensaje_plan_facturacion').css({display:"none"});
		$('#mensaje_cuenta_facturacion').css({display:"none"});
	};
	
	function modificarDatosFacturacion(campo, contenido, zona_mensaje){
		var url = "/restaurador/modificarDatosFacturacion";
		$.ajax({
			type: "POST",
			url: url,
			async: false,
			data: {
				id_restaurante: $('#id_restaurantes').val(),
				campo: campo,
				contenido: contenido
			},
			beforeSend: function (event) {
				$('#' + zona_mensaje).css({display:"block"});
				$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><img src="../../../assets/images/loader.gif" /></div>');
			},
			success: function (data) {
				if(data == 1){
					$('#' + zona_mensaje).css({display:"block"});
					$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;' + mensaje_realizado + '</div>');
					parpadeo = setInterval(function () {
						$('.efecto-fade').fadeOut("slow");
						$('.efecto-fade').fadeIn("slow");
					}, tiempo);
				}else{
					$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;' + mensaje_no_realizado + '</div>');
				};
			},
			error: function (event) {
				$('#' + zona_mensaje).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
			}
		});
	};
	
	$("#razon_social_facturacion").on('keydown', function () {
		borrarMensajesDF();
		if(event.keyCode == 13){
			modificarRazonFacturacion();
		};
	});
	$('#btnEditRazonFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarRazonFacturacion();
	});
	function modificarRazonFacturacion(){
		borrarMensajesDF();
		var razon_social_facturacion = $('#razon_social_facturacion').val();
		
		if(!razon_social_facturacion){
			$('#mensaje_razon_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una Razón Social</div>');
			$('#mensaje_razon_facturacion').css({display:"block"});
			$('#razon_social_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'Razón Social modificada correctamente';
		mensaje_no_realizado = 'No se pudo modificar la Razón Social';
		
		modificarDatosFacturacion('razon_social_facturacion', razon_social_facturacion, 'mensaje_razon_facturacion');
	};
	
	$("#cif_facturacion").on('keydown', function () {
		borrarMensajesDF();
		if(event.keyCode == 13){
			modificarCifFacturacion();
		};
	});
	$('#btnEditCifFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarCifFacturacion();
	});
	function modificarCifFacturacion(){
		borrarMensajesDF();
		var cif_facturacion = $('#cif_facturacion').val();
		
		if(!cif_facturacion){
			$('#mensaje_cif_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un CIF / NIF</div>');
			$('#mensaje_cif_facturacion').css({display:"block"});
			$('#cif_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'CIF / NIF  modificado correctamente';
		mensaje_no_realizado = 'No se pudo modificar el CIF / NIF';
		
		modificarDatosFacturacion('cif_facturacion', cif_facturacion, 'mensaje_cif_facturacion');
	};
	
	$("#calle_facturacion").on('keydown', function () {
		borrarMensajesDF();
		if(event.keyCode == 13){
			modificarCalleFacturacion();
		};
	});
	$('#btnEditCalleFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarCalleFacturacion();
	});
	function modificarCalleFacturacion(){
		borrarMensajesDF();
		var calle_facturacion = $('#calle_facturacion').val();
		
		if(!calle_facturacion){
			$('#mensaje_calle_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una calle</div>');
			$('#mensaje_calle_facturacion').css({display:"block"});
			$('#calle_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'Calle modificada correctamente';
		mensaje_no_realizado = 'No se pudo modificar la calle';
		
		modificarDatosFacturacion('direccion_facturacion', calle_facturacion, 'mensaje_calle_facturacion');
	};
	
	$("#numero_facturacion").on('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8)) return false;
		borrarMensajesDF();
		if(event.keyCode == 13){
			modificarNumeroFacturacion();
		};
	});
	$('#btnEditNumeroFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarNumeroFacturacion();
	});
	function modificarNumeroFacturacion(){
		borrarMensajesDF();
		var numero_facturacion = $('#numero_facturacion').val();
		
		if(!numero_facturacion){
			$('#mensaje_numero_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un número de dirección</div>');
			$('#mensaje_numero_facturacion').css({display:"block"});
			$('#numero_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
	
		if(isNaN(numero_facturacion)){
			$('#mensaje_numero_facturacion').css({display:"block"});
			$('#mensaje_numero_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El Número de dirección debe ser numérico</div>');
			$('#mensaje_numero_facturacion').css({display:"block"});
			$('#numero_facturacion').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'Número de dirección modificado correctamente';
		mensaje_no_realizado = 'No se pudo modificar el número de dirección';
		
		modificarDatosFacturacion('numero_facturacion', numero_facturacion, 'mensaje_numero_facturacion');
	};
	
	$("#cp_facturacion").on('keydown', function () {
		if(!(event.keyCode > 45 && event.keyCode < 57) && !(event.keyCode > 95 && event.keyCode < 106) && !(event.keyCode == 13) && !(event.keyCode == 8)) return false;
		borrarMensajesDF();
		if(event.keyCode == 13){
			modificarCpFacturacion();
		};
	});
	$('#btnEditCpFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarCpFacturacion();
	});
	function modificarCpFacturacion(){
		borrarMensajesDF();
		var cp_facturacion = $('#cp_facturacion').val();
		
		if(!cp_facturacion){
			$('#mensaje_cp_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un código postal</div>');
			$('#mensaje_cp_facturacion').css({display:"block"});
			$('#cp_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
	
		if(isNaN(cp_facturacion)){
			$('#mensaje_cp_facturacion').css({display:"block"});
			$('#mensaje_cp_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;El código postal debe ser numérico</div>');
			$('#mensaje_cp_facturacion').css({display:"block"});
			$('#cp_facturacion').focus();
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'Código postal modificado correctamente';
		mensaje_no_realizado = 'No se pudo modificar el código postal';
		
		modificarDatosFacturacion('cp_facturacion', cp_facturacion, 'mensaje_cp_facturacion');
	};

	//Para que se ejecute al cargar la página
    $("#provincia_facturacion option:selected").each(function () {
        provincia = $('#provincia_facturacion').val();
        localidad = $('#id_localidad_facturacion').val();
        if (provincia) {
            $.post("/completa-localidades/", {
                provincia: provincia, localidad: localidad
            }, function (data) {
                $("#municipio_facturacion").html(data);
            });
        }
    });
	//Para que se ejecute al cambiar la provincia
    $("#provincia_facturacion").on('change', function () {
        $("#provincia_facturacion option:selected").each(function () {
            provincia = $('#provincia_facturacion').val();
            $.post("/completa-localidades/", {
                provincia: provincia
            }, function (data) {
                //alert(data);
                $("#municipio_facturacion").html(data);
            });
        });
    });
	
	$('#btnEditProvinciaFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarProvinciaFacturacion();
	});
	function modificarProvinciaFacturacion(){
		borrarMensajesDF();
		var provincia_facturacion = $('#provincia_facturacion').val();
		
		if(provincia_facturacion == -1){
			$('#mensaje_provincia_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione una provincia</div>');
			$('#mensaje_provincia_facturacion').css({display:"block"});
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		$('#mensaje_provincia_facturacion').css({display:"block"});
		$('#mensaje_provincia_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Provincia modificada correctamente</div>');
		
		//modificarDatosFacturacion('direccion_facturacion', calle_facturacion, 'mensaje_calle_facturacion');
	};
	
	$('#btnEditMunicipioFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarMunicipioFacturacion();
	});
	function modificarMunicipioFacturacion(){
		borrarMensajesDF();
		var municipio_facturacion = $('#municipio_facturacion').val();
		
		if(municipio_facturacion == 'Municipio'){
			$('#mensaje_municipio_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un municipio</div>');
			$('#mensaje_municipio_facturacion').css({display:"block"});
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'Municipio modificado correctamente';
		mensaje_no_realizado = 'No se pudo modificar el municipio';
		
		modificarDatosFacturacion('localidades_id_localidad', municipio_facturacion, 'mensaje_municipio_facturacion');
	};
	
	$("#email_facturacion").on('keydown', function () {
		borrarMensajesDF();
		if(event.keyCode == 13){
			modificarEmailFacturacion();
		};
	});
	$('#btnEditEmailFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarEmailFacturacion();
	});
	function modificarEmailFacturacion(){
		borrarMensajesDF();
		var email_facturacion = $('#email_facturacion').val();
		
		if(!email_facturacion){
			$('#mensaje_email_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce un correo electrónico de facturación</div>');
			$('#mensaje_email_facturacion').css({display:"block"});
			$('#email_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
	
		var re = /^\b[a-zA-Z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/
		if (!re.test(email_facturacion)) {
			$('#mensaje_email_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Formato de correo electrónico incorrecto</div>');
			$('#mensaje_email_facturacion').css({display:"block"});
			$('#email_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'Correo electrónico de facturación modificado correctamente';
		mensaje_no_realizado = 'No se pudo modificar el correo electrónico de facturación';
		
		modificarDatosFacturacion('email_facturacion', email_facturacion, 'mensaje_email_facturacion');
	};	
	
    // El va asociado al Restaurante
    $('a#btnEditPlanContratadoFacturacion').on('click', function (e) {
		e.preventDefault();

        var id = $('#id_restaurantes').val();
        var plan = $('#plan_contratado').val();
		
		if(plan == -1){
			$('#mensaje_plan_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, seleccione un plan de contrato</div>');
			$('#mensaje_plan_facturacion').css({display:"block"});
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
        var url = "/restaurador/editarPlanContratado";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurantes: id,
                plan_contratado: plan,
            },
            beforeSend: function (event) {
                $('#mensaje_plan_facturacion').show();
				$('#mensaje_plan_facturacion').html('<div align="center" class="efecto-fade"><img src="../../../assets/images/loader.gif" /></div>');
            },
            success: function (event) {
				$('#mensaje_plan_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Plan contratado modificado correctamente</div>');
				$('#mensaje_plan_facturacion').css({display:"block"});
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
            }, error: function (event) {
                setInterval(function () {
				$('#mensaje_plan_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error</div>');
				$('#mensaje_plan_facturacion').css({display:"block"});
                }, 3000);
            },
        });
		
    });
	
	$("#num_cuenta_facturacion").on('keydown', function () {
		borrarMensajesDF();
		if(event.keyCode == 13){
			modificarCuentaFacturacion();
		};
	});
	$('#btnEditCuentaFacturacion').on('click', function(e) {
		e.preventDefault();
		modificarCuentaFacturacion();
	});
	function modificarCuentaFacturacion(){
		borrarMensajesDF();
		var num_cuenta_facturacion = $('#num_cuenta_facturacion').val();
		
		if(!num_cuenta_facturacion){
			$('#mensaje_cuenta_facturacion').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduce una número de cuenta bancaria</div>');
			$('#mensaje_cuenta_facturacion').css({display:"block"});
			$('#num_cuenta_facturacion').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		mensaje_realizado = 'Número de cuenta bancaria modificado correctamente';
		mensaje_no_realizado = 'No se pudo modificar el número de cuenta bancaria';
		
		modificarDatosFacturacion('num_cuenta_facturacion', num_cuenta_facturacion, 'mensaje_cuenta_facturacion');
	};
	
	
    /* Seccion Cupones de descuento */
	
	// Listado de cupones
	
	function listarCupones(){
		
        var id_restaurante = $('#id_restaurantes').val();
		
        var url = "/restaurador/listadoCuponesRestaurateJSON";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_restaurante: id_restaurante
            },
            beforeSend: function (event) {
                $('#lista_cupones').show();
				var out = '';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
                $('#lista_cupones').html(out);
            },
            success: function (data) {				
				var data = JSON.parse(data);
				var out = '';
				if (data.length) {
					for (var i in data) {
						out = out + '<div class="col-md-6" style="margin-bottom: 30px;">';
						out = out + '	<div class="callout">';
						out = out + '		<div class="row">';
						out = out + '			<div class="col-md-3">';
						out = out + '				<label>Título</label>';
						out = out + '			</div>';
						out = out + '			<div class="col-md-9 nodosfilas convertir12">';
						out = out + '				<div class="form-input">';
						out = out + '					<i class="fa fa-pencil"></i>';
						out = out + '					<input name="select_titulo_cupon" id="select_titulo_cupon_' + data[i].id_cupon + '" type="text" value="' + data[i].titulo_cupon + '">';
						out = out + '				</div>';
						out = out + '			</div>';
						out = out + '			<div class="col-md-3">';
						out = out + '				<label>Descripción</label>';
						out = out + '			</div>';
						out = out + '			<div class="col-md-9 nodosfilas convertir12">';
						out = out + '				<div class="form-input">';
						out = out + '					<i class="fa fa-pencil"></i>';
						out = out + '					<textarea name="select_descripcion_cupon" id="select_descripcion_cupon_' + data[i].id_cupon + '">' + data[i].descripcion_cupon + '</textarea>';
						out = out + '				</div>';
						out = out + '			</div>';
						out = out + '			<div class="col-md-3">';
						out = out + '				<label>Inicio promoción</label>';
						out = out + '			</div>';
						out = out + '			<div class="col-md-9 nodosfilas convertir12">';
						out = out + '				<div class="form-input">';
						out = out + '					<i class="fa fa-calendar"></i>';
						out = out + '					<input name="select_fecha_inicio_cupon" id="select_fecha_inicio_cupon_' + data[i].id_cupon + '" type="text" value="' + data[i].fecha_inicio_cupon + '" readonly="readonly">';
						out = out + '				</div>';
						out = out + '			</div>';
						out = out + '			<div class="col-md-3">';
						out = out + '				<label>Fin promoción</label>';
						out = out + '			</div>';
						out = out + '			<div class="col-md-9 nodosfilas convertir12">';
						out = out + '				<div class="form-input">';
						out = out + '					<i class="fa fa-calendar"></i>';
						out = out + '					<input name="select_fecha_fin_cupon" id="select_fecha_fin_cupon_' + data[i].id_cupon + '" type="text" value="' + data[i].fecha_fin_cupon + '" readonly="readonly">';
						out = out + '				</div>';
						out = out + '			</div>';
						out = out + '			<div id="mensaje_cupon_' + data[i].id_cupon + '" class="mensajeconfondo">asdasd</div>';
						out = out + '			<div class="col-md-6 nodosfilas">';
						out = out + '				<input name="borrarCupon-' + data[i].id_cupon + '" class="button-4" type="button" value="Eliminar">';
						out = out + '			</div>';
						out = out + '			<div class="col-md-6 nodosfilas">';
						out = out + '				<input name="modificarCupon-' + data[i].id_cupon + '" class="button-3" type="submit" value="Modificar">';
						out = out + '			</div>';
						out = out + '		</div>';
						out = out + '	</div>';
						out = out + '</div>';
					}
				} else {
					out = out + '<div class="col-md-12 nodosfilas">';
					out = out + '	<div class="form-input">';
					out = out + '		<p style="text-align: center;">Actualmente no tienes ningún cupón o descuento añadido.</p>';
					out = out + '	</div>';
					out = out + '</div>';
				}
				$('#lista_cupones').html(out);
            },
            error: function (event) {
                $('#lista_cupones').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
            },
        });
	};
	listarCupones();
	
    // Añadir cupón
	
	$("#titulo_cupon").on('keydown', function () {
		$('#mensaje_anadir_cupon').css({display:"none"});
		if(event.keyCode == 13){
			anadirCupon();
		};
	});
	$("#descripcion_cupon").on('keydown', function () {
		$('#mensaje_anadir_cupon').css({display:"none"});
	});
	$("#fecha_inicio_cupon").on('change', function () {
		$('#mensaje_anadir_cupon').css({display:"none"});
	});
	$("#fecha_fin_cupon").on('change', function () {
		$('#mensaje_anadir_cupon').css({display:"none"});
	});
    $('#btnAddCupon').on('click', function (e) {
		e.preventDefault();
		anadirCupon();
	});
	function anadirCupon(){

		$('#mensaje_anadir_cupon').css({display:"none"});
		
        var id = $('#id_restaurantes').val();
		
        var titulo = $('#titulo_cupon').val();
        var descripcion = $('#descripcion_cupon').val();
        var fecha_inicio = $('#fecha_inicio_cupon').val();
        var fecha_fin = $('#fecha_fin_cupon').val();
		
		if(!titulo){
			$('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca un título de cupón o descuento</div>');
			$('#mensaje_anadir_cupon').css({display:"block"});
			$('#titulo_cupon').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		if(!descripcion){
			$('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca una descripción de cupón o descuento</div>');
			$('#mensaje_anadir_cupon').css({display:"block"});
			$('#descripcion_cupon').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		if(!fecha_inicio){
			$('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca una fecha de inicio de cupón o descuento</div>');
			$('#mensaje_anadir_cupon').css({display:"block"});
			$('#fecha_inicio_cupon').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		if(!fecha_fin){
			$('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca una fecha de fin de cupón o descuento</div>');
			$('#mensaje_anadir_cupon').css({display:"block"});
			$('#fecha_fin_cupon').focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
        var url = "/restaurador/anadirCuponRestaurante";
		
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
                $('#mensaje_anadir_cupon').show();
                $('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><img src="../../../assets/images/loader.gif" /></div>');
            },
            success: function (event) {
				$('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Cupón o desccuento añadido correctamente</div>');
				$('#mensaje_anadir_cupon').css({display:"block"});
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
				listarCupones();
       			$('#titulo_cupon').val('');
        		$('#descripcion_cupon').val('');
       			$('#fecha_inicio_cupon').val('');
       			$('#fecha_fin_cupon').val('');
            },
            error: function (event) {
                $('#mensaje_anadir_cupon').show();
                $('#mensaje_anadir_cupon').html("<div align='center'>Error</div>");
            },
        });
        return false;
    };
		
	// Borrar Cupon
	$(document).on('click', "input[name*='borrarCupon-']", function (event) {

		var array = this.name.split('-');
		
        var url = "/restaurador/borrarCupon";
		
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id_cupon: array[1]
            },
            beforeSend: function (event) {
				var out = '';
				out = out + '	<div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">';
				out = out + '		<p><img src="../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
                $('#lista_cupones').html(out);
                $('#lista_cupones').show();
            },
            success: function (data) {
				if(data == 1){
					$('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Cupón o desccuento elimindado correctamente</div>');
					listarCupones();
				}else{
					$('#mensaje_anadir_cupon').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo eliminar el cupón o desccuento</div>');
				};
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
				$('#mensaje_anadir_cupon').css({display:"block"});
            },
            error: function (event) {
                $('#mensaje_anadir_cupon').show();
                $('#mensaje_anadir_cupon').html("<div align='center'>Error</div>");
            },
        });
        return false;
    });
	
	
    // Editar cupón
	$(document).on('keydown', "input[name*='select_titulo_cupon']", function (event) {
		$("div[id^='mensaje_cupon_']").css({display:"none"});
	});
	$(document).on('keydown', "input[name*='select_descripcion_cupon']", function (event) {
		$("div[id^='mensaje_cupon_']").css({display:"none"});
	});
	$(document).on('click', "input[name*='modificarCupon-']", function (event) {
		
		var array = this.name.split('-');
		
		$("div[id^='mensaje_cupon_']").css({display:"none"});
		
		var titulo = $('#select_titulo_cupon_' + array[1]).val();
		var descripcion = $('#select_descripcion_cupon_' + array[1]).val();
		var fecha_inicio = $('#select_fecha_inicio_cupon_' + array[1]).val();
		var fecha_fin = $('#select_fecha_fin_cupon_' + array[1]).val();
		
		if(!titulo){
			$('#mensaje_cupon_' + array[1]).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca un título de cupón o descuento</div>');
			$('#mensaje_cupon_' + array[1]).css({display:"block"});
			$('#select_titulo_cupon_' + array[1]).focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		if(!descripcion){
			$('#mensaje_cupon_' + array[1]).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Por favor, introduzca una descripción de cupón o descuento</div>');
			$('#mensaje_cupon_' + array[1]).css({display:"block"});
			$('#select_descripcion_cupon_' + array[1]).focus();
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		};
		
		var url = "/restaurador/modificarCupon";
		
		$.ajax({
			type: "POST",
			url: url,
			data: {
				id_cupon: array[1],
				select_titulo_cupon: titulo,
				select_descripcion_cupon: descripcion,
				select_fecha_inicio_cupon: fecha_inicio,
				select_fecha_fin_cupon: fecha_fin,
			},
			
			beforeSend: function (event){
				var out = '';
				out = out + '	<div class="form-input" style="text-align: center;">';
				out = out + '		<p><img src="../../assets/images/loader.gif" /></p>';
				out = out + '	</div>';
                $('#mensaje_cupon_' + array[1]).html(out);
                $('#mensaje_cupon_' + array[1]).show();
			},
			
			success: function (data){
				if(data == 1){
					$('#mensaje_cupon_' + array[1]).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Cupón o desccuento modificado correctamente</div>');
				}else{
					$('#mensaje_cupon_' + array[1]).html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudo modificar el cupón o desccuento</div>');
				};
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
				$('#mensaje_cupon_' + array[1]).css({display:"block"});
			},
			error: function (event){
                $('#mensaje_cupon_' + array[1]).html("<div align='center'>Error</div>");
                $('#mensaje_cupon_' + array[1]).show();
			},
		});
		return false;
	});
	
	
	/* Gestion de mimágenes */
	listadoImagenes();
	
	$(document).on('keydown', "input[name*='titulo_imagen']", function (event) {
		$('#mensaje_imagenes').css({display:"none"});
	});
																				   
	$(document).on('change', "input[id^='principal_imagen-']", function (event) {
		$('#mensaje_imagenes').css({display:"none"});
	});
	
    $('#cambios_imagenes').live('click', function (event) {
		
		$('#mensaje_imagenes').css({display:"none"});
				
		var ids_imagen = new Array();
		var titulos = new Array();
		var principal = new Array();
		var i = 0;
		
		$("input[id^=titulo_imagen-]").each(function () {
			//alert($(this).val());
    		var array = this.id.split('-');
			ids_imagen[i] = array[1];
			titulos[i] = $(this).val();
			if($('#principal_imagen-' + array[1]).is(':checked')){
				principal[i] = 1;
			}else{
				principal[i] = 0;
			};
			//alert($('#principal_imagen' + array[1]).is(':checked'));
            i++;
		});
		
		var url = "/restaurador/guardarDatosImagenes";
		
		$.ajax({
			type: "POST",
			url: url,
			async: false,
			data: {
				id_imagen: ids_imagen,
				titulo: titulos,
				principal: principal
			},
         	datatype: 'json',
			beforeSend: function (event){
				$('#mensaje_imagenes').html('<div align="center" class="efecto-fade"><img src="' + base_url + 'assets/images/loader.gif" /></div>');
			},
			success: function (data){
				if(data == 1){
					listadoImagenes();
					$('#mensaje_imagenes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Datos guardados correctamente</div>');
				}else{
					$('#mensaje_imagenes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;No se pudieron guardar los datos</div>');
				};
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
				$('#mensaje_imagenes').css({display:"block"});
			},
			error: function (event){
				$('#mensaje_imagenes').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Error</div>');
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
				$('#mensaje_imagenes').css({display:"block"});
			},
		});
		
	});
	
	
	

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

                    $('.addFormEstacion').html('<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Estación añadida correctamente.<br />');
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

	/* ----------- E-MAIL A SOPORTE TÉCNICO ----------- */
	
	$("#texto_mensaje_soporte").on('keydown', function () {
		$('#mensaje_soporte').css({display:"none"});
	});
	$('#btnEmailSoporte').on('click', function() {
		$('#mensaje_soporte').css({display:"none"});
		
		texto_mensaje_soporte = $('#texto_mensaje_soporte').val();
		
		if(!texto_mensaje_soporte){
			$('#mensaje_soporte').css({display:"block"});
			$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Por favor, escriba un mensaje</div>');
			clearInterval(parpadeo);
			parpadeo = setInterval(function () {
				$('.efecto-fade').fadeOut("slow");
				$('.efecto-fade').fadeIn("slow");
			}, tiempo);
			return false;
		}
		
		texto_mensaje_soporte = "<pre>" + texto_mensaje_soporte + "<pre>";
		
		var url = "/restaurador/mensajeSoporteTecnico";
		$.ajax({
			type: "POST",
			url: url,
			async: false,
			data: {
				texto_mensaje_soporte: texto_mensaje_soporte
			},
			beforeSend: function (event) {
				$('#mensaje_soporte').css({display:"block"});
				$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><img src="' + base_url + 'assets/images/loader.gif" /></div>');
			},
			success: function (data) {
				$('#mensaje_soporte').css({display:"block"});
				$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;' + data + '</div>');
				clearInterval(parpadeo);
				parpadeo = setInterval(function () {
					$('.efecto-fade').fadeOut("slow");
					$('.efecto-fade').fadeIn("slow");
				}, tiempo);
			},
			error: function (event) {
				$('#mensaje_soporte').html('<div align="center" class="efecto-fade"><i class="fa fa-info-circle"></i>&nbsp;Error</div>');
			}
		});
	});
});
    
var base_url = '';

var url = "/franquiciado/baseURL";
$.ajax({
	type: "POST",
	url: url,
	async: false,
	data: {
	},
	success: function (data) {
		base_url = data;
	}
});


/* Gestión de imágenes */

function listadoImagenes(){
	
	var id_restaurante = $('#id_restaurantes').val();
	
	var url = "/restaurador/listadoImagenesJSON";
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_restaurante: id_restaurante
		},
		beforeSend: function (event){
			var out = '';
			out = out + '<li class="col-md-12 portfolio-item portfolio-item-2 isotope-item">';
			out = out + '		<p align="center"><img src="' + base_url + 'assets/images/loader.gif" /></p>';
			out = out + '</li>';
			$('#listado_imagenes').html(out);
		},
		success: function (data){
			var out = '';
			out = out + '<div class="row portfolio-all portfolio-0 ajustaralto">';
			out = out + '	<ul>';
			if(data != '[]'){
				var data = JSON.parse(data);
				for (var i in data) {
					out = out + '<li class="col-md-4 portfolio-item portfolio-item-2 isotope-item">';
					out = out + '	<div class="portfolio-one rellenarfondo">';
					out = out + '		<div class="portfolio-head">';
					out = out + '			<div class="portfolio-img">';
					out = out + '				<img alt="" src="' + base_url + 'assets/img_restaurantes/' + data[i].thumbnails_imagen + '.' + data[i].extension_imagen + '">';
					out = out + '			</div>';
					out = out + '			<div class="portfolio-hover">';
					out = out + '				<div class="portfolio-meta">';
					out = out + '					<div class="portfolio-name">';
					out = out + '						<div class="form-input">';
					out = out + '							<i class="fa fa-pencil"></i>';
					out = out + '							<input name="titulo_imagen" id="titulo_imagen-' + data[i].id_imagen + '" type="text" ';
					if(data[i].titulo_imagen){
					out = out + '							 value="' + data[i].titulo_imagen + '" ';
					};
					out = out + '							 Placeholder="Título de foto">';
					out = out + '						</div>';
					out = out + '						<div class="form-input" style="float: right;">';
					out = out + '							<input type="radio" name="principal_imagen" id="principal_imagen-' + data[i].id_imagen + '" ';
					if(data[i].principal_imagen == 1){
					out = out + '							 checked="checked"';
					};
					out = out + '							><label>Principal</label>';
					out = out + '						</div>';
					out = out + '					</div>';
					out = out + '				</div>';
					out = out + '				<a class="portfolio-link" href="javascript:borrarImagen(' + data[i].id_imagen + ');"><i class="fa fa-times"></i></a>';
					out = out + '				<a data-rel="prettyPhoto" class="portfolio-zoom prettyPhoto" href="' + base_url + 'assets/img_restaurantes/' + data[i].nombre_imagen + '"><i class="fa fa-search"></i></a>';
					out = out + '			</div>';
					out = out + '		</div>';
					out = out + '	</div>';
					out = out + '</li>';
				};
			}else{
				out = out + '<li class="col-md-12 portfolio-item portfolio-item-2 isotope-item">';
				out = out + '	<p style="text-align: center;">No hay imágenes</p>';
				out = out + '</li>';
			};
			out = out + '	</ul>';
			out = out + '</div>';
			
			if(data != '[]'){ 
				out = out + '<div id="mensaje_imagenes" class="mensajeconfondo"></div>';
				out = out + '<div class="row centrar reducirfila">';
				out = out + '	<input id="cambios_imagenes" class="button-3 botonpeq" type="button" value="Guardar cambios">';
				out = out + '</div>';
			};
			
			out = out + '<div class="separadorpeq"></div>';
			
			/*out = out + '<div class="row centrar reducirfila">';
			out = out + '	<input class="button-4 botonpeq" type="button" id="addImagen" value="Añadir más fotos">';
			out = out + '</div>';*/
			out = out + '<div class="row centrar reducirfila">';
			out = out + '	<a href="' + base_url + 'acceso/restaurador/alta-imagenes/' + id_restaurante + '" class="button-4 botonpeq" style="text-align:center;">Añadir más fotos</a>';
			out = out + '</div>';
			$('#listado_imagenes').html(out);
			jQuery("a[data-rel^='prettyPhoto']").prettyPhoto();
		},
		error: function (event){
			$('#listado_imagenes').html("<div align='center'>Error</div>");
		},
	});
};

function borrarImagen(id_imagen){
		
	var url = "/restaurador/borrarImagen";
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_imagen: id_imagen
		},
		
		beforeSend: function (event){
			var out = '';
			out = out + '	<div class="form-input" style="text-align: center;">';
			out = out + '		<p><img src="' + base_url + 'assets/images/loader.gif" /></p>';
			out = out + '	</div>';
			$('#listado_imagenes').html(out);
		},
		
		success: function (data){
			if(data == 1){
				asegurarImagenPrincipal();
			};
		},
		error: function (event){
			var out = '';
			out = out + '	<div class="form-input" style="text-align: center;">';
			out = out + '		<p>Error</p>';
			out = out + '	</div>';
			$('#listado_imagenes').html(out);
		},
	});
};

function asegurarImagenPrincipal(){
		
	var url = "/restaurador/asegurarImagenPrincipal";
	
	$.ajax({
		type: "POST",
		url: url,
		async: false,
		data: {
			id_restaurante: $('#id_restaurantes').val()
		},
		beforeSend: function (event){
		},
		success: function (data){
			listadoImagenes();
		},
		error: function (event){
		},
	});
};