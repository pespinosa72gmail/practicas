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
								<li><a href="#altarestaurante">Alta de restaurante<span><i
											class="fa fa-arrow-circle-right"></i></span></a></li>
								<li><a href="#bajarestaurante">Eliminar restaurante<span><i
											class="fa fa-arrow-circle-right"></i></span></a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- FIN Primera columna 2/12 -->

				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">
					<article class="seccion-restaurante">

						<h5>Gestión de restaurantes - Alta/baja de restaurantes</h5>

						<div class="row">
							<div class="col-md-4">
								<div class="callout-a ">
									<a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado-gestion-restaurantes'); ?>"
										class="button-3">Volver a gestión de restaurantes</a>
								</div>
							</div>
							<div class="col-md-4">
								<div class="callout-a ">
									<a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado'); ?>" class="button-3">Volver
										a panel de control</a>
								</div>
							</div>
							<div class="col-md-4">
								<div class="callout-a ">
									<a href="<?php echo base_url(); ?>logout" class="button-3">Desconectar</a>
								</div>
							</div>
						</div>
					</article>



					<article id="altarestaurante" class="seccion-restaurante">
					<!-- Facturación -->
						<form action="<?php echo base_url(); ?>acceso/franquiciado/registro-propietario-franquiciado-3" method="POST">
						<div class="form-generico">
							<div class="separadorpeq"></div>
							<h6>Alta de restaurante - Datos facturación</h6>
							<div class="row">
								<div class="col-md-3">
									<label>Razón Social</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-user"></i> 
										<input name="razon_social_facturacion" id="razon_social_facturacion" placeholder="Razón Social" type="text" />
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label>CIF / NIF</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-user"></i> 
										<input name="cif_facturacion" id="cif_facturacion" placeholder="CIF / NIF Facturación" type="text" />
									</div>
								</div>

								<div class="clear"></div>

								<div class="col-md-3">
									<label>Calle</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="direccion_facturacion" id="direccion_facturacion" placeholder="Calle Facturación" type="text">
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label>Número</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="numero_facturacion" id="numero_facturacion" placeholder="" type="text" />
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label>Código Postal</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="cp_facturacion" id="cp_facturacion" placeholder="Código Postal" type="text" />
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label>Municipio</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="name" id="name" type="text" class="clarito" value="Asociado al CP" disabled>
									</div>
								</div>
								<div class="clear"></div>
								<div class="col-md-3">
									<label>Provincia</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="name" id="name" type="text" class="clarito" value="Asociado al CP" disabled>
									</div>
								</div>
								<div class="clear"></div>
								<div class="col-md-3">
									<label>Correo electrónico facturación</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-envelope"></i> 
										<input name="email_facturacion" id="email_facturacion" placeholder="Email Facturación" type="text">
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label>Número de cuenta bancaria</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-credit-card"></i> 
										<input name="cuenta_facturacion" id="cuenta_facturacion" placeholder="Cuenta Facturación" type="text">
									</div>
								</div>

								<div class="clear"></div>
							</div>

							<hr class="bordepunteadogris">

						</div>


						<div class="form-generico">

								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Categoría del restaurante</h6>
								<div class="row">
									<div class="col-md-2">
										<label>Categoría principal</label>
									</div>
									<div class="col-md-10 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> 
											<select id="primera_select_categoria" name="primera_select_categoria">
												<option selected>Seleccionar ...</option>
												<?php foreach ($listadoCategorias as $key => $value) { ?>
												<option value="<?php echo $value->id_categoria; ?>">
													<?php echo $value->nombre_categoria; ?>
												</option>
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
											<select id="segunda_select_categoria" name="segunda_select_categoria">
												<option selected>Seleccionar ...</option>
												<?php foreach ($listadoCategorias as $key => $value) { ?>
												<option value="<?php echo $value->nombre_categoria; ?>">
													<?php echo $value->nombre_categoria; ?>
												</option>
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
											<select id="tercera_select_categoria" name="tercera_select_categoria">
												<option selected>Seleccionar ...</option>
												<?php foreach ($listadoCategorias as $key => $value) { ?>
													<option value="<?php echo $value->nombre_categoria; ?>">
														<?php echo $value->nombre_categoria; ?>
													</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<!--
									<div class="enlacesencillo reducirfila"><a href="#">Añadir otra categoría secundaria<span><i class="fa fa-arrow-circle-right"></i></span></a></div>-->

								</div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Especialidades</h6>
								<div class="row">
									<div class="col-md-12 nodosfilas" id="especialidades">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
												<input type="text" name="nombre_especialidad[]" id="nombre_especialidad" placeholder="Introduce una especialidad, Ej. Carne a la brasa">
										</div>
									</div>
									<div class="enlacesencillo reducirfila">
										<a href="#" id="btnAddEspecialidad">Añadir más especialidades<span>
										<i class="fa fa-arrow-circle-right"></i></span>
										</a>
									</div>
								</div>



								<hr class="bordepunteadogris">



								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Puntos de interés</h6>
								<div class="row">
									<div class="col-md-12 nodosfilas" id="puntosInteres">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
												<input name="puntos_interes[]" id="puntos_interes" type="text" placeholder="Introduce un punto de interés, Ej. Puerta de Alcalá">
										</div>
									</div>
									<div class="enlacesencillo reducirfila">
										<a href="#" id="btnAddPuntoInteresA">Añadir más puntos de interés<span>
										<i class="fa fa-arrow-circle-right"></i></span>
										</a>
									</div>
								</div>




								<hr class="bordepunteadogris">




								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Estaciones de metro</h6>
								<div class="row">

									<div class="col-md-12 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
											<select name="nombre_estacion[]" id="nombre_estacion" class="listadoEstaciones">
												<option selected>Seleccionar</option>
												<?php foreach ($listadoEstaciones as $key => $value) { ?>
												<option value="<?php echo $value->nombre_estacion; ?>">
													<?php echo $value->nombre_estacion; ?>
												</option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div id="estaciones"></div>

									<div class="enlacesencillo reducirfila">
										<a href="#" id="btnAddEstaciones">Añadir más paradas de metro
											<span><i class="fa fa-arrow-circle-right"></i></span>
										</a>
									</div>

								</div>




								<div class="separadorpeq"></div>




								<div class="mensajeexito" style="display: none;">
									<div id="mensaje"></div>
								</div>

								<div class="row centrar reducirfila">
									<input type="hidden" name="clave_restaurante" id="clave_restaurante" value="<?php echo $dameDatosRestaurante->id_restaurante; ?>">



									<?php $clave_plan = $this->input->get_post('clave_plan'); ?>
									<input type="hidden" name="clave_plan" id="clave_plan" value="<?php echo $clave_plan; ?>">

									<input class="button-3 botonpeq" id="btnAddOtrosDatosRestaurante" type="submit" value="Guardar datos">
								</div>

							
							</div>
						</form>
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
