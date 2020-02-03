

<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	
@$id_sur = $_REQUEST['id_sur'];
@$closearch = $_REQUEST['closearch'];
@$openSearch = $_REQUEST['openSearch'];
@$modSearch = $_REQUEST['modSearch'];
$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];
$panel=$_REQUEST['panel'];
$sex_target=$_REQUEST['sex_target'];
$age1_target=$_REQUEST['age1_target'];
$age2_target=$_REQUEST['age2_target'];
$descrizione=$_REQUEST['descrizione'];
$end_date=$_REQUEST['end_date'];
$sur_date=$_REQUEST['sur_date'];
$goal=$_REQUEST['goal'];
$paese=$_REQUEST['paese'];

$data=date("Y-m-d");

/*default value */
$default_anno=date("Y");

$cerca_anno_originale=$_REQUEST['Canno'];
$cerca_anno=$_REQUEST['Canno'];
if ($cerca_anno==""){$cerca_anno=$default_anno;}
					else
					{$cerca_anno=$cerca_anno;}
					
$data=date("Y-m-d");


mysqli_select_db($database_admin, $admin);

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

?>

<div class="content-wrapper">
  <div class="container">

 <div class="row" style=" float:right; min-height:90px;">
<div class="col-md-12 col-sm-12">   
    <div class="form-group">
	<form role="form" name="modulo_cerca_prj" style="height:50px; margin-left:150px; max-width:500px; position:relative; top:10px; " action="storicoPanel.php" method="get">
		<select class="form-control" name="Canno">
			<option value="">[ANNO]</option>
			<option value="2014" <?php if ($cerca_anno_originale=="2014") {echo 'selected="selected"';} ?>>2014</option>
			<option value="2015" <?php if ($cerca_anno_originale=="2015") {echo 'selected="selected"';} ?>>2015</option>
			<option value="2016" <?php if ($cerca_anno_originale=="2015") {echo 'selected="selected"';} ?>>2016</option>
			<option value="2017" <?php if ($cerca_anno_originale=="2015") {echo 'selected="selected"';} ?>>2017</option>
		</select>
		
	<input class="btn btn-danger" type="submit" value="Filtra"></td>
	</form>
	</div>
	
</div>
	
</div>
	


<div class="row">
<div class="col-md-12 col-sm-12">

<?php
echo "<table id='tabField' style='font-size:12px' class='table table-striped table-bordered'>";
echo "<th colspan='10' style='font-size:16px; color:red'>Anno:".$cerca_anno."</th>";
echo "<tr class='intesta'>";
echo "<td style='font-weight:bold'>Mese</td>";
echo "<td style='font-weight:bold'>Ricerche</td>";
echo "<td style='font-weight:bold'>Panel %</td>";
echo "<td style='font-weight:bold'>Complete</td>";
echo "<td style='font-weight:bold'>Costi</td>";
echo "<td style='font-weight:bold'>Tot.Iscritti</td>";
echo "<td style='font-weight:bold'>Attivi</td>";
echo "<td style='font-weight:bold'>% Attivi</td>";
echo "<td style='font-weight:bold'>Registrati</td>";
echo "<td style='font-weight:bold'>Premi richiesti</td>";
echo "</tr>";

$arrNum = array("01","02","03","04","05","06","07","08","09","10","11","12");
$arrMes = array("Gennaio", "Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");

$cic=0;
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
</table>


</div>
</div>

</div>
</div>
<?php

require_once('inc_footer.php'); 
?>
