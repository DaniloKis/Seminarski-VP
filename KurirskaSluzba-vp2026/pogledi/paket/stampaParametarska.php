<?php $naslov = "Параметарска штампа"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">ПАРАМЕТАРСКА ШТАМПА</font></b><br/><br/>
<font face="Trebuchet MS" size="2px">Унесите шифру пакета за штампу појединачног пакета:</font>
<br/><br/>

<form action="<?php echo OSNOVA; ?>/paket/stampaPaket" method="POST" target="_blank">
<font face="Trebuchet MS" size="2px">Шифра пакета:</font>
<input type="text" name="sifra" />
<input type="submit" value="ШТАМПАЈ" />
</form>

<br/>
<font face="Trebuchet MS" size="2px">
Или: <a href="<?php echo OSNOVA; ?>/paket/stampa" target="_blank">штампа свих пакета</a>
</font>
<br/><br/>
</td></tr>
</table>

<?php require("pogledi/delovi/dno.php"); ?>
