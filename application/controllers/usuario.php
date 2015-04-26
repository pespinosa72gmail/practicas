<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('restaurador_model');
        $this->load->model('franquiciado_model');
        $this->load->model('footer_model');

        $this->breadcrumbs->push('Home', '/');
    }

    public function index() {
        if ($this->session->userdata('ingresado') == TRUE) {

            $this->breadcrumbs->push('Panel usuario', '/usuario/index');

            $datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();
            $id_usuario = $this->session->userdata('id_usuario');
            $datos['datosUsuario'] = $this->usuario_model->datoDatoUsario($id_usuario);
            //$datos['restauranteFavorito'] = $this->usuario_model->dameRestauranteFavorito($id_usuario);
            //$datos['platosFavoritos'] = $this->usuario_model->dameEspecialidades($id_usuario);

            //$datos['dameNumPlatoFavoritos'] = $this->usuario_model->dameNumPlatoFavoritos($id_usuario);
            //$datos['dameNumRestaurantesFavoritos'] = $this->usuario_model->dameNumRestaurantesFavoritos($id_usuario);

            //$datos['dameListadoCpFavoritos'] = $this->usuario_model->dameListadoCpFavoritos($id_usuario);

            $datos['dameDatosUsuarioTLM'] = $this->usuario_model->dameDatosUsuarioTLM($id_usuario);

            /*
              echo "<pre>";
              print_r($datos['restauranteFavorito']);
              die();
              echo "</pre>";
             */

            $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
            $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
            $datos['robots'] = "NOINDEX, NOFOLLOW";
            $datos['contenido'] = "panel-usuario";
            $this->load->view('plantillas/plantilla2', $datos);
        } else {
            redirect(base_url());
        }
    }

    /* Acciones de registro */

    //Formulario de Registro
    public function vistaRegistroUsuario() {
        $this->breadcrumbs->push('Registro de usuario', '/usuario/index');

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "registro-usuario";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    /* Cuando un usuario se registra por primera vez, se le envía un email */

    public function enviarEmailUsuario($email, $clave) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = 'Estimado usuario tienes que confirmar tu cuenta para poder logarte <br /><br />' . base_url() . 'confirmar-registro-usuario/?id=' . $clave;

        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to($email);
        $this->email->subject('Alta de usuario');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    //Action del formulario de registro
    public function registrarUsuario() {
        //Campos del formulario
        $nombre = $this->input->post('nombre_usuario', TRUE);
        $apellidos = $this->input->post('apellidos_usuario', TRUE);
        $cp = $this->input->post('cp_usuario', TRUE);
        $email = $this->input->post('email_usuario', TRUE);
        $password = sha1($this->input->post('password_usuario'));
        $clave = random_string('unique');
        $fecha_nacimiento = $this->input->post('fecha_nacimiento', TRUE);
        //Campos TLM
        $tlm = $this->input->post('tlm', TRUE);
        $email_adicional = $this->input->get_post('email_adicional_usuario', TRUE);
        $dia_adicional = $this->input->get_post('dia_usuario_nacimiento', TRUE);
        $mes_adicional = $this->input->get_post('mes_usuario_nacimiento', TRUE);
        $ano_adicional = $this->input->get_post('ano_usuario_nacimiento', TRUE);
        $sexo = $this->input->get_post('sexo_usuario_tlm', TRUE);
        $porque_tlm_a = $this->input->get_post('respuesta_a', TRUE);
        $porque_tlm_b = $this->input->get_post('respuesta_b', TRUE);

        //Si existe el usuario devolvemos error
        if ($this->usuario_model->existeEmail($email) || $this->restaurador_model->existeEmail($email) || $this->franquiciado_model->existeEmail($email)) {
            echo "Ya tenemos un usuario con ese e-mail";
            return;
        }
        $this->usuario_model->registroUsuario($nombre, $apellidos, $cp, $email, $password, $clave, $fecha_nacimiento, $tlm, $email_adicional, $dia_adicional, $mes_adicional, $ano_adicional, $sexo, $porque_tlm_a, $porque_tlm_b);
        $this->enviarEmailUsuario($email, $clave);

        echo "Registro realizado correctamente";
    }

    public function registroRealizado() {
        $this->breadcrumbs->push('Registro de usuario', '/usuario/vistaRegistroUsuario');
        $this->breadcrumbs->push('Registro realizado', '/usuario/registroRealizado');
        $datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();

        $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
        $datos['robots'] = "NOINDEX, NOFOLLOW";
        $datos['contenido'] = "registro-realizado";
        $this->load->view('plantillas/plantilla2', $datos);
    }

    public function comprobarRegistro() {
        $datos['obtenerUltimosRestaurantes'] = $this->footer_model->obtenerUltimosRestaurantes();

        $clave = $this->input->get_post('id');
        $comprueba = $this->usuario_model->comprobarRegistroUsuario($clave);

        if ($comprueba) {

            $activarUsuario = $this->usuario_model->activarUsuario($comprueba->id_usuario);

            /* Realizamos el login del usuario. */
            $email = $comprueba->email_usuario;
            $pass = $comprueba->pass_usuario;

            $comprobar_login = $this->usuario_model->login_user($email, $pass);

            if ($comprobar_login) {
                $data = array(
                    'id_usuario' => $comprobar_login->id_usuario,
                    'clave_usuario' => $comprobar_login->clave_usuario,
                    'nombre_usuario' => $comprobar_login->nombre_usuario,
                    'email_usuario' => $comprobar_login->email_usuario,
                    'usuario' => TRUE,
                    'ingresado' => TRUE,
                );
                $this->session->set_userdata($data);
            }

            $datos['title'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
            $datos['description'] = "Todoslosmenus.com - ¿Qué comerás hoy?";
            $datos['robots'] = "NOINDEX, NOFOLLOW";
            $datos['contenido'] = "confirmar-registro-usuario";
            $this->load->view('plantillas/plantilla2', $datos);
        } else {
            redirect(base_url('registro-usuario'));
        }
    }

    /*     * ********************* */









    /* Acciones con los datos del usuario */

    /* función anterior
	public function editarDatosUsuario() {
        if ($this->session->userdata('ingresado') !== FALSE) {

            $id_usuario = $this->session->userdata('id_usuario');

            $nombre = $this->input->get_post('nombre_usuario', TRUE);
            $apellidos = $this->input->get_post('apellidos_usuario', TRUE);
            $email = $this->input->get_post('email_usuario', TRUE);
            $localidad = $this->input->get_post('localidad_usuario', TRUE);
            $cp = $this->input->get_post('cp_usuario', TRUE);

            $editarDatosUsuario = $this->usuario_model->editarDatosUsuario($id_usuario, $nombre, $apellidos, $email, $localidad, $cp);
        } else {
            
        }
    }*/
	public function editarDatosUsuario() {
		$id_usuario = $this->session->userdata('id_usuario');
		$campo = $this->input->get_post('campo');
		$contenido = $this->input->get_post('contenido');
		if($campo == 'pass_usuario'){
			$contenido = sha1($contenido);
		}
        $afftectedRows = $this->usuario_model->editarDatosUsuario($id_usuario, $campo, $contenido);
		echo $afftectedRows;
	}
	
    public function modificarCorreo() {
		$id_usuario = $this->session->userdata('id_usuario');
        $email = $this->input->post('correo_usuario', TRUE);

        //Si existe el usuario devolvemos error
        if ($this->usuario_model->existeEmail($email) || $this->restaurador_model->existeEmail($email) || $this->franquiciado_model->existeEmail($email)) {
            echo "Ya tenemos un usuario con ese e-mail";
            return;
        }
		
		$obtenerClave = $this->usuario_model->datoDatoUsario($id_usuario);
		
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $mensaje = 'Estimado usuario tienes que confirmar tu cuenta para poder logarte <br /><br />' . base_url() . 'confirmar-registro-usuario/?id=' . $obtenerClave->clave_usuario;
        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to($email);
        $this->email->subject('Confirmación de cambio de e-mail de usuario');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        if(!$this->email->send()){
			echo "No pudimos enviar el e-mail de confirmación, por favor vuelva a intentarlo.";
			return;
		}

        $afftectedRows = $this->usuario_model->modificarCorreo($id_usuario, $email);
		$afftectedRows;
        if($afftectedRows){
			echo "Correo modificado correctamente. Por favor confirme su correo pinchando en el enlace que acabamos de mandarle a su nuevo e-mail.";
		}else{
			echo "No se pudo modificar correctamente su correo, por favor vuelva a intentarlo.";
		}
    }

    /*     * *********************************** */










    /* Acciones para Restaurantes - Panel de Control de Usuario */

    public function restaurantesFavoritos() {
		$id_usuario = $this->session->userdata('id_usuario');

		$resultado = '';
		$restaurantes_duplicados = '';
		$consulta = $this->usuario_model->restaurantesFavoritos($id_usuario);
		
		foreach($consulta as $value) {
			$resultado .= '<div class="col-md-9 nodosfilas">';
			$resultado .= '		<div class="form-input">';
			$resultado .= '			<i class="fa fa-cutlery"></i>';
			$resultado .= '			<input type="text" value="' . $value->nombre_restaurante . '" disabled />';
			$resultado .= '		</div>';
			$resultado .= '</div>';
			$resultado .= '<div class="col-md-3 nodosfilas">';
			$resultado .= '		<div class="form-input">';
			$resultado .= '			<div class="callout-a"><a href="javascript:borrarRestFav(' . $value->id_rest_favorito . ');" class="button-3">Eliminar</a></div>';
			$resultado .= '		</div>';
			$resultado .= '</div>';
			$restaurantes_duplicados .= '-r-' . $value->restaurantes_id_restaurante . '-r-';
		}
		
		$resultado .= 'separadorsplit';
		
		$resultado .= $restaurantes_duplicados;
		
		$resultado .= 'separadorsplit';
			
		if(count($consulta) < 5){	
			$resultado .= '<hr class="bordepunteadogris">';
			$resultado .= '<form method="post" id="buscarRestauranteFavorito">';
			$resultado .= '		<div class="col-md-9 nodosfilas">';
			$resultado .= '			<div class="form-input">';
			$resultado .= '				<i class="fa fa-cutlery"></i>';
			$resultado .= '				<input type="text" name="buscar_restaurante" id="buscar_restaurante" Placeholder="Nombre de restaurante" />';
			$resultado .= '			</div>';
			$resultado .= '		</div>';
			$resultado .= '		<div class="col-md-3 nodosfilas">';
			$resultado .= '			<div class="form-input">';
			$resultado .= '				<div class="callout-a ">';
			$resultado .= '					<a href="#" class="button-3" id="btnBuscarRestaurantes">Buscar</a>';
			$resultado .= '				</div>';
			$resultado .= '			</div>';
			$resultado .= '		</div>';
			$resultado .= '</form>';
		}
        echo $resultado;
    }
	
    public function buscarRestauranteFavorito() {
		$buscar_restaurante = $this->input->post('buscar_restaurante');
		$resultado = $this->usuario_model->buscarRestauranteFavorito($buscar_restaurante);

		$pintarRestaurantes = '';
		foreach ($resultado as $key => $value) {
			$pintarRestaurantes .= '
				<li>
					<div class="row">
						<div class="col-md-2 nodosfilas ocultar">
							<img alt="" src="./assets/images/restaurantes/00002_Restaurante02/principal.jpg">
						</div>
						<div class="col-md-6 nodosfilas convertir8">
							<div><strong>Nombre</strong>: ' . $value->nombre_restaurante . '</div>
							<div><strong>Dirección</strong>: ' . $value->direccion_restaurante . ', ' . $value->numero_restaurante . ' (' . $value->nombre_localidad . ')</div>
							<div><strong>Categoría</strong>: Mediterránea</div>
							<div><strong>Precio menú</strong>: ' . $value->precio_medio_restaurante . '€</div>
						</div>
						<div class="col-md-4 nodosfilas">
							<div class="enlacesencillo">
								<a href="javascript:addRestFav(' . $value->id_restaurante . ');">Seleccionar
									<span><i class="fa fa-arrow-circle-right"></i></span>
								</a>
							</div>
						</div>
					</div>
				</li>
			';
		}
		
		if($pintarRestaurantes == ''){
			$pintarRestaurantes .= '<div class="clear"></div><div class="col-md-12"><div align="center"><i class="fa fa-info-circle"></i>&nbsp;No se encontraron restaurantes con ese nombre</div></div>';
		}else{
			$pintarRestaurantes = '<div class="clear"></div><div class="col-md-12"><ul class="restaurantesfavoritos_seleccion">' . $pintarRestaurantes . '</ul></div>';
		}
		
		echo $pintarRestaurantes;
    }

    public function anadirRestauranteFavorito() {
		$id_usuario = $this->session->userdata('id_usuario', TRUE);
		$id_restaurante = $this->input->get_post('id_rest_fav', TRUE);

		$afftectedRows = $this->usuario_model->addRestauranteFavorito($id_usuario, $id_restaurante);
        echo $afftectedRows;
    }
	
    public function eliminarRestauranteFavorito() {
		$id_usuario = $this->session->userdata('id_usuario');
		$id_rest_fav = $this->input->get_post('id_rest_fav');

		$afftectedRows = $this->usuario_model->borrarRestauranteFavorito($id_usuario, $id_rest_fav);
		echo $afftectedRows;
    }

    /*     * *************************** */


    /* Acciones para platos - Panel de Control de Usuario */

    public function platosPreferidos() {
		$id_usuario = $this->session->userdata('id_usuario');

		$resultado = '';
		$platos_duplicados = '';
		$consulta = $this->usuario_model->dameEspecialidades($id_usuario);
		
		foreach($consulta as $value) {
			$resultado .= '<div class="col-md-9 nodosfilas">';
			$resultado .= '		<div class="form-input">';
			$resultado .= '			<i class="fa fa-cutlery"></i>';
			$resultado .= '			<input type="text" value="' . $value->nombre_plato_favorito . '" disabled />';
			$resultado .= '		</div>';
			$resultado .= '</div>';
			$resultado .= '<div class="col-md-3 nodosfilas">';
			$resultado .= '		<div class="form-input">';
			$resultado .= '			<div class="callout-a"><a href="javascript:eliminarPlato(' . $value->id_plato_favorito . ');" class="button-3">Eliminar</a></div>';
			$resultado .= '		</div>';
			$resultado .= '</div>';
			
			$platos_duplicados .= '-r-' . $value->nombre_plato_favorito . '-r-';
		}
		
		$resultado .= 'separadorsplit';
		
		$resultado .= $platos_duplicados;
		
		$resultado .= 'separadorsplit';
			
		if(count($consulta) < 5){	
			$resultado .= '<hr class="bordepunteadogris">';
			$resultado .= '<form method="post" id="addPlatoFavorito">';
			$resultado .= '		<div class="col-md-9 nodosfilas">';
			$resultado .= '			<div class="form-input">';
			$resultado .= '				<i class="fa fa-cutlery"></i>';
			$resultado .= '				<input type="text" name="nombre_nuevo_plato" id="nombre_nuevo_plato" Placeholder="Introduce un nuevo plato" />';
			$resultado .= '			</div>';
			$resultado .= '		</div>';
			$resultado .= '		<div class="col-md-3 nodosfilas">';
			$resultado .= '			<div class="form-input">';
			$resultado .= '				<div class="callout-a ">';
			$resultado .= '					<a href="#" class="button-3" id="btnAddPlatoFavorito">Añadir</a>';
			$resultado .= '				</div>';
			$resultado .= '			</div>';
			$resultado .= '		</div>';
			$resultado .= '</form>';
		}
        echo $resultado;
    }

    public function anadirPlatoFavorito() {
		$id_usuario = $this->session->userdata('id_usuario');
        $nombre_plato = $this->input->get_post('nombre_plato');

		$afftectedRows = $this->usuario_model->anadirPlatoFavorito($id_usuario, $nombre_plato);
        echo $afftectedRows;
    }

    public function eliminarPlatoFavorito() {
		$id_usuario = $this->session->userdata('id_usuario');
		$id_plato = $this->input->get_post('id_preferido');

		$afftectedRows = $this->usuario_model->eliminarPlatoFavorito($id_usuario, $id_plato);
		echo $afftectedRows;
    }

    /*     * ********************** */

    /* Acciones para añadir los CP Favoritos/Zona - Panel de Control de Usuario */

    public function cpFavoritos() {
		$id_usuario = $this->session->userdata('id_usuario');

		$resultado = '';
		$cp_duplicados = '';
		$consulta = $this->usuario_model->cpFavoritos($id_usuario);
		
		foreach($consulta as $value) {
			$resultado .= '<div class="col-md-9 nodosfilas">';
			$resultado .= '		<div class="form-input">';
			$resultado .= '			<i class="fa fa-cutlery"></i>';
			$resultado .= '			<input type="text" value="' . $value->nombre_cp_favorito . '" disabled />';
			$resultado .= '		</div>';
			$resultado .= '</div>';
			$resultado .= '<div class="col-md-3 nodosfilas">';
			$resultado .= '		<div class="form-input">';
			$resultado .= '			<div class="callout-a"><a href="javascript:eliminarCP(' . $value->id_cp_favorito . ');" class="button-3">Eliminar</a></div>';
			$resultado .= '		</div>';
			$resultado .= '</div>';
			$cp_duplicados .= '-r-' . $value->nombre_cp_favorito . '-r-';
		}
		
		$resultado .= 'separadorsplit';
		
		$resultado .= $cp_duplicados;
		
		$resultado .= 'separadorsplit';
			
		if(count($consulta) < 2){	
			$resultado .= '<hr class="bordepunteadogris">';
			$resultado .= '<form method="post" id="addCPFavorito">';
			$resultado .= '		<div class="col-md-9 nodosfilas">';
			$resultado .= '			<div class="form-input">';
			$resultado .= '				<i class="fa fa-cutlery"></i>';
			$resultado .= '				<input type="text" name="nuevo_cp" id="nuevo_cp" Placeholder="Introduce un nuevo CP" />';
			$resultado .= '			</div>';
			$resultado .= '		</div>';
			$resultado .= '		<div class="col-md-3 nodosfilas">';
			$resultado .= '			<div class="form-input">';
			$resultado .= '				<div class="callout-a ">';
			$resultado .= '					<a href="#" class="button-3" id="btnAnadirCPFavorito">Añadir</a>';
			$resultado .= '				</div>';
			$resultado .= '			</div>';
			$resultado .= '		</div>';
			$resultado .= '</form>';
		}
        echo $resultado;
    }

    public function anadirCPFavorito() {
		$id_usuario = $this->session->userdata('id_usuario');
        $nuevo_cp = $this->input->get_post('nuevo_cp');

		$afftectedRows = $this->usuario_model->addCpFavorito($id_usuario, $nuevo_cp);
        echo $afftectedRows;
    }

    public function eliminarCPFavorito() {
		$id_usuario = $this->session->userdata('id_usuario');
		$id_cp = $this->input->get_post('id_cp');

		$afftectedRows = $this->usuario_model->deleteCpFavorito($id_usuario, $id_cp);
		echo $afftectedRows;
    }

    /* Club TLM usuario */

    public function editarDatosTLMUsuario() {

        if ($this->session->userdata('ingresado') == TRUE) {

            $id_usuario = $this->session->userdata('id_usuario');
            $email_adicional = $this->input->get_post('email_usuario_tlm', TRUE);
            $dia_cumpleanos_usuario = $this->input->get_post('dia_cumpleanos_usuario', TRUE);
            $mes_cumpleanos_usuario = $this->input->get_post('mes_cumpleanos_usuario', TRUE);
            $ano_cumpleanos_usuario = $this->input->get_post('ano_cumpleanos_usuario', TRUE);
            $sexo = $this->input->get_post('sexo_usuario_tlm', TRUE);
            $respuesta_a = $this->input->get_post('pregunta_tlm_a', TRUE);
            $respuesta_b = $this->input->get_post('pregunta_tlm_b', TRUE);



            $afftectedRows = $this->usuario_model->editarDatosTLMUsuario($id_usuario, $email_adicional, $dia_cumpleanos_usuario, $mes_cumpleanos_usuario, $ano_cumpleanos_usuario, $sexo, $respuesta_a, $respuesta_b);
			echo $afftectedRows;
        } else {
            redirect(base_url());
        }
    }

    /* Mensaje del usuario a Soporte Técnico - Panel de control de usuario */
	
    public function mensajeSoporteTecnico() {
		$id_usuario = $this->session->userdata('id_usuario');
        $texto_mensaje_soporte = $this->input->post('texto_mensaje_soporte', TRUE);
		
		$datosUsuario = $this->usuario_model->datoDatoUsario($id_usuario);
		
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $mensaje = 'El usuario <b>' . $datosUsuario->nombre_usuario . ' ' . $datosUsuario->apellidos_usuario . '</b> a enviado el siguiente mensaje a soporte técnico:<br /><br />' . $texto_mensaje_soporte;
        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to('pespinosa72@gmail.com');
        $this->email->subject('Mensaje de Usuario a Soporte Técnico');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        if($this->email->send()){
			echo "Mensaje enviado correctamente, muchas gracias.";
		}else{
			echo "No pudimos enviar el e-mail de confirmación, por favor vuelva a intentarlo.";
		}
    }

    /*     * ***************** */


    /* Sistema de Login para el usuario */

    public function loginUsuario() {
        $email = $this->input->get_post('email_user', TRUE);
        $pass = sha1($this->input->get_post('pass_user', TRUE));
        $remember = $this->input->get_post('remember', TRUE);

        if ($email && $pass) {

            $comprobar_login = $this->usuario_model->login_user($email, $pass);
            $comprobar_login_propietario = $this->loginRestaurador($email, $pass);
            $comprobar_login_franquiciado = $this->loginFranquiciado($email, $pass);

            //Si los datos del formulario se validan contra alguna de las 3 tablas: usuario, propietarios, franquiciados...
            if ($comprobar_login || $comprobar_login_propietario || $comprobar_login_franquiciado) {

                if ($remember) {
                    //Estas cookies duran un año
                    $cookie = array(
                        'name' => 'email',
                        'value' => $email,
                        'expire' => time() + 60 * 60 * 24 * 365,
                        'domain' => '.todoslosmenus.com',
                        'path' => '/',
                    );
                    $this->input->set_cookie($cookie);
                    $cookie = array(
                        'name' => 'password',
                        'value' => $pass,
                        'expire' => time() + 60 * 60 * 24 * 365,
                        'domain' => '.todoslosmenus.com',
                        'path' => '/',
                    );
                    $this->input->set_cookie($cookie);
                } else {
                    //Estas cookies expiran cuando se cierra el navegador
                    //Estas cookies duran un año
                    $cookie = array(
                        'name' => 'email',
                        'value' => $email,
                        'expire' => 0,
                        'domain' => '.todoslosmenus.com',
                        'path' => '/',
                    );
                    $this->input->set_cookie($cookie);
                    $cookie = array(
                        'name' => 'password',
                        'value' => $pass,
                        'expire' => 0,
                        'domain' => '.todoslosmenus.com',
                        'path' => '/',
                    );
                    $this->input->set_cookie($cookie);
                }

                if ($comprobar_login) {

                    $data = array(
                        'id_usuario' => $comprobar_login->id_usuario,
                        'clave_usuario' => $comprobar_login->clave_usuario,
                        'nombre_usuario' => $comprobar_login->nombre_usuario,
                        'usuario' => TRUE,
                        'ingresado' => TRUE
                    );
                    $this->session->set_userdata($data);
                    echo '1';
                } else if ($comprobar_login_propietario) {
                    echo '2';
                } else if ($comprobar_login_franquiciado) {
                    echo '3';
                }
            } else {
                echo "KO";
            }
        }
    }

//Fin loginUsuario

    public function loginRestaurador($email, $password) {
        $compruebaPropietario = $this->restaurador_model->compruebaRestaurador($email, $password);
        if ($compruebaPropietario) {
            $data = array(
                'id_propietario' => $compruebaPropietario->id_propietario,
                'nombre_propietario' => $compruebaPropietario->nombre_propietario,
                'restaurador' => TRUE,
                'ingresado' => TRUE
            );
            $this->session->set_userdata($data);
            return $compruebaPropietario;
        }
    }

//Fin loginRestaurador

    public function loginFranquiciado($email, $password) {
        $compruebaFranquiciado = $this->franquiciado_model->compruebaFranquiciado($email, $password);
        if ($compruebaFranquiciado) {
            $data = array(
                'id_franquicia' => $compruebaFranquiciado->id_franquicia,
                'nombre_franquiciado' => $compruebaFranquiciado->nombre_franquiciado,
                'franquiciado' => TRUE,
                'ingresado' => TRUE
            );
            $this->session->set_userdata($data);
            return $compruebaFranquiciado;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->helper('cookie');
        delete_cookie('email','todoslosmenus.com', '/');
        delete_cookie('password','todoslosmenus.com', '/');
        redirect(base_url());
    }

    /*     * ********************************** */

    public function existeEmail() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {
            $email = $this->input->post('email');
            $existe = 'no';
            if ($this->usuario_model->existeEmail($email) || $this->restaurador_model->existeEmail($email) || $this->franquiciado_model->existeEmail($email)) {
                $existe = 'si';
            }
            echo $existe;
        }
    }

    public function recordarPassword() {
        $email = $this->input->post('email_user', TRUE);

        $password = random_string('alnum');
        if ($this->usuario_model->recordarPassword($email, $password)) {
            $this->enviarEmailRecordarPassword($email, $password);
            echo 'OK';
            return;
        }

        if ($this->recordarPasswordRestaurador($email, $password)) {
            $this->enviarEmailRecordarPassword($email, $password);
            echo 'OK';
            return;
        }

        if ($this->recordarPasswordFranquiciado($email, $password)) {
            $this->enviarEmailRecordarPassword($email, $password);
            echo 'OK';
            return;
        }

        echo 'KO';
    }

    public function recordarPasswordRestaurador($email, $password) {
        return $this->restaurador_model->recordarPassword($email, $password);
    }

    public function recordarPasswordFranquiciado($email, $password) {
        return $this->franquiciado_model->recordarPassword($email, $password);
    }

    public function enviarEmailRecordarPassword($email, $password) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = 'Estimado usuario, tu nueva contraseña para el email ' . $email . ' es: ' . $password;

        $this->email->from('info@todoslosmenus.com', 'Todoslosmenus.com');
        $this->email->to($email);
        $this->email->subject('Nueva contraseña');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

}
