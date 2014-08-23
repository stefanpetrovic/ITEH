<?php

class glavni_model extends CI_model {

	function dodaj_korisnika($data) {
		$this -> db -> insert('korisnik', $data);
		return;
	}

	function korisnik_postoji($ime, $sifra)//ako ti vise odgovara, mogu da promenim da uradim sa nizom

	{
		$this -> db -> where('username', $ime);
		$this -> db -> where('sifra', $sifra);
		$query = $this -> db -> get('korisnik');
		if ($query -> num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function clanci_za_kat($naziv) {
		$this -> db -> select('clanak.clanakID as clanakID, datum, kratakTekst, dugiTekst, naslov, autorID, featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('clanakkategorija', 'clanak.clanakID = clanakkategorija.clanakID');
		$this -> db -> join('kategorija', 'clanakkategorija.kategorijaID = kategorija.kategorijaID');
		$this -> db -> where('kategorija.naziv', $naziv);

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

	function vratiClanakZaID($idClanka) {
		$this -> db -> select('clanakID, datum,kratakTekst, dugiTekst, naslov, username, featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		$this -> db -> where('clanakID', $idClanka);
		
		$query = $this -> db -> get();

		
		$kategorije = $this->kategorija_model->vratiKategorijeZaClanak($idClanka);
		

		if ($query -> num_rows() > 0) {

			$data[] = $query -> result();
			$data[0]['kategorije'] = $kategorije;
			return $data;
		} else {
			return false;
		}
	}

	function vratiKomentareZaClanak($idClanka) {
		$this -> db -> select('komentarID, tekst, likes, dislikes, datum, username, (likes - dislikes) as skor');
		$this -> db -> from('komentar');
		$this -> db -> join('korisnik', 'komentar.userID = korisnik.korisnikID');
		$this -> db -> where('clanakID', $idClanka);
		$this -> db -> order_by('skor', 'desc');

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

	function vratiPovezaneClanke($idClanka) {
		$this -> db -> select('kategorijaID');
		$this -> db -> from('clanakkategorija');
		$this -> db -> where('clanakID', $idClanka);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$whereClause = "";
			foreach ($query->result() as $row) {
				$whereClause = "clanakkategorija.kategorijaID=" . $row -> kategorijaID . " OR ";
			}
			if (strlen($whereClause) > 0) {
				$whereClause = substr($whereClause, 0, strlen($whereClause) - 4);	
			}else {
				$whereClause = "1 = 1";
			}
			

			$this -> db -> select('clanak.clanakID as clanakID, naslov, username, featuredImage, brojPregleda');
			$this -> db -> from('clanak');
			$this -> db -> join('clanakkategorija', 'clanak.clanakID = clanakkategorija.clanakID');
			$this -> db -> join('kategorija', 'clanakkategorija.kategorijaID = kategorija.kategorijaID');
			$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
			$this -> db -> where($whereClause, null, false);
			$this -> db -> order_by('brojPregleda', 'desc');
			$this -> db -> limit(5);
			
			$query = $this -> db -> get();
			
			if ($query -> num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function pet_najcitanijih() {
		$this -> db -> from('clanak');
		$this -> db -> order_by("brojPregleda", "desc");

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$x = 0;
			foreach ($query->result() as $row) {
				$data[] = $row;
				$x++;
				if ($x == 4)
					break;
			}
			return $data;
		} else {
			return false;
		}

	}
	
	function najsvezijiClanci() {
		$this -> db -> select('clanakID, naslov, featuredImage, brojPregleda');	
		$this -> db -> from('clanak');
		$this -> db -> limit(12);
		$this -> db -> order_by("datum", "desc");
		
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

	function clanci_po_datumu() {

		$this -> db -> select('clanak.clanakID as clanakID, naslov, kratakTekst, datum, username, featuredImage, brojPregleda');	
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		//$this -> db -> where($whereClause, null, false);
		$this -> db -> limit(10);
		// $this -> db -> from('clanak');
		$this -> db -> order_by("datum", "desc");

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
	
	function like($komentarID, $korisnikID, $like) {
		$this -> db -> select('korisnikID, komentarID');
		$this -> db -> from('likedislike');
		$this -> db -> where('korisnikID', $korisnikID);
		$this -> db -> where('komentarID', $komentarID);
		$query = $this -> db -> get();
		
		if ($query->num_rows() == 0) {
			$this->db->set('korisnikID', $korisnikID);
			$this->db->set('komentarID', $komentarID);
			$this->db->set('like', $like);
			$this -> db -> insert('likedislike');
			
			$this->db->select('likes, dislikes');
			$this->db->from('komentar');
			$this->db->where('komentarID', $komentarID);
			
			$row = $this->db->get()->result();
			
			if ($like > 0) {
				$likes = $row[0]->likes + 1;
				$this->db->set('likes', $likes);
				$this->db->where('komentarID', $komentarID);
				$this->db->update('komentar');
			}else {
				$dislikes = $row[0]->dislikes + 1;
				$this->db->set('dislikes', $dislikes);
				$this->db->where('komentarID', $komentarID);
				$this->db->update('komentar');
			}
						
			return true;
		}else {
			return false;
		}
		
	}
	
	function saberiLajkoveZaKomentar($komentarID) {
		$this->db->select('likes, dislikes');
		$this->db->from('komentar');
		$this->db->where('komentarID', $komentarID);
		$query = $this->db->get();
		
		$result = $query->result();
		$suma_lajkova = $result[0]->likes - $result[0]->dislikes;
		return $suma_lajkova;
	}


	function dodaj_clanak($data){

		//var_dump($data);
		$this->db->insert('clanak', $data); 
		return $this->db->insert_id();;


	}

	function izmeni_clanak($data){

		
		
		$this->db->where('clanakID', $data['id']);
		unset($data['id']);
		$this->db->update('clanak', $data);
		return;


	}


	function obrisi_clanak($idClanka){

		$this->db->delete('clanak', array('clanakID' => $idClanka)); 
		return;


	}



	function dodaj_komentar($data) {
		$this -> db -> insert('komentar', $data);
		return;
	}

	function dodaj_lajk($data) {
		$this -> db -> insert('likedislike', $data);
		return;
	}

}
