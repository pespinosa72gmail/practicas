<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailing extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('usuario_model');
        $this->load->model('restaurador_model');
        $this->load->model('franquiciado_model');
        
    }

    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */

    //Action del Formulario Registro Franquiciado
    public function emailWebFranquiciate() {
        $nombre = $this->input->get_post('nombre_franquiciate', TRUE);
        $email = $this->input->get_post('email_franquiciate', TRUE);
        $telefono = $this->input->get_post('telefono_franquiciate', TRUE);
        $mensaje = $this->input->get_post('mensaje_franquiciate', TRUE);

        $this->sendEmailFranquiciate($nombre, $email, $telefono, $mensaje);
    }

    public function sendEmailFranquiciate($nombre, $email, $telefono, $mensaje) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = '
			Datos de nuevo restaurador.
			<br />
			<strong>Nombre:</strong> ' . $nombre . ' <br />
			<strong>Email:</strong> ' . $email . ' <br />
			<strong>Teléfono:</strong> ' . $telefono . ' <br />
			<strong>Mensaje:</strong> ' . $mensaje . ' <br />
		';


        $this->email->from('contacto@todoslosmenus.es', 'Todoslosmenus.com');
        //$this->email->to('juancarlos.hernandez@nablae.es'); //Cambiar
        $this->email->to(EMAIL_ENVIOS); //Cambiar
        $this->email->subject('Formulario Franquiciate');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */






    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */

    public function emailWebContacto() {
        $nombre = $this->input->get_post('nombre_contacto', TRUE);
        $email = $this->input->get_post('email_contacto', TRUE);
        $telefono = $this->input->get_post('telefono_contacto', TRUE);
        $mensaje = $this->input->get_post('mensaje_contacto', TRUE);

        $this->sendEmailContacto($nombre, $email, $telefono, $mensaje);
    }

    public function sendEmailContacto($nombre, $email, $telefono, $mensaje) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = '
			Contacto desde la web.
			<br />
			<strong>Nombre:</strong> ' . $nombre . ' <br />
			<strong>Email:</strong> ' . $email . ' <br />
			<strong>Teléfono:</strong> ' . $telefono . ' <br />
			<strong>Mensaje:</strong> ' . $mensaje . ' <br />
		';

        $this->email->from('contacto@todoslosmenus.es', 'Todoslosmenus.com');
        $this->email->to(EMAIL_ENVIOS); //Cambiar
        $this->email->subject('Contacto desde la web');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */






    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */

    public function emailSoportTecnicoPanelRestaurador() {

        //$restaurador = $this->input->get_post('');
        $mensaje = $this->input->post('mensaje_soporte', TRUE);

        $this->sendEmailSoporteTecnicoRestaurador($mensaje);
    }

    public function sendEmailSoporteTecnicoRestaurador($mensajes) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = '
			Mensaje soporte técnico - Restaurador: <br />
			Nombre: Fulanito (Cambiar) <br />
			Mensaje: ' . $mensajes . '
		';

        $this->email->from('contacto@todoslosmenus.es', 'Todoslosmenus.com');
        $this->email->to(EMAIL_ENVIOS); //Cambiar
        $this->email->subject('Mensaje soporte técnico');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */

    public function existeEmail() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {
            $email=$this->input->post('email');
            $existe = 'no';
            if ($this->usuario_model->existeEmail($email)) {
                $existe = 'si';
            }
            if ($this->restaurador_model->existeEmail($email)) {
                $existe = 'si';
            }
            if ($this->franquiciado_model->existeEmail($email)) {
                $existe = 'si';
            }
            echo $existe;
        }
    }

    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */

    public function emailSoportTecnicoPanelUsuario() {
        //$restaurador = $this->input->get_post('');
        $mensaje = $this->input->post('message_suppot_user', TRUE);

        $this->sendEmailSoporteTecnicoUsuario($mensaje);
    }

    public function sendEmailSoporteTecnicoUsuario($mensajes) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = '
			Mensaje soporte técnico - Usuario: <br />
			Nombre: Fulanito (Cambiar) <br />
			Mensaje: ' . $mensajes . '
		';

        $this->email->from('contacto@todoslosmenus.es', 'Todoslosmenus.com');
        $this->email->to(EMAIL_ENVIOS); //Cambiar
        $this->email->subject('Mensaje soporte técnico');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

    /*     * ********************************************************************************* */
    /*     * ********************************************************************************* */

    public function reservar() {
        $nombre = $this->input->get_post('nombre');
        $email = $this->input->get_post('email');
        $telefono = $this->input->get_post('telefono');
        $fecha = $this->input->get_post('fecha');
        $personas = $this->input->get_post('personas');
        $comentarios = $this->input->get_post('comentarios');

        $email_restaurante = $this->input->get_post('email_restaurante');

        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = '
			Nombre: ' . $nombre . ' <br />
			E-amil: ' . $email . ' <br />
			Teléfono: ' . $telefono . ' <br />
			Fecha: ' . $fecha . ' <br />
			Número de personas: ' . $personas . ' <br />
			Comentarios: ' . $comentarios . ' <br />

		';

        $this->email->from('contacto@todoslosmenus.es', 'Todoslosmenus.com');
        $this->email->to($email_restaurante);
        $this->email->subject('Nueva reserva desde TodosLosMenús');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
		
        echo "Reserva enviada correctamente";
    }

	// Esta función cre que no se está usando pero de momento la dejo por si acaso
    public function sendEmailReserva($nombre, $apellidos, $telefono, $fecha, $personas, $mensajes, $email_restaurante) {
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $mensaje = '
			Nombre: ' . $mensajes . ' <br />
			Apellidos: ' . $mensajes . ' <br />
			Teléfono: ' . $mensajes . ' <br />
			Fecha: ' . $mensajes . ' <br />
			Número de personas: ' . $mensajes . ' <br />
			Mensaje: ' . $mensajes . ' <br />

		';

        $this->email->from('contacto@todoslosmenus.es', 'Todoslosmenus.com');
        $this->email->to($email_restaurante);
        $this->email->subject('Nueva reserva desde TodosLosMenús');
        $this->email->message($mensaje);
        $this->email->set_alt_message('Tu gestor de correo no admite código HTML');
        $this->email->send();
    }

}
