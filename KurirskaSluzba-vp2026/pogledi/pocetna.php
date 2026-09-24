<?php $naslov = "Почетна"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="14" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="5px">Добродошли у Курирску службу</font></b><br/><br/>
<font face="Trebuchet MS" color="black" size="2px">
MVC + REST систем за управљање пакетима, куририма, корисницима и отпремницама.
Поред класичног серверског приказа, ентитети имају и REST приказ (учитавање и брисање преко <i>fetch</i>‑а).
</font>
<br/><br/>

<table style="width:100%;" cellspacing="8" cellpadding="0" border="0">
<tr valign="top">
<td width="25%" bgcolor="#feecb7" style="border:1px solid #a3874e;"><div style="padding:10px;">
<b><font face="Trebuchet MS" size="3px">Пакети</font></b><br/><br/>
<font face="Trebuchet MS" size="2px">Унос, измена, брисање и претрага пакета.</font><br/><br/>
<a href="<?php echo OSNOVA; ?>/paket/index">Отвори пакете »</a>
</div></td>

<td width="25%" bgcolor="#feecb7" style="border:1px solid #a3874e;"><div style="padding:10px;">
<b><font face="Trebuchet MS" size="3px">Отпремнице</font></b><br/><br/>
<font face="Trebuchet MS" size="2px">Master–detail: једна отпремница са више ставки (трансакција).</font><br/><br/>
<a href="<?php echo OSNOVA; ?>/otpremnica/index">Отвори отпремнице »</a>
</div></td>

<td width="25%" bgcolor="#feecb7" style="border:1px solid #a3874e;"><div style="padding:10px;">
<b><font face="Trebuchet MS" size="3px">Курири</font></b><br/><br/>
<font face="Trebuchet MS" size="2px">Управљање куририма и бројем додељених пакета.</font><br/><br/>
<a href="<?php echo OSNOVA; ?>/kurir/index">Отвори курире »</a>
</div></td>

<td width="25%" bgcolor="#feecb7" style="border:1px solid #a3874e;"><div style="padding:10px;">
<b><font face="Trebuchet MS" size="3px">Корисници</font></b><br/><br/>
<font face="Trebuchet MS" size="2px">Администрација корисничких налога.</font><br/><br/>
<a href="<?php echo OSNOVA; ?>/korisnik/index">Отвори кориснике »</a>
</div></td>
</tr>
</table>

<br/>
</td></tr>
</table>

<?php require("pogledi/delovi/dno.php"); ?>
