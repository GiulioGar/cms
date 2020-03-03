<?php

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);


require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 



require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 
*/

require 'vendor/autoload.php';

@$creaCamp = $_REQUEST['creaCamp'];

use interactivemr\cintapiclient\CintApiClient;

// API settings
const API_URL = "https://api.cint.com";
const API_KEY = "c5886a77-7ee1-45ef-b919-f4464a4ac93d";
const API_SECRET = "gRFry5s9UCwqT";

// instantiate API client
$client = new CintApiClient(API_URL, API_KEY, API_SECRET);
?>

<style>

input[type=image]:disabled
{
    opacity:0.5;
}

</style>


<?php


//leggo ultimo id
$query_cintUltimo = "SELECT id FROM cint_lastid";
$cintUltimo = mysqli_query($admin,$query_cintUltimo);
$row = mysqli_fetch_array($cintUltimo);
$lastview= $row["id"];


$todaydate=date ("Y/m/d H:i:s");


// lettura api
$invitations = $client->fetchInvitations($lastview, 1000);

foreach ( $invitations as $var )
{
    $idunico=$var['id'];
    $mbId=$var['content']['invitation']['member_id'];
    $pId=$var['content']['invitation']['project_id'];
    $loi=$var['content']['invitation']['loi'];
    $ir=$var['content']['invitation']['ir'];
    $url=$var['content']['invitation']['survey_url'];
    $arrivo=$var['content']['invitation']['date_to_send'];
    $fine=$var['content']['invitation']['expires'];

    //converto le date
    $arrivoC= date('Y-m-d H:i:s', strtotime($arrivo));
    $fineC= date('Y-m-d H:i:s', strtotime($fine));

    //calcolo scadenza
    $strStart1 = $fineC;
    $strEnd1   = $todaydate; 
    $dteStart1 = new DateTime($strStart1);
    $dteEnd1   = new DateTime($strEnd1); 
    $dteDiff1  = $dteStart1->diff($dteEnd1); 
    $scade=$dteDiff1->format("%h ore %i minuti");



//aggiungo i dati dell'api nella tabella
    $query_agginv= "INSERT INTO cint_invites (id,member_id,project_id,loi,ir,survey_url,date_to_send,expires,scadenza) values ('".$idunico."','".$mbId."','".$pId."','".$loi."','".$ir."','".$url."','".$arrivoC."','".$fineC."','".$scade."')";
    $aggiungi = mysqli_query($admin,$query_agginv);

}

//aggiorno ultimo id salvato
    $query_aggId= "UPDATE cint_lastid SET id=$idunico";
    $aggId = mysqli_query($admin,$query_aggId);


//aggiorna la scadenze
$query_selScadenza = "SELECT id,expires,scadenza FROM cint_invites where inviti=0 AND scadenza <> 'Scaduto' ORDER BY id DESC";
$selScadenza = mysqli_query($admin,$query_selScadenza);

while ($row2 = mysqli_fetch_assoc($selScadenza)) 
{
   $fineInt=$row2["expires"];
   $idScad=$row2["id"];

   $dataOggi= new DateTime($todaydate); 
   $fineInvito=new DateTime($fineInt); 

    if($dataOggi>$fineInvito) 
    {
    $query_aggScadenza= "UPDATE cint_invites SET scadenza='Scaduto' where id=$idScad";
    $aggScadenza = mysqli_query($admin,$query_aggScadenza);
    }



 

}    





//query inviti disponibili
$query_cintInviti = "SELECT id,member_id,project_id,loi,ir,survey_url,date_to_send,expires,email,gender,inviti,scadenza FROM cint_invites c, t_user_info i where i.user_id=c.member_id AND inviti=0 AND scadenza <> 'Scaduto' ORDER BY id DESC";
$cintInviti = mysqli_query($admin,$query_cintInviti);
$num_rows = mysqli_num_rows($cintInviti);

$offButton="";
if ($num_rows==0) { $offButton="disabled='disabled'"; }

?>

<div class="row">
<div class="col-xl-12">

<div class="card shadow mb-12">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> PANNELLO </h6></span>
</div>


<div class="card-body">   

<div class="bs-example">
<form class="invForm" role="form">
    <div class="row">
    <div class="col-sm-2">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">IR Bassa </label>
        </div>
    </div>   

     <div class="col-sm-2">   
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck2">
            <label class="custom-control-label" for="customCheck2">Loi Alta </label>
        </div>
    </div>   

    <div class="col-sm-2">   
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck3" >
            <label class="custom-control-label" for="customCheck3">Scadenza 4H </label>
        </div>
    </div>    

<div class="col-sm-6 controlConsole" style="text-align:right">   
<button class="btn btn-primary creaCamp" type="button" name="creaCamp" value="CREA" <?php echo $offButton; ?>><i class="fab fa-creative-commons-sa"></i>&nbsp;CREA</button>
</form>
<button type='button' class='btn btn-warning download' style="display:none" value='DOWNLOAD' <?php echo $offButton; ?>><i class="fas fa-cloud-download-alt"></i>&nbsp;DOWNLOAD</button> 
<button style="display:none" onclick="window.open('http://mailer.primisoft.com/admin/compila_mail_gest.php','_blank');" class="btn btn-success inviamail" value="INVIO" type="button"><i class="far fa-envelope"></i>&nbsp;INVIA</button>
				


</div>

</div>




</div>

</div>

</div>
</div>

</div>


<div class="row ">
<div class="col-xl-12 rowDisp">

<div class="card shadow mb-12">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary">INVITI DISPONIBILI <?php echo $num_rows;?> </h6></span>
</div>


<div class="card-body"> 

<div class="table-responsive">
<?php
echo "<table id='tabInviti' style='font-size:11px' class='table table-striped table-bordered table-hover'>";
echo "<tr class='intesta'>";
echo "<th style='font-weight:bold'>Id Intervista</th>";
echo "<th style='font-weight:bold'>Uid </th>";
echo "<th style='font-weight:bold'>Genere </th>";
echo "<th style='font-weight:bold'>Email </th>";
echo "<th style='font-weight:bold'>Progetto</th>";
echo "<th style='font-weight:bold'>Loi</th>";
echo "<th style='font-weight:bold'>Ir</th>";
echo "<th style='font-weight:bold'>Link</th>";
echo "<th style='font-weight:bold'>Scadenza</th>";
echo "<th style='font-weight:bold'>Inviti</th>";
echo "</tr>";

if ($num_rows==0)
{
    echo "<tr><td colspan='10' style='text-align:center'><button id='alert4' class='btn btn-alert btn-warning alcasi' type='button'>NON CI SONO INVITI DISPONIBILI !</button></td></tr>"; 
}

else 
{

while ($row = mysqli_fetch_assoc($cintInviti)) 
    {

        $strStart = $row['expires'];
        $strEnd   = $todaydate; 
        $dteStart = new DateTime($strStart);
        $dteEnd   = new DateTime($strEnd); 
        $dteDiff  = $dteStart->diff($dteEnd); 
        

        echo "<tr>";

        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['member_id']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['project_id']."</td>";
        echo "<td>".$row['loi']."</td>";
        echo "<td>".$row['ir']."</td>";
        echo "<td>".$row['survey_url']."</td>";
        if ($dteStart>=$dteEnd )
        { echo "<td>". $dteDiff->format("%h ore %i minuti")."</td>";}
        else
        { echo "<td style='color:red'>Scaduto</td>";}
        echo "<td>".$row['inviti']."</td>";

        

        echo "</tr>";
    
    }

}

  echo "</table>"  ;
?>
</div>
</div>
</div>
</div>
</div>






<script>

let formcsv;
let table;
let butVal;

//al click crea campione
$("button").on('click', function() 
{

butVal=$(this).val();
console.log(butVal);
console.log("Cliccato");

if (butVal=="CREA") { $(".download").fadeIn();   }


  //chiamata ajax
    $.ajax({

     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "function_cint_invitations.php",

      //Quali dati devo inviare?
      data: "creaCamp="+butVal, 
      dataType: "html",
	  success: function(data) 
	  					{ 
                          
                        if (butVal=="DOWNLOAD") 
                        {
                        formcsv=$(data).filter("#mycsv");
                        $(".controlConsole").append(formcsv);
                        $("#mycsv").submit();

                        $(".inviamail").fadeIn(); 
                        }
                        
                        if (butVal=="INVIO") 
                        {
                        table=$(data).filter(".rowDisp");
                        $(".rowDisp").html(table);

                        $(".inviamail").hide(); 
                        $(".download").hide(); 

                        }    
                        

                        }    
                

    });
  
  });

</script>
