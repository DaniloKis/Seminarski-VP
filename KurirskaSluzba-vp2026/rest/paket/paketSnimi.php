<?php
// REST POST - dodaje novi paket (poslovna logika: kapacitet kurira + transakcija + inkrement).
chdir(__DIR__ . '/../..');
session_start();
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['korisnik'])) {
        throw new Exception("Приступ није дозвољен. Пријавите се.");
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Неправилан метод захтева.");
    }

    require_once("klase/BaznaKonekcija.php");
    require_once("klase/BaznaTabela.php");
    require_once("klase/BaznaTransakcija.php");
    require_once("klase/Upis.php");
    require_once("model/PaketModel.php");
    require_once("model/KurirModel.php");
    require_once("repozitorijumi/PaketRepo.php");
    require_once("repozitorijumi/KurirRepo.php");

    $podaci = json_decode(file_get_contents("php://input"), true);
    if (!$podaci) {
        throw new Exception("Није прослеђен валидан JSON.");
    }

    $konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
    $konekcija->connect();

    $paket = new PaketModel();
    $paket->setSifraPaketa($podaci['sifraPaketa']);
    $paket->setPosiljalac($podaci['posiljalac']);
    $paket->setAdresaPosiljaoca($podaci['adresaPosiljaoca']);
    $paket->setPrimalac($podaci['primalac']);
    $paket->setAdresaDostave($podaci['adresaDostave']);
    $paket->setOznakaUpozorenja($podaci['oznakaUpozorenja']);
    $paket->setTezina($podaci['tezina']);
    $paket->setCena($podaci['cena']);
    $paket->setStatus($podaci['status']);
    $paket->setIdKurira($podaci['idKurira']);

    // Provera poslovne logike - kapacitet kurira
    $upis = new Upis($konekcija, 'paket');
    if ($upis->DaLiImaMestaZaDodelu($paket->getIdKurira()) != "DA") {
        throw new Exception("Курир је попуњен по капацитету – не може му се доделити још пакета.");
    }

    // Transakcija: unos paketa + inkrement broja paketa kod kurira
    $transakcija = new Transakcija($konekcija);
    $transakcija->ZapocniTransakciju();

    $paketRepo = new PaketRepo($konekcija, "paket");
    $kurirRepo = new KurirRepo($konekcija, "kurir");

    $greska1 = $paketRepo->DodajPaket($paket);
    $greska2 = $kurirRepo->InkrementirajBrojPaketa($paket->getIdKurira());

    $utvrdjenaGreska = $greska1 . $greska2;
    $transakcija->ZavrsiTransakciju($utvrdjenaGreska);

    if ($utvrdjenaGreska) {
        throw new Exception($utvrdjenaGreska);
    }

    echo json_encode(["uspeh" => true, "poruka" => "Пакет је успешно додат."]);
} catch (Exception $e) {
    echo json_encode(["uspeh" => false, "poruka" => $e->getMessage()]);
}
?>
