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
	<h6 class="m-0 font-weight-bold text-primary"> ISCRITTI <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="fas fa-user-clock"></i></span> </h6>
 </div>

<div class="card-body">  

<div class="row">

<div class="col-md-12">

<!-- TABELLA DATI  DA  ENGAGE-->

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Referente</th>
      <th scope="col">Registrati</th>
      <th scope="col">Attivi</th>
      <th scope="col">%</th>
      <th scope="col">Download</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">2 - Facebook</th>
      <td><?php echo $num_ref2 ?></td>
      <td><?php echo $num_ref2a ?></td>
      <td><?php echo $perc_ref2 ?></td>
      <td>
      <form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="bonusFacebook" />
        <input type="hidden" name="filetype" value="campione" />
        <input style="width:60px; height:50px"  class="form-control" type="image" value="submit" src="img/csv.png" />
        </form>	    
    </td>
    </tr>
    <tr>


      <th scope="row">3 - MVF</th>
      <td><?php echo $num_ref3 ?></td>
      <td><?php echo $num_ref3a ?></td>
      <td><?php echo $perc_ref3 ?></td>
      <td>
      <form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv3 ?>" />
				<input type="hidden" name="filename" value="bonusMVF" />
        <input type="hidden" name="filetype" value="campione" />
        <input style="width:60px; height:50px"  class="form-control" type="image" value="submit" src="img/csv.png" />
        </form>	  
        </td>
    </tr>

    <tr>


      <th scope="row">4 -GRUPPO FACEBOOK</th>
      <td><?php echo $num_ref4 ?></td>
      <td><?php echo $num_ref4a ?></td>
      <td><?php echo $perc_ref4 ?></td>
      <td>
      <form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv4 ?>" />
				<input type="hidden" name="filename" value="bonusEmy" />
        <input type="hidden" name="filetype" value="bonusEmy" />
        <input style="width:60px; height:50px"  class="form-control" type="image" value="submit" src="img/csv.png" />
        </form>	  
        </td>
    </tr>

    <tr>


<th scope="row">R - RIATTIVAZIONI</th>
<td><?php echo $num_refR ?></td>
<td><?php echo $num_refRa ?></td>
<td><?php echo $perc_refR ?></td>
<td>
  N.D.
  </td>
</tr>

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

 <!-- REF 2 -->
<div class="col-xl-3 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> facebook <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="fab fa-facebook"></i></span> </h6>
 </div>

<div class="card-body">  
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Azioni</th>
        <th scope="col">Utenti</th>
        <th scope="col">%</th>
      </tr>
    </thead>

  <tbody>
  <?php
  while ($row = mysqli_fetch_assoc($esegui_query_azioni2a)) 
      {
      $perc_refAct2=ceil($row["nref2"]/$num_ref2*100);
      ?>

     <tr>
     <td><?php echo $row["cref2"]; ?></td>
     <td><?php echo $row["nref2"]; ?></td>
     <td><?php echo $perc_refAct2; ?>%</td>
    </tr>   
  



    <?php 
    }

      ?>

    </tbody>

  </table>

</div>
</div>
</div>
 <!-- REF 2 -->

  <!-- REF 3 -->
<div class="col-xl-3 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> MVF <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="fas fa-server"></i></span> </h6>
 </div>

<div class="card-body">  
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Azioni</th>
        <th scope="col">Utenti</th>
        <th scope="col">%</th>
      </tr>
    </thead>

  <tbody>
  <?php
  while ($row = mysqli_fetch_assoc($esegui_query_azioni3a)) 
      {
      $perc_refAct3=ceil($row["nref3"]/$num_ref3*100);
      ?>

     <tr>
     <td><?php echo $row["cref3"]; ?></td>
     <td><?php echo $row["nref3"]; ?></td>
     <td><?php echo $perc_refAct3; ?>%</td>
    </tr>   
  



    <?php 
    }

      ?>

    </tbody>

  </table>

</div>
</div>
</div>
 <!-- REF 3 -->


   <!-- REF 4 -->
<div class="col-xl-3 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> Gruppo facebook <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="fab fa-facebook-messenger"></i></i></span> </h6>
 </div>

<div class="card-body">  
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Azioni</th>
        <th scope="col">Utenti</th>
        <th scope="col">%</th>
      </tr>
    </thead>

  <tbody>
  <?php
  while ($row = mysqli_fetch_assoc($esegui_query_azioni4a)) 
      {
      $perc_refAct4=ceil($row["nref4"]/$num_ref4*100);
      ?>

     <tr>
     <td><?php echo $row["cref4"]; ?></td>
     <td><?php echo $row["nref4"]; ?></td>
     <td><?php echo $perc_refAct4; ?>%</td>
    </tr>   
  



    <?php 
    }

      ?>

    </tbody>

  </table>

</div>
</div>
</div>
 <!-- REF 4 -->

    <!-- REF REACT -->
<div class="col-xl-3 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> Riattivazionie <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="fas fa-undo-alt"></i></span> </h6>
 </div>

<div class="card-body">  
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Azioni</th>
        <th scope="col">Utenti</th>
        <th scope="col">%</th>
      </tr>
    </thead>

  <tbody>
  <?php
  while ($row = mysqli_fetch_assoc($esegui_query_azioniRa)) 
      {
      $perc_refActR=ceil($row["nrefR"]/$num_refR*100);
      ?>

     <tr>
     <td><?php echo $row["crefR"]; ?></td>
     <td><?php echo $row["nrefR"]; ?></td>
     <td><?php echo $perc_refActR; ?>%</td>
    </tr>   
  



    <?php 
    }

      ?>

    </tbody>

  </table>

</div>
</div>
</div>
 <!-- REF 4 -->



 <!-- DETTAGLI CAMPANGE -->
</div>


</div>

</div>


<?php 

require_once('inc_footer.php');

?>