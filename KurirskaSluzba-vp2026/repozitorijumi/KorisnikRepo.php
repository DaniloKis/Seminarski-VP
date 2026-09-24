<?php
class KorisnikRepo extends Tabela {

    // Redosled kolona: 0 IDKORISNIKA, 1 PREZIME, 2 IME, 3 EMAIL, 4 KORISNICKOIME, 5 SIFRA, 6 statusucesca

    public function DohvatiSveKorisnike() {
        $upit = "SELECT IDKORISNIKA, PREZIME, IME, EMAIL, KORISNICKOIME, SIFRA, statusucesca FROM korisnik ORDER BY PREZIME ASC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function FiltrirajKorisnikaPoPrezimenu($prezime) {
        $upit = "SELECT IDKORISNIKA, PREZIME, IME, EMAIL, KORISNICKOIME, SIFRA, statusucesca FROM korisnik
                 WHERE PREZIME LIKE '%" . $prezime . "%' ORDER BY PREZIME ASC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DohvatiKorisnikaPoId(KorisnikModel $korisnikModelObjekat) {
        $upit = "SELECT IDKORISNIKA, PREZIME, IME, EMAIL, KORISNICKOIME, SIFRA, statusucesca FROM korisnik
                 WHERE IDKORISNIKA = " . (int)$korisnikModelObjekat->getIdKorisnika();
        $this->UcitajSvePoUpitu($upit);
    }

    // Za prijavu - vraca kolekciju korisnika sa datim kredencijalima (BrojZapisa > 0 => postoji)
    public function DohvatiPoKredencijalima($korisnickoIme, $sifra) {
        $upit = "SELECT IDKORISNIKA, PREZIME, IME, EMAIL, KORISNICKOIME, SIFRA, statusucesca FROM korisnik
                 WHERE KORISNICKOIME = '" . $korisnickoIme . "' AND SIFRA = '" . $sifra . "'";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DodajKorisnika(KorisnikModel $korisnikModelObjekat) {
        $upit = "INSERT INTO korisnik (PREZIME, IME, EMAIL, KORISNICKOIME, SIFRA, statusucesca)
                 VALUES (
                    '" . $korisnikModelObjekat->getPrezime() . "',
                    '" . $korisnikModelObjekat->getIme() . "',
                    '" . $korisnikModelObjekat->getEmail() . "',
                    '" . $korisnikModelObjekat->getKorisnickoIme() . "',
                    '" . $korisnikModelObjekat->getSifra() . "',
                    '" . $korisnikModelObjekat->getStatusUcesca() . "'
                 )";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function AzurirajKorisnika(KorisnikModel $korisnikModelObjekat) {
        $upit = "UPDATE korisnik SET
                    PREZIME = '" . $korisnikModelObjekat->getPrezime() . "',
                    IME = '" . $korisnikModelObjekat->getIme() . "',
                    EMAIL = '" . $korisnikModelObjekat->getEmail() . "',
                    KORISNICKOIME = '" . $korisnikModelObjekat->getKorisnickoIme() . "',
                    SIFRA = '" . $korisnikModelObjekat->getSifra() . "',
                    statusucesca = '" . $korisnikModelObjekat->getStatusUcesca() . "'
                 WHERE IDKORISNIKA = " . (int)$korisnikModelObjekat->getIdKorisnika();
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function ObrisiKorisnika(KorisnikModel $korisnikModelObjekat) {
        $upit = "DELETE FROM korisnik WHERE IDKORISNIKA = " . (int)$korisnikModelObjekat->getIdKorisnika();
        return $this->IzvrsiAktivanSQLUpit($upit);
    }
}
?>
