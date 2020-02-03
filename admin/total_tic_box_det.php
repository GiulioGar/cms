<?php 

mysqli_select_db($database_admin, $admin);
$query_tic = "SELECT u.user_id as user , u.email as email, t.code as code, t.received_on as buy, t.id as id_tic, t.user_id as usertic, t.valid  FROM t_virtual_tickets as t, t_concorso as c, t_user_info as u  WHERE c.status_v='1' AND t.received_on <= c.end_date AND t.received_on >= c.start_date AND u.user_id=t.user_id ORDER BY t.id DESC";
$tic = mysqli_query($query_tic, $admin) or die(mysql_error());
$row_tic = mysqli_fetch_assoc($tic);
$total_tic = mysql_num_rows($tic);
?>

<div class="sez2">
<div class="title"> TICKET TOTALI <?php echo $total_tic; ?> </div>
<?php if ( $total_tic > 0) { ?>
<div align="right" style="font-size:x-small"><a href="?">|NASCONDI|</a></div>
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

<?php }


else {?>
Nessun ticket acquistato
<?php } ?>


</div>