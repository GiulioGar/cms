<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
@$creaCamp = $_REQUEST['creaCamp'];
$sex_target=$_REQUEST['sex_target'];
$area=$_REQUEST['aree'];
$codregione=$_REQUEST['reg'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['sid'];
$currentYear=date("Y");

$startDate="2020-01-01";

require_once('inc_taghead.php');
require_once('inc_tagbody.php');

$query_surv = "SELECT *  FROM t_panel_control where stato=0 AND panel<>0";
$csv_sur = mysqli_query($admin,$query_surv) or die(mysql_error());	

//attività nuovi iscritti
mysqli_select_db($database_admin, $admin);
$query_user = "SELECT count(distinct story.user_id) as total FROM millebytesdb.t_user_history  as story, t_user_info as info where info.active='1' and reg_date >= $currentYear AND story.user_id=info.user_id 
AND story.event_type <>'subscribe'   order by story.event_date";
$tot_att6 = mysqli_query($admin,$query_user) or die(mysql_error());
$tot_act6 = mysqli_fetch_assoc($tot_att6);

$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and reg_date >= '$currentYear' and email not like'%.top'";
$t_user = mysqli_query($admin,$query_user) or die(mysql_error());
$t_use = mysqli_fetch_assoc($t_user);

$query_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=1 and reg_date >= '$currentYear' and email not like'%.top'";
$tm_user = mysqli_query($admin,$query_user) or die(mysql_error());
$tm_use = mysqli_fetch_assoc($tm_user);

$queryf_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and gender=2 and reg_date >= '$currentYear' and email not like'%.top'";
$tf_user = mysqli_query($admin,$queryf_user) or die(mysql_error());
$tf_use = mysqli_fetch_assoc($tf_user);

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



$query17_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)>='$und18' and reg_date >= '$startDate' and email not like'%.top'";
$t17_user = mysqli_query($admin,$query17_user) or die(mysql_error());
$t17_use = mysqli_fetch_assoc($t17_user);

$query18_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f18' and Year(birth_date)>='$f24' and reg_date >= '$startDate' and email not like'%.top'";
$t18_user = mysqli_query($admin,$query18_user) or die(mysql_error());
$t18_use = mysqli_fetch_assoc($t18_user);

$query25_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f25' and Year(birth_date)>='$f34' and reg_date >= '$startDate' and email not like'%.top'";
$t25_user = mysqli_query($admin,$query25_user) or die(mysql_error());
$t25_use = mysqli_fetch_assoc($t25_user);

$query35_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f35' and Year(birth_date)>='$f44' and reg_date >= '$startDate' and email not like'%.top'";
$t35_user = mysqli_query($admin,$query35_user) or die(mysql_error());
$t35_use = mysqli_fetch_assoc($t35_user);

$query45_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f45' and Year(birth_date)>='$f54' and reg_date >= '$startDate' and email not like'%.top'";
$t45_user = mysqli_query($admin,$query45_user) or die(mysql_error());
$t45_use = mysqli_fetch_assoc($t45_user);

$query55_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f55' and Year(birth_date)>='$f64' and reg_date >= '$startDate' and email not like'%.top'";
$t55_user = mysqli_query($admin,$query55_user) or die(mysql_error());
$t55_use = mysqli_fetch_assoc($t55_user);

$query65_user = "SELECT COUNT(*) as total FROM t_user_info where active='1' and Year(birth_date)<='$f65' and reg_date >= '$startDate' and email not like'%.top'";
$t65_user = mysqli_query($admin,$query65_user) or die(mysql_error());
$t65_use = mysqli_fetch_assoc($t65_user);

//conta aree
$tNo=0;
$tNe=0;
$tCe=0;
$tSu=0;

$query_new_at = "SELECT * FROM t_user_info where active=1 and reg_date >= '2020-01-01' and email not like'%.top'";
$csv_mvf_at = mysqli_query($admin,$query_new_at) or die(mysql_error());

while ($row = mysqli_fetch_assoc($csv_mvf_at)) 
   { 
	$proView=$row['province_id'];
	@include('cod_reg.php');
	if ($arView==1) { $tNo++;}
	if ($arView==2) { $tNe++;}
	if ($arView==3) { $tCe++;}
	if ($arView==4) { $tSu++;}
	if ($reView==1) { $ab++;}
	if ($reView==2) { $ba++;}
	if ($reView==3) { $cl++;}
	if ($reView==4) { $cm++;}
	if ($reView==5) { $em++;}
	if ($reView==6) { $fr++;}
	if ($reView==7) { $la++;}
	if ($reView==8) { $li++;}
	if ($reView==9) { $lo++;}
	if ($reView==10) { $ma++;}
	if ($reView==11) { $mo++;}
	if ($reView==12) { $pi++;}
	if ($reView==13) { $pu++;}
	if ($reView==14) { $sa++;}
	if ($reView==15) { $si++;}
	if ($reView==16) { $to++;}
	if ($reView==17) { $tr++;}
	if ($reView==18) { $um++;}
	if ($reView==19) { $ao++;}
	if ($reView==20) { $ve++;}
   }




?>
  <div class="content-wrapper">
       <div class="container">

<div class="row">	  
	
<div class="col-xl-12">
<div class="card shadow mb-6">
   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> ISCRITTI <?php echo $currentYear; ?> </h6></span>
 </div>

<div class="card-body">      
<div style="font-size:18px;">Nuovi Iscritti:&nbsp;</b></td><td><b><?php echo $t_use['total']; ?></b>&nbsp;&nbsp;<span style="color:gray"><i class="fas fa-user-check"></i></span></div>
</div>

</div>
</div>

</div>
	   
	   <div class="row">

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> GENERE </h6></span>
 </div>

<div class="card-body">      
<canvas id="pie-chart"></canvas>
</div>

</div>
</div>

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> FASCE D'ETA' </h6></span>
 </div>

<div class="card-body">      
<canvas id="bar-chart-horizontal" ></canvas>

</div>

</div>
</div>

<!-- close row  -->
</div>




<div class="row">

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> REGIONI </h6></span>
 </div>

<div class="card-body">      
<canvas id="bar-chart-horizontal2" height="400px"></canvas>
</div>

</div>
</div>

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> AREE </h6></span>
 </div>

<div class="card-body">      
<canvas id="pie-chart2" ></canvas>

</div>

</div>
</div>

<!-- close row  -->
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



//chart regione

new Chart(document.getElementById("bar-chart-horizontal2"), {
    type: 'horizontalBar',
    data: {
      labels: ["Abruzzo",
"Basilicata",
"Calabria",
"Campania",
"Emilia-Romagna",
"Friuli-Venezia Giulia",
"Lazio",
"Liguria",
"Lombardia",
"Marche",
"Molise",
"Piemonte",
"Puglia",
"Sardegna",
"Sicilia",
"Toscana",
"Trentino-Alto Adige",
"Umbria",
"Val d'Aosta",
"Veneto"],
      datasets: [
        {
          label: "Utenti ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#2393d3", "#15c146","#c782cc","#e8c3b9","#fccccc","#d3a9e5", "#8e5ea2","#3cba9f","#e8c3b9","#b8b1ed","#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [<?php echo $ab; ?>,<?php echo $ba; ?>,<?php echo $cl; ?>,<?php echo $cm; ?>,<?php echo $em; ?>,<?php echo $fr; ?>,<?php echo $la; ?>,<?php echo $li; ?>,<?php echo $lo; ?>,<?php echo $ma; ?>,<?php echo $mo; ?>,<?php echo $pi; ?>,<?php echo $pu; ?>,<?php echo $sa; ?>,<?php echo $si; ?>,<?php echo $to; ?>,<?php echo $tr; ?>,<?php echo $um; ?>,<?php echo $ao; ?>,<?php echo $ve; ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Regioni Italiane'
      }
    }
});


 // chart aree   
 new Chart(document.getElementById("pie-chart2"), {
    type: 'pie',
    data: {
      labels: ["Nord Ovest", "Nord Est","Centro","Sud"],
      datasets: [{
        label: "Utenti ",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9"],
        data: [<?php echo $tNo; ?>,<?php echo $tNe; ?>,<?php echo $tCe; ?>,<?php echo $tSu; ?>]
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


<?php

require_once('inc_footer.php'); 

?>
