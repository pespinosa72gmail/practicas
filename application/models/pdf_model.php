<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Pdf_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}


	public function comprueba_pdf($clave_cupon, $id_restaurante){
		$this->db->join('restaurantes', 'restaurantes.id_restaurante = cupones.restaurantes_id_restaurante');
		$this->db->where('clave_cupon', $clave_cupon);
		$this->db->where('restaurantes_id_restaurante', $id_restaurante);
		$consulta = $this->db->get('cupones');
		return $consulta->row();
	}

	public function obtenerCp($cp){
		$this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
		$this->db->where('cp_localidad', $cp);
		$consulta = $this->db->get('localidades');
		return $consulta->row();
	}


}
