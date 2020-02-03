<div class="sez2">
<?php 
$HSorderby = "str_to_date(last_update,'%d/%m/%Y %H:%i:%s')";
if (!empty($_REQUEST['HSorderby'])) { $Horderby = $_REQUEST['HSorderby']; } 
if ($HSorderby == "description") { $HSorderby = "prj_name"; }

$HSorderord = "DESC";
if (!empty($_REQUEST['HSorderord'])) { $Horderord = $_REQUEST['HSorderord']; }

mysqli_select_db($database_admin, $admin);
$query_crm = "SELECT * FROM t_respondents_history WHERE uid = '$user_id' AND status = '3' ORDER BY $HSorderby $HSorderord";
$crm = mysqli_query($query_crm, $admin) or die(mysql_error());
$row_crm = mysqli_fetch_assoc($crm);
$total_crm = mysql_num_rows($crm);

if ($HSorderord == "DESC") {
	$HSorderord = "ASC"; }
else {
	$HSorderord = "DESC"; }

?>
<div class="title">TUTTI I SONDAGGI CONCLUSI PARTECIPATI  (totale sondaggi: <?php echo $total_crm ?>)</div>
<?php if ($total_crm > 0) {?>
<table width="88%" class="insez">
   <tr>
    <td align="center" width="20%"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&HSorderord=<?php echo $HSorderord; ?>">DATA</a></td>
    <td align="center"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&HSorderby=description&HSorderord=<?php echo $HSorderord; ?>">ATTIVIT&Agrave;</a></td>
    <td align="center" width="8%">PUNTI</td>
    <td align="center" width="8%">EURO</td>
    <td align="center" width="8%">PUNTI ATTIVIT&Agrave;</td>
    <td align="center" width="8%">EURO ATTIVIT&Agrave;</td>
    </tr>
<?php do {
	$temp = array(json_decode($row_crm['account_change']));
	
	$Hdata = htmlentities($row_crm['last_update']);
	$Hdescrizione = htmlentities($row_crm['prj_name'])." - ".htmlentities($row_crm['sid']);
	if (!empty($temp[0]->before[0])) { $Hpunti = $temp[0]->before[0]; } else {$Hpunti = "N.D.";}
	if (!empty($temp[0]->before[0])) { $Hpunti_add = $temp[0]->after[0] - $temp[0]->before[0]; } else {$Hpunti_add = "N.D.";}
	if (!empty($temp[0]->before[0])) { $Heuro = $temp[0]->before[1]; } else {$Heuro = "N.D.";}
	if (!empty($temp[0]->before[0])) { $Heuro_add = $temp[0]->after[1] - $temp[0]->before[1]; } else {$Heuro_add = "N.D.";}
	unset($temp); 
	include('user_history_row.php');  
} while ($row_crm = mysqli_fetch_assoc($crm));
?>
</table>
<div align="right" style="font-size:x-small"><a href="?user_id=<?php echo $user_id; ?>">|NASCONDI|</a></div>
<?php } 
else {?>
Nessuna attivit&agrave; registrata
<?php } ?>
