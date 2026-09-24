<?php $naslov = "Унос курира"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">УНОС НОВОГ КУРИРА</font></b><br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/kurir/dodaj" class="forma-kurir" novalidate>
<table style="width:90%;" cellspacing="4" cellpadding="2" border="0">
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">ИД курира&nbsp;</font></b></td><td><input name="idKurira" type="text" size="30" placeholder="нпр. K03" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Презиме&nbsp;</font></b></td><td><input name="prezime" type="text" size="30" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Име&nbsp;</font></b></td><td><input name="ime" type="text" size="30" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Телефон&nbsp;</font></b></td><td><input name="telefon" type="text" size="30" /></td></tr>
<tr><td></td><td><br/><input type="submit" value="СНИМИ" /> &nbsp; <a href="<?php echo OSNOVA; ?>/kurir/index">Назад</a></td></tr>
</table>
</form>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/kurirValidacija.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
