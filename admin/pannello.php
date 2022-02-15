<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($admin,$database_admin);	

//     error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);

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
$loi=$_REQUEST['loi'];
$argomento=$_REQUEST['argomento'];
$points=$_REQUEST['point'];
$sex_target=$_REQUEST['sex_target'];
$age1_target=$_REQUEST['age1_target'];
$age2_target=$_REQUEST['age2_target'];
$descrizione=$_REQUEST['descrizione'];
$end_date=$_REQUEST['end_date'];
$labprj=$_REQUEST['labprj'];
$goal=$_REQUEST['goal'];
$paese=$_REQUEST['paese'];
$cliente=$_REQUEST['cliente'];
$tipologia=$_REQUEST['tipologia'];
$costoSur=$_REQUEST['costoSur'];

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
$controlSur = mysqli_query($admin,$query_surv);

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
	  
	$query_user = "INSERT INTO t_panel_control (sur_id,prj,sur_date,stato,sex_target,age1_target,age2_target,end_field,description,goal,panel,paese,cliente,tipologia,bytes) 
	VALUES ('".$sid."','".$prj."','".$data."','0','".$sex_target."','".$age1_target."','".$age2_target."','".$end_date."','".$descrizione."','".$goal."','".$panel."','".$paese."','".$cliente."','".$tipologia."',".$points.")";
	mysqli_query($admin,$query_user);

 

  if ($panel==1)
  {

  $query_loi = "INSERT INTO t_surveys_env (prj_name,sid,name,value,store) 
	VALUES ('".$prj."','".$sid."','length_of_interview','".$loi."','0')";
	mysqli_query($admin,$query_loi);

  $query_argomento = "INSERT INTO t_surveys_env (prj_name,sid,name,value,store) 
	VALUES ('".$prj."','".$sid."','survey_object','".$argomento."','0')";
	mysqli_query($admin,$query_argomento);

  $query_punti = "INSERT INTO t_surveys_env (prj_name,sid,name,value,store) 
	VALUES ('".$prj."','".$sid."','prize_complete','".$points."','0')";
	mysqli_query($admin,$query_punti);
  }


	}
}


if($modSearch=="Modifica")
{
	  
	$query_user = "UPDATE t_panel_control set panel='".$panel."',age1_target='".$age1_target."',age2_target='".$age2_target."',prj='".$labprj."',
	end_field='".$end_date."',description='".$descrizione."',goal='".$goal."',sex_target='".$sex_target."',paese='".$paese."' where sur_id='".$id_sur."'";
  mysqli_query($admin,$query_user);
  

}
 


if($closearch=="CLOSE" || $closearch=="OPEN")
{
if ($closearch=="CLOSE") { $statoSur=0; }
else {$statoSur=1;}

$query_aggiorna = "UPDATE t_panel_control SET stato=$statoSur,costo=$costoSur WHERE id='$id_sur'";
$up_ricercha = mysqli_query($admin,$query_aggiorna);


}



$query_ricerche = "SELECT * FROM t_panel_control order by stato,id DESC";
$query_ricerche_aggiornate = "SELECT * FROM t_panel_control  order by stato,giorni_rimanenti ASC,id DESC";
$tot_ricerche = mysqli_query($admin,$query_ricerche);

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
	 <div class="col col-xs-6">
	</div>
	<div class="col col-xs-6 text-right">
	<?php require_once('modulo_aggiungi_ricerca.php'); ?>
	</div>
	</div>
	
<div class="row">
  <div class="col-md-12 col-md-offset-1">
   <div class="card card-default">
   
   <div class="card-body">
    <div class="table-responsive">
		
	<div class="alert alert-secondary mess" role="alert"> Caricamento in corso... </div>

<table id='table_sur' style='display:none; font-size:11px; text-align:center' class='table table-striped table-hover dt-responsive display dataTable no-footer'>
<thead>
<tr>
<td style='font-weight:bold'>Ricerca</td>
<td style='font-weight:bold'>Descrizione</td>
<td style='font-weight:bold'>Panel</td>
<td style='font-weight:bold'>Complete</td>
<td style='font-weight:bold'>% Panel</td>
<td style='font-weight:bold'>% Ricerca</td>
<td style='font-weight:bold'>Start</td>
<td style='font-weight:bold'>Giorni</td>
<td style='font-weight:bold'>Costo Panel</td>
<td style='font-weight:bold'>Bytes</td>
<td style='font-weight:bold'>Stato</td>
<td style='font-weight:bold'>&nbsp;</td>
</tr>
</thead>
<tbody>


<?php

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
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche);
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);
}


//STAMPO LE RICERCHE DOPO AGGIORNAMENTO DEI GIORNI RIMANENTI
$tot_ricerche = mysqli_query($admin,$query_ricerche_aggiornate);


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
?>

<tr class="rowSur<?php echo $row['id'] ?>" style="background:<?php echo $colRow; ?>">

<?php

echo "<td><a href='controlloField.php?prj=".$row['prj']."&sid=".$row['sur_id']."'>".$row['sur_id']."</a><br></td>";
echo "<td>".$row['description']."</td>";
echo "<td>".$panel."</td>";
echo "<td>".$row['complete']."</td>";
echo "<td>".$row['red_panel']."%</td>";
echo "<td>".$row['red_surv']."%</td>";
echo "<td>".$sur_date."</td>";
if ($daysField==0 && $end_date==$today ){echo "<td><span class='".$dayClass."'>Ultimo<span></td>";}else{echo "<td><span class='".$dayClass."'>".$daysField."<span></td>";}

$costo=$row['costo'];
if ($costo==""){$costo=0;}
echo "<td>€".$costo."</td>";
echo "<td>".$row['bytes']." bytes</td>";
?>


<td>
<form id="<?php echo $row['id'] ?>" class="myform" name="modulo2" >
<input type="hidden" id="id_sur<?php echo $row['id'] ?>" name="id_sur" value="<?php echo $row['id'] ?>">
<input type="hidden" id="costo<?php echo $row['id'] ?>" name="costo" value="<?php echo $row['bytes'] ?>">
<input type="hidden" id="compl<?php echo $row['id'] ?>" name="compl" value="<?php echo $row['complete'] ?>">
<input id="stato<?php echo $row['id'] ?>" data-item-id="<?php echo $row['id'] ?>"  type="checkbox" checked data-toggle="toggle" data-on="On" data-off="Off" data-size="xs" data-onstyle="success" data-offstyle="danger">
</form>
</td>

<script type="text/javascript">

<?php if ($row['stato']==0) { ?>	$('#stato<?php echo $row['id'] ?>').bootstrapToggle('on')	<?php } ?>
<?php if ($row['stato']==1) { ?>	$('#stato<?php echo $row['id'] ?>').bootstrapToggle('off')	<?php } ?>

</script>




<td>
	<div class="apriMod" id="<?php echo $sid; ?>" data-toggle="modal" data-target="#modalMod<?php echo $sid?>" data-whatever="@mdo"><i class='fas fa-pen'></i></div>
</td>

</tr>

<?php

$query_aggiorna_statistiche = "UPDATE t_panel_control set giorni_rimanenti='".$daysField."' where sur_id='".$sid."'";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche);
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);
 ?>


<div class="modal fade" id="modalMod<?php echo $sid?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Modifica dati ricerca: <?php echo $sid;?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form  action="pannello.php" method="get">
<input name="id_sur" type="hidden" value="<?php echo $row['sur_id'];?>">

<div class="input-group">
      <div class="input-group-prepend">
    <span class="input-group-text" id="">Codice SID Progetto:</span>
      </div>
      <input required="" type="text" value="<?php echo $row['prj'];?>"  name="labprj"  class="form-control" id="sid" placeholder="">
	  </div>
	  
	  <div class="input-group mb-3">
      <div class="input-group-prepend">
    <label class="input-group-text" for="panel">Panel:</label>
    </div>
      <select  name="panel" required="" class="custom-select" id="panel">
	  <option selected="selected" value="<?php echo $row['panel'];?>"> <?php echo $panel;?> </option>
      <option value="1">Millebytes</option>
      <option value="0">Esterno</option>
      <option value="2">Target</option>
      </select>
	  </div>
	  
	  <div class="input-group mb-3">
      <div class="input-group-prepend">
    <label class="input-group-text" for="panel">Genere:</label>
    </div>
      <select required="" name="sex_target" required="" class="custom-select" id="sex_target">
	  <option value="<?php echo $row['sex_target'];?>" selected="selected"> <?php echo $sex; ?>
      <option value="1">Uomo</option>
      <option value="2">Donna</option>
      <option value="3">Uomo/Donna</option>
      </select>
	  </div>
	  
	<div class="form-row input-group">
  	<div class="input-group-prepend">
      <span class="input-group-text" id="">Età:</span>
      </div>
    <div class="col">
    <input name="age1_target" value="<?php echo $row['age1_target'];?>" type="number" class="form-control">
    </div>
    <div class="col">
    <input name="age2_target" type="number" value="<?php echo $row['age2_target'];?>" class="form-control">
    </div>
  </div>

  <div class="input-group">
  <div class="input-group-prepend">
      <span class="input-group-text" id="">Interviste:</span>
      </div>
      <input required="" type="number" value="<?php echo $row['goal'];?>" class="form-control" id="goal" placeholder="0" name="goal">
   </div>

   <div class="input-group date">
   <div class="input-group-prepend">
      <span class="input-group-text" id="">Chiusura Field:</span>
      </div>
    <input type="date" value="<?php echo $end_date; ?>"  id="date" class="form-control" name="end_date" >
</div>

<div class="input-group">
<div class="input-group-prepend">
      <span class="input-group-text" id="">Descrizione:</span>
      </div>
      <input required="" type="text" value="<?php echo $row['description'];?>" class="form-control" id="descrizione"  name="descrizione">
      </div>


</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="submit" value="Modifica"  name="modSearch" class="btn btn-primary">Modifica</button>
</form>
      </div>
</form>
</div>
</div>	
</div>	

<?php

}

?>
</tbody>
</table>



</div>

</div>

</div>
</div>
</div>


</div>
</div>







<div class="sp">&nbsp;</div>
<div class="sp">&nbsp;</div>

<script>
$("#datepicker").datepicker({ 
  dateFormat: "yy-mm-dd",
  altFormat: "yy-mm-dd"
});
</script>


<script type="text/javascript">

<?php if ($row['stato']==0) { ?>	$('#stato<?php echo $row['id'] ?>').bootstrapToggle('on')	<?php } ?>
<?php if ($row['stato']==1) { ?>	$('#stato<?php echo $row['id'] ?>').bootstrapToggle('off')	<?php } ?>



  //al click sul bottone del form
  $(".myform").click(function(){
	
	let idVal=$(this).attr("id");

	let togStatus=document.getElementById('stato'+idVal).checked;

	
    //associo variabili
    let id_sur = $("#id_sur"+idVal).val();
    let selezionato="";
    let coSur=$("#costo"+idVal).val();
    let compSur=$("#compl"+idVal).val();
    coSur=coSur/1000;
    coSur=compSur*coSur;


	console.log("costo "+coSur);

	if(togStatus==false) { selezionato="CLOSE";}
	else  { selezionato="OPEN";} 


  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "pannello.php",

      //Quali dati devo inviare?
      data: "id_sur=" + id_sur + "&closearch=" + selezionato + "&costoSur=" + coSur,
      dataType: "html",
	  success: function() 
	  					{ 
							location.reload(); 
						}

    });
  });

</script>


<?php

require_once('inc_footer.php'); 

?>

<script>
$(document).ready( function () {
  $('#table_sur').show();
  $('.mess').fadeOut();
    $('#table_sur').DataTable( {
      "bProcessing":true,
        "order": [[ 11, "asc" ]],
        "pagingType": "full_numbers",
        "scrollY": false,
        "scrollX": false,
		"language": {
      					"emptyTable": "Non sono presenti dati",
						  "search":"Cerca:",
						  "lengthMenu":     "Mostra _MENU_ ricerche"
   					 },
        "lengthMenu": [[10, 30, 100, -1], [10, 30, 100, "All"]],
        "pageLength": 30,
        'columnDefs': [ {

                        'targets': [1,2,12], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );
</script>