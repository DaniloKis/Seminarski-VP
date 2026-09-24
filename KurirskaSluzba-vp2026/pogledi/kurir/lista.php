<?php $naslov = "Курири"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">СПИСАК КУРИРА</font></b>
&nbsp;&nbsp;[ <a href="<?php echo OSNOVA; ?>/kurir/dodajForm">Додај курира</a> ]
<br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/kurir/pretraga">
<font face="Trebuchet MS" size="2px">Презиме:</font>
<input type="text" name="prezime" />
<input type="submit" value="ПРЕТРАГА" />
<a href="<?php echo OSNOVA; ?>/kurir/index">СВИ</a>
</form>
<br/>

<table style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ИД КУРИРА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПРЕЗИМЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ИМЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ТЕЛЕФОН&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;БРОЈ ПАКЕТА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КОНТРОЛЕ&nbsp;</font></b></td>
</tr>
<?php
if ($this->kurirRepo->BrojZapisa > 0) {
    for ($i = 0; $i < $this->kurirRepo->BrojZapisa; $i++) {
        $idk = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 0);
        $prz = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 1);
        $ime = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 2);
        $tel = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 3);
        $ukp = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 4);
        $idURL = rawurlencode($idk);
        echo '<tr bgcolor="#f4edd8"><font face="Trebuchet MS" size="2px">';
        echo '<td>&nbsp;' . htmlspecialchars($idk) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($prz) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($ime) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($tel) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($ukp) . '&nbsp;</td>';
        echo '<td>&nbsp;<a href="' . OSNOVA . '/kurir/izmeniForm/' . $idURL . '">измени</a> | '
           . '<a href="' . OSNOVA . '/kurir/obrisi/' . $idURL . '" onclick="return confirm(\'Обрисати курира?\');">обриши</a>&nbsp;</td>';
        echo '</font></tr>';
    }
} else {
    echo '<tr bgcolor="#f4edd8"><td colspan="6">&nbsp;<font face="Trebuchet MS" size="2px">Нема записа у табели.</font></td></tr>';
}
?>
</table>
<br/>
</td></tr>
</table>

<?php require("pogledi/delovi/dno.php"); ?>
