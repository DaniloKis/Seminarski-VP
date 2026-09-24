<?php
require_once("kontroler/Sesija.php");

class PocetnaKontroler {

    public function index() {
        proveriPrijavu();
        include("pogledi/pocetna.php");
    }
}
?>
