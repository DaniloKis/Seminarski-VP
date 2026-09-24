<?php
require_once("kontroler/Sesija.php");
require_once("klase/BaznaKonekcija.php");
require_once("klase/BaznaTabela.php");
require_once("klase/BaznaTransakcija.php");
require_once("model/StavkaModel.php");
require_once("model/OtpremnicaModel.php");
require_once("model/KurirModel.php");
require_once("repozitorijumi/OtpremnicaRepo.php");
require_once("repozitorijumi/StavkaRepo.php");
require_once("repozitorijumi/KurirRepo.php");

class OtpremnicaKontroler {

    private $konekcija;
    private $otpremnicaRepo;
    private $stavkaRepo;
    private $kurirRepo;

    public function __construct() {
        proveriPrijavu();
        $this->konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
        $this->konekcija->connect();
        $this->otpremnicaRepo = new OtpremnicaRepo($this->konekcija, "otpremnica");
        $this->stavkaRepo = new StavkaRepo($this->konekcija, "otpremnicastavka");
        $this->kurirRepo = new KurirRepo($this->konekcija, "kurir");
    }

    // MASTER - tabelarni prikaz svih otpremnica
    public function index() {
        $this->otpremnicaRepo->DohvatiSveOtpremnice();
        include("pogledi/otpremnica/lista.php");
    }

    // MASTER-DETAIL prikaz jedne otpremnice sa njenim stavkama
    public function detalji($broj = null) {
        if ($broj === null && isset($_GET['broj'])) { $broj = $_GET['broj']; }

        $otpremnicaModel = new OtpremnicaModel();
        $otpremnicaModel->setBrojOtpremnice($broj);
        $this->otpremnicaRepo->DohvatiOtpremnicuPoId($otpremnicaModel);

        $this->stavkaRepo->DajStavkeZaOtpremnicu($broj);
        include("pogledi/otpremnica/detalji.php");
    }

    // Ekranska forma za unos (zaglavlje + dinamicke stavke)
    public function dodajForm() {
        $this->kurirRepo->DohvatiSveKurire();
        include("pogledi/otpremnica/dodaj.php");
    }

    // TRANSAKCIONI upis: 1 zaglavlje + N stavki + inkrement kurira - sve ili nista
    public function snimi() {
        // --- zaglavlje (celina) ---
        $otpremnica = new OtpremnicaModel();
        $otpremnica->setDatum($_POST['datum']);
        $otpremnica->setPosiljalac($_POST['posiljalac']);
        $otpremnica->setAdresaPreuzimanja($_POST['adresaPreuzimanja']);
        $otpremnica->setIdKurira($_POST['idKurira']);
        $otpremnica->setStatus($_POST['status']);

        // --- stavke (delovi) iz paralelnih nizova sa forme ---
        $primaoci   = isset($_POST['primalac']) && is_array($_POST['primalac']) ? $_POST['primalac'] : [];
        $adrese     = isset($_POST['adresaDostave']) ? $_POST['adresaDostave'] : [];
        $upozorenja = isset($_POST['oznakaUpozorenja']) ? $_POST['oznakaUpozorenja'] : [];
        $tezine     = isset($_POST['tezina']) ? $_POST['tezina'] : [];
        $cene       = isset($_POST['cena']) ? $_POST['cena'] : [];

        $ukupno = 0;
        for ($i = 0; $i < count($primaoci); $i++) {
            if (trim($primaoci[$i]) === '') { continue; } // preskoci prazan red
            $stavka = new StavkaModel();
            $stavka->setPrimalac($primaoci[$i]);
            $stavka->setAdresaDostave($adrese[$i]);
            $stavka->setOznakaUpozorenja($upozorenja[$i]);
            $stavka->setTezina($tezine[$i]);
            $stavka->setCena($cene[$i]);
            $otpremnica->dodajStavku($stavka);
            $ukupno += (float)$cene[$i];
        }

        $brojStavki = count($otpremnica->getStavke());
        if ($brojStavki == 0) {
            echo "Отпремница мора имати бар једну ставку.<br><br><a href='" . OSNOVA . "/otpremnica/dodajForm'>Назад</a>";
            return;
        }
        $otpremnica->setUkupnaCena($ukupno);

        // --- provera kapaciteta kurira (trenutno + broj novih <= maksimum) ---
        $kurirModel = new KurirModel();
        $kurirModel->setIdKurira($otpremnica->getIdKurira());
        $this->kurirRepo->DohvatiKuriraPoId($kurirModel);
        $trenutno = (int)$this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, 0, 4);
        $maks = $this->maksKapacitet($otpremnica->getIdKurira());

        if ($trenutno + $brojStavki > $maks) {
            echo "Курир нема довољан капацитет: тренутно $trenutno, тражи се још $brojStavki, максимум $maks."
               . "<br><br><a href='" . OSNOVA . "/otpremnica/dodajForm'>Назад</a>";
            return;
        }

        // --- TRANSAKCIJA: zaglavlje + sve stavke + inkrement kurira ---
        $transakcija = new Transakcija($this->konekcija);
        $transakcija->ZapocniTransakciju();

        $greska = $this->otpremnicaRepo->DodajOtpremnicu($otpremnica);
        $brojOtpremnice = $this->otpremnicaRepo->DajPoslednjiId();

        foreach ($otpremnica->getStavke() as $stavka) {
            $stavka->setBrojOtpremnice($brojOtpremnice);
            $greska .= $this->stavkaRepo->DodajStavku($stavka);
        }

        // svaka stavka je jedan paket -> uvecaj brojac paketa kurira
        for ($j = 0; $j < $brojStavki; $j++) {
            $greska .= $this->kurirRepo->InkrementirajBrojPaketa($otpremnica->getIdKurira());
        }

        $transakcija->ZavrsiTransakciju($greska);

        if ($greska) {
            echo "Грешка при снимању (трансакција поништена): " . $greska
               . "<br><br><a href='" . OSNOVA . "/otpremnica/dodajForm'>Назад</a>";
            return;
        }

        header("Location: " . OSNOVA . "/otpremnica/detalji/" . $brojOtpremnice);
        exit;
    }

    // TRANSAKCIONO brisanje: brise otpremnicu (cascade brise stavke) + dekrementira kurira
    public function obrisi($broj = null) {
        if ($broj === null && isset($_POST['BrojOtpremnice'])) { $broj = $_POST['BrojOtpremnice']; }

        $otpremnicaModel = new OtpremnicaModel();
        $otpremnicaModel->setBrojOtpremnice($broj);
        $this->otpremnicaRepo->DohvatiOtpremnicuPoId($otpremnicaModel);

        if ($this->otpremnicaRepo->BrojZapisa == 0) {
            header("Location: " . OSNOVA . "/otpremnica/index");
            exit;
        }

        $idKurira = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->otpremnicaRepo->Kolekcija, 0, 4);
        $brojStavki = $this->stavkaRepo->DajBrojStavki($broj);

        $transakcija = new Transakcija($this->konekcija);
        $transakcija->ZapocniTransakciju();

        $greska = $this->otpremnicaRepo->ObrisiOtpremnicu($otpremnicaModel);
        for ($j = 0; $j < $brojStavki; $j++) {
            $greska .= $this->kurirRepo->DekrementirajBrojPaketa($idKurira);
        }

        $transakcija->ZavrsiTransakciju($greska);

        header("Location: " . OSNOVA . "/otpremnica/index");
        exit;
    }

    // Maksimalan kapacitet kurira iz klase/{IDKurira}.xml (ako fajl ne postoji -> bez limita)
    private function maksKapacitet($idKurira) {
        $putanja = "klase/" . $idKurira . ".xml";
        if (file_exists($putanja)) {
            $xml = simplexml_load_file($putanja);
            return (int)$xml->MaxBrPaketa;
        }
        return PHP_INT_MAX;
    }
}
?>
