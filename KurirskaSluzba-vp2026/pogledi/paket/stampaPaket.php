<?php $naslov = "Подаци о пакету"; require("pogledi/delovi/vrhStampa.php"); ?>

<div align="center"><font face="Trebuchet MS" color="brown" size="4px"><b>ПОДАЦИ О ПАКЕТУ</b></font></div>
<br/>

<?php
if ($this->paketRepo->BrojZapisa == 0) {
    echo '<font face="Trebuchet MS" size="3px">Нема пакета са унетом шифром.</font>';
} else {
    $k = $this->paketRepo->Kolekcija;
    $sifra      = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 0);
    $posiljalac = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 1);
    $adresaPos  = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 2);
    $primalac   = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 3);
    $adresaDost = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 4);
    $oznaka     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 5);
    $tezina     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 6);
    $cena       = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 7);
    $status     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 8);
    $kurir      = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 10);
    echo '<font face="Trebuchet MS" size="3px">';
    echo 'Шифра пакета: ' . htmlspecialchars($sifra) . '<br/>';
    echo 'Пошиљалац: ' . htmlspecialchars($posiljalac) . '<br/>';
    echo 'Адреса пошиљаоца: ' . htmlspecialchars($adresaPos) . '<br/>';
    echo 'Прималац: ' . htmlspecialchars($primalac) . '<br/>';
    echo 'Адреса доставе: ' . htmlspecialchars($adresaDost) . '<br/>';
    echo 'Ознака упозорења: ' . htmlspecialchars($oznaka) . '<br/>';
    echo 'Тежина: ' . htmlspecialchars($tezina) . ' kg<br/>';
    echo 'Цена: ' . htmlspecialchars($cena) . ' РСД<br/>';
    echo 'Статус: ' . htmlspecialchars($status) . '<br/>';
    echo 'Курир: ' . htmlspecialchars($kurir) . '<br/>';
    echo '</font>';
}
?>

<?php require("pogledi/delovi/dnoStampa.php"); ?>
