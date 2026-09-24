<?php $naslov = "Пакети"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">СПИСАК ПАКЕТА</font></b>
&nbsp;&nbsp;[ <a href="<?php echo OSNOVA; ?>/paket/dodajForm">Додај пакет</a> ]
<br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/paket/pretraga">
<font face="Trebuchet MS" size="2px">Шифра пакета:</font>
<input type="text" name="sifra" />
<input type="submit" value="ПРЕТРАГА" />
<a href="<?php echo OSNOVA; ?>/paket/index">СВИ</a>
</form>
<br/>

<table style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ШИФРА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПРИМАЛАЦ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;УПОЗОРЕЊЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ТЕЖИНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ЦЕНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;СТАТУС&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КУРИР&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КОНТРОЛЕ&nbsp;</font></b></td>
</tr>
<?php
if ($this->paketRepo->BrojZapisa > 0) {
    for ($i = 0; $i < $this->paketRepo->BrojZapisa; $i++) {
        $sifra    = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 0);
        $primalac = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 3);
        $upoz     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 5);
        $tezina   = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 6);
        $cena     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 7);
        $status   = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 8);
        $kurir    = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->paketRepo->Kolekcija, $i, 10);
        $sifraURL = rawurlencode($sifra);
        echo '<tr bgcolor="#f4edd8"><font face="Trebuchet MS" size="2px">';
        echo '<td>&nbsp;' . htmlspecialchars($sifra) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($primalac) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($upoz) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($tezina) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($cena) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($status) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($kurir) . '&nbsp;</td>';
        echo '<td>&nbsp;<a href="' . OSNOVA . '/paket/izmeniForm/' . $sifraURL . '">измени</a> | '
           . '<a href="' . OSNOVA . '/paket/obrisi/' . $sifraURL . '" onclick="return confirm(\'Обрисати пакет?\');">обриши</a>&nbsp;</td>';
        echo '</font></tr>';
    }
} else {
    echo '<tr bgcolor="#f4edd8"><td colspan="8">&nbsp;<font face="Trebuchet MS" size="2px">Нема записа у табели.</font></td></tr>';
}
?>
</table>
<br/>
</td></tr>
</table>

<?php require("pogledi/delovi/dno.php"); ?>
