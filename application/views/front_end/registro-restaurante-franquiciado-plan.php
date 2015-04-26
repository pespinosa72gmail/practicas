<section class="one-page-panelcontrol">

	<div class="sections">
		<div class="container">
			<div class="row">
				<!-- Primera columna 2/12 -->
				<!--
					<div class="col-md-3">
						<div class="widget">
							<div class="widget-title"><h6>Menú</h6></div>
							<nav class="menu">
							<ul>
								<li><a href="#altarestaurante">Alta de restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a></li>
								<li><a href="#bajarestaurante">Eliminar restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a></li>
							</ul>
							</nav>
						</div>
					</div>
				-->
				<!-- FIN Primera columna 2/12 -->
				


				<!-- Segunda columna 10/12 -->
				<div class="col-md-12">
					<article class="seccion-restaurante">

						<h5>Selecciona el tipo de plan que quieres asignar al Restaurante</h5>
							
          	<div class="row">
            	<div class="col-md-4 pricing-item">
                <div class="pricing-tables animation" data-animate="fadeInUpBig">
                  <div class="pricing-header">
                    <div><span>25€ +  IVA</span><strong>al mes</strong></div>
                    <h3>Plan Premium</h3>

                    <?php if(!$clave_propietario){ ?>

                    	<a class="button-4" href="<?php echo base_url(); ?>acceso/franquiciado/alta-propietario-franquiciado?plan=UE5Zg3YG">Elegir</a>

                    <?php }else{ ?>

                    	<a class="button-4" href="<?php echo base_url(); ?>acceso/franquiciado/alta-propietario-franquiciado-2?plan=UE5Zg3YG&clave=<?php echo $clave_propietario->clave_propietario; ?>">Elegir</a>

                    <?php } ?>

                  </div>
                </div>
	            </div>

            <div class="col-md-4 pricing-item">
              <div class="pricing-tables animation" data-animate="fadeInUpBig">
                <div class="pricing-header">
                  <div><span>12€ + IVA</span><strong>al mes</strong></div>
                  <h3>Plan Básico</h3>

	                  <?php if(!$clave_propietario){ ?>

	                  	<a class="button-4" href="<?php echo base_url(); ?>acceso/franquiciado/alta-propietario-franquiciado?plan=uKjHMt6g">Elegir</a>

	                  <?php }else{ ?>

	                  	<a class="button-4" href="<?php echo base_url(); ?>acceso/franquiciado/alta-propietario-franquiciado-2?plan=uKjHMt6g&clave=<?php echo $clave_propietario->clave_propietario; ?>">Elegir</a>

	                  <?php } ?>

                </div>
              </div>
            </div>


            <div class="col-md-4 pricing-item">
              <div class="pricing-tables animation" data-animate="fadeInUpBig">
                <div class="pricing-header">
                  <div><span>Gratuito</span></div>
                  <h3>Plan Freemium</h3>

                  	<?php if(!$clave_propietario){ ?>

	                  	<a class="button-4" href="<?php echo base_url(); ?>acceso/franquiciado/alta-propietario-franquiciado?plan=eJ6RW7aD">Elegir</a>

	                  <?php }else{ ?>

	                  	<a class="button-4" href="<?php echo base_url(); ?>acceso/franquiciado/alta-propietario-franquiciado-2?plan=eJ6RW7aD&clave=<?php echo $clave_propietario->clave_propietario; ?>">Elegir</a>

	                  <?php } ?>

                </div>
              </div>
            </div>

						</div>

					</article>

				</div><!-- FIN Segunda columna 10/12 -->
			</div><!-- FIN Row -->
		</div><!-- FIN Container -->
	</div><!-- FIN Sections -->
				

</section>
