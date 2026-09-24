<?php
// REST GET - vraca sve pakete (ili filtrirano po sifri) kao JSON.
chdir(__DIR__ . '/../..'); // CWD = koren projekta (da rade "klase/..." putanje)
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['korisnik'])) { echo json_encode([]); exit; }

require_once("klase/BaznaKonekcija.php");
require_once("klase/BaznaTabela.php");
require_once("model/PaketModel.php");
require_once("repozitorijumi/PaketRepo.php");

$konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
$konekcija->connect();
$paketRepo = new PaketRepo($konekcija, "paket");

$sifra = isset($_GET['sifra']) ? $_GET['sifra'] : '';

if ($sifra !== '') {
    $paketRepo->FiltrirajPaketPoSifri($sifra);
} else {
    $paketRepo->DohvatiSvePakete();
}

$rezultat = [];
for ($i = 0; $i < $paketRepo->BrojZapisa; $i++) {
    $rezultat[] = [
        'sifraPaketa'      => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 0),
        'posiljalac'       => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 1),
        'adresaPosiljaoca' => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 2),
        'primalac'         => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 3),
        'adresaDostave'    => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 4),
        'oznakaUpozorenja' => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 5),
        'tezina'           => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 6),
        'cena'             => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 7),
        'status'           => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 8),
        'idKurira'         => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 9),
        'kurir'            => $paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($paketRepo->Kolekcija, $i, 10)
    ];
}

$konekcija->disconnect();
echo json_encode($rezultat);
exit;
?>
