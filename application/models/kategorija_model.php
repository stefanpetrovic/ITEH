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

	

}

?>