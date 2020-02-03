<?php 
mysqli_select_db($database_admin, $admin);
$query_richieste = "SELECT r.req_id as req_id, r.user_id as user_id, r.date_req as date_req, r.date_update as date_update, r.date_delivery as date_delivery, s.description as status_id, p.description as prize_id, i.first_name as first_name, i.second_name as second_name, i.mobile_phone as mobile_phone, i.email as email, i.address as address, i.city as city, i.code as code FROM t_prizes_request as r, t_prizes as p, t_prizes_req_status as s, t_user_info as i WHERE r.status_id = s.status_id AND r.prize_id = p.prize_id AND r.user_id = i.user_id AND (r.status_id = '1' OR r.status_id = '2' OR r.status_id = '4') AND i.user_id = '$user_id' ORDER BY str_to_date(date_update,'%d/%m/%Y')";
$richieste = mysqli_query($query_richieste, $admin) or die(mysql_error());
$row_richieste = mysqli_fetch_assoc($richieste);
$total_richieste = mysql_num_rows($richieste);
?>
<div class="sez2">
<div class="title"><?php echo $total_richieste ?> PREMI DA PAGARE</div>
<?php if ( $total_richieste > 0) { ?>
<table class="insez" width="88%"><tr>
<td>ID</td>
<td>Premio</td>
<td>Data</td>
<td>Aggiornato</td>
<td>Consegna</td>
<td>Stato</td>
<td>&nbsp;</td>
</tr>
<?php do {
	include('premi_richieste_row_user.php');
} while ($row_richieste = mysqli_fetch_assoc($richieste));
?>
</table>
<?php } 
else {?>
Nessuna richiesta premio in attesa
<?php } ?>
</div>