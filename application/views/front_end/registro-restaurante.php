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
							<li>
								<a href="#bajarestaurante">Eliminar restaurante<span><i class="fa fa-arrow-circle-right"></i></span></a>
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
								<div class="callout-a ">
									<a href="javascript:window.history.back();" class="button-3">Volver al panel de control</a>
								</div>
							 </div>
						</div>
					</article>

					<article id="altarestaurante" class="seccion-restaurante">
						<h6>Alta de restaurante - Datos principales</h6>
						<p><?php //echo $dameUltimo->id_restaurante; ?></p>
						<div class="form-generico">




							<form method="post" id="form-1" action="<?php echo base_url(); ?>registro-restaurante">

								<div class="row">
									<div class="col-md-3">
										<label>Nombre restaurante</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input type="text" name="nombre_restaurante" id="nombre_restaurante" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Web</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-external-link"></i>
											<input type="text" name="web_restaurante" id="web_restaurante" placeholder="http://">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Calle</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input type="text" name="direccion_restaurante" id="direccion_restaurante" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Número</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input type="text" name="numero_restaurante" id="numero_restaurante" value="">
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Código postal</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input type="text" name="cp_restaurante" id="cp_restaurante" value="">
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
											<div id="pepe"></div>
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
											<input type="text" name="barrio_restaurante" id="barrio_restaurante" value="">
										</div>
									</div>
									
									<div class="clear"></div>

									<div class="col-md-3">
										<label>Precio medio carta</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-eur"></i>
											<select name="precio_medio_restaurante" id="precio_medio_restaurante">
												<option selected="">Seleccionar...</option>
												<option value="Menus de 15€">Menos de 15€</option>
												<option value="16-25€">16-25€</option>
												<option value="26-35€">26-35€</option>
												<option value="36-50€">36-50€</option>
												<option value="Más de 51€">Más de 51€</option>
											</select>
										</div>
									</div>
									
									<div class="clear"></div>
									<div class="row reducirfila">
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="parking_restaurante" id="parking_restaurante" value="1">
												<label>Tiene Parking</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="tarjeta_restaurante" id="tarjeta_restaurante" value="1">
												<label>Permite tarjeta</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="reservas_restaurante" id="reservas_restaurante" value="1">
												<label>Permite reservas</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-input">
												<input type="checkbox" name="visible_restaurante" id="visible_restaurante" value="1">
												<label>Está visible</label>
											</div>
										</div>
									</div>
								</div>

								<div class="separadorpeq"></div>

								<div class="separadorpeq"></div>
								<div class="row centrar reducirfila">
										<input class="button-3 botonpeq" id="btnAddRestaurante" type="submit" value="Guardar datos">
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
															<div class="callout-a "><a href="<?php echo base_url(); ?>acceso/restaurador/eliminar-restaurante?id_restaurante_eliminar=<?php echo $value->id_restaurante; ?>  " class="button-4" id="btnDeleteRest1">&nbsp;&nbsp;Sí&nbsp;&nbsp;</a></div>
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
