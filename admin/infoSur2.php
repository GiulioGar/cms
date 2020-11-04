<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
	  
mysqli_select_db($admin,$database_admin);

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
*/
require_once('inc_taghead.php');

?>



<style>

input[type="number"] {
	width:55px;
 }

</style>

<?php
require_once('inc_tagbody.php');


/*

$query_cerca = "SELECT res.uid, SUM(res.status=3) as comp ,SUM(res.status=0) as cont,info.email,first_name,reg_date
FROM t_respint as res, t_user_info as info where info.user_id=res.uid and info.active=1
GROUP BY res.uid ORDER BY comp DESC";
$cerca = mysqli_query($admin,$query_cerca);




// CREO GLI ARRAY

$arrComp = array();
$arrInviti = array();

while($rows =  mysqli_fetch_assoc($cerca))
{
    $arrComp[]=$rows['comp'];

}

$countComp=count($arrComp);
$arrComp=array_unique($arrComp);
*/


// $query_contatto = "SELECT distinct uid, COUNT(uid) AS 'numc',email,first_name FROM t_respint as res, t_user_info as info where info.user_id=res.uid and status=0 GROUP BY uid order by num desc ";
// $contatto = mysqli_query($admin,$query_contatto) or die(mysql_error());

?>

<div class="content-wrapper">
 <div class="container">
<div class="row">



<div class="col-md-8 col-md-offset-1">


<div class="card card-default">
<div class="card-body">
<div class="table-responsive">

<table style="font-size:11px" id="table_sur"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >

<thead>
<tr> 
<th>Uid</th>
<th>Anno</th>
<th>Email</th>
<th>Complete</th>
<th>Inviti</th>
<th>%</th>
</tr>
</thead>


</table>

</div>
</div>

</div>
</div>

<div class="col-md-4 col-md-offset-1">

<div class="card shadow mb-12">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> RICERCHE </h6></span>
 </div>
   
 <div class="card-body  recent-users-sec"> 
<table style="font-size:11px"  class="table table-striped table-bordered">
		<tr class='intesta'><th>Numero Ricerche</th><th >Utenti</th></tr>
		<tr>
		<td>OLTRE 100 RICERCHE:</td> 
		<td><?php echo $u100  ?></td>
		</tr>
			
		<tr>
		<td>51-100 RICERCHE:</td> 
		<td><?php echo $u51 ?></td>
		</tr>
		
		
		<tr>
		<td>30-50 RICERCHE:</td>
		<td><?php echo $u30 ?></td>
		</tr>
		
		
		<tr>
		<td>10-29 RICERCHE:</td>
		<td><?php echo $u10 ?></td>
		</tr>

    <tr>
		<td>2-9 RICERCHE:</td>
		<td><?php echo $u1 ?></td>
		</tr>

    <tr>
		<td>0-1 RICERCHE:</td>
		<td><?php echo $u0 ?></td>
		</tr>

</table>
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



<script>



$(document).ready( function (e) {

    $('#table_sur').DataTable( {
		"bProcessing":true,
		"serverSide":true,
		"ajax":{
			url:"function_infoSur.php",
			type:"POST",
			error: function(){
				$("#post_list_processing").css("display","none");
			}
		}
		
    } );
} );
</script>