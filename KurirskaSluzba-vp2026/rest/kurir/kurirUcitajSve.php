<?php
// REST GET - vraca sve kurire (ili filtrirano po prezimenu) kao JSON.
chdir(__DIR__ . '/../..');
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['korisnik'])) { echo json_encode([]); exit; }

require_once("klase/BaznaKonekcija.php");
require_once("klase/BaznaTabela.php");
require_once("model/KurirModel.php");
require_once("repozitorijumi/KurirRepo.php");

$konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
$konekcija->connect();
$kurirRepo = new KurirRepo($konekcija, "kurir");

$prezime = isset($_GET['prezime']) ? $_GET['prezime'] : '';

if ($prezime !== '') {
    $kurirRepo->FiltrirajKuriraPoPrezimenu($prezime);
} else {
    $kurirRepo->DohvatiSveKurire();
}

$rezultat = [];
for ($i = 0; $i < $kurirRepo->BrojZapisa; $i++) {
    $rezultat[] = [
        'idKurira'         => $kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kurirRepo->Kolekcija, $i, 0),
        'prezime'          => $kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kurirRepo->Kolekcija, $i, 1),
        'ime'              => $kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kurirRepo->Kolekcija, $i, 2),
        'telefon'          => $kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kurirRepo->Kolekcija, $i, 3),
        'ukupanBrojPaketa' => $kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($kurirRepo->Kolekcija, $i, 4)
    ];
}

$konekcija->disconnect();
echo json_encode($rezultat);
exit;
?>
