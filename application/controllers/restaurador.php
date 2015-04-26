<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restaurador extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('restaurador_model');
        $this->load->model('restaurante_model');
        $this->load->model('franquiciado_model');
        $this->load->model('home_model');
        $this->load->model('buscador_model');
        $this->load->model('footer_model');

        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Panel Restaurador', '/acceso/restaurador/panel-restaurador');
    }

    public function index() {

        $this->output->enable_profiler(TRUE);

        //Comprobamos si viene por post el id de restaurante
        $id_restaurante = $this->input->post('id_restaurante', TRUE);

        if ($this->session->userdata('ingresado') == TRUE) {
            $id_restaurador = $this->session->userdata('id_propietario');
            $datos['id_propietario'] = $id_restaurador;
            $datos['restaurador'] = $this->restaurador_model->datosRestaurador($id_restaurador);
            /*
              //Provincia Restaurador
              if (!isset($datos['restaurador']->provincias_id_provincia)){
              $datos['restaurador']->provincias_id_provincia=$this->home_model->getProvinciaByLocalidad($datos['restaurador']->localidades_id_localidad);
              }
             */
            $datos['cpRestaurador'] = $this->restaurador_model->obtenerCpRestaurador($datos['restaurador']->cp_propietario);


            $datos['listadoRestaurantes'] = $this->restaurador_model->listadoRestaurantesRestaurador($id_restaurador);

            //Restaurantes del Propietario ordenado por fecha_actualizacion DESC
            if ($id_restaurante) {
                $datos['restauranteActual'] = $this->restaurador_model->getRestauranteData($id_restaurante);
            } else {
                $datos['restauranteActual'] = $this->restaurante_model->dameRestauranteActualizado($id_restaurador);
            }

            /*             * ******************************************* */
            /*             * ******************************************* */
            /*             * ******************************************* */
            $datos['listadoMenus'] = $this->restaurador_model->listadoMenusRestaurantes($datos['restauranteActual']->id_restaurante);
            /*             * ******************************************* */
            /*             * ******************************************* */
            /*             * ******************************************* */
            //var_dump($datos['listadoMenus']);die;
            //$datos['listadoPrimeros'] = array();
            //$datos['listadoPrimeros'] = array();
            //Platos de los menÃºs del restaurante
            foreach ($datos['listadoMenus'] as $menu) {
                $datos['listadoPrimeros'][] = $this->buscador_model->buscador_primeros($menu->id_menu);
                $datos['listadoSegundos'][] = $this->buscador_model->buscador_segundos($menu->id_menu);
            }

            if ($datos['listadoMenus']) {
                $datos['listadoMenusHabituales'] = $this->restaurador_model->listadoMenusHabituales($datos['listadoMenus'][0]->id_menu);
            } else {
                $datos['listadoMenusHabituales'] = "";
            }


            $cp = $datos['restauranteActual']->cp_restaurante;
            $datos['dameCpRestaurante'] = $this->restaurante_model->obtenerCpRestaurante($cp);

            $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();

            //$datos['listadoEspecialidades'] = $this->restaurador_model->listadoEspecialidadesRestaurante($datos['restauranteActual']->id_restaurante);

            //$datos['listadoPuntosInteres'] = $this->restaurador_model->listadoPuntosInteres($datos['restauranteActual']->id_restaurante);

            //Derepente han dejao de funcionar estas dos lineas
            $datos['datosFacturacion'] = $this->restaurador_model->datosFacturacion($datos['restauranteActual']->id_restaurante);
            $datos['provinciaMunicipioDatosFacturacion'] = $this->restaurador_model->provinciaMunicipioDatosFacturacion($datos['datosFacturacion']->localidades_id_localidad);
            $datos['listadoPlanes'] = $this->restaurador_model->listadoPlanes();
            //$datos['listadoCuponesRestaurate'] = $this->restaurador_model->listadoCuponesRestaurate($datos['restauranteActual']->id_restaurante);
            //$datos['listadoEstacionesRestaurante'] = $this->restaurador_model->listadoEstacionesRestaurante($datos['restauranteActual']->id_restaurante);
            $datos['listadoEstaciones'] = $this->restaurador_model->listadoEstaciones();


            //$datos['listadoImagenes'] = $this->restaurador_model->listadoImagenes($datos['restauranteActual']->id_restaurante);

            $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
            $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
            $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
            $datos['robots'] = "NOINDEX, NOFOLLOW";
            $datos['contenido'] = "panel-restaurador";
            $this->load->view('plantillas/plantilla2', $datos);
        } else {
            redirect(base_url());
        }
    }

    public function index_url() {
        if ($this->session->userdata('ingresado') == TRUE) {
            $id_restaurador = $this->session->userdata('id_propietario');

            $id_restaurante = $this->input->get('id');

            $datos['restaurador'] = $this->restaurador_model->datosRestaurador($id_restaurador);
            $datos['cpRestaurador'] = $this->restaurador_model->obtenerCpRestaurador($datos['restaurador']->cp_propietario);


            $datos['listadoRestaurantes'] = $this->restaurador_model->listadoRestaurantesRestaurador($id_restaurador);

            /*             * ******************************************* */
            $datos['dameUltimoRestauranteActualizado'] = $this->restaurante_model->dameRestauranteActualizado_2($id_restaurante);
            /*             * ******************************************* */

            $datos['listadoMenus'] = $this->restaurador_model->listadoMenusRestaurantes($id_restaurante);

            //$datos['listadoMenusHabituales'] = $this->restaurador_model->listadoMenusHabituales();


            $cp = $datos['dameUltimoRestauranteActualizado']->cp_restaurante;
            $datos['dameCpRestaurante'] = $this->restaurante_model->obtenerCpRestaurante($cp);

            $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
            $datos['listadoEspecialidades'] = $this->restaurador_model->listadoEspecialidadesRestaurante($id_restaurante);
            $datos['listadoPuntosInteres'] = $this->restaurador_model->listadoPuntosInteres($id_restaurante);

            $datos['datosFacturacion'] = $this->restaurador_model->datosFacturacion($id_restaurante);
            $datos['dameCpDatosFacturacion'] = $this->restaurador_model->obtenerCp($datos['datosFacturacion']->cp_facturacion);
            $datos['listadoPlanes'] = $this->restaurador_model->listadoPlanes();
            $datos['listadoCuponesRestaurate'] = $this->restaurador_model->listadoCuponesRestaurate($id_restaurante);
            $datos['listadoEstacionesRestaurante'] = $this->restaurador_model->listadoEstacionesRestaurante($id_restaurante);
            $datos['listadoEstaciones'] = $this->restaurador_model->listadoEstaciones();
            $datos['listadoImagenes'] = $this->restaurador_model->listadoImagenes($id_restaurante);

            $datos['title'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
            $datos['description'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
            $datos['robots'] = "NOINDEX, NOFOLLOW";
            $datos['contenido'] = "panel-restaurador";
            $this->load->view('plantillas/plantilla2', $datos);
        } else {
            redirect(base_url());
        }
    }
	
	/* Alta de restaurante */
	
	public function altaRestaurantePlan(){
		if($this->session->userdata('ingresado') == TRUE){
		
       		$this->breadcrumbs->push('Plan de nuevo restaurante', '/acceso/restaurador/alta-restaurante-plan');
			
			$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "alta-restaurante-restaurador-plan";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}
	
	public function registroRestaurante($plan) 
	{
		//Vista para dar de alta un restaurante
		if($this->session->userdata('ingresado') == TRUE) {

       		$this->breadcrumbs->push('Plan de nuevo restaurante', '/acceso/restaurador/alta-restaurante-plan');
       		$this->breadcrumbs->push('Datos de restaurante', '/acceso/restaurador/alta-restaurante/' . $plan);
			
			$datos['planContratado'] = $plan;
			
			$datos['listadoTodosRestaurantes'] = $this->restaurante_model->listadoTodosRestaurantes();

			$datos['title'] = "Alta restaurante";
			$datos['description'] =  "Registro de restaurantes";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			//$datos['contenido'] = "registro-restaurante";
			$datos['contenido'] = "alta-restaurante-restaurador";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}
	
	public function altaRestaurante()
	{
		if($this->session->userdata('ingresado') == TRUE)
		{

			/* Registro datos del restaurante - Ordenado por el orden de la tabla de la base de datos */
			$clave_restaurante = random_string('unique');
			$nombre_restaurante = $this->input->get_post('nombre_restaurante', TRUE);
			$tipo_establecimiento = $this->input->get_post('nombre_select_restaurante', TRUE);
			$direccion_restaurante = $this->input->get_post('direccion_restaurante', TRUE);
			$numero_restaurante = $this->input->get_post('numero_restaurante', TRUE);
			$latlong_restaurante = $this->input->post('latlong_restaurante', TRUE);
			$latlong_restaurante = explode(",", preg_replace("/^\(|\)$/", "", $latlong_restaurante));
			$barrio_restaurante = $this->input->get_post('barrio_restaurante', TRUE);
			$web_restaurante = $this->input->get_post('web_restaurante', TRUE);
			$email_restaurante = $this->input->get_post('email_restaurante', TRUE);
			$cp_restaurante = $this->input->get_post('cp_restaurante', TRUE);
			$precio_medio_restaurante = $this->input->get_post('precio_medio_restaurante', TRUE);
			$activo_restaurante = 0;
			$reservas_restaurante = $this->input->get_post('reservas_restaurante', TRUE);
			$parking_restaurante = $this->input->get_post('parking_restaurante', TRUE);
			$tarjetas_restaurante = $this->input->get_post('tarjetas_restaurante', TRUE);
			$visible_restaurante = $this->input->get_post('visible_restaurante', TRUE);
			$localidad = $this->input->get_post('localidad', TRUE);
			$clave_plan = $this->input->get_post('clave_plan');
			$plan = 0;
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
			$id_propietario = $this->session->userdata('id_propietario');
			
			//$nombre_final_restaurante = $tipo_establecimiento. ' ' . $nombre_restaurante;
		

			$resultado = $this->restaurador_model->altaRestaurantes($clave_restaurante, $nombre_restaurante, $tipo_establecimiento, $direccion_restaurante, $numero_restaurante, $latlong_restaurante[0], $latlong_restaurante[1], $barrio_restaurante, $web_restaurante, $email_restaurante, $cp_restaurante, $precio_medio_restaurante, $activo_restaurante, $reservas_restaurante, $parking_restaurante, $tarjetas_restaurante, $visible_restaurante, $localidad, $plan, $id_propietario);
			echo $resultado . 'separadorsplit' . $clave_restaurante;

		}else{
			redirect(base_url());
		}
	}
	
	public function registroRestaurante2($clave_plan, $clave_restaurante) 
	{
		//Vista para dar de alta un restaurante
		if($this->session->userdata('ingresado') == TRUE) {

       		$this->breadcrumbs->push('Plan de nuevo restaurante', '/acceso/restaurador/alta-restaurante-plan');
       		$this->breadcrumbs->push('Datos de restaurante', '/acceso/restaurador/alta-restaurante/' . $clave_plan);
       		$this->breadcrumbs->push('Datos de facturación', '/acceso/restaurador/alta-restaurante-2/' . $clave_plan . '/'. $clave_restaurante);
			
			$datos['clave_plan'] = $clave_plan;
			$datos['clave_restaurante'] = $clave_restaurante;
			
            $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
            $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        	$datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();

			$datos['title'] = "Alta restaurante";
			$datos['description'] =  "Registro de restaurantes";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			//$datos['contenido'] = "registro-restaurante";
			$datos['contenido'] = "alta-restaurante-restaurador-2";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}

	public function altaRestaurante3()
	{
		if($this->session->userdata('ingresado') == TRUE)
		{
			
			$clave_restaurante	 = $this->input->get_post('clave_restaurante', TRUE);
			$datosRestaurante = $this->franquiciado_model->dameDatosRestaurante($clave_restaurante);
			
			$id_restaurante = $datosRestaurante->id_restaurante;
			
			$razon_social = $this->input->get_post('razon_social_facturacion', TRUE);
			$cif = $this->input->get_post('cif_facturacion', TRUE);
			$direccion = $this->input->get_post('direccion_facturacion', TRUE);
			$numero = $this->input->get_post('numero_facturacion', TRUE);
			$cp = $this->input->get_post('cp_facturacion', TRUE);
			$municipio = $this->input->get_post('municipio_facturacion', TRUE);
			$email = $this->input->get_post('email_facturacion', TRUE);
			$cuenta = $this->input->get_post('cuenta_facturacion', TRUE);

			$this->franquiciado_model->altaFacturacionPropietariosFranquiciado($id_restaurante, $razon_social, $cif, $direccion, $numero, $cp, $municipio, $email, $cuenta);




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
			$id_estaciones = $this->input->get_post('id_estacion');
			$estaciones_metro = $this->input->get_post('nombre_estacion');
			if(is_array($estaciones_metro))
			{
				$num = 0;
				foreach ($estaciones_metro as $nombre_estacion) 
				{
					$this->franquiciado_model->altaEstacionesRestaurantes($id_restaurante, $id_estaciones[$num], $nombre_estacion);
					$num++;
				}
			}
			
			// Poner a 1 el campo activo_restaurante
			$this->franquiciado_model->activarRestaurante($id_restaurante);




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
				redirect(base_url().'acceso/restaurador/alta-imagenes/'.$id_restaurante);
			}else{
				redirect(base_url().'acceso/restaurador/panel-restaurador');
			}

		}else{
			redirect(base_url());
		}
	}
	
	public function altaRestaurante4($id_restaurante) 
	{
		//Vista para dar de alta un restaurante
		if($this->session->userdata('ingresado') == TRUE) {

			$datos['id_restaurante'] = $id_restaurante;
			
			$datos['direccionRestaurante'] = $this->franquiciado_model->direccionRestaurante($id_restaurante);

			$datos['title'] = "Alta restaurante";
			$datos['description'] =  "Registro de restaurantes";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			//$datos['contenido'] = "registro-restaurante";
			$datos['contenido'] = "alta-restaurante-restaurador-3";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}
	}



	
	
	
	/* Baja de Restaurantes */
	
    public function listadoBajaRestaurantes() {
        echo json_encode($this->restaurador_model->listadoBajaRestaurantes());
    }
	
	
	
	/* Gestión de datos */

    public function actualizarDatosRestaurador() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurador = $this->session->userdata('id_propietario');

            $nombre_propietario = $this->input->post('nombre_propietario', TRUE);
            $apellidos_propietario = $this->input->post('apellidos_propietario', TRUE);
            $email_propietario = $this->input->post('email_propietario', TRUE);
            $pass_propietario = $this->input->post('pass_propietario', TRUE);
            $dni_propietario = $this->input->post('dni_propietario', TRUE);
            $telefono_propietario = $this->input->post('telefono_propietario', TRUE);
            $cp_propietario = $this->input->post('cp_propietario', TRUE);


            if ($pass_propietario != "") {
                $this->restaurador_model->editarDatosRestaurador($id_restaurador, $nombre_propietario, $apellidos_propietario, $email_propietario, $pass_propietario, $dni_propietario, $telefono_propietario, $cp_propietario);

                $this->enviarCambioContrasena($email_propietario, $pass_propietario);
            } else {
                $this->restaurador_model->editarDatosRestaurador2($id_restaurador, $nombre_propietario, $apellidos_propietario, $email_propietario, $dni_propietario, $telefono_propietario, $cp_propietario);
            }
        } else {
            redirect(base_url());
        }
    }

    public function enviarCambioContrasena($email, $clave) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = 'Estimado propietário, acabas de actulizar tu contraseña.';

        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to($email);
        $this->email->subject('Contraseña actualizada');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    public function actualizarDatosRestaurante() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->post('id_restaurante', TRUE);
            $nombre_restaurante = $this->input->post('nombre_restaurante', TRUE);
            $web_restaurante = $this->input->post('web_restaurante', TRUE);
            $direccion_restaurante = $this->input->post('direccion_restaurante', TRUE);
            $numero_restaurante = $this->input->post('numero_restaurante', TRUE);

            $cp_restaurante = $this->input->post('cp_restaurante', TRUE); //Este se deja para el Ãºltimo

            $barrio_restaurante = $this->input->post('barrio_restaurante', TRUE);
            $precio_medio_restaurante = $this->input->post('precio_medio_restaurante', TRUE);
            $parking_restaurante = $this->input->post('parking_restaurante', TRUE);
            $tarjetas_restaurante = $this->input->post('tarjetas_restaurante', TRUE);
            $reservas_restaurante = $this->input->post('reservas_restaurante', TRUE);
            $visible_restaurante = $this->input->post('visible_restaurante', TRUE);

            $this->restaurador_model->editarDatosRestaurante($id_restaurante, $nombre_restaurante, $web_restaurante, $direccion_restaurante, $numero_restaurante, $barrio_restaurante, $precio_medio_restaurante, $parking_restaurante, $tarjetas_restaurante, $reservas_restaurante, $visible_restaurante, $cp_restaurante);

            $this->restaurador_model->actualizarRestauranteClave($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    public function actualizarPdfRestaurante() {

        if ($this->session->userdata('ingresado') == TRUE) {

            /* Aqui */
            if (!empty($_FILES)) {

                $tempFile = $_FILES['archivo_carta']['tmp_name'];
                $fileName = convert_accented_characters(time() . '-' . $_FILES['archivo_carta']['name']);
                $targetPath = getcwd() . '/assets/pdfs/';
                $targetFile = $targetPath . $fileName;
                move_uploaded_file($tempFile, $targetFile);

                $id_restaurantes = $this->input->get_post('id_restaurantes', TRUE);
                $this->restaurador_model->subirPdf($id_restaurantes, $fileName);
                echo "<a href='" . base_url() . "assets/pdfs/" . $fileName . "' target='_blank'>Mostrar carta</a>";
            }
        } else {
            //redirect(base_url());
        }
    }

    public function editarCategoriasRestaurante() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->post('id_restaurante', TRUE);

            $primera_categoria_restaurante = $this->input->post('primera_categoria_restaurante', TRUE);
            $segunda_categoria_restaurante = $this->input->post('segunda_categoria_restaurante', TRUE);
            $tercera_categoria_restaurante = $this->input->post('tercera_categoria_restaurante', TRUE);

            $this->restaurador_model->editarCategoriasRestaurantes($id_restaurante, $primera_categoria_restaurante, $segunda_categoria_restaurante, $tercera_categoria_restaurante);

            $this->restaurador_model->actualizarRestauranteClave($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    /*     * ********** Especialidades *********** */

    public function anadirEspecialidad() {
        if ($this->session->userdata('ingresado') == TRUE) {
            $id_restaurante = $this->input->post('id_restaurantes', TRUE);
            $select_nombre_especialidad = $this->input->post('select_nombre_especialidad', TRUE);
            $this->restaurador_model->anadirEspecialidadRestaurante($id_restaurante, $select_nombre_especialidad);

            $this->restaurador_model->actualizarRestauranteID($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    public function borrarEspecialidad() {
        if ($this->session->userdata('ingresado') == TRUE) {
            $id_especialidad = $this->input->get_post('id_especialidad', TRUE);
            $resultado = $this->restaurador_model->borrarEspecialidadRestaurante($id_especialidad);
			echo $resultado;
        } else {
            redirect(base_url());
        }
    }
	
	// Esta la dejo por si la usa alguien
    public function eliminarEspecialidad() {
        if ($this->session->userdata('ingresado') == TRUE) {
            $clave_especialidad = $this->input->get('clave', TRUE);
            $this->restaurador_model->eliminarEspecialidadRestaurante($clave_especialidad);
            redirect(base_url('acceso/restaurador/panel-restaurador'));
        } else {
            redirect(base_url());
        }
    }

    /*     * ******** Puntos de interes ********* */

    public function listadoPuntosInteresJSON($id_restaurante = null) {
        echo json_encode($this->restaurador_model->listadoPuntosInteres($this->input->get_post('id_restaurante', TRUE)));
    }

    public function anadirPuntoInteres() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->get_post('id_restaurantes', TRUE);
            $nombre_punto_cercano = $this->input->get_post('select_nombre_punto_cercano', TRUE);
            $this->restaurador_model->anadirPuntoInteres($id_restaurante, $nombre_punto_cercano);

            $this->restaurador_model->actualizarRestauranteID($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    public function borrarPuntoInteres() {
        if ($this->session->userdata('ingresado') == TRUE) {
            $id_punto_interes = $this->input->get_post('id_punto_interes', TRUE);
            $resultado = $this->restaurador_model->borrarPuntoInteres($id_punto_interes);
			echo $resultado;
        } else {
            redirect(base_url());
        }
    }
	
	// Esta la dejo por si la usa alguien
    public function eliminarPuntoInteres() {
        if ($this->session->userdata('ingresado') == TRUE) {
            $clave = $this->input->get_post('pinteres', TRUE);
            $this->restaurador_model->eliminarPuntosInteres($clave);
            redirect(base_url('acceso/restaurador/panel-restaurador'));
        } else {
            redirect(base_url());
        }
    }

    /*     * ******** Estaciones de metro ********* */

    public function listadoEstacionesMetroJSON($id_restaurante = null) {
        echo json_encode($this->restaurador_model->listadoEstacionesMetroRestaurante($this->input->get_post('id_restaurante', TRUE)));
    }
	
    public function addEstacionMetro() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->get_post('id_restaurante', TRUE);
            $id_estacion = $this->input->get_post('id_estacion_metro', TRUE);
            $nombre_estacion = $this->input->get_post('nombre_estacion_metro', TRUE);

            $resultado = $this->restaurador_model->addEstacionMetro($id_restaurante, $id_estacion, $nombre_estacion);
			echo $resultado;
        } else {
            redirect(base_url());
        }
    }
	
    public function borrarEstacionMetro() {

        if ($this->session->userdata('ingresado') == TRUE) {
            $id_estacion = $this->input->get_post('id_estacion_metro', TRUE);

            $resultado = $this->restaurador_model->borrarEstacionMetro($id_estacion);
			echo $resultado;
        } else {
            redirect(base_url());
        }
    }
	
	// La dejo por si la usa alguien
    public function altaEstacion() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurantes = $this->input->get_post('id_restaurantes', TRUE);
            $nombre_estacion = $this->input->post('nombre_estacion', TRUE);

            $this->restaurador_model->anadirEstacion($id_restaurantes, $nombre_estacion);
        } else {
            redirect(base_url());
        }
    }

	// La dejo por si la usa alguien
    public function eliminarEstacione() {
        if ($this->session->userdata() == TRUE) {

            $id_restarante = $this->input->post('id_restaurantes');
        } else {
            redirect(base_url());
        }
    }

    /*     * ******** Datos de FacturaciÃ³n ********* */


	public function modificarDatosFacturacion(){
		if($this->session->userdata('ingresado') == TRUE)
		{
			$id_restaurante = $this->input->get_post('id_restaurante');
			$campo = $this->input->get_post('campo');
			$contenido = $this->input->get_post('contenido');
			
			$afftectedRows = $this->restaurador_model->modificarDatosFacturacion($id_restaurante, $campo, $contenido);
			echo $afftectedRows;
		}
		else
		{
			redirect(base_url());
		}

	}
	
	// La dejo por si se utiliza alguien
    public function editarDatosFacturacion() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->post('id_restaurantes', TRUE);
            $razon_social = $this->input->post('razon_social_facturacion', TRUE);

            $direccion_facturacion = $this->input->post('direccion_facturacion', TRUE);
            $numero_facturacion = $this->input->post('numero_facturacion', TRUE);
            $cp_facturacion = $this->input->post('cp_facturacion', TRUE);
            $email_facturacion = $this->input->post('email_facturacion', TRUE);
            $periodo_facturacion = $this->input->post('periodo_facturacion', TRUE);
            $num_cuenta_facturacion = $this->input->post('num_cuenta_facturacion', TRUE);

            $cif_facturacion = $this->input->post('cif_facturacion', TRUE);


            $this->restaurador_model->editarDatosFacturacion($id_restaurante, $razon_social, $direccion_facturacion, $numero_facturacion, $cp_facturacion, $email_facturacion, $periodo_facturacion, $num_cuenta_facturacion, $cif_facturacion);

            $this->restaurador_model->actualizarRestauranteID($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    /* Editar el plan contratado en ese momento */

    public function editarPlanContratado() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->post('id_restaurantes', TRUE);
            $plan_contratado = $this->input->Post('plan_contratado', TRUE);

            $this->restaurador_model->editarPlanContratado($id_restaurante, $plan_contratado);

            $this->restaurador_model->actualizarRestauranteID($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    /* Acciones relacionadas con los cupones - Añadir, Editar y Eliminar cupón */

    public function listadoCuponesRestaurateJSON() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->post('id_restaurante', TRUE);

            $resultado = $this->restaurador_model->listadoCuponesRestaurate($id_restaurante);
       		echo json_encode($resultado);

            $this->restaurador_model->actualizarRestauranteID($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    public function anadirCuponRestaurante() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->post('id_restaurantes', TRUE);
            $titulo_cupon = $this->input->post('titulo_cupon', TRUE);
            $descripcion_cupon = $this->input->post('descripcion_cupon', TRUE);
            $fecha_inicio_cupon = $this->input->post('fecha_inicio_cupon', TRUE);
            $fecha_fin_cupon = $this->input->post('fecha_fin_cupon', TRUE);

            $this->restaurador_model->anadirCupon($id_restaurante, $titulo_cupon, $descripcion_cupon, $fecha_inicio_cupon, $fecha_fin_cupon);

            $this->restaurador_model->actualizarRestauranteID($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    public function modificarCupon() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $id_cupon = $this->input->get_post('id_cupon', TRUE);

            $titulo_cupon = $this->input->get_post('select_titulo_cupon', TRUE);
            $descripcion_cupon = $this->input->get_post('select_descripcion_cupon', TRUE);
            $fecha_inicio_cupon = $this->input->get_post('select_fecha_inicio_cupon', TRUE);
            $fecha_fin_cupon = $this->input->get_post('select_fecha_fin_cupon', TRUE);

            $resultado = $this->restaurador_model->modificarCupon($id_cupon, $titulo_cupon, $descripcion_cupon, $fecha_inicio_cupon, $fecha_fin_cupon);
			echo $resultado;	
        } else {
            redirect(base_url());
        }
    }

	// La dejo por si la usa alguien
    public function editarCuponRestaurante() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $clave_cupon = $this->input->get_post('clave_cupon', TRUE);

            $titulo_cupon = $this->input->get_post('select_titulo_cupon', TRUE);
            $descripcion_cupon = $this->input->get_post('select_descripcion_cupon', TRUE);
            $fecha_inicio_cupon = $this->input->get_post('select_fecha_inicio_cupon', TRUE);
            $fecha_fin_cupon = $this->input->get_post('select_fecha_fin_cupon', TRUE);

            $this->restaurador_model->editarCupon($clave_cupon, $titulo_cupon, $descripcion_cupon, $fecha_inicio_cupon, $fecha_fin_cupon);

            redirect(base_url('acceso/restaurador/panel-restaurador#cupones'));
        } else {
            redirect(base_url());
        }
    }

    public function borrarCupon() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_cupon = $this->input->get_post('id_cupon', TRUE);
			
            $resultado = $this->restaurador_model->borrarCupon($id_cupon);
			echo $resultado;
			
        } else {
            redirect(base_url());
        }
    }

	// La dejo por si la usa alguien
    public function eliminarCuponRestaurante() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $clave_cupon = $this->input->get_post('clave_cupon', TRUE);
            $this->restaurador_model->eliminarCupon($clave_cupon);
            redirect(base_url('acceso/restaurador/panel-restaurador'));
        } else {
            redirect(base_url());
        }
    }

	/* Gestión de imágenes del panel de control de restaurador */

	public function altaImagenesRestaurante($id_restaurante){

		if($this->session->userdata('ingresado') == TRUE){

       		$this->breadcrumbs->push('Alta de fotografías de restaurante', '/acceso/restaurador/alta-imagenes/' . $id_restaurante);
			
			//$id_restaurante = $this->input->get_post('id_restaurante');

			$datos['datosRestaurante'] = $this->restaurante_model->dameDetalleRestaurante($id_restaurante);
			$datos['imagenesRestaurante'] = $this->restaurante_model->dameListadoImagen($id_restaurante);
			
			/*
			echo "<pre>";
			print_r($datos['imagenesRestaurante']);
			die();
			*/

			$datos['title'] = "Alta restaurante";
			$datos['description'] =  "Registro de restaurantes";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-imagenes";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}

	}
	
	public function listadoImagenesJSON(){
        $id_restaurante = $this->input->get_post('id_restaurante', TRUE);
        echo json_encode($this->restaurador_model->listadoImagenes($id_restaurante));
	}
	
	public function guardarDatosImagenes(){
        $id_imagen = $this->input->get_post('id_imagen', TRUE);
        $titulo = $this->input->get_post('titulo', TRUE);
        $principal = $this->input->get_post('principal', TRUE);
		/*$id_imagen[0] = 24;
		$id_imagen[1] = 25;
		$titulo[0] = 'cero';
		$titulo[1] = 'uno';*/
        echo $this->restaurador_model->guardarDatosImagenes($id_imagen, $titulo, $principal);
	}
	
	public function borrarImagen(){
        $id_imagen = $this->input->get_post('id_imagen', TRUE);
        echo $this->restaurador_model->borrarImagen($id_imagen);
	}
	
	public function asegurarImagenPrincipal(){
        $id_restaurante = $this->input->get_post('id_restaurante', TRUE);
        $this->restaurador_model->asegurarImagenPrincipal($id_restaurante);
	}

    /* GestiÃ³n de MenÃºn */

    public function anadirNuevoMenu() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_restaurante = $this->input->get_post('id_restaurantes', TRUE);
            $nombre_menu = $this->input->get_post('nombre_menu', TRUE);
            $estructura_menu = $this->input->get_post('estructura_menu', TRUE);

            $this->restaurador_model->guardarTipoMenu($id_restaurante, $nombre_menu, $estructura_menu);

            $this->restaurador_model->actualizarRestauranteID($id_restaurante);
        } else {
            redirect(base_url());
        }
    }

    public function eliminarMenu() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_menu = $this->input->get_post('id_menu', TRUE);
            $this->restaurador_model->eliminarMenu($id_menu);
            //redirect(base_url('acceso/restaurador/panel-restaurador#gestiontipos'));
        } else {
            redirect(base_url());
        }
    }

    /* GestiÃ³n Platos del MenÃº */

    public function anadirPlatosTipoMenu() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $id_menu = $this->input->get_post('id_menu');
            $id_restaurantes = $this->input->get_post('id_restaurante', TRUE);

            //Entrantes
            $this->restaurador_model->vaciarEntrantesEnMenu($id_menu);
            $entrantes = $this->input->get_post('entrantes');
            parse_str($entrantes, $entrantes_arr);
            if (is_array($entrantes_arr)) {
                foreach ($entrantes_arr as $entrante) {
                    foreach ($entrante as $plato) {
                        if (!empty($plato)) {
                            $this->restaurador_model->guardarEntrantesMenu($id_menu, $plato);
                        }
                    }
                }
            }
            //Primeros
            $this->restaurador_model->vaciarPrimerosEnMenu($id_menu);
            $primeros = $this->input->get_post('primeros');
            parse_str($primeros, $primeros_arr);
            if (is_array($primeros_arr)) {
                foreach ($primeros_arr as $primero) {
                    foreach ($primero as $plato) {
                        if (!empty($plato)) {
                            $this->restaurador_model->guardarPrimerosMenu($id_menu, $plato);
                        }
                    }
                }
            }

            //Segundos
            $this->restaurador_model->vaciarSegundosEnMenu($id_menu);
            $segundos = $this->input->get_post('segundos');
            parse_str($segundos, $segundos_arr);
            if (is_array($segundos_arr)) {
                foreach ($segundos_arr as $segundo) {
                    foreach ($segundo as $plato) {
                        if (!empty($plato)) {
                            $this->restaurador_model->guardarSegundosMenu($id_menu, $plato);
                        }
                    }
                }
            }

            $calendario = $this->input->get_post('calendario_menu', TRUE);
            $precio = $this->input->get_post('precio_menu', TRUE);
            $postre = $this->input->get_post('postre_menu', TRUE);
            $cafe = $this->input->get_post('cafe_menu', TRUE);
            $pan = $this->input->get_post('pan_menu', TRUE);
            $bebida = $this->input->get_post('bebida_menu', TRUE);
            $observaciones = $this->input->get_post('observaciones', TRUE);
            $guardarMenu = $this->restaurador_model->guardarDatosMenu($id_menu, $postre, $bebida, $pan, $cafe, $calendario, $precio, $observaciones);
            echo "ok: $id_menu";
            //redirect(base_url('acceso/restaurador/panel-restaurador#gestiontipos'));
        } else {
            redirect(base_url());
        }
    }

    public function anadirMenuHabitual() {
        if ($this->session->userdata('ingresado') == TRUE) {
            $id_menu = $this->input->get_post('id_menu');
            $nombre_menu = $this->input->get_post('nombre_menu_habitual');
            $this->restaurador_model->guardarMenuHabitualYCrearSnapShot($id_menu, $nombre_menu);
        } else {
            redirect(base_url());
        }
    }

    public function eliminarMenuHabitual() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $id_menu_habitual = $this->input->get_post('id_menu_habitual', TRUE);
            $this->restaurador_model->eliminarMenuHabitual($id_menu_habitual);

            //redirect(base_url('acceso/restaurador/panel-restaurador#gestionmenus'));
        } else {
            //redirect(base_url());
        }
    }

    public function vistaRegistroRestaurador($pag, $plan) {
        $this->breadcrumbs->push('Registro de restaurador Pag. ' . $pag, '/restaurador/vistaRegistroRestaurador/' . $pag . "/" . $plan);
        $this->output->enable_profiler(TRUE);

        $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
        $datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();

        $datos['title'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
        $datos['description'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        switch ($pag) {
            case 1:
                $datos['contenido'] = "registro-restaurador-pag1";
                $datos['id_plan'] = $plan;
                $datos['id_restaurante'] = $this->input->post('id_restaurante', TRUE);
                $datos['id_gestor'] = $this->input->post('id_gestor', TRUE);
                if ($this->input->post('id_restaurante', TRUE)) {
                    $restaurante = $this->restaurador_model->getRestauranteData($this->input->post('id_restaurante', TRUE));
                    $datos['nombre_restaurante'] = $restaurante->nombre_restaurante;
                    $datos['calle_restaurante'] = $restaurante->direccion_restaurante;
                    $datos['numero_restaurante'] = $restaurante->numero_restaurante;
                    $datos['cp_restaurante'] = $restaurante->cp_restaurante;
                    $datos['municipio_restaurante'] = $restaurante->nombre_localidad;
                    $datos['provincia_restaurante'] = $restaurante->nombre_provincia;
                }

                break;
            case 2:
                //Sacamos los datos del gestor

                if ($this->input->post('id_gestor', TRUE)) {
                    $gestor = $this->restaurador_model->getGestorData($this->input->post('id_gestor', TRUE));
                    //var_dump($gestor);die;
                    $datos['nombre_gestor'] = $gestor[0]->nombre_propietario;
                    $datos['apellidos_gestor'] = $gestor[0]->apellidos_propietario;
                    $datos['email_gestor'] = $gestor[0]->email_propietario;
                    $datos['telefono_gestor'] = $gestor[0]->telefono_propietario;
                    $datos['cp_gestor'] = $gestor[0]->cp_propietario;

                    if ($gestor[0]->localidades_id_localidad) {
                        $datos['municipio_gestor'] = $gestor[0]->localidades_id_localidad;
                        $gestor = $this->restaurador_model->getGestorData($this->input->post('id_gestor', TRUE), $gestor[0]->localidades_id_localidad);
                        $datos['provincia_gestor'] = $gestor[0]->id_provincia;
                    }
                }

                //Guardamos los datos de pÃ¡gina 1 (Restaurante)
                $datos['contenido'] = "registro-restaurador-pag2";
                $referer = explode('/', $_SERVER['HTTP_REFERER']);
                $referer = array_pop($referer);
                if ($referer == 'pag-1') {
                    $nombre_restaurante = $this->input->post('nombre_restaurante', TRUE);
                    $calle_restaurante = $this->input->post('calle_restaurante', TRUE);
                    $numero_restaurante = $this->input->post('numero_restaurante', TRUE);
                    $cp_restaurante = $this->input->post('cp_restaurante', TRUE);
                    $municipio_restaurante = $this->input->post('municipio_restaurante', TRUE);
                    $provincia_restaurante = $this->input->post('provincia_restaurante', TRUE);
                    $latlong_restaurante = $this->input->post('latlong_restaurante', TRUE);
                    $latlong_restaurante = explode(",", preg_replace("/^\(|\)$/", "", $latlong_restaurante));
                    $id_restaurante = $this->restaurador_model->guardarRestaurante($this->input->post('id_restaurante', TRUE), $nombre_restaurante, $calle_restaurante, $numero_restaurante, $cp_restaurante, $municipio_restaurante, $provincia_restaurante, trim($latlong_restaurante[0]), trim($latlong_restaurante[1]), $plan);
                    $datos['id_restaurante'] = $id_restaurante;
                } else {
                    $datos['id_restaurante'] = $this->input->post('id_restaurante', TRUE);
                }
                $datos['id_gestor'] = $this->input->post('id_gestor', TRUE);
                break;
            case 3:
                $nombre_gestor = $this->input->post('nombre_gestor', TRUE);
                $apellidos_gestor = $this->input->post('apellidos_gestor', TRUE);
                $email_gestor = $this->input->post('email_gestor', TRUE);
                $password_gestor = sha1($this->input->post('password_gestor', TRUE));
                $telefono_gestor = $this->input->post('telefono_gestor', TRUE);
                $cp_gestor = $this->input->post('cp_gestor', TRUE);
                $municipio_gestor = $this->input->post('municipio_gestor', TRUE);
                $provincia_gestor = $this->input->post('provincia_gestor', TRUE);
                $clave_gestor = random_string('unique');
                $id_gestor = $this->restaurador_model->guardarGestor($this->input->post('id_gestor', TRUE), $nombre_gestor, $apellidos_gestor, $email_gestor, $password_gestor, $clave_gestor, $telefono_gestor, $cp_gestor, $provincia_gestor, $municipio_gestor);
                $this->restaurador_model->guardarPropietarioRestaurante($this->input->post('id_restaurante', TRUE), $id_gestor);
                //Rellenamos los campos del restaurante
                if ($this->input->post('id_restaurante', TRUE)) {
                    $restaurante = $this->restaurador_model->getRestauranteData($this->input->post('id_restaurante', TRUE));

                    $datos['calle_restaurante'] = $restaurante->direccion_restaurante;
                    $datos['numero_restaurante'] = $restaurante->numero_restaurante;
                    $datos['cp_restaurante'] = $restaurante->cp_restaurante;
                    $datos['provincia_restaurante'] = $restaurante->id_provincia;
                    $datos['municipio_restaurante'] = $restaurante->id_localidad;
                }

                $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
                $datos['id_restaurante'] = $this->input->post('id_restaurante', TRUE);
                $datos['id_gestor'] = $id_gestor;
                $datos['id_plan'] = $plan;
                $datos['contenido'] = "registro-restaurador-pag3";
                break;
            case 4:

                if ($this->input->post('id_gestor', TRUE)) {
                    $gestor = $this->restaurador_model->getGestorData($this->input->post('id_gestor', TRUE));
                    // var_dump($gestor);die;
                    $email = $gestor[0]->email_propietario;
                    $clave = $gestor[0]->clave_propietario;
                    $this->enviarEmailPropietario($email, $clave);
                }

                $razon_social_facturacion = $this->input->post('razon_social_facturacion', TRUE);
                $direccion_facturacion = $this->input->post('direccion_facturacion', TRUE);
                $numero_facturacion = $this->input->post('numero_facturacion', TRUE);
                $cp_facturacion = $this->input->post('cp_facturacion', TRUE);
                $provincia_facturacion = $this->input->post('provincia_facturacion', TRUE);
                $municipio_facturacion = $this->input->post('municipio_facturacion', TRUE);
                $email_facturacion = $this->input->post('email_facturacion', TRUE);
                $plan_restaurante = $this->input->post('plan_restaurante', TRUE);
                $cuenta_facturacion = $this->input->post('cuenta_facturacion', TRUE);
                $this->restaurador_model->guardarDatosFacturacion($this->input->post('id_restaurante', TRUE), $razon_social_facturacion, $direccion_facturacion, $numero_facturacion, $cp_facturacion, $municipio_facturacion, $email_facturacion, $cuenta_facturacion);
                $this->restaurador_model->guardarPlanRestaurante($this->input->post('id_restaurante', TRUE), $plan_restaurante);
                $datos['contenido'] = "registro-restaurador-pag4";

            default:
                break;
        }

        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function guardarRestaurante() {
        $id_restaurante = $this->input->post('id_restaurante', TRUE);
        $nombre_restaurante = $this->input->post('nombre_restaurante', TRUE);
        $calle_restaurante = $this->input->post('calle_restaurante', TRUE);
        $numero_restaurante = $this->input->post('numero_restaurante', TRUE);
        $cp_restaurante = $this->input->post('cp_restaurante', TRUE);
        $municipio_restaurante = $this->input->post('municipio_restaurante', TRUE);
        $provincia_restaurante = $this->input->post('provincia_restaurante', TRUE);
        $latlong_restaurante = $this->input->post('latlong_restaurante', TRUE);
        $plan = $this->input->post('id_plan', TRUE);
        /*
          $id_restaurante = $this->input->get('id_restaurante', TRUE);
          $nombre_restaurante = $this->input->get('nombre_restaurante', TRUE);
          $calle_restaurante = $this->input->get('calle_restaurante', TRUE);
          $numero_restaurante = $this->input->get('numero_restaurante', TRUE);
          $cp_restaurante = $this->input->get('cp_restaurante', TRUE);
          $municipio_restaurante = $this->input->get('municipio_restaurante', TRUE);
          $provincia_restaurante = $this->input->get('provincia_restaurante', TRUE);
          $latlong_restaurante = $this->input->get('latlong_restaurante', TRUE);
          $plan = $this->input->get('id_plan', TRUE);
         */
        //echo "latlong ".$latlong_restaurante;die;
        $latlong_restaurante = explode(",", preg_replace("/^\(|\)$/", "", $latlong_restaurante));
        $id_restaurante = $this->restaurador_model->guardarRestaurante($id_restaurante, $nombre_restaurante, $calle_restaurante, $numero_restaurante, $cp_restaurante, $municipio_restaurante, $provincia_restaurante, trim($latlong_restaurante[0]), trim($latlong_restaurante[1]), $plan);
        echo $id_restaurante;
    }

    public function getMunicipioYProvinciaByCodigoPostal($cp) {
        $this->output->enable_profiler(TRUE);
        $municipioYProvincia = $this->restaurador_model->getMunicipioyProvinciaByCodigoPostal($cp);
        echo "{municipio: " . $municipioYProvincia[0]->nombre_localidad . ",provincia: " . $municipioYProvincia[0]->nombre_provincia . "}";
    }

    public function existeEmailPropietario() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {
            $email = $this->input->post('email');
            $existe = 'no';
            if ($this->restaurador_model->existeEmail($email)) {
                $existe = 'si';
            }
            echo $existe;
        }
    }

    /* Cuando un usuario se registra por primera vez, se le envía un email */

    public function enviarEmailPropietario($email, $clave) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = 'Estimado propietario tienes que confirmar tu cuenta para poder logarte <br /><br />' . base_url() . 'confirmar-registro-propietario/?id=' . $clave;

        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to($email);
        $this->email->subject('Alta de propietario');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    /* Cuando un usuario se registra por primera vez, se le envía un email */

    public function enviarNuevoEmailPropietario($email, $clave) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = 'Estimado propietario tienes que confirmar tu nuevo email para poder usarlo. Hasta entonces, tendrás tu antiguo email para logarte<br /><br />' . base_url() . 'confirmar-nuevo-email/?id=' . $clave;

        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to($email);
        $this->email->subject('Cambio de email');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    public function comprobarRegistro() {
        $datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();

        $clave = $this->input->get_post('id');
        $comprueba = $this->restaurador_model->comprobarRegistroPropietario($clave);

        if ($comprueba) {

            $activarUsuario = $this->restaurador_model->activarPropietario($comprueba->id_propietario);

            /* Realizamos el login del propietario. */
            $email = $comprueba->email_propietario;
            $pass = $comprueba->pass_propietario;


            $compruebaPropietario = $this->restaurador_model->compruebaRestaurador($email, $pass);
            if ($compruebaPropietario) {
                $data = array(
                    'id_propietario' => $compruebaPropietario->id_propietario,
                    'nombre_propietario' => $compruebaPropietario->nombre_propietario,
                    'restaurador' => TRUE,
                    'ingresado' => TRUE
                );
                $this->session->set_userdata($data);
            }
            $datos['title'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
            $datos['description'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
            $datos['robots'] = "NOINDEX, NOFOLLOW";
            $datos['contenido'] = "confirmar-registro-propietario";
            $this->load->view('plantillas/plantilla2', $datos);
        } else {
            redirect(base_url('eres-restaurador'));
        }
    }

    public function confirmarNuevoEmail() {
        //$datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();

        $clave = $this->input->get_post('id');
        $comprueba = $this->restaurador_model->comprobarRegistroPropietario($clave);

        if ($comprueba) {

            $actualizarEmail = $this->restaurador_model->actualizarEmail($comprueba->id_propietario);

            /* Realizamos el login del propietario. */
            $email = $comprueba->nuevo_email_propietario;
            $pass = $comprueba->pass_propietario;


            $compruebaPropietario = $this->restaurador_model->compruebaRestaurador($email, $pass);
            if ($compruebaPropietario) {
                $data = array(
                    'id_propietario' => $compruebaPropietario->id_propietario,
                    'nombre_propietario' => $compruebaPropietario->nombre_propietario,
                    'restaurador' => TRUE,
                    'ingresado' => TRUE
                );
                $this->session->set_userdata($data);
            }
            $datos['title'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
            $datos['description'] = "Todoslosmenus.com - Â¿QuÃ© comerÃ¡s hoy?";
            $datos['robots'] = "NOINDEX, NOFOLLOW";
            $datos['contenido'] = "confirmar-nuevo-email";
            $this->load->view('plantillas/plantilla2', $datos);
        } else {
            redirect(base_url('eres-restaurador'));
        }
    }

    public function buscarRestaurantesPropietariosJSON($nombre_restaurante = null, $id_propietario = null) {

        //$this->output->enable_profiler(TRUE);

        $nombre_restaurante = trim($this->input->get_post('nombre_restaurante', TRUE));
        $id_propietario = $this->input->get_post('id_propietario', TRUE);

        $restaurantes = $this->restaurador_model->buscarRestaurantesPropietarios($nombre_restaurante, $id_propietario);

        $json = "[";
        foreach ($restaurantes as $restaurante) {
            if ($json != "[") {
                $json .= ",";
            }
            $json .= '{"nombre_restaurante":"' . $restaurante->nombre_restaurante . '",';
            $json .= '"municipio":"' . $restaurante->nombre_localidad . '",';
            $json .= '"categoria":"' . $restaurante->nombre_categoria . '",';
            $json .= '"precio_medio":"' . $restaurante->precio_medio_restaurante . '",';
            $json .= '"id_restaurante":"' . $restaurante->id_restaurante . '",';
            $json .= '"logo":"' . base_url() . '"}';
        }
        $json .="]";
        echo $json;
    }

    public function obtenerTipoMenusJSON($id_restaurante = null) {

        //$this->output->enable_profiler(TRUE);

        $id_restaurante = $this->input->get_post('id_restaurante', TRUE);

        $menus = $this->restaurador_model->obtenerTipoMenus($id_restaurante);

        $json = "[";
        foreach ($menus as $menu) {
            if ($json != "[") {
                $json .= ",";
            }
            $json .= '{"nombre_menu":"' . $menu->nombre_menu . '",';
            $json .= '"id_menu":"' . $menu->id_menu . '"}';
        }
        $json .="]";
        echo $json;
    }

    public function obtenerMenusCompletosJSON($id_restaurante = null) {

        //$this->output->enable_profiler(TRUE);

        $id_restaurante = $this->input->get_post('id_restaurante', TRUE);

        $menus = $this->restaurador_model->obtenerTipoMenus($id_restaurante);
        $array_final = array();
        $array_menu = array();
        foreach ($menus as $menu) {
            $array_menu['id_menu'] = $menu->id_menu;
            $array_menu['fecha_dia_menu'] = $menu->fecha_dia_menu;
            $array_menu['precio_menu'] = $menu->precio_menu;
            $array_menu['nombre_menu'] = $menu->nombre_menu;
            $array_menu['tipo_menu_id_tipo_menu'] = $menu->tipo_menu_id_tipo_menu;
            $array_menu['postre_menu'] = $menu->postre_menu;
            $array_menu['bebida_menu'] = $menu->bebida_menu;
            $array_menu['pan_menu'] = $menu->pan_menu;
            $array_menu['cafe_menu'] = $menu->pan_menu;
            $array_menu['observaciones_menu'] = $menu->observaciones_menu;


            $menusHabituales = $this->restaurador_model->listadoMenusHabituales($menu->id_menu);
            $array_menus_habituales = array();
            $habituales = array();
            if ($menusHabituales) {
                foreach ($menusHabituales as $menuHabitual) {
                    $habituales['id_menu_habitual'] = $menuHabitual->id_menu_habitual;
                    $habituales['nombre_menu_habitual'] = $menuHabitual->nombre_menu_habitual;
                    array_push($array_menus_habituales, $habituales);
                }
            }
            $array_menu['menus_habituales'] = $array_menus_habituales;

            $entrantesMenu = $this->buscador_model->buscador_entrantes($menu->id_menu);
            $array_entrantes = array();
            $entrantes = array();
            if ($entrantesMenu) {
                foreach ($entrantesMenu as $entrante) {
                    $entrantes['id_entrante_menu'] = $entrante->id_entrante_menu;
                    $entrantes['nombre_entrante_menu'] = $entrante->nombre_entrante_menu;
                    array_push($array_entrantes, $entrantes);
                }
            }
            $array_menu['entrantes'] = $array_entrantes;

            $primerosMenu = $this->buscador_model->buscador_primeros($menu->id_menu);
            $array_primeros = array();
            $primeros = array();
            if ($primerosMenu) {
                foreach ($primerosMenu as $primero) {
                    $primeros['id_primero_menu'] = $primero->id_primero_menu;
                    $primeros['nombre_primeros_menu'] = $primero->nombre_primeros_menu;
                    array_push($array_primeros, $primeros);
                }
            }
            $array_menu['primeros'] = $array_primeros;


            $segundosMenu = $this->buscador_model->buscador_segundos($menu->id_menu);
            $array_segundos = array();
            $segundos = array();
            if ($segundosMenu) {
                foreach ($segundosMenu as $segundo) {
                    $segundos['id_segundo_menu'] = $segundo->id_segundo_menu;
                    $segundos['nombre_segundo_menu'] = $segundo->nombre_segundo_menu;
                    array_push($array_segundos, $segundos);
                }
            }
            $array_menu['segundos'] = $array_segundos;

            array_push($array_final, $array_menu);
        }

        echo json_encode($array_final);
    }

    public function obtenerMenusHabitualesJSON($id_menu = null) {
        echo json_encode($this->restaurador_model->listadoMenusHabituales($this->input->get_post('id_menu', TRUE)));
    }

    public function selecctionarMenuHabitualJSON($id_menu_habitual = null) {
        //$this->output->enable_profiler(TRUE);
        $menu_habitual_row = $this->restaurador_model->seleccionarMenuHabitual($this->input->get_post('id_menu_habitual', TRUE));
        $menu_habitual["entrantes_menu"] = $menu_habitual_row->entrantes_menu;
        $menu_habitual["postre_menu"] = $menu_habitual_row->postre_menu;
        $menu_habitual["bebida_menu"] = $menu_habitual_row->bebida_menu;
        $menu_habitual["pan_menu"] = $menu_habitual_row->pan_menu;
        $menu_habitual["cafe_menu"] = $menu_habitual_row->cafe_menu;
        $menu_habitual["observaciones_menu"] = $menu_habitual_row->observaciones_menu;
        $menu_habitual["fecha_dia_menu"] = $menu_habitual_row->fecha_dia_menu;
        $menu_habitual["precio_menu"] = $menu_habitual_row->precio_menu;
        $menu_habitual["tipo_id_tipo_menu"] = $menu_habitual_row->tipo_menu_id_tipo_menu;

        $entrantesMenu = $this->buscador_model->buscador_entrantes($menu_habitual_row->id_menu);
        $array_entrantes = array();
        $entrantes = array();
        if ($entrantesMenu) {
            foreach ($entrantesMenu as $entrante) {
                $entrantes['id_entrante_menu'] = $entrante->id_entrante_menu;
                $entrantes['nombre_entrante_menu'] = $entrante->nombre_entrante_menu;
                array_push($array_entrantes, $entrantes);
            }
        }
        $menu_habitual['entrantes'] = $array_entrantes;

        $primerosMenu = $this->buscador_model->buscador_primeros($menu_habitual_row->id_menu);
        $array_primeros = array();
        $primeros = array();
        if ($primerosMenu) {
            foreach ($primerosMenu as $primero) {
                $primeros['id_primero_menu'] = $primero->id_primero_menu;
                $primeros['nombre_primeros_menu'] = $primero->nombre_primeros_menu;
                array_push($array_primeros, $primeros);
            }
        }
        $menu_habitual['primeros'] = $array_primeros;


        $segundosMenu = $this->buscador_model->buscador_segundos($menu_habitual_row->id_menu);
        $array_segundos = array();
        $segundos = array();
        if ($segundosMenu) {
            foreach ($segundosMenu as $segundo) {
                $segundos['id_segundo_menu'] = $segundo->id_segundo_menu;
                $segundos['nombre_segundo_menu'] = $segundo->nombre_segundo_menu;
                array_push($array_segundos, $segundos);
            }
        }
        $menu_habitual['segundos'] = $array_segundos;

        echo json_encode($menu_habitual);
    }

    public function editarDatosPropietario() {
        $id_propietario = $this->session->userdata('id_propietario');
        $campo = $this->input->get_post('campo');
        $contenido = $this->input->get_post('contenido');
        if ($campo == 'pass_propietario') {
            $contenido = sha1($contenido);
        }
        if ($campo == 'nuevo_email_propietario') {
            //$propietario = $this->restaurador_model->getGestorData($id_propietario);
            $nueva_clave = random_string('unique');
            $this->restaurador_model->actualizarClave($id_propietario, $nueva_clave);
            $this->enviarNuevoEmailPropietario($contenido, $nueva_clave);
        }
        $afftectedRows = $this->restaurador_model->editarDatosPropietario($id_propietario, $campo, $contenido);
        echo $afftectedRows;
    }

    public function editarRestaurante() {
        $id_restaurante = $this->input->get_post('id_restaurante');
        $campo = $this->input->get_post('campo');
        $contenido = $this->input->get_post('contenido');
        if ($campo == 'lat_long_restaurante') {
            $contenido = str_replace("(", "", $contenido);
            $contenido = str_replace(")", "", $contenido);
            $LatLong = explode(",", $contenido);
            var_dump($id_restaurante,'lat_restaurante',trim($LatLong[0]),trim($LatLong[1]));
            $this->restaurador_model->editarRestaurante($id_restaurante, 'lat_restaurante', trim($LatLong[0]));
            $this->restaurador_model->editarRestaurante($id_restaurante, 'long_restaurante', trim($LatLong[1]));
        } else {
            $afftectedRows = $this->restaurador_model->editarRestaurante($id_restaurante, $campo, $contenido);
        }
        echo $afftectedRows;
    }

    public function obtenerEspecialidadesJSON($id_restaurante = null) {
        echo json_encode($this->restaurador_model->listadoEspecialidadesRestaurante($this->input->get_post('id_restaurante', TRUE)));
    }

    /* Mensaje del usuario a Soporte Técnico - Panel de control de usuario */
	
    public function mensajeSoporteTecnico() {
        $id_restaurador = $this->session->userdata('id_propietario');
        $datos = $this->restaurador_model->datosRestaurador($id_restaurador);
        $texto_mensaje_soporte = $this->input->post('texto_mensaje_soporte', TRUE);
		
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $mensaje = 'El Restaurador <b>' . $datos->nombre_propietario . ' ' . $datos->apellidos_propietario . '</b> a enviado el siguiente mensaje a soporte técnico:<br /><br />' . $texto_mensaje_soporte;
        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to('pespinosa72@gmail.com');
        //$this->email->to('sergio@serynoser.com');
        $this->email->subject('Mensaje de Restaurador a Soporte Técnico');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        if($this->email->send()){
			echo "Mensaje enviado correctamente, muchas gracias.";
		}else{
			echo "No pudimos enviar el e-mail de confirmación, por favor vuelva a intentarlo.";
		}
    }

    /*     * ***************** */
    
    
}
