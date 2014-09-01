<?php

class api extends CI_Controller {

	function index(){
		$this->load->view('api/api_documentation');
	}

	function autori(){
		$data = array(
			'username'	=>  $this->input->get('name')
			);
		// if($data['username']){
		$autori = $this->api_model -> vratiAutore($data);
		// } else {
			// $this->output->set_status_header('400');	
			// die();
		// }

		$niz_json = json_encode ($autori);
		print($niz_json);

	}

	function vest(){

		$data = array(
			'id'		=>  $this->input->get('id'),
			'naslov'		=>  $this->input->get('naslov')
			);
		if($data['id'] || $data['naslov']){
			$vest = $this->api_model -> vratiVest($data);
			echo 'true';
		} else {
			$this->output->set_status_header('400');	
		}

		$niz_json = json_encode ($vest);
		print($niz_json);
		//var_dump($vest);

	}

	function vesti(){

		$data = array(
			'author'		=>  $this->input->get('author'),
			'heading'		=>  $this->input->get('heading'),
			'text'			=>  $this->input->get('text'),
			'num'			=>  $this->input->get('num'),
			'kategorije'	=>  $this->input->get('kategorije')		
			);

		if($this->input->get()){
			$vest = $this->api_model -> vratiVesti($data);
		} else {
			$vest = $this->api_model -> vratiVesti(false);
		}

		// $niz_json = json_encode ($vest);
		// print($niz_json);
		var_dump($vest);
		
	}

	function komentari(){
		$data = array(
			'id'		=>  $this->input->get('id'),
			'kategorije'		=>  $this->input->get('kategorije')
			);

		$komentari = $this->api_model -> vratiKomentare($data);

		$niz_json = json_encode ($komentari);
		print($niz_json);
		
		//var_dump($komentari);
	}

	function kategorije(){
		$kategorije = $this->api_model -> vratiKategorije();

		$niz_json = json_encode ($kategorije);
		print($niz_json);
		
		// var_dump($kategorije);
	}

	function postKomentar(){

	}
}


?>