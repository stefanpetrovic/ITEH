<?php

class Site extends CI_Controller {
	
	public function index() {
		$data['main_content'] = 'proba';
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
}

?>