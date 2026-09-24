<?php
// Detail (deo) - jedna stavka otpremnice (jedan paket u okviru otpremnice).
class StavkaModel {

    private $idStavke;
    private $brojOtpremnice;
    private $primalac;
    private $adresaDostave;
    private $oznakaUpozorenja;
    private $tezina;
    private $cena;

    public function getIdStavke() { return $this->idStavke; }
    public function setIdStavke($idStavke) { $this->idStavke = $idStavke; }

    public function getBrojOtpremnice() { return $this->brojOtpremnice; }
    public function setBrojOtpremnice($brojOtpremnice) { $this->brojOtpremnice = $brojOtpremnice; }

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
}
?>
