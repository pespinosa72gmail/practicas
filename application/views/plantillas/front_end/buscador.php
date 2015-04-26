<!-- INICIO BUSCADOR -->
<section class="sections">
    <div class="container">
        <div class="row">
            <div class="col-md-2 centrar">
                <div class="animation" data-animate="wiggle">
                    <img id="logo" src="<?php echo base_url(); ?>assets/images/logo.png" alt="Todoslosmenus.com" />
                    <h2 class="slogan">Disfruta de tu mejor elección</h2>
                    <div class="gap"></div>
                </div>
            </div>

            <!--PESTAÑAS VERTICALES -->
            <div class="col-md-10">
                <article>
                    <h3 class="entradillaBuscador">Localiza fácilmente tu menú y el restaurante en el que vas a comer hoy.</h3>
                    <div class="dt-sc-tabs-vertical-container">
                        <ul class="dt-sc-tabs-vertical-frame">
                            <li><a href="#">Buscar por plato / tipo cocina </a></li>
                            <li><a href="#">Buscar por zona</a></li>
                            <li><a href="#">Buscar por restaurante </a></li>
                            <li>
                                <div class="botongeolocalizacion">
                                    <div class="checkbox-1">
                                        <input class="ocultar" type="checkbox" id="activar_geo" value="0" name="" />
                                        <label for="activar_geo"></label> 
                                        <span>Activar geolocalización</span>
                                    </div>
                                </div>
                            </li>
                        </ul>





                        <div class="dt-sc-tabs-vertical-frame-content" id="tab1">
                            <div class="form-home">

                                <form method="post" id="form-home-1" class="form-js" action="<?php echo base_url(); ?>buscador-plato">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-input">
                                                <i class="fa fa-cutlery"></i> 
                                                <input type="text" name="nombre_plato_1" id="nombre_plato_1" placeholder="¿Qué te apetece comer hoy? Ej. Paella, cocido ...">
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input">
                                                <i class="fa fa-cutlery"></i> 
                                                <select id="categoria_plato_1" name="categoria_plato_1">
                                                    <option value="">Categoría comida</option>
                                                    <?php foreach ($listadoCategorias as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_categoria; ?>">
                                                            <?php echo $value->nombre_categoria; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" class="autocompletar" name="localidad_1" id="localidad_1" placeholder="Localidad">

                                                <div class="contenido">
                                                    <div class="contenedor"></div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" name="zona_1" id="zona_1" placeholder="¿Dónde? Ej. Huertas, Gran Vía, ...">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" class="button-3" id="btnSendFormPlato" value="Buscar">
                                        </div>
                                    </div>
                                    <input type="hidden" name="geo_1" id="geo_1">
                                </form>
                            </div>
                        </div>
                        <!-- FIN form-home-1 -->


















                        <div class="dt-sc-tabs-vertical-frame-content" id="tab2" style="display: none">
                            <div class="form-home">
                                <form method="post" id="form-home-2" class="form-js" action="<?php echo base_url(); ?>buscador-zona">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <select id="provincia_2" name="provincia_2">
                                                    <option value="">Provincia</option>
                                                    <?php foreach ($listadoProvincias as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_provincia; ?>"><?php echo $value->nombre_provincia; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <select id="localidad_2" name="localidad_2">
                                                    <option value="">Localidad</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" name="cp_2" id="cp_2" placeholder="Código postal" />
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" name="direccion_2" id="direccion_2" placeholder="Calle, avenida, etc..." />
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" name="zona_2" id="zona_2" placeholder="Zona, barrio" />
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" name="punto_interes_2" id="punto_interes_2" placeholder="Punto de interés cercano, ej. Puerta de Alcalá" />
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <select id="metro_2" name="metro_2">
                                                    <option value="">Estación de Metro</option>
                                                    <?php foreach ($listadoEstaciones as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_estacion; ?>">
                                                            <?php echo $value->nombre_estacion; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" class="button-3" value="Buscar">
                                        </div>
                                    </div>
                                    <input type="hidden" name="geo_2" id="geo_2">
                                </form>
                            </div>
                            <!-- FIN form-home-2 -->
                        </div>














                        <div class="dt-sc-tabs-vertical-frame-content" id="tab3"
                             style="display: none">
                            <div class="form-home">
                                <form method="post" id="form-home-3" class="form-js" action="<?php echo base_url(); ?>buscador-restaurante">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <i class="fa fa-cutlery"></i> <input name="nombre_restaurante_3" id="nombre_restaurante" type="text" placeholder="Nombre restaurante">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <i class="fa fa-list"></i> 
                                                <select id="categoriaBusquedaRestaurantes" name="categoria_3">
                                                    <option value="">Categoría</option>
                                                    <?php foreach ($listadoCategorias as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_categoria; ?>">
                                                            <?php echo $value->nombre_categoria; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                        <div class="col-md-5">
                                            <div class="form-input">
                                                <i class="fa fa-star"></i> 
                                                <input name="especialidades_3" id="mail" type="text" placeholder="Especialidades / recomendaciones" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-input">
                                                <i class="fa fa-eur"></i>
                                                <select name="precio_carta_3">
                                                    <option value="">Precio carta</option>
                                                    <option value="1">Menos de 15€</option>
                                                    <option value="2">16-25€</option>
                                                    <option value="3">26-35€</option>
                                                    <option value="4">36-50€</option>
                                                    <option value="5">Más de 51€</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <i class="fa fa-eur"></i>
                                                <select name="precio_menu_3">
                                                    <option value="">Precio menú diario</option>
                                                    <option value="1">Menos de 7€</option>
                                                    <option value="2">Menos de 10€</option>
                                                    <option value="3">11-15€</option>
                                                    <option value="4">16-20€</option>
                                                    <option value="5">21-40€</option>
                                                    <option value="6">Más de 41 €</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" name="municipio_3" id="municipio" placeholder="Municipio" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-input">
                                                <i class="fa fa-map-marker"></i> 
                                                <input type="text" name="zona_3" id="zona_3" placeholder="¿Dónde? Ej. Huertas, Gran Vía, ..." />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <input name="parking_3" type="checkbox"><label>Con parking</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <input name="fotos_3" type="checkbox"><label>Con foto(s)</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <input name="actualizan_menu_3" type="checkbox"><label>Actualizan su menú</label>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <input name="con_descuentos_3" type="checkbox"><label>Con descuentos</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <input name="permiten_reservas_3" type="checkbox"><label>Permiten reservas</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-input">
                                                <input name="permiten_tarjeta_3" type="checkbox"><label>Permiten pago con tarjeta</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="submit" class="button-3" value="Buscar">
                                        </div>
                                    </div>
                                    <input type="hidden" name="geo_3" id="geo_3">
                                </form>
                            </div>
                            <!-- FIN form-home-3 -->
                        </div>
                    </div>
                    <!--FIN PESTAÑAS VERTICALES-->
                </article>
            </div>
            <!-- FIN row -->
        </div>
        <!-- FIN container -->
</section>
<!-- FIN sections -->
<!-- FIN BUSCADOR-->