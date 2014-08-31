<?php

class admin extends CI_Controller {
	/*	url ex: 'admin/clanci'
		total_rows : retrieve total number of rows before (ex: $this->db->get('clanak')->num_rows())
		records_per_page: numbers of items do display on page
		num_links: number of pagination options
	return: initialized pagination;
*/
	function admin_pagination($url, $total_rows, $records_per_page, $num_links){
		$this->load->library('pagination');

		$config['base_url'] = base_url().$url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $records_per_page;
		$config['num_links'] = $num_links;

		$config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
		$config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li><span><b>";
		$config['cur_tag_close'] = "</b></span></li>";
		$this->pagination->initialize($config);
		return $this->pagination->create_links(); 
	}

	public function index (){
		$data['main_content'] ='admin/admin_index';
		
		$this->load->view('admin/includes/admin_template', $data);
	}

	public function clanci(){
		// pagination 
		$page = $this->uri->segment(3);

		$num_rows = $this->db->get('clanak')->num_rows();
		$per_page = 5;
		$pagination = $this->admin_pagination('admin/clanci', $num_rows, $per_page, 7);
		$pagination = $this->pagination->create_links();
		
		$najcitanijiClanci = $this->glavni_model->clanci_po_datumu($per_page,$page);
		
		$data['najcitanijiClanci'] = $najcitanijiClanci;
		$data['main_content'] = 'admin/admin_clanci';
		$data['page'] = $page;
		$data['pagination'] = $pagination;
		$this->load->view('admin/includes/admin_template', $data);
	}

	public function clanakedit(){
		$id = $this->input->get('id');
		$kat = $this->kategorija_model->vratiKategorije();
		
		if($id != false){
			$article = $this->glavni_model->vratiClanakZaID($id);
			$data['article'] = $article;
			$data['kategorije'] = $kat;
			$data['main_content'] = 'admin/admin_clanak_edit';
			$this->load->view('admin/includes/admin_template', $data);
		} else {
			echo "error";
		}

	}

	public function noviclanak(){
		$kat = $this->kategorija_model->vratiKategorije();
		
		$data['kategorije'] = $kat;
		$data['main_content']= 'admin/admin_novi_clanak';
		$this->load->view('admin/includes/admin_template', $data);

		
	}

	public function edit_clanak(){
		//vrsi editovanje clanka

		$data = array(
			'id'			=>  $this->input->post('id'),
			'datum'			=>  $this->input->post('datum'),
			'kratakTekst'	=>  $this->input->post('kratki_text'),
			'dugiTekst'		=>  $this->input->post('dugi_text'),
			'naslov'		=>  $this->input->post('naslov'),
			'featuredImage'	=>  $this->input->post('fimage'),
			);

		$kategorije = $this->input->post('kategorije');

		

		$this->glavni_model ->izmeni_clanak($data);
		$this->kategorija_model->ukloniKategorijeZaClanak($data['id']);
		$this->kategorija_model->ubaciKategorijeZaClanak($data['id'],$kategorije);

		echo "Uspešno ste izmenili članak";
// 		ukloniKategorijeZaClanak($clanakID)
		// var_dump($data);
		// var_dump($kategorije);



		
		
	}

	public function dodaj_clanak(){
		$data = array(
			'datum'			=>  date('Y-m-d h:i:s'),
			'kratakTekst'	=>  $this->input->post('kratki_text'),
			'dugiTekst'		=>  $this->input->post('dugi_text'),
			'naslov'		=>  $this->input->post('naslov'),
			'featuredImage'	=>  $this->input->post('fimage'),
			'autorID'			=>  '1'
			);

		$kategorije = $this->input->post('kategorije');

		$this->glavni_model ->dodaj_clanak($data);
		$newId = $this->db->insert_id();
		$this->kategorija_model->ubaciKategorijeZaClanak($newId,$kategorije);
		echo "Uspešno ste ubacili članak";
	}

	public function obrisi_clanak(){
		
		$id = $this->uri->segment(3);

		$this->glavni_model ->obrisi_clanak($id);
		echo "Uspešno ste obrisali članak";


	}


	public function kategorije(){
		// pagination 
		$page = $this->uri->segment(3);
		
		$num_rows = $this->db->get('kategorija')->num_rows();
		$per_page = 5;
		$pagination = $this->admin_pagination('admin/kategorije', $num_rows, $per_page, 7);
		$pagination = $this->pagination->create_links();


		$kategorije = $this->kategorija_model->vratiKateg($per_page,$page);
		
		$data['kategorije'] = $kategorije;
		//var_dump($data);
		$data['page'] = $page;
		$data['pagination'] = $pagination;
		$data['main_content'] = 'admin/admin_kategorije';
		$this->load->view('admin/includes/admin_template', $data);
	}


	public function obrisi_kategoriju(){
		
		$id = $this->uri->segment(3);

		$this->kategorija_model  ->obrisi_kategoriju($id);
		echo "Uspešno ste obrisali kategoriju";


	}

	public function izmeni_kategoriju(){

		$data = array(
			'id' => $this->input->post('id'),
			'naziv'			=>  $this->input->post('naziv'),
			);
		$this->kategorija_model -> izmeni_kategoriju($data);
		echo "Uspešno ste izmenili kategoriju";
	}

	public function dodaj_kategoriju(){
		$data = array(
			'naziv'			=>  $this->input->post('name'),
			);
		$this->kategorija_model->ubaci_novu_kategoriju($data);
		$newId = $this->db->insert_id();
		 //echo $newId;
		redirect(base_url().'admin/kategorije');
		//var_dump($data);


		// var_dump($data);
		// var_dump($kategorije);
	}



	public function komentari(){



		$sort = $this->input->get('sort');
		//promenljiva koja nam kaze da li da menjamo sort
		$c = $this->input->get('c');
		var_dump($c);
		//put sort type in session
		// if($c){
			$session_data = $this->session->userdata('verified');

			if($session_data['sortKom']== "descending"){
				$session_data['sortKom'] = "ascending";
			} else {
				$session_data['sortKom'] = "descending";
			}
			$this->session->set_userdata("verified", $session_data);
			$sortType = $session_data['sortKom'];
		// } else {
		// 	var_dump("DDDD");
		// 	$session_data = $this->session->userdata('verified');
		// 	$session_data['sortKom'] = "descending";
		// 	$this->session->set_userdata("verified", $session_data);
		// 	$sortType = $session_data['sortKom'];
		// }



		// pagination 
		$page = $this->uri->segment(3);

		$this->load->library('pagination');

		$config['base_url'] = base_url().'admin/komentari';
		$config['total_rows'] = $this->db->get('komentar')->num_rows();
		$config['per_page'] = 5;
		$config['num_links'] = 7;
		//$config['page_query_string'] = TRUE;
		$config['enable_query_string'] = TRUE;

		$config['first_tag_open'] = $config['last_tag_open'] = $config['next_tag_open'] = $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
		$config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li><span><b>";
		$config['cur_tag_close'] = "</b></span></li>";

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();

		//dodavanje get parametra sort u linkove //
		$p = preg_split("[komentari]",$pagination);
		$d = array();

		foreach ($p as $value) {
			if (strpos($value, "<li") === 0){
				array_push($d, $value);
			} else {
				$newStr = substr_replace($value, '?sort='.$sort, strpos($value, "\""), 0);
				array_push($d, $newStr);
			}
			
		}
		//novi segment paginacije sa sredjenim get sort parametrom
		$newPagination = implode("komentari", $d);
		//---------
		

		$komentari = $this->komentar_model->vrati_komentare($sort,$sortType,$config['per_page'], $page);
		$data['komentari'] = $komentari;
		$data['page'] = $page;
		$data['pagination'] = $newPagination;
		$data['main_content'] = 'admin/admin_komentari';

		//$data['sortType']=$sortType;
		$this->load->view('admin/includes/admin_template', $data);
	}

	public function odobrikomentar($id){
		$komentari = $this->komentar_model->izmeni_status_komentara($id, '1');
		//var_dump($id);
		redirect(base_url().'admin/komentari');
	}
	public function draftujkomentar($id){
		$komentari = $this->komentar_model->izmeni_status_komentara($id, '0');
		//var_dump($id);
		redirect(base_url().'admin/komentari');
	}
	public function odbijkomentar($id){
		$komentari = $this->komentar_model->izmeni_status_komentara($id, '-1');
		//var_dump($id);
		redirect(base_url().'admin/komentari');
	}
	
	public function clanak(){
		$id = $this->input->get('id');
		
		if($id != false){
			$komentar = $this->komentar_model->vratiKomentar($id);
			$data['komentar'] = $komentar;
			$data['main_content'] = 'admin/admin_edit_komentar';
			$this->load->view('admin/includes/admin_template', $data);
		} else {
			echo "error";
		}
	}

	public function edit_komentar(){
		//vrsi editovanje clanka

		$data = array(
			'id'				=>  $this->input->post('id'),
			'tekst_komentara'	=>  $this->input->post('tekst_komentara'),
			'status'			=>  $this->input->post('status')
			);
		$this->komentar_model->izmeni_komentar($data);
		echo "Uspešno ste izmenili komentar";


		
		
	}


	public function korisnici(){
		// pagination 
		$page = $this->uri->segment(3);

		$num_rows = $this->db->get('korisnik')->num_rows();
		$per_page = 4;
		$pagination = $this->admin_pagination('admin/korisnici', $num_rows, $per_page, 7);
		$pagination = $this->pagination->create_links();
		

		$korisnici = $this->korisnik_model->vrati_korisnike($per_page, $page);
		$data['korisnici'] = $korisnici;
		$data['main_content'] = 'admin/admin_korisnici';
		$data['pagination'] = $pagination;
		$data['page'] = $page;
		//$data['sortType']=$sortType;
		$this->load->view('admin/includes/admin_template', $data);

	}

	public function korisnik_edit(){
		$id = $this->input->get('id');
		$korisnik = $this->korisnik_model->vrati_korisnika($id);
		//$korisnici = $this->korisnik_model->vrati_korisnike();
		$data['korisnik'] = $korisnik;
		$data['main_content'] = 'admin/admin_korisnik_edit';

		//$data['sortType']=$sortType;
		$this->load->view('admin/includes/admin_template', $data);

	}

	public function edit_korisnika(){

		$data = array(
			'id'				=>  $this->input->post('id'),
			'email'	=>  $this->input->post('email'),
			'nivoPrivilegija'			=>  $this->input->post('nivoPrivilegija')
			);
		$this->korisnik_model->izmeni_korisnika($data);
		echo "Uspešno ste izmenili korisnika";
	}


}

?>