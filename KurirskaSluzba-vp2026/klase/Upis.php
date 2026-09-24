<?php
class Upis extends Tabela
{
public function DaLiImaMestaZaDodelu($IDKuriraParametar)
{
	$odgovor = "NE";
	$xml = simplexml_load_file("klase/".$IDKuriraParametar.".xml") or die("Nije uspesno ucitavanje fajla sa kapacitetom!");
	$maxBrojPaketa = $xml->MaxBrPaketa;

	$NazivTrazenogPolja    = "count(`SifraPaketa`)";
	$KriterijumFiltriranja = "`IDKurira`='".$IDKuriraParametar."'";
	$KriterijumSortiranja  = "`SifraPaketa`";
	$trenutno = $this->DajVrednostJednogPoljaPrvogZapisa($NazivTrazenogPolja, $KriterijumFiltriranja, $KriterijumSortiranja);

	if ($trenutno < $maxBrojPaketa) { $odgovor = "DA"; } else { $odgovor = "NE"; }
	return $odgovor;
}
}
?>