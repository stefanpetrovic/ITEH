<?php

class glavni_model extends CI_model {

    function dodaj_korisnika($data)
    {
    	$this->db->insert('korisnik', $data);
    	return;
    }

    function korisnik_postoji($ime, $sifra) //ako ti vise odgovara, mogu da promenim da uradim sa nizom

    {
       $this->db->where('username',$ime);
       $this->db->where('sifra', $sifra);
       $query = $this->db->get('korisnik');
       if ($query->num_rows() > 0){
        return true;
        }
        else  {
        return false;
    }
     }

     function clanci_za_kat($naziv)

     {
     	$this->db->select('clanak.clanakID as clanakID, datum, kratakTekst, dugiTekst, naslov, autorID, featuredImage, brojPregleda');
     	$this->db->from('clanak');
     	$this->db->join('clanakkategorija', 'clanak.clanakID = clanakkategorija.clanakID'); 
     	$this->db->join('kategorija', 'clanakkategorija.kategorijaID = kategorija.kategorijaID');
        $this->db->where('kategorija.naziv', $naziv);

        $query = $this->db->get();

        if($query->num_rows() > 0)
            {
               foreach ($query->result() as $row) {
               	$data[] = $row;
               }
              return $data; 
            }
             
            else
            {
                return false;
            }
     }

     function vratiClanakZaID($idClanka) {
        $this->db->select('clanakID, datum, dugiTekst, naslov, username, featuredImage, brojPregleda');
        $this->db->from('clanak');
        $this->db->join('korisnik', 'clanak.autorID = korisnik.korisnikID');
        $this->db->where('clanakID', $idClanka);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
          return $data[] = $query->result();
        }else {
          return false;
        }
     }


      function pet_najcitanijih()
      {
         $this->db->from('clanak');
         $this->db->order_by("brojPregleda", "desc");

         $query= $this->db->get();

         if($query->num_rows() > 0)
            {
            	$x=0;
               foreach ($query->result() as $row) {
               	$data[] = $row;
               	$x++;
               	if ($x == 4) break;
               }
              return $data; 
            }
             
            else
            {
                return false;
            }

      }

      function clanci_po_datumu()
      {
         $this->db->from('clanak');
         $this->db->order_by("datum", "desc");

         $query= $this->db->get();

         if($query->num_rows() > 0)
             {
                foreach ($q->result() as $row) {
               	$data[] = $row;
               	}               	              
              return $data; 
            }
             
            else
            {
                return false;
            }

      }


    function dodaj_komentar($data) 
    {
       $this->db->insert('komentar', $data);
       return;
    }
    
    function dodaj_lajk($data)
    {
       $this->db->insert('likedislike', $data); 	
       return;
    }
}