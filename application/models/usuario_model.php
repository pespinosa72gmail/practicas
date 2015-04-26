<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login_user($email, $pass) {
        $this->db->where('email_usuario', $email);
        $this->db->where('pass_usuario', $pass);
        $this->db->where('activo_usuario', 1);
        $consulta = $this->db->get('usuarios');
        return $consulta->row();
    }

    /* Datos del usuario para el panel del usuario. */

    public function datoDatoUsario($id_usuario) {
        $this->db->where('id_usuario', $id_usuario);
        $consulta = $this->db->get('usuarios');
        return $consulta->row();
    }

    //Comprobamos si ya existe el email
    public function existeEmail($email) {
        $this->db->where('email_usuario', $email);
        $this->db->where('activo_usuario', 1);
        $consulta = $this->db->get('usuarios');
        return ($consulta->row());
    }

    /* Registramos al usuario. */

    //Insert de usuario
    public function registroUsuario($nombre, $apellidos, $cp, $email, $password, $clave, $fecha_nacimiento, $tlm, $email_adicional, $dia_adicional, $mes_adicional, $ano_adicional, $sexo, $porque_tlm_a, $porque_tlm_b) {
        $data = array(
            'clave_usuario' => $clave,
            'nombre_usuario' => $nombre,
            'apellidos_usuario' => $apellidos,
            'email_usuario' => $email,
            'pass_usuario' => $password,
            'cp_usuario' => $cp,
            'activo_usuario' => 0,
            'fecha_nacimiento_usuario' => $fecha_nacimiento,
            'fecha_alta_usuario' => now(),
            'tlm_usuario' => $tlm,
            'email_usuario_tlm' => $email_adicional,
            'dia_usuario_tlm' => $dia_adicional,
            'mes_usuario_tlm' => $mes_adicional,
            'ano_usuario_tlm' => $ano_adicional,
            'sexo_usuario_tlm' => $sexo,
            'resp_ocio_usuario_tlm' => $porque_tlm_a,
            'resp_trabajo_usuario_tlm' => $porque_tlm_b,
        );
        $this->db->insert('usuarios', $data);
    }

    public function activarUsuario($id_usuario) {
        $data = array(
            'activo_usuario' => 1,
        );
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', $data);
    }

    public function comprobarRegistroUsuario($clave) {
        $this->db->where('clave_usuario', $clave);
        $consulta = $this->db->get('usuarios');
        return $consulta->row();
    }

    /* funcion anterior
	public function editarDatosUsuario($id_usuario, $nombre, $apellidos, $email, $localidad, $cp) {
        $data = array(
            'nombre_usuario' => $nombre,
            'apellidos_usuario' => $apellidos,
            'email_usuario' => $email,
            'cp_usuario' => $cp,
        );
        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuarios', $data);
    }*/
	
	public function editarDatosUsuario($id_usuario, $campo, $contenido) {
        $data = array(
            $campo => $contenido
        );
        $this->db->where('id_usuario', $id_usuario);
        $afftectedRows = $this->db->update('usuarios', $data);
		return $afftectedRows;
    }
	
	public function modificarCorreo($id_usuario, $email) {
        $data = array(
            'email_usuario' => $email,
            'activo_usuario' => 0
        );
        $this->db->where('id_usuario', $id_usuario);
        $afftectedRows = $this->db->update('usuarios', $data);
		return $afftectedRows;
    }

    /*     * ******************************************** */






    /* Relación de platos Favoritos */

    public function dameEspecialidades($id_usuario) {
        $this->db->join('usuarios', 'usuarios.id_usuario = platos_favoritos.usuarios_id_usuario');

        $this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->get('platos_favoritos');
        return $consulta->result();
    }

    public function dameNumPlatoFavoritos($id_usuario) {
        $this->db->join('usuarios', 'usuarios.id_usuario = platos_favoritos.usuarios_id_usuario');
        $this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->count_all_results('platos_favoritos');
        return $consulta;
    }

    public function anadirPlatoFavorito($id_usuario, $nombre_plato) {
        $data = array(
            'nombre_plato_favorito' => $nombre_plato,
            'usuarios_id_usuario' => $id_usuario,
        );
        $this->db->insert('platos_favoritos', $data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
    }

    public function eliminarPlatoFavorito($id_usuario, $id_plato) {
        $this->db->where('usuarios_id_usuario', $id_usuario);
        $this->db->where('id_plato_favorito', $id_plato);
        $afftectedRows = $this->db->delete('platos_favoritos');
		return $afftectedRows;
    }

    /*     * ****************************** */






    /* Datos de los restaurantes favoritos del usuario */

    public function restaurantesFavoritos($id_usuario) {
        $this->db->join('restaurantes', 'restaurantes.id_restaurante = rest_favoritos.restaurantes_id_restaurante');
        $this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->get('rest_favoritos');
        return $consulta->result();
    }

    /*public function dameNumRestaurantesFavoritos($id_usuario) {
        $this->db->join('restaurantes', 'restaurantes.id_restaurante = rest_favoritos.restaurantes_id_restaurante');
        $this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->count_all_results('rest_favoritos');
        return $consulta;
    }*/

    public function buscarRestauranteFavorito($nombre_restaurante) {
		$this->db->limit(5);
        $this->db->join('localidades', 'restaurantes.localidades_id_localidad = localidades.id_localidad');
        $this->db->like('nombre_restaurante', $nombre_restaurante, 'both');
        $this->db->where('activo_restaurante', 1);
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    public function addRestauranteFavorito($id_usuario, $id_restaurante) {
        $data = array(
            'usuarios_id_usuario' => $id_usuario,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $afftectedRows = $this->db->insert('rest_favoritos', $data);
		return $afftectedRows;
    }

    public function borrarRestauranteFavorito($id_usuario, $id_rest_fav) {
        $this->db->where('id_rest_favorito', $id_rest_fav);
        $this->db->where('usuarios_id_usuario', $id_usuario);
        $afftectedRows = $this->db->delete('rest_favoritos');
		return $afftectedRows;
    }

    /*     * ************************************************ */



    /* Datos de los CP favoritos del usuario */

    public function cpFavoritos($id_usuario) {
        $this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->get('cp_favoritos');
        return $consulta->result();
    }

    public function addCpFavorito($id_usuario, $nuevo_cp) {
        $data = array(
            'nombre_cp_favorito' => $nuevo_cp,
            'usuarios_id_usuario' => $id_usuario,
        );
        $this->db->insert('cp_favoritos', $data);
		$afftectedRows = $this->db->affected_rows();
		return $afftectedRows;
    }

    public function deleteCpFavorito($id_usuario, $id_cp) {
        $this->db->where('usuarios_id_usuario', $id_usuario);
        $this->db->where('id_cp_favorito', $id_cp);
        $afftectedRows = $this->db->delete('cp_favoritos');
		return $afftectedRows;
    }

    /*     * ************************************************ */





    /*     * ************************************************ */
    /*     * * Usuario - TLM ** */

    public function editarDatosTLMUsuario($id_usuario, $email_adicional, $dia_cumpleanos_usuario, $mes_cumpleanos_usuario, $ano_cumpleanos_usuario, $sexo, $respuesta_a, $respuesta_b) {

        $data = array(
            'tlm_usuario' => 1,
            'email_usuario_tlm' => $email_adicional,
            'dia_usuario_tlm' => $dia_cumpleanos_usuario,
            'mes_usuario_tlm' => $mes_cumpleanos_usuario,
            'ano_usuario_tlm' => $ano_cumpleanos_usuario,
            'sexo_usuario_tlm' => $sexo,
            'resp_ocio_usuario_tlm' => $respuesta_a,
            'resp_trabajo_usuario_tlm' => $respuesta_b,
        );
        $this->db->where('id_usuario', $id_usuario);
        $afftectedRows = $this->db->update('usuarios', $data);
		return $afftectedRows;
    }

    public function dameDatosUsuarioTLM($id_usuario) {
        $this->db->where('id_usuario', $id_usuario);
        $consulta = $this->db->get('usuarios');
        return $consulta->row();
    }

    /*     * ************************************************ */

    //Recuperamos el password para mandarlo por correo
    public function recordarPassword($email, $password) {

        $this->db->where(array('email_usuario' => $email, 'activo_usuario' => 1));
        $query = $this->db->get('usuarios');

        $result = $query->result_array();
        $id_usuario = false;
        if ($result) {
            $id_usuario = $result[0]['id_usuario'];

            $data = array(
                'pass_usuario' => sha1($password),
            );
            $this->db->where('email_usuario', $email);
            $this->db->where('activo_usuario', 1);
            $this->db->update('usuarios', $data);
        }
        return $id_usuario;
    }

}
