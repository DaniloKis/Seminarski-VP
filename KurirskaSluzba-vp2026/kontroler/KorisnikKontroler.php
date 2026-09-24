<?php
require_once("kontroler/Sesija.php");
require_once("klase/BaznaKonekcija.php");
require_once("klase/BaznaTabela.php");
require_once("model/KorisnikModel.php");
require_once("repozitorijumi/KorisnikRepo.php");

class KorisnikKontroler {

    private $konekcija;
    private $korisnikRepo;

    public function __construct() {
        $this->konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
        $this->konekcija->connect();
        $this->korisnikRepo = new KorisnikRepo($this->konekcija, "korisnik");
    }

    // ---------- JAVNE AKCIJE (prijava / odjava) ----------

    // Forma za prijavu
    public function prijava() {
        if (isset($_SESSION["korisnik"])) {
            header("Location: " . OSNOVA . "/pocetna/index");
            exit;
        }
        $greska = isset($_GET['greska']);
        include("pogledi/korisnik/prijava.php");
    }

    // Obrada prijave (logika iz prijavaprovera.php)
    public function prijaviSe() {
        $korisnickoIme = $_POST['korisnickoIme'];
        $sifra = $_POST['sifra'];

        $this->korisnikRepo->DohvatiPoKredencijalima($korisnickoIme, $sifra);

        if ($this->korisnikRepo->BrojZapisa > 0) {
            $kol = $this->korisnikRepo->Kolekcija;
            $prezime = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kol, 0, 1);
            $ime = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kol, 0, 2);
            $idKorisnika = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kol, 0, 0);

            // Isti kljucevi sesije kao u postojecoj aplikaciji
            $_SESSION["prez"] = $prezime;
            $_SESSION["ime"] = $ime;
            $_SESSION["idkorisnika"] = $idKorisnika;
            $_SESSION["korisnik"] = $prezime . ' ' . $ime;

            header("Location: " . OSNOVA . "/pocetna/index");
            exit;
        } else {
            header("Location: " . OSNOVA . "/korisnik/prijava?greska=1");
            exit;
        }
    }

    public function odjava() {
        session_unset();
        session_destroy();
        header("Location: " . OSNOVA . "/korisnik/prijava");
        exit;
    }

    // ---------- ZASTICENE AKCIJE (administracija korisnika) ----------

    public function index() {
        proveriPrijavu();
        $this->korisnikRepo->DohvatiSveKorisnike();
        include("pogledi/korisnik/lista.php");
    }

    public function pretraga() {
        proveriPrijavu();
        $prezime = isset($_POST['prezime']) ? $_POST['prezime'] : '';
        $this->korisnikRepo->FiltrirajKorisnikaPoPrezimenu($prezime);
        include("pogledi/korisnik/lista.php");
    }

    public function prikazRest() {
        proveriPrijavu();
        include("pogledi/korisnik/prikazRest.php");
    }

    public function dodajForm() {
        proveriPrijavu();
        include("pogledi/korisnik/dodaj.php");
    }

    public function dodaj() {
        proveriPrijavu();
        $korisnik = $this->popuniIzPosta();
        $greska = $this->korisnikRepo->DodajKorisnika($korisnik);
        if ($greska) {
            echo "Грешка: " . $greska . "<br><br><a href='" . OSNOVA . "/korisnik/dodajForm'>Назад</a>";
            return;
        }
        header("Location: " . OSNOVA . "/korisnik/index");
        exit;
    }

    public function izmeniForm($id = null) {
        proveriPrijavu();
        if ($id === null && isset($_POST['IDKorisnika'])) {
            $id = $_POST['IDKorisnika'];
        }
        $korisnikModel = new KorisnikModel();
        $korisnikModel->setIdKorisnika($id);
        $this->korisnikRepo->DohvatiKorisnikaPoId($korisnikModel);
        include("pogledi/korisnik/izmeni.php");
    }

    public function izmeni() {
        proveriPrijavu();
        $korisnik = $this->popuniIzPosta();
        $korisnik->setIdKorisnika($_POST['idKorisnika']);
        $greska = $this->korisnikRepo->AzurirajKorisnika($korisnik);
        if ($greska) {
            echo "Грешка: " . $greska . "<br><br><a href='" . OSNOVA . "/korisnik/index'>Назад</a>";
            return;
        }
        header("Location: " . OSNOVA . "/korisnik/index");
        exit;
    }

    public function obrisi($id = null) {
        proveriPrijavu();
        if ($id === null && isset($_POST['IDKorisnika'])) {
            $id = $_POST['IDKorisnika'];
        }
        $korisnikModel = new KorisnikModel();
        $korisnikModel->setIdKorisnika($id);
        $this->korisnikRepo->ObrisiKorisnika($korisnikModel);
        header("Location: " . OSNOVA . "/korisnik/index");
        exit;
    }

    private function popuniIzPosta() {
        $korisnik = new KorisnikModel();
        $korisnik->setPrezime($_POST['prezime']);
        $korisnik->setIme($_POST['ime']);
        $korisnik->setEmail($_POST['email']);
        $korisnik->setKorisnickoIme($_POST['korisnickoIme']);
        $korisnik->setSifra($_POST['sifra']);
        $korisnik->setStatusUcesca($_POST['statusUcesca']);
        return $korisnik;
    }
}
?>
