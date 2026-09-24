<?php $naslov = "Нова отпремница"; require("pogledi/delovi/vrh.php"); ?>

<table style="width:100%;" bgcolor="#f4edd8" cellspacing="0" cellpadding="12" border="0">
<tr><td>
<br/>
<b><font face="Trebuchet MS" color="brown" size="4px">НОВА ОТПРЕМНИЦА</font></b><br/><br/>

<form action="<?php echo OSNOVA; ?>/otpremnica/snimi" method="POST" class="forma-otpremnica" novalidate>

<!-- ЗАГЛАВЉЕ (целина) -->
<fieldset style="border:1px solid #a3874e;">
<legend><b><font face="Trebuchet MS" size="3px">Заглавље</font></b></legend>
<table style="width:90%;" cellspacing="4" cellpadding="2" border="0">
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Датум&nbsp;</font></b></td><td><input name="datum" type="date" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Пошиљалац&nbsp;</font></b></td><td><input name="posiljalac" type="text" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Адреса преузимања&nbsp;</font></b></td><td><input name="adresaPreuzimanja" type="text" size="50" /></td></tr>
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Курир&nbsp;</font></b></td><td>
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
<tr><td align="right"><b><font face="Trebuchet MS" size="2px">Статус&nbsp;</font></b></td><td>
    <select name="status">
        <option value="Na cekanju">На чекању</option>
        <option value="U isporuci">У испоруци</option>
        <option value="Isporucen">Испоручен</option>
    </select></td></tr>
</table>
</fieldset>
<br/>

<!-- СТАВКЕ (делови) -->
<fieldset style="border:1px solid #a3874e;">
<legend><b><font face="Trebuchet MS" size="3px">Ставке (пакети)</font></b></legend>
<table id="stavkeTabela" style="width:100%;" cellspacing="0" cellpadding="5" border="1" bordercolor="#a3874e" bgcolor="#fffdf3">
<thead>
<tr bgcolor="#664600">
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;Р.б.&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ПРИМАЛАЦ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;АДРЕСА ДОСТАВЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;УПОЗОРЕЊЕ&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ТЕЖИНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;ЦЕНА&nbsp;</font></b></td>
    <td><b><font face="Trebuchet MS" color="white" size="2px">&nbsp;АКЦИЈА&nbsp;</font></b></td>
</tr>
</thead>
<tbody>
<tr bgcolor="#f4edd8">
    <td>1</td>
    <td><input type="text" name="primalac[]" /></td>
    <td><input type="text" name="adresaDostave[]" /></td>
    <td>
        <select name="oznakaUpozorenja[]">
            <option value="Nema">Нема</option>
            <option value="Lomljivo">Ломљиво</option>
            <option value="Opasno">Опасно</option>
            <option value="Hitno">Хитно</option>
        </select>
    </td>
    <td><input type="number" step="0.01" min="0" name="tezina[]" /></td>
    <td><input type="number" step="0.01" min="0" name="cena[]" /></td>
    <td><input type="button" class="btn-obrisi-stavku" value="Обриши" /></td>
</tr>
</tbody>
</table>
<br/>
<input type="button" id="dodajStavku" value="Додај ставку" />
</fieldset>
<br/>

<input type="submit" value="САЧУВАЈ ОТПРЕМНИЦУ" /> &nbsp; <a href="<?php echo OSNOVA; ?>/otpremnica/index">Назад</a>
</form>
<br/>
</td></tr>
</table>

<script src="<?php echo OSNOVA; ?>/js/otpremnicaStavke.js"></script>
<script src="<?php echo OSNOVA; ?>/js/validacija.js"></script>
<script src="<?php echo OSNOVA; ?>/js/otpremnicaValidacija.js"></script>

<?php require("pogledi/delovi/dno.php"); ?>
