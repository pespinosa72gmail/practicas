<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Franquiciado_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* Método genérico - Actualizar propietario */

    public function actualizarPropietario($id_propietario) {
        $data = array(
            'actualizado_propietario' => now(),
        );
        $this->db->where('id_propietario', $id_propietario);
        $this->db->update('propietarios', $data);
    }

    //Comprobamos si ya existe el email
    public function existeEmail($email) {
        $this->db->where('email_franquiciado', $email);
        $consulta = $this->db->get('franquiciados');
        return ($consulta->row());
    }

    public function listadoCategorias() {
        $consulta = $this->db->get('categorias');
        return $consulta->result();
    }

    public function listadoEstaciones() {
        $consulta = $this->db->get('estaciones');
        return $consulta->result();
    }

    /* Para el Login */

    public function compruebaFranquiciado($email, $password) {
        $this->db->where('email_franquiciado', $email);
        $this->db->where('password_franquiciado', $password);
        $consulta = $this->db->get('franquiciados');
        return $consulta->row();
    }

    public function dameDatosFranquiciado($id_franquiciado) {
        $this->db->where('id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('franquiciados');
        return $consulta->row();
    }

    public function listadoCpAsignados($id_franquiciado) {
        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('rel_franquiciados_cp');
        return $consulta->result();
    }

    /* Eliminamos el CP asociado al Franquiciado */

    public function eliminarCpFranquiciado($cp_franquiciado) {
        $this->db->where('id_rel_franquiciado_cp', $cp_franquiciado);
        $this->db->delete('rel_franquiciados_cp');
    }

    /* Función original y que la dejo de momento por si acaso la utiliza la web en otro lado
	public function editarDatosFranquiciado($id_franquiciado, $nombre, $apellidos, $cif, $email, $telefono, $cp) {
        $data = array(
            'nombre_franquiciado' => $nombre,
            'apellidos_franquiciado' => $apellidos,
            'cif_franquiciado' => $cif,
            'email_franquiciado' => $email,
            'telefono_franquiciado' => $telefono,
            'cp_franquiciado' => $cp,
        );
        $this->db->where('id_franquicia', $id_franquiciado);
        $this->db->update('franquiciados', $data);
    }*/
    public function editarDatosFranquiciado($id_franquiciado, $campo, $contenido) {		
        $data = array(
            $campo => $contenido
        );
        $this->db->where('id_franquicia', $id_franquiciado);
        $afftectedRows = $this->db->update('franquiciados', $data);
		return $afftectedRows;
    }

    public function editarPasswordFranquiciado($id_franquiciado, $clave) {
        $data = array(
            'password_franquiciado' => $clave,
        );
        $this->db->where('id_franquicia', $id_franquiciado);
        $this->db->update('franquiciados', $data);
    }

    public function obtenerCpFranquiciado($cp) {
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->where('cp_localidad', $cp);
        $consulta = $this->db->get('localidades');
        return $consulta->row();
    }
	
	
	/******************************************************************************************/
	/****************** PANEL DE GESTION DE PROPIETARIOS DE FRANQUICIADO **********************/
	/******************************************************************************************/

    public function seleccionPropietario($id_franquiciado, $id_propietario) {
        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
		if($id_propietario){
        	$this->db->where('id_propietario', $id_propietario);
		}
        $this->db->where('activo_propietario', 1);
        $this->db->order_by('actualizado_propietario', 'desc');
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }

    public function buscadorPropietariosFranquiciado($consulta, $id_franquiciado) {
		/* Con left salen aunque no tengan restaurante
        $this->db->join('restaurantes', 'restaurantes.propietarios_id_propietario = propietarios.id_propietario', 'left');*/
        $this->db->join('restaurantes', 'restaurantes.propietarios_id_propietario = propietarios.id_propietario', 'left');
        $this->db->like('nombre_propietario', $consulta, 'both');

        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $this->db->where('activo_propietario', 1);
        //$this->db->group_by('propietarios.id_propietario');
        $this->db->order_by('actualizado_propietario', 'desc');
        $consulta = $this->db->get('propietarios');
        return $consulta->result();
    }
	/* Función anterior que dejo por si la usa otra parte de la web
    public function buscadorPropietariosFranquiciado($consulta) {
        $this->db->like('nombre_propietario', $consulta, 'after');
        $this->db->or_like('nombre_propietario', $consulta, 'before');
        $this->db->or_like('nombre_propietario', $consulta, 'both');

        $consulta = $this->db->get('propietarios');
        return $consulta->result();
    }*/
	
	public function editarDatosPropietarioFranquiciado($id_propietario_seleccionado, $campo, $contenido) {
        $data = array(
            $campo => $contenido,
			'actualizado_propietario' => now()
        );
        $this->db->where('id_propietario', $id_propietario_seleccionado);
        $afftectedRows = $this->db->update('propietarios', $data);
		return $afftectedRows;
    }
	
	public function dameListadoPropietarios($id_franquiciado) {
        //$this->db->join('restaurantes', 'restaurantes.propietarios_id_propietario = propietarios.id_propietario');
        $this->db->order_by('actualizado_propietario', 'desc');
        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('propietarios');
        return $consulta->result();
    }

	/* Función anterior que dejo por si la usa otra parte de la web
    public function dameUltimoPropietarioActualizado($id_franquiciado) {
        $this->db->order_by('actualizado_propietario', 'desc');
        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }*/

	/* Función anterior que dejo por si la usa otra parte de la web
    public function dameUltimoPropietarioActualizadoUrl($id_propietario, $id_franquiciado) {
        $this->db->order_by('actualizado_propietario', 'desc');
        $this->db->where('id_propietario', $id_propietario);
        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }*/

	/* Funciones anteriores que dejo por si la usa otra parte de la web
    public function editarDatosPropietarioFranquiciado($id_propietario, $nombre, $apellidos, $email, $telefono, $cp) {
        $data = array(
            'nombre_propietario' => $nombre,
            'apellidos_propietario' => $apellidos,
            'email_propietario' => $email,
            'telefono_propietario' => $telefono,
            'cp_propietario' => $cp,
        );
        $this->db->where('id_propietario', $id_propietario);
        $this->db->update('propietarios', $data);
    }

    public function editarPasswordPropietarioFranquiciado($id_propietario, $password) {
        $data = array(
            'pass_propietario' => $password,
        );
        $this->db->where('id_propietario', $id_propietario);
        $this->db->update('propietarios', $data);
    }*/

    /*     * ***************************************************************************************************** */
    /*     * ***************************************************************************************************** */

    public function altaPropietariosFranquiciado($nombre, $apellidos, $email, $password, $telefono, $cp, $provincia, $localidad, $id_franquiciado, $clave) {
        $data = array(
            'clave_propietario' => $clave,
            'nombre_propietario' => $nombre,
            'apellidos_propietario' => $apellidos,
            'email_propietario' => $email,
            'pass_propietario' => $password,
            'telefono_propietario' => $telefono,
            'cp_propietario' => $cp,
            'provincias_id_provincia' => $provincia,
            'localidades_id_localidad' => $localidad,
            'actualizado_propietario' => now(),
            'franquiciados_id_franquicia' => $id_franquiciado,
            'activo_propietario' => 1,
        );
        $this->db->insert('propietarios', $data);
    }

    public function dameClavePropietario($clave) {
        $this->db->where('clave_propietario', $clave);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }

    public function altaRestaurantes($clave_restaurante, $nombre_restaurante, $tipo_establecimiento, $direccion_restaurante, $numero_restaurante, $lat_restaurante, $long_restaurante, $barrio_restaurante, $web_restaurante, $email_restaurante, $cp_restaurante, $precio_medio_restaurante, $activo_restaurante, $reservas_restaurante, $parking_restaurante, $tarjetas_restaurante, $visible_restaurante, $localidad, $plan, $id_propietario) {
		
		// Sacar el id de la localidad/municipio de la tabla localidades
		$localidades_id_localidad = 1;
        $this->db->where('cp_localidad', $cp_restaurante);
        $this->db->where('nombre_localidad', $localidad);
		$this->db->limit(1);
        $consulta = $this->db->get('localidades');
		if ($consulta->num_rows() > 0){
			$resultado = $consulta->row();
			$localidades_id_localidad = $resultado->id_localidad;
		}
		
		$id_codigo_postal = 1;
        $this->db->where('num_codigo_postal', $cp_restaurante);
		$this->db->limit(1);
        $consulta = $this->db->get('codigo_postal');
		if ($consulta->num_rows() > 0){
			$resultado = $consulta->row();
			$id_codigo_postal = $resultado->id_codigo_postal;
		}

        $data = array(
            'clave_restaurante' => $clave_restaurante,
            'slug_restaurante' => url_title(strtolower(convert_accented_characters($nombre_restaurante))),
            'metakeywords_restaurante' => $nombre_restaurante,
            'tipo_restaurante' => $tipo_establecimiento,
            'nombre_restaurante' => $nombre_restaurante,
            //'logo_restaurante' => '',
            //'descripcion_restaurante' => '',
            'direccion_restaurante' => $direccion_restaurante,
            'numero_restaurante' => $numero_restaurante,
            'lat_restaurante' => $lat_restaurante,
            'long_restaurante' => $long_restaurante,
            'barrio_restaurante' => $barrio_restaurante,
            //'telefono_restaurante' => '',
            'web_restaurante' => $web_restaurante,
            'email_restaurante' => $email_restaurante,
            'cp_restaurante' => $cp_restaurante,
            //'otros_datos_restaurante' => '',
			'precio_medio_restaurante' => $precio_medio_restaurante,
			//'carta_restaurante' => '',
			//'precio_carta_restaurante' => '',
			//'horario_apertura_restaurante' => '',
			//'horario_cierre_restaurante' => '',
			'activo_restaurante' => $activo_restaurante,
		    'reservas_restaurante' => $reservas_restaurante,
            'parking_restaurante' => $parking_restaurante,
            'tarjetas_restaurante' => $tarjetas_restaurante,
            'visible_restaurante' => $visible_restaurante,
			'creado_restaurante' => now(),
			'actualizado_restaurante' => now(),
            'categorias_id_categoria' => -1,
            'localidades_id_localidad' => $localidades_id_localidad,
            'codigo_postal_id_codigo_postal' => $id_codigo_postal,
            'planes_id_plan' => $plan,
            'propietarios_id_propietario' => $id_propietario,
        );
		
        $this->db->insert('restaurantes', $data);
		return $this->db->affected_rows();
    }

    public function activarRestaurante($id_restaurante) {
        $data = array(
            'activo_restaurante' => 1
        );
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
    }

    public function dameDatosRestaurante($clave) {
        $this->db->where('clave_restaurante', $clave);
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    public function listadoTodosRestaurantes($id_franquiciado) {
        $this->db->join('propietarios', 'propietarios.id_propietario = restaurantes.propietarios_id_propietario');
        $this->db->join('franquiciados', 'franquiciados.id_franquicia = propietarios.franquiciados_id_franquicia');
        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    public function altaFacturacionPropietariosFranquiciado($id_restaurante, $razon_social, $cif, $direccion, $numero, $cp, $municipio, $email, $cuenta) {
        $clave = random_string('unique');
        $data = array(
            'clave_facturacion' => $clave,
            'restaurantes_id_restaurante' => $id_restaurante,
            'razon_social_facturacion' => $razon_social,
            'cif_facturacion' => $cif,
            'direccion_facturacion' => $direccion,
            'numero_facturacion' => $numero,
            'cp_facturacion' => $cp,
            'localidades_id_localidad' => $municipio,
            'email_facturacion' => $email,
            'num_cuenta_facturacion' => $cuenta,
        );
        $this->db->insert('facturacion', $data);
    }

    public function altaCategoriaRestaurante($id_restaurante, $primera_categoria, $segunda_categoria, $tercera_categoria) {
        $data = array(
            'categorias_id_categoria' => $primera_categoria,
            'segunda_categoria_restaurante' => $segunda_categoria,
            'tercera_categoria_restaurante' => $tercera_categoria,
        );
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
    }

    public function altaEstacionesRestaurantes($id_restaurante, $id_estacion, $nombre_estacion) {
        $clave = random_string('unique');
        $data = array(
            'clave_rel_estacion_restaurante' => $clave,
            'estaciones_id_estacion' => $id_estacion,
            'nombre_rel_estacion_restaurante' => $nombre_estacion,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('rel_estaciones_restaurantes', $data);
    }

    /* Obtener el listado de Restaurantes */

    public function listadoRestaurantesFranquiciado($id_franquiciado, $id_franquiciado) {
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('propietarios', 'propietarios.id_propietario = restaurantes.propietarios_id_propietario');
        $this->db->join('franquiciados', 'franquiciados.id_franquicia = propietarios.franquiciados_id_franquicia');

        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    public function listadoBajaRestaurantesFranquiciado($id_franquiciado) {
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('propietarios', 'propietarios.id_propietario = restaurantes.propietarios_id_propietario');
        $this->db->join('franquiciados', 'franquiciados.id_franquicia = propietarios.franquiciados_id_franquicia');

        $this->db->where('franquiciados_id_franquicia', $id_franquiciado);
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }
	
    public function eliminarRestaurantesFranquiciado($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $this->db->delete('facturacion');
		
        $this->db->where('id_restaurante', $id_restaurante);
        $resultado = $this->db->delete('restaurantes');
		return $resultado;
	}

    /* Obtenemos los datos del usuario en base a la clave */

    public function obtenerDatosPropietario($id_propietario) {
        $this->db->where('clave_propietario', $id_propietario);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }
	
    public function datosPropietarioId($id_propietario) {
        $this->db->where('id_propietario', $id_propietario);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }
	
    public function direccionRestaurante($id_restaurante) {
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'localidades.provincias_id_provincia = provincias.id_provincia');

        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->where('activo_restaurante', 1);
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    //Recuperamos el password para mandarlo por correo
    public function recordarPassword($email, $password) {
        $this->db->where('email_franquiciado', $email);
        $query = $this->db->get('franquiciados');

        $result = $query->result_array();
        $id_franquiciado=false;
        if ($result) {
            $id_franquiciado = $result[0]['id_franquiciado'];

            $data = array(
                'password_franquiciado' => sha1($password),
            );
            $this->db->where('email_franquiciado', $email);
            $this->db->update('franquiciados', $data);
        }
        return $id_franquiciado;
    }
	
	
	
	
	
	
	
	
	
	
	
	
	


	/******************************************************************************************/
	/***************************** GESTION DE RESTAURANTES ************************************/
	/******************************************************************************************/
	
	
    public function buscarRestaurantesPropietarios($busqueda_restaurante_propietario) {

        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('propietarios', 'propietarios.id_propietario = restaurantes.propietarios_id_propietario');
        //$this->db->like('LOWER(nombre_restaurante)', strtolower($busqueda_restaurante_propietario));
        //$this->db->like('LOWER(nombre_propietario)', strtolower($busqueda_restaurante_propietario));
        //$this->db->like('LOWER(apellidos_propietario)', strtolower($busqueda_restaurante_propietario));
		$likes = "(LOWER(nombre_restaurante) like '%" . strtolower($busqueda_restaurante_propietario) . "%'";
		$likes .= " OR LOWER(nombre_propietario) like '%" . strtolower($busqueda_restaurante_propietario) . "%'";
		$likes .= " OR LOWER(apellidos_propietario) like '%" . strtolower($busqueda_restaurante_propietario) . "%')";
        $this->db->where($likes);
        $this->db->where('propietarios.franquiciados_id_franquicia', $this->session->userdata('id_franquicia'));
        $this->db->order_by('actualizado_restaurante', 'desc');
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }
	
	
	
	
	
	
	

}
