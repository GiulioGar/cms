

<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	


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



</div>
<div class="row">
<div class="col-md-2 col-md-offset-1">
</div>

<div class="col-md-8 col-md-offset-1">
<div class="card-body">
<div class="table-responsive">
<table id='tabField' style='font-size:11px text-align:center' class='table table-striped table-hover'>
<thead>
<th colspan='1' style='font-size:18px; color:red'>Anno: <span class='stampanno'>2020</span> </th>
<th colspan='2' >
<form role="form" name="modulo_cerca_prj">

<div class="bootstrap-select-wrapper">
		<select class="form-control Canno" name="Canno">
			<option value="">[ANNO]</option>
			<option value="2016" <?php if ($cerca_anno_originale=="2016") {echo 'selected="selected"';} ?>>2016</option>
			<option value="2017" <?php if ($cerca_anno_originale=="2017") {echo 'selected="selected"';} ?>>2017</option>
			<option value="2018" <?php if ($cerca_anno_originale=="2018") {echo 'selected="selected"';} ?>>2018</option>
			<option value="2019" <?php if ($cerca_anno_originale=="2019") {echo 'selected="selected"';} ?>>2019</option>
			<option value="2020" <?php if ($cerca_anno_originale=="2020") {echo 'selected="selected"';} ?>>2020</option>
		</select>
	</form>
</div>
</th>
<th style="vertical-align:middle" colspan="7">
<div class="alert alert-secondary mess2" role="alert" style="display:none"> Caricamento in corso... </div>
</th>
<tr class='intesta'>
<td style='font-weight:bold'>Mese</td>
<td style='font-weight:bold'>Ricerche</td>
<td style='font-weight:bold'>Panel %</td>
<td style='font-weight:bold'>Complete</td>
<td style='font-weight:bold'>Costi</td>
<td style='font-weight:bold'>Tot.Iscritti</td>
<td style='font-weight:bold'>Attivi</td>
<td style='font-weight:bold'>% Attivi</td>
<td style='font-weight:bold'>Registrati</td>
<td style='font-weight:bold'>Premi richiesti</td>
</tr>
</thead>

<tbody>
<?php

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
</tbody>
</table>


</div>
</div>

<div class="col-md-2 col-md-offset-1">
</div>

</div>
</div>



</div>
</div>


<script>

//al click dei disponibili
  $("select.Canno").on('change', function() {


 let can= $("select.Canno").val();
let annogiusto;

$('.mess2').fadeIn();

  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "function_storicoPanel.php",

      //Quali dati devo inviare?
      data: "Canno="+can, 
      dataType: "html",
	  success: function(data) 
	  					{ 
							$('.mess2').fadeOut(); 
							$("tbody").html(data).not(".mostranno");
							annogiusto=$(data).filter(".mostranno");
							$('.stampanno').html(annogiusto);
							$("tbody span.mostranno").remove();
						}

    });
  });

</script>



<?php

require_once('inc_footer.php'); 
?>
