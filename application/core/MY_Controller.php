<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();        
        
        //Si el usuario no está logado, le logamos por cookies
        if (!$this->session->userdata('ingresado')) {
            
            $this->load->model('usuario_model');
            $this->load->model('restaurador_model');
            $this->load->model('franquiciado_model');

            if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                $email = $_COOKIE['email'];
                $pass = $_COOKIE['password'];

                $comprobar_login = $this->usuario_model->login_user($email, $pass);
                $comprobar_login_propietario = $this->loginRestaurador($email, $pass);
                $comprobar_login_franquiciado = $this->loginFranquiciado($email, $pass);

                //Se guardan las variables de sesión sólo si se ha logeado un usuario de la tabla usuarios
                if ($comprobar_login) {

                    $data = array(
                        'id_usuario' => $comprobar_login->id_usuario,
                        'clave_usuario' => $comprobar_login->clave_usuario,
                        'nombre_usuario' => $comprobar_login->nombre_usuario,
                        'usuario' => TRUE,
                        'ingresado' => TRUE
                    );
                    $this->session->set_userdata($data);
                }
            }
        }
    }

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

}

?>
