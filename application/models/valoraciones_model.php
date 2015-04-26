<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Valoraciones_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}



	/**********************************************************/
	/* Valoración de un restaurante - Primero compruebo si el restaurante ya ha sido anteriormente valorado */
	public function guardar_puntuacion($id_usuario, $id_restaurante, $val_global, $val_servicio, $val_comida, $val_calidad_precio){
		$data = array(
			'usuarios_id_usuario' => $id_usuario,
			'restaurantes_id_restaurante' => $id_restaurante,
			'global_valoracion' => $val_global,
			'servicio_valoracion' => $val_servicio,
			'comida_valoracion' => $val_comida,
			'calidad_valoracion' => $val_calidad_precio,
			'fecha_valoracion' => date("Y-m-d H:i:s"),
		);
		$this->db->insert('valoracion', $data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
	}


	public function obtenerNumerValoraciones($id_restaurante){
		$this->db->where('restaurantes_id_restaurante', $id_restaurante);
		$consulta = $this->db->count_all_results('valoracion');
		return $consulta;
	}
	

	public function obtenerValoracionRestaurante($id_restaurante){
		$this->db->where('restaurantes_id_restaurante', $id_restaurante);

		$this->db->select_avg('global_valoracion');
		$this->db->select_avg('servicio_valoracion');
		$this->db->select_avg('comida_valoracion');
		$this->db->select_avg('calidad_valoracion');
		$consulta = $this->db->get('valoracion');
		return $consulta->row();
	}


	public function mediaValoracionRestaurante($id_restaurante){
		$this->db->where('restaurantes_id_restaurante', $id_restaurante);

		$this->db->select_avg('global_valoracion');
		$consulta = $this->db->get('valoracion');
		return $consulta->row();
	}


	public function valoracionesUsuarios($id_restaurante){
		$this->db->join('usuarios', 'usuarios.id_usuario = valoracion.usuarios_id_usuario');
		$this->db->where('restaurantes_id_restaurante', $id_restaurante);
		$consulta = $this->db->get('valoracion');
		return $consulta->result();
	}




}
