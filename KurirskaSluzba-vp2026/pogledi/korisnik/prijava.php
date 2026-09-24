<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<head>
<meta charset="UTF-8">
<title>Пријава — Курирска служба</title>
<?php include 'css/stil.php'; ?>
<style>
.greska { display:block; color:#8b0000; font:bold 12px "Trebuchet MS"; margin-top:3px; }
.polje-greska { border:2px solid #8b0000 !important; }
</style>
</head>
<body>

<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0">

<!-- Банер -->
<tr>
<td style="width:10%;"></td>
<td align="center" valign="middle">
    <table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" background="<?php echo OSNOVA; ?>/images/banerMain.png">
    <tr><td><font color="white" size="1px">.</font></td></tr>
    <tr><td align="center"><div class="flt1 topblock"><a href="<?php echo OSNOVA; ?>/pocetna/index" class="flt1 tp_txtplay">БРЗА ПОШТА<br/>Курирска служба<br/>Зрењанин</a></div></td></tr>
    <tr><td><font color="white" size="1px">.</font></td></tr>
    </table>
</td>
<td style="width:10%;"></td>
</tr>

<!-- Трака -->
<tr>
<td style="width:10%;"></td>
<td>
    <table style="width:100%;" bgcolor="#967f41">
    <tr>
    <td align="left" valign="middle"><font face="Trebuchet MS" color="brown" size="2px"><a href="<?php echo OSNOVA; ?>/pocetna/index">&nbsp;Почетна&nbsp;</a></font></td>
    <td></td>
    </tr>
    </table>
</td>
<td style="width:10%;"></td>
</tr>

<!-- Садржај: форма за пријаву -->
<tr>
<td style="width:10%;"></td>
<td align="center" valign="middle">
<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#663d00">
<tr>
<td style="width:2%;"></td>
<td align="center">

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="18" border="0">
<tr><td align="center">
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">ПРИЈАВА КОРИСНИКА</font></b><br/><br/>

<?php if (!empty($greska)) { ?>
    <font face="Trebuchet MS" color="#8b0000" size="2px"><b>Погрешно корисничко име или шифра.</b></font><br/><br/>
<?php } ?>

<form action="<?php echo OSNOVA; ?>/korisnik/prijaviSe" method="POST" class="forma-prijava" novalidate>
<table style="width:auto;" bgcolor="#b3a587" cellspacing="0" cellpadding="6" border="0" align="center">
<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Корисник&nbsp;</font></b></td>
<td align="left"><input name="korisnickoIme" type="text" size="40" placeholder="Унесите корисничко име" /></td>
</tr>
<tr>
<td align="right"><b><font face="Trebuchet MS" color="black" size="2px">Шифра&nbsp;</font></b></td>
<td align="left"><input name="sifra" type="password" size="40" placeholder="Унесите шифру" /></td>
</tr>
<tr>
<td></td>
<td align="left"><br/><input type="submit" value="ПРИЈАВИ СЕ" /></td>
</tr>
</table>
</form>
<br/>
</td></tr>
</table>

</td>
<td style="width:2%;"></td>
</tr>
</table>
</td>
<td style="width:10%;"></td>
</tr>

<!-- Подножје -->
<tr style="padding:0px;">
<td style="width:10%;"></td>
<td align="center" valign="middle" bgcolor="#3b2806"><font face="Trebuchet MS" color="white" size="2px">Copyright: Курирска служба &nbsp;*&nbsp;*&nbsp;* &nbsp;Контакт e-mail: <a href="mailto:kontakt@kurir.rs">kontakt@kurir.rs</a></font></td>
<td style="width:10%;"></td>
</tr>

</table>

<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/prijavaValidacija.js"></script>

</body>
</html>
