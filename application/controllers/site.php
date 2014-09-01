<?php

class Site extends CI_Controller {

	public $menu_items;
	public $korisnik;

	public function __construct() {
		parent::__construct();
		$this -> menu_items = $this -> glavni_model -> vratiKategorije();
		$this -> ulogovan();
	}

	public function ulogovan() {

		$this -> korisnik['ulogovan'] = $this -> session -> userdata('daliulogovan');

		if ($this -> korisnik['ulogovan'] == true) {
			$this -> korisnik['username'] = $this -> session -> userdata('username');
			$this -> korisnik['nivoPrivilegija'] = $this -> session -> userdata('nivoPriv');
			$this -> korisnik['idKorisnika'] = $this -> session -> userdata('idKorisnika');
		}
	}

	public function index() {
		$najcitanijiClanci = $this -> glavni_model -> pet_najcitanijih();
		$data['menu_items'] = $this -> menu_items;
		$data['korisnik'] = $this -> korisnik;
		$data['main_content'] = 'index';
		$data['najcitanijiClanci'] = $najcitanijiClanci;
		$podaci = $this -> glavni_model -> najnovijiClanciZaMix(12, $this -> uri -> segment(3) * 12);
		if ($podaci) {
			$data['mixClanci'] = array_slice($podaci, 0, count($podaci) - 1);
			$data['brojClanaka'] = array_slice($podaci, count($podaci) - 1);
		}else {
			$data['mixClanci'] = false;
			$data['brojClanaka'] = 0;
		}
		
		$this -> load -> view('includes/template', $data);
	}
	
	public function servis() {
		$this->load->library('curl');
		//$this->load->library('rest');
		$config = array('server' => 'http://football-api.com/');
		$this->rest->initialize($config);
		
		$podaci = $this->get('api', array('Action' => 'today', 'APIKey' => '41a8bfcd-3790-8d64-5f6e95a6c7ab', 'comp_id' => '1'), 'json');
	}

	public function registracija() {
		$data['menu_items'] = $this -> menu_items;
		$data['korisnik'] = $this -> korisnik;
		$data['main_content'] = "registracija-korisnika";
		$this -> load -> view('includes/template', $data);
	}
	
	function validacijaRegistracije() {
		$data['menu_items'] = $this -> menu_items;
		$data['korisnik'] = $this -> korisnik;
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passwordRetype','Password', 'required');
		$this->form_validation->set_rules('email','Email', 'required|valid_email');
		
		$this->form_validation->set_message('required', '%s polje ne moze biti prazno');
		$this->form_validation->set_message('valid_email', '%s nije validan, morate uneti drugi email.');
		if ($this->form_validation->run() == FALSE) {
			$data['main_content'] = "registracija-korisnika";
			$this->load->view('includes/template', $data);
		}else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			
			$result = $this->glavni_model->dodaj_korisnika($username, $password, $email);
			
			if ($result) {
				$data['main_content'] = "login-korisnika";
				$this->load->view('includes/template', $data);
			}else {
				echo "Greska prilikom registracije";
			}
			
		}
	}

	public function logovanje() {
		$data['menu_items'] = $this -> menu_items;
		$data['korisnik'] = $this -> korisnik;
		$data['main_content'] = "login-korisnika";
		$this -> load -> view('includes/template', $data);
	}

	public function proveriUsername() {
		$username = $this->input->post('username');
		if (!$username || $username==''){
			echo false;
			return;
		}
		$postoji = $this->glavni_model->proveriUsername($username);
		if ($postoji) {
			echo true;
		}
		echo false;
	}
	
	public function proveriEmail() {
		$email = $this->input->post('email');
		if (!$email || $email == '') {
			echo false;
			return;
		}
		$postoji = $this->glavni_model->proveriEmail($email);
		if ($postoji) {
			echo true;
		}
		echo false;
	}

	public function vest($idVesti) {
		$ipAdresa = $_SERVER['REMOTE_ADDR'];
		$this->glavni_model->dodajPregled($idVesti, $ipAdresa);
		$data['menu_items'] = $this -> menu_items;
		$data['korisnik'] = $this -> korisnik;
		$data['clanak'] = $this -> glavni_model -> vratiClanakZaID($idVesti);
		$data['komentari'] = $this -> glavni_model -> vratiKomentareZaClanak($idVesti);
		$data['povezaniClanci'] = $this -> glavni_model -> vratiPovezaneClanke($idVesti);
		$data['main_content'] = "vest";
		$this -> load -> view('includes/template', $data);
	}

	public function vestiPoKategoriji($kategorijaID, $offset) {
		$data['korisnik'] = $this -> korisnik;
		$data['menu_items'] = $this -> menu_items;
		$podaci = $this -> glavni_model -> clanci_za_kat($kategorijaID, $offset);
		if ($podaci) {
			$data['clanci'] = array_slice($podaci, 0, count($podaci) - 1);
			$data['brojClanaka'] = array_slice($podaci, count($podaci) - 1);
		}else {
			$data['clanci'] = false;
			$data['brojClanaka'] = 0;
		}
		
		$data['main_content'] = "vestiPoKategoriji";
		$this -> load -> view('includes/template', $data);
	}

	public function vestiPoAutoru($autorID, $offset) {
		$data['korisnik'] = $this -> korisnik;
		$data['menu_items'] = $this -> menu_items;
		$podaci = $this -> glavni_model -> clanciPoAutoru($autorID, $offset);
		if ($podaci) {
			$data['clanci'] = array_slice($podaci, 0, count($podaci) - 1);
			$data['brojClanaka'] = array_slice($podaci, count($podaci) - 1);
		}else {
			$data['clanci'] = false;
			$data['brojClanaka'] = 0;
		}
		$data['main_content'] = "vestiPoKategoriji";
		$this -> load -> view('includes/template', $data);
	}
	
	public function pretraga() {
		$data['korisnik'] = $this -> korisnik;
		$data['menu_items'] = $this -> menu_items;
		$data['main_content'] = "pretragaForma";
		$this -> load -> view('includes/template', $data);
	}
	
	public function pretraziClanke($offset) {
		$data['korisnik'] = $this -> korisnik;
		$data['menu_items'] = $this -> menu_items;
		
		$kljucnaRec = $this->input->get('kljucnaRec');
		$kategorijaID = $this->input->get('kategorija');
		$podaci = $this -> glavni_model -> pretraziClankePoKljucnojReci($kljucnaRec, $kategorijaID, $offset);
		if ($podaci) {
			$data['clanci'] = array_slice($podaci, 0, count($podaci) - 1);
			$data['brojClanaka'] = array_slice($podaci, count($podaci) - 1);
		}else {
			$data['clanci'] = false;
			$data['brojClanaka'] = 0;
		}
		$data['main_content'] = "pretragaVesti";
		$data['kljucnaRec'] = $kljucnaRec;
		$data['kategorijaID'] = $kategorijaID;
		$this -> load -> view('includes/template', $data);
	}

	public function lajk() {
		$komentarID = $this -> input -> post('komentarID');
		$korisnikID = $this -> input -> post('korisnikID');
		$like = $this -> input -> post('like');
		$result = $this -> glavni_model -> like($komentarID, $korisnikID, $like);
		$poruka = "";
		if ($result) {
			$poruka = "Uspesno dodat glas";
		} else {
			$poruka = "Ne mozete glasati vise puta!";
		}
		$data['poruka'] = $poruka;
		$data['brojKomentara'] = $this -> glavni_model -> saberiLajkoveZaKomentar($komentarID);
		echo json_encode($data);
	}

	public function ostaviKomentar() {
		$sadrzajKomentara = $this -> input -> post('sadrzajKomentara');
		$korisnikID = $this -> input -> post('korisnikID');
		$clanakID = $this -> input -> post('clanakID');
		if ($this -> glavni_model -> dodaj_komentar($sadrzajKomentara, $korisnikID, $clanakID)) {
			echo "Uspesno ste poslali komentar";
		} else {
			echo "Komentar nije uspesno poslat";
		}
	}

}
?>