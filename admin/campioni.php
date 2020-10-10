<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 





require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 



@$azione = $_REQUEST['azione'];
$sex_target=$_REQUEST['sex_target'];
$aree=$_REQUEST['aree'];
$codregione=$_REQUEST['reg'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['sid'];
$prj=$_REQUEST['prj'];
$tags=$_REQUEST['tag'];
$iscrizione=$_REQUEST['iscrizione'];
$currentYear=date("Y");

require_once('function_conta_aree.php');

?>

<div class="content-wrapper">
<div class="container">

<div class="row">
<div class="col-md-12 col-sm-12">

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="mytab" role="tablist">
<li class="nav-item">
    <a class="nav-link active" id="registra-tab" data-toggle="tab" href="#registra" role="tab" aria-controls="registra" aria-selected="false">Campione <i class="fas fa-users-cog"></i> </a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" id="inviti-tab" data-toggle="tab" href="#inviti" role="tab" aria-controls="inviti" aria-selected="true">Target <i class="fas fa-bullseye"></i></a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">

  <div class="tab-pane " id="registra" role="tabpanel" aria-labelledby="registra-tab">
  <?php  require_once('conta_aree.php');  ?> 
  </div>

  <div class="tab-pane active" id="inviti" role="tabpanel" aria-labelledby="inviti-tab"> 
  <?php    
  require_once('pannello_target.php');
  ?> 

  </div>

</div>




</div>
</div>


</div>
</div>


<?php 

require_once('inc_footer.php');

?>

