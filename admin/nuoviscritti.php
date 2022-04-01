<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php');
mysqli_select_db($database_admin, $admin);


$contaiscrittimese=0;

$mesecorrente=date(m);
$annocorrente=date(Y);

$contaGennaio=0;
$contaFebbraio=0;
$contaMarzo=0;
$contaAprile=0;
$contaMaggio=0;
$contaGiugno=0;
$contaLuglio=0;
$contaAgosto=0;
$contaSettembre=0;
$contaOttobre=0;
$contaNovembre=0;
$contaDicembre=0;

//echo "Giorno: ".$giorno." Mese: ".$mese." Anno: ".$anno;

$mese=$_REQUEST['mese'];
if ($mese==""){$mese=$mesecorrente;}


$anno=$_REQUEST['anno'];
if ($anno==""){$anno=$annocorrente;}

$tipocampagna=$_REQUEST['tipocampagna'];
if ($tipocampagna==""){$tipocampagna=1;}


require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 


$query_nuoviutenti = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' ";
$esegui_query_nuoviutenti = mysqli_query($admin,$query_nuoviutenti) ;


while ($row = mysqli_fetch_assoc($esegui_query_nuoviutenti))
{
	$giornoiscrizione=$row['reg_date'];
	$timestamp=strtotime($giornoiscrizione);
	$ricavamese=date('m', $timestamp);
	$ricavaanno=date('Y', $timestamp);
	
	if ($ricavamese==$mese && $ricavaanno==$anno)
	{
		$contaiscrittimese=$contaiscrittimese+1;
		$iscritti[$contaiscrittimese]=$timestamp;


	}
}




$giorno=01;

$giorni = array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato');



//echo $giorni[date('w',strtotime($data))]; 

///RICAVO PRIMO GIORNO
$data = "".$anno."-".$mese."-".$giorno; $giorno_n=date('w',strtotime($data));
$giorno_n=date('w',strtotime($data));


$giornimese = date("t",strtotime($data));




?>

<div class="content-wrapper">
<div class="container">

<div class="row">

<div class="col-md-12 ">
<div class="card shadow mb-12">

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-calendar-week"></i> ISCRITTI PER SETTIMANA </h6></span>
 </div>


<div class="card-body">	

<form role="form" name="modulo_cerca_mese">

<div class="input-group">
	<select class="form-control custom-select meseSel" name="mese" id="inputGroupSelect04">
	<option value="">[MESE]</option>
	<option value="01" <?php if ($mese=="01") {echo 'selected="selected"';} ?>>Gennaio</option>
	<option value="02" <?php if ($mese=="02") {echo 'selected="selected"';} ?>>Febbraio</option>
	<option value="03" <?php if ($mese=="03") {echo 'selected="selected"';} ?>>Marzo</option>
	<option value="04" <?php if ($mese=="04") {echo 'selected="selected"';} ?>>Aprile</option>
	<option value="05" <?php if ($mese=="05") {echo 'selected="selected"';} ?>>Maggio</option>
	<option value="06" <?php if ($mese=="06") {echo 'selected="selected"';} ?>>Giugno</option>
	<option value="07" <?php if ($mese=="07") {echo 'selected="selected"';} ?>>Luglio</option>
	<option value="08" <?php if ($mese=="08") {echo 'selected="selected"';} ?>>Agosto</option>
	<option value="09" <?php if ($mese=="09") {echo 'selected="selected"';} ?>>Settembre</option>
	<option value="10" <?php if ($mese=="10") {echo 'selected="selected"';} ?>>Ottobre</option>
	<option value="11" <?php if ($mese=="11") {echo 'selected="selected"';} ?>>Novembre</option>
	<option value="12" <?php if ($mese=="12") {echo 'selected="selected"';} ?>>Dicembre</option>
	</select>
	<select class="form-control custom-select annoSel" name="anno" id="inputGroupSelect04">
		<option value="">[ANNO]</option>
		<option value="2020" <?php if ($anno=="2020") {echo 'selected="selected"';} ?>>2020</option>
		<option value="2019" <?php if ($anno=="2019") {echo 'selected="selected"';} ?>>2019</option>
		<option value="2018" <?php if ($anno=="2018") {echo 'selected="selected"';} ?>>2018</option>
	</select>
</div>
</form>



<?php
     
    $vediMese;
    
	 if ($mese=="01") {$vediMese='GENNAIO:';} 
	 if ($mese=="02") {$vediMese='FEBBRAIO:';} 
	 if ($mese=="03") {$vediMese='MARZO:';} 
	 if ($mese=="04") {$vediMese='APRILE:';} 
	 if ($mese=="05") {$vediMese='MAGGIO:';} 
	 if ($mese=="06") {$vediMese='GIUGNO:';} 
	 if ($mese=="07") {$vediMese='LUGLIO:';} 
	 if ($mese=="08") {$vediMese='AGOSTO:';} 
	 if ($mese=="09") {$vediMese='SETTEMBRE:';} 
	 if ($mese=="10") {$vediMese='OTTOBRE:';} 
	 if ($mese=="11") {$vediMese='NOVEMBRE:';} 
	 if ($mese=="12") {$vediMese='DICEMBRE:';} 
	 
	 

?>
<hr>

<table id="tabIscritti" class='table table-striped table-bordered table-hover' cellpadding="5">
</table>	
</div>

</div>

</div>


</div>

<!-- STATISTICHE MENSILI -->

<div class="row">

<div class="col-md-12 ">
<div class="card shadow mb-12">

<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"><i class="far fa-calendar-alt"></i> ANDAMENTO ISCRITTI MENSILE </h6></span>
 </div>


<div class="card-body">	
<canvas width="100%" id="linered"></canvas>


</div>
</div>
</div>

</div>




</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<?php

$query_mese = "SELECT reg_date FROM t_user_info where active=1 and email not like'%.top' and reg_date like '%".$anno."%' ";
$esegui_queryMese = mysqli_query($admin,$query_mese);

while ($row2 = mysqli_fetch_assoc($esegui_queryMese))
{
	$giornoiscrizione2=$row2['reg_date'];
	$timestamp2=strtotime($giornoiscrizione2);
	$ricavamese2=date('m', $timestamp2);

	if($ricavamese2==1) { $contaGennaio++; }
	if($ricavamese2==2) { $contaFebbraio++; }
	if($ricavamese2==3) { $contaMarzo++; }
	if($ricavamese2==4) { $contaAprile++; }
	if($ricavamese2==5) { $contaMaggio++; }
	if($ricavamese2==6) { $contaGiugno++; }
	if($ricavamese2==7) { $contaLuglio++; }
	if($ricavamese2==8) { $contaAgosto++; }
	if($ricavamese2==9) { $contaSettembre++; }
	if($ricavamese2==10) { $contaOttobre++; }
	if($ricavamese2==11) { $contaNovembre++; }
	if($ricavamese2==12) { $contaDicembre++; }

}	

echo $contaGennaio;

?>


<script>

//al click dei disponibili
  $("select").on('change', function() {


let meseSel= $("select.meseSel").val();
let annoSel= $("select.annoSel").val();
let tabtot;
let tabField;

$('.mess2').fadeIn();

  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "functions_nuoviscritti.php",

      //Quali dati devo inviare?
      data: "mese="+meseSel+"&anno="+annoSel, 
      dataType: "html",
	  success: function(data) 
	  					{ 
							$('.mess2').fadeOut(); 
							tabField=$(data).filter("#tabIscritti");
							$("#tabIscritti").html(tabField);

						}

    });
  });




window.onload = function() 
{

//carico tabella principale
$.ajax({

//imposto il tipo di invio dati (GET O POST)
 type: "GET",

 //Dove devo inviare i dati recuperati dal form?
 url: "functions_nuoviscritti.php",

 //Quali dati devo inviare?
 data: "mese=<?php echo $mesecorrente; ?>&anno=<?php echo $annocorrente ?>",
 dataType: "html",
 success: function(data) 
					 { 
					   tabField=$(data).filter("#tabIscritti");
					   $("#tabIscritti").html(tabField);

				   }

});


 // chart redemption   
 new Chart(document.getElementById("linered"), {
    type: 'line',
    data: {
      labels: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto" , "Settembre" , "Ottobre", "Novembre", "Dicembre"],
	
      datasets: [{
        label: "ISCRITTI MESE ",
		borderColor: "#9DCE6B",
            pointBorderColor: "#9DCE6B",
            pointBackgroundColor: "#9DCE6B",
            pointHoverBackgroundColor: "#9DCE6B",
            pointHoverBorderColor: "#9DCE6B",
            pointBorderWidth: 6,
            pointHoverRadius: 6,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
        data: [
				<?php echo $contaGennaio; ?>,<?php echo $contaFebbraio; ?>,<?php echo $contaMarzo; ?>,<?php echo $contaAprile; ?>,<?php echo $contaMaggio; ?>,<?php echo $contaGiugno; ?>
				,<?php echo $contaLuglio; ?>,<?php echo $contaAgosto; ?>,<?php echo $contaSettembre; ?>,<?php echo $contaOttobre; ?>,<?php echo $contaNovembre; ?>,<?php echo $contaDicembre; ?>
			 ]
      }]
    },
    options: {
        legend: {
            position: "bottom"
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 20
                },
                gridLines: {
                    drawTicks: false,
                    display: false
                }}],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent"},
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});

}

</script>





<?php

require_once('inc_footer.php'); 

?>
