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
									<a href="#franquiciado">
										Datos franquiciado<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a id="btnUrlGestionPropietarios">
										Gestión propietarios<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>
								
								<li>
									<a href="#" id="btnUrlGestionRestaurantes"> 
									Gestión restaurantes<span><i class="fa fa-arrow-circle-right"></i></span>
									</a>
								</li>

								<li>
									<a href="#soporte">Soporte<span>
										<i class="fa fa-arrow-circle-right"></i></span>
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
						<div class="row">
							<div class="col-md-9">
								<h5>Bienvenido User</h5>
							</div>
							<div class="col-md-3">
								<div class="callout-a ">
									<a href="#" class="button-3">Desconectar</a>
								</div>
							</div>
						</div>
					</article>


					<article id="franquiciado" class="seccion-restaurante">
						<h6>Datos franquiciado</h6>
						<div class="form-generico">


							<form method="post" id="form-1" action="#">
								<div class="row">

									<div class="mensajeexito" style="display:none;">
										
									</div>



									<div class="col-md-2">
										<label>Nombre franquiciado</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<?php if($datosFranquiciado->nombre_franquiciado != ""){ ?>
												<input name="nombre_franquiciado" id="nombre_franquiciado" type="text" value="<?php echo $datosFranquiciado->nombre_franquiciado; ?>">
											<?php }else{ ?>
												<input name="nombre_franquiciado" id="nombre_franquiciado" type="text" placeholder="Pon tu nombre">
											<?php } ?>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataFranquiciado">Modificar</a>
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

											<?php if($datosFranquiciado->apellidos_franquiciado != ""){ ?>
												<input name="apellidos_franquiciado" id="apellidos_franquiciado" type="text" value="<?php echo $datosFranquiciado->apellidos_franquiciado; ?>" />
											<?php }else{ ?>
												<input name="apellidos_franquiciado" id="apellidos_franquiciado" type="text" placeholder="Pon tus apellidos" />
											<?php } ?>

										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataFranquiciado">Modificar</a>
											</div>
										</div>
									</div>




									<div class="clear"></div>




									<div class="col-md-2">
										<label>CIF / NIF</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<?php if($datosFranquiciado->cif_franquiciado != ""){ ?>
												<i class="fa fa-user"></i> <input name="cif_franquiciado" id="cif_franquiciado" type="text" value="<?php echo $datosFranquiciado->cif_franquiciado; ?>" />
											<?php }else{ ?>
												<i class="fa fa-user"></i> <input name="cif_franquiciado" id="cif_franquiciado" type="text" placeholder="Pon tu CIF/NIF" />
											<?php } ?>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataFranquiciado">Modificar</a>
											</div>
										</div>
									</div>




									<div class="clear"></div>




									<div class="col-md-2">
										<label>Correo electrónico</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<?php if($datosFranquiciado->email_franquiciado != ""){ ?>
												<i class="fa fa-envelope"></i> 
												<input type="text" name="email_franquiciado" id="email_franquiciado" value="<?php echo $datosFranquiciado->email_franquiciado; ?>" />
											<?php }else{ ?>
												<i class="fa fa-envelope"></i> 
												<input type="text" name="email_franquiciado" id="email_franquiciado" placeholder="Añade tu E-mail" />
											<?php } ?>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataFranquiciado">Modificar</a>
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
											<input type="password" name="password_franquiciado" id="password_franquiciado" placeholder="Escriba una nueva contraseña para cambiarla">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditPasswordFranquiciado">Modificar</a>
											</div>
										</div>
									</div>





									<div class="clear"></div>





									<div class="col-md-2">
										<label>Teléfono</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<?php if($datosFranquiciado->telefono_franquiciado != ""){ ?>
												<i class="fa fa-phone"></i> 
												<input name="telefono_franquiciado" id="telefono_franquiciado" type="text" value="<?php echo $datosFranquiciado->telefono_franquiciado; ?>" />
											<?php }else{ ?>
												<i class="fa fa-phone"></i> 
												<input name="telefono_franquiciado" id="telefono_franquiciado" type="text" placeholder="Teléfono franquiciado" />
											<?php } ?>

										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataFranquiciado">Modificar</a>
											</div>
										</div>
									</div>




									<div class="clear"></div>




									<div class="col-md-2">
										<label>Código postal propio</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">

										<?php if($datosFranquiciado->cp_franquiciado != ""){ ?>
											<i class="fa fa-map-marker"></i> 
											<input name="cp_franquiciado" id="cp_franquiciado" type="text" value="<?php echo $datosFranquiciado->cp_franquiciado; ?>" />
										<?php }else{ ?>
											<i class="fa fa-map-marker"></i> 
											<input name="cp_franquiciado" id="cp_franquiciado" type="text" placeholder="Código Postal" />
										<?php } ?>

										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a ">
												<a href="#" class="button-3" id="btnEditDataFranquiciado">Modificar</a>
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
											<input name="localidad_franquiciado" id="localidad_franquiciado" type="text" class="clarito" value="<?php echo $obtenerCpFranquiciado->nombre_localidad; ?>" disabled>
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
											<input name="name" id="name" type="text" class="clarito" value="<?php echo $obtenerCpFranquiciado->nombre_provincia; ?>" disabled>
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<span class="nota">Asociado al CP</span>
									</div>




									<div class="clear"></div>




									<hr class="bordepunteadogris">





									<div class="separadorpeq"></div>
									<div class="reducirfila" id="cpFranquiciados">
										<h6>Alcance de la franquicia - Códigos postales autorizados</h6>
									</div>



									<?php foreach ($listadoCpAsignados as $key => $value) { ?>
										<div class="col-md-2">
											<label>CP</label>
										</div>
										<div class="col-md-7 nodosfilas convertir9">
											<div class="form-input">
												<i class="fa fa-map-marker"></i> 
												<input name="cp_asig_franquiciado" id="cp_asig_franquiciado" type="text" value="<?php echo $value->cp_rel_franquiciado_cp; ?>">
											</div>
										</div>
										<div class="col-md-3 nodosfilas">
											<div class="form-input">
												<div class="callout-a ">
													<a href="<?php echo base_url(); ?>acceso/franquiciado/eliminar-cp-asignado?clave=<?php echo $value->id_rel_franquiciado_cp; ?>" class="button-3">Eliminar</a>
												</div>
											</div>
										</div>
										<div class="clear"></div>
									<?php } ?>

								</div>


								<input type="hidden" id="id_franquiciado" name="id_franquiciado" value="<?php echo $datosFranquiciado->id_franquicia; ?>" />

							</form>

						</div>
					</article>





					<article id="soporte" class="seccion-restaurante">
						<h6>Soporte técnico</h6>
						<p>¿Tienes cualquier duda o consulta? Mándanosla a través de
							este formulario y te contestaremos lo antes posible:</p>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">

								<div class="row">
									<div class="col-md-1">
										<label>Mensaje</label>
									</div>
									<div class="col-md-11">
										<div class="form-input">
											<i class="fa fa-comment"></i>
											<textarea name="message_support_franquiciado" id="message_support_franquiciado"></textarea>
										</div>
									</div>

									<div class="clear"></div>

									<div class="separadorpeq"></div>
									<div class="row centrar reducirfila">
										<input class="button-3 botonpeq" type="submit" value="Enviar">
									</div>
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

