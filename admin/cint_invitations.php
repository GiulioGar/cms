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

<div class="content-wrapper">
<div class="container">

<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">

<?php


/*
$query_agginv= "INSERT INTO t_test (uid) values ('test')";
$aggiungi = mysqli_query($admin,$query_agginv);

if ($admin->query($query_agginv) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query_agginv . "<br>" . $admin->error;
}
*/

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


$query_cintInviti = "SELECT id,member_id,project_id,loi,ir,survey_url,date_to_send,expires,email,gender,inviti FROM cint_invites c, t_user_info i where i.user_id=c.member_id ORDER BY id DESC";
$cintInviti = mysqli_query($admin,$query_cintInviti);

$query_contanew = "SELECT * FROM cint_invites c, t_user_info i where i.user_id=c.member_id AND expires >= CURDATE()";
$csv_conta = mysqli_query($admin,$query_contanew);
$num_rows = mysqli_num_rows($csv_conta);


if ($creaCamp=="CREA")	
{  

$query_new = "SELECT * FROM cint_invites c, t_user_info i where i.user_id=c.member_id AND expires >= CURDATE() AND inviti=0";
$csv_mvf = mysqli_query($admin,$query_new);

        //// ESPORTA CAMPIONE MVF IN CSV ////
    
    
        @$csv="uid;email;firstName;genderSuffix;link;scade";
        $csv .= "\n";
        
        
        while ($row = mysqli_fetch_assoc($csv_mvf)) 
        { 
                
                $uid=$row['user_id'];
                
                $mail=$row['email'];
                $nome=$row['first_name'];
                $urlsend=$row['survey_url'];
                $sesso=$row['gender'];
                $prid=$row['project_id'];
                $exp=$row['expires'];
                $scad = date("d-m-Y h:i", strtotime($exp));
                if($sesso==1){$genderTransform="o";}
                else {$genderTransform="a";}
                
                $csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$urlsend.";".$scad; 
                $csv .= "\n";

                    //aggiorno ultimo id salvato
            $query_aggInv= "UPDATE cint_invites SET inviti=1 where member_id='$uid' and project_id='$prid'";
            $aggInv = mysqli_query($admin,$query_aggInv);
        

        }

    }
?>

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="panel panel-default">
<div style="float:left; padding:10px;">

<form role="form"  action="cint_index.php" method="post">
<input class="btn btn-danger" type="submit" name="creaCamp" value="CREA">
</form>
<?php
if ($creaCamp=="CREA")	
{
?>
                <form  style="width: 150px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo$csv ?>" />
				<input type="hidden" name="filename" value="user_list" />
                <?php
                if ($num_rows==0) { echo "<input type='image' value='sumbit' src='img/down.png' disabled='disabled'/>"; } 
                else { echo "<input type='image' value='sumbit'  src='img/down.png' />"; } 
                ?>
				</form>	
<?php } ?>

   </div>

   <div style=" padding:10px;">
   <a target="_blank" href="http://mailer.primisoft.com/admin/compila_mail_gest.php"/> <img src="img/mail.png"/> </a>
   </div>


   <div class="panel-body text-center recent-users-sec">
    <div class="table-responsive">
<?php
echo "<table id='tabField' style='font-size:11px' class='table table-striped table-bordered table-hover'>";
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


while ($row = mysqli_fetch_assoc($cintInviti)) {

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

  echo "</table>"  ;
?>
</div>
</div>
</div>
</div>
</div>




</div>
</div>
</div>
</div>

<?php 

// require_once('inc_footer.php');

?>
