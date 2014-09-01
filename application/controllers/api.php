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

		//returnJSON("vesti", $vest);

		$niz_json = json_encode ($vest);
		print($niz_json);
		//var_dump($vest);
		
	}

	function komentari(){
		$data = array(
			'id'		=>  $this->input->get('id'),
			'kategorije'		=>  $this->input->get('kategorije')
			);

		$komentari = $this->api_model -> vratiKomentare($data);

		{}
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

	function example(){
		$this->load->view('api/api_example_form');
	}

	function example_result(){
		//primer za poziv apija vesti:
		$api_uri = base_url().'api/vesti';
		$parametri = $this->input->post();
		$p='';
		foreach ($parametri as $parametar) {
			$p .= $parametar;
		}

		if($p!=''){
			$api_uri .="?";
		}
		$parametri_niz = array(); //niz parametara sa vrednostima za implode
		foreach ($parametri as $key => $value) {
			if($value != '')
				$parametri_niz[] = $key."=".$value;
		}
		//spajanje uri sa parametrima - konacni uri
		$api_uri .= implode('&', $parametri_niz);
		

		echo "<h1>URI trazenog resursa:</h1>";
		var_dump($api_uri);



		//poziv apija - cURL
		$curl = curl_init($api_uri);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, false);
		$curl_odgovor = curl_exec($curl);
		curl_close($curl);
		echo "<h1>JSON odgovor servera:</h1>";
		var_dump($curl_odgovor);
		$json_objekat=json_decode($curl_odgovor);
		echo "<h1>JSON enkodiran objekat:</h1>";
		var_dump($json_objekat);
	

	}

}


?>