<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Gestione Utenti';
$areapagina = "tools";
$coldx = "no";

@$action = $_REQUEST['action'];


switch ($action){
	case "filter_selected":
	if (empty($_REQUEST['filtri'])) { 
	$errore	= "Selezionare almeno un filtro";
	} else {
	$action = "filter_list";
	$errore = "";
	}
	break;
	
	case "filter_list":
	$errore = "";
	foreach ($_REQUEST['filtri'] as $filtro){
	$verifica = "s_".$filtro;
	$verifica = $_REQUEST[$verifica];
	if ($filtro == "birth_date"){
	$age_from = $_REQUEST['age_from'];
	$age_to = $_REQUEST['age_to'];
	if (!empty($verifica)){foreach ($verifica as $verifico) {list($age_from, $age_to) = explode('/',$verifico);}}
	if (empty($age_from) || empty($age_to) || $age_from >= $age_to )
		{$errore = "Controllare l'intervallo di et&agrave;";} 
	$verifica = $age_from."/".$age_to;
	}
	if (empty($verifica)) { $errore	= "Selezionare almeno un criterio per ogni filtro";}
	} 
	if ($errore == ""){$action = "filter_option";}
	break;
	case "filter_option":
	
	if ($_REQUEST['solo_attivi'] == "si"){$obbligatori[] = "i.active = '1'"; }
	
	foreach ($_REQUEST['filtri'] as $filtro){
	$tabella = $filtro;
	$criterio = "s_".$filtro;
	$obbligo = "o_".$filtro;
	
	$value_c = $_REQUEST[$criterio];
	$value_o = $_REQUEST[$obbligo];
	
	if ($value_o == "si"){$obbligo = "si";}
	foreach ($array_tables as $value => $domanda){
	if ($filtro == $value ){
	if ($filtro == "birth_date"){ 
	foreach ($_REQUEST[$criterio] as $age){
	list($age_from, $age_to) = explode('/',$age); }
	$birth_date_from = date_from_age($age_to);
	$birth_date_to = date_from_age($age_from);
	if ($obbligo == "si"){
	$obbligatori[] = "STR_TO_DATE(i.birth_date, '%Y-%m-%d') between '".$birth_date_from."' AND '".$birth_date_to."'";
	} else {
	$altri[] = "STR_TO_DATE(i.birth_date, '%Y-%m-%d') between '".$birth_date_from."' AND '".$birth_date_to."'";}
	} else {
	foreach ($value_c as $valore){
	if ($domanda != "p.question"){
		if ($obbligo == "si"){
	$obbligatori[] = $domanda."='".$valore."'";
		} else {
	$altri[] = $domanda."='".$valore."'";}
	} else {
		if ($obbligo == "si"){
	$obbligatori[] = "p.question_code='".str_replace("a_","Q",$filtro)."' AND find_in_set(".$valore.", answer)" ;
		} else {
	$altri[] = "p.question_code='".str_replace("a_","Q",$filtro)."' AND find_in_set(".$valore.", answer)" ;}
	}}
	
}}}} 
	$totale_o = count($obbligatori);
	$totale_a = count($altri);

	if ($totale_o > 0){
	$searchfor = " AND (";
	$i=1;						
	foreach ($obbligatori as $obbligatorio){
		$searchfor .= $obbligatorio;
		if ($i < $totale_o) { $searchfor .= " AND ";}
		$i++;
	}
	$searchfor .= ")";
	}
	
	if ($totale_a > 0){
	$searchfor .= " AND (";
	$i=1;						
	foreach ($altri as $altro){
		$searchfor .= $altro;
		if ($i < $totale_a) { $searchfor .= " OR ";}
		$i++;
	}
	$searchfor .= ")";
	}

	$searchfor = str_replace("='TIM'"," LIKE 'TIM%'",$searchfor);
	$searchfor = str_replace("='WIN'"," LIKE 'WIN%'",$searchfor);
	$searchfor = str_replace("='H3G'"," LIKE 'H3G%'",$searchfor);
	$searchfor = str_replace("='VOD'"," LIKE 'VOD%'",$searchfor);

	$searchfor = "SELECT i.user_id as user_id, i.email as email, i.first_name as first_name, i.gender as gender, i.birth_date as birth_date, i.country as country, i.province_id as province_id, i.mobile_phone as mobile_phone FROM t_user_info as i, t_user_stats as s, t_user_profile as p WHERE i.user_id = s.user_id AND i.user_id = p.user_id ".$searchfor." GROUP BY (user_id)";
	
	$action = "filter_done";
	$errore = "";
	
	break;
}

require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 
?>
<span class="title">CREAZIONE GUIDATA CAMPIONE PRIMIS</span>

<?php 

switch ($action){ 
case "filter_done": 
	require_once('users_primis_form_done.php');
	break; 

case "filter_option": 
	require_once('users_primis_form_options.php');
	break; 
	
case "filter_list": 
	require_once('users_primis_form_list.php');
	break;

case "filter_selected":
	default:
	require_once('users_primis_form_filter.php');
} ?>
<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>