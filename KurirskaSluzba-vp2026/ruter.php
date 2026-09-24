<?php
// ================== RUTER ==================
// Preslikava "clean URL" (npr. paket/izmeniForm/K001) na Kontroler + akciju + parametre.
// Struktura URL-a:  kontroler / akcija / param1 / param2 ...

session_start();

// Osnovna putanja aplikacije (npr. "/KurirskaSluzba-vp2026"), racuna se dinamicki
// da bi linkovi/fetch radili bez obzira na naziv foldera na serveru.
define('OSNOVA', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'));

$url = "";

if (isset($_GET["url"])) {
    $url = $_GET["url"];
}

if ($url == "") {
    $url = "pocetna/index";
}

$url = rtrim($url, "/");

$delovi = explode("/", $url);

$kontrolerIme = ucfirst($delovi[0]) . "Kontroler";
$akcija = isset($delovi[1]) && $delovi[1] !== "" ? $delovi[1] : "index";

$parametri = array_slice($delovi, 2);

$putanja = "kontroler/" . $kontrolerIme . ".php";

if (file_exists($putanja)) {

    require_once($putanja);

    $kontroler = new $kontrolerIme();

    if (method_exists($kontroler, $akcija)) {
        call_user_func_array(array($kontroler, $akcija), $parametri);
    } else {
        echo "Akcija ne postoji";
    }

} else {
    echo "Kontroler ne postoji";
}
?>
