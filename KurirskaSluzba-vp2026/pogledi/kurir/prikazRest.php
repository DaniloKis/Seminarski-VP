<?php $naslov = "Курири (REST)"; require("pogledi/delovi/vrh.php"); ?>

<script>const OSNOVA_APP = "<?php echo OSNOVA; ?>";</script>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">КУРИРИ (REST)</font></b>
&nbsp;&nbsp;[ <a href="<?php echo OSNOVA; ?>/kurir/dodajForm">Додај курира</a> ]<br/>
<font face="Trebuchet MS" size="2px">Листа се учитава преко <i>fetch</i>‑а; брисање иде преко REST захтева.</font>
<br/><br/>

<form class="filter-forma" id="filterForm">
<font face="Trebuchet MS" size="2px">Презиме:</font>
<input type="text" name="prezime" />
<input type="submit" value="ПРЕТРАГА" />
<a href="#" class="btn-sve">СВИ</a>
</form>
<br/>

<table class="tabela" style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<thead>
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ИД КУРИРА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПРЕЗИМЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ИМЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ТЕЛЕФОН&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;БРОЈ ПАКЕТА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КОНТРОЛЕ&nbsp;</font></b></td>
</tr>
</thead>
<tbody></tbody>
</table>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/kurirRESTObrisi.js"></script>
<script src="<?php echo OSNOVA; ?>/js/kurirRESTUcitajSve.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
