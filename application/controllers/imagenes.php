<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imagenes extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('restaurador_model');
		$this->load->model('restaurante_model');

		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Buscador', '/section/page');
	}



	public function altaImagenesRestaurante(){

		if($this->session->userdata('ingresado') == TRUE){

			$id_restaurante = $this->input->get_post('id_restaurante');

			$datos['datosRestaurante'] = $this->restaurante_model->dameDetalleRestaurante($id_restaurante);
			$datos['imagenesRestaurante'] = $this->restaurante_model->dameListadoImagen($id_restaurante);
			
			/*
			echo "<pre>";
			print_r($datos['imagenesRestaurante']);
			die();
			*/

			$datos['title'] = "Alta restaurante";
			$datos['description'] =  "Registro de restaurantes";
			$datos['robots'] = "NOINDEX, NOFOLLOW";
			$datos['contenido'] = "registro-imagenes";
			$this->load->view ('plantillas/plantilla2', $datos);

		}else{
			redirect(base_url());
		}

	}

	public function dameImagenesRestaurantes(){

		$id_restaurante = $this->input->get_post('id_restaurante');
		$datos['imagenesRestaurante'] = $this->restaurante_model->dameListadoImagen($id_restaurante);

		$data = $datos['imagenesRestaurante'];

		foreach ($data as $key => $value) {
			//echo "<li>".$value->nombre_imagen."</li>";
			echo '
				<li>
					<div class="row">
						<div class="col-md-2 nodosfilas ocultar">
							<img alt=""
								src="/assets/images/restaurantes/00001_Restaurante01/principal.jpg">
						</div>
						<div class="col-md-8 nodosfilas convertir12">
							<div class="row">
								<div class="col-md-3">
									<label>Nombre</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<i class="fa fa-pencil"></i> <input name="name" id="name"
											type="text" value=" '.$value->titulo_imagen.' ">
									</div>
								</div>
								<div class="col-md-3">
									<label>Principal</label>
								</div>
								<div class="col-md-9 nodosfilas convertir12">
									<div class="form-input">
										<input type="checkbox" class="bajarcheck">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="enlacesencillo">
								<a href="#">Eliminar<span><i
										class="fa fa-arrow-circle-right"></i></span></a>
							</div>
						</div>
					</div>
				</li>
			';
		}

	}


	public function upload(){
		if (!empty($_FILES)) {

				$tempFile = $_FILES['file']['tmp_name'];
				$fileName_thumbsnails = $_FILES['file']['name'];

				//$fileName = convert_accented_characters(time().'-'.$_FILES['file']['name']);
				$fileName = convert_accented_characters(time().'-'.$fileName_thumbsnails);

				$targetPath = getcwd() . '/assets/img_restaurantes/';
				//$targetPath = getcwd() . '/assets/'.date('Y').'/img_restaurantes/';
				$targetFile = $targetPath . $fileName ;
				move_uploaded_file($tempFile, $targetFile);

				$id_restaurante = $this->input->get_post('id_restaurante');
				$ext = end(explode(".", $_FILES['file']['name']));
				$nombre_imagen = array_shift(explode(".", $_FILES['file']['name']));
				$nombre_img_final = time().'-'.$nombre_imagen.'_thumb';

				$this->restaurador_model->guardarImagen($id_restaurante, $fileName, $nombre_img_final, $ext);

				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/img_restaurantes/'.$fileName;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = FALSE;
				$config['master_dim'] = 'auto';
				$config['width'] = 430;
				$config['height'] = 225;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$this->restaurador_model->asegurarImagenPrincipal($id_restaurante);
				
		}
	}



}

