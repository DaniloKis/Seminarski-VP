<?php
// REST DELETE - brise korisnika.
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
    require_once("model/KorisnikModel.php");
    require_once("repozitorijumi/KorisnikRepo.php");

    $podaci = json_decode(file_get_contents("php://input"), true);
    if (!$podaci || empty($podaci['idKorisnika'])) {
        throw new Exception("ИД корисника је обавезан.");
    }

    $konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
    $konekcija->connect();

    $korisnikModel = new KorisnikModel();
    $korisnikModel->setIdKorisnika($podaci['idKorisnika']);

    $korisnikRepo = new KorisnikRepo($konekcija, "korisnik");
    $greska = $korisnikRepo->ObrisiKorisnika($korisnikModel);

    if ($greska) {
        throw new Exception($greska);
    }

    echo json_encode(["uspeh" => true, "poruka" => "Корисник је успешно обрисан."]);
} catch (Exception $e) {
    echo json_encode(["uspeh" => false, "poruka" => $e->getMessage()]);
}
?>
