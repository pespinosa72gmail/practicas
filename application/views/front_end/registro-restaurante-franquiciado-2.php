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

					<div class="mensajeexito" style="display: none;">
						<div class="altaFranquiciadoRestaurante"></div>
					</div>

						<h6>Alta de restaurante - Datos restaurante</h6>
						<div class="form-generico">
							<form method="post" id="form-1" action="#">
								<div class="row">
									<div class="col-md-3">
										<label>Tipo establecimiento</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-cutlery"></i>
											<select name="nombre_select_restaurante" id="nombre_select_restaurante">
												<option selected value="Restaurante">Restaurante</option>
												<option value="Bar">Bar</option>
												<option value="Mesón">Mesón</option>
												<option value="Asador">Asador</option>
												<option value="">Otro (ponerlo junto al nombre del restaurante)</option>
											</select>
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Nombre restaurante</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input name="nombre_restaurante" id="nombre_restaurante" type="text" value="" required>
										</div>
									</div>



									
									<?php if($planContratado != "eJ6RW7aD"){ ?>
										<div class="clear"></div>
										<div class="col-md-3">
											<label>Web</label>
										</div>
										<div class="col-md-9 nodosfilas convertir12">
											<div class="form-input">
												<i class="fa fa-external-link"></i>
												<input name="web_restaurante" id="web_restaurante" type="text" value="">
											</div>
										</div>
									<?php }else{ ?>
										<input name="web_restaurante" id="web_restaurante" type="hidden" value="www.nada.com">
									<?php	} ?>


									<?php if($planContratado != "eJ6RW7aD"){ ?>
										<div class="clear"></div>
										<div class="col-md-3">
											<label>E-mail</label>
										</div>
										<div class="col-md-9 nodosfilas convertir12">
											<div class="form-input">
												<i class="fa fa-user"></i>
												<input name="email_restaurante" id="email_restaurante" type="text" value="">
											</div>
										</div>
									<?php } ?>


									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Calle</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="direccion_restaurante" id="direccion_restaurante" type="text" value="" required>
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Número</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="numero_restaurante" id="numero_restaurante" type="text" value="" required>
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Código postal</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="cp_restaurante" id="cp_restaurante" type="text" value="" required>
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Municipio</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="localidad_restaurante" id="localidad_restaurante" type="text" class="clarito" placeholder="Asociado al CP" disabled>
										</div>
									</div>

									<div class="clear"></div>
									<div class="col-md-3">
										<label>Provincia</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="provincia_restaurante" id="provincia_restaurante" type="text" class="clarito" placeholder="Asociado al CP" disabled>
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Barrio</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="barrio_restaurante" id="barrio_restaurante" type="text" value="" required>
										</div>
									</div>
									

									<?php if($planContratado != "eJ6RW7aD"){ ?>
										<div class="clear"></div>
										<div class="col-md-3">
											<label>Precio medio carta</label>
										</div>
										<div class="col-md-9 nodosfilas convertir12">
											<div class="form-input">
												<i class="fa fa-eur"></i>
												<select name="precio_medio_restaurante" id="precio_medio_restaurante">
													<option selected>Seleccionar...</option>
													<option value="Menos de 15€">Menos de 15€</option>
													<option value="16-25€">16-25€</option>
													<option value="26-35€">26-35€</option>
													<option value="36-50€">36-50€</option>
													<option value="Más de 51€">Más de 51€</option>
												</select>
											</div>
										</div>
									<?php } ?>
									
									<div class="clear"></div>
									<div class="row reducirfila">
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="parking_restaurante" id="parking_restaurante" />
												<label>Tiene Parking</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="tarjetas_restaurante" id="tarjetas_restaurante" />
												<label>Permite tarjeta</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="reservas_restaurante" id="reservas_restaurante" />
												<label>Permite reservas</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="visible_restaurante" id="visible_restaurante" />
												<label>Está visible</label>
											</div>
										</div>
									</div>
								</div>

								<div class="separadorpeq"></div>

								<!--
								<div class="mensajeexito">
                  <i class="fa fa-info-circle"></i>&nbsp;&nbsp;Para guardar estos datos primero debe guardar los datos del propietario (arriba)
                </div>
                -->

								<div class="row centrar reducirfila">
										<input type="hidden" name="id_propietario" id="id_propietario" value="<?php echo $dameClavePropietario->id_propietario; ?>">

										<?php $clave_rest = random_string('unique'); ?>
										<input type="hidden" name="clave_restaurante" id="clave_restaurante" value="<?php echo $clave_rest; ?>">

										<input type="hidden" name="clave_plan" id="clave_plan" value="<?php echo $clave = $this->input->get_post('plan'); ?>">
										<input class="button-3 botonpeq" id="btnAltaFranquiciadoRestaurante" type="submit" value="Guardar datos">
								</div>
							</form>
						</div>
					</article>

					
				</div><!-- FIN Segunda columna 10/12 -->
			</div><!-- FIN Row -->
		</div><!-- FIN Container -->
	</div><!-- FIN Sections -->
				

</section>
