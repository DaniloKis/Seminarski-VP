<?php
// Gornji deo layout-a za stampu (cist, za stampac - bez menija). Ocekuje opciono $naslov.
$naslov = isset($naslov) ? $naslov : 'Штампа';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="sr-RS" xml:lang="sr-RS">
<head>
<meta charset="UTF-8">
<title><?php echo $naslov; ?> — Курирска служба</title>
<?php include 'css/stil.php'; ?>
<style>
@media print { .noprint { display:none !important; } }
.stampa-omot { width:92%; max-width:900px; margin:15px auto; }
</style>
</head>
<body bgcolor="#FFFFFF">

<div class="noprint" style="text-align:center; margin:12px;">
    <input type="button" value="ШТАМПАЈ" onclick="window.print();" />
    &nbsp; <a href="<?php echo OSNOVA; ?>/paket/index">Назад на пакете</a>
</div>

<table style="width:100%;" cellspacing="0" cellpadding="0" border="0">
<tr>
<td style="width:10%;"></td>
<td align="center" valign="middle">
    <b><font face="Trebuchet MS" color="brown" size="3px">БРЗА ПОШТА — Курирска служба</font></b><br/>
    <b><font face="Trebuchet MS" color="brown" size="3px">Зрењанин</font></b>
</td>
<td style="width:10%;"></td>
</tr>
</table>

<div class="stampa-omot">
