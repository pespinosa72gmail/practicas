<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/franquiciate.js"></script>
<section>

    <div class="sections">
        <div class="container">
            <div class="row reducirfila">

                <article id="restaurantes" class="seccion-restaurante">
                    <h5>Franquíciate con Todoslosmenus</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <h6>¿Qué significa franquiciarse con nosotros?</h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, 
                                eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie.Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, eleifend sed turpis. Pellentesque cursus arcu id magna 
                                euismod in elementum purus molestie.Lorem ipsum dolor sit amet, consectetur.</p>
                            <p>Pellentesque cursus arcu id magna euismod in elementum purus molestie.Lorem ipsum dolor sit amet, consectetur 
                                adipiscing elit.</p>
                        </div>

                        <div class="col-md-4">
                            <div class="centrar animation" data-animate="tada">
                                <img class="sombra" src="<?php echo base_url(); ?>assets/images/franquicias.jpg" alt="Menú del día"/>
                            </div>
                        </div>
                    </div>


                    <div class="separadorpeq"></div>
                    <h5>Me interesa, ¿por dónde empezamos?</h5>
                    <h6>Rellena este cuestionario y nos pondremos en contacto contigo lo más rápido posible para ponernos manos a la obra.</h6>
                    <!--<div class="mensajeFranquiciate"></div>-->
                    <div class="form-generico">
                        <form method="post" id="form-1" action="">
                            <div class="row">
                                <div class="col-md-1">
                                    <label>Nombre</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-input">
                                        <i class="fa fa-user"></i>
                                        <input name="nombre_franquiciate" id="nombre_franquiciate" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label>E-mail</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-input">
                                        <i class="fa fa-envelope"></i>
                                        <input name="email_franquiciate" id="email_franquiciate" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label>Teléfono</label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-input">
                                        <i class="fa fa-phone"></i>
                                        <input name="telefono_franquiciate" id="telefono_franquiciate" type="text" value="">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label>Mensaje</label>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-input">
                                        <i class="fa fa-pencil"></i>
                                        <textarea name="mensaje_franquiciate" id="mensaje_franquiciate"></textarea>
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div id="mensaje"></div>
                                <br />
                                <div class="separadorpeq"></div>
                                <div class="row centrar reducirfila">
                                    <input class="button-3 botonpeq" id="btnSendEmailFranquiciate" name="btnSendEmailFranquiciate" type="submit" value="Enviar">
                                </div>
                            </div>
                        </form>
                    </div>

                </article>

            </div><!-- FIN Row -->
        </div><!-- FIN Container -->
    </div><!-- FIN Sections -->


</section>
