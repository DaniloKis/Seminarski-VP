<?php
class KurirRepo extends Tabela {

    // Redosled kolona: 0 IDKurira, 1 Prezime, 2 Ime, 3 Telefon, 4 UkupanBrojPaketa

    public function DohvatiSveKurire() {
        $upit = "SELECT IDKurira, Prezime, Ime, Telefon, UkupanBrojPaketa FROM kurir ORDER BY Prezime ASC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function FiltrirajKuriraPoPrezimenu($prezime) {
        $upit = "SELECT IDKurira, Prezime, Ime, Telefon, UkupanBrojPaketa FROM kurir
                 WHERE Prezime LIKE '%" . $prezime . "%' ORDER BY Prezime ASC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DohvatiKuriraPoId(KurirModel $kurirModelObjekat) {
        $upit = "SELECT IDKurira, Prezime, Ime, Telefon, UkupanBrojPaketa FROM kurir
                 WHERE IDKurira = '" . $kurirModelObjekat->getIdKurira() . "'";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DodajKurira(KurirModel $kurirModelObjekat) {
        $upit = "INSERT INTO kurir (IDKurira, Prezime, Ime, Telefon, UkupanBrojPaketa)
                 VALUES (
                    '" . $kurirModelObjekat->getIdKurira() . "',
                    '" . $kurirModelObjekat->getPrezime() . "',
                    '" . $kurirModelObjekat->getIme() . "',
                    '" . $kurirModelObjekat->getTelefon() . "',
                    '" . (int)$kurirModelObjekat->getUkupanBrojPaketa() . "'
                 )";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function AzurirajKurira(KurirModel $kurirModelObjekat) {
        $upit = "UPDATE kurir SET
                    IDKurira = '" . $kurirModelObjekat->getIdKurira() . "',
                    Prezime = '" . $kurirModelObjekat->getPrezime() . "',
                    Ime = '" . $kurirModelObjekat->getIme() . "',
                    Telefon = '" . $kurirModelObjekat->getTelefon() . "',
                    UkupanBrojPaketa = '" . (int)$kurirModelObjekat->getUkupanBrojPaketa() . "'
                 WHERE IDKurira = '" . $kurirModelObjekat->getStariIdKurira() . "'";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function ObrisiKurira(KurirModel $kurirModelObjekat) {
        $upit = "DELETE FROM kurir WHERE IDKurira = '" . $kurirModelObjekat->getIdKurira() . "'";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function InkrementirajBrojPaketa($idKurira) {
        $kriterijum = "IDKurira='" . $idKurira . "'";
        $stara = $this->DajVrednostJednogPoljaPrvogZapisa('UkupanBrojPaketa', $kriterijum, 'UkupanBrojPaketa');
        $nova = $stara + 1;
        $upit = "UPDATE kurir SET UkupanBrojPaketa=" . $nova . " WHERE IDKurira='" . $idKurira . "'";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function DekrementirajBrojPaketa($idKurira) {
        $kriterijum = "IDKurira='" . $idKurira . "'";
        $stara = $this->DajVrednostJednogPoljaPrvogZapisa('UkupanBrojPaketa', $kriterijum, 'UkupanBrojPaketa');
        $nova = $stara - 1;
        $upit = "UPDATE kurir SET UkupanBrojPaketa=" . $nova . " WHERE IDKurira='" . $idKurira . "'";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }
}
?>
