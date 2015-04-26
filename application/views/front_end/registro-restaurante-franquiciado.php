<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registro.restaurante.franquiciado.js"></script>
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

						<h5>Gestión de propietarios - Alta/baja de restaurantes</h5>
							
          				<div class="row">
            				<div class="col-md-4">
								<div class="callout-a "><a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado-gestion-propietarios'); ?>" class="button-3">Volver a gestión de propietarios</a></div>
							</div>
							<div class="col-md-4">
								<div class="callout-a "><a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado'); ?>" class="button-3">Volver a panel de control</a></div>
							</div>
							<div class="col-md-4">
								<div class="callout-a "><a href="<?php echo base_url(); ?>logout" class="button-3">Desconectar</a></div>
							</div>
						</div>
					</article>



					<article id="altarestaurante" class="seccion-restaurante">


						<h6>Alta de restaurante - Datos propietario</h6>
						<div class="form-generico">
							<form method="post" id="reg-propietario-franquiciado" action="<?php echo base_url(); ?>acceso/franquiciado/registro-propietario-franquiciado">
								<div class="row">
									<div class="col-md-3">
										<label>Nombre propietario</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input name="nombre_propietario" id="nombre_propietario" type="text">
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Apellidos</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input name="apellidos_propietario" id="apellidos_propietario" type="text">
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Correo electrónico</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-envelope"></i>
											<input name="email_propietario" id="email_propietario" type="text">
										</div>
									</div>
                                    
									<div class="clear"></div>
									<div class="col-md-3">
										<?php //$pass = random_string('alnum', 7); ?>
										<label>Contraseña acceso</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-key"></i>
											<input type="password" name="password_propietario" id="password_propietario">
										</div>
									</div>
									<div class="clear"></div>
									<div class="col-md-3">
										<?php //$pass = random_string('alnum', 7); ?>
										<label>Repetir contraseña</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-key"></i>
											<input type="password" name="password_repetido" id="password_repetido">
										</div>
									</div>
                                    
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Teléfono</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-phone"></i>
											<input name="telefono_propietario" id="telefono_propietario" type="text">
										</div>
									</div>
                                    
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Código postal</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="cp_propietario" id="cp_propietario" type="text">
											<div id="comprueba_cp"></div>
										</div>
									</div>
                                    
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Provincia</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
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
                                    
									<div class="clear"></div>
									<div class="col-md-3">
										<label>Municipio</label>
									</div>
									<div class="col-md-9 nodosfilas convertir12">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
                                        <select class="municipio_gestor" name="municipio_propietario" id="municipio_propietario">
                                            <option>Municipio</option>
                                        </select>
										</div>
									</div>


									<div class="clear"></div>
									<div class="separadorpeq"></div>
                            
									<div id="mensaje_validacion" class="mensajeconfondo"></div>
                            
									<div class="row centrar reducirfila">
										<input type="hidden" id="clave_plan" name="clave_plan" value="<?php echo $planContratado; ?>">
										<input class="button-3 botonpeq" id="btnValidar" type="button" value="Guardar datos">
									</div>

								</form>
							</div>

					</article>






					



					<article id="bajarestaurante" class="seccion-restaurante">
						<h6>Listado de restaurantes - Baja</h6>
						<p>Este es el listado de tus restaurantes dados de alta. Para eliminar alguno, pincha en el botón "Eliminar".</p>
						<p>Para modificar alguno, vuelve al panel de control, selecciona el restaurante que quieras y edita sus datos.</p>
						 <div class="form-generico">


								<div class="row">

									<div class="col-md-12">
										<ul class="restaurantesfavoritos_seleccion" id="baja_restaurantes">


										</ul>	
									</div>
								</div>

						</div>
						<div class="clear"></div>
					</article>







					
				</div><!-- FIN Segunda columna 10/12 -->
			</div><!-- FIN Row -->
		</div><!-- FIN Container -->
	</div><!-- FIN Sections -->
				

</section>
