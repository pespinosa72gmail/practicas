<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pdf_model');
		$this->load->library("mpdf");
	}


	public function ver_cupon()
	{
		//Especificamos algunos parametros del PDF
    $this->mpdf->mPDF('utf-8','A4');

    //PASAMOS LA RUTA DONDE ESTA EL ESTILO 
    $stylesheet = file_get_contents('./assets/css/pdf.css');
    //cargamos el estilo CSS
    $this->mpdf->WriteHTML($stylesheet,1);


    $clave_cupon = $this->input->get_post('clave', TRUE);
    $id_restaurante = $this->input->get_post('id_restaurante', TRUE);

    $comprueba = $this->pdf_model->comprueba_pdf($clave_cupon, $id_restaurante);

    $obtenerCp = $this->pdf_model->obtenerCp($comprueba->cp_restaurante);

    /*
    echo "<pre>";
    print_r($obtenerCp);
    die();
    */
    
    //ini_set ('display_errors', '1');

    $datos['detalle'] = $comprueba;
    $datos['dameCp'] = $obtenerCp;
    $datos['contenido'] = "pdf";
    $html = $this->load->view('plantillas/pdf', $datos, true);
    //ESCRIBIMOS AL PDF
    $this->mpdf->WriteHTML($html,2);
    //SALIDA DE NUESTRO PDF
    $this->mpdf->Output();

	}


}

