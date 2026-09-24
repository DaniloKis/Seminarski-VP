<?php $naslov = "Пакети (REST)"; require("pogledi/delovi/vrh.php"); ?>

<script>const OSNOVA_APP = "<?php echo OSNOVA; ?>";</script>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">ПАКЕТИ (REST)</font></b><br/>
<font face="Trebuchet MS" size="2px">Листа се учитава преко <i>fetch</i>‑а; додавање и брисање иду преко REST захтева.</font>
<br/><br/>

<!-- REST додавање -->
<fieldset style="border:1px solid #a3874e;">
<legend><b><font face="Trebuchet MS" size="3px">Додај пакет (REST)</font></b></legend>
<form class="forma-dodaj" novalidate>
<table style="width:90%;" cellspacing="4" cellpadding="2" border="0">
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Шифра пакета&nbsp;</font></b></td><td><input name="sifraPaketa" type="text" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Пошиљалац&nbsp;</font></b></td><td><input name="posiljalac" type="text" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса пошиљаоца&nbsp;</font></b></td><td><input name="adresaPosiljaoca" type="text" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Прималац&nbsp;</font></b></td><td><input name="primalac" type="text" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса доставе&nbsp;</font></b></td><td><input name="adresaDostave" type="text" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Ознака упозорења&nbsp;</font></b></td><td>
    <select name="oznakaUpozorenja">
        <option value="Nema">Нема</option><option value="Lomljivo">Ломљиво</option>
        <option value="Opasno">Опасно</option><option value="Hitno">Хитно</option>
    </select></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Тежина (kg)&nbsp;</font></b></td><td><input name="tezina" type="number" step="0.01" min="0" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Цена (РСД)&nbsp;</font></b></td><td><input name="cena" type="number" step="0.01" min="0" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Статус&nbsp;</font></b></td><td>
    <select name="status">
        <option value="Na cekanju">На чекању</option><option value="U isporuci">У испоруци</option><option value="Isporucen">Испоручен</option>
    </select></td></tr>
<tr><td align="right" valign="top"><b><font face="Trebuchet MS" size="2px">Курир&nbsp;</font></b></td><td>
    <select name="idKurira">
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
<tr><td></td><td><br/><input type="submit" value="СНИМИ (REST)" /></td></tr>
</table>
</form>
</fieldset>
<br/>

<!-- Претрага -->
<form class="filter-forma" id="filterForm">
<font face="Trebuchet MS" size="2px">Шифра пакета:</font>
<input type="text" name="sifra" />
<input type="submit" value="ПРЕТРАГА" />
<a href="#" class="btn-sve">СВИ</a>
</form>
<br/>

<!-- Табела (пуни се преко fetch) -->
<table class="tabela" style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<thead>
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ШИФРА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПРИМАЛАЦ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;УПОЗОРЕЊЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ТЕЖИНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ЦЕНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;СТАТУС&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КУРИР&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;КОНТРОЛЕ&nbsp;</font></b></td>
</tr>
</thead>
<tbody></tbody>
</table>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/paketValidacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/paketRESTObrisi.js"></script>
<script src="<?php echo OSNOVA; ?>/js/paketRESTUcitajSve.js"></script>
<script src="<?php echo OSNOVA; ?>/js/paketRESTDodaj.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
