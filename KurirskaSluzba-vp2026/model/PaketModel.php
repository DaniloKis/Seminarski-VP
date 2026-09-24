<?php
class PaketModel {

    private $sifraPaketa;
    private $posiljalac;
    private $adresaPosiljaoca;
    private $primalac;
    private $adresaDostave;
    private $oznakaUpozorenja;
    private $tezina;
    private $cena;
    private $status;
    private $idKurira;
    private $staraSifra; // stara vrednost primarnog kljuca - potrebno kod izmene

    // GETTERI I SETTERI

    public function getSifraPaketa() { return $this->sifraPaketa; }
    public function setSifraPaketa($sifraPaketa) { $this->sifraPaketa = $sifraPaketa; }

    public function getPosiljalac() { return $this->posiljalac; }
    public function setPosiljalac($posiljalac) { $this->posiljalac = $posiljalac; }

    public function getAdresaPosiljaoca() { return $this->adresaPosiljaoca; }
    public function setAdresaPosiljaoca($adresaPosiljaoca) { $this->adresaPosiljaoca = $adresaPosiljaoca; }

    public function getPrimalac() { return $this->primalac; }
    public function setPrimalac($primalac) { $this->primalac = $primalac; }

    public function getAdresaDostave() { return $this->adresaDostave; }
    public function setAdresaDostave($adresaDostave) { $this->adresaDostave = $adresaDostave; }

    public function getOznakaUpozorenja() { return $this->oznakaUpozorenja; }
    public function setOznakaUpozorenja($oznakaUpozorenja) { $this->oznakaUpozorenja = $oznakaUpozorenja; }

    public function getTezina() { return $this->tezina; }
    public function setTezina($tezina) { $this->tezina = $tezina; }

    public function getCena() { return $this->cena; }
    public function setCena($cena) { $this->cena = $cena; }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = $status; }

    public function getIdKurira() { return $this->idKurira; }
    public function setIdKurira($idKurira) { $this->idKurira = $idKurira; }

    public function getStaraSifra() { return $this->staraSifra; }
    public function setStaraSifra($staraSifra) { $this->staraSifra = $staraSifra; }
}
?>
