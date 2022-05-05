<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

$mesecorrente=date(m);
$annocorrente=date(Y);

//FACEBOOK - ref 2
$query_nuoviutenti2 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref2' || provenienza='website') and reg_date like '%".$annocorrente."%'  ";
$esegui_query_nuoviutenti2 = mysqli_query($admin,$query_nuoviutenti2);
$num_ref2 = mysqli_num_rows($esegui_query_nuoviutenti2);

//FACEBOOK - ref 2 attivi
$query_nuoviutenti2a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref2' || provenienza='website') and reg_date like '%".$annocorrente."%'";
$esegui_query_nuoviutenti2a = mysqli_query($admin,$query_nuoviutenti2a);
$num_ref2a = mysqli_num_rows($esegui_query_nuoviutenti2a);

$perc_ref2=ceil($num_ref2a/$num_ref2*100);

//CONTA AZIONI - FACEBOOK
$query_azioni2a = "SELECT DISTINCT(actions) as cref2,  COUNT(DISTINCT user_id) AS nref2 FROM t_user_info where active=1 and (provenienza ='ref2' or provenienza ='website') and reg_date like '%$annocorrente%' GROUP by actions order by actions ASC";
$esegui_query_azioni2a = mysqli_query($admin,$query_azioni2a);





//MVF - ref 3
$query_nuoviutenti3 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref3') and reg_date like '%".$annocorrente."%'  ";
$esegui_query_nuoviutenti3 = mysqli_query($admin,$query_nuoviutenti3);
$num_ref3 = mysqli_num_rows($esegui_query_nuoviutenti3);

//MVF - ref 3
$query_nuoviutenti3a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref3') and reg_date like '%".$annocorrente."%'";
$esegui_query_nuoviutenti3a = mysqli_query($admin,$query_nuoviutenti3a);
$num_ref3a = mysqli_num_rows($esegui_query_nuoviutenti3a);

$perc_ref3=ceil($num_ref3a/$num_ref3*100);

//CONTA AZIONI - REF3
$query_azioni3a = "SELECT DISTINCT(actions) as cref3,  COUNT(DISTINCT user_id) AS nref3 FROM t_user_info where active=1 and provenienza ='ref3' and reg_date like '%$annocorrente%' GROUP by actions order by actions ASC";
$esegui_query_azioni3a = mysqli_query($admin,$query_azioni3a);

//EMY - ref 4
$query_nuoviutenti4 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref4') and reg_date like '%".$annocorrente."%'  ";
$esegui_query_nuoviutenti4 = mysqli_query($admin,$query_nuoviutenti4);
$num_ref4 = mysqli_num_rows($esegui_query_nuoviutenti4);

//EMY - ref 4
$query_nuoviutenti4a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref4') and reg_date like '%".$annocorrente."%'";
$esegui_query_nuoviutenti4a = mysqli_query($admin,$query_nuoviutenti4a);
$num_ref4a = mysqli_num_rows($esegui_query_nuoviutenti4a);

$perc_ref4=ceil($num_ref4a/$num_ref4*100);

//CONTA AZIONI - REF4
$query_azioni4a = "SELECT DISTINCT(actions) as cref4,  COUNT(DISTINCT user_id) AS nref4 FROM t_user_info where active=1 and provenienza ='ref4' and reg_date like '%$annocorrente%' GROUP by actions order by actions ASC";
$esegui_query_azioni4a = mysqli_query($admin,$query_azioni4a);


//RECUPERI - ref REACT
$query_nuoviutentiR = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='react') and reg_date like '%".$annocorrente."%'  ";
$esegui_query_nuoviutentiR = mysqli_query($admin,$query_nuoviutentiR);
$num_refR= mysqli_num_rows($esegui_query_nuoviutentiR);

//RECUPERI - ref REACT
$query_nuoviutentiRa = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='react') and reg_date like '%".$annocorrente."%'";
$esegui_query_nuoviutentiRa = mysqli_query($admin,$query_nuoviutentiRa);
$num_refRa = mysqli_num_rows($esegui_query_nuoviutentiRa);

$perc_refR=ceil($num_refRa/$num_refR*100);

//RECUPERI AZIONI - REF REACT
$query_azioniRa = "SELECT DISTINCT(actions) as crefR,  COUNT(DISTINCT user_id) AS nrefR FROM t_user_info where active=1 and provenienza ='react' and reg_date like '%$annocorrente%' GROUP by actions order by actions ASC";
$esegui_query_azioniRa = mysqli_query($admin,$query_azioniRa);


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
	<div col-xs-6><h6 class="m-0 font-weight-bold text-primary"> ISCRITTI <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="fas fa-user-clock"></i></span> </h6></div>
  <div class="col col-xs-6 text-right">
	<?php require_once('modifica_ref.php'); ?>
	</div>
 </div>

<div class="card-body">  

<div class="row">

<div class="col-md-12">

<!-- TABELLA DATI  DA  ENGAGE-->

<table  class="table table-striped">
  <thead class="thead-light">
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
<div class="row details">

 <!-- REF  -->

 <!-- REF  -->

 



 <!-- DETTAGLI CAMPANGE -->
</div>


</div>

</div>

<script>
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

  $.getJSON('referal.json', function(data) 
    {
  
      $.each(data.referal, function(key, val) 
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
        csv="$csvR";
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


  $.getJSON('referal.json', function(data) 
    {
  
      $.each(data.referal, function(key, val) 
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
      if($row["cref2"]>=1 && $row["cref2"]<=2) { $NactB=$NactB+$row["nref2"];; $perc_NactB=ceil($NactB/$num_ref2*100);}
      if($row["cref2"]>=3 && $row["cref2"]<=5) { $NactC=$NactC+$row["nref2"]; $perc_NactC=ceil($NactC/$num_ref2*100);}
      if($row["cref2"]>=6 && $row["cref2"]<=9) { $NactD=$NactD+$row["nref2"]; $perc_NactD=ceil($NactD/$num_ref2*100);}
      if($row["cref2"]>9) {  $NactE=$NactE+$row["nref2"]; $perc_NactE=ceil($NactE/$num_ref2*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-2) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(3-5) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(6-9) </td>
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
      if($row["cref3"]>=1 && $row["cref3"]<=2) { $NactB=$NactB+$row["nref3"];  $perc_NactB=ceil($NactB/$num_ref3*100);}
      if($row["cref3"]>=3 && $row["cref3"]<=5) { $NactC=$NactC+$row["nref3"]; $perc_NactC=ceil($NactC/$num_ref3*100);}
      if($row["cref3"]>=6 && $row["cref3"]<=9) { $NactD=$NactD+$row["nref3"]; $perc_NactD=ceil($NactD/$num_ref3*100);}
      if($row["cref3"]>9) {  $NactE=$NactE+$row["nref3"];  $perc_NactE=ceil($NactE/$num_ref3*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-2) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(3-5) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(6-9) </td>
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
      if($row["cref4"]>=1 && $row["cref4"]<=2) { $NactB=$NactB+$row["nref4"];  $perc_NactB=ceil($NactB/$num_ref4*100);}
      if($row["cref4"]>=3 && $row["cref4"]<=5) { $NactC=$NactC+$row["nref4"]; $perc_NactC=ceil($NactC/$num_ref4*100);}
      if($row["cref4"]>=6 && $row["cref4"]<=9) { $NactD=$NactD+$row["nref4"]; $perc_NactD=ceil($NactD/$num_ref4*100);}
      if($row["cref4"]>9) {  $NactE=$NactE+$row["nref4"];  $perc_NactE=ceil($NactE/$num_ref4*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-2) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(3-5) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(6-9) </td>
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
      if($row["crefR"]>=1 && $row["crefR"]<=2) { $NactB=$NactB+$row["nrefR"];  $perc_NactB=ceil($NactB/$num_refR*100);}
      if($row["crefR"]>=3 && $row["crefR"]<=5) { $NactC=$NactC+$row["nrefR"]; $perc_NactC=ceil($NactC/$num_refR*100);}
      if($row["crefR"]>=6 && $row["crefR"]<=9) { $NactD=$NactD+$row["nrefR"]; $perc_NactD=ceil($NactD/$num_refR*100);}
      if($row["crefR"]>9) {  $NactE=$NactE+$row["nrefR"];  $perc_NactE=ceil($NactE/$num_refR*100);}
   } 
   ?> 

     <tr style="background-color:#f9aeae">
     <td>Nessuna(0) </td>
     <td><?php echo $NactA; ?></td>
     <td><b><?php echo $perc_NactA; ?>%</b></td>
     </tr>  
     
     <tr style="background-color:#ffde7c">
     <td>Bassa(1-2) </td>
     <td><?php echo $NactB; ?></td>
     <td><b><?php echo $perc_NactB; ?>%</b></td>
     </tr>

     <tr style="background-color:#ffff7c">
     <td>Media(3-5) </td>
     <td><?php echo $NactC; ?></td>
     <td><b><?php echo $perc_NactC; ?>%</b></td>
     </tr>

     <tr style="background-color:#cfff7c">
     <td>Buona(6-9) </td>
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
	<h6 class="m-0 font-weight-bold text-primary"> `+val.title+` <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="`+val.icon+`"></i></span> </h6>
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
</script>

<?php 

require_once('inc_footer.php');

?>