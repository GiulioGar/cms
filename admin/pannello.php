

<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);	

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
$labprj=$_REQUEST['labprj'];
$goal=$_REQUEST['goal'];
$paese=$_REQUEST['paese'];


$cerca_progetto=$_REQUEST['prj'];
if ($cerca_progetto==""){$cerca_progetto="%";}



echo $cerca_panel_originale;
$cerca_panel=$_REQUEST['Cpanel'];
if ($cerca_panel==""){$cerca_panel="%";}


$cerca_anno_originale=$_REQUEST['Canno'];
$cerca_anno=$_REQUEST['Canno'];
if ($cerca_anno==""){$cerca_anno="%";}
					else
					{$cerca_anno=$cerca_anno."%";}
					
					
	



$data=date("Y-m-d");

if($openSearch=="Aggiungi")
{
  
$query_surv = "SELECT sur_id  FROM t_panel_control";
$controlSur = mysqli_query($admin,$query_surv) or die(mysql_error());

$duplicate=0;
while ($row = mysqli_fetch_assoc($controlSur))
{
	$verId=$row['sur_id'];
	if ($verId==$sid) { $duplicate=$duplicate+1;}
}
if($duplicate>0) { ?> 

<div title="Attenzione!" class="dialog-message">Attenzione questa ricerca &egrave; gi&agrave; stata inserita!</div>

 <?php  }

	else{
	  
	$query_user = "INSERT INTO t_panel_control (sur_id,prj,sur_date,stato,sex_target,age1_target,age2_target,end_field,description,goal,panel,paese) 
	VALUES ('".$sid."','".$prj."','".$data."','0','".$sex_target."','".$age1_target."','".$age2_target."','".$end_date."','".$descrizione."','".$goal."','".$panel."','".$paese."')";
	mysqli_query($admin,$query_user) or die(mysql_error());
	}
}


if($modSearch=="Modifica")
{
	  
	$query_user = "UPDATE t_panel_control set panel='".$panel."',age1_target='".$age1_target."',age2_target='".$age2_target."',prj='".$labprj."',
	sur_date='".$sur_date."',end_field='".$end_date."',description='".$descrizione."',goal='".$goal."',sex_target='".$sex_target."',paese='".$paese."' where sur_id='".$id_sur."'";
	mysqli_query($admin,$query_user) or die(mysql_error());

}
 


if($closearch=="CLOSE")
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna = "UPDATE t_panel_control SET stato=1 WHERE stato=0 and id='".$id_sur."'";
$up_ricercha = mysqli_query($admin,$query_aggiorna) or die(mysql_error());

}



mysqli_select_db($database_admin, $admin);
$query_ricerche = "SELECT * FROM t_panel_control where prj like '$cerca_progetto' and panel like '$cerca_panel' and sur_date like '$cerca_anno' order by stato,id DESC";
$query_ricerche_aggiornate = "SELECT * FROM t_panel_control where prj like '$cerca_progetto' and panel like '$cerca_panel' and sur_date like '$cerca_anno' order by stato,giorni_rimanenti ASC,id DESC";
$tot_ricerche = mysqli_query($admin,$query_ricerche) or die(mysql_error());

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

?>


<script type='text/javascript'>
/*
  $(document).ready(function() 
  {
	var larTab=$('#tabField').width();
	
	$('.veditutto,.hidetutto').css('width',larTab);
	
	var nRow=$(".rowSur").length;
	$("#tabField").after("<div class='hidetutto'>NASCONDI</div>");
	$('.hidetutto').hide();
	
	for ( var i = 20; i < nRow; i++ ) { 
	$(".rowSur:nth-of-type("+i+")").hide();}
	$("#tabField").after("<div class='veditutto'>MOSTRA TUTTO</div>");
	
	$('.veditutto').click( function() 
		{ 
		for ( var i = 20; i < nRow; i++ ) { 
		$(".rowSur:nth-of-type("+i+")").slideDown("slow");}
		$('.veditutto').hide();
		$('.hidetutto').show();
		});
		
	$('.hidetutto').click( function() 
		{ 
		for ( var i = 20; i < nRow; i++ ) { $(".rowSur:nth-of-type("+i+")").slideUp("slow");}
		$('.veditutto').show();
		$('.hidetutto').hide();
	});
	
	
  });   
  */
</script>

 <div class="content-wrapper">
     <div class="container">

	
 <div class="row">
   <div class="col-md-2 col-sm-2 col-xs-12">
    <div class="panel panel-primary">	
	                        <div class="panel-heading">
                          Nuova ricerca
                        </div>
<div class="panel-body text-center recent-users-sec">	
   <?php if ($_SESSION['MM_Username']=="g_garofalo"){require_once('modulo_aggiungi_ricerca.php'); }?>
   </div>
   </div>
   
   </div>
  
  
 
 
  <div class="col-md-4 col-sm-4 col-xs-12">
   <div class="panel panel-default">	 
                        <div class="panel-heading">
                          FILTRA RICERCHE
                        </div>
	 <div class="panel-body text-center recent-users-sec">

	<form role="form" name="modulo_cerca_prj" action="pannello.php" method="get">
	<select class="form-control" name="prj">
	<option value="">[PROGETTO]</option>
	<option value="ABO" <?php if ($cerca_progetto=="ABO") {echo 'selected="selected"';} ?>>ABO</option>
	<option value="ADV" <?php if ($cerca_progetto=="ADV") {echo 'selected="selected"';} ?>>ADV</option>
	<option value="AST" <?php if ($cerca_progetto=="AST") {echo 'selected="selected"';} ?>>AST</option>
	<option value="BRS" <?php if ($cerca_progetto=="BRS") {echo 'selected="selected"';} ?>>BRS</option>
	<option value="CLP" <?php if ($cerca_progetto=="CLP") {echo 'selected="selected"';} ?>>CLP</option>
	<option value="CLP" <?php if ($cerca_progetto=="CLP") {echo 'selected="selected"';} ?>>CLP</option>
	<option value="COS" <?php if ($cerca_progetto=="COS") {echo 'selected="selected"';} ?>>COS</option>
	<option value="FAT" <?php if ($cerca_progetto=="FAT") {echo 'selected="selected"';} ?>>FAT</option>
	<option value="FIT" <?php if ($cerca_progetto=="FIT") {echo 'selected="selected"';} ?>>FIT</option>
	<option value="GSI" <?php if ($cerca_progetto=="GSI") {echo 'selected="selected"';} ?>>GSI</option>
	<option value="IPS" <?php if ($cerca_progetto=="IPS") {echo 'selected="selected"';} ?>>IPS</option>
	<option value="JTSMR" <?php if ($cerca_progetto=="JTSMR") {echo 'selected="selected"';} ?>>JTSMR</option>
	<option value="LMI" <?php if ($cerca_progetto=="LMI") {echo 'selected="selected"';} ?>>LMI</option>
	<option value="MRP" <?php if ($cerca_progetto=="MRP") {echo 'selected="selected"';} ?>>MRP</option>
	<option value="MWB" <?php if ($cerca_progetto=="MWB") {echo 'selected="selected"';} ?>>MWB</option>
	<option value="RES" <?php if ($cerca_progetto=="RES") {echo 'selected="selected"';} ?>>RES</option>
	<option value="SIL" <?php if ($cerca_progetto=="SIL") {echo 'selected="selected"';} ?>>SIL</option>
	<option value="SRM" <?php if ($cerca_progetto=="SRM") {echo 'selected="selected"';} ?>>SRM</option>
	<option value="STR" <?php if ($cerca_progetto=="STR") {echo 'selected="selected"';} ?>>STR</option>
	<option value="TNS" <?php if ($cerca_progetto=="TNS") {echo 'selected="selected"';} ?>>TNS</option>
	</select>
		<select class="form-control" name="Cpanel">
			<option value="">[PANEL]</option>
			<option value="0" <?php if ($cerca_panel=="0") {echo 'selected="selected"';} ?>>Esterno</option>
			<option value="1" <?php if ($cerca_panel=="1") {echo 'selected="selected"';} ?>>Millebytes</option>
			
		</select>
		
		<select class="form-control" name="Canno">
			<option value="">[ANNO]</option>
			<option value="2014" <?php if ($cerca_anno_originale=="2014") {echo 'selected="selected"';} ?>>2014</option>
			<option value="2015" <?php if ($cerca_anno_originale=="2015") {echo 'selected="selected"';} ?>>2015</option>
			<option value="2016" <?php if ($cerca_anno_originale=="2016") {echo 'selected="selected"';} ?>>2016</option>
			<option value="2017" <?php if ($cerca_anno_originale=="2017") {echo 'selected="selected"';} ?>>2017</option>
			<option value="2018" <?php if ($cerca_anno_originale=="2018") {echo 'selected="selected"';} ?>>2018</option>
		</select>
		<span class="form-group input-group-btn">
	<p><input class="btn btn-danger" type="submit" value="Filtra"></p>
	</span>
	</form>
	</div>
	
</div>	
</div>

</div>
<?php




?>

 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="panel panel-default">
   
   <div class="panel-body text-center recent-users-sec">
    <div class="table-responsive">
<?php
echo "<table id='tabField' style='font-size:11px' class='table table-striped table-bordered table-hover'>";
echo "<tr class='intesta'>";
echo "<td style='font-weight:bold'>Ricerca</td>";
echo "<td style='font-weight:bold'>Descrizione</td>";
echo "<td style='font-weight:bold'>Panel</td>";
echo "<td style='font-weight:bold'>Complete</td>";
echo "<td style='font-weight:bold'>% Panel</td>";
echo "<td style='font-weight:bold'>% Ricerca</td>";
echo "<td style='font-weight:bold'>N° Interviste</td>";
echo "<td style='font-weight:bold'>Obiettivo</td>";
echo "<td style='font-weight:bold'>Durata</td>";
echo "<td style='font-weight:bold'>Start</td>";
echo "<td style='font-weight:bold'>Giorni</td>";
echo "<td style='font-weight:bold'>Costo Panel</td>";
echo "<td style='font-weight:bold'>Stato</td>";
echo "<td colspan='2' style='font-weight:bold'>&nbsp;</td>";
echo "</tr>";

//AGGIORNO INFO GIORNI RIMANENTI IN DB
while ($row = mysqli_fetch_assoc($tot_ricerche))
{
$today=substr($data,0,10);
$sur_date=substr($row['sur_date'],0,10);
$end_date=substr($row['end_field'],0,10);
if($end_date <> "") {$daysField=delta_tempo($today, $row['end_field'], "g"); }
else { $daysField="n.d.";}
if ($daysField<0) {$daysField=0;}
$sid=$row['sur_id'];
$query_aggiorna_statistiche = "UPDATE t_panel_control set giorni_rimanenti='".$daysField."' where sur_id='".$sid."'";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche) or die(mysql_error());
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);
}


//STAMPO LE RICERCHE DOPO AGGIORNAMENTO DEI GIORNI RIMANENTI
$tot_ricerche = mysqli_query($admin,$query_ricerche_aggiornate) or die(mysql_error());


while ($row = mysqli_fetch_assoc($tot_ricerche))
{
if ($row['stato']==0){$stato="Aperto"; $colRow="#BCF7BB"; $colSat="#007F21";}
if ($row['stato']==1){$stato="Chiuso"; $colRow="#FFF"; $colSat="#FF0400";}
if ($row['panel']==1){$panel="Millebytes";}
if ($row['panel']==0){$panel="Esterno";}
if ($row['panel']==2){$panel="Target";}
if ($row['sex_target']==1){$sex="M";}
if ($row['sex_target']==2){$sex="F";}
if ($row['sex_target']==3){$sex="M-F";}
$today=substr($data,0,10);
$sur_date=substr($row['sur_date'],0,10);
$end_date=substr($row['end_field'],0,10);
if($end_date <> "") {$daysField=delta_tempo($today, $row['end_field'], "g"); $dayClass="inField";}
else { $daysField=-1;}
if ($daysField<=0) {$daysField=0;}
if ($daysField==0 && $end_date< $today ) {$daysField=delta_tempo($row['sur_date'] ,$row['end_field'], "g");  $dayClass="cloField";}
if ($daysField==0 && $end_date==$today ) {$dayClass="last";}
$obj=$row['complete']-$row['goal'];
$sid=$row['sur_id'];
//Definisco stile obiettivo//
if ($obj<0) {$stObj='red';}
else {$stObj='#02680F';}

echo "<tr class='rowSur' style='background:".$colRow."'>";
echo "<td><a href='conta_locale.php?prj=".$row['prj']."&sid=".$row['sur_id']."'>".$row['sur_id']."</a><br></td>";
echo "<td>".$row['description']."</td>";
echo "<td>".$panel."</td>";
echo "<td>".$row['complete']."</td>";
echo "<td>".$row['red_panel']."%</td>";
echo "<td>".$row['red_surv']."%</td>";
echo "<td>".$row['goal']."</td>";
echo "<td style='color:".$stObj."'>".$obj."</td>";
echo "<td>".$row['durata']." min.</td>";
echo "<td>".$sur_date."</td>";
if ($daysField==0 && $end_date==$today ){echo "<td><span class='".$dayClass."'>Ultimo<span></td>";}else{echo "<td><span class='".$dayClass."'>".$daysField."<span></td>";}

$costo=$row['costo'];
if ($costo==""){$costo=0;}
echo "<td>€".$costo."</td>";
echo "<td style='color:".$colSat."'>".$stato."</td>";
if($stato=="Aperto" && $_SESSION['MM_Username']=="g_garofalo") { echo "<td id='forClo'><form  action=\"pannello.php\" method=\"get\"><input type=\"hidden\" name=\"id_sur\" value=\"".$row['id']."\" />
<input id='botClo' type='submit'  name='closearch' value='CLOSE' /></form></td>";}
else { echo "<td id='forClo'>&nbsp;</td>";}
if ($_SESSION['MM_Username']=="g_garofalo"){echo "<td><div class='apriMod' id='$sid'><img style='width:15px' src='img/modbutton.jpg'/></div></td>";}
else
{echo "<td><div></div></td>";}
echo "</tr>";


$query_aggiorna_statistiche = "UPDATE t_panel_control set giorni_rimanenti='".$daysField."' where sur_id='".$sid."'";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche) or die(mysql_error());
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);
 ?>

<div align="left" class="modifica" id="<?php echo $sid; ?>">
<div style="padding:30px; font-size:16px;">
<form  action="pannello.php" method="get">
<div><b>Modifica dati ricerca: <?php echo $sid;?></b></div>
<input name="id_sur" type="hidden" value="<?php echo $row['sur_id'];?>">
<div style="float:left;">Prj:</div><div style="margin-left:130px;"><input type="text" style="width:40px" value="<?php echo $row['prj'];?>"  name="labprj"></div>
<div style="float:left;">Panel:</div><div style="margin-left:130px;"> <select name="panel"><option selected="selected" value="<?php echo $row['panel'];?>"> <?php echo $panel;?> </option><option value="1">Millebytes</option><option value="0">Esterno</option></select></div>
<div style="float:left;">Target Sesso:</div> <div style="margin-left:130px;"><select name="sex_target"><option value="<?php echo $row['sex_target'];?>" selected="selected"> <?php echo $sex; ?><option value="1">Uomo</option><option value="2">Donna</option><option value="3">Uomo/Donna</option></select></div>
<div style="float:left;">Target Età:</div><div style="margin-left:130px;"><input type="text" maxlength="2" style="width:40px" value="<?php echo $row['age1_target'];?>"  name="age1_target">-<input type="text" maxlength="2" value="<?php echo $row['age2_target'];?>" style="width:40px" name="age2_target"></div>
<div style="float:left;">N°Interviste:</div><div style="margin-left:130px;"><input type="text" maxlength="4" value="<?php echo $row['goal'];?>" style="width:80px" id="goal" name="goal"></div>
<div style="float:left;">Start Field:</div><div style="margin-left:130px;"><input type="text" id="datepicker" value="<?php echo $sur_date; ?>" name="sur_date"></div>
<div style="float:left;">End Field:</div><div style="margin-left:130px;"><input type="text" id="datepicker" value="<?php echo $end_date; ?>" name="end_date"></div>
<div style="float:left;">Descrizione:</div><div style="margin-left:130px;"><input type="text" name="descrizione" value="<?php echo $row['description'];?>"></div>

<div><input type="submit" name="modSearch" value="Modifica"></div>
</form>
</div>
<p class="chiudi">X</p>

</div>

<div class="overlay" id="overlay" style="display:none;"></div>
<script>
$(".apriMod#<?php echo $sid; ?>").click(
     function(){
         $('#overlay').fadeIn('fast');
         $('.modifica#<?php echo $sid; ?>').fadeIn('slow');
		 
     });
 
     $(".chiudi").click(
     function(){
     $('#overlay').fadeOut('fast');
		$('.modifica#<?php echo $sid; ?>').hide();
     });
 
     //chiusura emergenza
     $("#overlay").click(
     function(){
     $(this).fadeOut('fast');
		$('.modifica#<?php echo $sid; ?>').hide();
     });
 
</script>
<?php
}


echo "</table>";
?>
</div>

</div>

</div>
</div>
</div>


</div>
</div>


 <script>
$("#datepicker").datepicker({ 
  dateFormat: "yy-mm-dd",
  altFormat: "yy-mm-dd"
});
</script>



<?php

require_once('inc_footer.php'); 


mysql_close();
?>
