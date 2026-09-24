<?php
require_once("kontroler/Sesija.php");
require_once("klase/BaznaKonekcija.php");
require_once("klase/BaznaTabela.php");
require_once("model/KurirModel.php");
require_once("repozitorijumi/KurirRepo.php");

class KurirKontroler {

    private $konekcija;
    private $kurirRepo;

    public function __construct() {
        proveriPrijavu();
        $this->konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
        $this->konekcija->connect();
        $this->kurirRepo = new KurirRepo($this->konekcija, "kurir");
    }

    public function index() {
        $this->kurirRepo->DohvatiSveKurire();
        include("pogledi/kurir/lista.php");
    }

    public function pretraga() {
        $prezime = isset($_POST['prezime']) ? $_POST['prezime'] : '';
        $this->kurirRepo->FiltrirajKuriraPoPrezimenu($prezime);
        include("pogledi/kurir/lista.php");
    }

    public function prikazRest() {
        include("pogledi/kurir/prikazRest.php");
    }

    public function dodajForm() {
        include("pogledi/kurir/dodaj.php");
    }

    public function dodaj() {
        $kurir = $this->popuniIzPosta();
        $kurir->setUkupanBrojPaketa(0); // novi kurir pocinje sa 0 paketa
        $greska = $this->kurirRepo->DodajKurira($kurir);
        if ($greska) {
            echo "Грешка: " . $greska . "<br><br><a href='" . OSNOVA . "/kurir/dodajForm'>Назад</a>";
            return;
        }
        header("Location: " . OSNOVA . "/kurir/index");
        exit;
    }

    public function izmeniForm($id = null) {
        if ($id === null && isset($_POST['IDKurira'])) {
            $id = $_POST['IDKurira'];
        }
        $id = rawurldecode($id);

        $kurirModel = new KurirModel();
        $kurirModel->setIdKurira($id);
        $this->kurirRepo->DohvatiKuriraPoId($kurirModel);
        include("pogledi/kurir/izmeni.php");
    }

    public function izmeni() {
        $kurir = $this->popuniIzPosta();
        $kurir->setStariIdKurira($_POST['stariIdKurira']);
        $greska = $this->kurirRepo->AzurirajKurira($kurir);
        if ($greska) {
            echo "Грешка: " . $greska . "<br><br><a href='" . OSNOVA . "/kurir/index'>Назад</a>";
            return;
        }
        header("Location: " . OSNOVA . "/kurir/index");
        exit;
    }

    public function obrisi($id = null) {
        if ($id === null && isset($_POST['IDKurira'])) {
            $id = $_POST['IDKurira'];
        }
        $id = rawurldecode($id);

        $kurirModel = new KurirModel();
        $kurirModel->setIdKurira($id);
        $greska = $this->kurirRepo->ObrisiKurira($kurirModel);

        // FK ON DELETE RESTRICT - ako kurir ima pakete, brisanje nije dozvoljeno
        if ($greska) {
            echo "Није могуће обрисати курира (можда има додељене пакете).<br>Грешка: " . $greska;
            echo "<br><br><a href='" . OSNOVA . "/kurir/index'>Назад</a>";
            return;
        }
        header("Location: " . OSNOVA . "/kurir/index");
        exit;
    }

    private function popuniIzPosta() {
        $kurir = new KurirModel();
        $kurir->setIdKurira($_POST['idKurira']);
        $kurir->setPrezime($_POST['prezime']);
        $kurir->setIme($_POST['ime']);
        $kurir->setTelefon($_POST['telefon']);
        if (isset($_POST['ukupanBrojPaketa'])) {
            $kurir->setUkupanBrojPaketa($_POST['ukupanBrojPaketa']);
        }
        return $kurir;
    }
}
?>
