<?php
// Master (celina) - otpremnica koja u sebi nosi listu stavki (StavkaModel).
class OtpremnicaModel {

    private $brojOtpremnice;
    private $datum;
    private $posiljalac;
    private $adresaPreuzimanja;
    private $idKurira;
    private $ukupnaCena;
    private $status;
    private $stavke = []; // lista StavkaModel objekata (delovi)

    public function getBrojOtpremnice() { return $this->brojOtpremnice; }
    public function setBrojOtpremnice($brojOtpremnice) { $this->brojOtpremnice = $brojOtpremnice; }

    public function getDatum() { return $this->datum; }
    public function setDatum($datum) { $this->datum = $datum; }

    public function getPosiljalac() { return $this->posiljalac; }
    public function setPosiljalac($posiljalac) { $this->posiljalac = $posiljalac; }

    public function getAdresaPreuzimanja() { return $this->adresaPreuzimanja; }
    public function setAdresaPreuzimanja($adresaPreuzimanja) { $this->adresaPreuzimanja = $adresaPreuzimanja; }

    public function getIdKurira() { return $this->idKurira; }
    public function setIdKurira($idKurira) { $this->idKurira = $idKurira; }

    public function getUkupnaCena() { return $this->ukupnaCena; }
    public function setUkupnaCena($ukupnaCena) { $this->ukupnaCena = $ukupnaCena; }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = $status; }

    public function getStavke() { return $this->stavke; }
    public function setStavke(array $stavke) { $this->stavke = $stavke; }

    // Dodavanje jedne stavke (dela) u listu
    public function dodajStavku(StavkaModel $stavka) {
        $this->stavke[] = $stavka;
    }
}
?>
