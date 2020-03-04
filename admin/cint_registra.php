<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
*/

require 'vendor/autoload.php';

use interactivemr\cintapiclient\CintApiClient;

// API settings
const API_URL = "https://api.cint.com";
const API_KEY = "c5886a77-7ee1-45ef-b919-f4464a4ac93d";
const API_SECRET = "gRFry5s9UCwqT";

// instantiate API client
$client = new CintApiClient(API_URL, API_KEY, API_SECRET);



// query conteggio utenti

//sesso uomo
$query_user = "SELECT COUNT(*) as total FROM cint_users where sesso=1";
$tm_user = mysqli_query($admin,$query_user);
$tm_use = mysqli_fetch_assoc($tm_user);

//sesso donna
$query_user = "SELECT COUNT(*) as total FROM cint_users where sesso=2";
$tf_user = mysqli_query($admin,$query_user);
$tf_use = mysqli_fetch_assoc($tf_user);


//fasce età
$query17_user = "SELECT COUNT(*) as total FROM t_user_info where Year(age)>='$und18'";
$t17_user = mysqli_query($admin,$query17_user);
$t17_use = mysqli_fetch_assoc($t17_user);

$query18_user = "SELECT COUNT(*) as total FROM t_user_info where Year(age)<='$f18' and Year(birth_date)>='$f24'";
$t18_user = mysqli_query($admin,$query18_user);
$t18_use = mysqli_fetch_assoc($t18_user);

$query25_user = "SELECT COUNT(*) as total FROM t_user_info where Year(age)<='$f25' and Year(birth_date)>='$f34'";
$t25_user = mysqli_query($admin,$query25_user);
$t25_use = mysqli_fetch_assoc($t25_user);

$query35_user = "SELECT COUNT(*) as total FROM t_user_info where Year(age)<='$f35' and Year(birth_date)>='$f44'";
$t35_user = mysqli_query($admin,$query35_user);
$t35_use = mysqli_fetch_assoc($t35_user);

$query45_user = "SELECT COUNT(*) as total FROM t_user_info where Year(age)<='$f45' and Year(birth_date)>='$f54'";
$t45_user = mysqli_query($admin,$query45_user);
$t45_use = mysqli_fetch_assoc($t45_user);

$query55_user = "SELECT COUNT(*) as total FROM t_user_info where Year(age)<='$f55' and Year(birth_date)>='$f64'";
$t55_user = mysqli_query($admin,$query55_user);
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM t_user_info where Year(age)<='$f65'";
$t65_user = mysqli_query($admin,$query65_user);
$t65_use = mysqli_fetch_assoc($t65_user);

?>

<div class="row">

<div class="col-xl-12 col-lg-5">
<div class="card shadow mb-12">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> UTENTI SINCRONIZZATI:  </h6></span>
 </div>

<div class="card-body">      
<canvas id="pie-chart"></canvas>
</div>

</div>
</div>


<!-- close row  -->
</div>


<?php

/*


$row = 1;
if (($handle = fopen("res/panel.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

        $mioarray= array (
    
            "member_id"=> $data['0'],
            "first_name"=> $data['1'],
            "last_name"=>$data['2'],
            "gender"=> $data['3'],
            "date_of_birth"=> $data['4'],
            "postal_code"=> $data['5'],
            "email_address"=> $data['0']."@interactivemr.com",
            "recruitment_source"=> "panelOld",
        
        );
        $registra = $client-> registerUser($mioarray);
        print_r($registra);
    }
    fclose($handle);
}








$query="SELECT user_id,first_name,second_name,gender,code,birth_date,email FROM t_user_info  WHERE email like '%feliciadamore%' ";
$resC = mysqli_query($admin,$query);
$infoC= mysqli_fetch_array($resC);

while($infoC<>0) 
{

   if ($infoC['gender']==1) {$genderCod="m";} 
   if ($infoC['gender']==2) {$genderCod="f";} 

 
$mioarray= array (
    
    "member_id"=> $infoC['user_id'],
    "first_name"=> $infoC['first_name'],
    "last_name"=>$infoC['second_name'],
    "email_address"=> $infoC['user_id']."@interactivemr.com",
    "gender"=> $genderCod,
    "postal_code"=> $infoC['code'],
    "date_of_birth"=> $infoC['birth_date'],
    "phone_number"=> "5555",
    "street_address"=> "nd.",
    //"payment_method_id"=> "3",
    "recruitment_source"=> "panelOld",
    //"variables"=> [1000,1001],
    "tracking_consent"=> true

);

$registra = $client-> registerUser($mioarray);
print_r($registra);

$infoC = mysqli_fetch_array($resC); 

}

/*
$query_newConta = "SELECT COUNT(user_id) as totalUser FROM t_user_info where active=1";
$csv_mvfCount = mysqli_query($admin,$query_newConta);
$data=mysqli_fetch_assoc($csv_mvfCount);

//print_r( $data['totalUser']);
echo $data['totalUser'];
*/
?>

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
</script>