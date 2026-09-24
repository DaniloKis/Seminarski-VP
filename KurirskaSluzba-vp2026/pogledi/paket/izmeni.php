<?php $naslov = "Измена пакета"; require("pogledi/delovi/vrh.php"); ?>

<?php
$k = $this->paketRepo->Kolekcija;
$sifra      = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 0);
$posiljalac = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 1);
$adresaPos  = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 2);
$primalac   = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 3);
$adresaDost = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 4);
$oznaka     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 5);
$tezina     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 6);
$cena       = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 7);
$status     = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 8);
$idKurira   = $this->paketRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($k, 0, 9);
?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">ИЗМЕНА ПОДАТАКА ПАКЕТА</font></b><br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/paket/izmeni" class="forma-paket" novalidate>
<input type="hidden" name="staraSifra" value="<?php echo htmlspecialchars($sifra); ?>">
<table style="width:90%;" cellspacing="4" cellpadding="2" border="0">

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Шифра пакета&nbsp;</font></b></td>
<td><input name="sifraPaketa" type="text" size="50" value="<?php echo htmlspecialchars($sifra); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Пошиљалац&nbsp;</font></b></td>
<td><input name="posiljalac" type="text" size="50" value="<?php echo htmlspecialchars($posiljalac); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса пошиљаоца&nbsp;</font></b></td>
<td><input name="adresaPosiljaoca" type="text" size="50" value="<?php echo htmlspecialchars($adresaPos); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Прималац&nbsp;</font></b></td>
<td><input name="primalac" type="text" size="50" value="<?php echo htmlspecialchars($primalac); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса доставе&nbsp;</font></b></td>
<td><input name="adresaDostave" type="text" size="50" value="<?php echo htmlspecialchars($adresaDost); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Ознака упозорења&nbsp;</font></b></td>
<td><input name="oznakaUpozorenja" type="text" size="50" value="<?php echo htmlspecialchars($oznaka); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Тежина (kg)&nbsp;</font></b></td>
<td><input name="tezina" type="number" step="0.01" min="0" size="50" value="<?php echo htmlspecialchars($tezina); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Цена (РСД)&nbsp;</font></b></td>
<td><input name="cena" type="number" step="0.01" min="0" size="50" value="<?php echo htmlspecialchars($cena); ?>" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Статус&nbsp;</font></b></td>
<td><input name="status" type="text" size="50" value="<?php echo htmlspecialchars($status); ?>" /></td></tr>

<tr><td align="right" valign="top"><b><font face="Trebuchet MS" size="2px">Курир&nbsp;</font></b></td>
<td><select name="idKurira">
    <?php
    if ($this->kurirRepo->BrojZapisa > 0) {
        for ($i = 0; $i < $this->kurirRepo->BrojZapisa; $i++) {
            $idk = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 0);
            $prz = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 1);
            $ime = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 2);
            $sel = ($idk == $idKurira) ? ' selected' : '';
            echo '<option value="' . htmlspecialchars($idk) . '"' . $sel . '>' . htmlspecialchars($prz . ' ' . $ime . ' (' . $idk . ')') . '</option>';
        }
    }
    ?>
</select></td></tr>

<tr><td></td><td><br/><input type="submit" value="СНИМИ ИЗМЕНУ" /> &nbsp; <a href="<?php echo OSNOVA; ?>/paket/index">Назад</a></td></tr>
</table>
</form>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/paketValidacija.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
