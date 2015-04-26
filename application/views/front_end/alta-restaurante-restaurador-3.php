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
						<h5>Gestión de restaurador - Alta de fotografías</h5>
						<p>
							Selección actual: <span class="restauranteseleccionado"><?php echo $direccionRestaurante->tipo_restaurante . ' ' . $direccionRestaurante->nombre_restaurante . ' (' . $direccionRestaurante->nombre_localidad . ', ' . $direccionRestaurante->nombre_provincia . ')'; ?></span>
						</p>

						<h5>Alta/baja de restaurantes</h5>

						<div class="row">
							<div class="col-md-4">
								<div class="callout-a ">
									<a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado'); ?>" class="button-3">Volver a panel de control</a>
								</div>
							</div>
							<div class="col-md-4">
								<div class="callout-a ">
									<a href="<?php echo base_url(); ?>logout" class="button-3">Desconectar</a>
								</div>
							</div>
						</div>
					</article>

					<article id="subidafotos" class="seccion-restaurante">
						<h6>Subir fotos</h6>
						<div class="form-generico">
							<p>El número máximo de imágenes permitidas es de 4. Si subes más de 4, solo se mostrarán las 4 primeras.</p>
						
							<form method="post" id="my-awesome-dropzone" action="<?php echo base_url('imagenes/upload'); ?>" class="dropzone" enctype="multipart/form-data">
								<input type="hidden" name="id_restaurante" value="<?php echo $id_restaurante; ?>">
							</form>
						
								<!--
								<ul class="restaurantesfavoritos_seleccion">
									<li>
										<div class="row">
											<div class="col-md-2 nodosfilas ocultar">
												<img alt=""
													src="images/restaurantes/00001_Restaurante01/principal.jpg">
											</div>
											<div class="col-md-8 nodosfilas convertir12">
												<div class="row">
													<div class="col-md-3">
														<label>Nombre</label>
													</div>
													<div class="col-md-9 nodosfilas convertir12">
														<div class="form-input">
															<i class="fa fa-pencil"></i> <input name="name" id="name"
																type="text" value="Nombre 1">
														</div>
													</div>
													<div class="col-md-3">
														<label>Principal</label>
													</div>
													<div class="col-md-9 nodosfilas convertir12">
														<div class="form-input">
															<input type="checkbox" class="bajarcheck">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<div class="enlacesencillo">
													<a href="#">Eliminar<span><i
															class="fa fa-arrow-circle-right"></i></span></a>
												</div>
											</div>
										</div>
									</li>
									<li>
										<div class="row">
											<div class="col-md-2 nodosfilas ocultar">
												<img alt=""
													src="images/restaurantes/00001_Restaurante01/principal.jpg">
											</div>
											<div class="col-md-8 nodosfilas convertir12">
												<div class="row">
													<div class="col-md-3">
														<label>Nombre</label>
													</div>
													<div class="col-md-9 nodosfilas convertir12">
														<div class="form-input">
															<i class="fa fa-pencil"></i> <input name="name" id="name"
																type="text" value="Nombre 1">
														</div>
													</div>
													<div class="col-md-3">
														<label>Principal</label>
													</div>
													<div class="col-md-9 nodosfilas convertir12">
														<div class="form-input">
															<input type="checkbox" class="bajarcheck">
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-2">
												<div class="enlacesencillo">
													<a href="#">Eliminar<span><i
															class="fa fa-arrow-circle-right"></i></span></a>
												</div>
											</div>
										</div>
									</li>
								</ul>
								-->


								
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