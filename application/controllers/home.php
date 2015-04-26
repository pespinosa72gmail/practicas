<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('valoraciones_model');
        $this->breadcrumbs->push('Home', '/');
    }

    public function index() {

        //debug
        $this->output->enable_profiler(TRUE);

        $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
        $datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();

        $id_usuario = $this->session->userdata('id_usuario');



        /*      Restaurantes Destacados     */

        if ($id_usuario) {
            /* Restaurantes Destacados con usuario logado */
            $datos['destacadoRestaurantes'] = $this->home_model->logadoDestacadoRestaurante($id_usuario);

            //Si no hay restaurantes destacados, se muestran los últimos dados de alta con usuario logado
            if (!$datos['destacadoRestaurantes']) {
                $datos['destacadoRestaurantes'] = $this->home_model->logadoListRestaurantes($id_usuario);
            }
        } else {
            /* Restaurantes Destacados */
            $datos['destacadoRestaurantes'] = $this->home_model->obtenerDestacadoRestaurante();

            //Si no hay restaurantes destacados, se muestran los últimos dados de alta
            if (!$datos['destacadoRestaurantes']) {
                $datos['destacadoRestaurantes'] = $this->home_model->obtenerListRestaurantes();
            }
        }

        //Añadir valoraciones
        //$datos['valoracionDestacados'] = array();
        foreach ($datos['destacadoRestaurantes'] as $destacado) {
            $datos['valoracionDestacados'][] = $this->valoraciones_model->mediaValoracionRestaurante($destacado->id_restaurante);
        }

        //Obtenemos el menú más actualizado de cada restaurante destacado
        foreach ($datos['destacadoRestaurantes'] as $restaurante) {
            //$datos['listadoRestaurantes'] = $this->home_model->obtenerListRestaurantes($id_usuario);
            //var_dump($datos['listadoRestaurantes']);
            $datos['listadoRestaurantes'][] = $this->home_model->listadoMenus($restaurante->id_restaurante);
        }
        //Obtenemos los platos de los menús
        foreach ($datos['listadoRestaurantes'] as $todoslosplatos) {
            $datos['listadoPrimeros'][] = $this->home_model->listadoPrimeros($todoslosplatos[0]->id_menu);
            $datos['listadoSegundos'][] = $this->home_model->listadoSegundos($todoslosplatos[0]->id_menu);
            $datos['listadoTerceros'][] = $this->home_model->listadoTerceros($todoslosplatos[0]->id_menu);
        }

        /*      Restaurantes Destacados     */



        /* Menús de tus Restaurantes Favoritos */

        //Para usuario logados
        if ($this->session->userdata('ingresado') == TRUE && $this->session->userdata('usuario') == TRUE) {


            $datos['obtenerRestauranteFavoritos'] = $this->home_model->obtenerRestauranteFavoritos($id_usuario);

            //Si el usuario tiene marcados restaurantes favoritos
            if ($datos['obtenerRestauranteFavoritos']) {

                foreach ($datos['obtenerRestauranteFavoritos'] as $key => $value) {
                    $datos['listadoMenusFavoritos'][] = $this->home_model->listadoMenus($value->id_restaurante);
                }

                foreach ($datos['listadoMenusFavoritos'] as $key => $menu) {
                    $datos['listadoPrimerosFavoritos'][] = $this->home_model->listadoPrimerosFavoritos($menu[0]->id_menu);
                    $datos['listadoSegundosFavoritos'][] = $this->home_model->listadoSegundosFavoritos($menu[0]->id_menu);
                    $datos['listadoTercerosFavoritos'][] = $this->home_model->listadoTercerosFavoritos($menu[0]->id_menu);
                }

                //Para usuario que no tengan marcados restaurantes favoritos
            } else {

                $datos['obtenerRestauranteFavoritos'] = $this->home_model->obtenerRestaurantesMejorValorados();

                foreach ($datos['obtenerRestauranteFavoritos'] as $key => $value) {
                    $datos['listadoMenusFavoritos'][] = $this->home_model->listadoMenus($value->id_restaurante);
                }

                foreach ($datos['listadoMenusFavoritos'] as $key => $menu) {
                    $datos['listadoPrimerosFavoritos'][] = $this->home_model->listadoPrimerosFavoritos($menu[0]->id_menu);
                    $datos['listadoSegundosFavoritos'][] = $this->home_model->listadoSegundosFavoritos($menu[0]->id_menu);
                    $datos['listadoTercerosFavoritos'][] = $this->home_model->listadoTercerosFavoritos($menu[0]->id_menu);
                }
            }

            //Para la home deslogada
        } else {//if ($this->session->userdata('ingresado') == TRUE && $this->session->userdata('usuario') == TRUE) {
            //Favoritos no logados: restaurantes mejor valorados
            $datos['obtenerRestauranteFavoritos'] = $this->home_model->obtenerRestaurantesMejorValorados();
            if ($datos['obtenerRestauranteFavoritos']) {

                foreach ($datos['obtenerRestauranteFavoritos'] as $key => $restaurante) {
                    $datos['listadoMenusFavoritos'][] = $this->home_model->listadoMenus($restaurante->id_restaurante);
                }

                foreach ($datos['listadoMenusFavoritos'] as $key => $restaurante) {
                    //Si el restaurante tiene menú asociado
                    $datos['listadoPrimerosFavoritos'][] = $this->home_model->listadoPrimerosFavoritos($restaurante[0]->id_menu);
                    $datos['listadoSegundosFavoritos'][] = $this->home_model->listadoSegundosFavoritos($restaurante[0]->id_menu);
                    $datos['listadoTercerosFavoritos'][] = $this->home_model->listadoTercerosFavoritos($restaurante[0]->id_menu);
                }
            }
        }
        /*      Restaurantes Favoritos     */


        /* Menus con platos que te gustan o en tu zona */
        if ($id_usuario) {
            $datos['listadoRestaurantesDerecha'] = $this->home_model->loginListadoRestaurantes($id_usuario);
        } else {
            $datos['listadoRestaurantesDerecha'] = $this->home_model->obtenerListadoRestaurantes();
        }

        if ($datos['listadoRestaurantesDerecha']) {

            foreach ($datos['listadoRestaurantesDerecha'] as $key => $restaurante) {
                $datos['listadoMenusDerecha'][] = $this->home_model->listadoMenus($restaurante->id_restaurante);
                $datos['mediaValoracionDerecha'][] = $this->valoraciones_model->mediaValoracionRestaurante($restaurante->id_restaurante);
            }

            foreach ($datos['listadoMenusDerecha'] as $key => $restaurante) {
                //Si el restaurante tiene menú asociado
                $datos['listadoPrimerosDerecha'][] = $this->home_model->listadoPrimerosFavoritos($restaurante[0]->id_menu);
                $datos['listadoSegundosDerecha'][] = $this->home_model->listadoSegundosFavoritos($restaurante[0]->id_menu);
                $datos['listadoTercerosDerecha'][] = $this->home_model->listadoTercerosFavoritos($restaurante[0]->id_menu);
            }
        }
        /* Menus con platos que te gustan o en tu zona */

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "index";
        $this->load->view('plantillas/plantilla', $datos);
    }

    public function sobreTodosLosMenus() {
        $this->breadcrumbs->push('Sobre Todoslosmenus', '/home/sobreTodosLosMenus');

        $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
        $datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "sobre-todoslosmenus";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function eresRestaurador() {
        $this->breadcrumbs->push('¿Eres restaurador?', '/home/sobreTodosLosMenus');

        $datos['listadoCategorias'] = $this->home_model->obtenerListCatego();
        $datos['listadoProvincias'] = $this->home_model->listadoProvincias();
        $datos['listadoEstaciones'] = $this->home_model->listadoEstaciones();

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "eres-restaurador";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function faqs() {
        $this->breadcrumbs->push('Faqs', '/home/faqs');

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "faqs";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function franquiciate() {
        $this->breadcrumbs->push('Franquíciate', '/home/franquiciate');

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "franquiciate";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function contactanos() {
        $this->breadcrumbs->push('Contáctanos', '/home/contactanos');

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "contacta";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function clubTLM() {
        $this->breadcrumbs->push('Club TLM', '/home/contactanos');

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "club-tlm";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function completaLocalidades() {
        //$this->output->enable_profiler(TRUE);
        if ($this->input->get_post('provincia')) {
            $provincia = $this->input->get_post('provincia');
            $localidades = $this->home_model->listadoLocalidades($provincia);
        } else {
            //Si no viene la provincia, la sacamos de la localidad
            $localidades = $this->home_model->listadoLocalidadesByLocalidad($this->input->get_post('localidad'));
        }
        ?>
        <option>Municipio</option>
        <?php
        foreach ($localidades as $key => $value) {
            ?>
            <option value="<?php echo $value->id_localidad; ?>" <?php echo $this->input->get_post('localidad') == $value->id_localidad ? 'selected' : '' ?>><?php echo $value->nombre_localidad . " (" . $value->cp_localidad . ")"; ?></option>
            <?php
        }
    }

    public function googleVerfycation() {
        echo "google-site-verification: google162d7bd3d4bb5ccd.html";
    }

}
