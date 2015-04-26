<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/marcar.favorito.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/detalle.restaurante.js"></script>
<section>
	<div class="sections">
		<div class="container">
			<div class="row">
				<!-- Primera columna 4/12 -->
				<div class="col-md-4">
					<article id="presentacion">
						<div class="seccion-restaurante">
							<?php if($detalle->planes_id_plan != 1){ ?>
    						<img class="logobar" src="<?php echo base_url(); ?>assets/logos/<?php echo $detalle->logo_restaurante; ?>" />
    					<?php } ?>
							<h1><?php echo $detalle->nombre_restaurante; ?></h1>
							<h6><?php echo $detalle->direccion_restaurante; ?>, n&ordm; <?php echo $detalle->numero_restaurante; ?>, <?php echo $detalle->nombre_localidad; ?> (<?php echo $detalle->nombre_provincia; ?>)</h6>
                <div class="clear"></div>
                <div class="widget-about">
                <div class="social-ul">

<?php //$detalle->planes_id_plan = 3 ?>

                <?php if($detalle->planes_id_plan == 1 && $detalle->planes_id_plan == 2){ ?>
	                <!--
	                  <ul>
	                    <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
	                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
	                    <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
	                    <li><div class="fb-like botonesrrss" data-href="<?php echo 'http://www.'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div></li>
	                  </ul>
                <?php //}else if($detalle->planes_id_plan == 2){ ?>
                  <ul>
                    <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                -->

                <?php }else if($detalle->planes_id_plan != 1){ ?>
                	<ul>
                    <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
               		<?php if($detalle->planes_id_plan == 3){ ?>
                   		<li><div class="fb-like botonesrrss" data-href="<?php echo 'http://www.'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div></li>
                	<?php } ?>
                  </ul>
                <?php } ?>


                </div>
                </div>
                <div class="clear"></div>
                <div class="enlacesencillo"><a href="javascript:history.go(-1)"><span><i class="fa fa-arrow-circle-left"></i></span>Volver atrás</a></div>
                <div class="clear"></div>
                
                
				<?php if ($this->session->userdata('ingresado') == TRUE && $this->session->userdata('usuario') == TRUE) { ?>
                    <?php if ($this->session->userdata('id_usuario', TRUE) == $detalle->favorito_id_usuario) { ?>
                        <div class="favorito-marcado"><i class="fa fa-star"></i>Restaurante favorito</div>
                    <?php } else { ?>
                        <span class="favorito<?php echo $detalle->id_restaurante; ?>"><div class="enlacefavorito"><a href="javascript:marcarFavorito(<?php echo $detalle->id_restaurante; ?>);"><span><i class="fa fa-star"></i></span>Marcar favorito</a></div></span>
                    <?php } ?>
                <?php } else { ?>
                    <div class="enlacefavorito"><a href="#"><span><i class="fa fa-star"></i></span>Marcar favorito</a></div>
                <?php } ?>
                
                <input type="hidden" name="valor_rest" id="valor_rest" value="<?php echo $detalle->id_restaurante; ?>">
                <div class="clear"></div>
                <div class="enlacefavorito"><a href="tel:<?php echo $detalle->telefono_restaurante; ?>"><span><i class="fa fa-phone"></i></span>Tlf: <?php echo $detalle->telefono_restaurante; ?></a></div>
                <div class="clear"></div>

						</div>
					</article>
					











					<?php if($detalle->planes_id_plan != 1) { ?>
					<article id="menus">
						<div class="seccion-restaurante">

						<?php if($detalleMenu){ ?>

							<?php //if($detalleMenu->tipo_menu_id_tipo_menu == 1){ ?>

								<?php foreach ($detalleMenu as $key => $listMenu) { ?>
									<div class="accordion accordion-2 toggle-accordion">
										<div class="section-content">
											<h4 class="accordion-title">
												<a href="#"><?php echo $listMenu->nombre_menu; ?><i class="fa fa-plus"></i></a>
											</h4>
											<div class="accordion-inner">
												<div class="animation" data-animate="rollIn">
													<time><?php echo $listMenu->fecha_dia_menu; ?></time>
												</div>

													<hr class="bordepunteado">

													<div class="row">
														<div class="col-md-12">
															<?php //echo "<pre>"; print_r($damePrimerosMenu); ?>
														</div>
													</div>

													<div class="row">
														<div class="col-md-6 dosfilas">
															<h5>PRIMEROS</h5>
																<ul>

																	<!--<li><?php echo $damePrimerosMenu; ?></li>-->
																	
																	
																	<?php //foreach ($damePrimerosMenu as $key => $primerosMenu) { ?>
																	<?php foreach ($damePrimerosMenu[$key] as $primerosMenu) { ?>
																		<li>* <?php echo $primerosMenu->nombre_primeros_menu; ?></li>
																	<?php } ?>
																	
																	
																	
																</ul>
														</div>
														<div class="col-md-6 dosfilas">
															<h5>SEGUNDOS</h5>
																<ul>
																	<?php foreach ($dameSegundosMenu[$key] as $segundosMenu) { ?>
																		<li>* <?php echo $segundosMenu->nombre_segundo_menu; ?></li>
																	<?php } ?>
																</ul>
														</div>
													</div>

													<?
                                                    $texto = "";
                                                    if($listMenu->pan_menu){
                                                        $texto = 'Pan';
                                                    }
                                                    if($listMenu->bebida_menu){
                                                        if($listMenu->pan_menu && !$listMenu->postre_menu && !$listMenu->cafe_menu){
                                                            $texto .= ' y ';
                                                        }else if($listMenu->pan_menu){
                                                            $texto .= ', ';
                                                        }
                                                        $texto .= 'Bebida';
                                                    }
                                                    if($listMenu->postre_menu){
                                                        if(($listMenu->pan_menu || $listMenu->bebida_menu) && !$listMenu->cafe_menu){
                                                            $texto .= ' y ';
                                                        }else if($listMenu->pan_menu || $listMenu->bebida_menu){
                                                            $texto .= ', ';
                                                        }
                                                        $texto .= 'Postre';
                                                    }
                                                    if($listMenu->cafe_menu){
                                                        if($listMenu->pan_menu || $listMenu->bebida_menu || $listMenu->postre_menu){
                                                            $texto .= ' y ';
                                                        }
                                                        $texto .= 'Café';
                                                    }
                                                    ?>
													<h6><?php echo $texto; ?></h6>
													<h7><?php echo $listMenu->precio_menu; ?> €</h7>
                                                    
                                                    <div class="enlacesencillo-sin-float"><a href="#">Suscribirse al menú por correo electrónico<span><i class="fa fa-arrow-circle-right"></i></span></a></div>

											</div>
										</div>
									</div>
									<?php } ?>

							<?php //} ?>



						<?php }else{ ?>
							<div id="mensajeMenu">
								<p>Este restaurante no tiene menús</p>
							</div>
						<?php } ?>

						</div>
					</article>
					<?php } ?>












					<?php if($detalle->planes_id_plan == 3 && $detalle->email_restaurante != ''){ ?>
						<article id="reservar">					
							<div class="seccion-restaurante">				
								<h6>Reservar</h6>
								<div class="clearfix"></div>
								<div class="form-generico">

									<form method="post" id="form-reserva" class="form-js" action="#">
										<div class="row">
											<div class="col-md-12">
												<div class="form-input">
													<i class="fa fa-user"></i>
													<input name="nombre_reserva" id="nombre_reserva" type="text" placeholder="Tu nombre">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-input">
													<i class="fa fa-envelope"></i>
													<input name="email_reserva" id="email_reserva" type="email" placeholder="Email">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-input">
													<i class="fa fa-phone"></i>
													<input name="telefono_reserva" id="telefono_reserva" type="text" placeholder="Teléfono">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-input">
													<i class="fa fa-clock-o"></i>
													<input name="fecha_reserva" id="fecha_reserva" type="text" placeholder="Fecha">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-input">
													<i class="fa fa-users"></i>
													<input name="personas_reserva" id="personas_reserva" type="text" placeholder="Nº Personas">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-input">
													<i class="fa fa-comment"></i>
													<textarea name="mensaje_reserva" id="mensaje_reserva" placeholder="Comentarios"></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div id="mensaje"></div>
											</div>
											<div class="col-md-12 derecha">
												<input name="email_restaurante" id="email_restaurante" type="hidden" value="<?php echo $detalle->email_restaurante; ?>">
												<input type="submit" class="button-3" id="reservaEmail" value="Enviar reserva">
											</div>
										</div><!-- End row -->
									</form>

								</div><!-- End comment-form -->
								
							</div>
						</article>
					<?php } ?>

				</div><!-- FIN Primera columna 4/12 -->
				
				<!-- Segunda columna 8/12 -->
				<div class="col-md-8">


				<!-- Compruebo si tiene cupones -->
				<?php if($dameListadoCupones){ ?>
						<?php if($this->session->userdata('ingresado') == TRUE){ ?>
							<article id="cupones">
								<div class="seccion-restaurante">
								<h6>Cupones y descuentos</h6>
									<div class="clearfix"></div>

									<?php foreach ($dameListadoCupones as $key => $value) { ?>
										<div class="animation" data-animate="lightSpeedIn">
											<div class="alerts cupon">
												<i class="fa fa-money"></i>
												<div>
													<h3><?php echo $value->titulo_cupon; ?></h3>

													<div class="col-md-8">
														<p><?php echo word_limiter($value->descripcion_cupon, 10); ?></p>
													</div>

													<div class="col-md-4">
														<div class="callout-a ">
															<a href="<?php echo base_url(); ?>descargar-cupon?clave=<?php echo $value->clave_cupon; ?>&id_restaurante=<?php echo $value->restaurantes_id_restaurante; ?>" target="_blank" class="button-3">Descargar cupón</a>
														</div>
													</div>

												</div>
											</div>
										</div>
									<?php } ?>

								</div>
							</article>
						<?php }else{ ?>

							<article id="cupones">
								<div class="seccion-restaurante">
									<h6>Cupones y descuentos</h6>
	                  <p>Este restaurante posee algún cupón o descuento asociado. Para poder disfrutarlo, <strong>debe pertenecer al <a href="clubtlm.php">Club TLM</a></strong>.</p>
	                  <p>¡Es totalmente gratuito y muy rápido! </p>
	                  <div class="callout-a ">
	                  	<a href="<?php echo base_url('club-tlm'); ?>" class="button-3 botonpeq">Darme de alta en el club TLM</a>
	                  </div> 
								</div>
							</article>

						<?php } ?>

					<?php }else{} ?>
								
								<article id="datos">	
									<div class="seccion-restaurante">

										<h6>Más información</h6>



										<div class="row">
											<div class="col-md-6 dosfilas">
												<div class="listadocontacto">
												<ul>
													<li>
														<i class="fa fa-map-marker"></i>
														<div>Dirección: <?php echo $detalle->direccion_restaurante; ?>, n&ordm; <?php echo $detalle->numero_restaurante; ?>, <?php echo $detalle->nombre_localidad; ?> (<?php echo $detalle->nombre_provincia; ?>)</div>
													</li>

													<?php if($detallePuntosCercanos && $detalle->planes_id_plan != 1) { ?>
													<li>
                                                        <i class="fa fa-map-marker"></i>
                                                        <div>
                                                            Puntos interés:
                                                            <?php
                                                            $texto = '';
                                                            foreach ($detallePuntosCercanos as $key => $puntosCercanos) {
                                                                if($texto) { $texto .= ', '; }
                                                            ?>
                                                                <?php $texto .= $puntosCercanos->nombre_punto_cercano; ?>
                                                            <?php
                                                            }
                                                            echo $texto . ".";
                                                            ?>
                                                        </div>
													</li>
													<?php } ?>

													<?php if($detalleEstaciones) { ?>
													<li>
														<i class="fa fa-info"></i>
														<div>Estaciones metro: 
															<?php
															$texto = '';
                                                            foreach ($detalleEstaciones as $key => $estaciones) {
																if($texto) { $texto .= ', '; }
															?>
																<?php $texto .= $estaciones->nombre_estacion; ?>
															<?php
                                                            }
															echo $texto . ".";
															?>
														</div>
													</li>
													<?php } ?>
                                                    
													<li>
														<i class="fa fa-phone"></i>
														<div>Teléfono: <a href="tel:<?php echo $detalle->telefono_restaurante; ?>"><?php echo $detalle->telefono_restaurante; ?></a></div>
													</li>

													<?php if($detalle->planes_id_plan != 1){ ?>
														<li>
															<i class="fa fa-envelope"></i>
															<div>Email : <?php echo $detalle->email_restaurante; ?></div>
														</li>
													<?php } ?>
			
													<?php if($detalle->planes_id_plan != 1){ ?>
														<li>
															<i class="fa fa-external-link"></i>
															<div>Web : <a href="http://<?php echo $detalle->web_restaurante; ?>" target="_blank"><?php echo $detalle->web_restaurante; ?></a></div>
														</li>
													<?php } ?>
			
													<?php if($detalle->planes_id_plan != 1){ ?>
                                                        <li>
                                                            <i class="fa fa-cutlery"></i>
                                                            <div>Categoría: <?php echo $detalle->nombre_categoria; ?></div>
                                                        </li>
													<?php } ?>

													<?php if($detalleEspecialidades) { ?>
													<li>
														<i class="fa fa-info"></i>
														<div>Especialidades: 
															<?php
															$texto = '';
                                                            foreach ($detalleEspecialidades as $key => $listadoEspecialidades) {
																if($texto) { $texto .= ', '; }
															?>
																<?php $texto .= $listadoEspecialidades->nombre_especialidad; ?>
															<?php
                                                            }
															echo $texto . ".";
															?>
														</div>
													</li>
													<?php } ?>

													<?php if($detalle->planes_id_plan != 1){ ?>
														<li>
															<i class="fa fa-eur"></i>
															<div>Precio medio carta: <?php echo $detalle->precio_medio_restaurante; ?>€</div>
														</li>
													<?php } ?>
													

													<!-- SUPONGO QUE TAMBIÉN ABRÁ QUE VERIFICAR QUE EL RESTAURANTE SUBIÓ LA CARTA -->
													<?php if($detalle->planes_id_plan == 3){ ?>
														<li>
															<i class="fa fa-book"></i>
															<div>
																<a href="<?php echo base_url() ?>assets/pdfs/<?php echo $detalle->carta_restaurante; ?>" target="_blank">Ver carta</a>
															</div>
														</li>
													<?php } ?>



													<?php if($detalle->planes_id_plan != 1){ ?>
													<li>
														<i class="fa fa-clock-o"></i>
														<div>Horario : <?php echo $detalle->horario_apertura_restaurante; ?></div>
													</li>
													<li>
														<i class="fa fa-lock"></i>
														<div>Cerrado : <?php echo $detalle->horario_cierre_restaurante; ?></div>
													</li>
													<?php } ?>


												</ul>
												</div>
											</div>
											<div class="col-md-6 dosfilas">

												<style type="text/css">
													#map-canvas, #maparestaurante
													{
														width: 100%;
														height: 250px;
										        margin: 0px;
										        padding: 0px;
													}	
												</style>

												<div id="maparestaurante">
													<div id="map-canvas"></div>
												</div>


												<!-- Custom scripts -->
												<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=ES"></script>
												<?php $dir = $detalle->direccion_restaurante . ', ' . $detalle->numero_restaurante . ', ' . $detalle->num_codigo_postal; ?>
												<script type="text/javascript">
												    var geocoder;
												    var map;
												    var query = '<?php echo $dir; ?>';
												    function initialize() {
												      geocoder = new google.maps.Geocoder();
												      var mapOptions = {
												        zoom:18
												      }
												      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
												      codeAddress();
												    }

												    function codeAddress() {
												      var address = query;
												      geocoder.geocode( { 'address': address}, function(results, status) {
												        if (status == google.maps.GeocoderStatus.OK) {
												          map.setCenter(results[0].geometry.location);
												          var marker = new google.maps.Marker({
												              map: map,
												              position: results[0].geometry.location
												          });
												        } else {
												          alert('Geocode was not successful for the following reason: ' + status);
												        }
												      });
												    }

												    google.maps.event.addDomListener(window, 'load', initialize);
												</script>
												
																							
											</div>
										</div>



										
									</div>
								</article>

								


								
								<article id="instalaciones" >	
									<div class="seccion-restaurante">
										<h6>Instalaciones y servicios</h6>
										<div class="clearfix"></div>
										<div class="list-ul list-ul-check-circle-o">
											<ul>



											<?php if($detalle->parking_restaurante == 1){ ?>
												<li>Parking</li>
											<?php }else{} ?>

											<?php if($detalle->tarjetas_restaurante == 1){ ?>
												<li>Admite pago con tarjeta</li>
											<?php }else{} ?>

											<?php if($detalle->visible_restaurante == 1){ ?>
												<li>Visible</li>
											<?php }else{} ?>

											<?php if($detalle->reservas_restaurante == 1){ ?>
												<li>Permiten reservas</li>
											<?php }else{} ?>

												

											</ul>
										</div>
									</div>
								</article>
								







								<?php if($detalle->planes_id_plan != 1){ ?>
									<article id="fotos"> 
										<div class="seccion-restaurante">
											<h6>Fotos</h6>
											<div class="clearfix"></div>	
											<div class="animation" data-animate="fadeInUp">										
												<div class="row portfolio-all portfolio-0 ajustaralto">
												<ul>
<!-- HASTA QUE TENGA CLARO COMO HACER LO DE LAS FOTOS DEJO LAS FOTOS ESTÁTICAS -->
												<li class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
													<div class="portfolio-one rellenarfondo">
														<div class="portfolio-head">
															<div class="portfolio-img"><img alt="" src="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/principal.jpg"></div>
															<div class="portfolio-hover">
																<div class="portfolio-meta">
																	<div class="portfolio-name"><h6><a href="single-portfolio.html">Foto principal</a></h6></div>
																</div><!-- End portfolio-meta -->
																<a class="portfolio-zoom prettyPhoto" href="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/principal.jpg"><i class="fa fa-search"></i></a>
															</div>
														</div><!-- End portfolio-head -->
													</div><!-- End portfolio-item -->
												</li>
												<li class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
													<div class="portfolio-one rellenarfondo">
														<div class="portfolio-head">
															<div class="portfolio-img"><img alt="" src="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/salon.jpg"></div>
															<div class="portfolio-hover">
																<div class="portfolio-meta">
																	<div class="portfolio-name"><h6><a href="single-portfolio.html">Salón</a></h6></div>
																</div><!-- End portfolio-meta -->
																<a class="portfolio-zoom prettyPhoto" href="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/salon.jpg"><i class="fa fa-search"></i></a>
															</div>
														</div><!-- End portfolio-head -->
													</div><!-- End portfolio-item -->
												</li>
												<li class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
													<div class="portfolio-one rellenarfondo">
														<div class="portfolio-head">
															<div class="portfolio-img"><img alt="" src="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/salon2.jpg"></div>
															<div class="portfolio-hover">
																<div class="portfolio-meta">
																	<div class="portfolio-name"><h6><a href="single-portfolio.html">Otro salón</a></h6></div>
																</div><!-- End portfolio-meta -->
																<a class="portfolio-zoom prettyPhoto" href="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/salon2.jpg"><i class="fa fa-search"></i></a>
															</div>
														</div><!-- End portfolio-head -->
													</div><!-- End portfolio-item -->
												</li>
												<li class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
													<div class="portfolio-one rellenarfondo">
														<div class="portfolio-head">
															<div class="portfolio-img"><img alt="" src="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/detalleplato.jpg"></div>
															<div class="portfolio-hover">
																<div class="portfolio-meta">
																	<div class="portfolio-name"><h6><a href="single-portfolio.html">Detalle plato</a></h6></div>
																</div><!-- End portfolio-meta -->
																<a class="portfolio-zoom prettyPhoto" href="http://www.todoslosmenus.com/maqueta/images/restaurantes/00001_Restaurante01/detalleplato.jpg"><i class="fa fa-search"></i></a>
															</div>
														</div><!-- End portfolio-head -->
													</div><!-- End portfolio-item -->
												</li>
<!-- FIN DE FOTOS ESTÁTICAS TEMPORALES EN OBRAS -->
												<?php foreach ($imagenes as $key => $value) { ?>

													<li class="col-md-4 portfolio-item portfolio-item-2 isotope-item">
														<div class="portfolio-one rellenarfondo">
															<div class="portfolio-head">
																<div class="portfolio-img"><img alt="" src="<?php echo base_url(); ?>assets/img_restaurantes/<?php echo $value->thumbnails_imagen.'.'.$value->extension_imagen; ?>">
																</div>
																<div class="portfolio-hover">
																	<!--
																	<div class="portfolio-meta">
																		<div class="portfolio-name">
																			<h6><a href="single-portfolio.html">Foto principal</a></h6>
																		</div>
																	</div>
																	-->
																	<a class="portfolio-zoom prettyPhoto" href="<?php echo base_url(); ?>assets/img_restaurantes/<?php echo $value->nombre_imagen; ?>"><i class="fa fa-search"></i></a>
																</div>
															</div><!-- End portfolio-head -->
														</div><!-- End portfolio-item -->
													</li>

												<?php } ?>

												</ul>
													
												</div>
											</div>

												<!--
												<div class="pagination">
													<ul>
														<li class="pagination-prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
														<li><a href="#">1</a></li>
														<li><a href="#">2</a></li>
														<li><a href="#">3</a></li>
														<li><a href="#">4</a></li>
														<li class="pagination-next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
													</ul>
												</div>
												<!- End pagination -->

										</div>
									</article>
								<?php } ?>







							<?php if($detalle->planes_id_plan != 1){ ?>
								<article id="valoraciones">
									<div class="seccion-restaurante">
										<h6>Valoraciones</h6>
										<div class="clearfix"></div>

										<?php if($obtenerNumerValoraciones > 0) { ?>
										<div class="animation" data-animate="bounceIn">
											<div class="progressbar-warp reducirbarraprogreso">
												<div class="progressbar">
													<!-- <span class="progressbar-title">Valoración global (basado en <?php echo $obtenerNumerValoraciones; ?> votos)<span><?php echo round($dameValoracionRestaurante->global_valoracion); ?>%</span></span> -->
													<span class="progressbar-title">Valoración global (basado en <?php echo $obtenerNumerValoraciones; ?> votos)<span><?php echo round(20 * $dameValoracionRestaurante->global_valoracion); ?>%</span></span>
													<div class="progressbar-all">
														<div class="progressbar-percent" data-percent="<?php echo 20 * $dameValoracionRestaurante->global_valoracion; ?>"></div>
													</div>
												</div>
												<div class="progressbar">
													<span class="progressbar-title">Servicio<span><?php echo round(20 * $dameValoracionRestaurante->servicio_valoracion); ?>%</span></span>
													<div class="progressbar-all">
														<div class="progressbar-percent" data-percent="<?php echo 20 * $dameValoracionRestaurante->servicio_valoracion; ?>"></div>
													</div>
												</div>
												<div class="progressbar">
													<span class="progressbar-title">Comida<span><?php echo round(20 * $dameValoracionRestaurante->comida_valoracion); ?>%</span></span>
													<div class="progressbar-all">
														<div class="progressbar-percent"data-percent="<?php echo 20 * $dameValoracionRestaurante->comida_valoracion; ?>"></div>
													</div>
												</div>
												<div class="progressbar">
													<span class="progressbar-title">Relación calidad-precio<span><?php echo round(20 * $dameValoracionRestaurante->calidad_valoracion); ?>%</span></span>
													<div class="progressbar-all">
														<div class="progressbar-percent" data-percent="<?php echo 20 * $dameValoracionRestaurante->calidad_valoracion; ?>"></div>
													</div>
												</div>
											</div><!-- End progressbar-warp -->
										</div>

										
										<br />



										
										<div class="row">
                                        <?php if ($obtenerNumerValoraciones < 3) { ?>
										<div class="testimonials-slide-solouno">
                                        <?php }else{ ?>
										<div class="bxslider-slide testimonials-slide">
                                        <?php } ?>
											<ul>
												<?php
												/*echo $valoracionesUsuarios[0];
												print_r($valoracionesUsuarios);
												var_dump($valoracionesUsuarios);*/
												//die();
                                                    $i = 1;
                                                    $num_items = 2;
                                                    foreach ($valoracionesUsuarios as $value) {
                                                        if($i == 1){
                                                            echo '<li>';
                                                        }
                                                ?>
													<div class="col-md-6">
														<div class="testimonial-item">
															<div class="testimonial-content">
															<div><i class="fa fa-quote-left"></i></div>
                              <div class="separadorpeq"></div>
                            	<div class="row">
                                	<div class="col-md-8 dosfilas"><div class="itemvaloracion">Valoración global</div></div>
                                    <div class="col-md-4 dosfilas">
                                    	<div class="itemvaloracion">
											<?php
                                            for ($v = 1; $v < 6; $v++) {
                                                if ($v <= $value->global_valoracion) {
                                                    echo '<i class="fa fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa fa-star-o"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                	<div class="col-md-8 dosfilas"><div class="itemvaloracion">Servicio</div></div>
                                    <div class="col-md-4 dosfilas">
                                    	<div class="itemvaloracion">
											<?php
                                            for ($v = 1; $v < 6; $v++) {
                                                if ($v <= $value->servicio_valoracion) {
                                                    echo '<i class="fa fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa fa-star-o"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                	<div class="col-md-8 dosfilas"><div class="itemvaloracion">Comida</div></div>
                                    <div class="col-md-4 dosfilas">
                                    	<div class="itemvaloracion">
											<?php
                                            for ($v = 1; $v < 6; $v++) {
                                                if ($v <= $value->comida_valoracion) {
                                                    echo '<i class="fa fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa fa-star-o"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                	<div class="col-md-8 dosfilas"><div class="itemvaloracion">Relacion calidad/precio</div></div>
                                    <div class="col-md-4 dosfilas">
                                    	<div class="itemvaloracion">
											<?php
                                            for ($v = 1; $v < 6; $v++) {
                                                if ($v <= $value->calidad_valoracion) {
                                                    echo '<i class="fa fa-star"></i>';
                                                } else {
                                                    echo '<i class="fa fa-star-o"></i>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
																<div class="separadorpeq"></div>	
																<div><i class="fa fa-quote-right"></i></div>
															</div>
															<div class="testimonial-meta">
																<div class="testimonial-name"><?php echo $value->nombre_usuario; ?></div>
																<div class="testimonial-date"><?php echo date_format(date_create($value->fecha_valoracion), 'd-m-Y'); ?></div>
															</div>
															<div class="clearfix"></div>
														</div>
													</div>
												<?php
                                                        if($i == $num_items){
                                                            echo '</li>';
                                                            $i = 0;
                                                        }
                                                        $i++;
                                                    }
                                                    if($i == 1){
                                                        echo '</li>';
                                                    }
                                                ?>
											</ul>
										</div>


									</div>
                                <?php    
                                }else{
                                    echo "Todavía no hay valoraciones de los usuarios de este restaurante";
                                }
								?>

									

								<?php if ($this->session->userdata('ingresado') == TRUE && $this->session->userdata('usuario') == TRUE) { ?>
									<div class="row">
										<div class="col-md-12 derecha">
											<input type="button" class="button-3 botonpeq" id="btnVistaValoracion" value="Enviar valoración">
										</div>
									</div>
                                    
								<?php } ?>
									






										
									</div>
								</article>

							<?php } ?>






				</div><!-- FIN Segunda columna 8/12 -->
			</div><!-- FIN Row -->
		</div><!-- FIN Container -->
	</div><!-- FIN Sections -->
				

</section>