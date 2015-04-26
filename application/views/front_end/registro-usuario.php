<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registro.usuario.js"></script>
<section>

    <div class="sections">
        <div class="container">
            <div class="row reducirfila">

                <article id="registro_user" class="seccion-restaurante">
                    <h5>¡ Regístrate gratis !</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <p>
                                ¿Qué <strong>ventajas</strong> tiene el registro en
                                Todoslosmenus.com?
                            </p>
                            <div class="alerts fondogrisclaro reducirpadding animation"
                                 data-animate="bounceInUp">
                                <i class="fa fa-star"></i>
                                <div>
                                    <h3>Menús del día de restaurantes favoritos</h3>
                                    <p>
                                        Cada día verás en tu home los menús del día de los
                                        restaurantes que hayas marcado como <strong>favoritos</strong>,
                                        ¡sin necesidad de buscarlos diariamente!
                                    </p>
                                </div>
                            </div>
                            <div class="alerts fondogrisclaro reducirpadding animation"
                                 data-animate="bounceInUp">
                                <i class="fa fa-cutlery"></i>
                                <div>
                                    <h3>Sugerencias de restaurantes</h3>
                                    <p>
                                        Te haremos <strong>sugerencias de restaurantes</strong>, que
                                        podrás ver en tu home, en base a tus preferencias culinarias
                                        que nos indiques, o en base a la cercanía a tu domicilio.
                                    </p>
                                </div>
                            </div>
                            <div class="alerts fondogrisclaro reducirpadding animation"
                                 data-animate="bounceInUp">
                                <i class="fa fa-credit-card"></i>
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>Ofertas, descuentos y cupones (sólo pertenecientes al
                                            club TLM)</h3>
                                        <p>
                                            Te podrás beneficiar de ciertas <strong>ofertas y
                                                cupones</strong> especiales para usuarios registrados. ¡No te los
                                            pierdas!
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="callout-a ">
                                            <a href="#" class="button-3">ver + info del Club</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 centrar">
                            <img src="<?php echo base_url(); ?>assets/images/pizarrarellena.png" alt="Menú del día"
                                 class="animation" data-animate="fadeInRight" />
                        </div>
                    </div>
                    <div class="separadorpeq"></div>
                    <h5>¡ Es muy fácil !</h5>
                    <h6>Sólo tienes que rellenar este sencillo formulario. ¡Ya
                        estás más cerca de pertenecer a la comunidad de Todos Los Menús!</h6>
                    <div class="form-generico">

                        <form method="post" id="form-1" action="#" name="formulario_registro_usuario">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Nombre</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i> 
                                        <input type="text" name="nombre_usuario" id="nombre_usuario" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>E-mail</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <i class="fa fa-envelope"></i> 
                                        <input type="text" name="email_usuario" id="email_usuario" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Apellidos</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i> 
                                        <input type="text" name="apellidos_usuario" id="apellidos_usuario" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <i class="fa fa-key"></i> 
                                        <input type="password" name="password_usuario" id="password_usuario" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Código postal</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <i class="fa fa-map-marker"></i> 
                                        <input type="text" name="cp_usuario" id="cp_usuario" />
                                    </div>
                                </div>

                                <div class="clear"></div>






                                <div class="col-md-12">
                                    <div class="form-input">
                                        <input type="checkbox" name="tlm_usuario" id="tlm_usuario">
                                        <label>Obtén más beneficios uniéndote gratuitamente a nuestro  <a href="">Club TLM</a></label>
                                    </div>
                                </div>
                                <div class="separadorgrande"></div>




                                <div id="registro_usuario_tlm_oculto">

                                    <div class="col-md-2">
                                        <label>E-mail adicional</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-input">
                                            <i class="fa fa-envelope"></i> 
                                            <input name="email_adicional_usuario" id="email_adicional_usuario" type="text" />
                                        </div>
                                    </div>


















                                    <!-- **************************************************************************** -->
                                    <!--
                                            <div class="col-md-2">
                                                    <label>Fecha nacimiento</label>
                                            </div>
                                            <div class="col-md-4">
                                                    <div class="form-input">
                                                            <i class="fa fa-calendar"></i> 
                                                            <input name="fecha_nacimiento" id="fecha_nacimiento" type="text" placeholder="30/08/1988" />
                                                    </div>
                                            </div>
                                    -->





                                    <div class="col-md-6">
                                        <div id="row" class="reducirpaddingselect">

                                            <div class="col-md-3">
                                                <label>Fecha nacimiento</label>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-input">
                                                    <select name="dia_usuario_nacimiento" id="dia_usuario_nacimiento">
                                                        <option>Día</option>
                                                        <?php
                                                        for ($i = 1; $i < 32; $i++) {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-input">
                                                    <select name="mes_usuario_nacimiento" id="mes_usuario_nacimiento">
                                                        <option>Mes</option>
                                                        <?php
                                                        for ($i = 1; $i < 13; $i++) {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-input">
                                                    <select name="ano_usuario_nacimiento" id="ano_usuario_nacimiento">
                                                        <option>Año</option>
                                                        <?php
                                                        for ($i = date('Y'); $i > 1960; $i--) {
                                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <!-- **************************************************************************** -->















                                    <div class="col-md-2">
                                        <label>Sexo</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-input">
                                            <input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="Hombre">
                                            <label>Hombre</label>


                                            <div class="clear"></div>
                                            <input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="Mujer">
                                            <label>Mujer</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>¿Para qué utilizas TLM?</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-input">
                                            <input type="checkbox" name="respuesta_a" id="respuesta_a">
                                            <label>Ocio</label>
                                            <div class="clear"></div>


                                            <input type="checkbox" name="respuesta_b" id="respuesta_b">
                                            <label>Trabajo</label>
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="reducirfila nota">
                                        <span>(*):</span>El e-mail adicional es por si necesitas recibir notificaciones en otro correo electrónico.<br> El password debe tener entre 6 y 8 caracteres, y tener mínimo un número, una letra, y una mayúscula.
                                    </div>

                                    <div class="separadorpeq"></div>

                                </div>




                                <div id="mensaje"></div>
                                <br />
                                <div class="row centrar reducirfila">
                                    <input class="button-3 botonpeq" type="submit" id="registro_usuario" value="Darme de alta">
                                    <p> ¿Eres restaurador? <a href="#" class="amarillo">Pincha aquí</a> </p>
                                </div>
                        </form>




                    </div>

                </article>

            </div>
            <!-- FIN Row -->
        </div>
        <!-- FIN Container -->
    </div>
    <!-- FIN Sections -->


</section>
