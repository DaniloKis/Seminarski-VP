<?php $naslov = "Измена курира"; require("pogledi/delovi/vrh.php"); ?>

<?php
$k = $this->kurirRepo->Kolekcija;
$idk = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 0);
$prz = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 1);
$ime = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 2);
$tel = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 3);
$ukp = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 4);
?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">ИЗМЕНА ПОДАТАКА КУРИРА</font></b><br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/kurir/izmeni" class="forma-kurir" novalidate>
<input type="hidden" name="stariIdKurira" value="<?php echo htmlspecialchars($idk); ?>">
<table style="width:90%;" cellspacing="4" cellpadding="2" border="0">
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">ИД курира&nbsp;</font></b></td><td><input name="idKurira" type="text" size="30" value="<?php echo htmlspecialchars($idk); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Презиме&nbsp;</font></b></td><td><input name="prezime" type="text" size="30" value="<?php echo htmlspecialchars($prz); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Име&nbsp;</font></b></td><td><input name="ime" type="text" size="30" value="<?php echo htmlspecialchars($ime); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Телефон&nbsp;</font></b></td><td><input name="telefon" type="text" size="30" value="<?php echo htmlspecialchars($tel); ?>" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Укупан број пакета&nbsp;</font></b></td><td><input name="ukupanBrojPaketa" type="number" min="0" size="30" value="<?php echo htmlspecialchars($ukp); ?>" /></td></tr>
<tr><td></td><td><br/><input type="submit" value="СНИМИ ИЗМЕНУ" /> &nbsp; <a href="<?php echo OSNOVA; ?>/kurir/index">Назад</a></td></tr>
</table>
</form>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/kurirValidacija.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
