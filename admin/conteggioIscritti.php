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

//MVF - ref 3
$query_nuoviutenti3 = "SELECT * FROM t_user_info where active=1 and email not like'%.top' and ( provenienza='ref3') and reg_date like '%".$annocorrente."%'  ";
$esegui_query_nuoviutenti3 = mysqli_query($admin,$query_nuoviutenti3);
$num_ref3 = mysqli_num_rows($esegui_query_nuoviutenti3);

//MVF - ref 3
$query_nuoviutenti3a = "SELECT * FROM t_user_info where active=1 and actions>0 and email not like'%.top' and ( provenienza='ref3') and reg_date like '%".$annocorrente."%'";
$esegui_query_nuoviutenti3a = mysqli_query($admin,$query_nuoviutenti3a);
$num_ref3a = mysqli_num_rows($esegui_query_nuoviutenti3a);

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
      <th scope="col">Download</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">2 - Facebook</th>
      <td><?php echo $num_ref2 ?></td>
      <td><?php echo $num_ref2a ?></td>
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
      <td>
      <form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv3 ?>" />
				<input type="hidden" name="filename" value="bonusMVF" />
        <input type="hidden" name="filetype" value="campione" />
        <input style="width:60px; height:50px"  class="form-control" type="image" value="submit" src="img/csv.png" />
        </form>	  
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


</div>

</div>


<?php 

require_once('inc_footer.php');

?>