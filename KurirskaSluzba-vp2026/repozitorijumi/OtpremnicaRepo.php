<?php
class OtpremnicaRepo extends Tabela {

    // Redosled kolona (JOIN sa kurir):
    // 0 BrojOtpremnice, 1 Datum, 2 Posiljalac, 3 AdresaPreuzimanja, 4 IDKurira, 5 UkupnaCena, 6 Status, 7 Kurir (Ime Prezime)

    private function OsnovniUpit() {
        return "SELECT o.BrojOtpremnice, o.Datum, o.Posiljalac, o.AdresaPreuzimanja, o.IDKurira, o.UkupnaCena, o.Status,
                       CONCAT(k.Ime, ' ', k.Prezime) AS Kurir
                FROM otpremnica o JOIN kurir k ON o.IDKurira = k.IDKurira";
    }

    public function DohvatiSveOtpremnice() {
        $upit = $this->OsnovniUpit() . " ORDER BY o.BrojOtpremnice DESC";
        $this->UcitajSvePoUpitu($upit);
    }

    public function DohvatiOtpremnicuPoId(OtpremnicaModel $otpremnicaModelObjekat) {
        $upit = $this->OsnovniUpit() . " WHERE o.BrojOtpremnice = " . (int)$otpremnicaModelObjekat->getBrojOtpremnice();
        $this->UcitajSvePoUpitu($upit);
    }

    // Upis zaglavlja (celine)
    public function DodajOtpremnicu(OtpremnicaModel $otpremnicaModelObjekat) {
        $upit = "INSERT INTO otpremnica (Datum, Posiljalac, AdresaPreuzimanja, IDKurira, UkupnaCena, Status)
                 VALUES (
                    '" . $otpremnicaModelObjekat->getDatum() . "',
                    '" . $otpremnicaModelObjekat->getPosiljalac() . "',
                    '" . $otpremnicaModelObjekat->getAdresaPreuzimanja() . "',
                    '" . $otpremnicaModelObjekat->getIdKurira() . "',
                    " . (float)$otpremnicaModelObjekat->getUkupnaCena() . ",
                    '" . $otpremnicaModelObjekat->getStatus() . "'
                 )";
        return $this->IzvrsiAktivanSQLUpit($upit);
    }

    // ID poslednje unete otpremnice (AUTO_INCREMENT) - po tekucoj konekciji
    public function DajPoslednjiId() {
        return mysqli_insert_id($this->OtvorenaKonekcija->konekcijaDB);
    }

    public function ObrisiOtpremnicu(OtpremnicaModel $otpremnicaModelObjekat) {
        // FK ON DELETE CASCADE brise i pripadajuce stavke
        $upit = "DELETE FROM otpremnica WHERE BrojOtpremnice = " . (int)$otpremnicaModelObjekat->getBrojOtpremnice();
        return $this->IzvrsiAktivanSQLUpit($upit);
    }
}
?>
