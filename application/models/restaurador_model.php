<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restaurador_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* Método genérico */

    public function actualizarRestauranteClave($id_restaurantes) {
        $data = array(
            'actualizado_restaurante' => now(),
        );
        $this->db->where('clave_restaurante', $id_restaurantes);
        $this->db->update('restaurantes', $data);
    }

    public function actualizarRestauranteID($id_restaurante) {
        $data = array(
            'actualizado_restaurante' => now(),
        );
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
    }

    //Insert de restaurante
    public function guardarRestaurante($id_restaurante, $nombre_restaurante, $calle_restaurante, $numero_restaurante, $cp_restaurante, $municipio_restaurante, $provincia_restaurante, $lat_restaurante, $long_restaurante, $plan_restaurante) {
        $this->db->where('cp_localidad', $cp_restaurante);
        $this->db->where('nombre_localidad', $municipio_restaurante);
        $municipio = $this->db->get('localidades');
        $this->db->where('num_codigo_postal', $cp_restaurante);
        $cp = $this->db->get('codigo_postal');

        $data = array(
            'slug_restaurante' => url_title(strtolower(convert_accented_characters($nombre_restaurante))),
            'nombre_restaurante' => $nombre_restaurante,
            'direccion_restaurante' => $calle_restaurante,
            'numero_restaurante' => $numero_restaurante,
            'cp_restaurante' => $cp_restaurante,
            'lat_restaurante' => $lat_restaurante,
            'long_restaurante' => $long_restaurante,
            'localidades_id_localidad' => $municipio->row()->id_localidad,
            'actualizado_restaurante' => now(),
            'creado_restaurante' => date("Y-m-d"),
            'codigo_postal_id_codigo_postal' => $cp->row()->id_codigo_postal,
            'categorias_id_categoria' => 0,
            'planes_id_plan' => $plan_restaurante
        );
        if ($id_restaurante) {
            $this->db->where('id_restaurante', $id_restaurante);
            $this->db->update('restaurantes', $data);
            return $id_restaurante;
        } else {
            $this->db->insert('restaurantes', $data);
            return $this->db->insert_id();
        }
    }

    /* Método general - Obtener el Código Postal */

    public function obtenerCp($cp) {
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->where('cp_localidad', $cp);
        $consulta = $this->db->get('localidades');
        return $consulta->row();
    }

    /* Restaurador */

    public function compruebaRestaurador($email, $password) {
        $this->db->where('email_propietario', $email);
        $this->db->where('pass_propietario', $password);
        $this->db->where('activo_propietario', 1);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }

    public function editarDatosRestaurador($id_restaurador, $nombre_propietario, $apellidos_propietario, $email_propietario, $pass_propietario, $dni_propietario, $telefono_propietario, $cp_propietario) {
        $data = array(
            'nombre_propietario' => $nombre_propietario,
            'apellidos_propietario' => $apellidos_propietario,
            'email_propietario' => $email_propietario,
            'pass_propietario' => sha1($pass_propietario),
            'dni_propietario' => $dni_propietario,
            'telefono_propietario' => $telefono_propietario,
            'cp_propietario' => $cp_propietario,
        );
        $this->db->where('id_propietario', $id_restaurador);
        $this->db->update('propietarios', $data);
    }

    public function editarDatosRestaurador2($id_restaurador, $nombre_propietario, $apellidos_propietario, $email_propietario, $dni_propietario, $telefono_propietario, $cp_propietario) {
        $data = array(
            'nombre_propietario' => $nombre_propietario,
            'apellidos_propietario' => $apellidos_propietario,
            'email_propietario' => $email_propietario,
            'dni_propietario' => $dni_propietario,
            'telefono_propietario' => $telefono_propietario,
            'cp_propietario' => $cp_propietario,
        );
        $this->db->where('id_propietario', $id_restaurador);
        $this->db->update('propietarios', $data);
    }

    public function datosRestaurador($id_restaurador) {
        $this->db->where('id_propietario', $id_restaurador);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }

    public function obtenerCpRestaurador($cp) {
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->where('cp_localidad', $cp);
        $consulta = $this->db->get('localidades');
        return $consulta->row();
    }

    public function listadoRestaurantesRestaurador($id_restaurador) {
        //$this->db->join('categorias', 'categorias.id_categoria = restaurantes.categorias_id_categoria');
        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        //$this->db->join('menu', 'menu.restaurantes_id_restaurante = restaurantes.id_restaurante');

        $this->db->order_by('actualizado_restaurante', 'desc');
        $this->db->where('propietarios_id_propietario', $id_restaurador);
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    /* Especialidades */

    public function listadoEspecialidadesRestaurante($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('especialidades');
        return $consulta->result();
    }

    public function eliminarEspecialidadRestaurante($clave) {
        $this->db->where('clave_especialidad', $clave);
        $this->db->delete('especialidades');
    }

    public function anadirEspecialidadRestaurante($id_restaurante, $nombre_especialidad) {
        $clave_especialidad = random_string('unique');
        $data = array(
            'clave_especialidad' => $clave_especialidad,
            'nombre_especialidad' => $nombre_especialidad,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('especialidades', $data);
    }

    /* Puntos de interés */

    public function listadoPuntosInteres($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('puntos_cercanos');
        return $consulta->result();
    }

    public function eliminarPuntosInteres($clave) {
        $this->db->where('clave_punto_cercano', $clave);
        $this->db->delete('puntos_cercanos');
    }

    public function anadirPuntoInteres($id_restaurante, $nombre_punto_cercano) {
        $clave_punto_cercano = random_string('unique');
        $data = array(
            'clave_punto_cercano' => $clave_punto_cercano,
            'nombre_punto_cercano' => $nombre_punto_cercano,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('puntos_cercanos', $data);
    }

    /* Estaciones de metro */

    public function listadoEstacionesRestaurante($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('rel_estaciones_restaurantes');
        return $consulta->result();
    }

    public function listadoEstaciones() {
        $this->db->order_by('nombre_estacion', 'asc');
        $consulta = $this->db->get('estaciones');
        return $consulta->result();
    }

    public function anadirEstacion($id_restaurantes, $nombre_estacion) {
        $data = array(
            'nombre_rel_estacion_restaurante' => $nombre_estacion,
            'restaurantes_id_restaurante' => $id_restaurantes,
        );
        $this->db->insert('rel_estaciones_restaurantes', $data);
    }

    /* Datos de facturación */

    public function datosFacturacion($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('facturacion');
        return $consulta->row();
    }

    public function editarDatosFacturacion($id_restaurante, $razon_social, $direccion_facturacion, $numero_facturacion, $cp_facturacion, $email_facturacion, $periodo_facturacion, $num_cuenta_facturacion, $cif_facturacion) {
        $data = array(
            'razon_social_facturacion' => $razon_social,
            'direccion_facturacion' => $direccion_facturacion,
            'numero_facturacion' => $numero_facturacion,
            'cp_facturacion' => $cp_facturacion,
            'email_facturacion' => $email_facturacion,
            'periodo_facturacion' => $periodo_facturacion,
            'num_cuenta_facturacion' => $num_cuenta_facturacion,
            'cif_facturacion' => $cif_facturacion,
        );
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $this->db->update('facturacion', $data);
    }

    /* Listado de Planes */

    public function listadoPlanes() {
        $consulta = $this->db->get('planes');
        return $consulta->result();
    }

    /* Edición de los planes contratados asociados a los restaurantes */

    public function editarPlanContratado($id_restaurante, $plan_contratado) {
        $data = array(
            'planes_id_plan' => $plan_contratado,
        );
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
    }

    /* Cupones de descuento */

    public function listadoCuponesRestaurate($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('cupones');
        return $consulta->result();
    }

    public function anadirCupon($id_restaurante, $titulo_cupon, $descripcion_cupon, $fecha_inicio_cupon, $fecha_fin_cupon) {
        $clave = random_string('unique');
        $data = array(
            'clave_cupon' => $clave,
            'titulo_cupon' => $titulo_cupon,
            'descripcion_cupon' => $descripcion_cupon,
            'fecha_inicio_cupon' => $fecha_inicio_cupon,
            'fecha_fin_cupon' => $fecha_fin_cupon,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('cupones', $data);
    }

    public function editarCupon($clave_cupon, $titulo_cupon, $descripcion_cupon, $fecha_inicio_cupon, $fecha_fin_cupon) {
        $data = array(
            'titulo_cupon' => $titulo_cupon,
            'descripcion_cupon' => $descripcion_cupon,
            'fecha_inicio_cupon' => $fecha_inicio_cupon,
            'fecha_fin_cupon' => $fecha_fin_cupon,
        );
        $this->db->where('clave_cupon', $clave_cupon);
        $this->db->update('cupones', $data);
    }

    public function eliminarCupon($clave_cupon) {
        $this->db->where('clave_cupon', $clave_cupon);
        $this->db->delete('cupones');
    }

    /* Relación Restaurador con sus Restaurantes */

    public function listadoMenusRestaurantes($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    public function listadoMenusHabituales($id_menu) {
        $this->db->where('menu_id_menu', $id_menu);
        $consulta = $this->db->get('menu_habituales');
        return $consulta->result();
    }

    public function eliminarMenuHabitual($id_menu_habitual) {

        //Obtenemos el id de la tabla menu
        $this->db->where('id_menu_habitual', $id_menu_habitual);
        $consulta = $this->db->get('menu_habituales');
        $row = $consulta->row();

        //Borramos el registro de snapshot de la tabla menú
        $this->db->where('menu_id_menu', $row->menu_id_menu_snapshot);
        $this->db->delete('entrantes_menu');

        //Borramos el registro de snapshot de la tabla menú
        $this->db->where('menu_id_menu', $row->menu_id_menu_snapshot);
        $this->db->delete('primeros_menu');

        //Borramos el registro de snapshot de la tabla menú
        $this->db->where('menu_id_menu', $row->menu_id_menu_snapshot);
        $this->db->delete('segundos_menu');

        //Borramos el registro de snapshot de la tabla menú
        $this->db->where('menu_id_menu', $row->menu_id_menu_snapshot);
        $this->db->delete('terceros_menu');

        //Borramos el registro de snapshot de la tabla menú
        $this->db->where('id_menu', $row->menu_id_menu_snapshot);
        $this->db->delete('menu');

        //Borramos el registro de la tabla menu_habituales
        $this->db->where('id_menu_habitual', $id_menu_habitual);
        $this->db->delete('menu_habituales');
    }

    //Este método crea un nuevo menú y guardar el nombre y el tipo: {El tipo hace referencia a la estructura}
    public function guardarTipoMenu($id_restaurante, $nombre_menu, $tipo_menu) {
        $data = array(
            'nombre_menu' => $nombre_menu,
            'restaurantes_id_restaurante' => $id_restaurante,
            'tipo_menu_id_tipo_menu' => $tipo_menu,
            'activo_menu' => 1,
        );
        $this->db->insert('menu', $data);
    }

    public function guardarDatosMenu($id_menu, $postre, $bebida, $pan, $cafe, $calendario, $precio, $observaciones) {
        $data = array(
            'postre_menu' => $postre,
            'bebida_menu' => $bebida,
            'pan_menu' => $pan,
            'cafe_menu' => $cafe,
            'precio_menu' => $precio,
            'fecha_dia_menu' => $calendario,
            'observaciones_menu' => $observaciones,
            'fecha_actualizado' => date("Y-m-d H:i:s")
        );
        $this->db->where('id_menu', $id_menu);
        $this->db->update('menu', $data);
    }

    public function guardarMenuHabitualYCrearSnapShot($id_menu, $nombre_menu) {

        //Duplicamos el menú: creamos el snapshot en la tabla menu
        $sql = "INSERT INTO menu
            (nombre_menu, entrantes_menu, postre_menu, bebida_menu, pan_menu, cafe_menu, observaciones_menu, fecha_dia_menu, activo_menu, precio_menu, restaurantes_id_restaurante, tipo_menu_id_tipo_menu, fecha_actualizado)
                SELECT nombre_menu, entrantes_menu, postre_menu, bebida_menu, pan_menu, cafe_menu, observaciones_menu, fecha_dia_menu, activo_menu, precio_menu, restaurantes_id_restaurante, tipo_menu_id_tipo_menu, fecha_actualizado
                FROM menu
                WHERE id_menu = $id_menu";
        $this->db->query($sql);
        $snapshotId = $this->db->insert_id();

        $sql = "INSERT INTO entrantes_menu (nombre_entrante_menu, menu_id_menu)
        SELECT nombre_entrante_menu, $snapshotId
        FROM entrantes_menu
        WHERE menu_id_menu = $id_menu";
        $this->db->query($sql);

        $sql = "INSERT INTO primeros_menu (nombre_primeros_menu, menu_id_menu)
        SELECT nombre_primeros_menu, $snapshotId
        FROM primeros_menu
        WHERE menu_id_menu = $id_menu";
        print $sql;
        $this->db->query($sql);

        $sql = "INSERT INTO segundos_menu (nombre_segundo_menu, menu_id_menu)
        SELECT nombre_segundo_menu, $snapshotId
        FROM segundos_menu
        WHERE menu_id_menu = $id_menu";
        $this->db->query($sql);

        $sql = "INSERT INTO terceros_menu (nombre_tercero_menu, menu_id_menu)
        SELECT nombre_tercero_menu, $snapshotId
        FROM terceros_menu
        WHERE menu_id_menu = $id_menu";
        $this->db->query($sql);

        //Ponemos a 1 el flag de snapshot
        $this->db->where('id_menu', $snapshotId);
        $this->db->update('menu', array('snapshot_menu_habitual_menu' => 1));

        //Guardamos el menú habitual
        $data = array(
            'nombre_menu_habitual' => $nombre_menu,
            'menu_id_menu' => $id_menu,
            'menu_id_menu_snapshot' => $snapshotId
        );
        $this->db->insert('menu_habituales', $data);
    }

    public function existeEntranteEnMenu($id_menu, $nombre_entrante_menu) {
        $this->db->where('menu_id_menu', $id_menu);
        $this->db->like('LOWER(nombre_entrante_menu)', strtolower($nombre_entrante_menu));
        $this->db->from('entrantes_menu');
        return $this->db->count_all_results();
    }

    public function guardarEntrantesMenu($id_menu, $nombre_entrante_menu) {
        $data = array(
            'nombre_entrante_menu' => $nombre_entrante_menu,
            'menu_id_menu' => $id_menu,
        );
        $this->db->insert('entrantes_menu', $data);
    }

    public function existePrimeroEnMenu($id_menu, $nombre_primero_menu) {
        $this->db->where('menu_id_menu', $id_menu);
        $this->db->like('LOWER(nombre_primeros_menu)', strtolower($nombre_primero_menu));
        $this->db->from('primeros_menu');
        return $this->db->count_all_results();
    }

    public function guardarPrimerosMenu($id_menu, $nombre_primeros_menu) {
        $data = array(
            'nombre_primeros_menu' => $nombre_primeros_menu,
            'menu_id_menu' => $id_menu,
        );
        $this->db->insert('primeros_menu', $data);
    }

    public function existeSegundoEnMenu($id_menu, $nombre_segundo_menu) {
        $this->db->where('menu_id_menu', $id_menu);
        $this->db->like('LOWER(nombre_segundo_menu)', strtolower($nombre_segundo_menu));
        $this->db->from('segundos_menu');
        return $this->db->count_all_results();
    }

    public function guardarSegundosMenu($id_menu, $nombre_segundos_menu) {
        $data = array(
            'nombre_segundo_menu' => $nombre_segundos_menu,
            'menu_id_menu' => $id_menu,
        );
        $this->db->insert('segundos_menu', $data);
    }

    public function guardarTercerosMenu($id_menu, $nombre_terceros_menu) {
        $data = array(
            'nombre_tercero_menu' => $nombre_terceros_menu,
            'menu_id_menu' => $id_menu,
        );
        $this->db->insert('terceros_menu', $data);
    }

    public function eliminarMenu($clave) {
        $this->db->where('id_menu', $clave);
        $this->db->delete('menu');
    }

    /* Mirar la tabla menu_estructura para entender estos pasos */
    /*
      public function damePlatosMenuEstructura($id_menu){
      $this->db->where('menu_id_menu', $id_menu);
      $consulta = $this->db->get('menu_estructura');
      return $consulta->result();
      }


      public function anadirPlatoMenuA($id_menu, $primeros_menu_estructura, $segundos_menu_estructura){
      $data = array(
      'primeros_menu_estructura' => $primeros_menu_estructura,
      'segundos_menu_estructura' => $segundos_menu_estructura,
      'menu_id_menu' => $id_menu,
      );
      $this->db->insert('menu_estructura', $data);
      }


      public function anadirPlatoMenuB($id_menu, $entrante_menu_estructura, $primeros_menu_estructura, $segundos_menu_estructura){
      $data = array(
      'entrante_menu_estructura' => $entrante_menu_estructura,
      'primeros_menu_estructura' => $primeros_menu_estructura,
      'segundos_menu_estructura' => $segundos_menu_estructura,
      'menu_id_menu' => $id_menu,
      );
      $this->db->insert('menu_estructura', $data);
      }


      public function anadirPlatoMenuC($id_menu, $entrante_menu_estructura, $plato_principal_menu_estructura){
      $data = array(
      'entrante_menu_estructura' => $entrante_menu_estructura,
      'plato_principal_menu_estructura' => $plato_principal_menu_estructura,
      'menu_id_menu' => $id_menu,
      );
      $this->db->insert('menu_estructura', $data);
      }
     */

    public function editarDatosRestaurante($id_restaurante, $nombre_restaurante, $web_restaurante, $direccion_restaurante, $numero_restaurante, $barrio_restaurante, $precio_medio_restaurante, $parking_restaurante, $tarjetas_restaurante, $reservas_restaurante, $visible_restaurante, $cp_restaurante) {
        $data = array(
            'nombre_restaurante' => $nombre_restaurante,
            'web_restaurante' => $web_restaurante,
            'slug_restaurante' => url_title(strtolower(convert_accented_characters($nombre_restaurante))),
            'direccion_restaurante' => $direccion_restaurante,
            'numero_restaurante' => $numero_restaurante,
            'barrio_restaurante' => $barrio_restaurante,
            'precio_medio_restaurante' => $precio_medio_restaurante,
            'parking_restaurante' => $parking_restaurante,
            'tarjetas_restaurante' => $tarjetas_restaurante,
            'reservas_restaurante' => $reservas_restaurante,
            'visible_restaurante' => $visible_restaurante,
            'cp_restaurante' => $cp_restaurante,
        );
        $this->db->where('clave_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
    }

    public function subirPdf($id_restaurantes, $nombre_documento) {
        $data = array(
            'carta_restaurante' => $nombre_documento,
        );
        $this->db->where('id_restaurante', $id_restaurantes);
        $this->db->update('restaurantes', $data);
    }

    public function editarCategoriasRestaurantes($id_restaurante, $primera_categoria, $segunda_categoria, $tercera_categoria) {
        $data = array(
            'categorias_id_categoria' => $primera_categoria,
            'segunda_categoria_restaurante' => $segunda_categoria,
            'tercera_categoria_restaurante' => $tercera_categoria,
        );
        $this->db->where('clave_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
    }

    public function guardarImagen($id_restaurante, $fileName, $nombre_img_final, $ext) {
        $data = array(
            'nombre_imagen' => $fileName,
            'thumbnails_imagen' => $nombre_img_final,
            'extension_imagen' => $ext,
            'restaurantes_id_restaurante' => $id_restaurante,
        );
        $this->db->insert('imagenes', $data);
    }

    public function listadoImagenes($id_restaurantes) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurantes);
        $consulta = $this->db->get('imagenes');
        return $consulta->result();
    }

    public function getRestauranteData($id_restaurante) {

        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->where('id_restaurante', $id_restaurante);
        $consulta = $this->db->get('restaurantes');
        //var_dump($consulta->result());die;
        return $consulta->row();
    }

    public function getGestorData($id_gestor, $id_localidad = null) {
        if ($id_localidad) {
            $this->db->join('localidades', 'localidades.id_localidad = propietarios.localidades_id_localidad');
            $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        }
        $this->db->where('id_propietario', $id_gestor);
        $consulta = $this->db->get('propietarios');
        return $consulta->result();
    }

    public function getMunicipioYProvinciaByCodigoPostal($cp) {
        $this->db->join('provincias', 'localidades.provincias_id_provincia = provincias.id_provincia');
        $this->db->join('codigo_postal', 'localidades.cp_localidad = codigo_postal.id_codigo_postal');
        $this->db->where('num_codigo_postal', $cp);
        $consulta = $this->db->get('localidades');
        //var_dump($consulta->result());die;
        return $consulta->result();
    }

    public function guardarGestor($id_gestor, $nombre_gestor, $apellidos_gestor, $email_gestor, $password_gestor, $clave_gestor, $telefono_gestor, $cp_gestor, $provincia_gestor, $municipio_gestor) {
        $data = array(
            'clave_propietario' => $clave_gestor,
            'nombre_propietario' => $nombre_gestor,
            'apellidos_propietario' => $apellidos_gestor,
            'email_propietario' => $email_gestor,
            'pass_propietario' => $password_gestor,
            'cp_propietario' => $cp_gestor,
            'telefono_propietario' => $telefono_gestor,
            'actualizado_propietario' => now(),
            'provincias_id_provincia' => $provincia_gestor,
            'localidades_id_localidad' => $municipio_gestor,
            'activo_propietario' => 0
        );
        if ($id_gestor) {
            $this->db->where('id_propietario', $id_gestor);
            $this->db->update('propietarios', $data);
            return $id_gestor;
        } else {
            $this->db->insert('propietarios', $data);
            return $this->db->insert_id();
        }
    }

    public function guardarPropietarioRestaurante($id_restaurante, $id_gestor) {
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', array('propietarios_id_propietario' => $id_gestor));
    }

    //Comprobamos si ya existe el email
    public function existeEmail($email) {
        $this->db->where('email_propietario', $email);
        $this->db->where('activo_propietario', 1);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }

    public function guardarDatosFacturacion($id_restaurante, $razon_social_facturacion, $direccion_facturacion, $numero_facturacion, $cp_facturacion, $municipio_facturacion, $email_facturacion, $cuenta_facturacion) {
        $data = array(
            'restaurantes_id_restaurante' => $id_restaurante,
            'razon_social_facturacion' => $razon_social_facturacion,
            'direccion_facturacion' => $direccion_facturacion,
            'numero_facturacion' => $numero_facturacion,
            'cp_facturacion' => $cp_facturacion,
            'localidades_id_localidad' => $municipio_facturacion,
            'email_facturacion' => $email_facturacion,
            'num_cuenta_facturacion' => $cuenta_facturacion
        );
        $this->db->insert('facturacion', $data);
        return $this->db->insert_id();
    }

    public function guardarPlanRestaurante($id_restaurante, $plan_restaurante) {
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', array('planes_id_plan' => $plan_restaurante));
    }

    public function comprobarRegistroPropietario($clave) {
        $this->db->where('clave_propietario', $clave);
        $consulta = $this->db->get('propietarios');
        return $consulta->row();
    }

    public function activarPropietario($id_propietario) {
        $data = array(
            'activo_propietario' => 1,
        );
        $this->db->where('id_propietario', $id_propietario);
        $this->db->update('propietarios', $data);
    }

    //Recuperamos el password para mandarlo por correo
    public function recordarPassword($email, $password) {

        $this->db->where(array('email_propietario' => $email, 'activo_propietario' => 1));
        $query = $this->db->get('propietarios');

        $result = $query->result_array();
        $id_propietario = false;
        if ($result) {
            $id_propietario = $result[0]['id_propietario'];

            $data = array(
                'pass_propietario' => sha1($password),
            );
            $this->db->where('email_propietario', $email);
            $this->db->where('activo_propietario', 1);
            $this->db->update('propietarios', $data);
        }
        return $id_propietario;
    }

    public function buscarRestaurantesPropietarios($nombre_restaurante, $id_propietario) {

        $this->db->join('localidades', 'localidades.id_localidad = restaurantes.localidades_id_localidad');
        $this->db->join('provincias', 'provincias.id_provincia = localidades.provincias_id_provincia');
        $this->db->join('categorias', 'restaurantes.categorias_id_categoria = categorias.id_categoria', 'left');
        $this->db->where('propietarios_id_propietario', $id_propietario);
        $this->db->like('LOWER(nombre_restaurante)', strtolower($nombre_restaurante));
        $consulta = $this->db->get('restaurantes');
        return $consulta->result();
    }

    public function obtenerTipoMenus($id_restaurante) {
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $this->db->where('snapshot_menu_habitual_menu', 0);
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    public function obtenerMenusCompletos($id_restaurante) {
        $this->db->join('primeros_menu', 'primeros_menu.menu_id_menu = menu.id_menu');
        $this->db->join('segundos_menu', 'segundos_menu.menu_id_menu = menu.id_menu');
        $this->db->where('restaurantes_id_restaurante', $id_restaurante);
        $consulta = $this->db->get('menu');
        return $consulta->result();
    }

    public function seleccionarMenuHabitual($id_menu_habitual) {
        $this->db->join('menu_habituales', 'menu.id_menu = menu_habituales.menu_id_menu_snapshot');
        $this->db->where('menu_habituales.id_menu_habitual', $id_menu_habitual);
        $this->db->where('menu.snapshot_menu_habitual_menu', 1);
        $consulta = $this->db->get('menu');
        return $consulta->row();
    }

    public function vaciarEntrantesEnMenu($id_menu = null) {
        $this->db->where('menu_id_menu', $id_menu);
        $this->db->delete('entrantes_menu');
    }

    public function vaciarPrimerosEnMenu($id_menu = null) {
        $this->db->where('menu_id_menu', $id_menu);
        $this->db->delete('primeros_menu');
    }

    public function vaciarSegundosEnMenu($id_menu = null) {
        $this->db->where('menu_id_menu', $id_menu);
        $this->db->delete('segundos_menu');
    }

    public function editarDatosPropietario($id_propietario, $campo, $contenido) {
        $data = array(
            $campo => $contenido
        );
        $this->db->where('id_propietario', $id_propietario);
        $this->db->update('propietarios', $data);
        return $this->db->affected_rows();
    }

    public function actualizarEmail($id_propietario) {
        $sql = "UPDATE propietarios SET email_propietario = nuevo_email_propietario where id_propietario='$id_propietario'";
        $this->db->query($sql);
    }

    public function actualizarClave($id_propietario, $nueva_clave) {
        $data = array(
            'clave_propietario' => $nueva_clave
        );
        $this->db->where('id_propietario', $id_propietario);
        $this->db->update('propietarios', $data);
    }

    public function editarRestaurante($id_restaurante, $campo, $contenido) {
        $data = array(
            $campo => $contenido
        );
        //var_dump($data);war_dump($id_restaurante);
        $this->db->where('id_restaurante', $id_restaurante);
        $this->db->update('restaurantes', $data);
        return $this->db->affected_rows();
    }

}
