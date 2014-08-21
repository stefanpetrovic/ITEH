<?php

class admin extends CI_Controller {

	public function index (){
		$this->load->view('admin/admin_index');
	}

	public function clanci(){
		 $najcitanijiClanci = $this->glavni_model->clanci_po_datumu();
		// var_dump($najcitanijiClanci);
		 $data['najcitanijiClanci'] = $najcitanijiClanci;
		$this->load->view('admin/admin_clanci', $data);
	}
}

?>