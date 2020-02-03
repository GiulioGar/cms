<div class="sez2">
<?php 
mysqli_select_db($database_admin, $admin);
$query_crm = "SELECT r.crm_id as crm_id, r.user_id as user_id, r.date_update as date_update, o.description as object_id, s.description as status_id FROM t_crm as r, t_crm_status as s, t_crm_objects as o WHERE r.status_id = s.status_id AND r.object_id = o.object_id AND (r.status_id = '1' OR r.status_id = '2' OR r.status_id = '4' OR r.status_id = '5') AND user_id = '$user_id' ORDER  BY r.crm_id DESC ";


$crm = mysqli_query($query_crm, $admin) or die(mysql_error());
$row_crm = mysqli_fetch_assoc($crm);
$total_crm = mysql_num_rows($crm);
?>
<div class="title"><?php echo $total_crm ?> RICHIESTE ASSISTENZA IN ATTESA</div>
<?php if ($total_crm > 0) {?>
<table width="88%"  class="insez" >
<tr style="background-color:#E0E0E0;">
<td><a href="#" style="color:#0B45B0"><b>ID</b></a></td><td><a href="#" style="color:#0B45B0"><b>Oggetto</b></a></td><td><a href="#" style="color:#0B45B0"><b>Stato</b></a></td><td><a href="#" style="color:#0B45B0"><b>Data</b></a></td><td>&nbsp;</td></tr>
<?php do {
	include('crm_richieste_row_user.php');
} while ($row_crm = mysqli_fetch_assoc($crm));
?>
</table>
<?php } 
else {?>
Nessuna richiesta di assistenza in attesa
<?php } ?>
</div>