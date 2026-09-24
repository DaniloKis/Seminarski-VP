<?php
class PaketRepo extends Tabela {

    // Redosled kolona (indeksi za DajVrednostPoRednomBrojuZapisaPoRBPolja):
    // 0 SifraPaketa, 1 Posiljalac, 2 AdresaPosiljaoca, 3 Primalac, 4 AdresaDostave,
    // 5 OznakaUpozorenja, 6 Tezina, 7 Cena, 8 Status, 9 IDKurira, 10 Kurir (Ime Prezime)

    private function OsnovniUpit() {
        // Sve kolone su vec definisane u pogledu (PAKET INNER JOIN KURIR),
        // redosledom naznacenim u komentaru iznad, pa je dovoljno SELECT *.
        return "SELECT * FROM SviPodaciOPaketima";
    }

    public function DohvatiSvePakete() {
        $upit = $this->OsnovniUpit() . " ORDER BY Primalac ASC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function FiltrirajPaketPoSifri($sifra) {
        $upit = $this->OsnovniUpit() . " WHERE SifraPaketa LIKE '%" . $sifra . "%' ORDER BY Primalac ASC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DohvatiPaketPoSifri(PaketModel $paketModelObjekat) {
        $upit = $this->OsnovniUpit() . " WHERE SifraPaketa = '" . $paketModelObjekat->getSifraPaketa() . "'";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DajIDKuriraPaketa($sifra) {
        $upit = "SELECT IDKurira FROM paket WHERE SifraPaketa = '" . $sifra . "'";
        $this->UcitajSvePoUpitu($upit);
        return $this->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->Kolekcija, 0, 0);
    }

    public function DodajPaket(PaketModel $paketModelObjekat) {
        $upit = "INSERT INTO paket (SifraPaketa, Posiljalac, AdresaPosiljaoca, Primalac, AdresaDostave, OznakaUpozorenja, Tezina, Cena, Status, IDKurira)
                 VALUES (
                    '" . $paketModelObjekat->getSifraPaketa() . "',
                    '" . $paketModelObjekat->getPosiljalac() . "',
                    '" . $paketModelObjekat->getAdresaPosiljaoca() . "',
                    '" . $paketModelObjekat->getPrimalac() . "',
                    '" . $paketModelObjekat->getAdresaDostave() . "',
                    '" . $paketModelObjekat->getOznakaUpozorenja() . "',
                    '" . $paketModelObjekat->getTezina() . "',
                    '" . $paketModelObjekat->getCena() . "',
                    '" . $paketModelObjekat->getStatus() . "',
                    '" . $paketModelObjekat->getIdKurira() . "'
                 )";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    // Unos primenom stored procedure `DodajPaket` (isti kao stari DBPaketSP)
    public function DodajPaketSP(PaketModel $p) {
        $g  = $this->IzvrsiAktivanSQLUpit("SET @SifraPaketaParametar='" . $p->getSifraPaketa() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @PosiljalacParametar='" . $p->getPosiljalac() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @AdresaPosiljaocaParametar='" . $p->getAdresaPosiljaoca() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @PrimalacParametar='" . $p->getPrimalac() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @AdresaDostaveParametar='" . $p->getAdresaDostave() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @OznakaUpozorenjaParametar='" . $p->getOznakaUpozorenja() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @TezinaParametar='" . $p->getTezina() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @CenaParametar='" . $p->getCena() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @StatusParametar='" . $p->getStatus() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("SET @IDKuriraParametar='" . $p->getIdKurira() . "'");
        $g .= $this->IzvrsiAktivanSQLUpit("CALL `DodajPaket`(@SifraPaketaParametar,@PosiljalacParametar,@AdresaPosiljaocaParametar,@PrimalacParametar,@AdresaDostaveParametar,@OznakaUpozorenjaParametar,@TezinaParametar,@CenaParametar,@StatusParametar,@IDKuriraParametar);");
        return $g;
    }

    public function AzurirajPaket(PaketModel $paketModelObjekat) {
        $upit = "UPDATE paket SET
                    SifraPaketa = '" . $paketModelObjekat->getSifraPaketa() . "',
                    Posiljalac = '" . $paketModelObjekat->getPosiljalac() . "',
                    AdresaPosiljaoca = '" . $paketModelObjekat->getAdresaPosiljaoca() . "',
                    Primalac = '" . $paketModelObjekat->getPrimalac() . "',
                    AdresaDostave = '" . $paketModelObjekat->getAdresaDostave() . "',
                    OznakaUpozorenja = '" . $paketModelObjekat->getOznakaUpozorenja() . "',
                    Tezina = '" . $paketModelObjekat->getTezina() . "',
                    Cena = '" . $paketModelObjekat->getCena() . "',
                    Status = '" . $paketModelObjekat->getStatus() . "',
                    IDKurira = '" . $paketModelObjekat->getIdKurira() . "'
                 WHERE SifraPaketa = '" . $paketModelObjekat->getStaraSifra() . "'";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function ObrisiPaket(PaketModel $paketModelObjekat) {
        $upit = "DELETE FROM paket WHERE SifraPaketa = '" . $paketModelObjekat->getSifraPaketa() . "'";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }
}
?>
