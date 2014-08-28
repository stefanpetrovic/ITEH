<?php
class Login extends CI_Controller {

	function index() {
		$data['main_content'] = 'login_form';
		$this -> load -> view('includes/template', $data);
	}

	function validate_credentials() {
		$this -> load -> model('glavni_model');
		$query = $this -> glavni_model -> validate();

		if ($query) {
			$data = array('idKorisnika' => $query -> korisnikID, 'username' => $this -> input -> post('username'), 'daliulogovan' => true, 'nivoPriv' => $query -> nivoPrivilegija, 'lajkovi' => 0);
			$this -> session -> set_userdata($data);
			redirect('site');
		} else {
			echo "Pogresno ime ili sifra! Kliknite <a href=\"../login\"> ovde </a> za povratak na prethodnu stranu.";
		}

	}

	function registracija() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		
	}
}
