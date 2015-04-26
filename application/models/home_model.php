<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function obtenerListCatego() {
        $consulta = $this->db->get("categorias");
        return $consulta->result();
    }

    public function logadoListRestaurantes($idusuario) {
        $this->db->limit(5);
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = restaurantes.id_restaurante', 'left');
        $this->db->where('activo_restaurante', 1);
        $this->db->group_by('restaurantes.nombre_restaurante');
        //$this->db->order_by('menu.fecha_actualizado', 'ASC'); // Esto no tiene el efecto deseado, no coge al hacer el groupby el de campo fecha más actualizado de la tabla menú
        $this->db->order_by('id_restaurante', 'DESC'); // Esto no tiene el efecto deseado, no coge al hacer el groupby el de campo fecha más actualizado de la tabla menú
        $this->db->select('*, rest_favoritos.usuarios_id_usuario as favorito_id_usuario');
        $consulta = $this->db->get("restaurantes");
        //}

        return $consulta->result();
    }

    public function obtenerListRestaurantes() {
        $this->db->limit(5);
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');
        $this->db->where('activo_restaurante', 1);
        $this->db->group_by('restaurantes.nombre_restaurante');
        //$this->db->order_by('menu.fecha_actualizado', 'ASC'); // Esto no tiene el efecto deseado, no coge al hacer el groupby el de campo fecha más actualizado de la tabla menú
        $this->db->order_by('id_restaurante', 'DESC'); // Esto no tiene el efecto deseado, no coge al hacer el groupby el de campo fecha más actualizado de la tabla menú
        $consulta = $this->db->get("restaurantes");
        //}

        return $consulta->result();
    }

    public function loginListadoRestaurantes($id_usuario = null) {

        $this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->get("platos_favoritos");
        $platos_favoritos = $consulta->result();

        $this->db->where('usuarios_id_usuario', $id_usuario);
        $this->db->select('nombre_cp_favorito');
        $consulta = $this->db->get("cp_favoritos");
        $cp_favoritos = $consulta->result();
        $cps=array();
        foreach ($cp_favoritos as $cp) {
            array_push($cps,$cp->nombre_cp_favorito);
        }
        //var_dump($cps);
        
        $this->db->where('id_usuario', $id_usuario);
        $this->db->select('cp_usuario');
        $consulta = $this->db->get("usuarios");
        $cp_usuario = $consulta->row();
        
        array_push($cps, $cp_usuario->cp_usuario);

        //var_dump($cps);die;
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = restaurantes.id_restaurante', 'left');
        if ($cps) {
            $this->db->where_in('cp_restaurante', $cps);
        }
        $this->db->where('activo_restaurante', 1);
        $this->db->group_by('restaurantes.nombre_restaurante');
        $this->db->select('*, rest_favoritos.usuarios_id_usuario as favorito_id_usuario');
        $consulta = $this->db->get("restaurantes");
        return $consulta->result();
    }

    public function obtenerListadoRestaurantes() {
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');
        $this->db->where('activo_restaurante', 1);
        $this->db->group_by('restaurantes.nombre_restaurante');
        $consulta = $this->db->get("restaurantes");
        return $consulta->result();
    }

    /* Busqueda de Primeros */

    public function listadoPrimeros($idmenu) {
        $this->db->where('menu_id_menu', $idmenu);

        $consulta = $this->db->get('primeros_menu');
        //var_dump($consulta->result());die;
        return $consulta->result();
    }

    /* Busqueda de Segundos */

    public function listadoSegundos($idmenu) {
        $this->db->where('menu_id_menu', $idmenu);

        $consulta = $this->db->get('segundos_menu');
        return $consulta->result();
    }

    /* Busqueda de Terceros */

    public function listadoTerceros($idmenu) {
        $this->db->where('menu_id_menu', $idmenu);

        $consulta = $this->db->get('terceros_menu');
        return $consulta->result();
    }

    public function logadoDestacadoRestaurante($idusuario) {
        $this->db->limit(5);
        $this->db->join('destacados', 'destacados.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = restaurantes.id_restaurante', 'left');
        $this->db->where('activo_restaurante', 1);
        $this->db->group_by('restaurantes.nombre_restaurante');
        $this->db->order_by('id_destacado', 'random');
        $this->db->select('*, rest_favoritos.usuarios_id_usuario as favorito_id_usuario');
        $consulta = $this->db->get("restaurantes");
        return $consulta->result();
    }

    public function obtenerDestacadoRestaurante() {
        $this->db->limit(5);
        $this->db->join('destacados', 'destacados.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');
        $this->db->where('activo_restaurante', 1);
        $this->db->group_by('restaurantes.nombre_restaurante');
        $this->db->order_by('id_destacado', 'random');
        $consulta = $this->db->get("restaurantes");
        return $consulta->result();
    }

    /* public function obtenerValoracion($id_restaurante) {
      $sql = "select count(*), sum(global_valoracion) + sum(servicio_valoracion) + sum(comida_valoracion) + sum(calidad_valoracion) as total_valoracion
      from valoracion, restaurantes where valoracion.restaurantes_id_restaurante = restaurantes.id_restaurante and restaurantes.id_restaurante = $id_restaurante";
      $consulta = $this->db->query($sql);
      $resultado = $consulta->result();
      $porcentaje = $resultado[0]->total_valoracion / 40 * 100;
      switch ($porcentaje) {
      case 0:
      return 0;
      case $porcentaje > 0 && $porcentaje <= 20:
      return 1;
      case $porcentaje > 20 && $porcentaje <= 40:
      return 2;
      case $porcentaje > 40 && $porcentaje <= 60:
      return 3;
      case $porcentaje > 60 && $porcentaje <= 80:
      return 4;
      case $porcentaje > 80 && $porcentaje <= 100:
      return 5;
      }
      } */

    public function listadoProvincias() {
        $consulta = $this->db->get('provincias');
        return $consulta->result();
    }

    public function listadoLocalidades($provincia) {
        $this->db->where('provincias_id_provincia', $provincia);
        $this->db->order_by('nombre_localidad, cp_localidad');
        $consulta = $this->db->get('localidades');
        return $consulta->result();
    }

    public function listadoLocalidadesByLocalidad($localidad) {
        $this->db->where('id_localidad', $localidad);
        $consulta = $this->db->get('localidades');
        $result = $consulta->row();
        $this->db->where('provincias_id_provincia', $result->provincias_id_provincia);
        $this->db->order_by('nombre_localidad, cp_localidad');
        $consulta = $this->db->get('localidades');
        return $consulta->result();
    }

    public function getProvinciaByLocalidad($localidad) {
        $this->db->where('id_localidad', $localidad);
        $consulta = $this->db->get('localidades');
        return $consulta->row()->provincias_id_provincia;
    }

    public function obtenerRestauranteFavoritos($id_usuario) {
        $this->db->join('restaurantes', 'restaurantes.id_restaurante = rest_favoritos.restaurantes_id_restaurante');


        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');


        $this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->get('rest_favoritos');
        return $consulta->result();
    }

    public function obtenerRestaurantesMejorValorados() {
        /* $sql = "select *, sum(global_valoracion) + sum(servicio_valoracion) + sum(comida_valoracion) + sum(calidad_valoracion) as total_valoraciones
          from valoracion, restaurantes where valoracion.restaurantes_id_restaurante = restaurantes.id_restaurante
          group by restaurantes_id_restaurante order by total_valoraciones desc limit 0,3"; */
        $sql = "select *, AVG(`global_valoracion`) AS global_valoracion
              from valoracion, restaurantes where valoracion.restaurantes_id_restaurante = restaurantes.id_restaurante
              group by restaurantes_id_restaurante order by global_valoracion desc limit 0,3";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    /*     * ******************************************************************************************************************* */
    /*     * ******************************************************************************************************************* */
    /*     * * Listado de los menús cuando estás logado ** */

    public function listadoMenus($id_restaurante) {
        $this->db->limit(1);
        $this->db->join('restaurantes', 'restaurantes.id_restaurante = menu.restaurantes_id_restaurante');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');

        //$this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = menu.restaurantes_id_restaurante');

        $this->db->where('id_restaurante', $id_restaurante);
        //$this->db->where('usuarios_id_usuario', $id_usuario);
        $this->db->order_by('fecha_actualizado', 'DESC');
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    public function listadoMenusFavoritos2($id_restaurante) {
        $this->db->join('restaurantes', 'restaurantes.id_restaurante = menu.restaurantes_id_restaurante');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');

        //$this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = menu.restaurantes_id_restaurante');

        $this->db->where('id_restaurante', $id_restaurante);
        //$this->db->where('usuarios_id_usuario', $id_usuario);
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    /*     * ******************************************************************************************************************* */
    /*     * ******************************************************************************************************************* */





    /*     * ******************************************************************************************************************* */
    /*     * ******************************************************************************************************************* */
    /*     * * Listado de menús cuando no estás logado ** */

    public function __listadoMenusFavoritos3() {
        $this->db->join('restaurantes', 'restaurantes.id_restaurante = menu.restaurantes_id_restaurante');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = menu.restaurantes_id_restaurante');
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    /*     * ******************************************************************************************************************* */
    /*     * ******************************************************************************************************************* */
    /*     * * Listado de menús cuando no estás logado ** */

    public function listadoMenusFavoritos3($id = null) {
        $this->db->join('restaurantes', 'restaurantes.id_restaurante = menu.restaurantes_id_restaurante');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        //$this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = menu.restaurantes_id_restaurante');
        $this->db->where('restaurantes.id_restaurante', $id);
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    /*     * ******************************************************************************************************************* */
    /*     * ******************************************************************************************************************* */
    /*     * * Listado de menús cuando no estás logado ** */

    public function _listadoMenusFavoritos3($id_restaurante) {

        $sql = "select * from restaurantes, menu where menu.restaurantes_id_restaurante = restaurantes.id_restaurante and 
            restaurantes.id_restaurante=$id_restaurante";

        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    /*     * ******************************************************************************************************************* */
    /*     * ******************************************************************************************************************* */

    public function listadoPrimerosFavoritos($id_menu) {
        $this->db->where('menu_id_menu', $id_menu);
        $consulta = $this->db->get('primeros_menu');
        //var_dump($consulta->result());
        return $consulta->result();
    }

    public function listadoSegundosFavoritos($id_menu) {
        $this->db->where('menu_id_menu', $id_menu);
        $consulta = $this->db->get('segundos_menu');
        return $consulta->result();
    }

    public function listadoTercerosFavoritos($id_menu) {
        $this->db->where('menu_id_menu', $id_menu);
        $consulta = $this->db->get('terceros_menu');
        return $consulta->result();
    }

    public function listadoEstaciones() {
        $this->db->order_by('nombre_estacion');
        $consulta = $this->db->get('estaciones');
        return $consulta->result();
    }

}
