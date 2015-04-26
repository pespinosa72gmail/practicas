<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Footer_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function obtenerUltimosRestaurantes(){
		$this->db->limit(2);
		$this->db->where('activo_restaurante', 1);
		$this->db->order_by('id_restaurante', 'DESC');
		$consultas = $this->db->get('restaurantes');
		return $consultas->result();
	}

}
