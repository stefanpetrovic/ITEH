<?php

class admin extends CI_Controller {

	public function index (){
		$data['main_content'] ='admin/admin_index';
		$this->load->view('admin/includes/admin_template', $data);
	}

	public function clanci(){
		$najcitanijiClanci = $this->glavni_model->clanci_po_datumu();
		// var_dump($najcitanijiClanci);
		$data['najcitanijiClanci'] = $najcitanijiClanci;
		$data['main_content'] = 'admin/admin_clanci';
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
		// var_dump($data);
		// var_dump($kategorije);
	}

	public function obrisi_clanak(){
		
		$id = $this->uri->segment(3);

		$this->glavni_model ->obrisi_clanak($id);
		echo "Uspešno ste obrisali članak";


	}
}

?>