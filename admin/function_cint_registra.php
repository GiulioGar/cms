
<?php

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 


require 'vendor/autoload.php';

use interactivemr\cintapiclient\CintApiClient;

// API settings
const API_URL = "https://api.cint.com";
const API_KEY = "c5886a77-7ee1-45ef-b919-f4464a4ac93d";
const API_SECRET = "gRFry5s9UCwqT";

// instantiate API client
$client = new CintApiClient(API_URL, API_KEY, API_SECRET);




@$azione = $_REQUEST['azione'];


$query_ver = "SELECT * FROM t_user_info WHERE active=1 and user_id NOT IN (SELECT uid FROM cint_users)";
$res_ver = mysqli_query($admin,$query_ver);
$num_ver = mysqli_num_rows($res_ver);   


if($num_ver==0)
{
?>

<div class="qver alert alert-success" role="alert"><i class="fas fa-users"></i><span style="display:none" class='numusi'><?php echo $num_ver ?></b></span> &nbsp;Tutti gli utenti sono correttamente sincronizzati!  </div>
<?php } 

else 
{
?>
<div class="qver alert alert-danger"> <i class="fas fa-user-times"></i>&nbsp; <b><span class='numusi'><?php echo $num_ver ?></b></span> utenti non sono sincronizzati!  </div>
<?php }  ?>


<?php
//SINCRONIZZAZIONE CON PANEL CINT 

if ($azione=="sync")
{

$query_sync = "SELECT user_id,first_name,second_name,gender,code,birth_date,email FROM t_user_info WHERE active=1 and user_id NOT IN (SELECT uid FROM cint_users) LIMIT 1";
$res_sync= mysqli_query($admin,$query_sync);
$num_sync = mysqli_num_rows($res_sync);   

$contSync;

while ($row2 = mysqli_fetch_assoc($res_sync)) 
{
    if ($row2['gender']==1) {$genderCod="m";} 
    if ($row2['gender']==2) {$genderCod="f";} 

    $mioarray= array (
    "member_id"=> $row2['user_id'],
    "first_name"=> $row2['first_name'],
    "last_name"=>$row2['second_name'],
    "email_address"=> $row2['user_id']."@interactivemr.com",
    "gender"=> $genderCod,
    "postal_code"=> $row2['code'],
    "date_of_birth"=> $row2['birth_date'],
    "recruitment_source"=> "panelDef",
    "tracking_consent"=> true
        );

    $registra = $client-> registerUser($mioarray);  

    // inserisci nel database
    $inUid=$row2['user_id'];
    $inNam=$row2['first_name'];
    $inEma=$row2['email'];
    $inGen=$row2['gender'];
    $inAge=55;
    $inCod=$row2['code'];
    $inBir=$row2['birth_date'];

    $contSync++;

    $query_updb= "INSERT INTO cint_users VALUES ('".$inUid."','".$inNam."','".$inEma."','".$inGen."','".$inAge."','".$inCod."','".$inBir."')";
    $res_updb= mysqli_query($admin,$query_updb);

    
   
  ?>
  
 
   
   <?php

}    


}

?>
<div id="usync"><span><?php echo $contSync ?> utenti sincronizzati correttamente!</span></div>


<?php
// query conteggio utenti

//sesso uomo
$query_user = "SELECT COUNT(*) as total FROM cint_users where sesso=1";
$tm_user = mysqli_query($admin,$query_user);
$tm_use = mysqli_fetch_assoc($tm_user);

//sesso donna
$query_user = "SELECT COUNT(*) as total FROM cint_users where sesso=2";
$tf_user = mysqli_query($admin,$query_user);
$tf_use = mysqli_fetch_assoc($tf_user);

$totalone=$tm_use['total']+$tf_use['total'];

$currentYear=date("Y");

$und18=$currentYear-17;
$f18=$currentYear-18;
$f24=$currentYear-24;
$f25=$currentYear-25;
$f34=$currentYear-34;
$f35=$currentYear-35;
$f44=$currentYear-44;
$f45=$currentYear-45;
$f54=$currentYear-54;
$f55=$currentYear-55;
$f64=$currentYear-64;
$f65=$currentYear-65;

//fasce età
$query17_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)>='$und18'";
$t17_user = mysqli_query($admin,$query17_user);
$t17_use = mysqli_fetch_assoc($t17_user);

$query18_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)<='$f18' and Year(birth_date)>='$f24'";
$t18_user = mysqli_query($admin,$query18_user);
$t18_use = mysqli_fetch_assoc($t18_user);

$query25_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)<='$f25' and Year(birth_date)>='$f34'";
$t25_user = mysqli_query($admin,$query25_user);
$t25_use = mysqli_fetch_assoc($t25_user);

$query35_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)<='$f35' and Year(birth_date)>='$f44'";
$t35_user = mysqli_query($admin,$query35_user);
$t35_use = mysqli_fetch_assoc($t35_user);

$query45_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)<='$f45' and Year(birth_date)>='$f54'";
$t45_user = mysqli_query($admin,$query45_user);
$t45_use = mysqli_fetch_assoc($t45_user);

$query55_user = "SELECT COUNT(*) as total FROM t_usercint_users_info where Year(birth_date)<='$f55' and Year(birth_date)>='$f64'";
$t55_user = mysqli_query($admin,$query55_user);
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)<='$f65'";
$t65_user = mysqli_query($admin,$query65_user);
$t65_use = mysqli_fetch_assoc($t65_user);


?>

<div class="datisync2"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> UTENTI SINCRONIZZATI: <span style="font-size:16px;" class="badge badge-dark totalone"><?php echo $totalone; ?></span> </h6></span>
 </div>

<div class="card-body">  

<div class="row">
<div class="col-md-6">
<canvas id="pie-chart"></canvas>
</div>

<div class="col-md-6">
<canvas id="bar-chart-horizontal" ></canvas>
</div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>

 // chart sesso   
new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Uomini", "Donne"],
      datasets: [{
        label: "Utenti ",
        backgroundColor: ["#3e95cd", "#e8c3b9"],
        data: [<?php echo $tm_use['total']; ?>,<?php echo $tf_use['total']; ?>]
      }]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    }
});

//chart età
new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
      labels: ["Under 18 anni", "18-24 anni", "25-34 anni","35-44 anni", "45-54 anni", "55-64 anni","65 e +"],
      datasets: [
        {
          label: "Utenti ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php echo $t17_use['total']; ?>,<?php echo $t18_use['total']; ?>,<?php echo $t25_use['total']; ?>,<?php echo $t35_use['total']; ?>,<?php echo $t45_use['total']; ?>,<?php echo $t55_use['total']; ?>,<?php echo $t65_use['total']; ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Fasce di età rappresentative'
      }
    }
});

</script>

</div>




<?php 

require_once('inc_footer.php');

?>