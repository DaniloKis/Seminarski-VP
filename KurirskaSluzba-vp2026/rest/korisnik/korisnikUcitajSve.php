<?php
// REST GET - vraca sve korisnike (ili filtrirano po prezimenu) kao JSON.
chdir(__DIR__ . '/../..');
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['korisnik'])) { echo json_encode([]); exit; }

require_once("klase/BaznaKonekcija.php");
require_once("klase/BaznaTabela.php");
require_once("model/KorisnikModel.php");
require_once("repozitorijumi/KorisnikRepo.php");

$konekcija = new Konekcija("klase/BaznaParametriKonekcije.xml");
$konekcija->connect();
$korisnikRepo = new KorisnikRepo($konekcija, "korisnik");

$prezime = isset($_GET['prezime']) ? $_GET['prezime'] : '';

if ($prezime !== '') {
    $korisnikRepo->FiltrirajKorisnikaPoPrezimenu($prezime);
} else {
    $korisnikRepo->DohvatiSveKorisnike();
}

$rezultat = [];
for ($i = 0; $i < $korisnikRepo->BrojZapisa; $i++) {
    $rezultat[] = [
        'idKorisnika'   => $korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($korisnikRepo->Kolekcija, $i, 0),
        'prezime'       => $korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($korisnikRepo->Kolekcija, $i, 1),
        'ime'           => $korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($korisnikRepo->Kolekcija, $i, 2),
        'email'         => $korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($korisnikRepo->Kolekcija, $i, 3),
        'korisnickoIme' => $korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($korisnikRepo->Kolekcija, $i, 4),
        'statusUcesca'  => $korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($korisnikRepo->Kolekcija, $i, 6)
    ];
}

$konekcija->disconnect();
echo json_encode($rezultat);
exit;
?>
