<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restaurante_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* Método general - Obtener el Código Postal */

    public function obtenerCp($cp) {
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->where('cp_localidad', $cp);
        $consulta = $this->db->get('localidades');
        return $consulta->row();
    }

    /* Método general - Obtener listado Categorias */

    public function listadoCategoriasRestaurante() {
        $consulta = $this->db->get('categorias');
        return $consulta->result();
    }

    public function listadoEstaciones() {
        $consulta = $this->db->get('estaciones');
        return $consulta->result();
    }

    public function listadoTodosRestaurantes() {
        $id_restaurador = $this->session->userdata('id_propietario');

        $this->db->where('propietarios_id_propietario', $id_restaurador);
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    /* ------------------------------------------ */
    /* Detalle de restaurante de la parte cliente */
    /* ------------------------------------------ */

    public function log_detalle_restaurante($slug_limpio, $idusuario) {
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('codigo_postal', 'codigo_postal.id_codigo_postal = restaurantes.codigo_postal_id_codigo_postal');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'localidades.provincias_id_provincia = provincias.id_provincia');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = restaurantes.id_restaurante', 'left');

        $this->db->where('slug_restaurante', $slug_limpio);
        $this->db->where('activo_restaurante', 1);
        $this->db->select('*, rest_favoritos.usuarios_id_usuario as favorito_id_usuario');
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    public function detalle_restaurante($slug_limpio) {
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('codigo_postal', 'codigo_postal.id_codigo_postal = restaurantes.codigo_postal_id_codigo_postal');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'localidades.provincias_id_provincia = provincias.id_provincia');

        $this->db->where('slug_restaurante', $slug_limpio);
        $this->db->where('activo_restaurante', 1);
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    public function listado_puntos_cercanos($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('puntos_cercanos');
        return $consulta->result();
    }

    public function listado_especialidades($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('especialidades');
        return $consulta->result();
    }

    public function listado_estaciones($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $this->db->join('rel_estaciones_restaurantes', 'rel_estaciones_restaurantes.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('estaciones', 'rel_estaciones_restaurantes.estaciones_id_estacion = estaciones.id_estacion');
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    /* public function listado_estaciones($id_restaurante){
      $this->db->where('restaurantes_id_restaurante', $id_restaurante);
      $consulta = $this->db->get('rel_estaciones_restaurantes');
      return $consulta->result();
      } */

    /* ------------------------------------------------ */
    /* FIN - Detalle de restaurante de la parte cliente */
    /* ------------------------------------------------ */

    public function detalle_menu_restaurante($id_restaurante) {
        //$this->db->join('primeros_menu', 'primeros_menu.menu_id_menu = menu.id_menu', 'right');
        //$this->db->group_by('nombre_menu');

        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    public function damePrimerosMenu($id_menu) {
        $this->db->join('menu', 'menu.id_menu = primeros_menu.menu_id_menu');

        $this->db->where('menu_id_menu', $id_menu);
        $consulta = $this->db->get('primeros_menu');
        return $consulta->result();

        /*
          if($consulta->num_rows > 0){
          foreach ($consulta->result() as $key => $value) {
          echo $value->nombre_primeros_menu;
          }
          }
         */
    }

    public function dameSegundosMenu($id_menu) {
        $this->db->join('menu', 'menu.id_menu = segundos_menu.menu_id_menu');

        $this->db->where('menu_id_menu', $id_menu);
        $consulta = $this->db->get('segundos_menu');
        return $consulta->result();

        /*
          if($consulta->num_rows > 0){
          foreach ($consulta->result() as $key => $value) {
          echo $value->nombre_primeros_menu;
          }
          }
         */
    }

    public function obtener_listado_imagenes($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('imagenes');
        return $consulta->result();
    }

    /* Dame restaurante del restaurador logado, ordenado por la fecha de actualización. */

    public function dameRestauranteActualizado($id_restaurador) {
        //$this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        //$this->db->join('codigo_postal', 'codigo_postal.id_codigo_postal = restaurantes.codigo_postal_id_codigo_postal');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'localidades.provincias_id_provincia = provincias.id_provincia');
        $this->db->join('planes', 'planes.id_plan = restaurantes.planes_id_plan');

        $this->db->where('propietarios_id_propietario', $id_restaurador);
        $this->db->order_by('actualizado_restaurante', 'desc');
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    public function dameRestauranteActualizado_2($id_restaurante) {
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('codigo_postal', 'codigo_postal.id_codigo_postal = restaurantes.codigo_postal_id_codigo_postal');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');

        $this->db->join('planes', 'planes.id_plan = restaurantes.planes_id_plan');

        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->order_by('actualizado_restaurante', 'desc');
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    /* Controler imagenes/altaImagenesRestaurante */

    public function dameDetalleRestaurante($id_restaurante) {
        $this->db->where('id_restaurante', $id_restaurante);
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    public function dameListadoImagen($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('imagenes');
        return $consulta->result();
    }

    /*     * ********************************************* */

    public function obtenerCpRestaurante($cp) {
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->where('cp_localidad', $cp);
        $consulta = $this->db->get('localidades');
        return $consulta->row();
    }

    /*     * ******************************************** */
    /*     * ******************************************** */
    /*     * *********** Alta de restaurante ************ */
    /* Primero guardamos los datos del restaurante */

    public function altaRestaurantes($nombre_restaurante, $web_restaurante, $direccion_restaurante, $numero_restaurante, $cp_restaurante, $barrio_restaurante, $precio_medio_carta, $parking_restaurante, $tarjeta_restaurante, $reservas_restaurante, $visible_restaurante) {
        $clave_restaurante = random_string('unique');
        $id_restaurador = $this->session->userdata('id_propietario');

        $data = array(
            'clave_restaurante' => $clave_restaurante,
            'nombre_restaurante' => $nombre_restaurante,
            'slug_restaurante' => url_title(strtolower(convert_accented_characters($nombre_restaurante))),
            'metakeywords_restaurante' => $nombre_restaurante,
            'web_restaurante' => $web_restaurante,
            'direccion_restaurante' => $direccion_restaurante,
            'numero_restaurante' => $numero_restaurante,
            'cp_restaurante' => $cp_restaurante,
            'barrio_restaurante' => $barrio_restaurante,
            'precio_medio_restaurante' => $precio_medio_carta,
            'parking_restaurante' => $parking_restaurante,
            'tarjetas_restaurante' => $tarjeta_restaurante,
            'reservas_restaurante' => $reservas_restaurante,
            'visible_restaurante' => $visible_restaurante,
            'creado_restaurante' => now(),
            'actualizado_restaurante' => now(),
            'categorias_id_categoria' => 1,
            'localidades_id_localidad' => 1,
            'codigo_postal_id_codigo_postal' => 1,
            'planes_id_plan' => 1,
            'propietarios_id_propietario' => $id_restaurador,
        );
        $this->db->insert('restaurantes', $data);
    }

    public function altaRestaurante2($id_restaurante, $razon_social_facturacion, $calle_facturacion, $numero_facturacion, $cp_facturacion, $email_facturacion, $num_cuenta_facturacion) {
        $clave = random_string('unique');
        $data = array(
            'clave_facturacion' => $clave,
            'razon_social_facturacion' => $razon_social_facturacion,
            'direccion_facturacion' => $calle_facturacion,
            'numero_facturacion' => $numero_facturacion,
            'cp_facturacion' => $cp_facturacion,
            'email_facturacion' => $email_facturacion,
            'num_cuenta_facturacion' => $num_cuenta_facturacion,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('facturacion', $data);
    }

    public function altaCategoriasRestaurantes($id_restaurante, $opc1, $opc2, $opc3) {
        $data = array(
            'categorias_id_categoria' => $opc1,
            'segunda_categoria_restaurante' => $opc2,
            'tercera_categoria_restaurante' => $opc3,
        );
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
    }

    public function altaEspecialidadesRestaurantes($id_restaurante, $nombre_especialidad) {
        $clave = random_string('unique');
        $data = array(
            'clave_especialidad' => $clave,
            'nombre_especialidad' => $nombre_especialidad,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('especialidades', $data);
    }

    public function altaPuntoInteresRestaurantes($id_restaurante, $nombre_punto_cercano) {
        $clave = random_string('unique');
        $data = array(
            'clave_punto_cercano' => $clave,
            'nombre_punto_cercano' => $nombre_punto_cercano,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('puntos_cercanos', $data);
    }

    public function altaEstacionesRestaurantes($id_restaurante, $estaciones_metro) {
        $clave = random_string('unique');
        $data = array(
            'clave_rel_estacion_restaurante' => $clave,
            'nombre_rel_estacion_restaurante' => $estaciones_metro,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('rel_estaciones_restaurantes', $data);
    }

    /*     * ******************************************** */
    /*     * ******************************************** */
    /*     * ******************************************** */

    public function eliminarRestaurante($id_restaurante_eliminar) {
        $this->db->where('id_restaurante', $id_restaurante_eliminar);
        $this->db->delete('restaurantes');
    }

    public function obtenerUltimoRestauranteRegistrado() {
        $id_propietario = $this->session->userdata('id_propietario');
        //$id_propietario = 2;
        $this->db->where('propietarios_id_propietario', $id_propietario);
        $this->db->limit(1);
        $this->db->order_by('id_restaurante', 'desc');
        $consulta = $this->db->get('restaurantes');
        return $consulta->row();
    }

    public function dameListadoCupones($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('cupones');
        return $consulta->result();
    }

}
