<?php

class korisnik_model extends CI_model {

	function vrati_korisnike($per_page, $page){

		$this -> db -> select('korisnikID, username, email,nivoPrivilegija');
		$this -> db -> from('korisnik');
		$this -> db -> limit($per_page, $page);
		$this -> db -> order_by("korisnikID", "DESC");

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

	function vrati_korisnika($id){
		
		
		$this -> db -> select('korisnikID,username,email,nivoPrivilegija');
		$this -> db -> from('korisnik');
		$this -> db -> where('korisnikID', $id);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {

			$data[] = $query -> result();
			
			return $data[0];
		} else {
			return false;
		}
	
	}

	function izmeni_korisnika($data){
		$this->db->set('nivoPrivilegija', $data['nivoPrivilegija'], FALSE);
		$this->db->set('email', $data['email']);
		$this->db->where('korisnikID', $data['id']);
		$this->db->update('korisnik');
		return;
	}
}
?>