<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 
mysqli_select_db($database_admin, $admin);

$data=date("Y-m-d");

/*default value */
$default_anno=date("Y");

$cerca_anno_originale=$_REQUEST['Canno'];
$cerca_anno=$_REQUEST['Canno'];
if ($cerca_anno==""){$cerca_anno=$default_anno;}
					else
					{$cerca_anno=$cerca_anno;}
					
$data=date("Y-m-d");

echo "<span class='mostranno'>".$cerca_anno."</span>";

$arrNum = array("01","02","03","04","05","06","07","08","09","10","11","12");
$arrMes = array("Gennaio", "Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");

$cic=0;
?>

<tbody>
<?php
foreach ($arrNum as $value) 
		{
			
		/*statistiche ricerche */
		$query_ricerche = "SELECT * FROM millebytesdb.t_panel_control where panel=1 and end_field like '".$cerca_anno."-".$value."%' ";
		$tot_ricerche = mysqli_query($admin,$query_ricerche) or die(mysql_error());

		$contaRic=0;
		$completeM=0;
		$panelM=0;
		$costiM=0;
		$mese=$arrMes[$cic];

		while ($row = mysqli_fetch_assoc($tot_ricerche))
		{
		$contaRic++;
		$completeM=$completeM+$row['complete_int'];
		$panelM=$panelM+$row['red_panel'];
		$costiM=$costiM+$row['costo'];
		}
		$panelM=$panelM/$contaRic;
		
		/*statistiche premi */
		$query_premi="SELECT COUNT(user_id) as total FROM millebytesdb.t_user_history where event_type='withdraw' and event_date like '".$cerca_anno."-".$value."%'";
		$tot_premi = mysqli_query($admin,$query_premi) or die(mysql_error());
		$tot_premi_ass = mysqli_fetch_assoc($tot_premi);
		
		/*nuovi registrati */
		$query_reg="SELECT COUNT(user_id) as totalreg FROM millebytesdb.t_user_info where reg_date LIKE '".$cerca_anno."-".$value."%'";
		$query_copia_reg_sample = mysqli_query($admin,$query_reg) or die(mysql_error());
		$query_copia_reg_sample_t = mysqli_fetch_assoc($query_copia_reg_sample);
		
		
		/*totali*/
		$query_user = "SELECT COUNT(*) as totalIsc FROM t_user_info where active='1' and reg_date <= '".$cerca_anno."-".$value."'";
		$tot_user = mysqli_query($admin,$query_user) or die(mysql_error());
		$tot_use = mysqli_fetch_assoc($tot_user);
		
		/*attività */
		$query_user = "SELECT count(distinct story.user_id) as totalAtt FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' AND story.user_id=info.user_id 
		AND story.event_date like '".$cerca_anno."-".$value."%'  AND story.event_type <>'subscribe'  order by story.event_date";
		$tot_att = mysqli_query($admin,$query_user) or die(mysql_error());
		$tot_act = mysqli_fetch_assoc($tot_att);
		$percAtt=0;
		$percAtt=$tot_act['totalAtt']/$tot_use['totalIsc']*100;



		/* stampa la tabella */
		echo "<tr class='rowSur'>";
		echo "<td>".$mese."</td>";
		echo "<td>".$contaRic."</td>";
		echo "<td>".substr($panelM,0,4)."%</td>";
		echo "<td>".$completeM."</td>";
		echo "<td>".$costiM."&euro;</td>";
		echo "<td>".$tot_use['totalIsc']."</td>";
		echo "<td>".$tot_act['totalAtt']."</td>";
		echo "<td>".substr($percAtt,0,4)."%</td>";
		echo "<td>".$query_copia_reg_sample_t['totalreg']."</td>";
		echo "<td>".$tot_premi_ass['total']."</td>";
		echo "</tr>";

		$cic++;
}
 ?>