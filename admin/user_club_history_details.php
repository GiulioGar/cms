<div class="sez2">
<?php 
$Horderby = "str_to_date(date,'%Y-%m-%d %H:%i:%s')";
if (!empty($_REQUEST['Horderby'])) { $Horderby = $_REQUEST['Horderby']; } 

$Horderord = "DESC";
if (!empty($_REQUEST['Horderord'])) { $Horderord = $_REQUEST['Horderord']; }

mysqli_select_db($database_admin, $admin);
$query_crm = "SELECT * FROM t_user_history WHERE user_id = '$user_id' ORDER BY $Horderby $Horderord";
$crm = mysqli_query($query_crm, $admin) or die(mysql_error());
$row_crm = mysqli_fetch_assoc($crm);
$total_crm = mysql_num_rows($crm);

if ($Horderord == "DESC") {
	$Horderord = "ASC"; }
else {
	$Horderord = "DESC"; }

?>
<div class="title">TUTTE LE ATTIVIT&Agrave; SUL SITO</div>
<?php if ($total_crm > 0) {?>
<table width="88%" class="insez">
    <tr>
    <td align="center" width="20%"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&Horderord=<?php echo $Horderord; ?>">DATA</a></td>
    <td align="center"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&Horderby=description&Horderord=<?php echo $Horderord; ?>">ATTIVIT&Agrave;</a></td>
    <td align="center" width="8%"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&Horderby=previous_bytes&Horderord=<?php echo $Horderord; ?>">PUNTI</a></td>
    <td align="center" width="8%"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&Horderby=previous_euro&Horderord=<?php echo $Horderord; ?>">EURO</a></td>
    <td align="center" width="8%"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&Horderby=assigned_bytes&Horderord=<?php echo $Horderord; ?>">PUNTI ATTIVIT&Agrave;</a></td>
    <td align="center" width="8%"><a href="?user_id=<?php echo $user_id; ?>&dettagli=club&Horderby=assigned_euro&Horderord=<?php echo $Horderord; ?>">EURO ATTIVIT&Agrave;</a></td>
    </tr>
<?php do {
	$Hdata = read_time(htmlentities($row_crm['date']));
	$Hdescrizione = htmlentities($row_crm['description']);
	$Hpunti = $row_crm['previous_bytes'];
	$Hpunti_add = $row_crm['assigned_bytes'];
	$Heuro = $row_crm['previous_euro'];
	$Heuro_add = $row_crm['assigned_euro'];
	include('user_history_row.php');  
} while ($row_crm = mysqli_fetch_assoc($crm));
?>
</table>
<div align="right" style="font-size:x-small"><a href="?user_id=<?php echo $user_id; ?>">|NASCONDI|</a></div>
<?php } 
else {?>
Nessuna attivit&agrave; registrata
<?php } ?>