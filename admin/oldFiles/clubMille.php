<?php
$query_new = "SELECT count('nid') as tot FROM millebytesdb.support_ticket where state='1';";
$new_crm = mysqli_query($query_new, $admin) or die(mysql_error());
$crm_new = mysqli_fetch_assoc($new_crm);

$query_new = "SELECT count('nid') as tot FROM millebytesdb.support_ticket where state='2' or state='3';";
$sosp_crm = mysqli_query($query_new, $admin) or die(mysql_error());
$crm_sosp = mysqli_fetch_assoc($sosp_crm);

$query_cerca1 = "SELECT COUNT('user_id') as tot1 FROM t_user_history where event_type='withdraw'";
$cerca1 = mysqli_query($query_cerca1, $admin) or die(mysql_error());
$crm_cerca1 = mysqli_fetch_assoc($cerca1);

$query_cerca = "SELECT COUNT('user_id') as tot FROM t_history_copia where pagato=1 order by event_date desc";
$cerca = mysqli_query($query_cerca, $admin) or die(mysql_error());
$crm_cerca = mysqli_fetch_assoc($cerca);

?>

<div style="margin-bottom:10px;" class="title">CLUB MILLEBYTES</div>


<!-- Ricerca iscritti -->
<div style="border:1px dotted;">

   <table width="100%" align="center"><tr>
    <td>
    	<div ><b>Ricerca Utente</b></div><form target="_blank" method="get" action="user_search.php">
        <table align="center"><tr>
            
            <td>ID<input type="radio" value="user_id" name="searchfor" /></td>
            <td>Nome Cognome<input type="radio" name="searchfor" value="second_name" /></td>
            <td>Email<input type="radio" name="searchfor" value="email" /></label></td>
        </tr><tr>
            <input type="hidden" value="1000" name="limit"> 
            <td colspan="2"><input type="text" name="searchtxt" /></td>
            <td><input type="submit" value="CERCA" class="mini" /></td>
        </tr></table></form>
    </td></tr>
 </table>

</div>



 <!--Richieste da leggere -->
<div style="margin-left:260px;">
<table style="border:1px dotted; height:86px">
<th height="20px">Richieste Utenti</th>

<?php 
$total_crm=$crm_new['tot'];
$sosp_crm=$crm_sosp['tot'];
$cer=$crm_cerca1['tot1']-$crm_cerca['tot'];
$sum=$total_crm+$sosp_crm+$cer;

if ( $sum > 0) 
{
		 if ( $total_crm == 1) {$ric="richiesta";}
		 else { $ric="richieste";}
?>
	<?php if ($total_crm>0){?> <tr><td>Hai <b><a href="http://www.millebytes.com/it/support/test_millebytes/new"><?php echo $total_crm." ".$ric; ?></a></b> da leggere </td></tr> <?php } ?>
	<?php if ($sosp_crm>0){?><tr><td>Hai <b><a href="http://www.millebytes.com/it/support/test_millebytes"><?php echo $sosp_crm." ".$ric; ?></a></b> in sospeso </td></tr> <?php } ?>


<?php   if ($cer>0) { if ( $cer == 1) {$ric="richiesta";} 	else { $ric="richieste";} 	?>
	
	<tr><td>Hai <b><a href="http://stats.primisoft.com/cms/admin/RichiestePremio.php"><?php echo $cer." ".$ric; ?></a></b> premio in sospeso </td></tr>
	

<?php } 

} 

else {?><tr><td> Nessuna nuova richiesta da leggere </td> </tr><?php } ?>



</table>

</div>

