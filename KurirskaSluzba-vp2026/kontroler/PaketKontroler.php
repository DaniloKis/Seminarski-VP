<?php
require_once("kontroler/Sesija.php");
require_once("klase/BaznaKonekcija.php");
require_once("klase/BaznaTabela.php");
require_once("klase/BaznaTransakcija.php");
require_once("klase/Upis.php");
require_once("model/PaketModel.php");
require_once("model/KurirModel.php");
require_once("repozitorijumi/PaketRepo.php");
require_once("repozitorijumi/KurirRepo.php");

class PaketKontroler {

    private $konekcija;
    private $paketRepo;
    private $kurirRepo;

    public function __construct() {
        proveriPrijavu();
        $this->konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
        $this->konekcija->connect();
        $this->paketRepo = new PaketRepo($this->konekcija, "paket");
        $this->kurirRepo = new KurirRepo($this->konekcija, "kurir");
    }

    // READ - server-rendered lista (klasican MVC prikaz)
    public function index() {
        $this->paketRepo->DohvatiSvePakete();
        include("pogledi/paket/lista.php");
    }

    // Pretraga po sifri paketa
    public function pretraga() {
        $sifra = isset($_POST['sifra']) ? $_POST['sifra'] : '';
        $this->paketRepo->FiltrirajPaketPoSifri($sifra);
        include("pogledi/paket/lista.php");
    }

    // REST-vodjeni prikaz (lista se puni preko fetch, dodavanje/brisanje preko REST)
    public function prikazRest() {
        $this->kurirRepo->DohvatiSveKurire(); // za padajucu listu kurira u REST forми
        include("pogledi/paket/prikazRest.php");
    }

    // Forma za REST izmenu (prepunjena serverski, cuvanje ide preko PUT/fetch)
    public function izmeniRestForm($sifra = null) {
        if ($sifra === null && isset($_POST['SifraPaketa'])) {
            $sifra = $_POST['SifraPaketa'];
        }
        $sifra = rawurldecode($sifra);

        $paketModel = new PaketModel();
        $paketModel->setSifraPaketa($sifra);
        $this->paketRepo->DohvatiPaketPoSifri($paketModel);

        $this->kurirRepo->DohvatiSveKurire();
        include("pogledi/paket/izmeniRest.php");
    }

    // CREATE forma
    public function dodajForm() {
        $this->kurirRepo->DohvatiSveKurire(); // za padajucu listu kurira
        include("pogledi/paket/dodaj.php");
    }

    // CREATE cuvanje (direktan INSERT) - poslovna logika: kapacitet + transakcija + inkrement
    public function dodaj() {
        $this->sacuvajNoviPaket($this->popuniIzPosta(), false, "dodajForm");
    }

    // CREATE forma - unos primenom stored procedure
    public function dodajSPForm() {
        $this->kurirRepo->DohvatiSveKurire();
        include("pogledi/paket/dodajSP.php");
    }

    // CREATE cuvanje primenom stored procedure `DodajPaket`
    public function dodajSP() {
        $this->sacuvajNoviPaket($this->popuniIzPosta(), true, "dodajSPForm");
    }

    // Zajednicka logika unosa: kapacitet + transakcija + (SP ili direktan) insert + inkrement kurira
    private function sacuvajNoviPaket(PaketModel $paket, $koristiSP, $povratnaForma) {
        $upis = new Upis($this->konekcija, 'paket');
        if ($upis->DaLiImaMestaZaDodelu($paket->getIdKurira()) != "DA") {
            echo "Курир је попуњен по капацитету – не може му се доделити још пакета.<br><br><a href='" . OSNOVA . "/paket/" . $povratnaForma . "'>Назад</a>";
            return;
        }

        $transakcija = new Transakcija($this->konekcija);
        $transakcija->ZapocniTransakciju();

        $greska1 = $koristiSP ? $this->paketRepo->DodajPaketSP($paket) : $this->paketRepo->DodajPaket($paket);
        $greska2 = $this->kurirRepo->InkrementirajBrojPaketa($paket->getIdKurira());

        $utvrdjenaGreska = $greska1 . $greska2;
        $transakcija->ZavrsiTransakciju($utvrdjenaGreska);

        if ($utvrdjenaGreska) {
            echo "Грешка: " . $utvrdjenaGreska . "<br><br><a href='" . OSNOVA . "/paket/" . $povratnaForma . "'>Назад</a>";
            return;
        }
        header("Location: " . OSNOVA . "/paket/index");
        exit;
    }

    // STAMPA svih paketa (opciono filtrirano po sifri preko ?sifra=)
    public function stampa() {
        $sifra = isset($_GET['sifra']) ? $_GET['sifra'] : '';
        if ($sifra !== '') {
            $this->paketRepo->FiltrirajPaketPoSifri($sifra);
        } else {
            $this->paketRepo->DohvatiSvePakete();
        }
        include("pogledi/paket/stampa.php");
    }

    // Parametarska stampa - forma za unos sifre
    public function stampaParametarska() {
        include("pogledi/paket/stampaParametarska.php");
    }

    // Stampa podataka o jednom paketu
    public function stampaPaket($sifra = null) {
        if ($sifra === null && isset($_POST['sifra'])) {
            $sifra = $_POST['sifra'];
        }
        $sifra = rawurldecode($sifra);

        $paketModel = new PaketModel();
        $paketModel->setSifraPaketa($sifra);
        $this->paketRepo->DohvatiPaketPoSifri($paketModel);
        include("pogledi/paket/stampaPaket.php");
    }

    // UPDATE forma
    public function izmeniForm($sifra = null) {
        if ($sifra === null && isset($_POST['SifraPaketa'])) {
            $sifra = $_POST['SifraPaketa'];
        }
        $sifra = rawurldecode($sifra);

        $paketModel = new PaketModel();
        $paketModel->setSifraPaketa($sifra);
        $this->paketRepo->DohvatiPaketPoSifri($paketModel);

        $this->kurirRepo->DohvatiSveKurire();
        include("pogledi/paket/izmeni.php");
    }

    // UPDATE cuvanje
    public function izmeni() {
        $paket = $this->popuniIzPosta();
        $paket->setStaraSifra($_POST['staraSifra']);
        $this->paketRepo->AzurirajPaket($paket);
        header("Location: " . OSNOVA . "/paket/index");
        exit;
    }

    // DELETE - transakcija + dekrement broja paketa kod kurira
    public function obrisi($sifra = null) {
        if ($sifra === null && isset($_POST['SifraPaketa'])) {
            $sifra = $_POST['SifraPaketa'];
        }
        $sifra = rawurldecode($sifra);

        $transakcija = new Transakcija($this->konekcija);
        $transakcija->ZapocniTransakciju();

        $idKurira = $this->paketRepo->DajIDKuriraPaketa($sifra);

        $paketModel = new PaketModel();
        $paketModel->setSifraPaketa($sifra);
        $greska1 = $this->paketRepo->ObrisiPaket($paketModel);
        $greska2 = $this->kurirRepo->DekrementirajBrojPaketa($idKurira);

        $utvrdjenaGreska = $greska1 . $greska2;
        $transakcija->ZavrsiTransakciju($utvrdjenaGreska);

        header("Location: " . OSNOVA . "/paket/index");
        exit;
    }

    // Pomocna metoda - punjenje modela iz POST podataka
    private function popuniIzPosta() {
        $paket = new PaketModel();
        $paket->setSifraPaketa($_POST['sifraPaketa']);
        $paket->setPosiljalac($_POST['posiljalac']);
        $paket->setAdresaPosiljaoca($_POST['adresaPosiljaoca']);
        $paket->setPrimalac($_POST['primalac']);
        $paket->setAdresaDostave($_POST['adresaDostave']);
        $paket->setOznakaUpozorenja($_POST['oznakaUpozorenja']);
        $paket->setTezina($_POST['tezina']);
        $paket->setCena($_POST['cena']);
        $paket->setStatus($_POST['status']);
        $paket->setIdKurira($_POST['idKurira']);
        return $paket;
    }
}
?>
