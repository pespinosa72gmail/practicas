<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buscador_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function obtenerLocalidad($abuscar) {
        $this->db->like('nombre_localidad', $abuscar, 'both');
        $this->db->or_like('nombre_localidad', $abuscar, 'before');
        $this->db->or_like('nombre_localidad', $abuscar, 'after');
        $this->db->group_by('nombre_localidad');
        $consulta = $this->db->get('localidades', 20);

        if ($consulta->num_rows() > 0) {
            return $consulta->result();
        } else {
            return FALSE;
        }
    }

    /* Primer buscador */

    public function buscador_plato($id_usuario, $nombre_plato, $categoria_plato, $localidad, $zona, $geo, $orderby = null, $direccion = null) {
        $this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'localidades.provincias_id_provincia = provincias.id_provincia');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = restaurantes.id_restaurante', 'left');

//Nombre de Plato
        if ($nombre_plato) {
            $this->db->join('primeros_menu', 'primeros_menu.menu_id_menu = menu.id_menu');
            $this->db->join('segundos_menu', 'segundos_menu.menu_id_menu = menu.id_menu');
            $this->db->join('terceros_menu', 'terceros_menu.menu_id_menu = menu.id_menu');

            $this->db->where("(LOWER(nombre_primeros_menu) LIKE '%" . strtolower($nombre_plato) . "%' or LOWER(nombre_segundo_menu) LIKE '%" . strtolower($nombre_plato) . "%' OR LOWER(nombre_tercero_menu) LIKE '%" . strtolower($nombre_plato) . "%')");

            //$this->db->like('nombre_primeros_menu', $nombre_plato, 'both');
            //$this->db->or_like('nombre_segundo_menu', $nombre_plato, 'both');
            //$this->db->or_like('nombre_tercero_menu', $nombre_plato, 'both');
        }

        $this->db->where('activo_restaurante', '1');

//Categoria del Restaurante
        if ($categoria_plato) {
            $this->db->where('id_categoria', $categoria_plato);
        }

//Nombre de la Localidad
        if ($localidad) {
            $this->db->like('LOWER(nombre_localidad)', strtolower($localidad), 'both');
        }
//Puntos Cercanos
        if ($zona) {
//$this->db->join('puntos_cercanos', 'puntos_cercanos.restaurantes_id_restaurante = restaurantes.id_restaurante');
            $this->db->like('LOWER(barrio_restaurante)', strtolower($zona), 'both');
        }

//Ordenación por mejor valoración media
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');

//Geolocalización
        if ($geo) {
            $this->db->where('lat_restaurante <', $geo[0] + LATITUDE_RANGE);
            $this->db->where('lat_restaurante >', $geo[0] - LATITUDE_RANGE);
            $this->db->where('long_restaurante <', $geo[1] + LONGITUDE_RANGE);
            $this->db->where('long_restaurante >', $geo[1] - LONGITUDE_RANGE);
        }

        $this->db->group_by('nombre_restaurante');

        if (!is_null($orderby) && !is_null($direccion))
            $this->db->order_by($orderby, $direccion);

        /*
          if ($orderby == "total_valoracion") {
          $this->db->select('*, sum(global_valoracion) + sum(servicio_valoracion) + sum(comida_valoracion) + sum(calidad_valoracion) as total_valoracion');
          }
         */

        $this->db->select('*, rest_favoritos.usuarios_id_usuario as favorito_id_usuario');

        $this->db->select_avg('global_valoracion');
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    /* Segundo buscador */

    public function buscador_zona($provincia, $localidad, $cp, $direccion, $zona, $punto_interes, $metro, $geo, $orderby = null, $direccionOrden = null) {
        $this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = restaurantes.id_restaurante', 'left');

//Ordenación por mejor valoración
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');

        $this->db->where('activo_restaurante', '1');

        if ($localidad) {
            $this->db->where('localidades_id_localidad', $localidad);
        }

        if ($punto_interes) {
            $this->db->join('puntos_cercanos', 'puntos_cercanos.restaurantes_id_restaurante = restaurantes.id_restaurante');
            $this->db->like('LOWER(nombre_punto_cercano)', strtolower($punto_interes), 'both');
        }

        if ($cp) {
            $this->db->join('codigo_postal', 'codigo_postal.id_codigo_postal = restaurantes.codigo_postal_id_codigo_postal');
            $this->db->where('num_codigo_postal', $cp);
        }
        if ($direccion) {
            $this->db->like('LOWER(direccion_restaurante)', strtolower($direccion), 'both');
        }
        if ($zona) {
            $this->db->like('LOWER(barrio_restaurante)', strtolower($zona), 'both');
        }
        if ($provincia) {
            $this->db->where('provincias_id_provincia', $provincia);
        }

        if ($metro) {
            $this->db->join('rel_estaciones_restaurantes', 'rel_estaciones_restaurantes.restaurantes_id_restaurante = restaurantes.id_restaurante');
            $this->db->where('rel_estaciones_restaurantes.estaciones_id_estacion', $metro);
        }
//Geolocalización
        if ($geo) {
            $this->db->where('lat_restaurante <', $geo[0] + LATITUDE_RANGE);
            $this->db->where('lat_restaurante >', $geo[0] - LATITUDE_RANGE);
            $this->db->where('long_restaurante <', $geo[1] + LONGITUDE_RANGE);
            $this->db->where('long_restaurante >', $geo[1] - LONGITUDE_RANGE);
        }
        $this->db->where('activo_restaurante', 1);

        $this->db->group_by('nombre_restaurante');

        if (!is_null($orderby) && !is_null($direccionOrden))
            $this->db->order_by($orderby, $direccionOrden);

        $this->db->select('*, rest_favoritos.usuarios_id_usuario as favorito_id_usuario');

        $this->db->select_avg('global_valoracion');
        $consulta = $this->db->get('restaurantes');
//var_dump("consulta: ", $consulta->result());
        //      die;
        return $consulta->result();
    }

    /* Tercer buscador */

    public function buscador_restaurante($nombreRestaurante, $categoriaRestaurante, $especialidades, $precioCarta, $precioMenu, $municipio, $zona, $parking, $fotos, $actualizanMenu, $conDescuentos, $permitenReservas, $permitenTarjeta, $geo, $orderby = null, $direccionOrden = null) {
        $this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');
        $this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('rest_favoritos', 'rest_favoritos.restaurantes_id_restaurante = restaurantes.id_restaurante', 'left');

//Ordenación por mejor valoración
        $this->db->join('valoracion', 'restaurantes.id_restaurante = valoracion.restaurantes_id_restaurante', 'left');

        if ($nombreRestaurante) {
            $this->db->like('LOWER(nombre_restaurante)', strtolower($nombreRestaurante));
        }

        if ($categoriaRestaurante) {
            $this->db->where('id_categoria', $categoriaRestaurante);
        }

        if ($especialidades) {
            $this->db->join('especialidades', 'especialidades.restaurantes_id_restaurante = restaurantes.id_restaurante');
            $this->db->like('LOWER(nombre_especialidad)', strtolower($especialidades));
        }

        $precioCartaWhere1 = null;
        $precioCartaWhere2 = null;
        switch ($precioCarta) {
            case 1:
                $precioCartaWhere1 = "precio_carta_restaurante < 15";
                break;
            case 2:
                $precioCartaWhere1 = "precio_carta_restaurante >= 16";
                $precioCartaWhere2 = "precio_carta_restaurante <= 25";
                break;
            case 3:
                $precioCartaWhere1 = "precio_carta_restaurante >= 26";
                $precioCartaWhere2 = "precio_carta_restaurante <= 35";
                break;
            case 4:
                $precioCartaWhere1 = "precio_carta_restaurante >= 36";
                $precioCartaWhere2 = "precio_carta_restaurante <= 50";
                break;
            case 5:
                $precioCartaWhere1 = "precio_carta_restaurante >= 51";
                break;

            default:
                break;
        }

        if ($precioCartaWhere1) {
            $this->db->where($precioCartaWhere1);
        }

        if ($precioCartaWhere2) {
            $this->db->where($precioCartaWhere2);
        }

        $precioMenuWhere1 = null;
        $precioMenuWhere2 = null;

        switch ($precioMenu) {
            case 1:
                $precioMenuWhere1 = "precio_menu < 7";
                $precioMenuWhere2 = null;
                break;
            case 2:
                $precioMenuWhere1 = "precio_menu >= 10";
                $precioMenuWhere2 = null;
                break;
            case 3:
                $precioMenuWhere1 = "precio_menu >= 11";
                $precioMenuWhere2 = "precio_menu <= 15";
                break;
            case 4:
                $precioMenuWhere1 = "precio_menu >= 16";
                $precioMenuWhere2 = "precio_menu <= 20";
                break;
            case 5:
                $precioMenuWhere1 = "precio_menu >= 21";
                $precioMenuWhere2 = "precio_menu <= 40";
                break;
            case 6:
                $precioMenuWhere1 = "precio_menu >= 41";
                $precioMenuWhere2 = null;
                break;

            default:
                break;
        }

        if ($precioMenuWhere1) {
            $this->db->where($precioMenuWhere1);
        }

        if ($precioMenuWhere2) {
            $this->db->where($precioMenuWhere2);
        }

        if ($municipio) {
            $this->db->like('LOWER(nombre_localidad)', strtolower($municipio));
        }

        if ($zona) {
            $this->db->like('LOWER(barrio_restaurante)', strtolower($zona));
        }

        if ($parking) {
            $this->db->where('parking_restaurante', $parking == 'on' ? 1 : 0);
        }

        if ($fotos) {
            $this->db->join('imagenes', 'imagenes.restaurantes_id_restaurante = restaurantes.id_restaurante');
        }

        if ($actualizanMenu) {
            $this->db->where('actualizado_restaurante >', strtotime("1 week ago"));
        }

        //Este campo no está dado de alta en base de datos
        if ($conDescuentos) {
            //$this->db->where('descuentos_restaurante', $parking);
        }

        if ($permitenReservas) {
            $this->db->where('reservas_restaurante', $permitenReservas == 'on' ? 1 : 0);
        }

        if ($permitenTarjeta) {
            $this->db->where('tarjetas_restaurante', $permitenTarjeta == 'on' ? 1 : 0);
        }

        if ($geo) {
            $this->db->where('lat_restaurante <', $geo[0] + LATITUDE_RANGE);
            $this->db->where('lat_restaurante >', $geo[0] - LATITUDE_RANGE);
            $this->db->where('long_restaurante <', $geo[1] + LONGITUDE_RANGE);
            $this->db->where('long_restaurante >', $geo[1] - LONGITUDE_RANGE);
        }

        $this->db->where('activo_restaurante', 1);

        $this->db->group_by('nombre_restaurante');

        if (!is_null($orderby) && !is_null($direccionOrden))
            $this->db->order_by($orderby, $direccionOrden);

        $this->db->select('*, rest_favoritos.usuarios_id_usuario as favorito_id_usuario');

        $this->db->select_avg('global_valoracion');
        $consulta = $this->db->get('restaurantes');

        return $consulta->result();
    }

    /* Busqueda de Primeros */

    public function buscador_primeros($idmenu) {
        $this->db->where('menu_id_menu', $idmenu);

        $consulta = $this->db->get('primeros_menu');
        return $consulta->result();
    }

    /* Busqueda de Segundos */

    public function buscador_segundos($idmenu) {
        $this->db->where('menu_id_menu', $idmenu);

        $consulta = $this->db->get('segundos_menu');
        return $consulta->result();
    }

        /* Busqueda de Segundos */

    public function buscador_entrantes($idmenu) {
        $this->db->where('menu_id_menu', $idmenu);

        $consulta = $this->db->get('entrantes_menu');
        return $consulta->result();
    }

}
