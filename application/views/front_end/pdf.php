<article>

	<aside class="logo">
		<img src="./assets/images/logo.png" alt="logo" title="logo">
	</aside>

	<aside class="cabecera">
		<h2>ESTE ES UN CUPÓN PARA EL RESTAURANTE</h2>
		<div class="restaurante"><h4><?php echo $detalle->nombre_restaurante; ?> (<?php echo $dameCp->nombre_localidad . ', ' .$dameCp->nombre_provincia; ?>)</h4></div>
	</aside>

	<aside class="cuerpo">
		<div class="fechas">Fecha de validez</div>
		<p><strong>Inicio:</strong> <?php echo $detalle->fecha_inicio_cupon; ?></p>
		<p><strong>Fin:</strong> <?php echo $detalle->fecha_fin_cupon; ?></p>
	</aside>

	<aside class="cupon">
		<div class="header">
			<strong><?php echo $detalle->titulo_cupon; ?></strong>
		</div>

		<div class="body">
			<p class="descripcion">Descripción</p>
			<?php echo $detalle->descripcion_cupon; ?>
		</div>
	</aside>


	<aside class="codigo">
		<?php $codigo = "Juan Carlos Hernández"; ?>
		<span>Usuario: <?php echo $codigo; ?></span>
	</aside>

</article>