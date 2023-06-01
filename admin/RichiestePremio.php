<?php 
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 


	  
$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
@$var_pagato = $_REQUEST['var_pagato'];  
@$var_esporta = $_REQUEST['var_esporta'];  
@$code = $_REQUEST['code']; 
$id_utente = $_REQUEST['id_utente']; 
$importo=$_REQUEST['importo'];
$email=$_REQUEST['email'];
@$azione = $_REQUEST['azione'];
@$verifica = $_REQUEST['Verifica'];
@$cifra2 = $_REQUEST['cifra2'];
@$cifra5 = $_REQUEST['cifra5'];
@$cifra9 = $_REQUEST['cifra9'];
@$cifra10 = $_REQUEST['cifra10'];
@$cifra15 = $_REQUEST['cifra15'];
@$cifra20 = $_REQUEST['cifra20'];
$data=date("Y-m-d");

@$del= $_REQUEST['del'];
@$idPre= $_REQUEST['idPremio'];

@$premi2euro=$_REQUEST["pr2euro"];
@$premi5euro=$_REQUEST["pr5euro"];
@$premi10euro=$_REQUEST["pr10euro"];
@$premi20euro=$_REQUEST["pr20euro"];


@$csv="uid;email;valore;codice";


	if ($premi2euro<>"")
	{
		@$array2euro=explode("\n",$premi2euro);
	}
	
	if ($premi5euro<>"")
	{
		@$array5euro=explode("\n",$premi5euro);
	}
	
	if ($premi10euro<>"")
	{
		@$array10euro=explode("\n",$premi10euro);
	}
	
	if ($premi20euro<>"")
	{
		@$array20euro=explode("\n",$premi20euro);
	}

mysqli_select_db($admin,$database_admin);

	$cerca_progetto=$_REQUEST['typ'];
	if ($cerca_progetto==""){$cerca_progetto="0";}


require_once('inc_taghead.php');
require_once('inc_tagbody.php');


if($del=="Delete")
{
	  
	$query_selPoint = "SELECT user_id,prev_level,new_level FROM  t_user_history  where id='".$idPre."'";
	$risCerca=mysqli_query($admin,$query_selPoint);

	while ($row = mysqli_fetch_assoc($risCerca))
		{

			$recuperoPunteggio=$row["prev_level"]-$row["new_level"];
			$recuperoUid=$row["user_id"];

			$query_addPoint = "UPDATE t_user_info SET points=points+$recuperoPunteggio where user_id='$recuperoUid'";
			$risCerca=mysqli_query($admin,$query_addPoint);

			$query_delPremio = "DELETE FROM t_user_history  where id='".$idPre."'";
			$eliminaPremio=mysqli_query($admin,$query_delPremio);

		
		}

//   $query_user = "UPDATE t_user_history set pagato=1 where id='".$idPre."'";
//   mysqli_query($admin,$query_user);
  

}


$query_cerca = "SELECT * FROM t_user_history,t_user_info where pagato like '$cerca_progetto' AND t_user_history.user_id=t_user_info.user_id AND event_type='withdraw' and event_info LIKE '%Amazon%' order by event_date asc";
$cerca = mysqli_query($admin,$query_cerca);


?>

<div class="content-wrapper">
 <div class="container">



 <div class="row">
 <div class="col-md-9">
 <form role="form" name="modulo_cerca_prj" action="RichiestePremio.php" method="get">

 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <button class="btn btn-outline-secondary" type="submit" value="Filtra">Filtra</button>
  </div>
  <select class="form-control" name="typ">
		 <option value="">[PAGATI/NO PAGATI]</option>
		 <option value="0" <?php if ($cerca_progetto=="0") {echo 'selected="selected"';} ?>>NO PAGATO</option>
		 <option value="1" <?php if ($cerca_progetto=="1") {echo 'selected="selected"';} ?>>PAGATO</option>
		
	 </select>
</div>

 </form>

<form  action="RichiestePremio.php" method="post">

<div class="card shadow p-9 mb-9 bg-white rounded">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> RICHIESTE PREMIO</h6></span>
	<!-- <input class='btn btn-danger'  type='submit'  name='Verifica' value='verifica' /> -->
 </div>
   

 <div class="card-body recent-users-sec">
<table id='table_sur' style="font-size:11px;"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >
<thead>
<tr class='intesta'>
	 <th style="max-width:150px;">Uid</th>
	 <th>Premio</th>
	 <th>Bytes</th>
	 <th>Richiesta</th>
	 <th>IP</th>
	 <th>Codice</th>
	 <th>Pagato</th>
	 <th>*</th>
	</tr>

</thead>	
<tbody>	
<?php
$pagati=0;
$pagati2=0;
$pagati5=0;
$pagati9=0;
$pagati10=0;
$pagati15=0;
$pagati20=0;

	$contadapagati2euro=0;
	$contadapagati5euro=0;
	$contadapagati10euro=0;
	$contadapagati20euro=0;

$contapagati2euro=0;
$contapagati5euro=0;
$contapagati10euro=0;
$contapagati20euro=0;


	while ($row = mysqli_fetch_assoc($cerca))
		{
			$newdate = substr($row['event_date'],0,strlen($row['event_date'])-3);
			$paydate = substr($row['giorno_paga'],0,strlen($row['giorno_paga'])-8);
			$euroPaga=substr($row['event_info'], -7, 7);
			$tipoPremio=substr($row['event_info'], -14,7);
		
			if (strstr($euroPaga,"2 euro")&&(strstr($tipoPremio,"Amazon"))){ $bacCol="#D1E8FC"; $contadapagati2euro=$contadapagati2euro+1;}
			if (strstr($euroPaga,"5 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#FCC4C4"; $contadapagati5euro=$contadapagati5euro+1;}
			if (strstr($euroPaga,"9 Euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#F1F9B3";}
			if (strstr($euroPaga,"+1 Euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#F1F9B3";}
			if (strstr($euroPaga,"10 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#F1F9B3"; $contadapagati10euro=$contadapagati10euro+1;}
			if (strstr($euroPaga,"+5 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#C4FCB0";}
			if (strstr($euroPaga,"20 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#C4FCB0"; $contadapagati20euro=$contadapagati20euro+1;}

			if (strstr($euroPaga,"2 euro")&&(strstr($tipoPremio,"Paypal"))){ $bacCol="#99d1ff"; }
			if (strstr($euroPaga,"5 euro")&&(strstr($tipoPremio,"Paypal"))) { $bacCol="#ff8989"; }
			if (strstr($euroPaga,"10 euro")&&(strstr($tipoPremio,"Paypal"))) { $bacCol="#ffdcbc"; }
	
		 $puntiSpesi=$row['prev_level']-$row['new_level'];

		  echo "<tr>
		  <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['user_id']."<br/>".$row['email']."</a></td>
		 <td style='background:".$bacCol."'>".$tipoPremio." - ".$euroPaga."</td>
		 <td>".$puntiSpesi."</td>
		 <td>".$newdate."</td>
		 <td>".$row['ip']."</td>";
		  if ($row['codice']===null){echo "<td>n.a.</td><td>n.p.</td>";}
								else
								{
									echo "<td>".$row['codice']."</td><td>".$paydate."</td>"; 
									 
								}
							
			$montDate=date("m",strtotime($row['event_date']));
			$yearDate=date("y",strtotime($row['event_date']));
			

			
			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"2 euro"))&&(strstr($tipoPremio,"Amazon")))
			{
				
			$code=$array2euro[$contapagati2euro];	
			//echo "<div>2 euro:".$code."</div>";

			if ($code!=null)	
				{
				

				mysqli_select_db($admin,$database_admin );
				$query_aggiorna = "UPDATE t_user_history SET codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
				$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
				
				$contapagati2euro=$contapagati2euro+1;
				}	
			
			}
			
			
			
			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"5 euro"))&&(strstr($tipoPremio,"Amazon")))
			{
			
				$code=$array5euro[$contapagati5euro];
		
				
				if ($code!="")	
				{
				

					mysqli_select_db($admin,$database_admin);
					$query_aggiorna = "UPDATE t_user_history SET codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
					$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
					
					$contapagati5euro=$contapagati5euro+1;
				}	
				
			}	
			
			
			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"10 euro"))&&(strstr($tipoPremio,"Amazon")))
			{
				
				$code=$array10euro[$contapagati10euro];	
				//echo "<div>10 euro:".$code."</div>";
				
				if ($code!="")	
				{
			

					mysqli_select_db($admin,$database_admin);
					$query_aggiorna = "UPDATE t_user_history SET  codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
					$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
					
					$contapagati10euro=$contapagati10euro+1;
				}	
				
			}
			


			if(($var_pagato=="PAGA")&&(strstr($euroPaga,"20 euro"))&&(strstr($tipoPremio,"Amazon")))
			{
			

				$code=$array20euro[$contapagati20euro];
				//echo "<div>20 euro:".$code."</div>";
				
				if ($code!="")	
				{
					mysqli_select_db($admin,$database_admin);
					$query_aggiorna = "UPDATE t_user_history SET  codice='$code', giorno_paga='$data' WHERE pagato=0 and id='".$row['id']."'";
					$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
					
					

					$contapagati20euro=$contapagati20euro+1;
				}	
				
			}	
		
			if(($var_esporta=="ESPORTA")&&(strstr($tipoPremio,"Amazon")))
			{
				if ($row['codice'] != null)	
				{
				echo "entro in esporta";
				$csv .= "\n";
				$csv .=$row['user_id'].";".$row['email'].";".$euroPaga.";".$row['codice']; 

				mysqli_select_db($admin,$database_admin);
				$query_aggiorna2 = "UPDATE t_user_history SET  pagato=1 WHERE pagato=0 and id='".$row['id']."'";
				$up_ricercha2 = mysqli_query($admin,$query_aggiorna2) ;

				}
			}
			
//delete prizes
?>
<td><form action="RichiestePremio.php" method="POST">
<input type="hidden" id="id_sur<?php echo $row['id'] ?>" name="idPremio" value="<?php echo $row['id'] ?>">
<button class="btn btn-success" value="Delete"  name="del" onclick="return confirm('Sei sicuro?')" type="submit"><i class="fa-solid fa-trash-can"></i></button>
</form>
</td>


<?php
		}


/* premi in cassa */

$query_cassa = "SELECT * FROM millebytesdb.field_data_field_number_of_prizes order by entity_id ASC;";
$cassaRim = mysqli_query($admin,$query_cassa) ;

$cicli=0;
	while ($row = mysqli_fetch_assoc($cassaRim))
		{
		$cicli++;

		  if ($cicli==1) { $rimasti2=$row['field_number_of_prizes_value'];}	
		  if ($cicli==2) { $rimasti5=$row['field_number_of_prizes_value'];}	
		  if ($cicli==3) { $rimasti9=$row['field_number_of_prizes_value'];}	
		  if ($cicli==4) { $rimasti15=$row['field_number_of_prizes_value'];}	
		}
		
$query_cassa = "SELECT * FROM millebytesdb.field_data_field_refill_date order by entity_id ASC;";
$cassaRim = mysqli_query($admin,$query_cassa) ;

$cicli=0;
	while ($row = mysqli_fetch_assoc($cassaRim))
		{
		$cicli++;

		  if ($cicli==1) { $rimastiData2=$row['field_refill_date_value'];}	
		  if ($cicli==2) { $rimastiData5=$row['field_refill_date_value'];}	
		  if ($cicli==3) { $rimastiData9=$row['field_refill_date_value'];}	
		  if ($cicli==4) { $rimastiData15=$row['field_refill_date_value'];}	
		}		

		
?>
</tr>	
</tbody>
</table>



</div>


</div>

</div>

<div class="col-md-3">

<div class="row">
 
<div class="card shadow mb-12">
<div class="card-header py-6 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> STATUS PREMI </h6></span>
 </div>
   
 <div class="card-body  recent-users-sec"> 
<table style="font-size:11px; width:100%"  class="table table-striped table-bordered">
		<tr class='intesta'><th>Premio</th><th >Rimasti</th><th>Rifornimento</th></tr>
		<tr>
		<td>Buoni 2 euro:</td> 
		<td><?php echo $rimasti2  ?></td>
		<td><?php echo substr($rimastiData2,0,10) ?></td>

		</tr>
			
		<tr>
		<td>Buoni 5 euro:</td> 
		<td><?php echo $rimasti5 ?></td>
		<td><?php echo substr($rimastiData5,0,10) ?></td>
		</tr>
		
		
		<tr>
		<td>Buoni 10 Euro:</td>
		<td><?php echo $rimasti9 ?></td>
		<td><?php echo substr($rimastiData9,0,10) ?></td>
		</tr>
		
		
		<tr>
		<td>Buoni 20 Euro:</td>
		<td><?php echo $rimasti15 ?></td>
		<td><?php echo substr($rimastiData15,0,10) ?></td>
		</tr>

</table>
</div>
</div>
</div>

<?php

$cyear=date("Y");

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_user_history where event_info='Buono Amazon 2 euro' and event_date LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data2=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_user_history where event_info='Buono Amazon 5 Euro' and event_date LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data5=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_user_history where event_info='Buono Amazon 10 Euro' and event_date LIKE '".$cyear."%'";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data10=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_user_history where event_info='Buono Amazon 20 Euro'  and event_date LIKE '".$cyear."%'";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data20=mysqli_fetch_assoc($t_PAGO);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro2'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud2=mysqli_fetch_assoc($t_bud);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro5'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud5=mysqli_fetch_assoc($t_bud);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro10'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud10=mysqli_fetch_assoc($t_bud);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro20'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud20=mysqli_fetch_assoc($t_bud);

$gia2=$bud2['num']-$data2['total'];
$gia5=$bud5['num']-$data5['total'];
$gia10=$bud10['num']-$data10['total'];
$gia20=$bud20['num']-$data20['total'];

$dinizio = "2017-03-01";
$dfine = date("Y-m-d");

$ts1 = strtotime($dinizio);
$ts2 = strtotime($dfine);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$diff = 12-((($year2 - $year1) * 12) + ($month2 - $month1));


$giaM2=$gia2/$diff;
$giaM5=$gia5/$diff;
$giaM10=$gia10/$diff;
$giaM20=$gia20/$diff;

?>

<div class="row">
 
<div class="card-success shadow mb-12">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> TOTALE PREMI PAGATI</h6></span>
 </div>

   
 <div class="card-body  recent-users-sec"> 


<table style="font-size:11px"  class="table table-striped table-bordered">
		<tr class='intesta'><th></th><th >&euro; 2</th><th >&euro;5</th><th >&euro;10</th><th> &euro;20 </th></tr>

		<tr class=''>
		<td style="vertical-align : middle; text-align:center;" rowspan="2">Pagati</td><td><?php echo $data2['total']; ?></td><td><?php echo $data5['total']; ?></td><td><?php echo $data10['total']; ?></td><td><?php echo $data20['total']; ?></td>
		</tr>
		<tr>
		<td><?php echo $data2['total']*2; ?>€</td><td><?php echo $data5['total']*5; ?>€</td><td><?php echo $data5['total']*5; ?>€</td><td><?php echo $data20['total']*20; ?>€</td>
		</tr>
		<tr class=''>
		<td style="vertical-align : middle; text-align:center;"><b>Pagati</b></td>
		<td colspan="4">
		<?php 
		$totalone=($data2['total']*2)+($data5['total']*5)+($data10['total']*10)+($data20['total']*20);
		?>
		<b>
		<?php 
		echo $totalone;
		?>
		€</b>
		</td>
		</tr>

</table>
</div>
</div>
</div>


	 <div class="row">
		 
		 <div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-primary">
		Buoni Amazon 2 euro <span class="badge badge-light"><?php echo "(".$contadapagati2euro.")";?></span>
			</button>	  
		 </div>
			 
			 <div class="card-body"> 
			 <textarea class="form-control" style="text-transform:uppercase;" name="pr2euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea> 
		 </div>
	 </div>
 </div>
 
 
 	 <div class="row">
	  <div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-danger">
		 Buoni Amazon 5 euro <span class="badge badge-light"><?php echo "(".$contadapagati5euro.")";?></span>
				 </button>	
			 </div>
			 
			 <div class="card-body"> 
				 
				 <textarea class="form-control" style="text-transform:uppercase;" name="pr5euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea>
				 
			
			 
		 </div>
	 </div>
 </div>
 
 
	<div class="row">
		
	<div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-warning">
		 Buoni Amazon 10 euro <span class="badge badge-light"><?php echo "(".$contadapagati10euro.")";?></span>
			</div>
			
			<div class="card-body"> 
				
				<textarea class="form-control" style="text-transform:uppercase;" name="pr10euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea>
				
			
			
		</div>
	</div>
</div>

	 <div class="row">
		 
	 <div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-success">
		 Buoni Amazon 20 euro  <span class="badge badge-light"><?php echo "(".$contadapagati20euro.")";?></span>
			 </div>
			 
			 <div class="card-body"> 
				 
				 <textarea class="form-control" style="text-transform:uppercase;" name="pr20euro" cols="15" placeholder="Inserisci qui i codici" rows="10"></textarea>
				
				 <hr>
				<button class='btn btn-primary' style="min-width:214px;" type='submit'  name='var_pagato' value='PAGA' >PAGA</button>
				
				</form>

				<div  class="formCsv">
				<form style="text-align:center" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="premi2" />
				<input type="hidden" name="filetype" value="pr2" />
				<input style="height: 50px; width:60px;" class="form-control" type="image" nam='esporta' value="submit" src="img/csv.png" />
				</form>	
				</div>	
				<hr>
				<form style="text-align:center" action="RichiestePremio.php" method="post" target="_blank">
				<button class='btn btn-primary' style="min-width:214px;" type='submit'  name='var_esporta' value='ESPORTA' >ESPORTA</button>
				</form>	
				 
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
$(document).ready( function () {
  $('#table_sur').show();
  $('.mess').fadeOut();
    $('#table_sur').DataTable( {
        "order": [[ 3, "asc" ]],
        "pagingType": "full_numbers",
        "scrollY": false,
        "scrollX": false,
		"language": {
      					"emptyTable": "Non sono presenti dati",
						  "search":"Cerca:",
						  "lengthMenu":     "Mostra _MENU_ richieste"
   					 },
        "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "pageLength": 50,
        'columnDefs': [ {

                        'targets': [0,5,6,7], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );
</script>