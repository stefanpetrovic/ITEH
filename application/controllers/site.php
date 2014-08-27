<?php

class Site extends CI_Controller {
	
	public function index() {
		$najcitanijiClanci = $this->glavni_model->pet_najcitanijih();
		$data['main_content'] = 'index';
		$data['najcitanijiClanci'] = $najcitanijiClanci;
		$data['mixClanci'] = $this->glavni_model->najnovijiClanciZaMix(12, $this->uri->segment(3) * 10);
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
		$data['komentari'] = $this->glavni_model->vratiKomentareZaClanak($idVesti);
		$data['povezaniClanci'] = $this->glavni_model->vratiPovezaneClanke($idVesti);
		$data['main_content'] = "vest";
		$this->load->view('includes/template', $data);	
	}

	public function vestiPoKategoriji($nazivKategorije, $offset){
		$data['clanci'] = $this->glavni_model->clanci_za_kat($nazivKategorije, $offset);
		$data['main_content'] = "vestiPoKategoriji";
		$this->load->view('includes/template', $data);	
	}
	
	public function vestiPoAutoru($autorID, $offset) {
		$data['clanci'] = $this->glavni_model->clanciPoAutoru($autorID, $offset);
		$data['main_content'] = "vestiPoKategoriji";
		$this->load->view('includes/template', $data);
	}
	public function lajk() {
		$komentarID = $this->input->post('komentarID');
		$korisnikID = $this->input->post('korisnikID');
		$like = $this->input->post('like');
		$result = $this -> glavni_model -> like($komentarID, $korisnikID, $like);
		$poruka = "";
		if ($result) {
			 $poruka = "Uspesno dodat glas";
		}else {
			$poruka = "Ne mozete glasati vise puta!";
		}
		$data['poruka'] = $poruka;
		$data['brojKomentara'] = $this->glavni_model->saberiLajkoveZaKomentar($komentarID);
		echo json_encode($data);
	}
	
	public function ostaviKomentar() {
		$sadrzajKomentara = $this->input->post('komentarID');
		$korisnikID = $this->input->post('korisnikID');
		$clanakID = $this->input->post('clanakID');
		if ($this->glavni_model->dodaj_komentar($sadrzajKomentara, $korisnikID, $clanakID)) {
			echo "Uspesno ste poslali komentar";
		}else {
			echo "Komentar nije uspesno poslat";
		}
	}
	
}

?>