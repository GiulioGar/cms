<?php 
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 
	  
$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
@$var_pagato = $_REQUEST['var_pagato'];  
@$var_email = $_REQUEST['var_email'];  
@$code = $_REQUEST['code']; 
$id_utente = $_REQUEST['id_utente']; 
$importo=$_REQUEST['importo'];
$email=$_REQUEST['email'];
@$azione = $_REQUEST['azione'];
@$id_pre = $_REQUEST['id_pre'];
@$verifica = $_REQUEST['Verifica'];
$data=date("Y-m-d");


$contaMailNulle;


mysqli_select_db($admin,$database_admin);

$cerca_progetto=$_REQUEST['typ'];
if ($cerca_progetto==""){$cerca_progetto="0";}


require_once('inc_taghead.php');
require_once('inc_tagbody.php');



$query_cerca = "SELECT * FROM t_user_history,t_user_info where pagato like '$cerca_progetto' AND t_user_history.user_id=t_user_info.user_id AND event_type='withdraw' and event_info LIKE '%Paypal%' order by event_date asc";
$cerca = mysqli_query($admin,$query_cerca);




?>

<div class="content-wrapper">
 <div class="container">



 <div class="row">
 <div class="col-md-12">
 <form role="form" name="modulo_cerca_prj" action="RichiestePaypal.php" method="get">

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



<div class="card shadow p-12 mb-12 bg-white rounded">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> RICHIESTE PAYPAL</h6></span>
	<!-- <input class='btn btn-danger'  type='submit'  name='Verifica' value='verifica' /> -->
 </div>
   

 <div class="card-body recent-users-sec">
<table id='table_sur' style="font-size:11px;"  class="table table-striped table-hover dt-responsive display dataTable no-footer" >
<thead>
<tr class='intesta'>
	 <th style="max-width:200px;">Uid</th>
	 <th>Premio</th>
	 <th>Valore</th>
	 <th>Pre</th>
	 <th>Post</th>
	 <th>Richiesta</th>
	 <th>Email paypal</th>
	 <th>Pagamento</th>
	 <th>Paga</th>
	</tr>

</thead>	
<tbody>	
<?php

@$csv="uid;email;";

	while ($row = mysqli_fetch_assoc($cerca))
		{
			$newdate = substr($row['event_date'],0,strlen($row['event_date'])-8);
			$paydate = substr($row['giorno_paga'],0,strlen($row['giorno_paga'])-8);
			$euroPaga=substr($row['event_info'], -7, 7);
			$tipoPremio=substr($row['event_info'], -14,7);
		
			if($row['paypalEmail']===NULL) { $contaMailNulle++;}
			if (strstr($euroPaga,"5 euro")&&(strstr($tipoPremio,"Paypal"))) { $bacCol="#ff8989"; $contadapagati5euro=$contadapagati5euro+1;}
			if (strstr($euroPaga,"10 euro")&&(strstr($tipoPremio,"Paypal"))) { $bacCol="#ffdcbc"; $contadapagati10euro=$contadapagati10euro+1;}
	

		  echo "<tr>
		  <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['user_id']."<br/>".$row['email']."</a></td>
		 <td style='background:".$bacCol."'>".$tipoPremio."</td>
		 <td style='background:".$bacCol."'>".$euroPaga."</td>
		 <td>".$row['prev_level']."</td>
		 <td>".$row['new_level']."</td>
		 <td>".$newdate."</td>
		 <td>".$row['paypalEmail']."</td>";
		  if ($row['pagato']==0){echo "<td>n.p.</td>";}
								else
								{
									echo "<td>".$paydate."</td></tr>"; 
									 
								}
			if ($row['pagato']==0){					
			echo "<td>
			<form  action='RichiestePaypal.php' method='POST'>
			<input name='id_pre' type='hidden' value='".$row['id']."' >
			<button class='btn btn-primary' style='min-width:54px;' type='submit'  name='var_pagato' value='PAGA' >PAGA</button>
			</form>
			</td></tr>	";	
			}
			$montDate=date("m",strtotime($row['event_date']));
			$yearDate=date("y",strtotime($row['event_date']));


			if($row['paypalEmail']===NULL )
			{
			    //// ESPORTA CAMPIONE MVF IN CSV ////
				$csv .= "\n";
				$csv .=$row['user_id'].";".$row['email']; 
				//$csv .= "\n";


				//INVIO EMAIL DEPRECATO //


				// $header = "MIME-Version: 1.0\r\n";
				// $header .= "Content-type: text/html; charset=utf-8\r\n";
				// $header .= 'From: "Millebytes" <sondaggi@interactive-mr.com>';
				// $destinatario = $row['email'];
				// //$destinatario = "millebytes@interactive-mr.com";
				// $oggetto = "Club Millebytes: Richiesta ricarica Paypal!";
				// $messaggio = '
				// <html>
				// <head>
				// <title>Club Millebytes: Un ultimo passo e avrai la tua ricarica!</title>
				// <style type="text/css">
				// body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:normal; color:#000000;}
				// </style>
				// </head>
				// <body>
					
				// <p>
				// Caro utente, <br/>

				// per poter effettuare la ricarica paypal da te richiesta abbiamo bisogno dell indirizzo email* legato al tuo conto Paypyal.
				// <br/>
				// <br/>
				// Ti preghiamo di fornircelo quanto prima, dopo qualche giorno riceverai la ricarica che ti spetta.

				// Collegati al seguente link per lasciarci il tuo indirizzo:
				// <br>
				// <a href="https://millebytes.com/res/paypalMail.php?user_id='.$row['user_id'].'"/>https://millebytes.com/res/paypalMail.php?user_id='.$row['user_id'].'</a>
				// </p>
				// <br>
				
	
				
				// <p>
				// Lascia un commento sulla nostra pagina facebook !<br/><a href="https://www.facebook.com/pages/Millebytes/1474771096088455">https://www.facebook.com/pages/Millebytes/1474771096088455</a>
				// </p>
				
				// <br>
				// <br>
				// <p>
				// <i>*La tua email paypal sar&agrave; utilizzata esclusivamente per pagare il premio, non invieremo sondaggi/comunicazioni su questa email.</i>
				// </p>
				
				
				
				// </body>
				// </html>
				// ';
				// mail($destinatario, $oggetto, $messaggio, $header);
				
				// $contaInviate++;


			}
		}			
?>
</tbody>
</table>
</div>


</div>

</div>

<div class="col-md-3">

<?php

$cyear=date("Y");


$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_user_history where event_info='Buono regalo da 5 Euro' and event_date LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data5=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_user_history where event_info='Buono regalo da 10 Euro' and event_date LIKE '".$cyear."%'";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data10=mysqli_fetch_assoc($t_PAGO);



$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro5'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud5=mysqli_fetch_assoc($t_bud);

$query_bud= "SELECT * FROM millebytesdb.cassa_buoni where type='euro10'";
$t_bud = mysqli_query($admin,$query_bud) ;
$bud10=mysqli_fetch_assoc($t_bud);




$gia5=$bud5['num']-$data5['total'];
$gia10=$bud10['num']-$data10['total'];

$dinizio = "2017-03-01";
$dfine = date("Y-m-d");

$ts1 = strtotime($dinizio);
$ts2 = strtotime($dfine);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);




?>




 
 	 <!-- <div class="row">
	  <div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-danger">
		 Ricariche 5 euro <span class="badge badge-light"><?php echo "(".$contadapagati5euro.")";?></span>
				 </button>	
			 </div>
			 
			 <div class="card-body"> 
				 
			 <input type="number" class="form-control" name="pr5euro" cols="15" placeholder="Buoni da pagare" rows="1"></input>
				 
			
			 
		 </div>
	 </div>
 </div>
 
 
	<div class="row">
		
	<div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 <button style="width:100%" type="button" class="btn btn-warning">
		 Ricariche 10 euro <span class="badge badge-light"><?php echo "(".$contadapagati10euro.")";?></span>
			</div>
			
			<div class="card-body"> 
				
				<input type="number" class="form-control" name="pr10euro" cols="15" placeholder="Buoni da pagare" rows="1"></input>
				
				<hr>
				
				
				
			
		</div>
	</div>



</div>
<br/>
<br/>
<div class="row">
		
		<div class="card card-danger shadow mb-12">
			 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			 <button style="width:100%" type="button" class="btn btn-success">
			 Utenti senza email <span class="badge badge-light"><?php echo "(".$contaMailNulle.")";?></span>
				</div>
				
				<div class="card-body"> 

				<div  class="formCsv">
				<form style="text-align:center" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="mailPaypal" />
				<input type="hidden" name="filetype" value="mailPay" />
				<input style="height: 80px; width:80px;" class="form-control" type="image" value="submit" src="img/csv.png" />
				</form>	
				</div>
					
				
			</div>
		</div>
	
	
	
	</div>


</div> -->




</div>

</div>
</div>
<?php

if($var_pagato=="PAGA")
{

		mysqli_select_db($admin,$database_admin);
		$query_aggiorna = "UPDATE t_user_history SET  giorno_paga='$data', pagato=1 WHERE pagato=0 and id='".$id_pre."'";
		$up_ricercha = mysqli_query($admin,$query_aggiorna) ;
?>


<script>

window.onload = function() {
	if(!window.location.hash) {
		window.location = window.location + '#loaded';
		window.location.reload();
	}
}

</script>


	
		
	
<?php }	

require_once('inc_footer.php'); 
?>

<script>
$(document).ready( function () {
  $('#table_sur').show();
  $('.mess').fadeOut();



    $('#table_sur').DataTable( {
        "order": [[ 5, "asc" ]],
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

                        'targets': [0,1,3,4,6], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );
} );
</script>