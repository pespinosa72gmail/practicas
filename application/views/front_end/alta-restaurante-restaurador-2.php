<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alta.restaurante.restaurador.2.js"></script>
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
								<li><a href="#altarestaurante">Alta de restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- FIN Primera columna 2/12 -->

				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">
					<article class="seccion-restaurante">

						<h5>Gestión de restauradores - Alta/baja de restaurantes</h5>

						<div class="row">
							<div class="col-md-6">
								<div class="callout-a ">
									<a href="<?php echo base_url('acceso/restaurador/panel-restaurador'); ?>" class="button-3">Volver
										a panel de control</a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="callout-a ">
									<a href="<?php echo base_url(); ?>logout" class="button-3">Desconectar</a>
								</div>
							</div>
						</div>
					</article>



					<article id="altarestaurante" class="seccion-restaurante">
					<!-- Facturación -->
						<form name="alta_restaurante_restaurador_2" action="<?php echo base_url(); ?>acceso/restaurador/alta-restaurante-3" method="POST">
						<div class="form-generico">
							<div class="separadorpeq"></div>
							<h6>Alta de restaurante - Datos facturación</h6>
							<div class="row">
								<div class="col-md-3">
									<label style="cursor: text;">Razón Social</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-user"></i> 
										<input name="razon_social_facturacion" id="razon_social_facturacion" type="text" />
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label style="cursor: text;">CIF / NIF</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-user"></i> 
										<input name="cif_facturacion" id="cif_facturacion" type="text" />
									</div>
								</div>

								<div class="clear"></div>

								<div class="col-md-3">
									<label style="cursor: text;">Calle</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="direccion_facturacion" id="direccion_facturacion" type="text">
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label style="cursor: text;">Número</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="numero_facturacion" id="numero_facturacion" type="text" />
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label style="cursor: text;">Código Postal</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
										<input name="cp_facturacion" id="cp_facturacion" type="text" />
									</div>
								</div>
                                
								<div class="clear"></div>
                                
								<div class="col-md-3">
									<label style="cursor: text;">Provincia</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
                                        <select class="provincia_gestor" name="provincia_facturacion" id="provincia_facturacion">
                                            <option value="-1">Provincia</option>
                                            <?php foreach ($listadoProvincias as $key => $value) { ?>
                                                <option value="<?php echo $value->id_provincia; ?>">
                                                    <?php echo $value->nombre_provincia; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="clear"></div>
                                
								<div class="col-md-3">
									<label style="cursor: text;">Municipio</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-map-marker"></i> 
                                        <select class="municipio_gestor" name="municipio_facturacion" id="municipio_facturacion">
                                            <option>Municipio</option>
                                        </select>
									</div>
								</div>
                                
								<div class="clear"></div>
								<div class="col-md-3">
									<label style="cursor: text;">Correo electrónico facturación</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-envelope"></i> 
										<input name="email_facturacion" id="email_facturacion" type="text">
									</div>
								</div>

								<div class="clear"></div>
								<div class="col-md-3">
									<label style="cursor: text;">Número de cuenta bancaria</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-credit-card"></i> 
										<input name="cuenta_facturacion" id="cuenta_facturacion" type="text">
									</div>
								</div>

								<div class="clear"></div>
							</div>
                            
							<div id="mensaje_facturacion" class="mensajeconfondo"></div>

							<hr class="bordepunteadogris">

						</div>


						<div class="form-generico">

								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Categoría del restaurante</h6>
								<div class="row">
									<div class="col-md-2">
										<label style="cursor: text;">Categoría principal</label>
									</div>
									<div class="col-md-10 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> 
											<select id="primera_select_categoria" name="primera_select_categoria">
												<option value="-1" selected>Seleccionar ...</option>
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
										<label style="cursor: text;">Categoría secundaria</label>
									</div>
									<div class="col-md-10 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> 
											<select id="segunda_select_categoria" name="segunda_select_categoria">
												<option value="-1" selected>Seleccionar ...</option>
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
										<label style="cursor: text;">Categoría secundaria</label>
									</div>
									<div class="col-md-10 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> 
											<select id="tercera_select_categoria" name="tercera_select_categoria">
												<option value="-1" selected>Seleccionar ...</option>
												<?php foreach ($listadoCategorias as $key => $value) { ?>
													<option value="<?php echo $value->id_categoria; ?>">
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
									<div class="col-md-12 nodosfilas" id="especialidades"></div>
									<div class="col-md-12 nodosfilas">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> 
												<input type="text" id="nueva_especialidad" placeholder="Introduce una especialidad, Ej. Carne a la brasa">
										</div>
									</div>
									<div id="mensaje_especialidades" class="mensajeconfondo"></div>
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
									<div class="col-md-12 nodosfilas" id="puntosInteres"></div>
									<div class="col-md-12 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
												<input type="text" id="nuevo_interes" placeholder="Introduce un punto de interés, Ej. Puerta de Alcalá">
										</div>
									</div>
									<div id="mensaje_interes" class="mensajeconfondo"></div>
									<div class="enlacesencillo reducirfila">
										<a href="#" id="btnAddPuntoInteres">Añadir más puntos de interés<span>
										<i class="fa fa-arrow-circle-right"></i></span>
										</a>
									</div>
								</div>




								<hr class="bordepunteadogris">




								<div class="separadorpeq"></div>
								<h6>Alta de restaurante - Estaciones de metro</h6>
								<div class="row">
									<div class="col-md-12 nodosfilas" id="estacionesMetro"></div>
									<div class="col-md-12 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> 
											<select name="nueva_estacion" id="nueva_estacion" class="listadoEstaciones">
												<option value="-1" selected>Seleccionar</option>
												<?php foreach ($listadoEstaciones as $key => $value) { ?>
												<option value="<?php echo $value->id_estacion; ?>"><?php echo $value->nombre_estacion; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div id="mensaje_metro" class="mensajeconfondo"></div>
									<div class="enlacesencillo reducirfila">
										<a href="#" id="btnAddEstaciones">Añadir más paradas de metro
											<span><i class="fa fa-arrow-circle-right"></i></span>
										</a>
									</div>

								</div>




								<div class="separadorpeq"></div>
                                
								<div id="mensaje_resultado" class="mensajeconfondo"></div>
                            
								<div class="row centrar reducirfila">
									<input type="hidden" name="clave_restaurante" id="clave_restaurante" value="<?php echo $clave_restaurante; ?>">
									<input type="hidden" name="clave_plan" id="clave_plan" value="<?php echo $clave_plan; ?>">
									<input class="button-3 botonpeq" id="btnAddOtrosDatosRestaurante" type="button" value="Guardar datos">
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
