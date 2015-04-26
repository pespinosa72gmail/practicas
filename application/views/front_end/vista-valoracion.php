<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/vista.valoracion.js"></script>
<section>

  <div class="sections">
    <div class="container">
      <div class="row reducirfila">

        <article id="valoracion" class="seccion-restaurante">
          <h5>Enviar valoración de restaurante</h5>
          <div class="row">
            <div class="col-md-8">
              <p>Vas a valorar el restaurante:</p>
              <span class="restauranteseleccionado"><?php echo $detalle->nombre_restaurante; ?>
                (<?php echo $detalle->nombre_localidad; ?>, <?php echo $detalle->nombre_provincia; ?>)</span>
              <div class="separadorpeq"></div>
              <p>Indica, en una escala del 1 al 5 (1: malo, 5:excelente)
                cómo valorarías:</p>
              <div class="form-generico">


                <form method="post" id="form-1" action="#">
                  <div class="row">
                    <div class="col-md-4">
                      <label>Valoración global</label>
                    </div>
                    <div class="col-md-8">
                      <div class="form-input checksenlinea">
                        <input type="radio" name="valoracion_global" id="valoracion_global" value="1" checked=""><label>1</label>&nbsp;&nbsp;&nbsp; 
                        <input type="radio" name="valoracion_global" id="valoracion_global" value="2" checked=""><label>2</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_global" id="valoracion_global" value="3" checked=""><label>3</label>&nbsp;&nbsp;&nbsp; 
                        <input type="radio" name="valoracion_global" id="valoracion_global" value="4" checked=""><label>4</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_global" id="valoracion_global" value="5" checked=""><label>5</label>&nbsp;&nbsp;&nbsp;
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="col-md-4">
                      <label>Servicio</label>
                    </div>
                    <div class="col-md-8">
                      <div class="form-input checksenlinea">
                        <input type="radio" name="valoracion_servicio" id="valoracion_servicio" value="1" checked=""><label>1</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_servicio" id="valoracion_servicio" value="2" checked=""><label>2</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_servicio" id="valoracion_servicio" value="3" checked=""><label>3</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_servicio" id="valoracion_servicio" value="4" checked=""><label>4</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_servicio" id="valoracion_servicio" value="5" checked=""><label>5</label>&nbsp;&nbsp;&nbsp;
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="col-md-4">
                      <label>Comida</label>
                    </div>
                    <div class="col-md-8">
                      <div class="form-input checksenlinea">
                        <input type="radio" name="valoracion_comida" id="valoracion_comida" value="1" checked=""><label>1</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_comida" id="valoracion_comida" value="2" checked=""><label>2</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_comida" id="valoracion_comida" value="3" checked=""><label>3</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_comida" id="valoracion_comida" value="4" checked=""><label>4</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_comida" id="valoracion_comida" value="5" checked=""><label>5</label>&nbsp;&nbsp;&nbsp;
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="col-md-4">
                      <label>Relación calidad-precio</label>
                    </div>
                    <div class="col-md-8">
                      <div class="form-input checksenlinea">
                        <input type="radio" name="valoracion_calidad_precio" id="valoracion_calidad_precio" value="1" checked=""><label>1</label>&nbsp;&nbsp;&nbsp; 
                        <input type="radio" name="valoracion_calidad_precio" id="valoracion_calidad_precio" value="2" checked=""><label>2</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_calidad_precio" id="valoracion_calidad_precio" value="3" checked=""><label>3</label>&nbsp;&nbsp;&nbsp; 
                        <input type="radio" name="valoracion_calidad_precio" id="valoracion_calidad_precio" value="4" checked=""><label>4</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="valoracion_calidad_precio" id="valoracion_calidad_precio" value="5" checked=""><label>5</label>&nbsp;&nbsp;&nbsp;
                      </div>
                    </div>
                    <div class="clear"></div>
                    <div class="separadorpeq"></div>
                    <div id="mensaje"></div>
                    <div class="row centrar reducirfila">
                      <?php $clave = $this->input->get('clave'); ?>
                      <input type="hidden" id="id_restaurante" name="id_restaurante" value="<?php echo $detalle->id_restaurante; ?>" />
                      <input class="button-3 botonpeq" type="submit" id="btnEnviarValoracion" value="Enviar valoración">
                    </div>
                  </div>
                </form>


              </div>
            </div>
            <div class="col-md-4 centrar">
              <div class="enlacesencillo">
                <a href="<?php echo base_url(); ?>restaurante/<?php echo $detalle->slug_restaurante; ?>">Volver a detalle de restaurante<span><i
                    class="fa fa-arrow-circle-right"></i></span></a>
              </div>
              <div class="separadorgrande"></div>
              <img class="sombra"
                src="<?php echo base_url(); ?>assets/images/restaurantes/00001_Restaurante01/principal.jpg"
                alt="Restaurante" class="animation" data-animate="fadeInDown" />
            </div>
          </div>



        </article>

      </div>
      <!-- FIN Row -->
    </div>
    <!-- FIN Container -->
  </div>
  <!-- FIN Sections -->


</section>
