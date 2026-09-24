<?php
// Zajednicka zastita pristupa - preusmerava neprijavljenog korisnika na formu za prijavu.
// Koristi iste kljuceve sesije kao i postojeca aplikacija ($_SESSION["korisnik"]).

function proveriPrijavu() {
    if (!isset($_SESSION["korisnik"])) {
        header("Location: " . OSNOVA . "/korisnik/prijava");
        exit;
    }
}
?>
