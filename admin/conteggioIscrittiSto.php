<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

$mesecorrente=date('m');
$annocorrente=date('Y');

@$modCosti = $_REQUEST['modCosti'];
$eti2=$_REQUEST['eti2'];
$eti3=$_REQUEST['eti3'];
$eti4=$_REQUEST['eti4'];
$eti5=$_REQUEST['eti5'];
$eti6=$_REQUEST['eti6'];
$eti7=$_REQUEST['eti7'];
$etiR=$_REQUEST['etiR'];

$jsonString = file_get_contents('referalSto.json');
$data = json_decode($jsonString, true);

// MODIFICA JSON

$sumSpesa=$data['referalSto'][0]["spesa"]+$data['referalSto'][1]["spesa"]+$data['referalSto'][2]["spesa"]+$data['referalSto'][3]["spesa"]+$data['referalSto'][4]["spesa"]+$data['referalSto'][5]["spesa"];
$difSpesa=15000-$sumSpesa;

if ($modCosti=="Modifica")
{
  if (!empty($eti2)) { $data['referalSto'][0]["spesa"]=$eti2; }
  if (!empty($eti3)) { $data['referalSto'][1]["spesa"]=$eti3; }
  if (!empty($eti4)) { $data['referalSto'][2]["spesa"]=$eti4; }
  if (!empty($eti5)) { $data['referalSto'][3]["spesa"]=$eti5; }
  if (!empty($eti6)) { $data['referalSto'][4]["spesa"]=$eti6; }
  if (!empty($etiA)) { $data['referalSto'][6]["spesa"]=$etiA; }
  if (!empty($etiR)) { $data['referalSto'][5]["spesa"]=$etiR; }


?>

<script>
$.ajaxSetup({
  cache:false
});

</script>
<?php
}

$newJsonString = json_encode($data);
file_put_contents('referalSto.json', $newJsonString);

$num_ref1=0;
$num_ref2=0;
$num_ref3=0;
$num_ref4=0;
$num_ref5=0;
$num_ref6=0;
$num_ref7=0;

$perc_ref1=0;
$perc_ref2=0;
$perc_ref3=0;
$perc_ref4=0;
$perc_ref5=0;
$perc_ref6=0;
$perc_ref7=0;
$perc_refA=0;
$perc_refR=0;

// QUERY DI LETTURA DATI

//FACEBOOK - ref 2
$query_nuoviutenti2 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref2' || provenienza='website' || provenienza ='app')";
$esegui_query_nuoviutenti2 = mysqli_query($admin,$query_nuoviutenti2);
$num_ref2 = mysqli_num_rows($esegui_query_nuoviutenti2);

//FACEBOOK - ref 2 attivi
$query_nuoviutenti2a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref2' || provenienza='website' || provenienza ='app')";
$esegui_query_nuoviutenti2a = mysqli_query($admin,$query_nuoviutenti2a);
$num_ref2a = mysqli_num_rows($esegui_query_nuoviutenti2a);

//echo $query_nuoviutenti2a;

if($num_ref2a>0) {$perc_ref2=ceil($num_ref2a/$num_ref2*100);}

//CONTA AZIONI - FACEBOOK
$query_azioni2a = "SELECT DISTINCT(actions) as cref2,  COUNT(DISTINCT user_id) AS nref2 FROM t_user_info where active=1 and (provenienza ='ref2' or provenienza ='website') GROUP by actions order by actions ASC";
$esegui_query_azioni2a = mysqli_query($admin,$query_azioni2a);


//MVF - ref 3
$query_nuoviutenti3 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref3')  ";
$esegui_query_nuoviutenti3 = mysqli_query($admin,$query_nuoviutenti3);
$num_ref3 = mysqli_num_rows($esegui_query_nuoviutenti3);

//MVF - ref 3
$query_nuoviutenti3a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref3') ";
$esegui_query_nuoviutenti3a = mysqli_query($admin,$query_nuoviutenti3a);
$num_ref3a = mysqli_num_rows($esegui_query_nuoviutenti3a);


if($num_ref3a>0) {$perc_ref3=ceil($num_ref3a/$num_ref3*100);}

//CONTA AZIONI - REF3
$query_azioni3a = "SELECT DISTINCT(actions) as cref3,  COUNT(DISTINCT user_id) AS nref3 FROM t_user_info where active=1 and provenienza ='ref3' GROUP by actions order by actions ASC";
$esegui_query_azioni3a = mysqli_query($admin,$query_azioni3a);

//EMY - ref 4
$query_nuoviutenti4 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref4')  ";
$esegui_query_nuoviutenti4 = mysqli_query($admin,$query_nuoviutenti4);
$num_ref4 = mysqli_num_rows($esegui_query_nuoviutenti4);

//EMY - ref 4
$query_nuoviutenti4a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref4') ";
$esegui_query_nuoviutenti4a = mysqli_query($admin,$query_nuoviutenti4a);
$num_ref4a = mysqli_num_rows($esegui_query_nuoviutenti4a);

if($num_ref4a>0) {$perc_ref4=ceil($num_ref4a/$num_ref4*100);}

//CONTA AZIONI - REF4
$query_azioni4a = "SELECT DISTINCT(actions) as cref4,  COUNT(DISTINCT user_id) AS nref4 FROM t_user_info where active=1 and provenienza ='ref4' GROUP by actions order by actions ASC";
$esegui_query_azioni4a = mysqli_query($admin,$query_azioni4a);

//adviceme - ref 5
$query_nuoviutenti5= "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref5')   ";
$esegui_query_nuoviutenti5 = mysqli_query($admin,$query_nuoviutenti5);
$num_ref5 = mysqli_num_rows($esegui_query_nuoviutenti5);

//adviceme - ref 5
$query_nuoviutenti5a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref5') ";
$esegui_query_nuoviutenti5a = mysqli_query($admin,$query_nuoviutenti5a);
$num_ref5a = mysqli_num_rows($esegui_query_nuoviutenti5a);

if($num_ref5a>0) {$perc_ref5=ceil($num_ref5a/$num_ref5*100);}

//CONTA AZIONI - REF5
$query_azioni6a = "SELECT DISTINCT(actions) as cref5,  COUNT(DISTINCT user_id) AS nref5 FROM t_user_info where active=1 and provenienza ='ref5'  GROUP by actions order by actions ASC";
$esegui_query_azioni5a = mysqli_query($admin,$query_azioni6a);


//BIG DATA - ref 6
$query_nuoviutenti6 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref6')  ";
$esegui_query_nuoviutenti6 = mysqli_query($admin,$query_nuoviutenti6);
$num_ref6 = mysqli_num_rows($esegui_query_nuoviutenti6);

//BIG DATA - ref 6
$query_nuoviutenti6a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref6') ";
$esegui_query_nuoviutenti6a = mysqli_query($admin,$query_nuoviutenti6a);
$num_ref6a = mysqli_num_rows($esegui_query_nuoviutenti6a);

if($num_ref6a>0) {$perc_ref6=ceil($num_ref6a/$num_ref6*100);}

//CONTA AZIONI - REF6
$query_azioni6a = "SELECT DISTINCT(actions) as cref6,  COUNT(DISTINCT user_id) AS nref6 FROM t_user_info where active=1 and provenienza ='ref6'  GROUP by actions order by actions ASC";
$esegui_query_azioni6a = mysqli_query($admin,$query_azioni6a);


//AMICI
$query_nuoviutentiA = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and provenienza NOT LIKE 'ref%' AND provenienza NOT LIKE 'website%'   ";
$esegui_query_nuoviutentiA = mysqli_query($admin,$query_nuoviutentiA);
$num_refA = mysqli_num_rows($esegui_query_nuoviutentiA);

//AMICI
$query_nuoviutentiAa = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and provenienza NOT LIKE 'ref%' AND provenienza NOT LIKE 'website%' ";
$esegui_query_nuoviutentiAa = mysqli_query($admin,$query_nuoviutentiAa);
$num_refAa = mysqli_num_rows($esegui_query_nuoviutentiAa);

if($num_refAa>0) {$perc_refA=ceil($num_refAa/$num_refA*100);}

//CONTA AZIONI - AMICI
$query_azioniAa = "SELECT DISTINCT(actions) as crefA,  COUNT(DISTINCT user_id) AS nrefA FROM t_user_info where active=1 and provenienza NOT LIKE 'ref%' AND provenienza NOT LIKE 'website%' GROUP by actions order by actions ASC";
$esegui_query_azioniAa = mysqli_query($admin,$query_azioniAa);


//RECUPERI - ref REACT
$query_nuoviutentiR = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='react')";
$esegui_query_nuoviutentiR = mysqli_query($admin,$query_nuoviutentiR);
$num_refR= mysqli_num_rows($esegui_query_nuoviutentiR);

//RECUPERI - ref REACT
$query_nuoviutentiRa = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='react')";
$esegui_query_nuoviutentiRa = mysqli_query($admin,$query_nuoviutentiRa);
$num_refRa = mysqli_num_rows($esegui_query_nuoviutentiRa);

if($num_refRa>0) { $perc_refR=ceil($num_refRa/$num_refR*100);}

//RECUPERI AZIONI - REF REACT
$query_azioniRa = "SELECT DISTINCT(actions) as crefR,  COUNT(DISTINCT user_id) AS nrefR FROM t_user_info where active=1 and provenienza ='react GROUP by actions order by actions ASC";
$esegui_query_azioniRa = mysqli_query($admin,$query_azioniRa);


 // somma iscritti
 $sommaIscritti=$num_ref2+$num_ref3+$num_ref4+$num_ref5+$num_ref6+$num_refR+$num_refA;
  // somma attivi
$sommaIscrittiA=$num_ref2a+$num_ref3a+$num_ref4a+$num_ref5a+$num_ref6a+$num_refRa+$num_refAa;

//% attivi
$mediaAct=($sommaIscrittiA/$sommaIscritti)*100;
$mediaAct=round($mediaAct, 2);

 //cpi Medio
 $mediaCpi=$sumSpesa/$sommaIscritti;
 $mediaCpi=round($mediaCpi, 2);

 $mediaCpiA=$sumSpesa/$sommaIscrittiA;
 $mediaCpiA=round($mediaCpiA, 2);

//// ESPORTA CAMPIONE FACEBOOK IN CSV ////

    @$csv="uid;email;firstName;type;points";
    $csv .= "\n";

    while ($row = mysqli_fetch_assoc($esegui_query_nuoviutenti2)) 
    {
      $uid=$row['user_id'];	
      $mail=$row['email'];
      $nome=$row['first_name'];
      $punti=500;
      $type="Bonus di Benvenuto";
      $csv .=$uid.";".$mail.";".$nome.";".$type.";".$punti; 
			$csv .= "\n";

    }

        //// ESPORTA CAMPIONE MVF IN CSV ////

        @$csv3="uid;email;firstName";
        $csv3 .= "\n";
    
        while ($row = mysqli_fetch_assoc($esegui_query_nuoviutenti3)) 
        {
          $uid=$row['user_id'];	
          $mail=$row['email'];
          $nome=$row['first_name'];
          $csv3 .=$uid.";".$mail.";".$nome; 
          $csv3 .= "\n";
    
        }

        //// ESPORTA CAMPIONE emy IN CSV ////

        @$csv4="uid;email;firstName";
        $csv4 .= "\n";
    
        while ($row = mysqli_fetch_assoc($esegui_query_nuoviutenti4)) 
        {
          $uid=$row['user_id'];	
          $mail=$row['email'];
          $nome=$row['first_name'];
          $csv4 .=$uid.";".$mail.";".$nome; 
          $csv4 .= "\n";
    
        }

?>


<div class="content-wrapper">
<div class="container">

<div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<div col-xs-6>
        <h2>Reclutamento Storico</h2>
</div>
 
 


  <div class="col col-xs-6 text-right">
      <?php 
      require_once('modifica_ref.php');
      ?>
	</div>
 </div>

<div class="card-body">  

<div class="row">

<div class="col-md-12">

<table  class="table">
  <thead class="table-primary">
    <tr>
      <th scope="col">Budget</th>
      <th scope="col">Speso</th>
      <th scope="col">Resto</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">Isritti</th>
      <th scope="col">CPI Medio</th>
      <th scope="col">Attivi</th>
      <th scope="col">%</th>
      <th scope="col">CPA Medio</th>
    </tr>
  </thead>
  <tbody class="">
<tr>
<td><b>15.000€</b></td>
<td><b><?php echo $sumSpesa ?>€ </b></td>
<td><b><?php echo $difSpesa ?>€</b></td>
<td>&nbsp;</td>
<td><b><?php echo $sommaIscritti ?></b></td>
<td><b><?php echo $mediaCpi ?>€</b></td>
<td><b><?php echo $sommaIscrittiA ?></b></td>
<td><b><?php echo $mediaAct ?>%</b></td>
<td><b><?php echo $mediaCpiA ?>€</b></td>
</tr>
   
  </tbody>
</table>

<!-- TABELLA DATI  DA  ENGAGE-->

<table  class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Referente</th>
      <th scope="col">Registrati</th>
      <th scope="col">Attivi</th>
      <th scope="col">%</th>
      <th scope="col">CPI TOT</th>
      <th scope="col">CPI REALE</th>
      <th scope="col">Costo</th>
      <th scope="col">Download</th>
    </tr>
  </thead>
  <tbody class="reference">

   
  </tbody>
</table>

</div>




</div>

</div>




</div>
</div>

</div>

 <!-- DETTAGLI CAMPANGE -->
 <div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<div col-xs-6><h6 class="m-0 font-weight-bold text-primary"> DETTAGLI - CAMPAGNE STORICO &nbsp; <span style="float:right"> <i class="fas fa-info-circle"></i></span> </h6></div>
  <div class="col col-xs-6 text-right">
	<?php require_once('modifica_ref.php'); ?>
	</div>
 </div>

<div class="card-body">  

<div class="row details">
  

 <!-- REF  -->

 <!-- REF  -->

 



 <!-- DETTAGLI CAMPANGE -->
</div>

</div>
</div>
</div>


</div>

</div>

<script>
$.ajaxSetup({
  cache:false
});

 function addrows()
 {
   let info1;
   let info2;
   let info3;
   let info5;
   let info6;
   let info7;
   let price;
   let csv;

  $.getJSON('referalSto.json', function(data) 
    {
      $.ajaxSetup({
        cache:false
          });

      cache: false
      $.each(data.referalSto, function(key, val) 
      {

      if (val.id==2) 
      {
        info1=<?php echo $num_ref2 ?>;
        info2=<?php echo $num_ref2a ?>;
        info3=<?php echo $perc_ref2 ?>;
        info5=val.spesa/<?php echo $num_ref2 ?>;
        info5 = info5.toFixed(2);
        info6=val.spesa/<?php echo $num_ref2a ?>;
        info6 = info6.toFixed(2);
        info7=val.spesa;
        csv="$csv";
      }

      if (val.id==3) 
      {
        info1=<?php echo $num_ref3 ?>;
        info2=<?php echo $num_ref3a ?>;
        info3=<?php echo $perc_ref3 ?>;
        info5=val.spesa/<?php echo $num_ref3 ?>;
        info5 = info5.toFixed(2);
        info6=val.spesa/<?php echo $num_ref3a ?>;
        info6 = info6.toFixed(2);
        info7=val.spesa;
        csv="$csv3";
      }

      if (val.id==4) 
      {
        info1=<?php echo $num_ref4 ?>;
        info2=<?php echo $num_ref4a ?>;
        info3=<?php echo $perc_ref4 ?>;
        info5=val.spesa/<?php echo $num_ref4 ?>;
        info5 = info5.toFixed(2);
        info6=val.spesa/<?php echo $num_ref4a ?>;
        info6 = info6.toFixed(2);
        info7=val.spesa;
        csv="$csv4";
      }

      if (val.id==5) 
      {
        console.log("entrato5");
        info1=<?php echo $num_ref5 ?>;
        info2=<?php echo $num_ref5a ?>;
        info3=<?php echo $perc_ref5 ?>;
        info5=val.spesa/<?php echo $num_ref5 ?>;
        info5 = info5.toFixed(2);
        info6=val.spesa/<?php echo $num_ref5a ?>;
        info6 = info6.toFixed(2);
        info7=val.spesa;
        csv="$csv5";
      }

      if (val.id==6) 
      {
        info1=<?php echo $num_ref6 ?>;
        info2=<?php echo $num_ref6a ?>;
        info3=<?php echo $perc_ref6 ?>;
        info5=val.spesa/<?php echo $num_ref6 ?>;
        info5 = info5.toFixed(2);
        info6=val.spesa/<?php echo $num_ref6a ?>;
        info6 = info6.toFixed(2);
        info7=val.spesa;
        csv="N.D.";
      }

      if (val.id=="R") 
      {
        info1=<?php echo $num_refR ?>;
        info2=<?php echo $num_refRa ?>;
        info3=<?php echo $perc_refR ?>;
        info5=val.spesa/<?php echo $num_refR ?>;
        info5 = info5.toFixed(2);
        info6=val.spesa/<?php echo $num_refRa ?>;
        info6 = info6.toFixed(2);
        info7=val.spesa;
        csv="N.D.";
      }

      if (val.id=="A") 
      {
        info1=<?php echo $num_refA ?>;
        info2=<?php echo $num_refAa ?>;
        info3=<?php echo $perc_refA ?>;
        info5=val.spesa/<?php echo $num_refA ?>;
        info5 = info5.toFixed(2);
        info6=val.spesa/<?php echo $num_refAa ?>;
        info6 = info6.toFixed(2);
        info7=val.spesa;
        csv="N.D.";
      }
        
        $("tbody.reference").append(
          `
        <tr>
        <th scope="row">`+val.id+` - `+val.title+`</th>
      <td>`+info1+`</td>
      <td>`+info2+`</td>
      <td>`+info3+`</td>
      <td>`+info5+`€</td>
      <td>`+info6+`€</td>
      <td>`+info7+`€</td>
      <td>
      <form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo `+csv+` ?>" />
				<input type="hidden" name="filename" value="bonusFacebook" />
        <input type="hidden" name="filetype" value="campione" />
        <input style="width:40px; height:30px"  class="form-control" type="image" value="submit" src="img/csv.png" />
        </form>	    
    </td>
    </tr>
    `
         );

      
      });


    });
 }


 function addDetails()
 {
   let info4;


  $.getJSON('referalSto.json', function(data) 
    {
      $.ajaxSetup({
     cache:false
        });

      cache: false
      $.each(data.referalSto, function(key, val) 
      {

      if (val.id==2) 
      {
     info4=`
        <?php
        $NactA=0;
        $NactB=0;
        $NactC=0;
        $NactD=0;
        $NactE=0;

       while ($row = mysqli_fetch_assoc($esegui_query_azioni2a)) 
      {
      if($row["cref2"]==0) { $NactA=$NactA+$row["nref2"];  $perc_NactA=ceil($NactA/$num_ref2*100);}
      if($row["cref2"]>=1 && $row["cref2"]<=4) { $NactB=$NactB+$row["nref2"];; $perc_NactB=ceil($NactB/$num_ref2*100);}
      if($row["cref2"]>=5 && $row["cref2"]<=8) { $NactC=$NactC+$row["nref2"]; $perc_NactC=ceil($NactC/$num_ref2*100);}
      if($row["cref2"]>=9 && $row["cref2"]<=15) { $NactD=$NactD+$row["nref2"]; $perc_NactD=ceil($NactD/$num_ref2*100);}
      if($row["cref2"]>15) {  $NactE=$NactE+$row["nref2"]; $perc_NactE=ceil($NactE/$num_ref2*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-4) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(5-8) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(9-15) </td>
     <td><?php echo $NactD; ?></td>
     <td><b><?php echo $perc_NactD; ?>%</b></td>
     </tr>

     <tr style="background-color:#9DCE6B">
     <td>Ottima(+9) </td>
     <td><?php echo $NactE; ?></td>
     <td><b><?php echo $perc_NactE; ?>%</b></td>
     </tr>

    `;

    
      }

      if (val.id==3) 
      {
      info4=`
      <?php
        $NactA=0;
        $NactB=0;
        $NactC=0;
        $NactD=0;
        $NactE=0;
        $perc_NactA=0;
        $perc_NactB=0;
        $perc_NactC=0;
        $perc_NactD=0;
        $perc_NactE=0;

       while ($row = mysqli_fetch_assoc($esegui_query_azioni3a)) 
      {
      if($row["cref3"]==0) { $NactA=$NactA+$row["nref3"];  $perc_NactA=ceil($NactA/$num_ref3*100);}
      if($row["cref3"]>=1 && $row["cref3"]<=4) { $NactB=$NactB+$row["nref3"];  $perc_NactB=ceil($NactB/$num_ref3*100);}
      if($row["cref3"]>=5 && $row["cref3"]<=8) { $NactC=$NactC+$row["nref3"]; $perc_NactC=ceil($NactC/$num_ref3*100);}
      if($row["cref3"]>=9 && $row["cref3"]<=15) { $NactD=$NactD+$row["nref3"]; $perc_NactD=ceil($NactD/$num_ref3*100);}
      if($row["cref3"]>15) {  $NactE=$NactE+$row["nref3"];  $perc_NactE=ceil($NactE/$num_ref3*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-4) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(5-8) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(9-15) </td>
     <td><?php echo $NactD; ?></td>
     <td><b><?php echo $perc_NactD; ?>%</b></td>
     </tr>

     <tr style="background-color:#9DCE6B">
     <td>Ottima(+9) </td>
     <td><?php echo $NactE; ?></td>
     <td><b><?php echo $perc_NactE; ?>%</b></td>
     </tr>
    `;


      }

      if (val.id==4) 
      {
        info4=`
        <?php
        $NactA=0;
        $NactB=0;
        $NactC=0;
        $NactD=0;
        $NactE=0;
        $perc_NactA=0;
        $perc_NactB=0;
        $perc_NactC=0;
        $perc_NactD=0;
        $perc_NactE=0;

       while ($row = mysqli_fetch_assoc($esegui_query_azioni4a)) 
      {
      if($row["cref4"]==0) { $NactA=$NactA+$row["nref4"];  $perc_NactA=ceil($NactA/$num_ref4*100);}
      if($row["cref4"]>=1 && $row["cref4"]<=4) { $NactB=$NactB+$row["nref4"];  $perc_NactB=ceil($NactB/$num_ref4*100);}
      if($row["cref4"]>=5 && $row["cref4"]<=8) { $NactC=$NactC+$row["nref4"]; $perc_NactC=ceil($NactC/$num_ref4*100);}
      if($row["cref4"]>=9 && $row["cref4"]<=15) { $NactD=$NactD+$row["nref4"]; $perc_NactD=ceil($NactD/$num_ref4*100);}
      if($row["cref4"]>15) {  $NactE=$NactE+$row["nref4"];  $perc_NactE=ceil($NactE/$num_ref4*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-4) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(5-8) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(9-15) </td>
     <td><?php echo $NactD; ?></td>
     <td><b><?php echo $perc_NactD; ?>%</b></td>
     </tr>

     <tr style="background-color:#9DCE6B">
     <td>Ottima(+9) </td>
     <td><?php echo $NactE; ?></td>
     <td><b><?php echo $perc_NactE; ?>%</b></td>
     </tr>
    `;
   

      }

      if (val.id==5) 
      {
        info4=`
        <?php
        $NactA=0;
        $NactB=0;
        $NactC=0;
        $NactD=0;
        $NactE=0;
        $perc_NactA=0;
        $perc_NactB=0;
        $perc_NactC=0;
        $perc_NactD=0;
        $perc_NactE=0;

       while ($row = mysqli_fetch_assoc($esegui_query_azioni5a)) 
      {
      if($row["cref5"]==0) { $NactA=$NactA+$row["nref5"];  $perc_NactA=ceil($NactA/$num_ref5*100);}
      if($row["cref5"]>=1 && $row["cref5"]<=4) { $NactB=$NactB+$row["nref5"];  $perc_NactB=ceil($NactB/$num_ref5*100);}
      if($row["cref5"]>=5 && $row["cref5"]<=8) { $NactC=$NactC+$row["nref5"]; $perc_NactC=ceil($NactC/$num_ref5*100);}
      if($row["cref5"]>=9 && $row["cref5"]<=15) { $NactD=$NactD+$row["nref5"]; $perc_NactD=ceil($NactD/$num_ref5*100);}
      if($row["cref5"]>15) {  $NactE=$NactE+$row["nref5"];  $perc_NactE=ceil($NactE/$num_ref5*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-4) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(5-8) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(9-15) </td>
     <td><?php echo $NactD; ?></td>
     <td><b><?php echo $perc_NactD; ?>%</b></td>
     </tr>

     <tr style="background-color:#9DCE6B">
     <td>Ottima(+9) </td>
     <td><?php echo $NactE; ?></td>
     <td><b><?php echo $perc_NactE; ?>%</b></td>
     </tr>
    `;
   

      }


      if (val.id==6) 
      {
        info4=`
        <?php
        $NactA=0;
        $NactB=0;
        $NactC=0;
        $NactD=0;
        $NactE=0;
        $perc_NactA=0;
        $perc_NactB=0;
        $perc_NactC=0;
        $perc_NactD=0;
        $perc_NactE=0;

       while ($row = mysqli_fetch_assoc($esegui_query_azioni6a)) 
      {
      if($row["cref6"]==0) { $NactA=$NactA+$row["nref6"];  $perc_NactA=ceil($NactA/$num_ref6*100);}
      if($row["cref6"]>=1 && $row["cref6"]<=4) { $NactB=$NactB+$row["nref6"];  $perc_NactB=ceil($NactB/$num_ref6*100);}
      if($row["cref6"]>=5 && $row["cref6"]<=8) { $NactC=$NactC+$row["nref6"]; $perc_NactC=ceil($NactC/$num_ref6*100);}
      if($row["cref6"]>=9 && $row["cref6"]<=15) { $NactD=$NactD+$row["nref6"]; $perc_NactD=ceil($NactD/$num_ref6*100);}
      if($row["cref6"]>15) {  $NactE=$NactE+$row["nref6"];  $perc_NactE=ceil($NactE/$num_ref6*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-4) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(5-8) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(9-15) </td>
     <td><?php echo $NactD; ?></td>
     <td><b><?php echo $perc_NactD; ?>%</b></td>
     </tr>

     <tr style="background-color:#9DCE6B">
     <td>Ottima(+9) </td>
     <td><?php echo $NactE; ?></td>
     <td><b><?php echo $perc_NactE; ?>%</b></td>
     </tr>
    `;
   

      }


      if (val.id=="R") 
      {
      info4=`
      <?php
        $NactA=0;
        $NactB=0;
        $NactC=0;
        $NactD=0;
        $NactE=0;
        $perc_NactA=0;
        $perc_NactB=0;
        $perc_NactC=0;
        $perc_NactD=0;
        $perc_NactE=0;

       while ($row = mysqli_fetch_assoc($esegui_query_azioniRa)) 
      {
      if($row["crefR"]==0) { $NactA=$NactA+$row["nrefR"];  $perc_NactA=ceil($NactA/$num_refR*100);}
      if($row["crefR"]>=1 && $row["crefR"]<=4) { $NactB=$NactB+$row["nrefR"];  $perc_NactB=ceil($NactB/$num_refR*100);}
      if($row["crefR"]>=5 && $row["crefR"]<=8) { $NactC=$NactC+$row["nrefR"]; $perc_NactC=ceil($NactC/$num_refR*100);}
      if($row["crefR"]>=9 && $row["crefR"]<=15) { $NactD=$NactD+$row["nrefR"]; $perc_NactD=ceil($NactD/$num_refR*100);}
      if($row["crefR"]>15) {  $NactE=$NactE+$row["nrefR"];  $perc_NactE=ceil($NactE/$num_refR*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-4) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(5-8) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(9-15) </td>
     <td><?php echo $NactD; ?></td>
     <td><b><?php echo $perc_NactD; ?>%</b></td>
     </tr>

     <tr style="background-color:#9DCE6B">
     <td>Ottima(+9) </td>
     <td><?php echo $NactE; ?></td>
     <td><b><?php echo $perc_NactE; ?>%</b></td>
     </tr>
    `;
  

      }

      if (val.id=="A") 
      {
      info4=`
      <?php
        $NactA=0;
        $NactB=0;
        $NactC=0;
        $NactD=0;
        $NactE=0;
        $perc_NactA=0;
        $perc_NactB=0;
        $perc_NactC=0;
        $perc_NactD=0;
        $perc_NactE=0;

       while ($row = mysqli_fetch_assoc($esegui_query_azioniAa)) 
      {
      if($row["crefA"]==0) { $NactA=$NactA+$row["nrefA"];  $perc_NactA=ceil($NactA/$num_refA*100);}
      if($row["crefA"]>=1 && $row["crefA"]<=4) { $NactB=$NactB+$row["nrefA"];  $perc_NactB=ceil($NactB/$num_refA*100);}
      if($row["crefA"]>=5 && $row["crefA"]<=8) { $NactC=$NactC+$row["nrefA"]; $perc_NactC=ceil($NactC/$num_refA*100);}
      if($row["crefA"]>=9 && $row["crefA"]<=15) { $NactD=$NactD+$row["nrefA"]; $perc_NactD=ceil($NactD/$num_refA*100);}
      if($row["crefA"]>15) {  $NactE=$NactE+$row["nrefA"];  $perc_NactE=ceil($NactE/$num_refA*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-4) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(5-8) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(9-15) </td>
     <td><?php echo $NactD; ?></td>
     <td><b><?php echo $perc_NactD; ?>%</b></td>
     </tr>

     <tr style="background-color:#9DCE6B">
     <td>Ottima(+9) </td>
     <td><?php echo $NactE; ?></td>
     <td><b><?php echo $perc_NactE; ?>%</b></td>
     </tr>
    `;
  

      }    


        $("div.details").append(
          `
          <div class="col-xl-3 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> `+val.title+` STORICO &nbsp; <span style="float:right"> <i class="`+val.icon+`"></i></span> </h6>
 </div>

<div class="card-body">  
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Attività</th>
        <th scope="col">Utenti</th>
        <th scope="col">%</th>
      </tr>
    </thead>

  <tbody>

  `+info4+`

    </tbody>

  </table>

</div>
</div>
</div>
    `
         );

      
      });


    });
 }

 addrows(); 
 addDetails(); 

 $.ajaxSetup({
  cache:false
});

</script>

<?php 

require_once('inc_footer.php');

?>