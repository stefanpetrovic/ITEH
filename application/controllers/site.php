<?php

class Site extends CI_Controller {
	
	public function index() {
		$najcitanijiClanci = $this->glavni_model->pet_najcitanijih();
		$data['main_content'] = 'index';
		$data['najcitanijiClanci'] = $najcitanijiClanci;
 		$this->load->view('includes/template', $data);
	}
	public function registracija() {
		$data['main_content'] = "registracija-korisnika";
		$this->load->view('includes/template', $data);
	}

	public function logovanje() {
		$data['main_content'] = "login-korisnika";
		$this->load->view('includes/template', $data);	
	}

	public function vest($idVesti) {
		$data['clanak'] = $this->glavni_model->vratiClanakZaID($idVesti);
		$data['main_content'] = "vest";
		$this->load->view('includes/template', $data);	
	}

	public function vestiPoKategoriji($nazivKategorije){
		$data['clanci'] = $this->glavni_model->clanci_za_kat($nazivKategorije);
		$data['main_content'] = "vestiPoKategoriji";
		$this->load->view('includes/template', $data);	
	}
}

?>