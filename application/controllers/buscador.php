<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buscador extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('buscador_model');
        $this->load->model('home_model');
        $this->load->model('valoraciones_model');
        $this->load->model('footer_model');

        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Buscador', '/section/page');
    }

    public function autocompletarLocalidad() {
        if ($this->input->is_ajax_request() && $this->input->post('info')) {
            $abuscar = $this->security->xss_clean($this->input->post('info'));
            $buscar = $this->buscador_model->obtenerLocalidad($abuscar);

            if ($buscar !== FALSE) {
                foreach ($buscar as $key => $value) {
                    ?>
                    <ul class="sugerenciasmunicipios">
                        <li><a href=""><?php echo $value->nombre_localidad; ?></a></li>
                    </ul>
                    <?php
                }
            } else {
                ?>
                <p><?php echo "No hay datos"; ?></p>
                <?php
            }
        }
    }

    public function geolocalizacionSession() {
        //echo 'prueba1';
        if ($this->input->is_ajax_request() && $this->input->post('valor')) {
            $this->session->set_userdata('geolocalizacion_session', $this->input->post('valor'));
        }
        echo $this->session->userdata('geolocalizacion_session');
    }

    public function buscador_plato() {

        $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
        $datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();

        $nombre_plato = trim($this->input->post('nombre_plato_1', TRUE));
        $categoria_plato = $this->input->post('categoria_plato_1', TRUE);
        $localidad = trim($this->input->post('localidad_1', TRUE));
        $zona = trim($this->input->post('zona_1', TRUE));

        $id_usuario = $this->session->userdata('id_usuario', TRUE);

        //Geolocalización: Latitud y Longitud
        $geo = $this->input->post('geo_1', TRUE);
        if ($geo) {
            $geo = explode(',', $geo);
            $datos['geo'] = $geo;
        }

        //debug. mostrar información
        $this->output->enable_profiler(TRUE);

        $datos['todos'] = $this->buscador_model->buscador_plato($id_usuario, $nombre_plato, $categoria_plato, $localidad, $zona, $geo, "nombre_restaurante", "ASC");
        $datos['baratos'] = $this->buscador_model->buscador_plato($id_usuario, $nombre_plato, $categoria_plato, $localidad, $zona, $geo, "precio_menu", "ASC");
        $datos['caros'] = $this->buscador_model->buscador_plato($id_usuario, $nombre_plato, $categoria_plato, $localidad, $zona, $geo, "precio_menu", "DESC");
        $datos['mejorvalorados'] = $this->buscador_model->buscador_plato($id_usuario, $nombre_plato, $categoria_plato, $localidad, $zona, $geo, "global_valoracion", "DESC");
        //$datos['mejorvalorados'] = $this->buscador_model->buscador_plato($nombre_plato, $categoria_plato, $localidad, $zona, "total_valoracion", "DESC");

        $lats = array();
        $longs = array();
        foreach ($datos['todos'] as $primeros_segundos) {
            $lats[] = $primeros_segundos->lat_restaurante;
            $longs[] = $primeros_segundos->long_restaurante;
            $datos['todosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['todosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionTodos'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['baratos'] as $primeros_segundos) {
            $datos['baratosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['baratosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionBaratos'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['caros'] as $primeros_segundos) {
            $datos['carosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['carosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionCaros'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['mejorvalorados'] as $primeros_segundos) {
            $datos['valoradosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['valoradosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionValorados'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }

        //Calculamos la esquina sur oeste y el centro del mapa
        if ($geo) {
            $datos['minLat'] = $geo[0] - LATITUDE_RANGE / 2;
            $datos['minLong'] = $geo[1] - LONGITUDE_RANGE / 2;
            $datos['centroLat'] = $geo[0];
            $datos['centroLong'] = $geo[1];
        } else {
            if (!empty($lats) && !empty($longs)) {
                $datos['minLat'] = min($lats);
                $datos['minLong'] = min($longs);
                $datos['centroLat'] = $datos['minLat'] + LATITUDE_RANGE / 2;
                $datos['centroLong'] = $datos['minLong'] + LONGITUDE_RANGE / 2;
            } else {
                $datos['centroLat'] = LATITUDE_SOL;
                $datos['centroLong'] = LONGITUDE_SOL;
            }
        }

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "resultado-busqueda";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function buscador_zona() {

        $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
        $datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();
        //$datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();

        $provincia = $this->input->post('provincia_2', TRUE);
        if ($provincia == "Provincia") {
            $provincia = null;
        }
        $localidad = $this->input->post('localidad_2', TRUE);
        if ($localidad == "Municipio") {
            $localidad = null;
        }
        $cp = trim($this->input->post('cp_2', TRUE));
        $direccion = trim($this->input->post('direccion_2', TRUE));
        $zona = trim($this->input->post('zona_2', TRUE));
        $punto_interes = trim($this->input->post('punto_interes_2', TRUE));
        $metro = $this->input->post('metro_2', TRUE);
        if ($metro == "Estación de Metro") {
            $metro = null;
        }

        //Geolocalización: Latitud y Longitud
        $geo = $this->input->post('geo_2', TRUE);
        if ($geo) {
            $geo = explode(',', $geo);
            $datos['geo'] = $geo;
        }

        //debug. mostrar información
        $this->output->enable_profiler(TRUE);


//        $comprueba = $this->buscador_model->buscador_zona($provincia, $localidad, $cp, $direccion, $zona, $punto_interes, $metro);

        $datos['todos'] = $this->buscador_model->buscador_zona($provincia, $localidad, $cp, $direccion, $zona, $punto_interes, $metro, $geo, "nombre_restaurante", "ASC");
        $datos['baratos'] = $this->buscador_model->buscador_zona($provincia, $localidad, $cp, $direccion, $zona, $punto_interes, $metro, $geo, "precio_medio_restaurante", "ASC");
        $datos['caros'] = $this->buscador_model->buscador_zona($provincia, $localidad, $cp, $direccion, $zona, $punto_interes, $metro, $geo, "precio_medio_restaurante", "DESC");
        $datos['mejorvalorados'] = $this->buscador_model->buscador_zona($provincia, $localidad, $cp, $direccion, $zona, $punto_interes, $metro, $geo, "global_valoracion", "DESC");
        //$datos['mejorvalorados'] = $this->buscador_model->buscador_plato($nombre_plato, $categoria_plato, $localidad, $zona, "total_valoracion", "DESC");

        $lats = array();
        $longs = array();
        foreach ($datos['todos'] as $primeros_segundos) {
            $lats[] = $primeros_segundos->lat_restaurante;
            $longs[] = $primeros_segundos->long_restaurante;
            $datos['todosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['todosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionTodos'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['baratos'] as $primeros_segundos) {
            $datos['baratosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['baratosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionBaratos'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['caros'] as $primeros_segundos) {
            $datos['carosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['carosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionCaros'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['mejorvalorados'] as $primeros_segundos) {
            $datos['valoradosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['valoradosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionValorados'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }

        //Calculamos la esquina sur oeste y el centro del mapa
        if ($geo) {
            $datos['minLat'] = $geo[0] - LATITUDE_RANGE / 2;
            $datos['minLong'] = $geo[1] - LONGITUDE_RANGE / 2;
            $datos['centroLat'] = $geo[0];
            $datos['centroLong'] = $geo[1];
        } else {
            if (!empty($lats) && !empty($longs)) {
                $datos['minLat'] = min($lats);
                $datos['minLong'] = min($longs);
                $datos['centroLat'] = $datos['minLat'] + LATITUDE_RANGE / 2;
                $datos['centroLong'] = $datos['minLong'] + LONGITUDE_RANGE / 2;
            } else {
                $datos['centroLat'] = LATITUDE_SOL;
                $datos['centroLong'] = LONGITUDE_SOL;
            }
        }


        /*
          echo "<pre>";
          print_r($comprueba);
          die();
          echo "</pre>";
         */

        //      $datos['detalles'] = $comprueba;
        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "resultado-busqueda";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function buscador_restaurante() {
        //$datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();
        $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
        $datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();
        
        $nombreRestaurante = trim($this->input->post('nombre_restaurante_3', TRUE));
        $categoriaRestaurante = $this->input->post('categoria_3', TRUE);
        $especialidades = trim($this->input->post('especialidades_3', TRUE));
        $precioCarta = $this->input->post('precio_carta_3', TRUE);
        $precioMenu = $this->input->post('precio_menu_3', TRUE);
        $municipio = trim($this->input->post('municipio_3', TRUE));
        $zona = trim($this->input->post('zona_3', TRUE));
        $parking = $this->input->post('parking_3', TRUE);
        $fotos = $this->input->post('fotos_3', TRUE);
        $actualizanMenu = $this->input->post('actualizan_menu_3', TRUE);
        $conDescuentos = $this->input->post('con_descuentos_3', TRUE);
        $permitenReservas = $this->input->post('permiten_reservas_3', TRUE);
        $permitenTarjeta = $this->input->post('permiten_tarjeta_3', TRUE);

        //Geolocalización: Latitud y Longitud
        $geo = $this->input->post('geo_3', TRUE);
        if ($geo) {
            $geo = explode(',', $geo);
            $datos['geo'] = $geo;
        }

        //debug. mostrar información
        $this->output->enable_profiler(TRUE);


//        $comprueba = $this->buscador_model->buscador_zona($provincia, $localidad, $cp, $direccion, $zona, $punto_interes, $metro);

        $datos['todos'] = $this->buscador_model->buscador_restaurante($nombreRestaurante, $categoriaRestaurante, $especialidades, $precioCarta, $precioMenu, $municipio, $zona, $parking, $fotos, $actualizanMenu, $conDescuentos, $permitenReservas, $permitenTarjeta, $geo, "nombre_restaurante", "ASC");
        $datos['baratos'] = $this->buscador_model->buscador_restaurante($nombreRestaurante, $categoriaRestaurante, $especialidades, $precioCarta, $precioMenu, $municipio, $zona, $parking, $fotos, $actualizanMenu, $conDescuentos, $permitenReservas, $permitenTarjeta, $geo, "precio_medio_restaurante", "ASC");
        $datos['caros'] = $this->buscador_model->buscador_restaurante($nombreRestaurante, $categoriaRestaurante, $especialidades, $precioCarta, $precioMenu, $municipio, $zona, $parking, $fotos, $actualizanMenu, $conDescuentos, $permitenReservas, $permitenTarjeta, $geo, "precio_medio_restaurante", "DESC");
        $datos['mejorvalorados'] = $this->buscador_model->buscador_restaurante($nombreRestaurante, $categoriaRestaurante, $especialidades, $precioCarta, $precioMenu, $municipio, $zona, $parking, $fotos, $actualizanMenu, $conDescuentos, $permitenReservas, $permitenTarjeta, $geo, "global_valoracion", "DESC");
        //$datos['mejorvalorados'] = $this->buscador_model->buscador_plato($nombre_plato, $categoria_plato, $localidad, $zona, "total_valoracion", "DESC");

        $lats = array();
        $longs = array();
        foreach ($datos['todos'] as $primeros_segundos) {
            $lats[] = $primeros_segundos->lat_restaurante;
            $longs[] = $primeros_segundos->long_restaurante;
            $datos['todosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['todosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionTodos'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['baratos'] as $primeros_segundos) {
            $datos['baratosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['baratosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionBaratos'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['caros'] as $primeros_segundos) {
            $datos['carosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['carosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionCaros'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }
        foreach ($datos['mejorvalorados'] as $primeros_segundos) {
            $datos['valoradosPrimerosBuscador'][] = $this->buscador_model->buscador_primeros($primeros_segundos->id_menu);
            $datos['valoradosSegundosBuscador'][] = $this->buscador_model->buscador_segundos($primeros_segundos->id_menu);
            $datos['mediaValoracionValorados'][] = $this->valoraciones_model->mediaValoracionRestaurante($primeros_segundos->id_restaurante);
        }

        //Calculamos la esquina sur oeste y el centro del mapa
        if ($geo) {
            $datos['minLat'] = $geo[0] - LATITUDE_RANGE / 2;
            $datos['minLong'] = $geo[1] - LONGITUDE_RANGE / 2;
            $datos['centroLat'] = $geo[0];
            $datos['centroLong'] = $geo[1];
        } else {
            if (!empty($lats) && !empty($longs)) {
                $datos['minLat'] = min($lats);
                $datos['minLong'] = min($longs);
                $datos['centroLat'] = $datos['minLat'] + LATITUDE_RANGE / 2;
                $datos['centroLong'] = $datos['minLong'] + LONGITUDE_RANGE / 2;
            } else {
                $datos['centroLat'] = LATITUDE_SOL;
                $datos['centroLong'] = LONGITUDE_SOL;
            }
        }


        /*
          echo "<pre>";
          print_r($comprueba);
          die();
          echo "</pre>";
         */

        //      $datos['detalles'] = $comprueba;
        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "resultado-busqueda";
        $this->load->view('plantillas/plantilla2', $datos);
    }

}
