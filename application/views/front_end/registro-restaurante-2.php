<section class="one-page-panelcontrol">

	<div class="sections">
		<div class="container">
			<div class="row">
				<!-- Primera columna 2/12 -->
				<div class="col-md-3">
					<div class="widget">
						<div class="widget-title"><h6>Menú</h6></div>
						<nav class="menu">
						<ul>

							<li>
								<a href="#altarestaurante">Alta de restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a>
							</li>

						</ul>
						</nav>
					</div>
				</div><!-- FIN Primera columna 2/12 -->
				
				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">

					<article class="seccion-restaurante">
						<div class="row">
							 <div class="col-md-8">
								<h5>Alta/baja de restaurantes</h5>
							</div>
							<div class="col-md-4">
								<div class="callout-a "><a href="javascript:window.history.back();" class="button-3">Volver al panel de control</a></div>
							</div>
						</div>
					</article>

					<article id="altarestaurante" class="seccion-restaurante">
						<div class="form-generico">

							<form method="post" class="fondo" id="form-1" action="<?php echo base_url(); ?>registro-restaurante-2">

								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Datos facturación</h6>
								<div class="row">
									<div class="col-md-3">
										<label>Razón Social</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input type="text" name="razon_social_facturacion" id="razon_social_facturacion" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Calle</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input type="text" name="calle_facturacion" id="calle_facturacion" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Número</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input type="text" name="numero_facturacion" id="numero_facturacion" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Código Postal</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input type="text" name="cp_facturacion" id="cp_facturacion" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Municipio</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="localidad_facturacion" id="localidad_facturacion" type="text" class="clarito" placeholder="Asociado al CP" disabled>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Provincia</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="provincia_facturacion" id="provincia_facturacion" type="text" class="clarito" placeholder="Asociado al CP" disabled>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Correo electrónico facturación</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-envelope"></i>
											<input type="text" name="email_facturacion" id="email_facturacion" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Número de cuenta bancaria</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-credit-card"></i>
											<input type="text" class="required ccc number" name="cuenta_bancaria_facturacion" id="cuenta_bancaria_facturacion" value="">
										</div>
									</div>
									
									<div class="clear"></div>
								</div>
								<hr class="bordepunteadogris">


								<div class="separadorpeq"></div>


								<h6>Alta de restaurante - Categoría del restaurante</h6>
								<div class="row">
									<div class="col-md-2">
										<label>Categoría principal</label>
									</div>
									<div class="col-md-10 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i>
												<select name="opc1_categoria_restaurante" id="opc1_categoria_restaurante">
													<option selected>Seleccionar ...</option>
													<?php foreach ($listadoCategoriasRestaurante as $key => $value) { ?>
														<option value="<?php echo $value->id_categoria; ?>"><?php echo $value->nombre_categoria; ?></option>
													<?php } ?>
												</select>
										</div>
									</div>

									<div class="clear"></div>	

									<div class="col-md-2">
										<label>Categoría secundaria</label>
									</div>
									<div class="col-md-10 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i>
												<select name="opc2_categoria_restaurante" id="opc2_categoria_restaurante">
													<option selected>Seleccionar ...</option>
													<?php foreach ($listadoCategoriasRestaurante as $key => $value) { ?>
														<option value="<?php echo $value->nombre_categoria; ?>"><?php echo $value->nombre_categoria; ?></option>
													<?php } ?>
												</select>
										</div>
									</div>

									<div class="clear"></div>

									<div class="col-md-2">
										<label>Categoría secundaria</label>
									</div>
									<div class="col-md-10 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i>
												<select name="opc3_categoria_restaurante" id="opc3_categoria_restaurante">
													<option selected>Seleccionar ...</option>
													<?php foreach ($listadoCategoriasRestaurante as $key => $value) { ?>
														<option value="<?php echo $value->nombre_categoria; ?>"><?php echo $value->nombre_categoria; ?></option>
													<?php } ?>
												</select>
										</div>
									</div>

									<div class="clear"></div>


									<div class="enlacesencillo reducirfila">
										<!--
										<a href="#">Añadir otra categoría secundaria<span><i class="fa fa-arrow-circle-right"></i></span></a>
										-->
									</div>

								</div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Especialidades</h6>

								<div class="row">	

										<div class="col-md-12 nodosfilas" id="contenedorEspecialidades">
											<div class="form-input" id="anadiElementoEspecialidad">
												<i class="fa fa-map-marker"></i>
												<input name="especialidades_restaurante[]" id="especialidades_restaurante" type="text" placeholder="Introduce una especialidad, Ej. Carne a la brasa">
											</div>
										</div>

										<div class="enlacesencillo reducirfila">
											<a href="#" id="btnAddEspecialidadAltaRestaurante">Añadir más especialidades<span>
											<i class="fa fa-arrow-circle-right"></i></span></a>
										</div>
								</div>


								<hr class="bordepunteadogris">


								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Puntos de interés</h6>
								<div class="row">	
										<div class="col-md-12 nodosfilas">
											<div class="form-input" id="contenedorPuntosInteres">
												<i class="fa fa-map-marker"></i>
												<input name="puntos_interes[]" id="puntos_interes" type="text" value="" placeholder="Introduce un punto de interés, Ej. Puerta de Alcalá">
											</div>
										</div>
										<div class="enlacesencillo reducirfila">
											<a href="#" id="btnAddPuntoInteresAltaRestaurante">Añadir más puntos de interés<span>
											<i class="fa fa-arrow-circle-right"></i></span></a>
										</div>
								</div>


								<hr class="bordepunteadogris">


								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Estaciones de metro</h6>
								<div class="row">	
										<div class="col-md-12 nodosfilas">
											<div class="form-input" id="contenedorEstaciones">
												<i class="fa fa-map-marker"></i>
												<select name="estaciones_metro[]" id="estaciones_metro">
													<option selected>Seleccionar</option>
													<?php foreach ($listadoEstaciones as $key => $value) { ?>
														<option><?php echo $value->nombre_estacion; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="enlacesencillo reducirfila">
											<a href="#" id="btnAddEstacionesAltaRestaurante">Añadir más paradas de metro<span><i class="fa fa-arrow-circle-right"></i></span></a>
										</div>
								</div>
								<div class="separadorpeq"></div>

								<input type="hidden" name="id_restaurante" id="id_restaurante" value="<?php echo $id_restaurante; ?>">

								<div class="row centrar reducirfila">
										<input class="button-3 botonpeq" id="btnGuardarDatosRestaurante2" type="submit" value="Guardar datos">
								</div>
							</form>
						</div>
					</article>





				</div><!-- FIN Segunda columna 10/12 -->
			</div><!-- FIN Row -->
		</div><!-- FIN Container -->
	</div><!-- FIN Sections -->
				

</section>