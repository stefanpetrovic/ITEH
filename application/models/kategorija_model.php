<?php

class kategorija_model extends CI_model {

	function vratiKategorije(){
		$this -> db -> select('kategorijaID, naziv');
		$this -> db -> from('kategorija');

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		} else {
			return false;
		}

	}

	function vratiKateg($per_page, $page){
		$this -> db -> select('kategorijaID, naziv');
		$this -> db -> from('kategorija');
		$this -> db -> limit($per_page, $page);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		} else {
			return false;
		}

	}


	function vratiKategorijeZaClanak($clanakID){
		$this -> db -> select('clanakkategorija.kategorijaID, naziv');
		$this -> db -> from('clanakkategorija');
		$this -> db -> join('kategorija', 'kategorija.kategorijaID = clanakkategorija.kategorijaID');
		$this -> db -> where('clanakID', $clanakID);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		} else {
			return false;
		}

	}

	function ukloniKategorijeZaClanak($clanakID){
		
		$this->db->delete('clanakkategorija', array('clanakID' => $clanakID)); 
		return;
	}


	function ubaciKategorijeZaClanak($clanakID, $kategorije){
		foreach ($kategorije as $idKategorije) {
			$data = array(
				'clanakID'		=> $clanakID,
				'kategorijaID'	=> $idKategorije,
				);
			$this->db->insert('clanakkategorija', $data); 
		}
		return;

	}

	function izmeni_kategoriju($data){
		$this->db->where('kategorijaID', $data['id']);
		unset($data['id']);
		$this->db->update('kategorija', $data);
		return;
	}

	function ubaci_novu_kategoriju($data){
			$this->db->insert('kategorija', $data); 
		return $this->db->insert_id();
	}

	function obrisi_kategoriju($idKategorije){
		$this->db->delete('kategorija', array('kategorijaID' => $idKategorije)); 
		return;

		// $this->db->delete('clanak', array('clanakID' => $idClanka)); 
		// return;
	}


}

?>