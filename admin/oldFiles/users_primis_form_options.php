<div id="bluebox">
<table width="100%" align="left">
<tr><form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<td colspan="2" align="left">
<label>Ricerca rivolta solo ad utenti attivi <input name="solo_attivi" type="checkbox" value="si" checked="checked" /></label></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2">
Definisci i filtri vincolanti<br />
<span style="font-size: small">Es: se et&agrave; &egrave; vincolante chi non risponde al criterio sar&agrave; escluso, pur rispondendo agli altri criteri.<br />Se non sono definiti filtri vincolanti invece, chi risponde a uno qualsiasi dei criteri sar&agrave; inserito nel campione.</span></td></tr>
<?php 
if (!empty($errore)) { echo '<tr><td colspan="2"><span class="title">'.$errore.'</span></td></tr>'."\n"; } ?>
<?php foreach ($_REQUEST['filtri'] as $filtro){
	$result = "";
		foreach ($array_decode as $value => $domanda){
		if ($filtro == $value){
		$obbligo = "o_".$filtro;
		@$obbligo = $_REQUEST[$obbligo];
		if ($obbligo == "si") {$checked = "checked=\"checked\"";} else {$checked = "";}
		$result .= '<tr align="left"><td><label><input name="o_'.$filtro.'" type="checkbox" value="si" '.$checked.'/> '.$domanda.' </label>'."\n";
		$result .= '</td>'."\n";
		$result .= '<tr><td colspan="2">&nbsp;</td></tr>'."\n";
		}}
		echo $result;
	}?>
</tr>
<tr><td align="right"><input type="submit" value="CONTINUA" />
  <input type="hidden" name="action" value="filter_option" />
  <?php foreach ($_REQUEST['filtri'] as $filtro){ echo '<input type="hidden" name="filtri[]" value="'.$filtro.'" />'."\n" ;}?>
  <?php foreach ($_REQUEST['filtri'] as $filtro){
	$criterio = "s_".$filtro;
	$value = $_REQUEST[$criterio];
	if ($filtro == "birth_date"){ 
	$age_from = $_REQUEST['age_from'];
	$age_to = $_REQUEST['age_to'];
	if (empty($age_from) && empty($age_to)){foreach ($value as $valore) {list($age_from, $age_to) = explode('/',$valore);}}
	$value = array($age_from."/".$age_to);}
	foreach ($value as $valore){
	echo '<input type="hidden" name="'.$criterio.'[]" value="'.$valore.'" />'."\n" ;}
}
	?>
  </form></td>
<td align="left">
<table>
<tr><td>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<?php foreach ($_REQUEST['filtri'] as $filtro){ echo '<input type="hidden" name="filtri[]" value="'.$filtro.'" />'."\n" ;}?>
<?php foreach ($_REQUEST['filtri'] as $filtro){
	$criterio = "s_".$filtro;
	$value = $_REQUEST[$criterio];
	if ($filtro == "birth_date"){ $value = array($_REQUEST['age_from']."/".$_REQUEST['age_to']);}
	foreach ($value as $valore){
	echo '<input type="hidden" name="'.$criterio.'[]" value="'.$valore.'" />'."\n" ;}
}
	?>
      <input type="hidden" name="action" value="filter_selected" />
  <input type="submit" value="INDIETRO" />
</form>
</td><td>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<input type="submit" value="ANNULLA" />
</form></td></tr></table>
</td>
</table>
</div>