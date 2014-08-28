<?php
class komentar_model extends CI_model {

	function dodaj_komentar($sadrzajKomentara, $korisnikID, $clanakID) {
		$date = date('Y-m-d H:i:s');
		$this -> db -> set('userID', $korisnikID);
		$this -> db -> set('tekst', $sadrzajKomentara);
		$this -> db -> set('likes', 0);
		$this -> db -> set('dislikes', 0);
		$this -> db -> set('clanakID', $clanakID);
		$this -> db -> set('odabran', 0);
		$this -> db -> set('datum', $date);
		$this -> db -> insert('komentar');
		return true;
	}



	function vrati_komentare($sort, $sortType){
		switch ($sort) {
			case 'datum':
			$orderby = "datum";
			break;
			case 'status':
			$orderby = "odabran";
			break;
			case 'korisnik':
			$orderby = "userID";
			break;
			default:
			$orderby = "datum";
			break;
		}
		$sortT = ($sortType == '' || $sortType== 'ascending') ? "asc" : "desc";

		$this -> db -> select('komentar.komentarID,korisnik.username,tekst,likes,dislikes, clanak.naslov, clanak.kratakTekst as tekstClanka, komentar.datum as datum,odabran');
		$this -> db -> from('komentar');
		$this -> db -> join('korisnik', 'komentar.userID = korisnik.korisnikID');
		$this -> db -> join('clanak', 'clanak.clanakID = komentar.clanakID');
		$this -> db -> order_by($orderby, $sortT);

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

	function izmeni_status_komentara($id, $statusOdabran){
		$this->db->set('odabran', $statusOdabran, FALSE);
		$this->db->where('komentarID', $id);
		$this->db->update('komentar');
		return;
	}

	function vratiKomentar($id){
		

		$this -> db -> select('komentar.komentarID,korisnik.username,tekst,likes,dislikes, clanak.naslov, clanak.kratakTekst as tekstClanka, komentar.datum as datum,odabran');
		$this -> db -> from('komentar');
		$this -> db -> join('korisnik', 'komentar.userID = korisnik.korisnikID');
		$this -> db -> join('clanak', 'clanak.clanakID = komentar.clanakID');
		$this -> db -> where('komentarID', $id);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {

			$data[] = $query -> result();
			
			return $data[0];
		} else {
			return false;
		}
	}

	function izmeni_komentar($data){
		$this->db->set('odabran', $data['status'], FALSE);
		$this->db->set('tekst', $data['tekst_komentara']);
		$this->db->where('komentarID', $data['id']);
		$this->db->update('komentar');
		return;
	}
}
?>