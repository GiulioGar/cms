<?php


// LETTURA FILE EXCEL
require_once "Classes/PHPExcel.php";

$tmpfname = "res/datiCint.xlsx";
$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);

?>

<div class="row">
<div class="col-md-12 col-sm-12">

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="mytab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="inviti-tab2" data-toggle="tab" href="#inviti2" role="tab" aria-controls="inviti2" aria-selected="true">2021</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="registra-tab2" data-toggle="tab" href="#registra2" role="tab" aria-controls="registra2" aria-selected="false">2020</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="inviti2" role="tabpanel" aria-labelledby="inviti-tab2"> 
  <?php  require_once('cint_stats21.php');  ?> 

  </div>


  <div class="tab-pane" id="registra2" role="tabpanel" aria-labelledby="registra-tab2">
  <?php  require_once('cint_stats20.php');  ?>  
 
  </div>

</div>




</div>
</div>