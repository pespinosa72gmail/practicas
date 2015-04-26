	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="footer-widget">
						<div class="widget-title"><h6>Sobre Todoslosmenus</h6></div>
						<div class="widget-about">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lorem quam, adipiscing condimentum tristique vel, 
                            eleifend sed turpis. Pellentesque cursus arcu id magna euismod in elementum purus molestie.</p>
							<div class="social-ul">
								<ul>
									<li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li class="social-instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li class="social-youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
								</ul>
							</div>
                            <div class="clear"></div>
                            <div class="fb-like botonesrrss" data-href="http://www.todoslosmenus.com" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
						</div>
					</div>
				</div>
                <div class="col-md-4 centrar">
                	<img src="<?php echo base_url(); ?>assets/images/logoblanco.png" alt="Todos los menús"/>
                </div>
				<div class="col-md-4">
					<div class="footer-widget">
						<div class="widget-title"><h6>Contáctanos</h6></div>
						<div class="widget-about-2">
							<ul>
								<li>
									<i class="fa fa-map-marker"></i>
									<div>C/ Francisco Alonso, nº2, CP 28660<br>Boadilla del Monte (Madrid)</div>
								</li>
								<li>
									<i class="fa fa-phone"></i>
									<div>Teléfono: <a href="tel:XXXXXXX">+34 XXX XX XX</a></div>
								</li>
								<li>
									<i class="fa fa-envelope"></i>
									<div>Email : <a href="mailto:info@todoslosmenus.com">info@todoslosmenus.com</a></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				
			</div><!-- FIN row -->
		</div><!-- FIN container -->
	</footer><!-- FIN footer -->
	<footer id="footer-bottom">
		<div class="container">
			<div class="copyrights">Copyright 2014 Todoslosmenus | Diseñado por <a target="_blank" href="http://7oroof.com/">Nablae</a></div>
			<nav class="navigation-footer">
				<ul>
					<li><a href="index.php">Home</a></li>
                    <li><a href="quienessomos.php">Sobre Todoslosmenus</a></li>
					<li><a href="restaurantes">¿Eres restaurador?</a></li>
					<li><a href="faqs.php">FAQs</a></li>
                    <li><a href="franquicias.php">Franquíciate</a></li>
					<li><a href="contacto.php">Contáctanos</a></li>
					<li><a href="registro_user.php">Regístrate gratis</a></li>
                    <li><a href="clubtlm.php">Club TLM</a></li>
				</ul>
			</nav>
		</div><!-- FIN container -->
	</footer><!-- FIN footer-bottom -->
	
</div><!-- FIN wrap -->

<div class="go-up"><i class="fa fa-chevron-up"></i></div>

<!-- js -->



<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.tabs.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/shortcodes.js"></script>  
<script src="<?php echo base_url(); ?>assets/js/html5.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.isotope.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.appear.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery.nav.js"></script>
<script src="<?php echo base_url(); ?>assets/js/count-to.js"></script>
<script src="<?php echo base_url(); ?>assets/js/twitter/jquery.tweet.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.inview.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.themepunch.plugins.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.themepunch.revolution.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.numeric.js"></script>

<script src="<?php echo base_url(); ?>assets/js/calendarios.js"></script>
<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/app_franquiciados.js"></script> -->
<script src="<?php echo base_url(); ?>assets/dropzone/dropzone.js"></script>












<!-- Validamos el formulario - Metér en algún código js -->
<script type="text/javascript">
    /*
	$(document).ready(function(){
		$('.fondo').validate();
		
		$.validator.addMethod("ccc", function(ccc) {
			if (ccc.length !== 20) {
				return false;
			}
			//	 Formato deseado de los parámetros:
			//	 - entidad (4)
			//	 - oficina (4)
			//	 - digito (2)
			//	 - cuenta (10)
			
			var entidad=ccc.substr(0,4);
			var oficina=ccc.substr(4,4);
			var digito=ccc.substr(8,2);
			var cuenta=ccc.substr(10,10);
			
			var total,cociente,resto;
			
			if (entidad.length != 4 || oficina.length != 4 || digito.length!= 2 || cuenta.length != 10) return false;
			
			total = (entidad.charAt(0) * 4) + (entidad.charAt(1) * 8) + (entidad.charAt(2) * 5) + (entidad.charAt(3) * 10) + (oficina.charAt(0) * 9) + (oficina.charAt(1) * 7) + (oficina.charAt(2) * 3) + (oficina.charAt(3) * 6);
			
			// busco el resto de dividir total entre 11
			cociente = Math.floor(total / 11);
			resto = total - (cociente * 11);
			
			total = 11 - resto;
			if (total == 11) total=0;
			if (total == 10) total=1;
			if (total != digito.charAt(0)) return false;
			
			//hemos validado la entidad y oficina
			total = (cuenta.charAt(0) * 1) + (cuenta.charAt(1) * 2) + (cuenta.charAt(2) * 4) + (cuenta.charAt(3) * 8) + (cuenta.charAt(4) * 5) + (cuenta.charAt(5) * 10) + (cuenta.charAt(6) * 9) + (cuenta.charAt(7) * 7) + (cuenta.charAt(8) * 3) + (cuenta.charAt(9) * 6);

			// busco el resto de dividir total entre 11
			cociente = Math.floor(total / 11);
			resto = total - (cociente * 11);
			total = 11 - resto;
			if (total == 11){total=0;}
			if (total == 10){total=1;}

			if (total != digito.charAt(1)) return false;
			
			var mensaje = '<span class="form-description required-error" style="color: green;">Correcto.</span>';
		    $("#cuenta_bancaria_facturacion").after(mensaje);
		    $('#error_cuenta_bancaria').hide();
			return true;
		}, "La cuenta bancaria ingresada no es correcta.");
	});
        */
	</script>

<!-- FIN js -->

</body>
</html>