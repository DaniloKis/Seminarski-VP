<?php $naslov = "Штампа пакета"; require("pogledi/delovi/vrhStampa.php"); ?>

<table style="width:100%;" cellspacing="0" cellpadding="0" border="0">
<tr><td align="right"><font face="Trebuchet MS" color="brown" size="2px"><b>датум: <?php echo date("d.m.Y."); ?></b></font></td></tr>
</table>

<div align="center"><font face="Trebuchet MS" color="brown" size="5px"><b>СПИСАК ПАКЕТА</b></font></div>
<br/>

<?php if ($this->paketRepo->BrojZapisa == 0) { ?>
    <font face="Trebuchet MS" size="2px">НЕМА ЗАПИСА У ТАБЕЛИ!</font>
<?php } else { ?>
<table style="width:100%;" cellspacing="0" cellpadding="4" border="1" bgcolor="white">
<tr>
    <td><b><font face="Trebuchet MS" size="2px">ШИФРА ПАКЕТА</font></b></td>
    <td><b><font face="Trebuchet MS" size="2px">ПРИМАЛАЦ</font></b></td>
    <td><b><font face="Trebuchet MS" size="2px">УПОЗОРЕЊЕ</font></b></td>
    <td><b><font face="Trebuchet MS" size="2px">ТЕЖИНА</font></b></td>
    <td><b><font face="Trebuchet MS" size="2px">ЦЕНА</font></b></td>
    <td><b><font face="Trebuchet MS" size="2px">СТАТУС</font></b></td>
    <td><b><font face="Trebuchet MS" size="2px">КУРИР</font></b></td>
</tr>
<?php
for ($i = 0; $i < $this->paketRepo->BrojZapisa; $i++) {
    $sifra    = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 0);
    $primalac = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 3);
    $upoz     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 5);
    $tezina   = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 6);
    $cena     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 7);
    $status   = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 8);
    $kurir    = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 10);
    echo '<tr><font face="Trebuchet MS" size="2px">';
    echo '<td>' . htmlspecialchars($sifra) . '</td>';
    echo '<td>' . htmlspecialchars($primalac) . '</td>';
    echo '<td>' . htmlspecialchars($upoz) . '</td>';
    echo '<td>' . htmlspecialchars($tezina) . '</td>';
    echo '<td>' . htmlspecialchars($cena) . '</td>';
    echo '<td>' . htmlspecialchars($status) . '</td>';
    echo '<td>' . htmlspecialchars($kurir) . '</td>';
    echo '</font></tr>';
}
?>
<tr><td colspan="6"></td><td align="right"><b><font face="Trebuchet MS" size="2px">УКУПНО: <?php echo $this->paketRepo->BrojZapisa; ?></font></b></td></tr>
</table>
<?php } ?>

<br/><br/>
<div align="right">
<font face="Trebuchet MS" size="2px">Одговорно лице</font><br/><br/>
<font face="Trebuchet MS" size="2px">_______________________</font>
</div>

<?php require("pogledi/delovi/dnoStampa.php"); ?>
