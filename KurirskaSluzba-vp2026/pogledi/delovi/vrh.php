<?php
// Gornji deo originalnog dizajna (baner + traka korisnika + levi meni + otvaranje sadrzaja).
// Ocekuje opcionu promenljivu $naslov. Slike/linkovi idu preko OSNOVA (radi i sa clean URL-om).
$naslov = isset($naslov) ? $naslov : 'Курирска служба';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<head>
<meta charset="UTF-8">
<title><?php echo $naslov; ?> — Курирска служба</title>
<?php include 'css/stil.php'; ?>
<style>
/* poruke JS validacije (u duhu starog dizajna) */
.greska { display:block; color:#8b0000; font:bold 12px "Trebuchet MS"; margin-top:3px; }
.polje-greska { border:2px solid #8b0000 !important; }
</style>
</head>
<body>

<table class="no-spacing" style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0">

<!-------------------------- ЗАГЛАВЉЕ ------->
<tr>
<td style="width:10%;"></td>
<td align="center" valign="middle">
    <table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" background="<?php echo OSNOVA; ?>/images/banerMain.png">
    <tr><td><font color="white" size="1px">.</font></td></tr>
    <tr><td align="center">
        <div class="flt1 topblock"><a href="<?php echo OSNOVA; ?>/pocetna/index" class="flt1 tp_txtplay">БРЗА ПОШТА<br/>Курирска служба<br/>Зрењанин</a></div>
    </td></tr>
    <tr><td><font color="white" size="1px">.</font></td></tr>
    </table>
</td>
<td style="width:10%;"></td>
</tr>

<tr>
<td style="width:10%;"></td>
<td>
    <table style="width:100%;" bgcolor="#a3874e">
    <tr>
    <td align="left" valign="middle" style="width:35%;">
        <font face="Trebuchet MS" color="white" size="2px">&nbsp;Корисник:&nbsp;<b><?php echo isset($_SESSION['korisnik']) ? htmlspecialchars($_SESSION['korisnik']) : ''; ?></b></font>
    </td>
    <td style="width:50%;"></td>
    <td align="right"><font face="Trebuchet MS" color="brown" size="2px"><a href="<?php echo OSNOVA; ?>/korisnik/odjava">&nbsp;Одјава&nbsp;</a></font></td>
    </tr>
    </table>
</td>
<td style="width:10%;"></td>
</tr>

<!-------------------------- ДОЊИ ДЕО: мени + садржај ------->
<tr style="padding:0px;">
<td style="width:10%;"></td>
<td align="center" valign="middle" style="width:80%; padding:0">

<table style="width:100%; padding:0" align="center" cellspacing="0" cellpadding="0" border="0" bgcolor="#664600">
<tr>
<td style="width:1%;"></td>

<td style="width:18%;padding:0" valign="top">
<?php include 'pogledi/delovi/menilevo.php'; ?>
</td>

<td style="width:1%;"></td>

<td style="width:80%;padding:0" valign="top">
<!-- ================= САДРЖАЈ почиње ================= -->
