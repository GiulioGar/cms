<div id="bluebox">
Query: <?php echo $searchfor;?><br />
<?php 
$csv = "uid;email;firstName;genderSuffix;gender;age;country;state;mobilePhone;\n";

mysqli_select_db($database_admin, $admin);
$panel = mysqli_query($searchfor, $admin) or die(mysql_error());
$totalRows_panel = mysql_num_rows($panel);
do {
if (!empty($user['user_id'])){
if ($user['gender']==1){
	$gender_suff = "o";
	$gender = "M";
}else{
	$gender_suff = "a";
	$gender = "F";
}
$age = $user['birth_date'];
list($annon,$mesen,$giornon)=explode('-',$age); 
list($annoo,$meseo,$giornoo)=explode('-',date("Y-n-j")); 
$age=$annoo-$annon; 
if (($mesen>$meseo) or ($mesen==$meseo and $giornon>$giornoo)){$age-=1;}
$operatori = array("VOD","TIM","H3G","WIN");
$mobile_phone = str_replace($operatori, "", $user['mobile_phone']);
@$result .= $user['user_id'].";".$user['email'].";".$user['first_name'].";".$gender_suff.";".$gender.";".$age.";".$user['country'].";".$user['province_id'].";".$mobile_phone.";\n";
}} while ($user = mysqli_fetch_assoc($panel));
$csv .= $result;
?>
Il campione selezionato comprende <?php echo $totalRows_panel; ?> utenti.<br />
<table width="80%"><tr><td align="right">
<?php if ($totalRows_panel > 0){ ?><form action="csv.php" method="post" target="_blank">
<label for="filename">Nome File:</label>
<input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
<input type="text" name="filename" value="Nome_Ricerca" style="width:50%" /></td><td align="left">
<input type="hidden" name="filetype" value="primis" />
<input type="submit" value="DOWNLOAD" /></form>
<?php }else{ ?>
&nbsp;
<?php } ?>
</td>
<td><table>
<tr><td>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<?php foreach ($_REQUEST['filtri'] as $filtro){ echo '<input type="hidden" name="filtri[]" value="'.$filtro.'" />'."\n" ;}?>
<?php foreach ($_REQUEST['filtri'] as $filtro){
	$criterio = "s_".$filtro;
	$value = $_REQUEST[$criterio];
	if ($filtro == "birth_date"){ $value = array($age_from."/".$age_to);}
	foreach ($value as $valore){
	echo '<input type="hidden" name="'.$criterio.'[]" value="'.$valore.'" />'."\n" ;}
}
	?>
<?php foreach ($_REQUEST['filtri'] as $filtro){
	$criterio = "o_".$filtro;
	$value = $_REQUEST[$criterio];
	if ($value == "si"){
	echo '<input type="hidden" name="o_'.$filtro.'" value="si" />'."\n" ;}
}
	?>

      <input type="hidden" name="action" value="filter_list" />
  <input type="submit" value="INDIETRO" />
</form>
</td><td>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<input type="submit" value="FINITO" />
</form></td></tr></table>
</td></tr></table>

</div>