<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/panel.franquiciado.propietario.js"></script>
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
								Selección actual: <span class="restauranteseleccionado" id="restauranteseleccionado"></span>
						</p>
						<div class="enlacesencillo" id="alta_propietario"></div>

						<div class="clear"></div>

						<p>
							Selecciona el propietario que quieres consultar / modificar:
						</p>
						<div class="form-generico">

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
												<a href="#" class="button-3" id="btnSearchPropietario">Buscar</a>
											</div>
										</div>
									</div>



									<div class="clear"></div>
									<div class="col-md-12">

										
										<div id="mensaje_buscador" class="mensajeconfondo"></div>

										<ul class="restaurantesfavoritos_seleccion">

											<div id="listadoPropietarios">
											</div>

										</ul>
									</div>

						</div>
						<div class="separadorgrande"></div>
						<div class="alerts">
							<i class="fa fa-info"></i>
							<div>
								<h3>Nota sobre alta de propietario</h3>
								<p>
									No se pueden dar de alta propietarios por separado.
									Deberá crearlo a la vez que se crea un restaurante.
                                    <p style="color:#F00; font-weight:bold;">(creo que sería mejor que si se pueda y que se ponga como está ahora mismo "propietario sin restaurante asignado", de lo contrario cuando un francuiciado borre todos los restaurantes de un propietario habría que borrar al propietario o hacer que no lo muestre cuando no tenga restaurantes)</p>
								</p>
								<div class="enlacesencillo">
									<a href="<?php echo base_url('acceso/franquiciado/alta-propietario-franquiciado-plan'); ?>">Ir a Alta/Baja de Restaurante
									<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</article>

















					<article id="propietario" class="seccion-restaurante" style="display: none;">

						<div class="mensajeexito" style="display: none;">
							<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado con éxito.
						</div>

						<h6>Datos propietario</h6>
						<div class="form-generico">
								<div class="row">
									<div class="col-md-2">
										<label>Nombre propietario</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> 
                                            <input type="text" name="nombre_propietario" id="nombre_propietario">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditNombrePropieratioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_nombre" class="mensajeconfondo"></div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Apellidos</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> 
											<input name="apellidos_propietario" id="apellidos_propietario" type="text">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditApellidosPropieratioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_apellidos" class="mensajeconfondo"></div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Correo electrónico</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-envelope"></i> 
											<input name="email_propietario" id="email_propietario" type="text">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditCorreoPropieratioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_correo" class="mensajeconfondo"></div>



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
									</div>
                                    
									<div class="clear"></div>
                                    
									<div class="col-md-2">
										<label>Repetir contraseña</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-key"></i> 
											<input type="password" name="repetir_password" id="repetir_password" placeholder="Repite la nueva contraseña">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditPasswordPropietarioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_password" class="mensajeconfondo"></div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Teléfono</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-phone"></i> 
											<input name="telefono_propietario" id="telefono_propietario" type="text">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditTelefonoPropieratioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_telefono" class="mensajeconfondo"></div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Código postal</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
											<input name="cp_propietario" id="cp_propietario" type="text">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditCpPropieratioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_cp" class="mensajeconfondo"></div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Provincia</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
                                                <select class="provincia_gestor" name="provincia_propietario" id="provincia_propietario">
                                                    <option value="-1">Provincia</option>
                                                    <?php foreach ($listadoProvincias as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_provincia; ?>">
                                                            <?php echo $value->nombre_provincia; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditProvinciaPropieratioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_provincia" class="mensajeconfondo"></div>



									<div class="clear"></div>



									<div class="col-md-2">
										<label>Municipio</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
                                        <select class="municipio_gestor" name="municipio_propietario" id="municipio_propietario">
                                            <option>Municipio</option>
                                        </select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditMunicipioPropieratioFranquiciado">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_municipio" class="mensajeconfondo"></div>
                                    
									<div class="clear"></div>

								</div>
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
