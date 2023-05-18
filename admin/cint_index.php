<?php



ini_set('memory_limit', '-1');

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 


require 'vendor/autoload.php';

@$creaCamp = $_REQUEST['creaCamp'];

use interactivemr\cintapiclient\CintApiClient;

// API settings
const API_URL = "https://api.cint.com";
const API_KEY = "c5886a77-7ee1-45ef-b919-f4464a4ac93d";
const API_SECRET = "UjYL89CEZHADJ";

// instantiate API client
$client = new CintApiClient(API_URL, API_KEY, API_SECRET);
?>

<style>


input[type=image]:disabled
{
    opacity:0.5;
}

</style>

<div class="content-wrapper">
<div class="container">

<div class="row">
<div class="col-md-12 col-sm-12">

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="mytab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="inviti-tab" data-toggle="tab" href="#inviti" role="tab" aria-controls="inviti" aria-selected="true">Inviti</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="registra-tab" data-toggle="tab" href="#registra" role="tab" aria-controls="registra" aria-selected="false">Registrati</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="sta-tab" data-toggle="tab" href="#sta" role="tab" aria-controls="sta" aria-selected="false">Statistiche</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="fat-tab" data-toggle="tab" href="#fat" role="tab" aria-controls="fat" aria-selected="false">Fatture</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="inviti" role="tabpanel" aria-labelledby="inviti-tab"> 

   <?php  require_once('cint_invitations.php');  ?> 
 

  </div>


  <div class="tab-pane" id="registra" role="tabpanel" aria-labelledby="registra-tab">
  
  <?php require_once('cint_registra.php'); ?> 
  
  </div>

  <div class="tab-pane" id="sta" role="tabpanel" aria-labelledby="sta-tab">
  <?php require_once('cint_stats.php'); ?> 
 
  
  </div>

  <div class="tab-pane" id="fat" role="tabpanel" aria-labelledby="fat-tab">
  
  <?php require_once('cint_fatture.php'); ?> 
  
  </div>

</div>




</div>
</div>


</div>
</div>


<?php 

require_once('inc_footer.php');

?>
