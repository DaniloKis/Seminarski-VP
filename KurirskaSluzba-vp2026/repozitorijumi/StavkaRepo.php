<?php
class StavkaRepo extends Tabela {

    // Redosled kolona: 0 IDStavke, 1 BrojOtpremnice, 2 Primalac, 3 AdresaDostave, 4 OznakaUpozorenja, 5 Tezina, 6 Cena

    // Upis jedne stavke (dela) vezane za otpremnicu
    public function DodajStavku(StavkaModel $stavkaModelObjekat) {
        $upit = "INSERT INTO otpremnicastavka (BrojOtpremnice, Primalac, AdresaDostave, OznakaUpozorenja, Tezina, Cena)
                 VALUES (
                    " . (int)$stavkaModelObjekat->getBrojOtpremnice() . ",
                    '" . $stavkaModelObjekat->getPrimalac() . "',
                    '" . $stavkaModelObjekat->getAdresaDostave() . "',
                    '" . $stavkaModelObjekat->getOznakaUpozorenja() . "',
                    '" . $stavkaModelObjekat->getTezina() . "',
                    '" . $stavkaModelObjekat->getCena() . "'
                 )";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    public function DajStavkeZaOtpremnicu($brojOtpremnice) {
        $upit = "SELECT IDStavke, BrojOtpremnice, Primalac, AdresaDostave, OznakaUpozorenja, Tezina, Cena
                 FROM otpremnicastavka WHERE BrojOtpremnice = " . (int)$brojOtpremnice . " ORDER BY IDStavke ASC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DajBrojStavki($brojOtpremnice) {
        $upit = "SELECT COUNT(*) FROM otpremnicastavka WHERE BrojOtpremnice = " . (int)$brojOtpremnice;
        $this->UcitajSvePoUpitu($upit);
        return (int)$this->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->Kolekcija, 0, 0);
    }
}
?>
