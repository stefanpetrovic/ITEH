<?php

class api_model extends CI_model {

	function vratiAutore($data){
		
		if(!$data['username']){
			$data['username']="";
			$this->db->limit(100);
		}


		$this -> db -> select('korisnikID, username,brKomentara,nivoPrivilegija');
		$this -> db -> from('korisnik');
		$this -> db -> like('korisnik.username', $data['username']);

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				$autori[] = $row;
			}
			//unset($autori['username']);
			//var_dump($data);
			foreach ($autori as $key => $value) {

				$this ->db->select('*');
				$this->db->from('clanak');
				$this->db->where('clanak.autorID', $value->korisnikID);
				$numArticles = $this->db->count_all_results();

				$value->brojClanaka = $numArticles;

			}
			return $autori;
		} else {
			return false;
		}


		
		
		
	}

	function vratiVest($data){
		$this -> db -> select('clanakID,datum,kratakTekst, dugiTekst, naslov, username, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');

		if($data['id']){
			$this -> db -> where('clanakID', $data['id']);
		} elseif($data['naslov']) {
			echo "Tru naslov";
			$this -> db -> where('naslov', $data['naslov']);
		} else {
			return false;
		}

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$vest = $query -> result();
			$vest = $vest[0];
			$kategorije = $this -> kategorija_model -> vratiKategorijeZaClanak($vest->clanakID);
			$vest->kategorije = $kategorije;
			unset($vest->clanakID);
			return $vest;
		} else {
			return false;
		}
	}

	function vratiVesti($data){
		//var_dump($data);
		$this -> db -> select('clanakID,datum,kratakTekst, dugiTekst, naslov, username, brojPregleda');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');


		if(!$data){
			$this->db->limit(100);
		}

		if($author = $data['author']){
			$authors =  array_map('trim', explode(',', $author));
			// echo "Authors:";
			// var_dump($authors);
			foreach ($authors as $key => $author) {
				$this -> db -> or_where('username', $author);
			}
			
		} if ($heading = $data['heading']) {
			$headings = array_map('trim', explode(',', $heading));
			// echo "Heading:";
			// var_dump($headings);
			foreach ($headings as $heading) {
				$this ->db -> or_like('naslov', $heading);
			}
		} if ($text = $data['text']) {
			$words = array_map('trim', explode(',', $text));
			// echo "Words:";
			// var_dump($words);
			foreach ($words as $word) {
				//var_dump($word);
				$this ->db -> like('kratakTekst', $word);
				$this ->db -> or_like('dugiTekst', $word);
			}
			
		} if ($limit = $data['num']) {
			// echo "Limit:";
			// var_dump($limit);
			$this->db->limit($limit);
		}

		$query = $this -> db -> get();

		if ($query -> num_rows() > 0) {
			$vesti = $query -> result();
			
			foreach ($vesti as $key => $vest) {


				$kategorije = $this -> api_model -> vratiKategorijeZaClanak($vest->clanakID);
			//var_dump($kategorije);
			$vest->kategorije = $kategorije;//	var_dump($vest);
		}

			//provera za kategorije
		if($kategorije = $data['kategorije']){

			$trazene_kategorije = array_map('trim', explode(',', $kategorije));


			foreach ($vesti as $key => $vest) {
				$kategorije_vesti = $vest->kategorije;
				//trazi zajednicku kategoriju za vest i korisnicki parametar
				$cc = array_intersect($kategorije_vesti, $trazene_kategorije);
				
				if(empty($cc)){
					//izbacujemo iz niza posto nemaju nijednu zajednicku kategoriju
					unset($vesti[$key]);
				}
			}
			//'prepakuje' indekse u nizu
			$vesti = array_values($vesti);


		}
		return $vesti;
	} else {
		return false;
	}
}

function vratiKomentare($data){

	if($id = $data['id']){
		$this -> db -> select('clanak.clanakID,korisnik.username');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		$this -> db -> where('clanak.clanakID',$id);
		$query = $this -> db -> get();

	} elseif ($kategorije = $data['kategorije']) {
		$kategorije = explode(',', $kategorije);

		$this -> db -> select('clanak.clanakID,korisnik.username');
		$this -> db -> from('clanakKategorija');
		$this -> db -> join('clanak', 'clanak.clanakID = clanakKategorija.clanakID','left');
		$this -> db -> join('kategorija', 'clanakKategorija.kategorijaID = kategorija.kategorijaID');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		$this -> db -> where('kategorija.naziv','Košarka');

		foreach ($kategorije as $kat) {
			$this -> db -> or_where('kategorija.naziv',$kat);
		}
		$query = $this -> db -> get();
	} else {
		$this -> db -> select('clanak.clanakID,korisnik.username');
		$this -> db -> from('clanak');
		$this -> db -> join('korisnik', 'clanak.autorID = korisnik.korisnikID');
		$this -> db -> limit(100);
		$query = $this -> db -> get();

	}



	$komentari = array();

	if ($query -> num_rows() > 0) {
		foreach ($query->result() as $row) {
			$clanci[] = $row;


		}

		foreach ($clanci as $clanak) {
			$this -> db -> select('tekst,likes,dislikes,datum');
			$this -> db -> from('komentar');
			$this -> db -> where('komentar.clanakID', $clanak->clanakID);
			$this -> db -> where('komentar.odabran','1');
			$q = $this -> db -> get();
			if($q->num_rows()>0){
				foreach ($q->result() as $kom) {
					$kom->author = $clanak->username;
					$komentari[] = $kom;
				}
			}
		}

		return $komentari;
	} else {
		return false;
	}





























}

function vratiKategorije(){
	$this -> db -> select('naziv');
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

function ostaviKomentar(){

}













	//pomocna za API
function vratiKategorijeZaClanak($idClanka){
	$this -> db -> select('naziv');
	$this -> db -> from('clanakkategorija');
	$this -> db -> join('kategorija', 'kategorija.kategorijaID = clanakkategorija.kategorijaID');
	$this -> db -> where('clanakID', $idClanka);

	$query = $this -> db -> get();

	if ($query -> num_rows() > 0) {
		foreach ($query->result() as $row) {
			$data[] = $row->naziv;
		}
		return $data;
	} else {
		return false;
	}

}
}
?>