<?php $naslov = "Унос пакета"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">УНОС НОВОГ ПАКЕТА</font></b><br/><br/>

<form method="POST" action="<?php echo OSNOVA; ?>/paket/dodaj" class="forma-paket" novalidate>
<table style="width:90%;" cellspacing="4" cellpadding="2" border="0">

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Шифра пакета&nbsp;</font></b></td>
<td><input name="sifraPaketa" type="text" size="50" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Пошиљалац&nbsp;</font></b></td>
<td><input name="posiljalac" type="text" size="50" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса пошиљаоца&nbsp;</font></b></td>
<td><input name="adresaPosiljaoca" type="text" size="50" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Прималац&nbsp;</font></b></td>
<td><input name="primalac" type="text" size="50" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса доставе&nbsp;</font></b></td>
<td><input name="adresaDostave" type="text" size="50" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Ознака упозорења&nbsp;</font></b></td>
<td><select name="oznakaUpozorenja">
    <option value="Nema">Нема</option>
    <option value="Lomljivo">Ломљиво</option>
    <option value="Opasno">Опасно</option>
    <option value="Hitno">Хитно</option>
</select></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Тежина (kg)&nbsp;</font></b></td>
<td><input name="tezina" type="number" step="0.01" min="0" size="50" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Цена (РСД)&nbsp;</font></b></td>
<td><input name="cena" type="number" step="0.01" min="0" size="50" /></td></tr>

<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Статус&nbsp;</font></b></td>
<td><select name="status">
    <option value="Na cekanju">На чекању</option>
    <option value="U isporuci">У испоруци</option>
    <option value="Isporucen">Испоручен</option>
</select></td></tr>

<tr><td align="right" valign="top"><b><font face="Trebuchet MS" size="2px">Курир&nbsp;</font></b></td>
<td><select name="idKurira">
    <option value="">изаберите...</option>
    <?php
    if ($this->kurirRepo->BrojZapisa > 0) {
        for ($i = 0; $i < $this->kurirRepo->BrojZapisa; $i++) {
            $idk = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 0);
            $prz = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 1);
            $ime = $this->kurirRepo->DajVrednostPoRednomBrojuZapisaPoRBPolja($this->kurirRepo->Kolekcija, $i, 2);
            echo '<option value="' . htmlspecialchars($idk) . '">' . htmlspecialchars($prz . ' ' . $ime . ' (' . $idk . ')') . '</option>';
        }
    }
    ?>
</select></td></tr>

<tr><td></td><td><br/><input type="submit" value="СНИМИ" /> &nbsp; <a href="<?php echo OSNOVA; ?>/paket/index">Назад</a></td></tr>
</table>
</form>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/paketValidacija.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
