<?php
// REST PUT - menja postojeci paket.
chdir(__DIR__ . '/../..');
session_start();
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['korisnik'])) {
        throw new Exception("Приступ није дозвољен. Пријавите се.");
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
        throw new Exception("Неправилан метод захтева.");
    }

    require_once("klase/BaznaKonekcija.php");
    require_once("klase/BaznaTabela.php");
    require_once("model/PaketModel.php");
    require_once("repozitorijumi/PaketRepo.php");

    $podaci = json_decode(file_get_contents("php://input"), true);
    if (!$podaci) {
        throw new Exception("Није прослеђен валидан JSON.");
    }
    if (empty($podaci['staraSifra'])) {
        throw new Exception("Стара шифра пакета је обавезна.");
    }

    $konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
    $konekcija->connect();

    $paket = new PaketModel();
    $paket->setStaraSifra($podaci['staraSifra']);
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

    $paketRepo = new PaketRepo($konekcija, "paket");
    $greska = $paketRepo->AzurirajPaket($paket);

    if ($greska) {
        throw new Exception($greska);
    }

    echo json_encode(["uspeh" => true, "poruka" => "Пакет је успешно измењен."]);
} catch (Exception $e) {
    echo json_encode(["uspeh" => false, "poruka" => $e->getMessage()]);
}
?>
