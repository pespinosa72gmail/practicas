<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registro.restaurador.3.js"></script>
<section>

    <div class="sections">
        <div class="container">
            <div class="row reducirfila">

                <article id="registro_user" class="seccion-restaurante">
                    <h5>Registro de nuevo restaurante</h5>

                    <span class="restauranteseleccionado">Paso 3 - Datos facturación</span>

                    <div class="separadorpeq"></div>
                    <div class="form-generico">
                        <form method="post" id="registro_restaurador_form3" action="<?php echo base_url() ?>registro-restaurador/plan-premium/pag-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Razón Social (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i>
                                        <input name="razon_social_facturacion" id="razon_social_facturacion" type="text" value="">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Calle (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="direccion_facturacion" id="direccion_facturacion" type="text" value="<?php echo isset($calle_restaurante)?$calle_restaurante:'' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Número (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="numero_facturacion" id="numero_facturacion" type="text" value="<?php echo isset($numero_restaurante)?$numero_restaurante:'' ?>">
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Código Postal (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <input name="cp_facturacion" id="cp_facturacion" type="text" value="<?php echo  isset($cp_restaurante)?$cp_restaurante:'' ?>">
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Provincia (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <!--<input name="name" id="name" type="text" class="clarito" value="Asociado al CP" disabled>-->
                                        <select id="provincia_facturacion" name="provincia_facturacion">
                                            <option>Provincia</option>
                                            <?php foreach ($listadoProvincias as $key => $value) { ?>
                                                <option value="<?php echo $value->id_provincia; ?>" <?php
                                                if (isset($provincia_restaurante)) {
                                                    echo $provincia_restaurante == $value->id_provincia ? 'selected' : '';
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
                                    <label>Municipio (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i>
                                        <!--<input name="name" id="name" type="text" class="clarito" value="Asociado al CP" disabled>-->
                                        <select id="municipio_facturacion" name="municipio_facturacion">
                                            <option>Municipio</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Correo electrónico facturación</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-envelope"></i>
                                        <input name="email_facturacion" id="email_facturacion" type="text" value="">
                                    </div>
                                </div>

                                <div class="clear"></div>

                                <div class="col-md-3">
                                    <label>Plan contratado</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-eur"></i>
                                        <select name="plan_restaurante" id="plan_restaurante">
                                            <option value="1" <?php echo $id_plan == 1? 'selected':''?>>Plan freemium (gratuito)</option>
                                            <option value="2" <?php echo $id_plan == 2? 'selected':''?>>Plan Básico (12 + IVA)</option>
                                            <option value="3" <?php echo $id_plan == 3? 'selected':''?>>Plan Preemium (25 + IVA)</option>
                                        </select>
                                    </div>
                                </div>
                                <!--
                                                                <div class="clear"></div>
                                                                <div class="col-md-3">
                                                                    <label>Forma de pago</label>
                                                                </div>
                                                                <div class="col-md-9 nodosfilas convertir12">
                                
                                                                    <div class="form-input">
                                                                        <input type="radio" name="estructura"><label>Tarjeta</label>
                                                                    </div>
                                                                    <div class="clear"></div>
                                                                    <div class="form-input">
                                                                        <input type="radio" name="estructura" checked><label>Cuenta bancaria</label>
                                                                    </div>
                                                                </div>
                                -->

                                <div class="clear"></div>
                                <div class="col-md-3">
                                    <label>Número de cuenta bancaria (*)</label>
                                </div>
                                <div class="col-md-9 nodosfilas convertir12">
                                    <div class="form-input">
                                        <i class="fa fa-credit-card"></i>
                                        <input name="cuenta_facturacion" id="cuenta_facturacion" type="text" value="" placeholder="Sólo para planes de pago">
                                    </div>
                                </div>

                                <div class="reducirfila nota"><span>(*):</span>Los campos marcados con asterisco son obligatorios.
                                </div>

                                <div class="clear"></div>
                                <div class="separadorpeq"></div>
                                <div class="row centrar reducirfila">
                                    <input id="paso_anterior_3" class="button-4 botonpeq" type="button" value="Paso anterior">
                                    <input id="finalizar_3" class="button-3 botonpeq" type="submit" value="Finalizar">
                                </div>
                                <input id="id_restaurante" type="hidden" name="id_restaurante" value="<?php echo isset($id_restaurante) ? $id_restaurante : '' ?>">
                                <input id="id_gestor" type="hidden" name="id_gestor" value="<?php echo isset($id_gestor) ? $id_gestor : '' ?>">
                                <input id="id_localidad" type="hidden" name="id_localidad" value="<?php echo isset($municipio_restaurante) ? $municipio_restaurante : '' ?>">
                                <div class="mensajeexito" id="mensajeexito" style="display:none;">
                                </div>	
                        </form>
                    </div>


                </article>

            </div><!-- FIN Row -->
        </div><!-- FIN Container -->
    </div><!-- FIN Sections -->


</section>
