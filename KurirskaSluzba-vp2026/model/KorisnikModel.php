<?php
class KorisnikModel {

    private $idKorisnika;
    private $prezime;
    private $ime;
    private $email;
    private $korisnickoIme;
    private $sifra;
    private $statusUcesca;

    // GETTERI I SETTERI

    public function getIdKorisnika() { return $this->idKorisnika; }
    public function setIdKorisnika($idKorisnika) { $this->idKorisnika = $idKorisnika; }

    public function getPrezime() { return $this->prezime; }
    public function setPrezime($prezime) { $this->prezime = $prezime; }

    public function getIme() { return $this->ime; }
    public function setIme($ime) { $this->ime = $ime; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getKorisnickoIme() { return $this->korisnickoIme; }
    public function setKorisnickoIme($korisnickoIme) { $this->korisnickoIme = $korisnickoIme; }

    public function getSifra() { return $this->sifra; }
    public function setSifra($sifra) { $this->sifra = $sifra; }

    public function getStatusUcesca() { return $this->statusUcesca; }
    public function setStatusUcesca($statusUcesca) { $this->statusUcesca = $statusUcesca; }
}
?>
