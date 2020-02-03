<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Strumenti Utenti';
$areapagina = "tools";
$coldx = "no";

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

@$sid = $_REQUEST['sid'];
@$stId = $_REQUEST['stid'];
@$prj = $_REQUEST['prj'];
@$gt = $_REQUEST['guest'];
@$ss = $_REQUEST['ss'];
@$ot = $_REQUEST['ot'];
@$nl = $_REQUEST['nl'];
@$abi = $_REQUEST['abi'];
@$vId = $_REQUEST['viewId'];
@$ctId = $_REQUEST['ctId'];
@$vDat = $_REQUEST['viewData'];

//Tutto maiuscolo//
$sid=strtoupper($sid);
$prj=strtoupper($prj);
$vId=strtoupper($vId);


mysqli_select_db($database_admin, $admin);


?>
<script type="text/javascript" src="js/jquery.zclip.min.js"></script>

<div id="modLink">

	  
	  
	  <div class="insez" style="width:200px; height:120px; margin-left:500px;">
	  
		    <div align="center" class="title">DATI RICERCA:</div>
	  
		    <div align="left" style="margin-left:10px; line-height:30px; padding:5px;">
		    <form method="get" action="tools_res.php">
		    
		    Sid:<input style="text-transform:uppercase;" name="viewId" type="text">&nbsp;&nbsp;&nbsp;
			 Data:<input style="text-transform:uppercase;" name="viewData" type="datetime">&nbsp;&nbsp;&nbsp;
		    <input type="submit" name="ctId" id="crea" value="CERCA">
		    
		    </form>
		    
		    </div>
	  
	  </div>

</div>



<table style='margin-left:20px;' width='60%' class='sez2' id='linTab'>


<?php
//Tabella Cerca//
if ($ctId=="CERCA")
{
?>
<table style='margin-left:20px;'  class='sez2' id='linTab'>
<?php	  
	  $query_search="SELECT COUNT(uid) as ab FROM t_respint WHERE sid='$vId' ";
	  $abil = mysqli_query($query_search, $admin) or die(mysql_error());
	  $tot_abil = mysqli_fetch_assoc($abil);
	  
	  $query_search="SELECT COUNT(uid) as cc FROM t_respint WHERE sid='$vId' and iid<>-1 ";
	  $contact = mysqli_query($query_search, $admin) or die(mysql_error());
	  $tot_contact = mysqli_fetch_assoc($contact);
	  
	  $query_search="SELECT prj_name as prj FROM t_surveys WHERE sid='$vId'";
	  $contact = mysqli_query($query_search, $admin) or die(mysql_error());
	  $prog = mysqli_fetch_assoc($contact);
	  
	  $query_search="SELECT COUNT(uid) as co FROM t_respint WHERE sid='$vId' and status=3 ";
	  $comp = mysqli_query($query_search, $admin) or die(mysql_error());
	  $tot_comp = mysqli_fetch_assoc($comp);
	  
	  $rp=$tot_contact['cc']/$tot_abil['ab']*100;
	  $rs=$tot_comp['co']/$tot_contact['cc']*100;
	  $abi=$tot_abil['ab'];
	  $cont=$tot_contact['cc'];
	  $comp=$tot_comp['co'];
	  $pr=$prog['prj'];
	
	  $query_inserisci="INSERT INTO t_panel_control (sur_id,abilitati,contatti,complete,red_panel,sur_date,red_surv,prj) VALUES ('$vId','$abi','$cont','$comp','$rp','$vDat','$rs','$pr'); ";
	  $result = mysqli_query($query_inserisci);
	  mysql_close();
	
	  
	 
}
?>
<th>Ricerca</th><th>Abilitati</th><th>Contatti</th><th>Completi</th><th>%Panel</th><th>%Survey</th>
<tr>
<td><?php echo $vId;?></td>
<td><?php echo $tot_abil['ab'];?></td>
<td><?php echo $tot_contact['cc'];?></td>
<td><?php echo $tot_comp['co'];?></td>
<td><?php echo sprintf("%01.2f", $rp)."%";  ?></td>
<td><?php echo sprintf("%01.2f", $rs)."%";  ?></td>
</tr>


</table>


<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>