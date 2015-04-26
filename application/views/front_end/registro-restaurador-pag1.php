<!--<script src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registro.restaurador.1.js"></script>
<section>

    <div class="sections">
        <div class="container">
            <div class="row reducirfila">

                <article id="registro_user" class="seccion-restaurante">
                    <h5>Registro de nuevo restaurante</h5>

                    <h6>En sólo tres pasos tu restaurante tendrá más visibilidad en internet.</h6>

                    <span class="restauranteseleccionado">Paso 1 - Datos principales restaurante</span>

                    <div class="separadorpeq"></div>
                    <div class="form-generico">
                        <form method="post" id="registro_restaurador_form" action="<?php echo base_url() ?>registro-restaurador/plan-premium/pag-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nombre comercial del restaurante</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i>
                                        <input name="nombre_restaurante" id="nombre_restaurante_form" class="nombre_restaurante" type="text" value="<?php echo isset($nombre_restaurante) ? $nombre_restaurante : '' ?>" />
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Calle</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="calle_restaurante" id="calle_restaurante" class="calle_restaurante" type="text" value="<?php echo isset($calle_restaurante) ? $calle_restaurante : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Número</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="numero_restaurante" id="numero_restaurante" class="numero_restaurante" type="text" value="<?php echo isset($numero_restaurante) ? $numero_restaurante : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Código postal</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="cp_restaurante" id="cp_restaurante" class="cp_restaurante" type="text" value="<?php echo isset($cp_restaurante) ? $cp_restaurante : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Municipio</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="municipio_restaurante" id="municipio_restaurante" class="municipio_restaurante" type="text" class="clarito" value="<?php echo isset($municipio_restaurante) ? $municipio_restaurante : 'Asociado al CP' ?>" disabled>
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Provincia</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="provincia_restaurante" id="provincia_restaurante" class="provincia_restaurante" type="text" class="clarito" value="<?php echo isset($provincia_restaurante) ? $provincia_restaurante : 'Asociado al CP' ?>" disabled>
                                    </div>
                                </div>

                                <div class="reducirfila nota"><span>(*):</span>Todos los campos son obligatorios.1
                                </div>
                                <div class="clear"></div>
                                <div class="separadorpeq"></div>
                                <div class="row centrar reducirfila">
                                    <input class="button-4 botonpeq" id="comprobar_ubicacion" type="submit" value="Comprobar ubicación del restaurante">
                                    <input style="display:none;" id="paso_siguiente_pag1" class="button-3 botonpeq" type="submit" value="Paso siguiente">
                                </div>
                                <input id="latlong_restaurante" type="hidden" name="latlong_restaurante" value="">
                                <input id="id_restaurante" type="hidden" name="id_restaurante" value="<?php echo isset($id_restaurante) ? $id_restaurante : '' ?>">
                                <input id="id_gestor" type="hidden" name="id_gestor" value="<?php echo isset($id_gestor) ? $id_gestor : '' ?>">
                                <input id="id_plan" type="hidden" name="id_plan" value="<?php echo isset($id_plan) ? $id_plan : '' ?>">
                                <div class="mensajeexito" style="display:none;">
                                </div>

                            </div>	
                        </form>
                    </div>


                </article>

            </div><!-- FIN Row -->
        </div><!-- FIN Container -->
    </div><!-- FIN Sections -->


</section>
