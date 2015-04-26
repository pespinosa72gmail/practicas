<section class="one-page-panelcontrol">

	<div class="sections">
		<div class="container">
			<div class="row">

			
				<!-- Primera columna 2/12 -->
				<div class="col-md-3">
					<div class="widget" id="menuflotante">
						<div class="widget-title">
							<h6>Menú</h6>
						</div>
						<nav class="menu">
							<ul>
								<li>
									<a href="#seleccion">Selección propietario<span><i class="fa fa-arrow-circle-right"></i></span></a>
								</li>
								<li>
									<a href="#propietario">Datos propietario<span><i class="fa fa-arrow-circle-right"></i></span></a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- FIN Primera columna 2/12 -->



				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">
					<article class="seccion-restaurante">
						<h5>Consulta / edición de propietarios</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="callout-a ">
									<a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado'); ?>" class="button-3">Volver a panel de control</a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="callout-a ">
									<a href="<?php echo base_url('logout'); ?>" class="button-3">Desconectar</a>
								</div>
							</div>
						</div>
					</article>



					<article id="seleccion" class="seccion-restaurante">
						<h6>Selección de propietario</h6>
						<p>
							<?php if($dameUltimoPropietarioActualizado){ ?>

								Selección actual: <span class="restauranteseleccionado">
								<?php echo $dameUltimoPropietarioActualizado->nombre_propietario." ".$dameUltimoPropietarioActualizado->apellidos_propietario; ?> - Restaurante El Rodado</span>

							<?php }else{ ?>

								Selección actual: <span class="restauranteseleccionado" style="text-align: center;">Actualmente no tienes ningún propietario dado de alta.</span>

							<?php } ?>
						</p>
						<div class="enlacesencillo">
							


							<?php if($dameUltimoPropietarioActualizado){ ?>

							<!-- Alta asignado al propietario seleccionado en este momento. -->
							<a href="<?php echo base_url(); ?>acceso/franquiciado/alta-propietario-restaurante-plan?clave=<?php echo $dameUltimoPropietarioActualizado->clave_propietario ?>">
								Asignar nuevo restaurante al propietario<span>
								<i class="fa fa-arrow-circle-right"></i></span>
							</a>

							<?php }else{ ?>

							

							<?php } ?>


						</div>

						<div class="clear"></div>

						<p>
							Selecciona el propietario que quieres consultar / modificar:
						</p>
						<div class="form-generico">

							<form method="post" id="form-1" action="#">
								<div class="row">

									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-user"></i> 
											<input name="search_nombre_propietario" id="search_nombre_propietario" type="text" Placeholder="Nombre del propietario">
										</div>
									</div>

									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnSearchUser">Buscar</a>
											</div>
										</div>
									</div>



									<div class="clear"></div>
									<div class="col-md-12">

										
										<div class="mensajeexito" style="display: none;">
											<div class="mensajeexitoSearch"></div>
										</div>

										<ul class="restaurantesfavoritos_seleccion">

											<div id="listadoPropietarios">
											<?php if ($dameListadoPropietarios) { ?>
												<?php foreach ($dameListadoPropietarios as $key => $value) { ?>
													<li>
														<div class="row">
															<div class="col-md-2 nodosfilas ocultar">
																<img alt="usuario" width="70" height="70" src="<?php echo base_url(); ?>assets/images/usuario.png">
															</div>
															<div class="col-md-6 nodosfilas convertir8">
																<div>
																	<strong>Nombre</strong>: <?php echo $value->nombre_propietario; ?>
																</div>
																<div>
																	<strong>Apellidos</strong>: <?php echo $value->apellidos_propietario; ?>
																</div>
																<div>
																	<strong>Restaurante</strong>: El Rodado (Boadilla del Monte, Madrid)
																</div>
															</div>
															<div class="col-md-4 nodosfilas">
																<div class="enlacesencillo">
																	<a href="<?php echo base_url(); ?>acceso/franquiciado/panel-franquiciado-gestion-propietarios-url?clave_u=<?php echo $value->id_propietario; ?>">Seleccionar<span>
																	<i class="fa fa-arrow-circle-right"></i></span></a>
																</div>
															</div>
														</div>
													</li>
												<?php } ?>
											<?php }else{ ?>
												<p style="text-align: center;">Actualmente no tienes ningún propietario dado de alta.</p>
											<?php } ?>

												


											</div>

											<div id="listadoBuscadoPropietarios" class="listadoBuscadoPropietarios" style="display: none;"></div>

										</ul>
									</div>
							</form>

						</div>
						<div class="separadorgrande"></div>
						<div class="alerts">
							<i class="fa fa-info"></i>
							<div>
								<h3>Nota sobre alta de propietario</h3>
								<p>
									No se pueden dar de alta propietarios por separado.
									Deberá crearlo a la vez que se crea un restaurante.
								</p>
								<div class="enlacesencillo">
									<a href="<?php echo base_url('acceso/franquiciado/alta-propietario-franquiciado-plan'); ?>">Ir a Alta de Restaurante
									<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</article>







































				<?php if ($dameUltimoPropietarioActualizado) { ?>
					<article id="propietario" class="seccion-restaurante">

						<div class="mensajeexito" style="display: none;">
							<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.
						</div>

						<h6>Datos propietario</h6>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-2">
										<label>Nombre propietario</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> 
											<input type="text" name="nombre_propietario" id="nombre_propietario" value="<?php echo $dameUltimoPropietarioActualizado->nombre_propietario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataPropieratiosFranquiciado">Modificar</a>
											</div>
										</div>
									</div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Apellidos</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> 
											<input name="apellidos_propietario" id="apellidos_propietario" type="text" value="<?php echo $dameUltimoPropietarioActualizado->apellidos_propietario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataPropieratiosFranquiciado">Modificar</a>
											</div>
										</div>
									</div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Correo electrónico</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-envelope"></i> 
											<input name="email_propietario" id="email_propietario" type="text" value="<?php echo $dameUltimoPropietarioActualizado->email_propietario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataPropieratiosFranquiciado">Modificar</a>
											</div>
										</div>
									</div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Contraseña acceso</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-key"></i> 
											<input type="password" name="password_propietario" id="password_propietario" placeholder="Introduce una nueva contraseña">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditPasswordPropietario">Modificar</a>
											</div>
										</div>
									</div>
									<input type="hidden" name="id_propietario" id="id_propietario" value="<?php echo $dameUltimoPropietarioActualizado->id_propietario; ?>">



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Teléfono</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-phone"></i> 
											<input name="telefono_propietario" id="telefono_propietario" type="text" value="<?php echo $dameUltimoPropietarioActualizado->telefono_propietario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataPropieratiosFranquiciado">Modificar</a>
											</div>
										</div>
									</div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Código postal</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
											<input name="cp_propietario" id="cp_propietario" type="text" value="<?php echo $dameUltimoPropietarioActualizado->cp_propietario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataPropieratiosFranquiciado">Modificar</a>
											</div>
										</div>
									</div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Municipio</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
											<input name="localidad_propietario" id="localidad_propietario" type="text" class="clarito" value="<?php echo $dameCpPropietario->nombre_localidad; ?>" disabled>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<span class="nota">Asociado al CP</span>
									</div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Provincia</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
											<input name="provincia_propietario" id="provincia_propietario" type="text" class="clarito"  value="<?php echo $dameCpPropietario->nombre_provincia; ?>" disabled>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<span class="nota">Asociado al CP</span>
									</div>
									<div class="clear"></div>

								</div>

								<input type="hidden" name="id_propietario" id="id_propietario" value="<?php echo $dameUltimoPropietarioActualizado->id_propietario; ?>">

							</form>
						</div>
					</article>
				<?php } ?>























				</div>
				<!-- FIN Segunda columna 10/12 -->
			</div>
			<!-- FIN Row -->
		</div>
		<!-- FIN Container -->
	</div>
	<!-- FIN Sections -->


</section>
