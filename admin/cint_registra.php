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

$query55_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)<='$f55' and Year(birth_date)>='$f64'";
$t55_user = mysqli_query($admin,$query55_user);
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM cint_users where Year(birth_date)<='$f65'";
$t65_user = mysqli_query($admin,$query65_user);
$t65_use = mysqli_fetch_assoc($t65_user);


?>

<div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
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

</div>


<!-- close row  -->
</div>

<hr>

<div class="row">

<div class="col-xl-12 col-lg-5">
<div class="card shadow mb-12">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> REGISTRAZIONE NUOVI UTENTI</span>
 </div>

 <div class="card-body">  

<div class="row">
<div class="col-md-2">
<button type="button" style="width:110px;" value="verifica" class="btn btn-outline-secondary verifica">Verifica</button>
<br/>
<br/>
<button type="button" style="width:110px; display:none" value="sync" class="btn btn-outline-success sync">Sincronizza</button>
</div>

<div class="col-md-10 jumbotron">
<div class="verificati">
<!-- inizio verificati -->

<div class="alert alert-warning mesync" style="display:none" role="alert"><i class="fas fa-sync"></i> Sincornizzazione in corso... </div>
<div class="alert alert-success mesok" style="display:none" role="alert"><i class="fas fa-user-check"></i> <span id="usync">Utenti sincronizzati correttamente </span> </div>


<!-- fine verificati -->
</div>
</div>
</div>

</div>
</div>

</div>


</div>



<?php


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




//al click dei bottoni
$("button").on('click', function() 
{

let butVal2=$(this).val();
console.log(butVal2);

if (butVal2=="sync") { $(".mesync").fadeIn(); } 


let usinc;
let numeroUser;
let numeroSync;
let nsync;
let alldatasync;

  //chiamata ajax
    $.ajax({      
  
     //imposto il tipo di invio dati (GET O POST)
      type: "GET",

      //Dove devo inviare i dati recuperati dal form?
      url: "function_cint_registra.php",

      //Quali dati devo inviare?
      data: "azione="+butVal2, 
      dataType: "html",

	  success: function(data) 
	  					{ 
                          
                        if (butVal2=="verifica") 
                        {
                        $(".qver").remove();
                        $(".mesok").fadeOut();
                        usinc=$(data).filter(".qver");
                        $(".verificati").append(usinc);
                        numeroUser=$(usinc).find("span").html();
                        if(numeroUser != 0)    
                        { 
                        console.log(numeroUser);
                         $("button.sync").fadeIn();
                         $("button.verifica").prop("disabled","true");
                        }
                
                        }

                        if (butVal2=="sync") 
                        {
                            $(".mesync").fadeOut();
                            $(".qver").remove();

                        nsync=$(data).filter("#usync");
                        numeroSync=$(nsync).find("span").html();
                        console.log(numeroSync);
                        $("#usync").html(numeroSync);

                        $("button.verifica").removeAttr('disabled'); 
                        $("button.sync").fadeOut();
                        $(".mesok").fadeIn();

                        alldatasync=$(data).filter(".datisync2");
                        $(".datisync").html(alldatasync);



                        } 
                }    
                

   
  
  });




});

</script>