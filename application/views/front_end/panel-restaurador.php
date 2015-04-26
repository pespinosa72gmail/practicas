<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/panel.restaurador.js"></script>
<section class="one-page-panelcontrol">

    <div class="sections">
        <div class="container">
            <div class="row">
                <!-- Primera columna 2/12 -->
                <div class="col-md-3">
                    <div class="widget">
                        <div class="widget-title"><h6>MenÃº</h6></div>
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
                        <h6>SelecciÃ³n de restaurante</h6>
                        <p>SelecciÃ³n actual: 
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
                                                        <div><strong>CategorÃ­a</strong>: <?php echo isset($value->nombre_categoria) ? $value->nombre_categoria : ''; ?></div>
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
                                        <div class="enlacesencillo"><a href="panelcontrol_restaurador2.php">Alta de nuevo restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a></div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_restaurante" id="id_restaurante">
                                <input type="hidden" name="id_propietario" id="id_propietario" value="<?php echo $id_propietario ?>">
                            </form>

                            <div class="clear"></div>
                        </div>
                    </article>



                    <article id="gestiontipos" class="seccion-restaurante">
                        <h6>Tipos de menÃº</h6>
                        <p>A continuaciÃ³n se indican los tipos de menÃºs que tiene asociados el restaurante. Puede aÃ±adir mÃ¡s en la parte inferior.</p>
                        <p>En todos ellos, podrÃ¡ indicar en la secciÃ³n "Gestionar menÃºs" si incluyen <strong>cafÃ©, bebida y postre</strong>.</p>
                        <div class="form-generico">

                            <div class="row" id="listado-tipos-menu">

                                <?php //if ($listadoMenus) { ?>

                                <?php //foreach ($listadoMenus as $key => $value) { ?>
                                <!-- <div class="col-md-9 nodosfilas">
                                     <div class="form-input">
                                         <i class="fa fa-pencil"></i>
                                         <input name="name" id="name" type="text" value="<?php //echo $value->nombre_menu;     ?>" disabled>
                                     </div>
                                 </div>
                                 <div class="col-md-3 nodosfilas">
                                     <div class="form-input">
                                         <div class="callout-a ">
                                             <a href="<?php //echo base_url();     ?>acceso/restaurador/eliminar-tipo-menu?clave_menu=<?php //echo $value->id_menu;     ?>&clave_restaurante=<?php //echo $value->restaurantes_id_restaurante;     ?>" class="button-3">Eliminar</a>
                                         </div>
                                     </div>
                                 </div>
                                -->
                                <?php //} ?>

                                <?php //} else { ?>
                                <!--
                                                                    <div class="col-md-12 nodosfilas">
                                                                        <div class="form-input">
                                                                            <p style="text-align: center;">Actualmente no tienes ningÃºn menÃº aÃ±adido.</p>
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
                                            <input name="nombre_menu" id="nombre_menu" type="text" placeholder="Introduce un nombre, Ej. MenÃº fin de semana">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-3">
                                        <label>Estructura</label>
                                    </div>

                                    <div class="col-md-9 nodosfilas convertir12">
                                        <div class="form-input">
                                            <input type="radio" name="estructura_menu" id="estructura_menu" value="1">
                                            <label>Primeros + Segundos (típico menú del día)</label>
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
                                                                                                        <input name="calendario" id="calendario_menu<?php //echo $codigo;            ?>" type="text" value="<?php echo $value->fecha_dia_menu; ?>" placeholder="dd/mm/aaaa">
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
                                                                                                <h3>SelecciÃ³n de menÃºs habituales</h3>
                                                                                                <p>Si lo prefieres, puedes seleccionar uno de tus menÃºs guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>
                                    
                                    
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
                                                                                                                            <p>Actualmente no tienes ningÃºn menÃº dado de alta.</p>
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
                                                                                                                                                        <input value="<?php echo $primero->nombre_primeros_menu ?>" name="primeros_menu_estructura[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">
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
                                                                                                                                    <input name="primeros_menu_estructura[]" class="input-class" id="primeros_menu_estructura" type="text" placeholder="AÃ±adir plato">
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
                                                                                                    <a href="#" id="addInputPrimeros">AÃ±adir mÃ¡s primeros<span><i class="fa fa-arrow-circle-right"></i></span></a>
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
                                                                                                                                                        <input value="<?php echo $segundo->nombre_segundo_menu ?>" name="segundos_menu_estructura[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">
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
                                                                                                                                    <input name="segundos_menu_estructura[]" id="segundos_menu_estructura" type="text" placeholder="AÃ±adir plato">
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
                                                                                                    <a href="#" id="addInputSegundos">AÃ±adir mÃ¡s segundos<span><i class="fa fa-arrow-circle-right"></i></span></a>
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
                                                                                                                        <input type="checkbox" name="cafe_menu" id="cafe_menu"checked><label>Con cafÃ©</label>
                                        <?php } else { ?>
                                                                                                                        <input type="checkbox" name="cafe_menu" id="cafe_menu"><label>Con cafÃ©</label>
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
                                                                                            <p class="reducirfila">Â¿Este menÃº lo vas a reutilizar a
                                                                                                menudo? Ponle un nombre y dale a "Guardar como menÃº habitual"</p>
                                                                                            <div class="col-md-8 nodosfilas">
                                                                                                <div class="form-input">
                                                                                                    <i class="fa fa-cutlery"></i> <input name="nombre_menu_habitual" id="nombre_menu_habitual" type="text" placeholder="Ej. MenÃº de los lunes, MenÃº arroces, etc...">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4 nodosfilas">
                                                                                                <div class="form-input">
                                                                                                    <div class="callout-a ">
                                                                                                        <a href="#" id="btnAddMenuHabitual" class="button-3">Guardar como menÃº habitual</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                    
                                    
                                                                                        </div>
                                                                                        <div class="separadorpeq"></div>
                                                                                        <div class="row centrar reducirfila">
                                                                                            <input class="button-3 botonpeq" id="btnAddPlateMenu2" type="submit" value="Actualizar menÃº">
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
                                                                                                <h3>SelecciÃ³n de menÃºs habituales</h3>
                                                                                                <p>Si lo prefieres, puedes seleccionar uno de tus menÃºs guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>
                                    
                                    
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6">
                                                                                                        <label>
                                                                                                            <a href="#">MenÃº de los lunes&nbsp;
                                                                                                                <i class="fa fa-check-circle"></i>
                                                                                                            </a>&nbsp;
                                    
                                                                                                            <a href="#">
                                                                                                                <i class="fa fa-times-circle"></i>
                                                                                                            </a>
                                                                                                        </label>
                                                                                                    </div>
                                    
                                                                                                    <div class="col-md-6">
                                                                                                        <label>
                                                                                                            <a href="#">MenÃº de los lunes&nbsp;
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
                                                                                                    <a href="#">AÃ±adir mÃ¡s primeros<span><i
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
                                                                                                    <a href="#">AÃ±adir mÃ¡s primeros<span><i
                                                                                                                class="fa fa-arrow-circle-right"></i></span></a>
                                                                                                </div>
                                                                                            </div>
                                    
                                    
                                    
                                    
                                                                                            <div class="col-md-6 dosfilas">
                                                                                                <h5>SEGUNDOS</h5>
                                    
                                        <?php for ($i = 0; $i < 3; $i++) { ?>
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-md-10 nodosfilas">
                                                                                                                            <div class="form-input">
                                                                                                                                <i class="fa fa-cutlery"></i> <input name="name" id="name" type="text" value="JudÃ­as verdes con tomate" disabled>
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
                                                                                                    <a href="#">AÃ±adir mÃ¡s segundos<span><i
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
                                                                                                                        <input type="checkbox" name="cafe_menu" id="cafe_menu"checked><label>Con cafÃ©</label>
                                        <?php } else { ?>
                                                                                                                        <input type="checkbox" name="cafe_menu" id="cafe_menu"><label>Con cafÃ©</label>
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
                                                                                            <p class="reducirfila">Â¿Este menÃº lo vas a reutilizar a
                                                                                                menudo? Ponle un nombre y dale a "Guardar como menÃº habitual"</p>
                                                                                            <div class="col-md-8 nodosfilas">
                                                                                                <div class="form-input">
                                                                                                    <i class="fa fa-cutlery"></i> <input name="name" id="name"
                                                                                                                                         type="text"
                                                                                                                                         placeholder="Ej. MenÃº de los lunes, MenÃº arroces, etc...">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4 nodosfilas">
                                                                                                <div class="form-input">
                                                                                                    <div class="callout-a ">
                                                                                                        <a href="#" class="button-3">Guardar como menÃº habitual</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="separadorpeq"></div>
                                                                                        <div class="row centrar reducirfila">
                                                                                            <input class="button-3 botonpeq" type="submit" value="Actualizar menÃº">
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
                                                                                                <h3>SelecciÃ³n de menÃºs habituales</h3>
                                                                                                <p>Si lo prefieres, puedes seleccionar uno de tus menÃºs guardados para no teclearlos de nuevo. Sobre ellos puedes modificar lo que quieras:</p>
                                    
                                    
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6">
                                                                                                        <label>
                                                                                                            <a href="#">MenÃº de los lunes&nbsp;
                                                                                                                <i class="fa fa-check-circle"></i>
                                                                                                            </a>&nbsp;
                                    
                                                                                                            <a href="#">
                                                                                                                <i class="fa fa-times-circle"></i>
                                                                                                            </a>
                                                                                                        </label>
                                                                                                    </div>
                                    
                                                                                                    <div class="col-md-6">
                                                                                                        <label>
                                                                                                            <a href="#">MenÃº de los lunes&nbsp;
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
                                                                                                    <a href="#">AÃ±adir mÃ¡s primeros<span><i
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
                                                                                                    <a href="#">AÃ±adir mÃ¡s primeros<span><i
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
                                                                                                                        <input type="checkbox" name="cafe_menu" id="cafe_menu"checked><label>Con cafÃ©</label>
                                        <?php } else { ?>
                                                                                                                        <input type="checkbox" name="cafe_menu" id="cafe_menu"><label>Con cafÃ©</label>
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
                                                                                            <p class="reducirfila">Â¿Este menÃº lo vas a reutilizar a
                                                                                                menudo? Ponle un nombre y dale a "Guardar como menÃº habitual"</p>
                                                                                            <div class="col-md-8 nodosfilas">
                                                                                                <div class="form-input">
                                                                                                    <i class="fa fa-cutlery"></i> <input name="name" id="name"
                                                                                                                                         type="text"
                                                                                                                                         placeholder="Ej. MenÃº de los lunes, MenÃº arroces, etc...">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4 nodosfilas">
                                                                                                <div class="form-input">
                                                                                                    <div class="callout-a ">
                                                                                                        <a href="#" class="button-3">Guardar como menÃº habitual</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="separadorpeq"></div>
                                                                                        <div class="row centrar reducirfila">
                                                                                            <input class="button-3 botonpeq" type="submit"
                                                                                                   value="Actualizar menÃº">
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
                                                    <a href="#">MenÃº ejecutivo<i class="fa fa-minus"></i></a>
                                            </h4>
                                            <div class="accordion-inner"></div>
                                    </div>
                                    <div class="section-content">
                                            <h4 class="accordion-title">
                                                    <a href="#">MenÃº fin de semana<i class="fa fa-minus"></i></a>
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
                                            <input name="password_propietario" id="pass_propietario" type="text" placeholder="Escribe tu nueva contraseÃ±a si quieres cambiarla">
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
                                                <option value="1" <?php $restauranteActual->precio_carta_restaurante == 1 ? 'selected' : '' ?>>Menos de 15€</option>
                                                <option value="2" <?php $restauranteActual->precio_carta_restaurante == 2 ? 'selected' : '' ?>>16-25€</option>
                                                <option value="3" <?php $restauranteActual->precio_carta_restaurante == 3 ? 'selected' : '' ?>>26-35€</option>
                                                <option value="4" <?php $restauranteActual->precio_carta_restaurante == 4 ? 'selected' : '' ?>>36-50€</option>
                                                <option value="5" <?php $restauranteActual->precio_carta_restaurante == 5 ? 'selected' : '' ?>>Más de 51€</option>
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
                                            <input name="file" id="file" type="file">
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
                                            <span class="restauranteseleccionado">
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
                                                        <option value="<?php echo $value->id_categoria; ?>" <?php $restauranteActual->categorias_id_categoria == $value->id_categoria ? 'selected' : ''; ?>>
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
                                                        <option value="<?php echo $value->id_categoria; ?>"  <?php $restauranteActual->segunda_categoria_restaurante == $value->id_categoria ? 'selected' : ''; ?>>
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
                                                        <option value="<?php echo $value->id_categoria; ?>"  <?php $restauranteActual->tercera_categoria_restaurante == $value->id_categoria ? 'selected' : ''; ?>>
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
                                <div id="lista-especialidades" class="row">
                                    <!--<div class="mensajeexito editFormEspecialidades" style="display:none;"></div>-->

                                    <?php if ($listadoEspecialidades) { ?>
                                        <?php foreach ($listadoEspecialidades as $key => $value) { ?>
                                            <div class="col-md-9 nodosfilas">
                                                <div class="form-input">
                                                    <i class="fa fa-cutlery"></i>
                                                    <input name="nombre_especilidad" id="nombre_especilidad" type="text" value="<?php echo $value->nombre_especialidad; ?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-3 nodosfilas">
                                                <div class="form-input">
                                                    <div class="callout-a ">
                                                        <a href="<?php echo base_url(); ?>acceso/restaurador/eliminar-especialidad?clave=<?php echo $value->clave_especialidad; ?>" class="button-3">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="col-md-9 nodosfilas">
                                            <div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">
                                                <p>Actualmente no has aÃ±adido ninguna especialidad a tu restaurante</p>
                                            </div>
                                        </div>
                                    <?php } ?>



                                    <div id="mensaje_especialidad" class="mensajeconfondo"></div>                                                                                
                                    <div class="col-md-9 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-cutlery"></i>
                                            <input name="select_nombre_especialidad" id="select_nombre_especialidad" type="text" Placeholder="AÃ±adir otra especialidad">
                                        </div>
                                    </div>

                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnAddEspecialtiesForm">AÃ±adir</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>



















                                <hr class="bordepunteadogris">

















                                <div class="separadorpeq"></div>
                                <h6>Puntos de interÃ©s</h6>
                                <div class="row">
                                    <div class="mensajeexito editFormPuntoInteres" style="display:none;"></div>

                                    <?php if ($listadoPuntosInteres) { ?>
                                        <?php foreach ($listadoPuntosInteres as $key => $value) { ?>
                                            <div class="col-md-9 nodosfilas">
                                                <div class="form-input">
                                                    <i class="fa fa-map-marker"></i>
                                                    <input name="nombre_punto_cercano" id="nombre_punto_cercano" type="text" value="<?php echo $value->nombre_punto_cercano; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3 nodosfilas">
                                                <div class="form-input">
                                                    <div class="callout-a">
                                                        <a href="<?php echo base_url(); ?>acceso/restaurador/eliminar-puntos-interes?pinteres=<?php echo $value->clave_punto_cercano; ?>" class="button-3" id="btnDeletePInteres">Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="col-md-9 nodosfilas">
                                            <div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">
                                                <p>Actualmente no has aÃ±adido ningun punto cercano a tu restaurante</p>
                                            </div>
                                        </div>
                                    <?php } ?>



                                    <div class="col-md-9 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="select_nombre_punto_cercano" id="select_nombre_punto_cercano" type="text" Placeholder="AÃ±adir otro punto de interÃ©s">
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnAddPuntoInteres">AÃ±adir</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>












                                <hr class="bordepunteadogris">
                                <div class="separadorpeq"></div>
                                <h6>Estaciones de metro</h6>
                                <div class="row">

                                    <div class="mensajeexito addFormEstacion" style="display:none;"></div>

                                    <?php if ($listadoEstacionesRestaurante) { ?>

                                        <?php foreach ($listadoEstacionesRestaurante as $key => $value) { ?>
                                            <div class="col-md-9 nodosfilas">
                                                <div class="form-input">
                                                    <i class="fa fa-map-marker"></i>
                                                    <input type="text" name="estacion_restaurante" id="estacion_restaurante" value="<?php echo $value->nombre_rel_estacion_restaurante; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3 nodosfilas">
                                                <div class="form-input">
                                                    <div class="callout-a "><a href="#" class="button-3">Eliminar</a></div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    <?php } else { ?>
                                        <div class="col-md-9 nodosfilas">
                                            <div class="form-input" style="text-align: center; margin: 20px 0 40px 0;">
                                                <p>Actualmente no has aÃ±adido ninguna estaciÃ³n cercana a tu restaurante</p>
                                            </div>
                                        </div>
                                    <?php } ?>



                                    <div class="col-md-9 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <select name="nombre_estacion" id="nombre_estacion">
                                                <option>AÃ±adir estaciÃ³n</option>
                                                <option>------------------</option>

                                                <?php foreach ($listadoEstaciones as $key => $value) { ?>
                                                    <option><?php echo $value->nombre_estacion; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnAddEstacion">AÃ±adir</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo $restauranteActual->clave_restaurante; ?>">
                                <input type="hidden" name="id_restaurantes" id="id_restaurantes" value="<?php echo $restauranteActual->id_restaurante; ?>">
                            </form>



                        </div>
                    </article>


































                    <article id="facturacion" class="seccion-restaurante">
                        <h6>Datos facturaciÃ³n</h6>
                        <div class="form-generico">


                            <form method="post" id="form-1" name="formularioFacturacion">
                                <div class="row">

                                    <div class="mensajeexito editFormRazonSocial" style="display:none;"></div>


                                    <div class="col-md-2">
                                        <label>RazÃ³n Social</label>
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
                                                <a href="#" class="button-3" id="btnEditBillingData">Modificar</a>
                                            </div>
                                        </div>
                                    </div>







                                    <!-- Revisar -->
                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>CIF / NIF</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-user"></i>
                                            <input name="cif_facturacion" id="cif_facturacion" type="text" placeholder="Poner NIF / CIF - FacturaciÃ³n">
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
                                        <label>Calle</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="direccion_facturacion" id="direccion_facturacion" type="text" value="<?php echo $datosFacturacion->direccion_facturacion; ?>">
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
                                        <label>NÃºmero</label>
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
                                                <a href="#" class="button-3" id="btnEditBillingData">Modificar</a>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>CÃ³digo Postal</label>
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
                                                <a href="#" class="button-3" id="btnEditBillingData">Modificar</a>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Municipio</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-map-marker"></i>
                                            <input name="name" id="name" type="text" class="clarito" value="<?php echo $dameCpDatosFacturacion->nombre_localidad; ?>" disabled>
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
                                            <input name="name" id="name" type="text" class="clarito" value="<?php echo $dameCpDatosFacturacion->nombre_provincia; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <span class="nota">Asociado al CP</span>
                                    </div>



                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Correo electrÃ³nico facturaciÃ³n</label>
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
                                                <a href="#" class="button-3" id="btnEditBillingData">Modificar</a>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Periodo de facturaciÃ³n</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-calendar"></i>
                                            <input name="periodo_facturacion" id="periodo_facturacion" type="text" value="<?php echo $datosFacturacion->periodo_facturacion; ?>" disabled>
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
                                        <label>Plan contratado</label>
                                    </div>
                                    <div class="col-md-7 nodosfilas convertir9">
                                        <div class="form-input">
                                            <i class="fa fa-eur"></i>

                                            <select name="plan_contratado" id="plan_contratado">
                                                <option value="<?php echo $restauranteActual->id_plan; ?>"><?php echo $restauranteActual->nombre_plan; ?></option>
                                                <option>----------------------------------------</option>
                                                <?php foreach ($listadoPlanes as $key => $value) { ?>
                                                    <option value="<?php echo $value->id_plan; ?>"><?php echo $value->nombre_plan; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-3 nodosfilas">
                                        <div class="form-input">
                                            <div class="callout-a ">
                                                <a href="#" class="button-3" id="btnEditPlanContratado">Modificar</a>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="clear"></div>
                                    <div class="col-md-2">
                                        <label>Forma de pago</label>
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
                                        <label>NÃºmero de cuenta bancaria</label>
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
                                                <a href="#" class="button-3" id="btnEditBillingData">Modificar</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clear"></div>

                                </div>


                                <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo $restauranteActual->clave_restaurante; ?>">
                                <input type="hidden" name="id_restaurantes" id="id_restaurantes" value="<?php echo $restauranteActual->id_restaurante; ?>">

                            </form>


                        </div>
                    </article>


























                    <article id="cupones" class="seccion-restaurante">
                        <h6>Cupones y descuentos</h6>
                        <p>A continuaciÃ³n se indican los cupones y descuentos vigentes en
                            el restaurante. Puede modificarlos o aÃ±adir mÃ¡s en la parte inferior.</p>
                        <div class="form-generico">

                            <form method="post" id="form-1" action="<?php echo base_url(); ?>acceso/restaurador/editar-cupon">
                                <div class="row">

                                    <div class="mensajeexito editFormRazonSocial" style="display:none;"></div>

                                    <?php foreach ($listadoCuponesRestaurate as $key => $value) { ?>
                                        <div class="col-md-6">
                                            <div class="callout">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>TÃ­tulo</label>
                                                    </div>
                                                    <div class="col-md-9 nodosfilas convertir12">
                                                        <div class="form-input">
                                                            <i class="fa fa-pencil"></i> 
                                                            <input name="select_titulo_cupon" id="select_titulo_cupon" type="text" value="<?php echo $value->titulo_cupon; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label>DescripciÃ³n</label>
                                                    </div>
                                                    <div class="col-md-9 nodosfilas convertir12">
                                                        <div class="form-input">
                                                            <i class="fa fa-pencil"></i>
                                                            <textarea name="select_descripcion_cupon" id="select_descripcion_cupon"><?php echo $value->descripcion_cupon; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Inicio promociÃ³n</label>
                                                    </div>
                                                    <div class="col-md-9 nodosfilas convertir12">
                                                        <div class="form-input">
                                                            <i class="fa fa-calendar"></i> 
                                                            <input name="select_fecha_inicio_cupon" id="select_fecha_inicio_cupon" type="text" value="<?php echo $value->fecha_inicio_cupon; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Fin promociÃ³n</label>
                                                    </div>
                                                    <div class="col-md-9 nodosfilas convertir12">
                                                        <div class="form-input">
                                                            <i class="fa fa-calendar"></i> 
                                                            <input name="select_fecha_fin_cupon" id="select_fecha_fin_cupon" type="text" value="<?php echo $value->fecha_fin_cupon; ?>">
                                                        </div>
                                                    </div>

                                                    <!--
                                                    <div class="col-md-6 nodosfilas">
                                                            <input class="button-4" type="submit" value="Eliminar">
                                                    </div>
                                                    -->

                                                    <div class="col-md-6 nodosfilas">
                                                        <a href="<?php echo base_url(); ?>acceso/restaurador/eliminar-cupon?clave_cupon=<?php echo $value->clave_cupon; ?>" class="button-4" style="text-align:center;">Eliminar</a>
                                                    </div>



                                                    <div class="col-md-6 nodosfilas">
                                                        <input class="button-3" type="submit" value="Modificar">
                                                    </div>



                                                    <input type="hidden" name="clave_cupon" id="clave_cupon" value="<?php echo $value->clave_cupon; ?>">
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </form>




                            <div class="separadorpeq"></div>
                            <hr class="bordepunteadogris">
                            <div class="separadorpeq"></div>



                            <p>AÃ±adir oferta o cupÃ³n:</p>
                            <div class="row">

                                <div class="mensajeexito addFormCupon" style="display:none;"></div>

                                <form method="POST">
                                    <div class="col-md-2">
                                        <label>TÃ­tulo</label>
                                    </div>
                                    <div class="col-md-10 nodosfilas convertir12">
                                        <div class="form-input">
                                            <i class="fa fa-pencil"></i> 
                                            <input name="titulo_cupon" id="titulo_cupon" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>DescripciÃ³n</label>
                                    </div>
                                    <div class="col-md-10 nodosfilas convertir12">
                                        <div class="form-input">
                                            <i class="fa fa-pencil"></i>
                                            <textarea name="descripcion_cupon" id="descripcion_cupon"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-2 nodosfilas">
                                        <label>Inicio promociÃ³n</label>
                                    </div>
                                    <div class="col-md-4 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-calendar"></i> 
                                            <input name="fecha_inicio_cupon" id="fecha_inicio_cupon" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-2 nodosfilas">
                                        <label>Fin promociÃ³n</label>
                                    </div>
                                    <div class="col-md-4 nodosfilas">
                                        <div class="form-input">
                                            <i class="fa fa-calendar"></i> 
                                            <input name="fecha_fin_cupon" id="fecha_fin_cupon" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12 centrar">
                                        <input class="button-3 botonpeq" type="submit" id="btnAddCupon" value="AÃ±adir">
                                    </div>

                                    <input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo $restauranteActual->clave_restaurante; ?>">
                                    <input type="hidden" name="id_restaurantes" id="id_restaurantes" value="<?php echo $restauranteActual->id_restaurante; ?>">

                                </form>
                            </div>



                        </div>
                    </article>












                    <article id="fotos" class="seccion-restaurante">
                        <h6>Fotos restaurante</h6>
                        <p>Estas son las fotos dadas de alta actualmente para este
                            restaurante:</p>
                        <div class="form-generico">
                            <form method="post" id="form-1" action="#">
                                <div class="row portfolio-all portfolio-0 ajustaralto">
                                    <ul>

                                        <?php if ($listadoImagenes) { ?>



                                            <?php foreach ($listadoImagenes as $key => $value) { ?>
                                                <li class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
                                                    <div class="portfolio-one rellenarfondo">
                                                        <div class="portfolio-head">
                                                            <div class="portfolio-img">
                                                                <img alt="" src="<?php echo base_url(); ?>assets/img_restaurantes/<?php echo $value->thumbnails_imagen; ?>.<?php echo $value->extension_imagen; ?>">
                                                            </div>
                                                            <div class="portfolio-hover">
                                                                <div class="portfolio-meta">
                                                                    <div class="portfolio-name">

                                                                        <div class="form-input">
                                                                            <i class="fa fa-pencil"></i> 
                                                                            <input name="name" id="name" type="text" value="SalÃ³n">
                                                                        </div>
                                                                        <div class="form-input">
                                                                            <?php if ($value->principal_imagen == 1) { ?>
                                                                                <input type="checkbox" name="principal_imagen" id="principal_imagen" checked="checked"><label>Principal</label>
                                                                            <?php } else { ?>
                                                                                <input type="checkbox" name="principal_imagen" id="principal_imagen"><label>Principal</label>
                                                                            <?php } ?>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <!-- End portfolio-meta -->
                                                                <a class="portfolio-link" href="#"><i class="fa fa-times"></i></a>
                                                                <a class="portfolio-zoom prettyPhoto"
                                                                   href="<?php echo base_url(); ?>assets/img_restaurantes/<?php echo $value->nombre_imagen; ?>"><i
                                                                        class="fa fa-search"></i></a>
                                                            </div>
                                                        </div>
                                                        <!-- End portfolio-head -->
                                                    </div>
                                                    <!-- End portfolio-item -->
                                                </li>
                                            <?php } ?>




                                        <?php } else { ?>
                                            <li class="col-md-12 portfolio-item portfolio-item-2 isotope-item">
                                                <p style="text-align: center;">No hay imÃ¡genes</p>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                </div>

                                <div class="row centrar reducirfila">
                                    <input class="button-3 botonpeq" type="submit" value="Guardar cambios">
                                </div>

                                <div class="separadorpeq"></div>

                                <!--
                                <div class="row centrar reducirfila">
                                        <input class="button-4 botonpeq" type="button" id="addImagen" value="AÃ±adir mÃ¡s fotos">
                                </div>
                                -->

                                <div class="row centrar reducirfila">
                                    <a href="<?php echo base_url(); ?>acceso/restaurador/alta-imagenes?id_restaurante=<?php echo $restauranteActual->id_restaurante; ?>" class="button-4 botonpeq" style="text-align:center;">AÃ±adir mÃ¡s fotos</a>
                                </div>

                            </form>
                        </div>
                    </article>




                    <article id="soporte" class="seccion-restaurante">

                        <div class="mensajeexito addFormTipoMenu" id="sendMessageSupport" style="display:none;"></div>

                        <h6>Soporte tÃ©cnico</h6>
                        <p>Â¿Tienes cualquier duda o consulta? MÃ¡ndanosla a travÃ©s de este formulario y te contestaremos lo antes posible:</p>
                        <div class="form-generico">
                            <form method="post" id="form-1" action="#">
                                <div class="row">
                                    <div class="col-md-1">
                                        <label>Mensaje</label>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-input">
                                            <i class="fa fa-comment"></i>
                                            <textarea id="mensaje_soporte" name="mensaje_soporte"></textarea>
                                        </div>
                                    </div>

                                    <div class="clear"></div>

                                    <div class="separadorpeq"></div>
                                    <div class="row centrar reducirfila">
                                        <input class="button-3 botonpeq" id="btnSubmitMessageSupport" type="submit" value="Enviar">
                                    </div>
                                </div>
                            </form>
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
