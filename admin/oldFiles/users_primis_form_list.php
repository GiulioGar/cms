<div id="bluebox">
<table width="100%" align="left">
<tr>
<td colspan="2">
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
Definisci i filtri per i criteri scelti:
</td></tr>
<?php 
if (!empty($errore)) { echo '<tr><td colspan="2"><span class="title">'.$errore.'</span></td></tr>'."\n"; } 
@$filtri_temp = $_REQUEST['filtri'];
if (empty($filtri_temp)) {$filtri_temp = array();}?>
<?php foreach ($filtri_temp as $filtro){
	$result = "";
	
		foreach ($array_decode as $value => $domanda){
		$pre_value = "s_".$filtro;
		@$pre_value = $_REQUEST[$pre_value];
		if ($filtro == $value){
		if ($filtro == "birth_date"){
		if ($_REQUEST['s_birth_date'] == "/"){
		$age_from = $_REQUEST['age_from'];
		$age_to = $_REQUEST['age_to'];
		} else {
		foreach ($_REQUEST['s_birth_date'] as $age)
		list($age_from, $age_to) = explode('/', $age);}
		$result .= '<tr align="left"><td colspan="2">Et&agrave; compresa tra <select name="age_from">'."\n";
		for ($i=18;$i<=80;$i++){
		if ($i == $age_from) {$selected = ' selected="selected"'; } else { $selected = '';}
		$result .= '<option value="'.$i.'"'.$selected.'>'.$i."</option>\n";}
		$result .= '</select>'."\n";
		$result .= 'e <select name="age_to">';
		for ($i=19;$i<=80;$i++){
		if ($i == $age_to) {$selected = ' selected="selected"'; } else { $selected = '';}
		$result .= '<option value="'.$i.'"'.$selected.'>'.$i."</option>\n";}
		$result .= '</select> anni</td>'."\n";
		} else {
		$result .= '<tr align="left"><td>'.$domanda.':</td>'."\n";
		$result .= '<td>'.@check_options($$filtro,$pre_value,"s_".$filtro)."</td></tr>\n";
		$result .= '<tr><td colspan"2">&nbsp;</td></tr>'."\n";
		}}}
		echo $result;
	}?>
<tr><td colspan="2">
<table width="30%" align="center">
<tr><td align="right">
  <input type="submit" value="CONTINUA" />
  <input type="hidden" name="action" value="filter_list" />
  <?php foreach ($filtri_temp as $filtro){ echo '<input type="hidden" name="filtri[]" value="'.$filtro.'" />'."\n" ;}?>
  </form>
</td><td align="left">
<table><tr><td>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<?php foreach ($filtri_temp as $filtro){ echo '<input type="hidden" name="filtri[]" value="'.$filtro.'" />'."\n" ;}?>
<?php foreach ($filtri_temp as $filtro){
	$criterio = "s_".$filtro;
	@$value = $_REQUEST[$criterio];
	if (empty($value)) {$value = array();}
	if ($filtro == "birth_date"){ 
	foreach ($_REQUEST['s_birth_date'] as $age) {list($age_from, $age_to) = explode('/', $age);}
	$value = array($age_from."/".$age_to);}
	foreach ($value as $valore){
	echo '<input type="hidden" name="'.$criterio.'[]" value="'.$valore.'" />'."\n" ;}
}
	?>
  <input type="submit" value="INDIETRO" />
</form></td><td>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<input type="submit" value="ANNULLA" />
</form>
</td></tr></table>
</td></tr></table>

</td>
</tr>
</form></table>
</div>