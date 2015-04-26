<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('footer_model');

		$this->breadcrumbs->push('Home', '/');
	}

	public function error404(){
		$this->breadcrumbs->push('Error 404 - Página no encontrada', '/error/error404');
		$datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();

		$datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
		$datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
		$datos['robots'] = "NOINDEX, NOFOLLOW";
		$datos['contenido'] = "error-404";
		$this->load->view ('plantillas/plantilla2', $datos);
	}

}

