<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favoritos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('favoritos_model');
    }

    /* Solo se puede añadir un restaurante si estás registrado/logado en la web, sino te mando a la págoina de registro. */

    public function anadirRestFavorito() {
		$id_usuario = $this->session->userdata('id_usuario', TRUE);
		$id_rest = $this->input->get_post('idrestaurante', TRUE);

		$afftectedRows = $this->favoritos_model->anadirRestFavorito($id_usuario, $id_rest);
        echo $afftectedRows;
    }

    public function eliminarRestFavorito() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $id_usuario = $this->session->userdata('id_usuario', TRUE);
            $id_rest = $this->input->get_post('restaurante', TRUE);

            $this->favoritos_model->eliminarRestFavorito($id_usuario, $id_rest);

            redirect(base_url());
        } else {
            redirect(base_url());
        }
    }

    public function avisoMarcarFavorito() {
        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "aviso-marcar-favorito.php";
        $this->load->view('plantillas/plantilla2', $datos);        
    }
}
