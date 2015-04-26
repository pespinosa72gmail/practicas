<section class="one-page-panelcontrol">


	<div class="sections">
		<div class="container">
			<div class="row">
				<!-- Primera columna 2/12 -->
				<div class="col-md-3">
					<div class="widget">
						<div class="widget-title">
							<h6>Menú</h6>
						</div>
						<nav class="menu">
							<ul>
								<li><a href="#subidafotos">Subir fotos<span><i
											class="fa fa-arrow-circle-right"></i></span></a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- FIN Primera columna 2/12 -->

				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">
					<article class="seccion-restaurante">
						<div class="row">
							<div class="col-md-8">
								<h5>Alta de fotografías</h5>
								<p>
									Selección actual: 
									<span class="restauranteseleccionado"><?php echo $datosRestaurante->nombre_restaurante; ?></span>
								</p>
							</div>
							<div class="col-md-4">
								<div class="callout-a ">
									<a href="javascript:window.history.back();" class="button-3">Volver
										al panel de control</a>
								</div>
							</div>
						</div>
					</article>



					<article id="subidafotos" class="seccion-restaurante">
						<h6>Subir fotos</h6>
						<div class="form-generico">
							<form method="post" id="form-1" action="<?php echo base_url('imagenes/upload'); ?>" class="dropzone" enctype="multipart/form-data">

								<!--<p class="centrar">Aquí se mostrará la ventanita para arrastrar y cargar imágenes</p>-->
								<input type="hidden" name="id_restaurante" value="<?php echo $datosRestaurante->id_restaurante; ?>">
							</form>


							<div id="mostrarImagenes"></div>


							<form method="post" id="form-1" action="#">
								<hr class="bordepunteadogris">
								<ul class="restaurantesfavoritos_seleccion">

								<?php if ($imagenesRestaurante != "") { ?>

									<?php foreach ($imagenesRestaurante as $key => $value) { ?>
										<div id="listadoImagen"></div>
									<?php } ?>

								<?php }else{ ?>
									<div class="mensaje"><p>No hay imágenes subidas</p></div>
								<?php } ?>

								</ul>
								<div class="separadorpeq"></div>
								<div class="row centrar reducirfila">
									<input class="button-3 botonpeq" type="submit"
										value="Guardar cambios">
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
