
<?php


// LETTURA FILE EXCEL
require_once "Classes/PHPExcel.php";

$tmpfname = "res/datiCint.xlsx";
$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);


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
        if ($leggoStatus=="EarlyScreenout" || $leggoStatus=="SurveyClosed" || $leggoStatus=="TimedOut" ) {$filtrateCint++;   }
        if ($leggoStatus=="QuotaFull") {$quotaFullCint++;   }
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
$query_inviti = "SELECT COUNT(*) as total FROM cint_invites  where inviti=1";
$inviti_user = mysqli_query($admin,$query_inviti);
$inviti_use = mysqli_fetch_assoc($inviti_user);

$tassoPart=($contattiCint/$inviti_use['total'])*100;
   
?>
<div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> RISPOSTA UTENTI </h6>
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

    <tr>
      <th scope="row">Complete Nostro DB</th>
      <td><?php echo $comp_use['total']; ?></td>
      <td><?php echo (int)$irCompleteDb;?>%</td>
    </tr>

      <th scope="row">Screenout</th>
      <td><?php echo $filtrateCint ?></td>
      <td><?php echo (int)$irScreenoutCint ?>%</td>
    </tr>
    <tr>
      <th scope="row">QuotaFull</th>
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
	<h6 class="m-0 font-weight-bold text-primary"> INTERVISTE FATTURATE </h6>
 </div>

<div class="card-body">  

<div class="row">

<div class="col-md-6">

<table style="text-align:center" class="table table-striped">
  <thead class="thead-light">
    <tr>
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

  } 


  ?>

</tbody>
</table>

</div>



<div class="col-md-6">

<table style="text-align:center" class="table striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">TOTALE 2020</th>
    </tr>
  </thead>
  <tbody>

<tr>
<th scope="col">N° Interviste</th>
<td></td>
</tr>

<tr>
<th scope="col">Pagate </th>
<td></td>
</tr>

<tr>
<th scope="col">CPI </th>
<td></td>
</tr>

</tbody>
</table>


<!-- PREVISIONI -->

<table style="text-align:center" class="table striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">STIMA ENTRATE</th>
    </tr>
  </thead>
  <tbody>

<tr>
<th scope="col">Intervista da pagare</th>
<td></td>
</tr>

<tr>
<th scope="col">Stima entrate </th>
<td></td>
</tr>

</tbody>
</table>

</div>


</div>
</div>
</div>
</div>
</div>