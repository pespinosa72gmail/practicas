<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registro.restaurador.2.js"></script>
<section>

    <div class="sections">
        <div class="container">
            <div class="row reducirfila">

                <article id="registro_user" class="seccion-restaurante">
                    <h5>Registro de nuevo restaurante</h5>

                    <span class="restauranteseleccionado">Paso 2 - Datos usuario gestor del restaurante</span>

                    <div class="separadorpeq"></div>
                    <div class="form-generico">
                        <form method="post" id="registro_restaurador_form2" action="<?php echo base_url() ?>registro-restaurador/plan-premium/pag-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nombre (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i>
                                        <input name="nombre_gestor" class="nombre_gestor" type="text" value="<?php echo isset($nombre_gestor) ? $nombre_gestor : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Apellidos (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i>
                                        <input name="apellidos_gestor" class="apellidos_gestor" type="text" value="<?php echo isset($apellidos_gestor) ? $apellidos_gestor : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Correo electrónico (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-envelope"></i>
                                        <input name="email_gestor" class="email_gestor" type="text" value="<?php echo isset($email_gestor) ? $email_gestor : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Contraseña (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-key"></i>
                                        <input name="password_gestor" class="password_gestor" type="password" value="<?php echo isset($password_gestor) ? $password_gestor : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Repetir contraseña (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-key"></i>
                                        <input name="password_gestor2" class="password_gestor2" type="password" value="<?php echo isset($password_gestor) ? $password_gestor : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Teléfono</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-phone"></i>
                                        <input name="telefono_gestor" class="telefono_gestor" type="text" value="<?php echo isset($telefono_gestor) ? $telefono_gestor : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Código postal (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="cp_gestor" class="cp_gestor" type="text" value="<?php echo isset($cp_gestor) ? $cp_gestor : '' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Provincia</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <!--<input name="municipio_gestor" class="municipio_gestor" type="text" class="clarito" value="">-->
                                        <select class="provincia_gestor" name="provincia_gestor">
                                            <option>Provincia</option>
                                            <?php foreach ($listadoProvincias as $key => $value) { ?>
                                                <option value="<?php echo $value->id_provincia; ?>" <?php
                                                if (isset($provincia_gestor)){
                                                    echo $provincia_gestor == $value->id_provincia ? 'selected' : '';
                                                }
                                                        ?>>
                                                    <?php echo $value->nombre_provincia; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Municipio</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <!--<input name="municipio_gestor" class="provincia_gestor" type="text" class="clarito" value="Asociado al CP" disabled>-->
                                        <select class="municipio_gestor" name="municipio_gestor">
                                            <option>Municipio</option>
                                        </select>

                                    </div>
                                </div>

                            </div>


                            <div class="reducirfila nota"><span>(*):</span>Los campos marcados con asterisco son obligatorios.<br>El password debe tener entre 6 y 8 caracteres, y tener mínimo un número, una letra, y una mayúscula.
                            </div>

                            <div class="clear"></div>
                            <div class="separadorpeq"></div>
                            <div class="row centrar reducirfila">
                                <input class="button-4 botonpeq" id="paso_anterior_2" type="button" value="Paso anterior">
                                <input type="hidden" name="id_gestor" value="<?php echo isset($id_gestor) ? $id_gestor : '' ?>">
                                <input type="hidden" name="id_restaurante" value="<?php echo isset($id_restaurante) ? $id_restaurante : '' ?>">
                                <input type="hidden" id="id_provincia" name="id_provincia" value="<?php echo isset($provincia_gestor) ? $provincia_gestor : '' ?>">
                                <input type="hidden" id="id_localidad" name="id_localidad" value="<?php echo isset($municipio_gestor) ? $municipio_gestor : '' ?>">
                                <input class="button-3 botonpeq" id="paso_siguiente_2" type="submit" value="Paso siguiente">
                            </div>
                            <div class="mensajeexito" style="display:none;"></div>
                    </div>
                    </form>

                </article>

            </div><!-- FIN Row -->
        </div><!-- FIN Container -->
    </div><!-- FIN Sections -->


</section>
