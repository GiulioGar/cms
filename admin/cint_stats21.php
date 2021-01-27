
<?php



$worksheet = $excelObj->getSheet(0);
$worksheet2 = $excelObj->getSheet(1);


$lastRow = $worksheet->getHighestRow();
     

//FOGLIO 1
    $completeCint;    
    $filtrateCint;    
    $quotaFullCint;    
    for ($row = 1; $row <= $lastRow; $row++) 
    {    
        $leggoStatus=$worksheet->getCell('B'.$row)->getValue();
        if ($leggoStatus=="Complete") {$completeCint++;   }
        if ($leggoStatus=="EarlyScreenout") {$filtrateCint++;   }
        if ($leggoStatus=="QuotaFull" || $leggoStatus=="SurveyClosed" || $leggoStatus=="TimedOut") {$quotaFullCint++;}
    }   

    $contattiCint=$completeCint+$filtrateCint+$quotaFullCint;

    $irCompleteCint=($completeCint/$contattiCint)*100;
    $irScreenoutCint=($filtrateCint/$contattiCint)*100;
    $irQuotafullCint=($quotaFullCint/$contattiCint)*100;

//FOGLIO 2


 
    
   // LETTURA DATABASE
   
// COMPLETE
$query_comp = "SELECT COUNT(*) as total FROM t_respint  where prj_name='CINTPANEL' AND status=3";
$comp_user = mysqli_query($admin,$query_comp);
$comp_use = mysqli_fetch_assoc($comp_user);

// FILTRATE
$query_filt = "SELECT COUNT(*) as total FROM t_respint  where prj_name='CINTPANEL' AND status=4";
$filt_user = mysqli_query($admin,$query_filt);
$filt_use = mysqli_fetch_assoc($filt_user);

// QF
$query_qf = "SELECT COUNT(*) as total FROM t_respint  where prj_name='CINTPANEL' AND status=5";
$qf_user = mysqli_query($admin,$query_qf);
$qf_use = mysqli_fetch_assoc($qf_user);

$contattiDb=$comp_use['total']+$filt_use['total']+$qf_use['total'];


// CONTO INVITI
$query_inviti = "SELECT COUNT(*) as total FROM cint_invites  where inviti=1 and expires LIKE '%2021%'";
$inviti_user = mysqli_query($admin,$query_inviti);
$inviti_use = mysqli_fetch_assoc($inviti_user);

$tassoPart=($contattiCint/$inviti_use['total'])*100;
   
?>
<div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> RISPOSTA UTENTI &nbsp; <span style="float:right"> <i class="fas fa-user-clock"></i></span> </h6>
 </div>

<div class="card-body">  

<div class="row">

<div class="col-md-6">

<!-- TABELLA DATI  DA  ENGAGE-->

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Interviste</th>
      <th scope="col">Redemption</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Complete Engage</th>
      <td><?php echo $completeCint ?></td>
      <td><?php echo (int)$irCompleteCint ?>%</td>
    </tr>
    <tr>


      <th scope="row">Screenout</th>
      <td><?php echo $filtrateCint ?></td>
      <td><?php echo (int)$irScreenoutCint ?>%</td>
    </tr>
    <tr>
      <th scope="row">QuotaFull - Closed</th>
      <td><?php echo $quotaFullCint ?></td>
      <td><?php echo (int)$irQuotafullCint ?>%</td>
    </tr>

    
  </tbody>
</table>

</div>



<div class="col-md-6">

<!-- TABELLA DATI  DA  ENGAGE-->

<table class="table">

<thead class="thead-dark">
    <tr>
      <th scope="col" colspan="2" >Generiche</th>
    </tr>
  </thead>

  <tbody>
    <tr>
      <th scope="row">Email Inviate</th>
      <td><?php echo $inviti_use['total']; ?></td>
    </tr>
    <tr>

    <tr>
      <th scope="row">Tasso di partecipazione</th>
      <td><?php echo (int)$tassoPart;?>%</td>
    </tr>

    
  </tbody>
</table>



</div>

</div>

</div>




</div>
</div>

</div>

<!-- SEZIONE FATTURATO -->

<div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary">BILANCIO &nbsp; <span style="float:right"><i class="fas fa-balance-scale-right"></i></span></h6>
 </div>

<div class="card-body">  

<div class="row">

<div class="col-md-6">

<table style="text-align:center" class="table table-striped">
  <thead>
  <tr style="text-align:left" class="table-light"><th colspan="6" scope="col">INTERVISTE FATTURATE <span style="float:right"><i class="fas fa-file-invoice-dollar"></i></span></th></tr>
    <tr class="table-dark">
      <th scope="col">Mese</th>
      <th scope="col">N° Interviste</th>
      <th scope="col">Entrate Tot</th>
      <th scope="col">Entrate Netto</th>
      <th scope="col">CPI</th>
      <th scope="col">CPI Netto</th>
    </tr>
  </thead>
  <tbody>

  <?php 
  
$contaMesi;
$sumCpi;
$sumCpiLordo;


  for ($row2 = 1; $row2 <= 12; $row2++) 
  {    

$celInt=$worksheet2->getCell('B'.$row2)->getValue();
$celPago=$worksheet2->getCell('C'.$row2)->getValue();

$celCpi=$celPago/$celInt;
$celCpiNetto=$celPago/$celInt-0.27;
$entrateNetto=$celCpiNetto*$celInt;
$celCpi=number_format((float)$celCpi, 2, '.', ''); 
$celCpiNetto=number_format((float)$celCpiNetto, 2, '.', ''); 
$entrateNetto=number_format((float)$entrateNetto, 2, '.', ''); 


if($celInt>0) { $contaMesi++;}
if($celCpiNetto>0) { $sumCpi=$sumCpi+$celCpiNetto; }
if($celCpi>0) { $sumCpiLordo=$sumCpiLordo+$celCpi; }


    echo  "<tr>". 
    "<th scope='col'>".$worksheet2->getCell('A'.$row2)->getValue()."</th>".
    "<td>".$worksheet2->getCell('B'.$row2)->getValue()."</td>".
    "<td>".$worksheet2->getCell('C'.$row2)->getValue()."€</td>".
    "<td>".$entrateNetto."€</td>".
    "<td>".$celCpi."€</td>".
    "<td>".$celCpiNetto."€</td>".
    "</tr>";

    $contaInterviste=$contaInterviste+$celInt;
    $contaPagate=$contaPagate+$celPago;
    $contaPagateNetto=$contaPagateNetto+$entrateNetto;

  } 
  $mediaCpi=$sumCpi/$contaMesi;
  $mediaCpiLordo=$sumCpiLordo/$contaMesi;
  $mediaCpi=number_format((float)$mediaCpi, 2, '.', ''); 
  $mediaCpiLordo=number_format((float)$mediaCpiLordo, 2, '.', ''); 

  ?>

</tbody>
</table>

</div>



<div class="col-md-6">

<table class="table striped">
  <thead class="thead-light">
    <tr>
      <th colspan="2" scope="col">TOTALE ANNUO - FATTURATE<span style="float:right"><i class="fas fa-calculator"></i></span></th>
    </tr>
  </thead>
  <tbody>

<tr>
<th scope="col">N° Interviste</th>
<td><?php echo $contaInterviste ?></td>
</tr>

<tr>
<th scope="col">Entrate Lorde</th>
<td><?php echo $contaPagate ?>€</td>
</tr>

<tr>
<th scope="col">Entrate Nette</th>
<td><?php echo $contaPagateNetto ?>€</td>
</tr>

<tr class="table-info">
<th scope="col">CPI NETTO </th>
<td><?php echo $mediaCpi ?>€</td>
</tr>

</tbody>
</table>

<div>&nbsp;</div>
<!-- DA FATTURARE -->

<?php

$dapagare=$completeCint-$contaInterviste;
$stimaEntrate=$dapagare*$mediaCpiLordo;

?>


<table class="table striped">
  <thead class="thead-dark">
    <tr>
      <th colspan="2" scope="col">DA FATTURARE <span style="float:right"><i class="fas fa-forward"></i></span> </span></th>
    </tr>
  </thead>
  <tbody>

<tr>
<th scope="col">Interviste insolute</th>
<td> <?php echo $dapagare; ?> </td>
</tr>

<tr>
<th scope="col">Importo previsto</th>
<td> <?php echo $stimaEntrate; ?>€</td>
</tr>

</tbody>
</table>
<div>&nbsp;</div>

<!-- PREVISIONI  -->

<?php


$mediaMeseInterviste=$completeCint/$contaMesi;

$stimaintAnno=$mediaMeseInterviste*12;
$stimaentAnno=$stimaintAnno*$mediaCpi;





?>

<table class="table striped">
  <thead class="thead-light">
    <tr>
      <th colspan="2" scope="col">PROSPETTIVA ENTRATE <span style="float:right"><i class="fas fa-comments-dollar"></i></span></th>
    </tr>
  </thead>
  <tbody>

<tr>
<th scope="col">Possibili Interviste annuali</th>
<td> <?php echo $stimaintAnno; ?> </td>
</tr>

<tr style="font-size:16px" class="table-success">
<th scope="col">Possibili Introiti annui</th>
<td> <?php echo (int)$stimaentAnno; ?>€</td>
</tr>

</tbody>
</table>

<div>&nbsp;</div>
</div>





</div>
</div>
</div>
</div>
</div>


<script>

$('td').each(function() {
    var text = $(this).text();
    $(this).text(text.replace('nan€', '-')); 
});

</script>