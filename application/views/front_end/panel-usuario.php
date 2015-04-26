<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/panel.usuario.js"></script>
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
								<a href="#preferencias">Preferencias culinarias<span><i class="fa fa-arrow-circle-right"></i></span></a>
							</li>
							<li>
								<a href="#zona">Preferencias por zona<span><i class="fa fa-arrow-circle-right"></i></span></a>
							</li>
							<li>
								<a href="#favoritos">Restaurantes favoritos<span><i class="fa fa-arrow-circle-right"></i></span></a>
							</li>
							<li>
								<a href="#datos">Datos personales<span><i class="fa fa-arrow-circle-right"></i></span></a>
							</li>
							<li>
								<a href="#clubtlm">Club TLM<span><i class="fa fa-arrow-circle-right"></i></span></a>
							</li>
              <li>
              	<a href="#soporte">Soporte<span><i class="fa fa-arrow-circle-right"></i></span></a>
              </li>
						</ul>
					</nav>
					</div>
				</div><!-- FIN Primera columna 2/12 -->
				
				<!-- Segunda columna 10/12 -->
				<div class="col-md-9">
					<article class="seccion-restaurante">
						<div class="row">
							 <div class="col-md-9">
								<h5>Bienvenido <?php echo $datosUsuario->nombre_usuario; ?></h5>
							</div>
							<div class="col-md-3">
								<div class="callout-a "><a href="<?php echo base_url('logout'); ?>" class="button-3">Desconectar</a></div>
							 </div>
						</div>
					</article>
					
					<article id="preferencias" class="seccion-restaurante">
						 <h6>Preferencias culinarias</h6>
						 <p>Introduce hasta 5 platos favoritos, para que te podamos sugerir de forma más personalizada:</p>
						<div class="form-generico">
                            <div class="row">
                                <span id="platos-favoritos">
                                </span>
                                <span id="anadir-platos">
                                </span>
								<div id="mensaje_platos" class="mensajeconfondo"></div>
                            </div>
						</div>
					</article>

					<article id="preferencias" class="seccion-restaurante">

						<div class="mensajeexito" id="cp_anadido" style="display:none;"></div>

						<h6>Preferencias por zona</h6>
						<p>Puedes introducir hasta dos códigos postales más, aparte del de tu domicilio, para que podamos afinar nuestras sugerencias:</p>
						<div class="form-generico">
                            <div class="row">
                                <span id="cp-favoritos">
                                </span>
                                <span id="anadir-cp">
                                </span>
								<div id="mensaje_cps" class="mensajeconfondo"></div>
                            </div>
						</div>
					</article>




					
					<article id="favoritos" class="seccion-restaurante">
						 <h6>Restaurantes favoritos</h6>
						 <p>Selecciona hasta un máximo de 5 restaurantes favoritos, que te mostraremos en tu home:</p>
						<div class="form-generico">
                            <div class="row">
                                <span id="restaurantes-favoritos"></span>
                                <span id="buscador-restaurantes"></span>
								<div id="mensaje_restaurantes" class="mensajeconfondo"></div>
                                <span id="listado-restaurantes"></span>
                            </div>
						</div>
					</article>
					








					<article id="datos" class="seccion-restaurante">
						 <h6>Datos personales</h6>
						 <div class="form-generico">

						 	<div class="mensajeexito" style="display:none;"></div>

								<div class="row">

									<div class="col-md-2">
										<label>Tu nombre</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input name="nombre_usuario" id="nombre_usuario" type="text" value="<?php echo $datosUsuario->nombre_usuario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a">
												<a href="#" class="button-3 btn_nombre_usuario" id="btnEditUser">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_nombre" class="mensajeconfondo"></div>


									<div class="clear"></div>


									<div class="col-md-2">
										<label>Tus apellidos</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-user"></i>
											<input name="apellidos_usuario" id="apellidos_usuario" type="text" value="<?php echo $datosUsuario->apellidos_usuario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a">
												<a href="#" class="button-3 btn_apellidos_usuario" id="btnEditApellidos">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_apellidos" class="mensajeconfondo"></div>


									<div class="clear"></div>


									<div class="col-md-2">
										<label>Tu correo electrónico</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-envelope"></i>
											<input name="correo_usuario" id="correo_usuario" type="text" value="<?php echo $datosUsuario->email_usuario; ?>" placeholder="Escribe tu email">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a">
												<a href="#" class="button-3" id="btnEditCorreo">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_correo" class="mensajeconfondo"></div>


									<div class="clear"></div>


									<div class="col-md-2">
										<label>Contraseña</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-key"></i>
											<input name="pass_usuario" id="pass_usuario" type="password" placeholder="Escribe una nueva contraseña">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
									</div>


									<div class="clear"></div>


									<div class="col-md-2">
										<label>Repetir Contraseña</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-key"></i>
											<input name="repetir_pass" id="repetir_pass" type="password" placeholder="Repite la contraseña">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a">
												<a href="#" class="button-3" id="btnEditPass">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_pass" class="mensajeconfondo"></div>


									<div class="clear"></div>


									<div class="col-md-2">
										<label>¿Cuál es tu municipio?</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="localidad_usuario" id="localidad_usuario" type="text" value="<?php echo $datosUsuario->localidad_usuario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a">
												<a href="#" class="button-3" id="btnEditLocalidad">Modificar</a>
											</div>
										</div>
									</div>
									<div id="mensaje_localidad" class="mensajeconfondo"></div>


									<div class="clear"></div>


									<div class="col-md-2">
										<label>¿Y tu código postal?</label>
									</div>
									<div class="col-md-7 nodosfilas convertir9">
										<div class="form-input">
											<i class="fa fa-map-marker"></i>
											<input name="cp_usuario" id="cp_usuario" type="text" value="<?php echo $datosUsuario->cp_usuario; ?>">
										</div>
									</div>
									<div class="col-md-3 nodosfilas">
										<div class="form-input">
											<div class="callout-a">
												<a href="#" class="button-3" id="btnEditCP">Modificar</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
									<div id="mensaje_cp" class="mensajeconfondo"></div>
								</div>


						</div>
					</article>




















	<article id="clubtlm" class="seccion-restaurante">

		<div class="mensajeexito" id="messageDatosTlm" style="display:none;"></div>

		<h6>Club TLM</h6>
		<p>
			EL <a href="clubtlm.php">Club TLM</a>, es un espacio en el disfrutarás de beneficios exclusivos por ser miembro de nuestra red de restaurantes, premiando así tu fidelidad como usuario de la plataforma Todoslosmenus.com, como son cupones, descuentos en restaurantes, regalos exclusivos, etc...
		</p>
		<p>Para pertenecer al club sólo tienes que indicarnos estos datos:</p>
		<div class="form-generico">

				<div class="row">
				
					<div class="col-md-2">
						<label>E-mail adicional</label>
					</div>
					<div class="col-md-3">
						<div class="form-input">
							<i class="fa fa-envelope"></i>

								<input type="text" name="email_usuario_tlm" id="email_usuario_tlm" placeholder="E-Mail" value="<?php echo $dameDatosUsuarioTLM->email_usuario_tlm; ?>" />

						</div>
					</div>





					<div class="col-md-7">
						<div id="row" class="reducirpaddingselect">

							<div class="col-md-3">
								<label>Fecha nacimiento</label>
							</div>
							<div class="col-md-3">
								<div class="form-input">
									<select name="dia_cumpleanos_usuario" id="dia_cumpleanos_usuario">
										<?php if($dameDatosUsuarioTLM->dia_usuario_tlm != 0 || $dameDatosUsuarioTLM->dia_usuario_tlm == ""){ ?>
											<option selected="selected"><?php echo $dameDatosUsuarioTLM->dia_usuario_tlm; ?></option>
										<?php }else{ ?>
											<option selected="selected" value="0">Día</option>
										<?php } ?>

										<?php for ($i=1; $i < 32; $i++) {
											echo '<option value="'.$i.'">'.$i.'</option>';
										} ?>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-input">
									<select name="mes_cumpleanos_usuario" id="mes_cumpleanos_usuario">
										<?php if($dameDatosUsuarioTLM->mes_usuario_tlm != 0 || $dameDatosUsuarioTLM->mes_usuario_tlm == ""){ ?>
											<option selected="selected"><?php echo $dameDatosUsuarioTLM->mes_usuario_tlm; ?></option>
										<?php }else{ ?>
											<option selected="selected" value="0">Mes</option>
										<?php } ?>

										<?php for ($i=1; $i < 13; $i++) {
											echo '<option value="'.$i.'">'.$i.'</option>';
										} ?>
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-input">
									<select name="ano_cumpleanos_usuario" id="ano_cumpleanos_usuario">
										<?php if($dameDatosUsuarioTLM->ano_usuario_tlm != 0 || $dameDatosUsuarioTLM->ano_usuario_tlm == ""){ ?>
											<option selected="selected"><?php echo $dameDatosUsuarioTLM->ano_usuario_tlm; ?></option>
										<?php }else{ ?>
											<option selected="selected" value="0">Año</option>
										<?php } ?>

										<?php for ($i=date('Y'); $i > 1960; $i--) {
											echo '<option value="'.$i.'">'.$i.'</option>';
										} ?>
									</select>
								</div>
							</div>
							
						</div>
					</div>




				</div>
				<div class="row">






					<div class="col-md-2">
						<label>Sexo</label>
					</div>
					<div class="col-md-4">
						<div class="form-input">

							<?php if($dameDatosUsuarioTLM->sexo_usuario_tlm == "hombre"){ ?>

								<input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="hombre" checked="checked">
								<label>Hombre</label>
								<div class="clear"></div>
								<input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="mujer">
								<label>Mujer</label>

							<?php }else if($dameDatosUsuarioTLM->sexo_usuario_tlm == "mujer"){ ?>

								<input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="hombre">
								<label>Hombre</label>
								<div class="clear"></div>
								<input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="mujer" checked="checked">
								<label>Mujer</label>

							<?php }else{ ?>

								<input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="hombre">
								<label>Hombre</label>
								<div class="clear"></div>
								<input type="radio" name="sexo_usuario_tlm" id="sexo_usuario_tlm" value="mujer">
								<label>Mujer</label>
							<?php } ?>

						</div>
					</div>

					<div class="col-md-2">
						<label>¿Para qué utilizas TLM?</label>
					</div>
					<div class="col-md-4">
						<div class="form-input">
							<?php if($dameDatosUsuarioTLM->resp_ocio_usuario_tlm == 1){ ?>
								<input type="checkbox" name="pregunta_tlm_a" id="pregunta_tlm_a" value="1" checked="checked"><label>Ocio</label>
							<?php }else{ ?>
								<input type="checkbox" name="pregunta_tlm_a" id="pregunta_tlm_a" value="1"><label>Ocio</label>
							<?php } ?>

								<div class="clear"></div>

							<?php if($dameDatosUsuarioTLM ->resp_trabajo_usuario_tlm == 1){ ?>
								<input type="checkbox" name="pregunta_tlm_b" id="pregunta_tlm_b" value="1" checked="checked"><label>Trabajo</label>
							<?php }else{ ?>
								<input type="checkbox" name="pregunta_tlm_b" id="pregunta_tlm_b" value="1"><label>Trabajo</label>
							<?php } ?>

						</div>
					</div>

					<div class="clear"></div>

					<div class="reducirfila nota">
						<span>(*):</span>El e-mail adicional es por si necesitas recibir notificaciones en otro correo electrónico.
					</div>

					<div class="separadorpeq"></div>
					<div id="mensaje_tlm" class="mensajeconfondo"></div>
					<div class="row centrar reducirfila">
						<input class="button-3 botonpeq" id="btnEditarDatosTlmUsuario" type="button" value="Enviar">
					</div>
				</div>

		</div>
		<div class="enlacesencillo">
			<a href="<?php echo base_url(); ?>club-tlm" target="_blank">Ver más información sobre el Club TLM<span><i
					class="fa fa-arrow-circle-right"></i></span></a>
		</div>
		
		<div class="clear"></div>
		
	</article>








	<article id="soporte" class="seccion-restaurante">
		<h6>Soporte técnico</h6>
		<p>¿Tienes cualquier duda o consulta? Mándanosla a través de este
			formulario y te contestaremos lo antes posible:</p>
		<div class="form-generico">

            <div class="row">
                <div class="col-md-1">
                    <label>Mensaje</label>
                </div>
                <div class="col-md-11">
                    <div class="form-input">
                        <i class="fa fa-comment"></i>
                        <textarea name="texto_mensaje_soporte" id="texto_mensaje_soporte"></textarea>
                    </div>
                </div>

                <div class="clear"></div>

                <div id="mensaje_soporte" class="mensajeconfondo"></div>
                <div class="row centrar reducirfila">
                    <input class="button-3 botonpeq" id="btnEmailSoporte" type="submit" value="Enviar">
                </div>
            </div>

		</div>
	</article>







					
				
				</div><!-- FIN Segunda columna 10/12 -->
			</div><!-- FIN Row -->
		</div><!-- FIN Container -->
	</div><!-- FIN Sections -->
				

</section>
