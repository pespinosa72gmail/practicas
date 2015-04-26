<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Valoraciones extends MY_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('valoraciones_model');
		$this->load->model('restaurante_model');
	}

	public function index($slug_restaurante) {
		
		$slug_limpio = $this->security->xss_clean($slug_restaurante);
		
		$comprobacion = $this->restaurante_model->detalle_restaurante($slug_limpio);
		
		// NO FUNCIONAN NINGUNO DE ESTAS 2 MIGAS SEGÚN ENTENDÍ QUE TENÍA QUE HACERSE
		//$this->breadcrumbs->push('Valoración', 'restaurante/' . $slug_limpio . '/valoracion');
		$this->breadcrumbs->push('Valoración', '/valoraciones/index/' . $slug_limpio);

		$datos['detalle'] = $comprobacion;
		
		
		$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
		$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
		$datos['robots'] = "NOINDEX, NOFOLLOW";
		$datos['contenido'] = "vista-valoracion";
		$this->load->view ('plantillas/plantilla2', $datos);
		
	}




	public function valorar() {
        $id_usuario = $this->session->userdata('id_usuario');
		$id_restaurante = $this->input->get_post('id_restaurante');
		
		$val_global = $this->input->get_post('valoracion_global');
		$val_servicio = $this->input->get_post('valoracion_servicio');
		$val_comida = $this->input->get_post('valoracion_comida');
		$val_calidad_precio = $this->input->get_post('valoracion_calidad_precio');

		$afftectedRows = $this->valoraciones_model->guardar_puntuacion($id_usuario, $id_restaurante, $val_global, $val_servicio, $val_comida, $val_calidad_precio);
		
		echo $afftectedRows;
	}



}

