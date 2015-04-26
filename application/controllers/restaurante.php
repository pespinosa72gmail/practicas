<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurante extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->model('restaurante_model');
		$this->load->model('valoraciones_model');

		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Restaurantes', '/restaurante');
	}




	public function autocompletarCP(){
		if($this->input->is_ajax_request() && $this->input->post('info')){

			$cp = $this->security->xss_clean($this->input->get_post('info'));
			$buscar = $this->restaurante_model->obtenerCp($cp);

			if($buscar !== FALSE){
				echo $buscar->nombre_localidad;
			}else{ ?>
				<p><?php echo "No hay datos"; ?></p>
			<?php }
		}
	}



	public function autocompletarProvincia(){
		if($this->input->is_ajax_request() && $this->input->post('info')){

			$cp = $this->security->xss_clean($this->input->get_post('info'));
			$buscar = $this->restaurante_model->obtenerCp($cp);

			if($buscar !== FALSE){
				echo $buscar->nombre_provincia;
			}else{ ?>
				<p><?php echo "No hay datos"; ?></p>
			<?php }
		}
	}



	



	public function index() 
	{
		//Vista para dar de alta un restaurante
		if($this->session->userdata('ingresado') == TRUE) {

			$datos['listadoTodosRestaurantes'] = $this->restaurante_model->listadoTodosRestaurantes();

			$datos['title'] = "Alta restaurante";
			$datos['description'] =  "Registro de restaurantes";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}


	public function altaDatosRestaurante() {
		if($this->session->userdata('ingresado') == TRUE){

			$datos['id_restaurante'] = $this->input->get('id_restaurante', TRUE);
			$datos['listadoCategoriasRestaurante'] = $this->restaurante_model->listadoCategoriasRestaurante();
			$datos['listadoEstaciones'] = $this->restaurante_model->listadoEstaciones();

			$datos['title'] = "Alta restaurante";
			$datos['description'] =  "Registro de restaurantes";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante-2";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}






	/* Almacenado de datos */
	public function altaRestaurante()
	{
		if($this->session->userdata('ingresado') == TRUE){

			$nombre_restaurante = $this->input->post('nombre_restaurante', TRUE);
			$web_restaurante = $this->input->post('web_restaurante', TRUE);
			$direccion_restaurante = $this->input->post('direccion_restaurante', TRUE);
			$numero_restaurante = $this->input->post('numero_restaurante', TRUE);
			$cp_restaurante = $this->input->post('cp_restaurante', TRUE);
			$barrio_restaurante = $this->input->post('barrio_restaurante', TRUE);
			$precio_medio_carta = $this->input->post('precio_medio_restaurante', TRUE);
			$parking_restaurante = $this->input->post('parking_restaurante', TRUE);
			$tarjeta_restaurante = $this->input->post('tarjeta_restaurante', TRUE);
			$reservas_restaurante = $this->input->post('reservas_restaurante', TRUE);
			$visible_restaurante = $this->input->post('visible_restaurante', TRUE);

			$this->restaurante_model->altaRestaurantes($nombre_restaurante, $web_restaurante, $direccion_restaurante, $numero_restaurante, $cp_restaurante, $barrio_restaurante, $precio_medio_carta, $parking_restaurante, $tarjeta_restaurante, $reservas_restaurante, $visible_restaurante);

			$id_ultimo_restaurante = $this->restaurante_model->obtenerUltimoRestauranteRegistrado();
			redirect(base_url()."acceso/restaurador/alta-restaurante-2?id_restaurante=".$id_ultimo_restaurante->id_restaurante."");

		}else{
			redirect(base_url());
		}
	}


	public function altaRestaurante2()
	{
		if($this->session->userdata('ingresado') == TRUE){

			$id_restaurante = $this->input->get_post('id_restaurante', TRUE);


			/* Datos de facturación */
			$razon_social_facturacion = $this->input->get_post('razon_social_facturacion', TRUE);
			$calle_facturacion = $this->input->get_post('calle_facturacion', TRUE);
			$numero_facturacion = $this->input->get_post('numero_facturacion', TRUE);
			$cp_facturacion = $this->input->get_post('cp_facturacion', TRUE);
			$email_facturacion = $this->input->get_post('email_facturacion', TRUE);
			$num_cuenta_facturacion = $this->input->get_post('cuenta_bancaria_facturacion', TRUE);

			$this->restaurante_model->altaRestaurante2($id_restaurante, $razon_social_facturacion, $calle_facturacion, $numero_facturacion, $cp_facturacion, $email_facturacion, $num_cuenta_facturacion);



			$cat1_rest_facturacion = $this->input->get_post('opc1_categoria_restaurante', TRUE);
			$cat2_rest_facturacion = $this->input->get_post('opc2_categoria_restaurante', TRUE);
			$cat3_rest_facturacion = $this->input->get_post('opc3_categoria_restaurante', TRUE);

			$this->restaurante_model->altaCategoriasRestaurantes($id_restaurante, $cat1_rest_facturacion, $cat2_rest_facturacion, $cat3_rest_facturacion);
	



			
			$especialidades = $this->input->post('especialidades_restaurante');
			if(is_array($especialidades)){
				foreach ($especialidades as $value) {
					$valor = $value;
					$this->restaurante_model->altaEspecialidadesRestaurantes($id_restaurante, $valor);
				}
			}



			$puntos_cercanos = $this->input->get_post('puntos_interes');
			if(is_array($puntos_cercanos)){
				foreach ($puntos_cercanos as $value) {
					$valor = $value;
					$this->restaurante_model->altaPuntoInteresRestaurantes($id_restaurante, $valor);
				}
			}

			

			$estaciones_metro = $this->input->get_post('estaciones_metro');
			if(is_array($estaciones_metro)){
				foreach ($estaciones_metro as $value) {
					$valor = $value;
					$this->restaurante_model->altaEstacionesRestaurantes($id_restaurante, $valor);
				}
			}

			redirect(base_url()."acceso/restaurador/alta-imagenes?id_restaurante=".$id_restaurante."");

		}else{
			redirect(base_url());
		}

	}









	public function eliminarRestaurante() 
	{
		if($this->session->userdata('ingresado') == TRUE) 
		{
			$id_restaurante_eliminar = $this->input->get_post('id_restaurante_eliminar');
			$this->restaurante_model->eliminarRestaurante($id_restaurante_eliminar);
			redirect(base_url('acceso/restaurador/alta-restaurante#bajarestaurante'));
		}
		else
		{
			redirect(base_url());
		}
	}


	public function eliminarFranquiciadoRestaurante() 
	{
		if($this->session->userdata('ingresado') == TRUE) 
		{
			$id_restaurante_eliminar = $this->input->get_post('id_restaurante_eliminar');
			$plan = $this->input->get_post('plan');
			$this->restaurante_model->eliminarRestaurante($id_restaurante_eliminar);
			redirect(base_url('acceso/franquiciado/alta-propietario-franquiciado?plan='.$plan.'#bajarestaurante'));
		}
		else
		{
			redirect(base_url());
		}
	}
















	public function detalleRestaurante($slug_restaurante){
        //debug. mostrar información
        $this->output->enable_profiler(TRUE);
		
        $id_usuario = $this->session->userdata('id_usuario');
		$slug_limpio = $this->security->xss_clean($slug_restaurante);
		
        if ($id_usuario) {
			$comprobacion = $this->restaurante_model->log_detalle_restaurante($slug_limpio, $idusuario);
		} else {
			$comprobacion = $this->restaurante_model->detalle_restaurante($slug_limpio);
		}

		$this->breadcrumbs->push($comprobacion->nombre_restaurante, base_url('restaurante/'.$comprobacion->nombre_restaurante));

		$datos['detalle'] = $comprobacion;






		$datos['detallePuntosCercanos'] = $this->restaurante_model->listado_puntos_cercanos($datos['detalle']->id_restaurante);
		$datos['detalleEspecialidades'] = $this->restaurante_model->listado_especialidades($datos['detalle']->id_restaurante);
		
		$datos['detalleEstaciones'] = $this->restaurante_model->listado_estaciones($datos['detalle']->id_restaurante);
		
		/*
		echo "<pre>";
		print_r($datos['detalle']->id_restaurante);
		die();
		*/




		$datos['detalleMenu'] = $this->restaurante_model->detalle_menu_restaurante($comprobacion->id_restaurante);

		//foreach ($datos['detalleMenu'] as $key => $value) {
		foreach ($datos['detalleMenu'] as $value) {
			$datos['damePrimerosMenu'][] = $this->restaurante_model->damePrimerosMenu($value->id_menu);
		}
		
		foreach ($datos['detalleMenu'] as $value) {
			$datos['dameSegundosMenu'][] = $this->restaurante_model->dameSegundosMenu($value->id_menu);
		}
		

		
		$datos['imagenes'] = $this->restaurante_model->obtener_listado_imagenes($comprobacion->id_restaurante);


		/*
		echo "<pre>";
		print_r($datos['obtenerNumerValoraciones']);
		die();
		*/


		$datos['dameListadoCupones'] = $this->restaurante_model->dameListadoCupones($comprobacion->id_restaurante);
		
		
		$datos['obtenerNumerValoraciones'] = $this->valoraciones_model->obtenerNumerValoraciones($datos['detalle']->id_restaurante);
		$datos['dameValoracionRestaurante'] = $this->valoraciones_model->obtenerValoracionRestaurante($datos['detalle']->id_restaurante);
		$datos['valoracionesUsuarios'] = $this->valoraciones_model->valoracionesUsuarios($datos['detalle']->id_restaurante);

		$datos['title'] = "Restaurante " . $comprobacion->nombre_restaurante . " - Todoslosmenus.com";
		$datos['description'] =  $comprobacion->descripcion_restaurante ;
		$datos['robots'] = "NOINDEX, NOFOLLOW";
		$datos['contenido'] = "detalle-restaurante";
		$this->load->view ('plantillas/plantilla2', $datos);
		
		
	}





}

