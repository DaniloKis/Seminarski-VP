<?php $naslov = "Измена корисника"; require("pogledi/delovi/vrh.php"); ?>

<?php
$k = $this->korisnikRepo->Kolekcija;
$id  = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 0);
$prz = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 1);
$ime = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 2);
$eml = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 3);
$kim = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 4);
$sif = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 5);
$sts = $this->korisnikRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 6);
?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">ИЗМЕНА ПОДАТАКА КОРИСНИКА</font></b><br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/korisnik/izmeni" class="forma-korisnik" novalidate>
<input type="hidden" name="idKorisnika" value="<?php echo htmlspecialchars($id); ?>">
<table style="width:90%;" cellspacing="4" cellpadding="2" border="0">
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Презиме&nbsp;</font></b></td><td><input name="prezime" type="text" size="40" value="<?php echo htmlspecialchars($prz); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Име&nbsp;</font></b></td><td><input name="ime" type="text" size="40" value="<?php echo htmlspecialchars($ime); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Е-пошта&nbsp;</font></b></td><td><input name="email" type="text" size="40" value="<?php echo htmlspecialchars($eml); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Корисничко име&nbsp;</font></b></td><td><input name="korisnickoIme" type="text" size="40" value="<?php echo htmlspecialchars($kim); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Шифра&nbsp;</font></b></td><td><input name="sifra" type="text" size="40" value="<?php echo htmlspecialchars($sif); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Статус учешћа&nbsp;</font></b></td><td>
    <select name="statusUcesca">
        <option value="admin"<?php echo ($sts == 'admin') ? ' selected' : ''; ?>>admin</option>
        <option value="korisnik"<?php echo ($sts == 'korisnik') ? ' selected' : ''; ?>>korisnik</option>
    </select></td></tr>
<tr><td></td><td><br/><input type="submit" value="СНИМИ ИЗМЕНУ" /> &nbsp; <a href="<?php echo OSNOVA; ?>/korisnik/index">Назад</a></td></tr>
</table>
</form>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/korisnikValidacija.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
