<?php $naslov = "Корисници"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">СПИСАК КОРИСНИКА</font></b>
&nbsp;&nbsp;[ <a href="<?php echo OSNOVA; ?>/korisnik/dodajForm">Додај корисника</a> ]
<br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/korisnik/pretraga">
<font face="Trebuchet MS" size="2px">Презиме:</font>
<input type="text" name="prezime" />
<input type="submit" value="ПРЕТРАГА" />
<a href="<?php echo OSNOVA; ?>/korisnik/index">СВИ</a>
</form>
<br/>

<table style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ИД&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПРЕЗИМЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ИМЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;Е-ПОШТА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КОРИСНИЧКО ИМЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;СТАТУС&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КОНТРОЛЕ&nbsp;</font></b></td>
</tr>
<?php
if ($this->korisnikRepo->BrojZapisa > 0) {
    for ($i = 0; $i < $this->korisnikRepo->BrojZapisa; $i++) {
        $id  = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->korisnikRepo->Kolekcija, $i, 0);
        $prz = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->korisnikRepo->Kolekcija, $i, 1);
        $ime = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->korisnikRepo->Kolekcija, $i, 2);
        $eml = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->korisnikRepo->Kolekcija, $i, 3);
        $kim = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->korisnikRepo->Kolekcija, $i, 4);
        $sts = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->korisnikRepo->Kolekcija, $i, 6);
        echo '<tr bgcolor="#f4edd8"><font face="Trebuchet MS" size="2px">';
        echo '<td>&nbsp;' . htmlspecialchars($id) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($prz) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($ime) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($eml) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($kim) . '&nbsp;</td>';
        echo '<td>&nbsp;' . htmlspecialchars($sts) . '&nbsp;</td>';
        echo '<td>&nbsp;<a href="' . OSNOVA . '/korisnik/izmeniForm/' . rawurlencode($id) . '">измени</a> | '
           . '<a href="' . OSNOVA . '/korisnik/obrisi/' . rawurlencode($id) . '" onclick="return confirm(\'Обрисати корисника?\');">обриши</a>&nbsp;</td>';
        echo '</font></tr>';
    }
} else {
    echo '<tr bgcolor="#f4edd8"><td colspan="7">&nbsp;<font face="Trebuchet MS" size="2px">Нема записа у табели.</font></td></tr>';
}
?>
</table>
<br/>
</td></tr>
</table>

<?php require("pogledi/delovi/dno.php"); ?>
