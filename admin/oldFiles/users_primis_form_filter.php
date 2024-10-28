<div id="bluebox">
<table width="100%" align="left">
<tr>
<td>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
Scegli i criteri per cui vuoi creare dei filtri



<td>
<?php if (!empty($errore)) { echo '<span class="title">'.$errore.'</span>'."\n"; } 
@$filtri_temp = $_REQUEST['filtri'];
if (empty($filtri_temp)) {$filtri_temp = array();}
?>
<table>
    <tr align="left">
      <td><p><label>
        <input type="checkbox" name="filtri[]" value="gender" id="filtri_0" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "gender"){echo "checked=\"checked\""; }} ?> />
        Sesso</label></p></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="birth_date" id="filtri_1" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "birth_date"){echo "checked=\"checked\""; }} ?> />
        Et&agrave;</label></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="province_id" id="filtri_2" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "province_id"){echo "checked=\"checked\""; }} ?> />
        Provincia</label></td>
    </tr>
    <tr align="left">
      <td><p><label>
        <input type="checkbox" name="filtri[]" value="work_id" id="filtri_3" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "work_id"){echo "checked=\"checked\""; }} ?> />
        Occupazione</label></p></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="instr_level_id" id="filtri_4" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "instr_level_id"){echo "checked=\"checked\""; }} ?> />
        Istruzione</label></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="mar_status_id" id="filtri_5" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "mar_status_id"){echo "checked=\"checked\""; }} ?> />
        Stato Civile</label></td>
    </tr>
    <tr align="left">
      <td><p><label>
        <input type="checkbox" name="filtri[]" value="mobile_op" id="filtri_6" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "mobile_op"){echo "checked=\"checked\""; }} ?> />
        Operatore Telefonico</label></p></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_11" id="filtri_7" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_11"){echo "checked=\"checked\""; }} ?> />
        Composizione Famiglia</label></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_12" id="filtri_8" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_12"){echo "checked=\"checked\""; }} ?> />
        Hobbies</label></td>
    </tr>
    <tr align="left">
      <td><p><label>
        <input type="checkbox" name="filtri[]" value="a_13" id="filtri_9" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_13"){echo "checked=\"checked\""; }} ?> />
        Prodotti tecnologici</label></p></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_14" id="filtri_10" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_14"){echo "checked=\"checked\""; }} ?> />
        Mezzo di trasporto</label></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_21" id="filtri_11" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_21"){echo "checked=\"checked\""; }} ?> />
        Prodotti alimentari</label></td>
    </tr>
    <tr align="left">
      <td><p><label>
        <input type="checkbox" name="filtri[]" value="a_22" id="filtri_12" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_22"){echo "checked=\"checked\""; }} ?> />
        Dove fa la spesa</label></p></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_23" id="filtri_13" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_23"){echo "checked=\"checked\""; }} ?> />
        Abbonamenti TV</label></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_24" id="filtri_14" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_24"){echo "checked=\"checked\""; }} ?> />
        Servizi/azioni internet</label></td>
    </tr>
    <tr align="left">
      <td><p><label>
        <input type="checkbox" name="filtri[]" value="a_31" id="filtri_15" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_31"){echo "checked=\"checked\""; }} ?> />
        Prodotti bancari o assicurativi</label></p></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_32" id="filtri_16" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_32"){echo "checked=\"checked\""; }} ?> />
        Reddito familiare mensile</label></td>
      <td><label>
        <input type="checkbox" name="filtri[]" value="a_34" id="filtri_17" <?php foreach ($filtri_temp as $filtro) { if ($filtro == "a_34"){echo "checked=\"checked\""; }} ?> />
        Problemi di salute</label></td>
    </tr>
</table>
<tr><td align="right">
  <input type="submit" value="CONTINUA" />
  <input type="hidden" name="action" value="filter_selected" />
 
<?php foreach ($filtri_temp as $filtro){
	@$criterio = "s_".$filtro;
	@$value = $_REQUEST[$criterio];
	if (empty($value)) {$value = array();}
	if ($filtro == "birth_date"){ foreach ($_REQUEST['s_birth_date'] as $age) {list($age_from, $age_to) = explode('/', $age);}
	$value = array($age_from."/".$age_to);}
	foreach ($value as $valore){
	echo '<input type="hidden" name="'.$criterio.'[]" value="'.$valore.'" />'."\n" ;}
}
	?>
</form>
</td>
<td align="left">
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<input type="submit" value="ANNULLA" />
</form>
</td>
</tr>
</table>
</div>