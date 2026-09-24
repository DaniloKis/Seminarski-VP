<?php
// REST DELETE - brise paket (transakcija + dekrement broja paketa kod kurira).
chdir(__DIR__ . '/../..');
session_start();
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['korisnik'])) {
        throw new Exception("Приступ није дозвољен. Пријавите се.");
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
        throw new Exception("Неправилан метод захтева.");
    }

    require_once("klase/BaznaKonekcija.php");
    require_once("klase/BaznaTabela.php");
    require_once("klase/BaznaTransakcija.php");
    require_once("model/PaketModel.php");
    require_once("repozitorijumi/PaketRepo.php");
    require_once("repozitorijumi/KurirRepo.php");

    $podaci = json_decode(file_get_contents("php://input"), true);
    if (!$podaci || empty($podaci['sifraPaketa'])) {
        throw new Exception("Шифра пакета је обавезна.");
    }

    $konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
    $konekcija->connect();

    $sifra = $podaci['sifraPaketa'];

    $transakcija = new Transakcija($konekcija);
    $transakcija->ZapocniTransakciju();

    $paketRepo = new PaketRepo($konekcija, "paket");
    $kurirRepo = new KurirRepo($konekcija, "kurir");

    $idKurira = $paketRepo->DajIDKuriraPaketa($sifra);

    $paketModel = new PaketModel();
    $paketModel->setSifraPaketa($sifra);
    $greska1 = $paketRepo->ObrisiPaket($paketModel);
    $greska2 = $kurirRepo->DekrementirajBrojPaketa($idKurira);

    $utvrdjenaGreska = $greska1 . $greska2;
    $transakcija->ZavrsiTransakciju($utvrdjenaGreska);

    if ($utvrdjenaGreska) {
        throw new Exception($utvrdjenaGreska);
    }

    echo json_encode(["uspeh" => true, "poruka" => "Пакет је успешно обрисан."]);
} catch (Exception $e) {
    echo json_encode(["uspeh" => false, "poruka" => $e->getMessage()]);
}
?>
