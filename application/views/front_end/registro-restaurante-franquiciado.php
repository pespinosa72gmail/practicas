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
								<li><a href="#altarestaurante">Alta de restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a></li>
								<li><a href="#bajarestaurante">Eliminar restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a></li>
							</ul>
							</nav>
						</div>
				</div><!-- FIN Primera columna 2/12 -->
				


				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">
					<article class="seccion-restaurante">

						<h5>Gestión de restaurantes - Alta/baja de restaurantes</h5>
							
          	<div class="row">
            	<div class="col-md-4">
								<div class="callout-a "><a href="panelcontrol_franquiciado_gestionrestaurantes.php" class="button-3">Volver a gestión de restaurantes</a></div>
							</div>
							 <div class="col-md-4">
								<div class="callout-a "><a href="panelcontrol_franquiciado.php" class="button-3">Volver a panel de control</a></div>
							</div>
							<div class="col-md-4">
								<div class="callout-a "><a href="<?php echo base_url(); ?>logout" class="button-3">Desconectar</a></div>
							</div>
						</div>
					</article>



					<article id="altarestaurante" class="seccion-restaurante">


						<h6>Alta de restaurante - Datos propietario</h6>
						<div class="form-generico">
							<form method="post" id="form-1" action="<?php echo base_url(); ?>acceso/franquiciado/registro-propietario-franquiciado">
								<div class="row">
									<div class="col-md-3">
										<label>Nombre propietario</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input name="nombre_propietario" id="nombre_propietario" type="text" required>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Apellidos</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input name="apellidos_propietario" id="apellidos_propietario" type="text" required>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Correo electrónico</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-envelope"></i>
											<input name="email_propietario" id="email_propietario" type="text" required>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<?php $pass = random_string('alnum', 7); ?>
										<label>Contraseña acceso</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-key"></i>
											<input name="password_propietario" id="password_propietario" value="<?php echo $pass; ?>" type="text" required>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Teléfono</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-phone"></i>
											<input name="telefono_propietario" id="telefono_propietario" type="text" required>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Código postal</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="cp_propietario" id="cp_propietario" type="text" required>
											<div id="comprueba_cp"></div>
										</div>
									</div>


									<!--
										<div class="clear"></div>
										<div class="col-md-3">
											<label>Municipio</label>
										</div>
										<div class="col-md-9 nodosfilas convertir12">
											<div class="form-input">
												<i class="fa fa-map-marker"></i>
												<input name="localidad_propietario" id="localidad_propietario" type="text" class="clarito" placeholder="Asociado al CP" disabled>
											</div>
										</div>
										<div class="clear"></div>
										<div class="col-md-3">
											<label>Provincia</label>
										</div>
										<div class="col-md-9 nodosfilas convertir12">
											<div class="form-input">
												<i class="fa fa-map-marker"></i>
												<input name="provincia_propietario" id="provincia_propietario" type="text" class="clarito" placeholder="Asociado al CP" disabled>
											</div>
										</div>
									-->

									<div class="clear"></div>
									<div class="separadorpeq"></div>
									<div class="row centrar reducirfila">
										<input type="hidden" id="clave_plan" name="clave_plan" value="<?php echo $plan = $this->input->get_post('plan'); ?>">
										<input class="button-3 botonpeq" type="submit" value="Guardar datos">
									</div>

								</form>
							</div>

					</article>






					




					<article id="bajarestaurante" class="seccion-restaurante">
						<h6>Listado de restaurantes - Baja</h6>
						<p>Este es el listado de tus restaurantes dados de alta. Para eliminar alguno, pincha en el botón "Eliminar".</p>
						<p>Para modificar alguno, vuelve al panel de control, selecciona el restaurante que quieras y edita sus datos.</p>
						 <div class="form-generico">


							<form method="post" id="form-1" action="#">
								<div class="row">

									<div class="col-md-12">
										<ul class="restaurantesfavoritos_seleccion">

											<?php if($listadoTodosRestaurantes){ ?>
												<?php foreach ($listadoTodosRestaurantes as $key => $value) { ?>
													<li>
														<div class="row">

															<div class="col-md-2 nodosfilas ocultar">
																<img alt="" src="<?php echo base_url(); ?>assets/images/restaurantes/00001_Restaurante01/principal.jpg">
															</div>

															<div class="col-md-6 nodosfilas convertir8">
																<div><strong>ID</strong>: <?php echo $value->id_restaurante; ?></div>
																<div><strong>Nombre</strong>: <?php echo $value->nombre_restaurante; ?></div>
																<div><strong>Municipio</strong>: Madrid</div>
																<div><strong>Categoría</strong>: Mediterránea</div>
																<div><strong>Precio menú</strong>: Menos de 10€</div>
															</div>

															<div class="col-md-4 nodosfilas" id="<?php echo $value->id_restaurante; ?>">
																<div class="enlacesencillo" id="deleteRestaurant">
																	<a href="#" id="btnDeleteRestaurant">Eliminar<span><i class="fa fa-arrow-circle-right"></i></span></a>
																</div>
															</div>

															<div id="showMessageDeleteRestaurant_<?php echo $value->id_restaurante; ?>" class="oculto" style="display: none;">
																<div class="col-md-12" id="<?php echo $value->id_restaurante; ?>">
																	<div class="callout callout-3">
																		<h6>¿Estás seguro de que quieres eliminar el restaurante?</h6>
																		<div class="row">
																			<div class="col-md-8">
																				<p>La acción no se puede deshacer. Se eliminarán también todos los menús asociados.</p>
																			</div>
																			<div class="col-md-2 nodosfilas">
																				<div class="callout-a ">
																					<a href="<?php echo base_url(); ?>acceso/franquiciado/eliminar-restaurante?plan=<?php echo $plan = $this->input->get_post('plan'); ?>&id_restaurante_eliminar=<?php echo $value->id_restaurante; ?>" class="button-4" id="btnDeleteRest1">&nbsp;&nbsp;Sí&nbsp;&nbsp;</a>
																				</div>
																			</div>
																			<div class="col-md-2 nodosfilas">
																				<div class="callout-a "><a href="#" class="button-4" id="btnDeleteRest2">&nbsp;&nbsp;No&nbsp;&nbsp;</a></div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>


														</div>
													</li>
												<?php } ?>

											<?php }else{ ?>

												<div class="row"><p>Actualmente no tienes registrado ningún restaurante.</p></div>

											<?php } ?>

										</ul>	
									</div>

								</div>
							</form>


						</div>
						<div class="clear"></div>
					</article>







					
				</div><!-- FIN Segunda columna 10/12 -->
			</div><!-- FIN Row -->
		</div><!-- FIN Container -->
	</div><!-- FIN Sections -->
				

</section>
