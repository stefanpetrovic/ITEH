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

	function validate() {

		$this -> db -> where('username', $this -> input -> post('username'));
		$this -> db -> where('password', $this -> input -> post('password'));
		$query = $this -> db -> get('korisnik');

		if ($query -> num_rows == 1) {
			$rows = $query->result();
			return $rows[0];
		} else {
			return false;
		}
	}
	
	function proveriUsername($username) {
		$this->db->from('korisnik');
		$this->db->where('username', $username);
		$query = $this->db->get();
		if($query -> num_rows() == 0) {
			return true;
		}else {
			return false;
		}
	}

	function clanci_za_kat($naziv, $offset) {
		$this -> db -> select('clanak.clanakID as clanakID, datum, kratakTekst, dugiTekst, naslov, autorID, korisnikID, username,  featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('clanakkategorija', 'clanak.clanakID = clanakkategorija.clanakID');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		$this -> db -> join('kategorija', 'clanakkategorija.kategorijaID = kategorija.kategorijaID');
		$this -> db -> where('kategorija.naziv', $naziv);
		$this -> db -> limit(10, $offset * 10);
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
		$this -> db -> select('clanakID, datum,kratakTekst, dugiTekst, naslov, username, autorID, featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		$this -> db -> where('clanakID', $idClanka);

		$query = $this -> db -> get();

		$kategorije = $this -> kategorija_model -> vratiKategorijeZaClanak($idClanka);

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
		$this -> db -> where('odabran >', 0);
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
			} else {
				$whereClause = "1 = 1";
			}

			$this -> db -> select('clanak.clanakID as clanakID, naslov, username, autorID, featuredImage, brojPregleda');
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
		$this -> db -> select('clanakID, naslov, korisnikID, username, featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
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

	function najnovijiClanciZaMix($limit, $offset) {
		$this -> db -> select('clanakID, naslov, featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> limit($limit, $offset);
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

	function clanci_po_datumu($totalCol,$page) {
		//$offset = ($page-1)*10;
		$this -> db -> select('clanak.clanakID as clanakID, naslov, kratakTekst, datum, username, featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		//$this -> db -> where($whereClause, null, false);
		$this -> db -> limit($totalCol, $page);
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

	function clanciPoAutoru($autorID, $offset) {
		$this -> db -> select('clanakID, datum, kratakTekst, naslov, username, korisnikID, featuredImage, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		$this -> db -> where('autorID', $autorID);
		$this -> db -> limit(10, $offset * 10);
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

	function vratiKategorije() {
		$query = $this -> db -> get('kategorija', 10, 2);
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

		if ($query -> num_rows() == 0) {
			$this -> db -> set('korisnikID', $korisnikID);
			$this -> db -> set('komentarID', $komentarID);
			$this -> db -> set('like', $like);
			$this -> db -> insert('likedislike');

			$this -> db -> select('likes, dislikes');
			$this -> db -> from('komentar');
			$this -> db -> where('komentarID', $komentarID);

			$row = $this -> db -> get() -> result();

			if ($like > 0) {
				$likes = $row[0] -> likes + 1;
				$this -> db -> set('likes', $likes);
				$this -> db -> where('komentarID', $komentarID);
				$this -> db -> update('komentar');
			} else {
				$dislikes = $row[0] -> dislikes + 1;
				$this -> db -> set('dislikes', $dislikes);
				$this -> db -> where('komentarID', $komentarID);
				$this -> db -> update('komentar');
			}

			return true;
		} else {
			return false;
		}

	}

	function saberiLajkoveZaKomentar($komentarID) {
		$this -> db -> select('likes, dislikes');
		$this -> db -> from('komentar');
		$this -> db -> where('komentarID', $komentarID);
		$query = $this -> db -> get();

		$result = $query -> result();
		$suma_lajkova = $result[0] -> likes - $result[0] -> dislikes;
		return $suma_lajkova;
	}

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

	function dodajPregled($idVesti, $ipAdresa) {
		$date = date('Y-m-d', strtotime("-1 day"));
		$this->db->from('brojPregleda');
		$array = array('clanakID =' => $idVesti, 'ipAdresa =' => $ipAdresa, 'datum >=' => $date);
		$this->db->where($array);
		$this->db->order_by('datum', 'desc');
		
		$query = $this->db->get();
		if ($query -> num_rows() == 0) {
			$data = array(
				'clanakID' => $idVesti,
				'ipAdresa' => $ipAdresa,
				'datum' => date('Y-m-d')
			);
			$this->db->insert('brojPregleda', $data);
			$this->db->select('brojPregleda');
			$this->db->from('clanak');
			$this->db->where('clanakID', $idVesti);
			$query = $this->db->get();
			$rows = $query->result();
			$row = $rows[0];
			$brojPregleda = $row->brojPregleda + 1;
			
			$this->db->set('brojPregleda', $brojPregleda);
			$this->db->where('clanakID', $idVesti);
			$this->db->update('clanak');
			return true;
		}
		return false;
	}
	function dodaj_clanak($data) {

		//var_dump($data);
		$this -> db -> insert('clanak', $data);
		return $this -> db -> insert_id();

	}

	function izmeni_clanak($data) {

		$this -> db -> where('clanakID', $data['id']);
		unset($data['id']);
		$this -> db -> update('clanak', $data);
		return;

	}

	function obrisi_clanak($idClanka) {

		$this -> db -> delete('clanak', array('clanakID' => $idClanka));
		return;

	}

	function dodaj_lajk($data) {
		$this -> db -> insert('likedislike', $data);
		return;
	}

}
