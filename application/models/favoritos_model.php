<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Favoritos_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}



	public function anadirRestFavorito($id_usuario, $id_rest) {
		$data = array(
			'usuarios_id_usuario' => $id_usuario,
			'restaurantes_id_restaurante' => $id_rest,
		);
		$this->db->insert('rest_favoritos', $data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
	}


	public function eliminarRestFavorito($id_usuario, $id_rest){
		$data = array(
			'usuarios_id_usuario' => $id_usuario,
			'restaurantes_id_restaurante' => $id_rest,
		);
		$this->db->delete('rest_favoritos', $data);
	}
	

}
