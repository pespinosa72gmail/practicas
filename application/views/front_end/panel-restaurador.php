<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/panel.restaurador.js"></script>
<section class="one-page-panelcontrol">

    <div class="sections">
        <div class="container">
            <div class="row">
                <!-- Primera columna 2/12 -->
                <div class="col-md-3">
                    <div class="widget">
                        <div class="widget-title"><h6>Menú</h6></div>
                        <nav class="menu">
                            <ul>
                                <?php $this->load->view('front_end/menu_lateral/menu-panel-restaurador'); ?>
                            </ul>
                        </nav>
                    </div>
                </div><!-- FIN Primera columna 2/12 -->

                <!-- Segunda columna 10/12 -->
                <div class="col-md-9">
                    <article class="seccion-restaurante">
                        <div class="row">
                            <div class="col-md-9">
                                <h5>Bienvenido <?php echo $restaurador->nombre_propietario; ?></h5>
                            </div>
                            <div class="col-md-3">
                                <div class="callout-a ">
                                    <a href="<?php echo base_url('logout'); ?>" class="button-3">Desconectar</a>
                                </div>
                            </div>
                        </div>
                    </article>


                    <!-- Listado de los restaurantes -->
                    <article id="seleccion" class="seccion-restaurante">
                        <h6>Selección de restaurante</h6>
                        <p>Selección actual: 
                            <span class="restauranteseleccionado">
                                <!--Restaurante Rodado (Boadilla del Monte, Madrid)-->
                                <?php echo $restauranteActual->nombre_restaurante; ?>
                                (<?php echo $restauranteActual->nombre_localidad . ", " . $restauranteActual->nombre_provincia; ?>)
                            </span>
                        </p>


                        <div class="enlacesencillo">
                            <a id="abrir-cerrar-buscador" href="">Seleccionar otro restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a>
                        </div>

                        <div class="clear"></div>


                        <div class="form-generico" id="buscador-restaurante" style="display:none">
                            <p>Selecciona el restaurante que quieres gestionar :</p>
                            <form method="post" id="buscador-restaurante-form" action="">

                                <div class="row">

                                    <div class="col-md-9 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="nombre_restaurante_buscar" id="nombre_restaurante_buscar" type="text" Placeholder="Nombre del restaurante">
                                        </div>
                                    </div>

                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a "><a id="buscarRestaurante" href="" class="button-3">Buscar</a></div>
                                        </div>
                                    </div>


                                    <div class="clear"></div>
                                    <div class="col-md-12">
                                        <ul id="resultado-buscador" class="restaurantesfavoritos_seleccion">


                                            <?php //foreach ($listadoRestaurantes as $key => $value) { ?>
                                            <!--<li>
                                                <div class="row">
                                                    <div class="col-md-2 nodosfilas ocultar">
                                                        <img alt="" src="<?php echo base_url(); ?>assets/images/restaurantes/00002_Restaurante02/principal.jpg">
                                                    </div>
                                                    <div class="col-md-6 nodosfilas convertir8">
                                                        <div><strong>Nombre</strong>: <?php echo $value->nombre_restaurante; ?></div>
                                                        <div><strong>Municipio</strong>: <?php echo $value->nombre_localidad; ?></div>
                                                        <div><strong>Categorí­a</strong>: <?php echo isset($value->nombre_categoria) ? $value->nombre_categoria : ''; ?></div>
                                                        <div><strong>Precio medio</strong>: <?php echo $value->precio_medio_restaurante; ?></div>
                                                    </div>
                                                    <div class="col-md-4 nodosfilas">

                                                        <div class="enlacesencillo">
                                                            <a id="seleccionar-restaurante" href="javascript:seleccionaRestaurante(<?php echo $value->id_restaurante ?>);">Seleccionar<span>
                                                                    <i class="fa fa-arrow-circle-right"></i></span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>-->
                                            <?php //} ?>



                                        </ul>
                                        <div class="enlacesencillo"><a href="<?php echo base_url('acceso/restaurador/alta-restaurante-plan'); ?>">Alta de nuevo restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a></div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_restaurante" id="id_restaurante">
                                <input type="hidden" name="id_propietario" id="id_propietario" value="<?php echo $id_propietario ?>">
                            </form>

                            <div class="clear"></div>
                        </div>
                    </article>



                    <article id="gestiontipos" class="seccion-restaurante">
                        <h6>Tipos de menú</h6>
                        <p>A continuación se indican los tipos de menús que tiene asociados el restaurante. Puede añadir más en la parte inferior.</p>
                        <p>En todos ellos, podrá indicar en la sección "Gestionar menús" si incluyen <strong>café, bebida y postre</strong>.</p>
                        <div class="form-generico">

                            <div class="row" id="listado-tipos-menu">

                                <?php //if ($listadoMenus) { ?>

                                <?php //foreach ($listadoMenus as $key => $value) { ?>
                                <!-- <div class="col-md-9 nodosfilas">
                                     <div class="form-input">
                                         <i class="fa fa-pencil"></i>
                                         <input name="name" id="name" type="text" value="<?php //echo $value->nombre_menu;    ?>" disabled>
                                     </div>
                                 </div>
                                 <div class="col-md-3 nodosfilas">
                                     <div class="form-input">
                                         <div class="callout-a ">
                                             <a href="<?php //echo base_url();    ?>acceso/restaurador/eliminar-tipo-menu?clave_menu=<?php //echo $value->id_menu;    ?>&clave_restaurante=<?php //echo $value->restaurantes_id_restaurante;    ?>" class="button-3">Eliminar</a>
                                         </div>
                                     </div>
                                 </div>
                                -->
                                <?php //} ?>

                                <?php //} else { ?>
                                <!--
                                                                    <div class="col-md-12 nodosfilas">
                                                                        <div class="form-input">
                                                                            <p style="text-align: center;">Actualmente no tienes ningún menú añadido.</p>
                                                                        </div>
                                                                    </div>
                                -->

                                <?php //} ?>

                            </div>


                            <hr class="bordepunteadogris">
                            <div class="separadorpeq"></div>
                            <h6>Alta de tipo de menú</h6>

                            <div class="mensajeexito addFormTipoMenu" style="display:none;"></div>

                            <form method="post" id="nuevo-menu-form">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Nombre</label>
                                    </div>
                                    <div class="col-md-9 nodosfilas convertir12">
                                        <div class="form-input">
                                            <i class="fa fa-pencil"></i>
                                            <input name="nombre_menu" id="nombre_menu" type="text" placeholder="Introduce un nombre, Ej. Menú fin de semana">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-3">
                                        <label>Estructura</label>
                                    </div>

                                    <div class="col-md-9 nodosfilas convertir12">
                                        <div class="form-input">
                                            <input type="radio" name="estructura_menu" id="estructura_menu" value="1">
                                            <label>Primeros + Segundos (tí­pico menú del dí­a)</label>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="form-input">
                                            <input type="radio" name="estructura_menu" id="estructura_menu" value="2">
                                            <label>Entrante + Primeros + Segundos</label>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="form-input">
                                            <input type="radio" name="estructura_menu" id="estructura_menu" value="3">
                                            <label>Entrante + Plato principal</label>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                                <div class="row centrar reducirfila">
                                    <input class="button-3 botonpeq" type="submit" name="btnAddTipoMenu" id="btnAddTipoMenu" value="Guardar tipo">
                                </div>

                                <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo $restauranteActual->clave_restaurante; ?>">
                                <input type="hidden" name="id_restaurantes" id="id_restaurantes" value="<?php echo $restauranteActual->id_restaurante; ?>">

                            </form>


                        </div>
                    </article>



































                    <article id="gestionmenus" class="seccion-restaurante">
                        <h6>Gestión menús</h6>
                        <div class="accordion accordion-2 toggle-accordion">

                            <div class="mensajeexito addFormPlateMenu" style="display:none;"></div>

                            <div id="listado-menus">
                                <!--
                                <?php foreach ($listadoMenus as $key => $value) { ?>
                
                                    <?php if ($value->tipo_menu_id_tipo_menu == 1) { ?>
                                                                <div class="section-content">
                                                                    <h4 class="accordion-title">
                                                                        <a href="#"><?php echo $value->nombre_menu; ?><i class="fa fa-plus"></i></a>
                                                                    </h4>
                            
                                                                    <div class="accordion-inner">
                                                                        <div class="form-generico">
                                                                            <form method="post" name="test" id="platos-menus-form">
                            
                                                                                <div class="row">
                                                                                    <div class="col-md-6 nodosfilas">
                                                                                        <div class="col-md-4">
                                                                                            <label>Fecha</label>
                                                                                        </div>
                                                                                        <div class="col-md-8 nodosfilas convertir12">
                                                                                            <div class="form-input">
                                                                                                <i class="fa fa-calendar"></i>
                                        <?php //$codigo = random_string('unique'); ?>
                                                                                                <input name="calendario" id="calendario_menu<?php //echo $codigo;           ?>" type="text" value="<?php echo $value->fecha_dia_menu; ?>" placeholder="dd/mm/aaaa">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 nodosfilas">
                                                                                        <div class="col-md-4">
                                                                                            <label>Precio</label>
                                                                                        </div>
                                                                                        <div class="col-md-8 nodosfilas convertir12">
                                                                                            <div class="form-input">
                                                                                                <i class="fa fa-eur"></i> 
                                                                                                <input name="precio_menu" id="precio_menu" type="text" value="<?php echo $value->precio_menu; ?>" placeholder="">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <hr class="bordepunteadogris">
                            
                                                                                <div class="alerts">
                                                                                    <i class="fa fa-star"></i>
                                                                                    <div>
                                                                                        <h3>Selección de menús habituales</h3>
                                                                                        <p>Si lo prefieres, puedes seleccionar uno de tus menús guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>
                            
                            
                                                                                        <div class="row">
                            
                                        <?php if ($listadoMenusHabituales) { ?>
                                            <?php foreach ($listadoMenusHabituales as $key => $values) { ?>
                                                                                                                            <div class="col-md-6">
                                                                                                                                <label>
                                                                                                                                    <a href="<?php echo base_url(); ?>?menu_habitual=<?php echo $values->id_menu_habitual; ?>" id="btnSelectMenuHabitual">
                                                <?php echo $values->nombre_menu_habitual; ?>&nbsp;
                                                                                                                                        <i class="fa fa-check-circle"></i>
                                                                                                                                    </a>&nbsp;
                                                    
                                                                                                                                    <a href="<?php echo base_url(); ?>acceso/restaurador/eliminar-menu-habitual?menu_habitual=<?php echo $values->id_menu_habitual; ?>" id="btnDeleteMenuHabitual">
                                                                                                                                        <i class="fa fa-times-circle"></i>
                                                                                                                                    </a>
                                                    
                                                                                                                                    <input type="hidden" name="id_menu_habitual" id="id_menu_habitual" class="id_menu_habitual" value="<?php echo $values->id_menu_habitual; ?>" />
                                                    
                                                                                                                                </label>
                                                                                                                            </div>
                                            <?php } ?>
                                        
                                        <?php } else { ?>
                                                                                                            <div class="col-md-6">
                                                                                                                <p>Actualmente no tienes ningún menú dado de alta.</p>
                                                                                                            </div>
                                        <?php } ?>
                            
                                                                                        </div>
                            
                            
                                                                                    </div>
                                                                                </div>
                            
                            
                                                                                <div class="row derecha">
                                                                                    <input class="button-3 botonpeq" type="submit" value="Borrar cajas y escribir de nuevo">
                                                                                </div>
                            
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 dosfilas">
                                                                                        <h5>PRIMEROS</h5>
                            
                                                                                        <div id="contenedorPlatos" class="contenedorPlatos">
                                        <?php if ($listadoPrimeros[$key]) { ?>
                                            <?php foreach ($listadoPrimeros[$key] as $primero): ?>
                                                                                                                            <div class="row contenedor" id="1">
                                                                                                                                <div class="col-md-10 nodosfilas">
                                                                                                                                    <div class="form-input">
                                                                                                                                        <i class="fa fa-cutlery"></i> 
                                                                                                                                        <input value="<?php echo $primero->nombre_primeros_menu ?>" name="primeros_menu_estructura[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="col-md-2 nodosfilas">
                                                                                                                                    <div class="form-input">
                                                                                                                                        <div class="form-input">
                                                                                                                                            <div class="callout-a">
                                                                                                                                                <a href="#" class="button-3 eliminar">X</a>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                            <?php endforeach; ?>
                                        <?php } else { ?>
                                                                                                            <div class="row contenedor" id="1">
                                                                                                                <div class="col-md-10 nodosfilas">
                                                                                                                    <div class="form-input">
                                                                                                                        <i class="fa fa-cutlery"></i> 
                                                                                                                        <input name="primeros_menu_estructura[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="Añadir plato">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-2 nodosfilas">
                                                                                                                    <div class="form-input">
                                                                                                                        <div class="form-input">
                                                                                                                            <div class="callout-a">
                                                                                                                                <a href="#" class="button-3 eliminar">X</a>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                        
                                        <?php } ?>
                                                                                        </div>
                            
                                                                                        <div class="clear"></div>
                            
                            
                                                                                        <div class="enlacesencillo">
                                                                                            <a href="#" id="addInputPrimeros">Añadir más primeros<span><i class="fa fa-arrow-circle-right"></i></span></a>
                                                                                        </div>
                            
                                                                                        <input type="hidden" name="primeros_platos_menu" id="primeros_platos_menu">
                            
                                                                                    </div>
                            
                            
                            
                            
                                                                                    <div class="col-md-6 dosfilas">
                                                                                        <h5>SEGUNDOS</h5>
                            
                                                                                        <div id="contenedorPlatos2">
                                        <?php if ($listadoSegundos[$key]) { ?>                                                                
                                            <?php foreach ($listadoSegundos[$key] as $segundo): ?>
                                                                                                                            <div class="row">
                                                                                                                                <div class="col-md-10 nodosfilas">
                                                                                                                                    <div class="form-input">
                                                                                                                                        <i class="fa fa-cutlery"></i> 
                                                                                                                                        <input value="<?php echo $segundo->nombre_segundo_menu ?>" name="segundos_menu_estructura[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="col-md-2 nodosfilas">
                                                                                                                                    <div class="form-input">
                                                                                                                                        <div class="callout-a ">
                                                                                                                                            <a href="#" class="button-3">X</a>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                            <?php endforeach; ?>
                                        <?php } else { ?>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-10 nodosfilas">
                                                                                                                    <div class="form-input">
                                                                                                                        <i class="fa fa-cutlery"></i> 
                                                                                                                        <input name="segundos_menu_estructura[]" id="segundos_menu_estructura" type="text" placeholder="Añadir plato">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-2 nodosfilas">
                                                                                                                    <div class="form-input">
                                                                                                                        <div class="callout-a ">
                                                                                                                            <a href="#" class="button-3">X</a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                        <?php } ?>                                                                
                                                                                        </div>
                            
                                                                                        <div class="clear"></div>
                                                                                        <div class="enlacesencillo">
                                                                                            <a href="#" id="addInputSegundos">Añadir más segundos<span><i class="fa fa-arrow-circle-right"></i></span></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                            
                                                                                <hr class="bordepunteadogris">
                            
                                                                                <div class="separadorgrande"></div>
                            
                            
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                            
                                        <?php if ($value->postre_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="postre_menu" id="postre_menu" checked><label>Con postre</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="postre_menu" id="postre_menu"><label>Con postre</label>
                                        <?php } ?>
                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->cafe_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="cafe_menu" id="cafe_menu"checked><label>Con café</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="cafe_menu" id="cafe_menu"><label>Con café</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->pan_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="pan_menu" id="pan_menu" checked><label>Con pan</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="pan_menu" id="pan_menu"><label>Con pan</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->bebida_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="bebida_menu" id="bebida_menu" checked><label>Con bebida</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="bebida_menu" id="bebida_menu"><label>Con bebida</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <label>Observaciones</label>
                                                                                    </div>
                                                                                    <div class="col-md-9 nodosfilas convertir12">
                                                                                        <div class="form-input">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                            <textarea maxlength="255" name="observaciones_menu" id="observaciones_menu" type="text"></textarea>
                                                                                            <strong><div id="contador"></div></strong>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <br />
                            
                                                                                <div class="row">
                                                                                    <p class="reducirfila">Â¿Este menú lo vas a reutilizar a
                                                                                        menudo? Ponle un nombre y dale a "Guardar como menú habitual"</p>
                                                                                    <div class="col-md-8 nodosfilas">
                                                                                        <div class="form-input">
                                                                                            <i class="fa fa-cutlery"></i> <input name="nombre_menu_habitual" id="nombre_menu_habitual" type="text" placeholder="Ej. Menú de los lunes, Menú arroces, etc...">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 nodosfilas">
                                                                                        <div class="form-input">
                                                                                            <div class="callout-a ">
                                                                                                <a href="#" id="btnAddMenuHabitual" class="button-3">Guardar como menú habitual</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                            
                            
                                                                                </div>
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row centrar reducirfila">
                                                                                    <input class="button-3 botonpeq" id="btnAddPlateMenu2" type="submit" value="Actualizar menú">
                                                                                </div>
                            
                                                                                <div id="mensajeMenu"></div>
                            
                                                                                <input type="hidden" name="id_menu" id="id_menu" value="<?php echo $value->id_menu; ?>" />
                                                                                <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo $restauranteActual->clave_restaurante; ?>">
                                                                                <input type="hidden" name="id_restaurantes" id="id_restaurantes" value="<?php echo $restauranteActual->id_restaurante; ?>">
                            
                            
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                            
                                    <?php } ?>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                                    <?php if ($value->tipo_menu_id_tipo_menu == 2) { ?>
                                                                <div class="section-content">
                                                                    <h4 class="accordion-title">
                                                                        <a href="#"><?php echo $value->nombre_menu; ?><i class="fa fa-plus"></i></a>
                                                                    </h4>
                            
                                                                    <div class="accordion-inner">
                                                                        <div class="form-generico">
                                                                            <form method="post" id="form-1" action="#">
                            
                                                                                <div class="row">
                                                                                    <div class="col-md-6 nodosfilas">
                                                                                        <div class="col-md-4">
                                                                                            <label>Fecha</label>
                                                                                        </div>
                                                                                        <div class="col-md-8 nodosfilas convertir12">
                                                                                            <div class="form-input">
                                                                                                <i class="fa fa-calendar"></i> 
                                                                                                <input name="calendario_2" id="calendario_2" type="text" value="<?php echo $value->fecha_dia_menu; ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 nodosfilas">
                                                                                        <div class="col-md-4">
                                                                                            <label>Precio</label>
                                                                                        </div>
                                                                                        <div class="col-md-8 nodosfilas convertir12">
                                                                                            <div class="form-input">
                                                                                                <i class="fa fa-eur"></i> 
                                                                                                <input name="name" id="name" type="text" value="<?php echo $value->precio_menu; ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <hr class="bordepunteadogris">
                            
                                                                                <div class="alerts">
                                                                                    <i class="fa fa-star"></i>
                                                                                    <div>
                                                                                        <h3>Selección de menús habituales</h3>
                                                                                        <p>Si lo prefieres, puedes seleccionar uno de tus menús guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>
                            
                            
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <label>
                                                                                                    <a href="#">Menú de los lunes&nbsp;
                                                                                                        <i class="fa fa-check-circle"></i>
                                                                                                    </a>&nbsp;
                            
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-times-circle"></i>
                                                                                                    </a>
                                                                                                </label>
                                                                                            </div>
                            
                                                                                            <div class="col-md-6">
                                                                                                <label>
                                                                                                    <a href="#">Menú de los lunes&nbsp;
                                                                                                        <i class="fa fa-check-circle"></i>
                                                                                                    </a>&nbsp;
                            
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-times-circle"></i>
                                                                                                    </a>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                            
                            
                                                                                    </div>
                                                                                </div>
                            
                            
                                                                                <div class="row derecha">
                                                                                    <input class="button-3 botonpeq" type="submit" value="Borrar cajas y escribir de nuevo">
                                                                                </div>
                            
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 dosfilas">
                                                                                        <h5>ENTRANTES</h5>
                            
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-10 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <i class="fa fa-cutlery"></i> <input name="name" id="name" type="text" value="Arroz con pollo">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <div class="form-input">
                                                                                                                        <div class="callout-a ">
                                                                                                                            <a href="#" class="button-3">X</a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                        <?php } ?>
                            
                            
                                                                                        <div class="clear"></div>
                                                                                        <div class="enlacesencillo">
                                                                                            <a href="#">Añadir más primeros<span><i
                                                                                                        class="fa fa-arrow-circle-right"></i></span></a>
                                                                                        </div>
                                                                                    </div>
                            
                            
                            
                                                                                    <div class="col-md-6 dosfilas">
                                                                                        <h5>PRIMEROS</h5>
                            
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-10 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <i class="fa fa-cutlery"></i> <input name="name" id="name" type="text" value="Arroz con pollo">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <div class="form-input">
                                                                                                                        <div class="callout-a ">
                                                                                                                            <a href="#" class="button-3">X</a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                        <?php } ?>
                            
                            
                                                                                        <div class="clear"></div>
                                                                                        <div class="enlacesencillo">
                                                                                            <a href="#">Añadir más primeros<span><i
                                                                                                        class="fa fa-arrow-circle-right"></i></span></a>
                                                                                        </div>
                                                                                    </div>
                            
                            
                            
                            
                                                                                    <div class="col-md-6 dosfilas">
                                                                                        <h5>SEGUNDOS</h5>
                            
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-10 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <i class="fa fa-cutlery"></i> <input name="name" id="name" type="text" value="Judí­as verdes con tomate" disabled>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <div class="callout-a ">
                                                                                                                        <a href="#" class="button-3">X</a>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                        <?php } ?>
                            
                            
                            
                                                                                        <div class="clear"></div>
                                                                                        <div class="enlacesencillo">
                                                                                            <a href="#">Añadir más segundos<span><i
                                                                                                        class="fa fa-arrow-circle-right"></i></span></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                            
                                                                                <hr class="bordepunteadogris">
                            
                                                                                <div class="separadorgrande"></div>
                            
                            
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                            
                                        <?php if ($value->postre_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="postre_menu" id="postre_menu" checked><label>Con postre</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="postre_menu" id="postre_menu"><label>Con postre</label>
                                        <?php } ?>
                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->cafe_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="cafe_menu" id="cafe_menu"checked><label>Con café</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="cafe_menu" id="cafe_menu"><label>Con café</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->pan_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="pan_menu" id="pan_menu" checked><label>Con pan</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="pan_menu" id="pan_menu"><label>Con pan</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->bebida_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="bebida_menu" id="bebida_menu" checked><label>Con bebida</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="bebida_menu" id="bebida_menu"><label>Con bebida</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <label>Observaciones</label>
                                                                                    </div>
                                                                                    <div class="col-md-9 nodosfilas convertir12">
                                                                                        <div class="form-input">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                            <textarea maxlength="255" name="observaciones_menu" id="observaciones_menu" type="text"></textarea>
                                                                                            <strong><div id="contador"></div></strong>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <p class="reducirfila">Â¿Este menú lo vas a reutilizar a
                                                                                        menudo? Ponle un nombre y dale a "Guardar como menú habitual"</p>
                                                                                    <div class="col-md-8 nodosfilas">
                                                                                        <div class="form-input">
                                                                                            <i class="fa fa-cutlery"></i> <input name="name" id="name"
                                                                                                                                 type="text"
                                                                                                                                 placeholder="Ej. Menú de los lunes, Menú arroces, etc...">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 nodosfilas">
                                                                                        <div class="form-input">
                                                                                            <div class="callout-a ">
                                                                                                <a href="#" class="button-3">Guardar como menú habitual</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row centrar reducirfila">
                                                                                    <input class="button-3 botonpeq" type="submit" value="Actualizar menú">
                                                                                </div>
                            
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                            
                                    <?php } ?>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                                    <?php if ($value->tipo_menu_id_tipo_menu == 3) { ?>
                                                                <div class="section-content">
                                                                    <h4 class="accordion-title">
                                                                        <a href="#"><?php echo $value->nombre_menu; ?><i class="fa fa-plus"></i></a>
                                                                    </h4>
                            
                                                                    <div class="accordion-inner">
                                                                        <div class="form-generico">
                                                                            <form method="post" id="form-1" action="#">
                            
                                                                                <div class="row">
                                                                                    <div class="col-md-6 nodosfilas">
                                                                                        <div class="col-md-4">
                                                                                            <label>Fecha</label>
                                                                                        </div>
                                                                                        <div class="col-md-8 nodosfilas convertir12">
                                                                                            <div class="form-input">
                                                                                                <i class="fa fa-calendar"></i> 
                                                                                                <input name="calendario_2" id="calendario_2" type="text" value="<?php echo $value->fecha_dia_menu; ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 nodosfilas">
                                                                                        <div class="col-md-4">
                                                                                            <label>Precio</label>
                                                                                        </div>
                                                                                        <div class="col-md-8 nodosfilas convertir12">
                                                                                            <div class="form-input">
                                                                                                <i class="fa fa-eur"></i> 
                                                                                                <input name="name" id="name" type="text" value="<?php echo $value->precio_menu; ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <hr class="bordepunteadogris">
                            
                                                                                <div class="alerts">
                                                                                    <i class="fa fa-star"></i>
                                                                                    <div>
                                                                                        <h3>Selección de menús habituales</h3>
                                                                                        <p>Si lo prefieres, puedes seleccionar uno de tus menús guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>
                            
                            
                                                                                        <div class="row">
                                                                                            <div class="col-md-6">
                                                                                                <label>
                                                                                                    <a href="#">Menú de los lunes&nbsp;
                                                                                                        <i class="fa fa-check-circle"></i>
                                                                                                    </a>&nbsp;
                            
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-times-circle"></i>
                                                                                                    </a>
                                                                                                </label>
                                                                                            </div>
                            
                                                                                            <div class="col-md-6">
                                                                                                <label>
                                                                                                    <a href="#">Menú de los lunes&nbsp;
                                                                                                        <i class="fa fa-check-circle"></i>
                                                                                                    </a>&nbsp;
                            
                                                                                                    <a href="#">
                                                                                                        <i class="fa fa-times-circle"></i>
                                                                                                    </a>
                                                                                                </label>
                                                                                            </div>
                                                                                        </div>
                            
                            
                                                                                    </div>
                                                                                </div>
                            
                            
                                                                                <div class="row derecha">
                                                                                    <input class="button-3 botonpeq" type="submit" value="Borrar cajas y escribir de nuevo">
                                                                                </div>
                            
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row">
                                                                                    <div class="col-md-6 dosfilas">
                                                                                        <h5>ENTRANTES</h5>
                            
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-10 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <i class="fa fa-cutlery"></i> <input name="name" id="name" type="text" value="Arroz con pollo">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <div class="form-input">
                                                                                                                        <div class="callout-a ">
                                                                                                                            <a href="#" class="button-3">X</a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                        <?php } ?>
                            
                            
                                                                                        <div class="clear"></div>
                                                                                        <div class="enlacesencillo">
                                                                                            <a href="#">Añadir más primeros<span><i
                                                                                                        class="fa fa-arrow-circle-right"></i></span></a>
                                                                                        </div>
                                                                                    </div>
                            
                            
                            
                                                                                    <div class="col-md-6 dosfilas">
                                                                                        <h5>PLATO PRINCIPAL</h5>
                            
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-10 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <i class="fa fa-cutlery"></i> <input name="name" id="name" type="text" value="Arroz con pollo">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 nodosfilas">
                                                                                                                <div class="form-input">
                                                                                                                    <div class="form-input">
                                                                                                                        <div class="callout-a ">
                                                                                                                            <a href="#" class="button-3">X</a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                        <?php } ?>
                            
                            
                                                                                        <div class="clear"></div>
                                                                                        <div class="enlacesencillo">
                                                                                            <a href="#">Añadir más primeros<span><i
                                                                                                        class="fa fa-arrow-circle-right"></i></span></a>
                                                                                        </div>
                                                                                    </div>
                            
                                                                                </div>
                            
                            
                                                                                <hr class="bordepunteadogris">
                            
                                                                                <div class="separadorgrande"></div>
                            
                            
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                            
                                        <?php if ($value->postre_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="postre_menu" id="postre_menu" checked><label>Con postre</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="postre_menu" id="postre_menu"><label>Con postre</label>
                                        <?php } ?>
                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->cafe_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="cafe_menu" id="cafe_menu"checked><label>Con café</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="cafe_menu" id="cafe_menu"><label>Con café</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->pan_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="pan_menu" id="pan_menu" checked><label>Con pan</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="pan_menu" id="pan_menu"><label>Con pan</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-input">
                                        <?php if ($value->bebida_menu == 1) { ?>
                                                                                                            <input type="checkbox" name="bebida_menu" id="bebida_menu" checked><label>Con bebida</label>
                                        <?php } else { ?>
                                                                                                            <input type="checkbox" name="bebida_menu" id="bebida_menu"><label>Con bebida</label>
                                        <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <label>Observaciones</label>
                                                                                    </div>
                                                                                    <div class="col-md-9 nodosfilas convertir12">
                                                                                        <div class="form-input">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                            <textarea maxlength="255" name="observaciones_menu" id="observaciones_menu" type="text"></textarea>
                                                                                            <strong><div id="contador"></div></strong>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <p class="reducirfila">Â¿Este menú lo vas a reutilizar a
                                                                                        menudo? Ponle un nombre y dale a "Guardar como menú habitual"</p>
                                                                                    <div class="col-md-8 nodosfilas">
                                                                                        <div class="form-input">
                                                                                            <i class="fa fa-cutlery"></i> <input name="name" id="name"
                                                                                                                                 type="text"
                                                                                                                                 placeholder="Ej. Menú de los lunes, Menú arroces, etc...">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 nodosfilas">
                                                                                        <div class="form-input">
                                                                                            <div class="callout-a ">
                                                                                                <a href="#" class="button-3">Guardar como menú habitual</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="separadorpeq"></div>
                                                                                <div class="row centrar reducirfila">
                                                                                    <input class="button-3 botonpeq" type="submit"
                                                                                           value="Actualizar menú">
                                                                                </div>
                            
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                            
                                    <?php } ?>
                
                
                
                
                                                
                                <?php } ?>
                                -->
                            </div>











                            <!--
                                    <div class="section-content">
                                            <h4 class="accordion-title">
                                                    <a href="#">Menú ejecutivo<i class="fa fa-minus"></i></a>
                                            </h4>
                                            <div class="accordion-inner"></div>
                                    </div>
                                    <div class="section-content">
                                            <h4 class="accordion-title">
                                                    <a href="#">Menú fin de semana<i class="fa fa-minus"></i></a>
                                            </h4>
                                            <div class="accordion-inner"></div>
                                    </div>
                            -->



                        </div>
                        <div class="form-generico">
                            <form method="post" id="form-1" action="#"></form>
                        </div>
                    </article>




























                    <article id="propietario" class="seccion-restaurante">
                        <h6>Datos propietario</h6>
                        <div class="form-generico">

                            <div class="mensajeexito editFormProperties" style="display:none;">

                            </div>

                            <form method="POST" id="form-1">

                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Nombre propietario</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-user"></i>
                                            <input name="nombre_propietario" id="nombre_propietario" type="text" value="<?php echo $restaurador->nombre_propietario; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a">
                                                <a href="#" class="button-3" id="btnEditNombrePropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_nombre" class="mensajeconfondo"></div>

                                    <div class="clear"></div>

                                    <div class="col-md-2">
                                        <label>Apellidos</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-user"></i>
                                            <input name="apellidos_propietario" id="apellidos_propietario" type="text" value="<?php echo $restaurador->apellidos_propietario; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnEditApellidosPropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_apellidos" class="mensajeconfondo"></div>

                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Correo electrónico</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-envelope"></i>
                                            <input name="email_propietario" id="email_propietario" type="text" value="<?php echo $restaurador->email_propietario; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a">
                                                <a href="#" class="button-3" id="btnEditEmailPropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="email_actual" name="email_actual" value="<?php echo $restaurador->email_propietario; ?>">
                                    <div id="mensaje_email" class="mensajeconfondo"></div>

                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Contraseña acceso</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-key"></i>
                                            <input name="password_propietario" id="pass_propietario" type="text" placeholder="Escribe tu nueva contraseña si quieres cambiarla">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a">
                                                <a href="#" class="button-3" id="btnEditPasswordPropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_pass" class="mensajeconfondo"></div>

                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Teléfono</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-phone"></i>
                                            <input name="telefono_propietario" id="telefono_propietario" type="text" value="<?php echo $restaurador->telefono_propietario; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a">
                                                <a href="#" class="button-3" id="btnEditTelefonoPropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_tel" class="mensajeconfondo"></div>

                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Código postal</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="cp_propietario" id="cp_propietario" type="text" value="<?php echo $restaurador->cp_propietario; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a">
                                                <a href="#" class="button-3" id="btnEditCPPropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_cp" class="mensajeconfondo"></div>

                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Provincia</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <select id="provincia_propietario" class="provincia_propietario" name="provincia_propietario">
                                                <option>Provincia</option>
                                                <?php foreach ($listadoProvincias as $key => $value) { ?>
                                                    <option value="<?php echo $value->id_provincia; ?>" <?php
                                                    if (isset($restaurador->provincias_id_provincia)) {
                                                        echo $restaurador->provincias_id_provincia == $value->id_provincia ? 'selected' : '';
                                                    }
                                                    ?>>
                                                                <?php echo $value->nombre_provincia; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>

<!--                                            <input type="text" class="clarito" value="<?php echo $cpRestaurador->nombre_localidad; ?>" disabled>-->
                                        </div>
                                    </div>
                                    <input type="hidden" id="id_provincia" value="<?php echo $restaurador->provincias_id_provincia ?>">
                                    <input type="hidden" id="id_localidad" value="<?php echo $restaurador->localidades_id_localidad ?>">
                                    <!--
                                    <div class="col-md-3 nodosfilas">
                                        <span class="nota">Asociado al CP</span>
                                    </div>
                                    -->
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a">
                                                <a href="#" class="button-3" id="btnEditProvinciaPropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_provincia" class="mensajeconfondo"></div>

                                    <div class="clear"></div>

                                    <div class="col-md-2">
                                        <label>Localidad</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <select class="localidad_propietario" id="localidad_propietario" name="localidad_propietario">
                                                <option>Localidad</option>
                                            </select>                                           
                                                <!--<input type="text" class="clarito" value="<?php echo $cpRestaurador->nombre_provincia; ?>" disabled>-->
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-3 nodosfilas">
                                        <span class="nota">Asociado al CP</span>
                                    </div>
                                    -->
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a">
                                                <a href="#" class="button-3" id="btnEditLocalidadPropietario">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_localidad" class="mensajeconfondo"></div>

                                    <div class="clear"></div>

                            </form>

                        </div>
                    </article>






















                    <article id="datosrestaurante" class="seccion-restaurante">
                        <h6>Datos restaurante</h6>
                        <div class="form-generico">

                            <div class="mensajeexito editFormRestaurant" style="display:none;"></div>

                            <form method="post" id="form-1" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Nombre restaurante</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-user"></i>
                                            <input name="nombre_restaurante" id="nombre_restaurante2" type="text" value="<?php echo $restauranteActual->nombre_restaurante; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnModificarNombreRestaurante">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_nombre_restaurante" class="mensajeconfondo"></div>

                                    <div class="clear"></div>

                                    <?php if ($restauranteActual->planes_id_plan == 2 || $restauranteActual->planes_id_plan == 3): ?>
                                        <div class="col-md-2">
                                            <label>Web</label>
                                        </div>
                                        <div class="col-md-7 nodosfilas convertir9">
                                            <div class="form-input">
                                                <i class="fa fa-external-link"></i>
                                                <input name="web_restaurante" id="web_restaurante" type="text" value="<?php echo $restauranteActual->web_restaurante; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 nodosfilas">
                                            <div class="form-input">
                                                <div class="callout-a ">
                                                    <a href="#" class="button-3" id="btnModificarWebRestaurante">Modificar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="mensaje_web" class="mensajeconfondo"></div>

                                        <div class="clear"></div>

                                    <?php endif; ?>
                                    <div class="col-md-2">
                                        <label>Calle</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="calle_restaurante" id="calle_restaurante" type="text" value="<?php echo $restauranteActual->direccion_restaurante; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnModificarCalleRestaurante">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_calle" class="mensajeconfondo"></div>

                                    <div class="clear"></div>


                                    <div class="col-md-2">
                                        <label>Número</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="numero_restaurante" id="numero_restaurante" type="text" value="<?php echo $restauranteActual->numero_restaurante; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnModificarNumeroRestaurante">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_numero" class="mensajeconfondo"></div>

                                    <div class="clear"></div>


                                    <div class="col-md-2">
                                        <label>Código postal</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <!--
                                            <input name="cp_restaurante" id="cp_restaurante" type="text" value="<?php echo $restauranteActual->num_codigo_postal; ?>">
                                            -->
                                            <input name="cp_restaurante" id="cp_restaurante" type="text" value="<?php echo $restauranteActual->cp_restaurante; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnModificarCPRestaurante">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_cp_restaurante" class="mensajeconfondo"></div>

                                    <div class="clear"></div>


                                    <div class="col-md-2">
                                        <label>Municipio</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="localidad_restaurante" id="localidad_restaurante" type="text" class="clarito" value="<?php echo $restauranteActual->nombre_localidad; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <span class="nota">Asociado al CP</span>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="col-md-2">
                                        <label>Provincia</label>
                                    </div>

                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="provincia_restaurante" id="provincia_restaurante" type="text" class="clarito" value="<?php echo $dameCpRestaurante->nombre_provincia; ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3 nodosfilas">
                                        <span class="nota">Asociado al CP</span>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="col-md-2">
                                        <label>Barrio</label>
                                    </div>

                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="barrio_restaurante" id="barrio_restaurante" type="text" value="<?php echo $restauranteActual->barrio_restaurante; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnModificarBarrio">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_barrio" class="mensajeconfondo"></div>

                                    <div class="clear"></div>

                                    <div class="col-md-2">
                                        <label>Precio medio carta</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-eur"></i>
                                            <select name="precio_medio_restaurante" id="precio_medio_restaurante">
                                                <option>Selecciona rango de precios</option>
                                                <option <?php if($restauranteActual->precio_medio_restaurante == 'Menos de 15€'){ echo ' selected="selected"'; } ?>>Menos de 15€</option>
                                                <option <?php if($restauranteActual->precio_medio_restaurante == '16-25€'){ echo ' selected="selected"'; } ?>>16-25€</option>
                                                <option <?php if($restauranteActual->precio_medio_restaurante == '26-35€'){ echo ' selected="selected"'; } ?>>26-35€</option>
                                                <option <?php if($restauranteActual->precio_medio_restaurante == '36-50€'){ echo ' selected="selected"'; } ?>>36-50€</option>
                                                <option <?php if($restauranteActual->precio_medio_restaurante == 'Más de 51€'){ echo ' selected="selected"'; } ?>>Más de 51€</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnModificarPrecio">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_precio" class="mensajeconfondo"></div>









                                    <div class="clear"></div>

                                    <div class="mensajeexito" id="mensajePDF" style="display:none;"></div>

                                    <div class="col-md-2">
                                        <label>Subir carta</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <input name="archivo_carta" id="archivo_carta" type="file">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" id="btnUploadCartaRestaurante" class="button-3">Modificar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mensaje_carta" class="mensajeconfondo"></div>

                                    <div class="clear"></div>
                                    <br />
                                    <p style="text-align: center;">
                                        <?php if ($restauranteActual->carta_restaurante != "") { ?>
                                            <span id="mostrar_carta" class="restauranteseleccionado">
                                                <a href="<?php echo base_url() ?>assets/pdfs/<?php echo $restauranteActual->carta_restaurante; ?>" target="_blank">Mostrar carta</a>
                                            </span>
                                        <?php } else { ?>
                                            <span id="mostrar_carta" class="restauranteseleccionado">
                                                Actualmente no tiene subida ninguna carta.
                                            </span>
                                        <?php } ?>
                                    </p>
                                    <div class="clear"></div>











                                    <div class="row reducirfila">

                                        <div class="col-md-3">
                                            <div class="form-input">
                                                <?php if ($restauranteActual->parking_restaurante != 0) { ?>
                                                    <input type="checkbox" name="parking_restaurante" id="parking_restaurante" value="1" checked><label>Tiene Parking</label>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="parking_restaurante" id="parking_restaurante" value="0"><label>Tiene Parking</label>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input">
                                                <?php if ($restauranteActual->tarjetas_restaurante != 0) { ?>
                                                    <input type="checkbox" name="tarjetas_restaurante" id="tarjetas_restaurante" value="1" checked><label>Permite tarjeta</label>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="tarjetas_restaurante" id="tarjetas_restaurante" value="0"><label>Permite tarjeta</label>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input">
                                                <?php if ($restauranteActual->reservas_restaurante != 0) { ?>
                                                    <input type="checkbox" name="reservas_restaurante" id="reservas_restaurante" value="1" checked><label>Permite reservas</label>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="reservas_restaurante" id="reservas_restaurante" value="0"><label>Permite reservas</label>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input">
                                                <?php if ($restauranteActual->visible_restaurante != 0) { ?>
                                                    <input type="checkbox" name="visible_restaurante" id="visible_restaurante" value="1" checked><label>Está visible</label>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="visible_restaurante" id="visible_restaurante" value="0"><label>Está visible</label>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>






                                <hr class="bordepunteadogris">

                                <div class="separadorpeq"></div>
















                                <article>
                                    <h6>Categoría del restaurante</h6>
                                    <div class="row">
                                        <div class="mensajeexito editFormCategory" style="display:none;"></div>

                                        <div class="col-md-2">
                                            <label>Categoría principal</label>
                                        </div>

                                        <div class="col-md-7 nodosfilas convertir9">
                                            <div class="form-input">
                                                <i class="fa fa-cutlery"></i>
                                                <select name="primera_categoria_restaurante" id="primera_categoria_restaurante">
                                                    <option>Selecciona categoría</option>
                                                    <?php foreach ($listadoCategorias as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_categoria; ?>"<?php if($restauranteActual->categorias_id_categoria == $value->id_categoria){ echo ' selected="selected"'; } ?>>
                                                            <?php echo $value->nombre_categoria; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3 nodosfilas">
                                            <div class="form-input">
                                                <div class="callout-a ">
                                                    <a href="#" class="button-3" id="btnModificarCategoria">Actualizar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="mensaje_categoria" class="mensajeconfondo"></div>                                        

                                        <div class="clear"></div>		


                                        <div class="col-md-2">
                                            <label>Categoría secundaria</label>
                                        </div>
                                        <div class="col-md-7 nodosfilas convertir9">
                                            <div class="form-input">
                                                <i class="fa fa-cutlery"></i>

                                                <select name="segunda_categoria_restaurante" id="segunda_categoria_restaurante">
                                                    <option>Selecciona categoría</option>
                                                    <?php foreach ($listadoCategorias as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_categoria; ?>"<?php if($restauranteActual->segunda_categoria_restaurante == $value->id_categoria){ echo ' selected="selected"'; } ?>>
                                                            <?php echo $value->nombre_categoria; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-md-3 nodosfilas">
                                            <div class="form-input">
                                                <div class="callout-a ">
                                                    <a href="#" class="button-3" id="btnModificarCategoria2">Actualizar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="mensaje_categoria2" class="mensajeconfondo"></div>                                        
                                        <div class="clear"></div>

                                        <div class="col-md-2">
                                            <label>Añadir otra categoría secundaria</label>
                                        </div>
                                        <div class="col-md-7 nodosfilas convertir9">
                                            <div class="form-input">
                                                <i class="fa fa-cutlery"></i>
                                                <select name="tercera_categoria_restaurante" id="tercera_categoria_restaurante">
                                                    <option>Selecciona categoría</option>
                                                    <?php foreach ($listadoCategorias as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_categoria; ?>"<?php if($restauranteActual->tercera_categoria_restaurante == $value->id_categoria){ echo ' selected="selected"'; } ?>>
                                                            <?php echo $value->nombre_categoria; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 nodosfilas">
                                            <div class="form-input">
                                                <div class="callout-a ">
                                                    <a href="#" class="button-3" id="btnModificarCategoria3">Actualizar</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="mensaje_categoria3" class="mensajeconfondo"></div>                                                                                
                                        <div class="clear"></div>
                                    </div>
                                </article>


                                















                                <hr class="bordepunteadogris">
                                <div class="separadorpeq"></div>
                                <h6>Especialidades</h6>
                                <div class="row">
                                
                                	<div id="listado_especialidades"></div>

                                    <div class="col-md-9 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-cutlery"></i>
                                            <input name="nueva_especialidad" id="nueva_especialidad" type="text" Placeholder="Añadir nueva especialidad">
                                        </div>
                                    </div>

                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnAddEspecialtiesForm">Añadir</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="mensaje_especialidades" class="mensajeconfondo"></div>

                                </div>



                                <hr class="bordepunteadogris">





                                <div class="separadorpeq"></div>
                                <h6>Puntos de interés</h6>
                                <div class="row">
                                
                                	<div id="listado_punto_interes"></div>

                                    <div class="col-md-9 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-cutlery"></i>
                                            <input name="nuevo_punto_interes" id="nuevo_punto_interes" type="text" Placeholder="Añadir nuevo punto de interés">
                                        </div>
                                    </div>

                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnAddPuntoInteres">Añadir</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="mensaje_punto_interes" class="mensajeconfondo"></div>

                                </div>


                                <hr class="bordepunteadogris">
                                <div class="separadorpeq"></div>
                                
                                
                                <h6>Estaciones de metro</h6>
                                <div class="row">

                                	<div id="listado_estaciones_metro"></div>
                                    
                                    <div class="col-md-9 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <select name="nueva_estacion_metro" id="nueva_estacion_metro">
                                                <option value="-2">Añadir estación</option>
                                                <option value="-1">------------------</option>

                                                <?php foreach ($listadoEstaciones as $key => $value) { ?>
                                                    <option value="<?php echo $value->id_estacion; ?>"><?php echo $value->nombre_estacion; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="addEstacionMetro">Añadir</a>
                                            </div>
                                        </div>
                                    </div>
                                
                               		<div id="mensaje_estaciones_metro" class="mensajeconfondo"></div>
                                </div>
                                    
                                    
                                    
                                <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo $restauranteActual->clave_restaurante; ?>">
                                <input type="hidden" name="id_restaurantes" id="id_restaurantes" value="<?php echo $restauranteActual->id_restaurante; ?>">
                            </form>



                        </div>
                    </article>


















                    <article id="facturacion" class="seccion-restaurante">
                        <h6>Datos facturación</h6>
                        <div class="form-generico">


                            <div class="row">

                                <div class="col-md-2">
                                    <label style="cursor: text;">Razón Social</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i>
                                        <input name="razon_social_facturacion" id="razon_social_facturacion" type="text" value="<?php echo $datosFacturacion->razon_social_facturacion; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditRazonFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_razon_facturacion" class="mensajeconfondo"></div>







                                <!-- Revisar -->
                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">CIF / NIF</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i>
                                        <input name="cif_facturacion" id="cif_facturacion" type="text" placeholder="Poner NIF / CIF - Facturación" value="<?php echo $datosFacturacion->cif_facturacion; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditCifFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_cif_facturacion" class="mensajeconfondo"></div>










                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Calle</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="calle_facturacion" id="calle_facturacion" type="text" value="<?php echo $datosFacturacion->direccion_facturacion; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditCalleFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_calle_facturacion" class="mensajeconfondo"></div>



                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Número</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="numero_facturacion" id="numero_facturacion" type="text" value="<?php echo $datosFacturacion->numero_facturacion; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditNumeroFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_numero_facturacion" class="mensajeconfondo"></div>



                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Código Postal</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="cp_facturacion" id="cp_facturacion" type="text" value="<?php echo $datosFacturacion->cp_facturacion; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditCpFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_cp_facturacion" class="mensajeconfondo"></div>



                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Provincia</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <select class="provincia_gestor" name="provincia_facturacion" id="provincia_facturacion">
                                            <option value="-1">Provincia</option>
                                            <?php foreach ($listadoProvincias as $key => $value) { ?>
                                                <option value="<?php echo $value->id_provincia; ?>"<?php
                                                if (isset($provinciaMunicipioDatosFacturacion->provincias_id_provincia)){
                                                    echo $provinciaMunicipioDatosFacturacion->provincias_id_provincia == $value->id_provincia ? ' selected="selected"' : '';
                                                }
                                                        ?>>
                                                    <?php echo $value->nombre_provincia; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditProvinciaFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_provincia_facturacion" class="mensajeconfondo"></div>
                                <input name="id_provincia_facturacion" id="id_provincia_facturacion" type="hidden" value="<?php echo $provinciaMunicipioDatosFacturacion->provincias_id_provincia; ?>" disabled>



                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Municipio</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <select class="municipio_gestor" name="municipio_facturacion" id="municipio_facturacion">
                                            <option>Municipio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditMunicipioFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>                            
								<div id="mensaje_municipio_facturacion" class="mensajeconfondo"></div>    
                                <input name="id_localidad_facturacion" id="id_localidad_facturacion" type="hidden" value="<?php echo $provinciaMunicipioDatosFacturacion->id_localidad; ?>" disabled>




                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Correo electrónico facturación</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-envelope"></i>
                                        <input name="email_facturacion" id="email_facturacion" type="text" value="<?php echo $datosFacturacion->email_facturacion; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditEmailFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_email_facturacion" class="mensajeconfondo"></div>  



                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Periodo de facturación</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-calendar"></i>
                                        <input name="periodo_facturacion" id="periodo_facturacion" type="text" value="<?php echo $restauranteActual->creado_restaurante; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                </div>



                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Plan contratado</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-eur"></i>

                                        <select name="plan_contratado" id="plan_contratado">
                                            <option value="-1">Seleccione Plan</option>
                                            <option>----------------------------------------</option>
                                            <?php foreach ($listadoPlanes as $key => $value) { ?>
                                                <option value="<?php echo $value->id_plan; ?>"<?php
                                                if (isset($restauranteActual->nombre_plan)){
                                                    echo $restauranteActual->id_plan == $value->id_plan ? ' selected="selected"' : '';
                                                }
                                                        ?>><?php echo $value->nombre_plan; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditPlanContratadoFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_plan_facturacion" class="mensajeconfondo"></div> 


                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Forma de pago</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">

                                    <div class="form-input">
                                        <input type="radio" name="estructura"><label>Tarjeta</label>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="form-input">
                                        <input type="radio" name="estructura" checked><label>Cuenta bancaria</label>
                                    </div>

                                </div>
                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditBillingData">Modificar</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="clear"></div>
                                <div class="col-md-2">
                                    <label style="cursor: text;">Número de cuenta bancaria</label>
                                </div>
                                <div class="col-md-7 nodosfilas convertir9">
                                    <div class="form-input">
                                        <i class="fa fa-credit-card"></i>
                                        <input name="num_cuenta_facturacion" id="num_cuenta_facturacion" type="text" value="<?php echo $datosFacturacion->num_cuenta_facturacion; ?>">
                                    </div>
                                </div>

                                <div class="col-md-3 nodosfilas">
                                    <div class="form-input">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3" id="btnEditCuentaFacturacion">Modificar</a>
                                        </div>
                                    </div>
                                </div>
								<div id="mensaje_cuenta_facturacion" class="mensajeconfondo"></div> 

                            </div>

                        </div>
                    </article>









                    <article id="cupones" class="seccion-restaurante">
                        <h6>Cupones y descuentos</h6>
                        <p>A continuación se indican los cupones y descuentos vigentes en
                            el restaurante. Puede modificarlos o añadir más en la parte inferior.</p>
                        <div class="form-generico">

                            <div class="row" id="lista_cupones"></div>


                            <hr class="bordepunteadogris">
                            <div class="separadorpeq"></div>


                            <p>Añadir oferta o cupón:</p>
                            <div class="row">

                                    <div class="col-md-2">
                                        <label>Título</label>
                                    </div>
                                    <div class="col-md-10 nodosfilas convertir12">
                                        <div class="form-input">
                                            <i class="fa fa-pencil"></i> 
                                            <input name="titulo_cupon" id="titulo_cupon" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Descripción</label>
                                    </div>
                                    <div class="col-md-10 nodosfilas convertir12">
                                        <div class="form-input">
                                            <i class="fa fa-pencil"></i>
                                            <textarea name="descripcion_cupon" id="descripcion_cupon"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-2 nodosfilas">
                                        <label>Inicio promoción</label>
                                    </div>
                                    <div class="col-md-4 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-calendar"></i> 
                                            <input name="fecha_inicio_cupon" id="fecha_inicio_cupon" type="text" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-md-2 nodosfilas">
                                        <label>Fin promoción</label>
                                    </div>
                                    <div class="col-md-4 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-calendar"></i> 
                                            <input name="fecha_fin_cupon" id="fecha_fin_cupon" type="text" readonly="readonly">
                                        </div>
                                    </div>
                                    
									<div id="mensaje_anadir_cupon" class="mensajeconfondo"></div> 

                                    <div class="col-md-12 centrar">
                                        <input class="button-3 botonpeq" type="submit" id="btnAddCupon" value="Añadir">
                                    </div>

                            </div>

                        </div>
                    </article>












                    <article id="fotos" class="seccion-restaurante">
                        <h6>Fotos restaurante</h6>
                        <p>Estas son las fotos dadas de alta actualmente para este
                            restaurante:</p>
                        <div class="form-generico" id="listado_imagenes"></div>
                    </article>




                    <article id="soporte" class="seccion-restaurante">

                        <div class="mensajeexito addFormTipoMenu" id="sendMessageSupport" style="display:none;"></div>

                        <h6>Soporte técnico</h6>
                        <p>¿Tienes cualquier duda o consulta? Mándanosla a través de este formulario y te contestaremos lo antes posible:</p>
                        <div class="form-generico">
                        
                            <div class="row">
                                <div class="col-md-1">
                                    <label>Mensaje</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-input">
                                        <i class="fa fa-comment"></i>
                                        <textarea id="texto_mensaje_soporte" name="mensaje_soporte"></textarea>
                                    </div>
                                </div>

                                <div class="clear"></div>

                                <div id="mensaje_soporte" class="mensajeconfondo"></div>
                                <div class="separadorpeq"></div>
                                <div class="row centrar reducirfila">
                                    <input class="button-3 botonpeq" id="btnEmailSoporte" type="submit" value="Enviar">
                                </div>
                            </div>
                            
                        </div>
                    </article>


                </div>
                <!-- FIN Segunda columna 10/12 -->
            </div>
            <!-- FIN Row -->
        </div>
        <!-- FIN Container -->
    </div>
    <!-- FIN Sections -->


</section>
