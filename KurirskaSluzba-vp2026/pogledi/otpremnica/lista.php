<?php $naslov = "Отпремнице"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">СПИСАК ОТПРЕМНИЦА (master–detail)</font></b>
&nbsp;&nbsp;[ <a href="<?php echo OSNOVA; ?>/otpremnica/dodajForm">Нова отпремница</a> ]<br/>
<font face="Trebuchet MS" size="2px">Свака отпремница је целина (заглавље) са више ставки–пакета, уписаних у једној трансакцији.</font>
<br/><br/>

<table style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;БРОЈ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ДАТУМ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПОШИЉАЛАЦ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КУРИР&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;УКУПНА ЦЕНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;СТАТУС&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КОНТРОЛЕ&nbsp;</font></b></td>
</tr>
<?php
if ($this->otpremnicaRepo->BrojZapisa > 0) {
    for ($i = 0; $i < $this->otpremnicaRepo->BrojZapisa; $i++) {
        $broj = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->otpremnicaRepo->Kolekcija, $i, 0);
        $datum = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->otpremnicaRepo->Kolekcija, $i, 1);
        $pos = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->otpremnicaRepo->Kolekcija, $i, 2);
        $cena = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->otpremnicaRepo->Kolekcija, $i, 5);
        $status = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->otpremnicaRepo->Kolekcija, $i, 6);
        $kurir = $this->otpremnicaRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->otpremnicaRepo->Kolekcija, $i, 7);
        echo '<tr bgcolor="#f4edd8"><font face="Trebuchet MS" size="2px">';
        echo '<td>&nbsp;' . htmlspecialchars($broj) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($datum) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($pos) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($kurir) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($cena) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($status) . '&nbsp;</td>';
        echo '<td>&nbsp;<a href="' . OSNOVA . '/otpremnica/detalji/' . rawurlencode($broj) . '">прикажи више</a> | '
           . '<a href="' . OSNOVA . '/otpremnica/obrisi/' . rawurlencode($broj) . '" onclick="return confirm(\'Обрисати отпремницу и све њене ставке?\');">обриши</a>&nbsp;</td>';
        echo '</font></tr>';
    }
} else {
    echo '<tr bgcolor="#f4edd8"><td colspan="7">&nbsp;<font face="Trebuchet MS" size="2px">Нема отпремница.</font></td></tr>';
}
?>
</table>
<br/>
</td></tr>
</table>

<?php require("pogledi/delovi/dno.php"); ?>
