<?php
class KurirModel {

    private $idKurira;
    private $prezime;
    private $ime;
    private $telefon;
    private $ukupanBrojPaketa;
    private $stariIdKurira; // stara vrednost primarnog kljuca - potrebno kod izmene

    // GETTERI I SETTERI

    public function getIdKurira() { return $this->idKurira; }
    public function setIdKurira($idKurira) { $this->idKurira = $idKurira; }

    public function getPrezime() { return $this->prezime; }
    public function setPrezime($prezime) { $this->prezime = $prezime; }

    public function getIme() { return $this->ime; }
    public function setIme($ime) { $this->ime = $ime; }

    public function getTelefon() { return $this->telefon; }
    public function setTelefon($telefon) { $this->telefon = $telefon; }

    public function getUkupanBrojPaketa() { return $this->ukupanBrojPaketa; }
    public function setUkupanBrojPaketa($ukupanBrojPaketa) { $this->ukupanBrojPaketa = $ukupanBrojPaketa; }

    public function getStariIdKurira() { return $this->stariIdKurira; }
    public function setStariIdKurira($stariIdKurira) { $this->stariIdKurira = $stariIdKurira; }
}
?>
