<?php
// REST DELETE - brise kurira (FK ON DELETE RESTRICT: ne moze ako ima pakete).
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
    require_once("model/KurirModel.php");
    require_once("repozitorijumi/KurirRepo.php");

    $podaci = json_decode(file_get_contents("php://input"), true);
    if (!$podaci || empty($podaci['idKurira'])) {
        throw new Exception("ИД курира је обавезан.");
    }

    $konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
    $konekcija->connect();

    $kurirModel = new KurirModel();
    $kurirModel->setIdKurira($podaci['idKurira']);

    $kurirRepo = new KurirRepo($konekcija, "kurir");
    $greska = $kurirRepo->ObrisiKurira($kurirModel);

    if ($greska) {
        throw new Exception("Није могуће обрисати курира (можда има додељене пакете). " . $greska);
    }

    echo json_encode(["uspeh" => true, "poruka" => "Курир је успешно обрисан."]);
} catch (Exception $e) {
    echo json_encode(["uspeh" => false, "poruka" => $e->getMessage()]);
}
?>
