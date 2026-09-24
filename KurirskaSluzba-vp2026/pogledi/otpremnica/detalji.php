<?php $naslov = "Детаљи отпремнице"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<?php
if ($this->otpremnicaRepo->BrojZapisa == 0) {
    echo '<br/><b><font face="Trebuchet MS" color="brown" size="4px">Отпремница није пронађена</font></b><br/><br/>';
    echo '<a href="' . OSNOVA . '/otpremnica/index">Назад</a>';
} else {
    $o = $this->otpremnicaRepo->Kolekcija;
    $broj  = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($o, 0, 0);
    $datum = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($o, 0, 1);
    $pos   = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($o, 0, 2);
    $adr   = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($o, 0, 3);
    $cena  = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($o, 0, 5);
    $stat  = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($o, 0, 6);
    $kurir = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($o, 0, 7);
?>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">ОТПРЕМНИЦА #<?php echo htmlspecialchars($broj); ?></font></b><br/><br/>

<table style="width:auto;" bgcolor="#feecb7" cellspacing="0" cellpadding="6" border="0">
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Датум:</font></b></td><td><font face="Trebuchet MS" size="2px">&nbsp;<?php echo htmlspecialchars($datum); ?></font></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Пошиљалац:</font></b></td><td><font face="Trebuchet MS" size="2px">&nbsp;<?php echo htmlspecialchars($pos); ?></font></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса преузимања:</font></b></td><td><font face="Trebuchet MS" size="2px">&nbsp;<?php echo htmlspecialchars($adr); ?></font></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Курир:</font></b></td><td><font face="Trebuchet MS" size="2px">&nbsp;<?php echo htmlspecialchars($kurir); ?></font></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Статус:</font></b></td><td><font face="Trebuchet MS" size="2px">&nbsp;<?php echo htmlspecialchars($stat); ?></font></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Укупна цена:</font></b></td><td><font face="Trebuchet MS" size="2px">&nbsp;<?php echo htmlspecialchars($cena); ?></font></td></tr>
</table>
<br/>

<b><font face="Trebuchet MS" color="brown" size="3px">СТАВКЕ (ПАКЕТИ)</font></b><br/><br/>
<table style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;Р.б.&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПРИМАЛАЦ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;АДРЕСА ДОСТАВЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;УПОЗОРЕЊЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ТЕЖИНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ЦЕНА&nbsp;</font></b></td>
</tr>
<?php
if ($this->stavkaRepo->BrojZapisa > 0) {
    for ($i = 0; $i < $this->stavkaRepo->BrojZapisa; $i++) {
        $prim = $this->stavkaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->stavkaRepo->Kolekcija, $i, 2);
        $ad   = $this->stavkaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->stavkaRepo->Kolekcija, $i, 3);
        $up   = $this->stavkaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->stavkaRepo->Kolekcija, $i, 4);
        $tez  = $this->stavkaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->stavkaRepo->Kolekcija, $i, 5);
        $cn   = $this->stavkaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->stavkaRepo->Kolekcija, $i, 6);
        echo '<tr bgcolor="#f4edd8"><font face="Trebuchet MS" size="2px">';
        echo '<td>&nbsp;' . ($i + 1) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($prim) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($ad) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($up) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($tez) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($cn) . '&nbsp;</td>';
        echo '</font></tr>';
    }
} else {
    echo '<tr bgcolor="#f4edd8"><td colspan="6">&nbsp;<font face="Trebuchet MS" size="2px">Нема ставки.</font></td></tr>';
}
?>
</table>
<br/>
<a href="<?php echo OSNOVA; ?>/otpremnica/index">Назад на списак</a>
<?php } ?>
<br/>
</td></tr>
</table>

<?php require("pogledi/delovi/dno.php"); ?>
