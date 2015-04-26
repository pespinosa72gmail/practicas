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
									<a href="#seleccion">Seleccionar restaurante
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#gestiontipos">Tipos de menú
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#gestionmenus">Gestionar menús
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#propietario">Datos propietario
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#datosrestaurante">Datos restaurante
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#facturacion">Datos facturación
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#cupones">Cupones y descuentos
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#" id="btnViewFranquiciadoGestRestaurante">Alta / Baja restaurantes<span>
									<i class="fa fa-arrow-circle-right"></i></span></a>
								</li>

								<li>
									<a href="#fotos">Fotos restaurante
										<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

							</ul>
						</nav>
					</div>
				</div>
				<!-- FIN Primera columna 2/12 -->

				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">
					<article class="seccion-restaurante">
						<h5>Gestión de restaurantes</h5>
						<div class="row">
							<div class="col-md-6">
								<div class="callout-a ">
									<a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado'); ?>" class="button-3">Volver a panel de control</a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="callout-a ">
									<a href="#" class="button-3">Desconectar</a>
								</div>
							</div>
						</div>
					</article>

					<article id="seleccion" class="seccion-restaurante">
						<h6>Selección de restaurante</h6>
						<p>
							Selección actual: <span class="restauranteseleccionado">Restaurante Rodado (Boadilla del Monte, Madrid)</span>
						</p>
						<div class="enlacesencillo">
							<a href="#">Seleccionar otro restaurante<span><i
									class="fa fa-arrow-circle-right"></i></span></a>
						</div>
						<div class="clear"></div>
						<p>Selecciona el restaurante que quieres gestionar :</p>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" Placeholder="Nombre del restaurante">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Buscar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-12">
										<ul class="restaurantesfavoritos_seleccion">
											<?php if($listadoRestaurantesFranquiciado){ ?>
											<?php foreach ($listadoRestaurantesFranquiciado as $key => $value) { ?>
												<li>
													<div class="row">
														<div class="col-md-2 nodosfilas ocultar">
															<img alt="" src="<?php echo base_url(); ?>assets/images/restaurantes/00001_Restaurante01/principal.jpg">
														</div>
														<div class="col-md-6 nodosfilas convertir8">
															<div>
																<strong>ID</strong>: <?php echo $value->id_restaurante; ?>
															</div>
															<div>
																<strong>Nombre</strong>: <?php echo $value->nombre_restaurante; ?>
															</div>
															<div>
																<strong>Municipio</strong>: <?php echo $value->nombre_localidad; ?>
															</div>
															<div>
																<strong>Categoría</strong>: <?php echo $value->nombre_categoria; ?>
															</div>
															<div>
																<strong>Precio menú</strong>: <?php echo $value->precio_medio_restaurante; ?>
															</div>
														</div>
														<div class="col-md-4 nodosfilas">
															<div class="enlacesencillo">
																<a href="#">Seleccionar<span><i
																		class="fa fa-arrow-circle-right"></i></span></a>
															</div>
														</div>
													</div>
												</li>
											<?php } ?>
											<?php }else{ ?>
												<p style="text-align: center;">No hay Restaurantes</p>
											<?php } ?>

										</ul>
										<div class="enlacesencillo">
											<a href="panelcontrol_restaurador2.php">Alta de nuevo
												restaurante<span><i class="fa fa-arrow-circle-right"></i></span>
											</a>
										</div>


									</div>
							</form>
						</div>
						<div class="clear"></div>
					</article>

					<article id="gestiontipos" class="seccion-restaurante">
						<h6>Tipos de menú</h6>
						<p>A continuación se indican los tipos de menús que tiene
							asociados el restaurante. Puede añadir más en la parte inferior.</p>
						<p>
							En todos ellos, podrá indicar en la sección "Gestionar menús" si
							incluyen <strong>café, bebida y postre</strong>.
						</p>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-pencil"></i> <input name="name" id="name"
												type="text" value="Menú del día">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-pencil"></i> <input name="name" id="name"
												type="text" value="Menú ejecutivo">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
								</div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<h6>Alta de tipo de menú</h6>
								<div class="row">
									<div class="col-md-3">
										<label>Nombre</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-pencil"></i> <input name="name" id="name"
												type="text"
												placeholder="Introduce un nombre, Ej. Menú fin de semana">
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Estructura</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<input type="radio" name="estructura" checked><label>Primeros
												+ Segundos (típico menú del día)</label>
										</div>
										<div class="clear"></div>
										<div class="form-input">
											<input type="radio" name="estructura"><label>Entrante
												+ Primeros + Segundos</label>
										</div>
										<div class="clear"></div>
										<div class="form-input">
											<input type="radio" name="estructura"><label>Entrante
												+ Plato principal</label>
										</div>
										<div class="clear"></div>
									</div>
									<div class="clear"></div>
								</div>
								<div class="row centrar reducirfila">
									<input class="button-3 botonpeq" type="submit"
										value="Guardar tipo">
								</div>

							</form>
						</div>
					</article>

					<article id="gestionmenus" class="seccion-restaurante">
						<h6>Gestión menús</h6>
						<div class="accordion accordion-2 toggle-accordion">
							<div class="section-content">
								<h4 class="accordion-title active">
									<a href="#">Menú del día<i class="fa fa-plus"></i></a>
								</h4>
								<div class="accordion-inner active">
									<div class="form-generico">
										<form method="post" id="form-1" action="#">
											<div class="row">
												<div class="col-md-6 nodosfilas">
													<div class="col-md-4">
														<label>Fecha</label>
													</div>
													<div class="col-md-8 nodosfilas convertir12">
														<div class="form-input">
															<i class="fa fa-calendar"></i> <input name="name"
																id="name" type="text" value="10/10/2014">
														</div>
													</div>
												</div>
												<div class="col-md-6 nodosfilas">
													<div class="col-md-4">
														<label>Precio</label>
													</div>
													<div class="col-md-8 nodosfilas convertir12">
														<div class="form-input">
															<i class="fa fa-eur"></i> <input name="name" id="name"
																type="text" value="9,5">
														</div>
													</div>
												</div>
											</div>
											<!-- End row -->
											<hr class="bordepunteadogris">

											<div class="alerts">
												<i class="fa fa-star"></i>
												<div>
													<h3>Selección de menús habituales</h3>
													<p>Si lo prefieres, puedes seleccionar uno de tus menús
														guardados para no teclearlos de nuevo. Sobre ellos puedes
														modificar lo que quieras:</p>
													<div class="row">
														<div class="col-md-6">

															<label><a href="#">Menú de los lunes&nbsp;<i
																	class="fa fa-check-circle"></i></a>&nbsp;<a href="#"><i
																	class="fa fa-times-circle"></i></a></label> <label><a
																href="#">Menú de los martes&nbsp;<i
																	class="fa fa-check-circle"></i></a>&nbsp;<a href="#"><i
																	class="fa fa-times-circle"></i></a></label> <label><a
																href="#">Menú de los miércoles&nbsp;<i
																	class="fa fa-check-circle"></i></a>&nbsp;<a href="#"><i
																	class="fa fa-times-circle"></i></a></label> <label><a
																href="#">Menú de los jueves&nbsp;<i
																	class="fa fa-check-circle"></i></a>&nbsp;<a href="#"><i
																	class="fa fa-times-circle"></i></a></label>

														</div>
														<div class="col-md-6">

															<label><a href="#">Menú de los viernes&nbsp;<i
																	class="fa fa-check-circle"></i></a>&nbsp;<a href="#"><i
																	class="fa fa-times-circle"></i></a></label> <label><a
																href="#">Menú del día paella&nbsp;<i
																	class="fa fa-check-circle"></i></a>&nbsp;<a href="#"><i
																	class="fa fa-times-circle"></i></a></label> <label><a
																href="#">Menú del día caldereta&nbsp;<i
																	class="fa fa-check-circle"></i></a>&nbsp;<a href="#"><i
																	class="fa fa-times-circle"></i></a></label>

														</div>
													</div>
												</div>
											</div>
											<div class="row derecha">
												<input class="button-3 botonpeq" type="submit"
													value="Borrar cajas y escribir de nuevo">
											</div>
											<div class="separadorpeq"></div>
											<div class="row">
												<div class="col-md-6 dosfilas">
													<h5>PRIMEROS</h5>
													<div class="row">
														<div class="col-md-10 nodosfilas">
															<div class="form-input">
																<i class="fa fa-cutlery"></i> <input name="name"
																	id="name" type="text" value="Arroz con pollo">
															</div>
														</div>
														<div class="col-md-2 nodosfilas">
															<div class="form-input">
																<div class="form-input">
																	<div class="callout-a ">
																		<a href="#" class="button-3">X</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10 nodosfilas">
															<div class="form-input">
																<i class="fa fa-cutlery"></i> <input name="name"
																	id="name" type="text" value="Arroz a la cubana">
															</div>
														</div>
														<div class="col-md-2 nodosfilas">
															<div class="form-input">
																<div class="callout-a ">
																	<a href="#" class="button-3">X</a>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10 nodosfilas">
															<div class="form-input">
																<i class="fa fa-cutlery"></i> <input name="name"
																	id="name" type="text" value="Lentejas">
															</div>
														</div>
														<div class="col-md-2 nodosfilas">
															<div class="form-input">
																<div class="callout-a ">
																	<a href="#" class="button-3">X</a>
																</div>
															</div>
														</div>
													</div>
													<div class="clear"></div>
													<div class="enlacesencillo">
														<a href="#">Añadir más primeros<span><i
																class="fa fa-arrow-circle-right"></i></span></a>
													</div>
												</div>
												<div class="col-md-6 dosfilas">
													<h5>SEGUNDOS</h5>
													<div class="row">
														<div class="col-md-10 nodosfilas">
															<div class="form-input">
																<i class="fa fa-cutlery"></i> <input name="name"
																	id="name" type="text" value="Judías verdes con tomate">
															</div>
														</div>
														<div class="col-md-2 nodosfilas">
															<div class="form-input">
																<div class="callout-a ">
																	<a href="#" class="button-3">X</a>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10 nodosfilas">
															<div class="form-input">
																<i class="fa fa-cutlery"></i> <input name="name"
																	id="name" type="text" value="Carne con patatas">
															</div>
														</div>
														<div class="col-md-2 nodosfilas">
															<div class="form-input">
																<div class="callout-a ">
																	<a href="#" class="button-3">X</a>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-10 nodosfilas">
															<div class="form-input">
																<i class="fa fa-cutlery"></i> <input name="name"
																	id="name" type="text"
																	value="Salmón a la plancha con guarnición">
															</div>
														</div>
														<div class="col-md-2 nodosfilas">
															<div class="form-input">
																<div class="callout-a ">
																	<a href="#" class="button-3">X</a>
																</div>
															</div>
														</div>
													</div>
													<div class="clear"></div>
													<div class="enlacesencillo">
														<a href="#">Añadir más segundos<span><i
																class="fa fa-arrow-circle-right"></i></span></a>
													</div>
												</div>
											</div>
											<hr class="bordepunteadogris">
											<div class="separadorgrande"></div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-input">
														<input type="checkbox" checked><label>Con
															postre</label>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-input">
														<input type="checkbox"><label>Con café</label>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-input">
														<input type="checkbox" checked><label>Con
															pan</label>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-input">
														<input type="checkbox" checked><label>Con
															bebida</label>
													</div>
												</div>
											</div>
											<div class="separadorpeq"></div>
											<div class="row">
												<div class="col-md-3">
													<label>Observaciones</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-pencil"></i>
														<textarea name="name" id="name" type="text"></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<p class="reducirfila">¿Este menú lo vas a reutilizar a
													menudo? Ponle un nombre y dale a "Guardar como menú
													habitual"</p>
												<div class="col-md-8 nodosfilas">
													<div class="form-input">
														<i class="fa fa-cutlery"></i> <input name="name" id="name"
															type="text"
															placeholder="Ej. Menú de los lunes, Menú arroces, etc...">
													</div>
												</div>
												<div class="col-md-4 nodosfilas">
													<div class="form-input">
														<div class="callout-a ">
															<a href="#" class="button-3">Guardar como menú
																habitual</a>
														</div>
													</div>
												</div>
											</div>
											<div class="separadorpeq"></div>
											<div class="row centrar reducirfila">
												<input class="button-3 botonpeq" type="submit"
													value="Actualizar menú">
											</div>

										</form>
									</div>
								</div>
							</div>
							<div class="section-content">
								<h4 class="accordion-title">
									<a href="#">Menú ejecutivo<i class="fa fa-minus"></i></a>
								</h4>
								<div class="accordion-inner"></div>
							</div>
							<div class="section-content">
								<h4 class="accordion-title">
									<a href="#">Menú fin de semana<i class="fa fa-minus"></i></a>
								</h4>
								<div class="accordion-inner"></div>
							</div>
						</div>
						<div class="form-generico">
							<form method="post" id="form-1" action="#"></form>
						</div>
					</article>

					<article id="propietario" class="seccion-restaurante">
						<h6>Datos propietario</h6>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-2">
										<label>Nombre propietario</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> <input name="name" id="name"
												type="text" value="Alba">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="mensajeexito">
										<i class="fa fa-info-circle"></i>&nbsp;&nbsp;Se ha modificado
										con éxito.
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Apellidos</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> <input name="name" id="name"
												type="text" value="Alba">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Correo electrónico</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-envelope"></i> <input name="name" id="name"
												type="text" value="alba.alcaide@nablae.es">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Contraseña acceso</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-key"></i> <input name="name" id="name"
												type="text" value="20122312x">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Teléfono</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-phone"></i> <input name="name" id="name"
												type="text" value="989 2349 83">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Código postal</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="28600">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Municipio</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" class="clarito" value="Navalcarnero" disabled>
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
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" class="clarito" value="Madrid" disabled>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<span class="nota">Asociado al CP</span>
									</div>
									<div class="clear"></div>
							</form>
						</div>
					</article>

					<article id="datosrestaurante" class="seccion-restaurante">
						<h6>Datos restaurante</h6>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-2">
										<label>Nombre restaurante</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> <input name="name" id="name"
												type="text" value="Alba">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Web</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-external-link"></i> <input name="name"
												id="name" type="text" value="www.mirestaurante.com">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Calle</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="Labrador">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Número</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="8">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Código postal</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="28600">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Municipio</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" class="clarito" value="Navalcarnero" disabled>
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
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" class="clarito" value="Madrid" disabled>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<span class="nota">Asociado al CP</span>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Barrio</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="El Pinar">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Precio medio carta</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-eur"></i> <select>
												<option>Precio carta</option>
												<option>Menos de 15€</option>
												<option selected>16-25€</option>
												<option>26-35€</option>
												<option>36-50€</option>
												<option>Más de 51€</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Subir carta</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<input name="name" id="name" type="file">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="separadorpeq"></div>
									<div class="row reducirfila">
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" checked><label>Tiene
													Parking</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox"><label>Permite
													tarjeta</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" checked><label>Permite
													reservas</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" checked><label>Está
													visible</label>
											</div>
										</div>
									</div>
								</div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<h6>Categoría del restaurante</h6>
								<div class="row">
									<div class="col-md-2">
										<label>Categoría principal</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> <select>
												<option selected>De autor</option>
												<option>Vasca</option>
												<option>Oriental</option>
												<option>Árabe</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Categoría secundaria</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> <select>
												<option>De autor</option>
												<option>Vasca</option>
												<option>Oriental</option>
												<option selected>Árabe</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Añadir otra categoría secundaria</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> <select>
												<option>Seleccionar...</option>
												<option>De autor</option>
												<option>Vasca</option>
												<option>Oriental</option>
												<option>Árabe</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Añadir</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>

								</div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<h6>Especialidades</h6>
								<div class="row">
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> <input name="name" id="name"
												type="text" value="Carne a la brasa">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> <input name="name" id="name"
												type="text" value="Chuleta lechal">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-cutlery"></i> <input name="name" id="name"
												type="text" value="" Placeholder="Añadir otra especialidad">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Añadir</a>
											</div>
										</div>
									</div>
								</div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<h6>Puntos de interés</h6>
								<div class="row">
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="Puerta de Alcalá">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="El Retiro">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value=""
												Placeholder="Añadir otro punto de interés">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Añadir</a>
											</div>
										</div>
									</div>
								</div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<h6>Estaciones de metro</h6>
								<div class="row">
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <select>
												<option selected>Argüelles</option>
												<option>Sol</option>
												<option>La Latina</option>
												<option>Las Tablas</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <select>
												<option>Argüelles</option>
												<option>Sol</option>
												<option selected>La Latina</option>
												<option>Las Tablas</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Eliminar</a>
											</div>
										</div>
									</div>
									<div class="col-md-9 nodosfilas">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <select>
												<option>Añadir otra estación</option>
												<option>Argüelles</option>
												<option>Sol</option>
												<option>La Latina</option>
												<option>Las Tablas</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Añadir</a>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</article>

					<article id="facturacion" class="seccion-restaurante">
						<h6>Datos facturación</h6>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-2">
										<label>Razón Social</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> <input name="name" id="name"
												type="text" value="Rodado S.L.">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>CIF / NIF</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i> <input name="name" id="name"
												type="text" value="C8982KK34K2">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Calle</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="Real">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Número</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="2">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Código Postal</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" value="28600">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Municipio</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" class="clarito" value="Navalcarnero" disabled>
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
											<i class="fa fa-map-marker"></i> <input name="name" id="name"
												type="text" class="clarito" value="Madrid" disabled>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<span class="nota">Asociado al CP</span>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Correo electrónico facturación</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-envelope"></i> <input name="name" id="name"
												type="text" value="alba.alcaide@nablae.es">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Periodo de facturación</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-calendar"></i> <input name="name" id="name"
												type="text" value="01/01/2014" disabled>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Plan contratado</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-eur"></i> <select>
												<option selected>A</option>
												<option>B</option>
												<option>C</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Forma de pago</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">

										<div class="form-input">
											<input type="radio" name="estructura"><label>Tarjeta</label>
										</div>
										<div class="clear"></div>
										<div class="form-input">
											<input type="radio" name="estructura" checked><label>Cuenta
												bancaria</label>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-2">
										<label>Número de cuenta bancaria</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-credit-card"></i> <input name="name"
												id="name" type="text" value="2222334132234234234">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
							</form>
						</div>
					</article>

					<article id="cupones" class="seccion-restaurante">
						<h6>Cupones y descuentos</h6>
						<p>A continuación se indican los cupones y descuentos vigentes
							en el restaurante. Puede modificarlos o añadir más en la parte
							inferior.</p>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-6">
										<div class="callout">
											<div class="row">
												<div class="col-md-3">
													<label>Título</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-pencil"></i> <input name="name" id="name"
															type="text" placeholder=""
															Value="Oferta 2 x 1 en cafés mes de noviembre">
													</div>
												</div>
												<div class="col-md-3">
													<label>Descripción</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-pencil"></i>
														<textarea name="name" id="name">Para todos nuestros clientes aplicamos un 2x1 en cafés durante el mes de noviembre. ¡No te pierdas la promoción!
                                                                </textarea>
													</div>
												</div>
												<div class="col-md-3">
													<label>Inicio promoción</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-calendar"></i> <input name="name"
															id="name" type="text" placeholder="" Value="01/11/2014">
													</div>
												</div>
												<div class="col-md-3">
													<label>Fin promoción</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-calendar"></i> <input name="name"
															id="name" type="text" placeholder="" Value="30/11/2014">
													</div>
												</div>
												<div class="col-md-6 nodosfilas">
													<input class="button-4" type="submit" value="Eliminar">
												</div>
												<div class="col-md-6 nodosfilas">
													<input class="button-3" type="submit" value="Modificar">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="callout">
											<div class="row">
												<div class="col-md-3">
													<label>Título</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-pencil"></i> <input name="name" id="name"
															type="text" placeholder=""
															Value="Paga 4 menús y uno te sale gratis">
													</div>
												</div>
												<div class="col-md-3">
													<label>Descripción</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-pencil"></i>
														<textarea name="name" id="name">Si venís cuatro personas, a uno de ellos le saldrá gratis el menú.
                                                                </textarea>
													</div>
												</div>
												<div class="col-md-3">
													<label>Inicio promoción</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-calendar"></i> <input name="name"
															id="name" type="text" placeholder="" Value="01/11/2014">
													</div>
												</div>
												<div class="col-md-3">
													<label>Fin promoción</label>
												</div>
												<div class="col-md-9 nodosfilas convertir12">
													<div class="form-input">
														<i class="fa fa-calendar"></i> <input name="name"
															id="name" type="text" placeholder="" Value="30/11/2014">
													</div>
												</div>
												<div class="col-md-6 nodosfilas">
													<input class="button-4" type="submit" value="Eliminar">
												</div>
												<div class="col-md-6 nodosfilas">
													<input class="button-3" type="submit" value="Modificar">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="separadorpeq"></div>
								<hr class="bordepunteadogris">
								<div class="separadorpeq"></div>
								<p>Añadir oferta o cupón:</p>
								<div class="row">
									<div class="col-md-2">
										<label>Título</label>
									</div>
									<div class="col-md-10 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-pencil"></i> <input name="name" id="name"
												type="text" placeholder="" Value="">
										</div>
									</div>
									<div class="col-md-2">
										<label>Descripción</label>
									</div>
									<div class="col-md-10 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-pencil"></i>
											<textarea name="name" id="name">
                                                                </textarea>
										</div>
									</div>
									<div class="col-md-2 nodosfilas">
										<label>Inicio promoción</label>
									</div>
									<div class="col-md-4 nodosfilas">
										<div class="form-input">
											<i class="fa fa-calendar"></i> <input name="name" id="name"
												type="text" placeholder="" Value="">
										</div>
									</div>
									<div class="col-md-2 nodosfilas">
										<label>Fin promoción</label>
									</div>
									<div class="col-md-4 nodosfilas">
										<div class="form-input">
											<i class="fa fa-calendar"></i> <input name="name" id="name"
												type="text" placeholder="" Value="">
										</div>
									</div>
									<div class="col-md-12 centrar">
										<input class="button-3 botonpeq" type="submit" value="Añadir">
									</div>
								</div>
						</div>
					</article>

					<article id="fotos" class="seccion-restaurante">
						<h6>Fotos restaurante</h6>
						<p>Estas son las fotos dadas de alta actualmente para este
							restaurante:</p>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row portfolio-all portfolio-0 ajustaralto">
									<ul>
										<li
											class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
											<div class="portfolio-one rellenarfondo">
												<div class="portfolio-head">
													<div class="portfolio-img">
														<img alt=""
															src="images/restaurantes/00001_Restaurante01/principal.jpg">
													</div>
													<div class="portfolio-hover">
														<div class="portfolio-meta">
															<div class="portfolio-name">
																<div class="form-input">
																	<i class="fa fa-pencil"></i> <input name="name"
																		id="name" type="text" value="Salón">
																</div>
																<div class="form-input">
																	<input type="checkbox" checked><label>Principal</label>
																</div>
															</div>
														</div>
														<!-- End portfolio-meta -->
														<a class="portfolio-link" href="#"><i
															class="fa fa-times"></i></a> <a
															class="portfolio-zoom prettyPhoto"
															href="images/restaurantes/00001_Restaurante01/principal.jpg"><i
															class="fa fa-search"></i></a>
													</div>
												</div>
												<!-- End portfolio-head -->
											</div>
											<!-- End portfolio-item -->
										</li>
										<li
											class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
											<div class="portfolio-one rellenarfondo">
												<div class="portfolio-head">
													<div class="portfolio-img">
														<img alt=""
															src="images/restaurantes/00001_Restaurante01/salon.jpg">
													</div>
													<div class="portfolio-hover">
														<div class="portfolio-meta">
															<div class="portfolio-name">
																<div class="form-input">
																	<i class="fa fa-pencil"></i> <input name="name"
																		id="name" type="text" value="Salón">
																</div>
																<div class="form-input">
																	<input type="checkbox"><label>Principal</label>
																</div>
															</div>
														</div>
														<!-- End portfolio-meta -->
														<a class="portfolio-link" href="#"><i
															class="fa fa-times"></i></a> <a
															class="portfolio-zoom prettyPhoto"
															href="images/restaurantes/00001_Restaurante01/salon.jpg"><i
															class="fa fa-search"></i></a>
													</div>
												</div>
												<!-- End portfolio-head -->
											</div>
											<!-- End portfolio-item -->
										</li>
										<li
											class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
											<div class="portfolio-one rellenarfondo">
												<div class="portfolio-head">
													<div class="portfolio-img">
														<img alt=""
															src="images/restaurantes/00001_Restaurante01/salon2.jpg">
													</div>
													<div class="portfolio-hover">
														<div class="portfolio-meta">
															<div class="portfolio-name">
																<div class="form-input">
																	<i class="fa fa-pencil"></i> <input name="name"
																		id="name" type="text" value="Salón">
																</div>
																<div class="form-input">
																	<input type="checkbox"><label>Principal</label>
																</div>
															</div>
														</div>
														<!-- End portfolio-meta -->
														<a class="portfolio-link" href="#"><i
															class="fa fa-times"></i></a> <a
															class="portfolio-zoom prettyPhoto"
															href="images/restaurantes/00001_Restaurante01/salon2.jpg"><i
															class="fa fa-search"></i></a>
													</div>
												</div>
												<!-- End portfolio-head -->
											</div>
											<!-- End portfolio-item -->
										</li>
										<li
											class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
											<div class="portfolio-one rellenarfondo">
												<div class="portfolio-head">
													<div class="portfolio-img">
														<img alt=""
															src="images/restaurantes/00001_Restaurante01/detalleplato.jpg">
													</div>
													<div class="portfolio-hover">
														<div class="portfolio-meta">
															<div class="portfolio-name">
																<div class="form-input">
																	<i class="fa fa-pencil"></i> <input name="name"
																		id="name" type="text" value="Salón">
																</div>
																<div class="form-input">
																	<input type="checkbox"><label>Principal</label>
																</div>
															</div>
														</div>
														<!-- End portfolio-meta -->
														<a class="portfolio-link" href="#"><i
															class="fa fa-times"></i></a> <a
															class="portfolio-zoom prettyPhoto"
															href="images/restaurantes/00001_Restaurante01/detalleplato.jpg"><i
															class="fa fa-search"></i></a>
													</div>
												</div>
												<!-- End portfolio-head -->
											</div>
											<!-- End portfolio-item -->
										</li>
									</ul>

								</div>

								<div class="row centrar reducirfila">
									<input class="button-3 botonpeq" type="submit"
										value="Guardar cambios">
								</div>
								<div class="separadorpeq"></div>
								<div class="row centrar reducirfila">
									<input class="button-4 botonpeq" type="button"
										onclick="window.location.href='panelcontrol_restaurador3.php'"
										value="Añadir más fotos">
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
