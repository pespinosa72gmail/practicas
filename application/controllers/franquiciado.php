<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Franquiciado extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('franquiciado_model');
		$this->load->model('restaurante_model');
	}


	public function index(){

		if($this->session->userdata('ingresado') == TRUE){


			/* Datos del franquiciado */
			$id_franquiciado = $this->session->userdata('id_franquicia');
			$datos['datosFranquiciado'] = $this->franquiciado_model->dameDatosFranquiciado($id_franquiciado);

			$datos['listadoCpAsignados'] = $this->franquiciado_model->listadoCpAsignados($id_franquiciado);

			$datos['obtenerCpFranquiciado'] = $this->franquiciado_model->obtenerCpFranquiciado($datos['datosFranquiciado']->cp_franquiciado);



			/*
			echo "<pre>";
			print_r($datos['obtenerCpFranquiciado']);
			die();
			*/

			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "panel-franquiciado";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}

	}


	public function editarDatosFranquiciado(){

		if($this->session->userdata('ingresado') == TRUE)
		{

			$id_franquiciado = $this->session->userdata('id_franquicia');

			$nombre = $this->input->get_post('nombre_franquiciado', TRUE);
			$apellidos = $this->input->get_post('apellidos_franquiciado', TRUE);
			$cif = $this->input->get_post('cif_franquiciado', TRUE);
			$email = $this->input->get_post('email_franquiciado', TRUE);
			$telefono = $this->input->get_post('telefono_franquiciado', TRUE);
			$cp = $this->input->get_post('cp_franquiciado', TRUE);

			$this->franquiciado_model->editarDatosFranquiciado($id_franquiciado, $nombre, $apellidos, $cif, $email, $telefono, $cp);

		}
		else
		{
			redirect(base_url());
		}

	}


	public function editarPasswordFranquiciado(){

		if($this->session->userdata('ingresado') == TRUE){

			$id_franquiciado = $this->session->userdata('id_franquicia');
			$clave = sha1($this->input->get_post('password_franquiciado'));
			$this->franquiciado_model->editarPasswordFranquiciado($id_franquiciado, $clave);

		}else{
			redirect(base_url());
		}


	}



	public function eliminarCpFranquiciado(){

		if($this->session->userdata('ingresado') == TRUE)
		{

			$cp_franquiciado = $this->input->get_post('clave');
			$this->franquiciado_model->eliminarCpFranquiciado($cp_franquiciado);
			redirect(base_url('acceso/franquiciado/panel-franquiciado#cpFranquiciados'));

		}
		else
		{
			redirect(base_url());
		}

	}





	/******************************************************************************************/
	/******************************************************************************************/
	public function vistaPanelPropietarios(){

		if($this->session->userdata('ingresado') == TRUE)
		{

			/* Obtenemos el último propietario editado */
			$id_franquiciado = $this->session->userdata('id_franquicia');
			$datos['dameListadoPropietarios'] = $this->franquiciado_model->dameListadoPropietarios($id_franquiciado);

			$datos['dameUltimoPropietarioActualizado'] = $this->franquiciado_model->dameUltimoPropietarioActualizado($id_franquiciado);

			/*
			echo "<pre>";
			print_r($ultimoPropietarioActualizado);
			die();
			*/



			$datos['dameCpPropietario'] = $this->franquiciado_model->obtenerCpFranquiciado($datos['dameUltimoPropietarioActualizado']->cp_propietario);

			

			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "panel-franquiciado-gestion-propietarios";
			$this->load->view ('plantillas/plantilla2', $datos);
		}
		else
		{
			redirect(base_url());
		}

	}

	
	public function vistaPanelPropietariosUrl(){

		if($this->session->userdata('ingresado') == TRUE){

			/* Obtenemos el último propietario editado */
			$id_franquiciado = $this->session->userdata('id_franquicia');
			$id_propietario = $this->input->get_post('clave_u');
			

			$datos['dameListadoPropietarios'] = $this->franquiciado_model->dameListadoPropietarios($id_franquiciado);

			$datos['dameUltimoPropietarioActualizado'] = $this->franquiciado_model->dameUltimoPropietarioActualizadoUrl($id_propietario, $id_franquiciado);

			$datos['dameCpPropietario'] = $this->franquiciado_model->obtenerCpFranquiciado($datos['dameUltimoPropietarioActualizado']->cp_propietario);


			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "panel-franquiciado-gestion-propietarios";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}

	}




	/* Franquiciado edita los restaurantes */
	public function vistaPanelRestaurantes()
	{
		if($this->session->userdata('ingresado') == TRUE)
		{
			/* Obtengo el último Restaurante Actualizado */
			$id_franquiciado = $this->session->userdata('id_franquicia');
			$datos['listadoPropietarios'] = $this->franquiciado_model->dameListadoPropietarios($id_franquiciado);

			foreach ($datos['listadoPropietarios'] as $key => $value) {
				$datos['listadoRestaurantesFranquiciado'] = $this->franquiciado_model->listadoRestaurantesFranquiciado($value->id_propietario, $id_franquiciado);
			}

			/*
			echo "<pre>";
			print_r($datos['listadoRestaurantesFranquiciado']);
			die();
			*/
			
			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "panel-franquiciado-gestion-restaurantes";
			$this->load->view ('plantillas/plantilla2', $datos);
		}
		else
		{
			redirect(base_url());
		}
	}


	


	public function editarDatosPropietarioFranquiciado(){

		if($this->session->userdata('ingresado') == TRUE)
		{
			$id_franquiciado = $this->session->userdata('id_franquicia');

			$id_propietario = $this->input->get_post('id_propietario', TRUE);
			$nombre = $this->input->get_post('nombre_propietario', TRUE);
			$apellidos = $this->input->get_post('apellidos_propietario', TRUE);
			$email = $this->input->get_post('email_propietario', TRUE);
			$telefono = $this->input->get_post('telefono_propietario', TRUE);
			$cp = $this->input->get_post('cp_propietario', TRUE);

			$this->franquiciado_model->editarDatosPropietarioFranquiciado($id_propietario, $nombre, $apellidos, $email, $telefono, $cp);
		}
		else
		{
			redirect(base_url());
		}

	}

	public function editarPasswordPropietarioFranquiciado(){

		if($this->session->userdata('ingresado') == TRUE) {

			$id_franquiciado = $this->session->userdata('id_franquicia');

			$id_propietario = $this->input->get_post('id_propietario', TRUE);
			$password = sha1($this->input->get_post('password_propietario', TRUE));

			$this->franquiciado_model->editarPasswordPropietarioFranquiciado($id_propietario, $password);
		
		}else{
			redirect(base_url());
		}

	}


	public function buscadorPropietariosFranquiciado(){

		if($this->session->userdata('ingresado') == TRUE){

			$consulta = $this->input->get_post('search_nombre_propietario', TRUE);

			$abuscar = $this->franquiciado_model->buscadorPropietariosFranquiciado($consulta);

			if($abuscar){

				foreach ($abuscar as $key => $value) {
					echo '
					<li>
						<div class="row">
							<div class="col-md-2 nodosfilas ocultar">
								<img alt="usuario" width="70" height="70" src="'.base_url().'/assets/images/usuario.png" />
							</div>
							<div class="col-md-6 nodosfilas convertir8">
								<div>
									<strong>Nombre</strong>: ' . $value->nombre_propietario . '
								</div>
								<div>
									<strong>Apellidos</strong>: ' . $value->apellidos_propietario . '
								</div>
								<div>
									<strong>Restaurante</strong>: El Rodado (Boadilla del Monte, Madrid)
								</div>
							</div>
							<div class="col-md-4 nodosfilas">
								<div class="enlacesencillo">
									<a href="' . base_url() . 'acceso/franquiciado/panel-franquiciado-gestion-propietarios-url?clave_u=' . $value->id_propietario . '">Seleccionar<span>
									<i class="fa fa-arrow-circle-right"></i></span></a>
								</div>
							</div>
						</div>
					</li>
					';
				}

			}else{
				echo "Nada que mostrar";
			}

		}else{
			redirect(base_url());
		}

	}

	/******************************************************************************************/
	/******************************************************************************************/





	/******************************************************************************************/
	/******************************************************************************************/
	public function vistaAltaPropietariosPlan(){
		if($this->session->userdata('ingresado') == TRUE){

			$datos['clave_propietario'] = "";

			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante-franquiciado-plan";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}


	public function vistaAltaPropietarios(){
		if($this->session->userdata('ingresado') == TRUE)
		{

			$id_franquiciado = $this->session->userdata('id_franquicia');
			$datos['listadoTodosRestaurantes'] = $this->franquiciado_model->listadoTodosRestaurantes($id_franquiciado);

			
			/*
			echo "<pre>";
			print_r($datos['listadoTodosRestaurantes']);
			die();
			*/


			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante-franquiciado";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}



	public function altaPropietariosFranquiciado()
	{
		if($this->session->userdata('ingresado') == TRUE)
		{
			$plan_restaurante = $this->input->get_post('clave_plan', TRUE);

			$nombre = $this->input->post('nombre_propietario', TRUE);
			$apellidos = $this->input->post('apellidos_propietario', TRUE);
			$email = $this->input->post('email_propietario', TRUE);
			$password = sha1($this->input->post('password_propietario', TRUE));
			$telefono = $this->input->post('telefono_propietario', TRUE);
			$cp = $this->input->post('cp_propietario', TRUE);
			$id_franquiciado = $this->session->userdata('id_franquicia');
			$clave = random_string('unique');

			$this->franquiciado_model->altaPropietariosFranquiciado($nombre, $apellidos, $email, $password, $telefono, $cp, $id_franquiciado, $clave);

			redirect(base_url().'acceso/franquiciado/alta-propietario-franquiciado-2?clave='.$clave.'&plan='.$plan_restaurante);

		}else{
			redirect(base_url());
		}
	}



	public function vistaAltaPropietarios2()
	{
		if($this->session->userdata('ingresado') == TRUE)
		{
			$plan = $this->input->get('plan');
			$datos['planContratado'] = $plan;

			$clave = $this->input->get('clave');
			$datos['dameClavePropietario'] = $this->franquiciado_model->dameClavePropietario($clave);
			$datos['listadoCategorias'] = $this->franquiciado_model->listadoCategorias();
			$datos['listadoEstaciones'] = $this->franquiciado_model->listadoEstaciones();

			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante-franquiciado-2";
			$this->load->view ('plantillas/plantilla2', $datos);
		}else{
			redirect(base_url());
		}
	}


	public function altaPropietariosFranquiciado2()
	{
		if($this->session->userdata('ingresado') == TRUE)
		{

			/* Registro datos del restaurante */
			$id_propietario = $this->input->get_post('id_propietario', TRUE);
			$tipo_establecimiento = $this->input->get_post('nombre_select_restaurante', TRUE);
			$nombre_restaurante = $this->input->get_post('nombre_restaurante', TRUE);
			$clave_restaurante = $this->input->get_post('clave_restaurante', TRUE);

			$nombre_final_restaurante = $tipo_establecimiento. ' ' . $nombre_restaurante;
		
			$web_restaurante = $this->input->get_post('web_restaurante', TRUE);
			$email_restaurante = $this->input->get_post('email_restaurante', TRUE);
			$direccion_restaurante = $this->input->get_post('direccion_restaurante', TRUE);
			$numero_restaurante = $this->input->get_post('numero_restaurante', TRUE);
			$cp_restaurante = $this->input->get_post('cp_restaurante', TRUE);
			$barrio_restaurante = $this->input->get_post('barrio_restaurante', TRUE);
			$precio_medio_restaurante = $this->input->get_post('precio_medio_restaurante', TRUE);
			$parking_restaurante = $this->input->get_post('parking_restaurante', TRUE);
			$tarjeta_restaurante = $this->input->get_post('tarjetas_restaurante', TRUE);
			$reservas_restaurante = $this->input->get_post('reservas_restaurante', TRUE);
			$visible_restaurante = $this->input->get_post('visible_restaurante', TRUE);



			$clave_plan = $this->input->get_post('clave_plan');

			if($clave_plan == "eJ6RW7aD"){
				//Plan Freemium o Gratis contratado
				$plan = 1;
			}else if($clave_plan == "uKjHMt6g"){
				//Plan Básico
				$plan = 2;
			}else if($clave_plan == "UE5Zg3YG"){
				//Plan Premium
				$plan = 3;
			}

			$this->franquiciado_model->altaRestaurantes($id_propietario, $nombre_final_restaurante, $web_restaurante, $email_restaurante, $direccion_restaurante, $numero_restaurante, $cp_restaurante, $barrio_restaurante, $precio_medio_restaurante, $parking_restaurante, $tarjeta_restaurante, $reservas_restaurante, $visible_restaurante, $tipo_establecimiento, $plan, $clave_restaurante);

		}else{
			redirect(base_url());
		}
	}











	public function vistaAltaPropietarios3(){

		if($this->session->userdata('ingresado') == TRUE){

			$clave = $this->input->get('clave_rest');
			$clave_plan = $this->input->get_post('clave_plan');

			$datos['dameDatosRestaurante'] = $this->franquiciado_model->dameDatosRestaurante($clave);

			$datos['listadoCategorias'] = $this->franquiciado_model->listadoCategorias();
			$datos['listadoEstaciones'] = $this->franquiciado_model->listadoEstaciones();

			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante-franquiciado-3";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}

	}


	public function altaPropietariosFranquiciado3()
	{
		if($this->session->userdata('ingresado') == TRUE)
		{
			
			/* Registro datos del Propietario */
			$id_restaurante = $this->input->get_post('clave_restaurante', TRUE);
			
			$razon_social = $this->input->get_post('razon_social_facturacion', TRUE);
			$cif = $this->input->get_post('cif_facturacion', TRUE);
			$direccion = $this->input->get_post('direccion_facturacion', TRUE);
			$numero = $this->input->get_post('numero_facturacion', TRUE);
			$cp = $this->input->get_post('cp_facturacion', TRUE);
			$email = $this->input->get_post('email_facturacion', TRUE);
			$cuenta = $this->input->get_post('cuenta_facturacion', TRUE);

			$this->franquiciado_model->altaFacturacionPropietariosFranquiciado($id_restaurante, $razon_social, $cif, $direccion, $numero, $cp, $email, $cuenta);




			/* Se registran los datos de las categorías */
			$primera_categoria = $this->input->get_post('primera_select_categoria', TRUE);
			$segunda_categoria = $this->input->get_post('segunda_select_categoria', TRUE);
			$tercera_categoria = $this->input->get_post('tercera_select_categoria', TRUE);

			$this->franquiciado_model->altaCategoriaRestaurante($id_restaurante, $primera_categoria, $segunda_categoria, $tercera_categoria);



			/* Se registran los datos de las Especialidades */
			$especialidades = $this->input->get_post('nombre_especialidad', TRUE);
			if(is_array($especialidades))
			{
				foreach ($especialidades as $value) 
				{
					$valor = $value;
					$this->restaurante_model->altaEspecialidadesRestaurantes($id_restaurante, $valor);
				}
			}


			/* Se registran los datos de las Puntos de interés */
			$puntos_cercanos = $this->input->get_post('puntos_interes');
			if(is_array($puntos_cercanos))
			{
				foreach ($puntos_cercanos as $value) 
				{
					$valor = $value;
					$this->restaurante_model->altaPuntoInteresRestaurantes($id_restaurante, $valor);
				}
			}

			
			/* Se registran los datos de las Estaciones */
			$estaciones_metro = $this->input->get_post('nombre_estacion');
			if(is_array($estaciones_metro))
			{
				foreach ($estaciones_metro as $value) 
				{
					$valor = $value;
					$this->restaurante_model->altaEstacionesRestaurantes($id_restaurante, $valor);
				}
			}




			$clave_plan = $this->input->get_post('clave_plan');
			if($clave_plan == "eJ6RW7aD") {
				//Plan Freemium o Gratis contratado
				$plan = 1;
			}else if($clave_plan == "uKjHMt6g") {
				//Plan Básico
				$plan = 2;
			}else if($clave_plan == "UE5Zg3YG") {
				//Plan Premium
				$plan = 3;
			}


			if($plan != 1){
				redirect(base_url().'acceso/franquiciado/alta-propietario-franquiciado-4?clave_rest='.$id_restaurante);
			}else{
				redirect(base_url().'acceso/franquiciado/panel-franquiciado-gestion-propietarios');
			}


		}else{
			redirect(base_url());
		}
	}



	public function vistaAltaPropietarios4()
	{

		if($this->session->userdata('ingresado') == TRUE){

			$clave = $this->input->get('clave_rest');
			$datos['dameDatosRestaurante'] = $this->franquiciado_model->dameDatosRestaurante($clave);

			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante-franquiciado-4";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}

	}

	/******************************************************************************************/
	/******************************************************************************************/







	/******************************************************************************************/
	/******************************************************************************************/

	/* Funciones para que un Franquiciado dé de Alta un Restaurante asociado a un Propietario */
	public function vistaAltaRestaurantePlan(){

		if($this->session->userdata('ingresado') == TRUE){

			$id_propietario = $this->input->get_post('clave');

			/* Obtenemos el ID del usuario al que pasamos la clave */
			$datos['clave_propietario'] = $this->franquiciado_model->obtenerDatosPropietario($id_propietario);



			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-restaurante-franquiciado-plan";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}

	}

	/******************************************************************************************/
	/******************************************************************************************/












}

