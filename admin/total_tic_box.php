<?php 

mysqli_select_db($database_admin, $admin);
$query_tic = "SELECT u.user_id as user , u.email as email, t.code as code, t.received_on as buy, t.id as id_tic, t.user_id as usertic, t.valid, c.start_date  FROM t_virtual_tickets as t, t_concorso as c, t_user_info as u  WHERE c.status_v=1 AND t.received_on <= c.end_date AND t.received_on >= c.start_date  AND u.user_id=t.user_id AND t.valid='1' ORDER BY t.id DESC LIMIT 5";
$tic = mysqli_query($query_tic, $admin) or die(mysql_error());
$row_tic = mysqli_fetch_assoc($tic);
$total_tic = mysql_num_rows($tic);
?>

<div class="sez2">
<div class="title"> ULTIMI 5 TICKET ACQUISTATI</div>
<?php if ( $total_tic > 0) { ?>
<table class="insez" width="88%"><tr>
<td class="insez">User Id</td>
<td class="insez">E mail</td>
<td class="insez">Id ticket</td>
<td class="insez">Codice</td>
<td class="insez">Comprato</td>       
<td class="insez">Status</td>
</tr>
<?php do {
	include('tic_buy_row_total.php');
} while ($row_tic = mysqli_fetch_assoc($tic));

?>    
</table>
<div align="right" style="font-size:x-small"><a href="?dettagli=view">|MOSTRA TUTTI|</a></div>
<div align="left"  style="font-size:x-small; margin-bottom:10PX;">

<form action="admin_ticket.php" method="get">
<input type="hidden" name="dettagli" value="ver" />
Limite ticket:<input name="ct" size="2" type="input" value="10" />
<input type="submit" value="CONTROLLA" style="width:10%"/>
</form>

</div>
<?php }


 else {?>
Nessun ticket acquistato
<?php } ?>
</div>