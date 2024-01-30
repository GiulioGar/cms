<?php 
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/

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
$cyear=date("Y");

mysqli_select_db($admin,$database_admin);

$cerca_progetto=$_REQUEST['typ'];
if ($cerca_progetto==""){$cerca_progetto="0";}
else {$cerca_progetto="1";}


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

@$csv="uid;email;valore;codice";

$query_cerca = "SELECT * FROM t_user_history,t_user_info where pagato like '$cerca_progetto' AND t_user_history.user_id=t_user_info.user_id AND event_type='withdraw' and event_info LIKE '%Amazon%' order by event_date asc";
$cerca2 = mysqli_query($admin,$query_cerca);

?>


<div  id="parteSinistra">

<form role="form" name="modulo_cerca_prj" action="RichiestePremio.php" method="get">

 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <button id="filPrize" class="btn btn-outline-secondary" type="submit" value="Filtra">Filtra</button>
  </div>
  <select class="form-control" name="typ">
		 <option value="">[PAGATI/NO PAGATI]</option>
		 <option value="0" <?php if ($cerca_progetto=="0") {echo 'selected="selected"';} ?>>NO PAGATO</option>
		 <option value="1" <?php if ($cerca_progetto=="1") {echo 'selected="selected"';} ?>>PAGATO</option>
		
	 </select>
</div>

 </form>

<div class="card shadow p-9 mb-9 bg-white rounded">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> RICHIESTE PREMIO</h6></span>
	<!-- <input class='btn btn-danger'  type='submit'  name='Verifica' value='verifica' /> -->
 </div>
   

<div class="card-body recent-users-sec">

<?php

//AGGIORNA I PREMI
while ($row = mysqli_fetch_assoc($cerca2))
{
    $userIde=$row['id'];
    $uid=$row['user_id'];

    $newdate = substr($row['event_date'],0,strlen($row['event_date'])-3);
    $paydate = substr($row['giorno_paga'],0,strlen($row['giorno_paga'])-8);
    $euroPaga=substr($row['event_info'], -7, 7);
    $tipoPremio=substr($row['event_info'], -14,7);
   

    if (strstr($euroPaga,"2 euro")&&(strstr($tipoPremio,"Amazon"))){ $bacCol="#D1E8FC"; }
    if (strstr($euroPaga,"5 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#FCC4C4"; }
    if (strstr($euroPaga,"9 Euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#F1F9B3";}
    if (strstr($euroPaga,"+1 Euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#F1F9B3";}
    if (strstr($euroPaga,"10 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#F1F9B3"; }
    if (strstr($euroPaga,"+5 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#C4FCB0";}
    if (strstr($euroPaga,"20 euro")&&(strstr($tipoPremio,"Amazon"))) { $bacCol="#C4FCB0"; }

    if (strstr($euroPaga,"2 euro")&&(strstr($tipoPremio,"Paypal"))){ $bacCol="#99d1ff"; }
    if (strstr($euroPaga,"5 euro")&&(strstr($tipoPremio,"Paypal"))) { $bacCol="#ff8989"; }
    if (strstr($euroPaga,"10 euro")&&(strstr($tipoPremio,"Paypal"))) { $bacCol="#ffdcbc"; }

    if(($var_pagato=="PAGA")&&(strstr($euroPaga,"2 euro"))&&(strstr($tipoPremio,"Amazon")))
    {
    

    $query_selPrize = "SELECT codice FROM  t_premidb  where status='disponibile' and valore=2";
    $risPrize=mysqli_query($admin,$query_selPrize);
    $risPrizeArr = mysqli_fetch_assoc($risPrize);

    $code=$risPrizeArr["codice"];	

    if ($code!=null)	
        {
        
        mysqli_select_db($admin,$database_admin );
        //aggiorna storico
        $query_aggiorna = "UPDATE t_user_history SET codice2='$code', giorno_paga='$data', pagato=1 WHERE pagato=0 and id='$userIde'";
        $up_ricercha = mysqli_query($admin,$query_aggiorna) ;
        //aggiora database premi
        $query_aggiorna = "UPDATE t_premidb SET status='pagato', pagamento='$data', user='$uid' WHERE  codice='$code'";
        $up_dbpremi = mysqli_query($admin,$query_aggiorna) ;
        
        $contapagati2euro=$contapagati2euro+1;
        }	
    
    }
    
    
    
    if(($var_pagato=="PAGA")&&(strstr($euroPaga,"5 euro"))&&(strstr($tipoPremio,"Amazon")))
    {
    
        $query_selPrize = "SELECT codice FROM  t_premidb  where status='disponibile' and valore=5";
        $risPrize=mysqli_query($admin,$query_selPrize);
        $risPrizeArr = mysqli_fetch_assoc($risPrize);

        $code=$risPrizeArr["codice"];	


        
        if ($code!="")	
        {
        

            mysqli_select_db($admin,$database_admin);
        //aggiorna storico
        $query_aggiorna = "UPDATE t_user_history SET codice2='$code', giorno_paga='$data', pagato=1 WHERE pagato=0 and id='$userIde'";
        $up_ricercha = mysqli_query($admin,$query_aggiorna) ;
        //aggiora database premi
        $query_aggiorna = "UPDATE t_premidb SET status='pagato', pagamento='$data', user='$uid' WHERE  codice='$code'";
        $up_dbpremi = mysqli_query($admin,$query_aggiorna) ;
            
            $contapagati5euro=$contapagati5euro+1;
        }	
        
    }	
    
    
    if(($var_pagato=="PAGA")&&(strstr($euroPaga,"10 euro"))&&(strstr($tipoPremio,"Amazon")))
    {
        
        $query_selPrize = "SELECT codice FROM  t_premidb  where status='disponibile' and valore=10";
        $risPrize=mysqli_query($admin,$query_selPrize);
        $risPrizeArr = mysqli_fetch_assoc($risPrize);

        $code=$risPrizeArr["codice"];	
        
        if ($code!="")	
        {
    

        mysqli_select_db($admin,$database_admin);
        //aggiorna storico
        $query_aggiorna = "UPDATE t_user_history SET codice2='$code', giorno_paga='$data', pagato=1 WHERE pagato=0 and id='$userIde'";
        $up_ricercha = mysqli_query($admin,$query_aggiorna) ;
        //aggiora database premi
        $query_aggiorna = "UPDATE t_premidb SET status='pagato', pagamento='$data', user='$uid' WHERE  codice='$code'";
        $up_dbpremi = mysqli_query($admin,$query_aggiorna) ;
            
            $contapagati10euro=$contapagati10euro+1;
        }	
        
    }
    


    if(($var_pagato=="PAGA")&&(strstr($euroPaga,"20 euro"))&&(strstr($tipoPremio,"Amazon")))
    {
    

        $query_selPrize = "SELECT codice FROM  t_premidb  where status='disponibile' and valore=20";
        $risPrize=mysqli_query($admin,$query_selPrize);
        $risPrizeArr = mysqli_fetch_assoc($risPrize);

        $code=$risPrizeArr["codice"];	
        
        if ($code!="")	
        {
            mysqli_select_db($admin,$database_admin);
        //aggiorna storico
        $query_aggiorna = "UPDATE t_user_history SET codice2='$code', giorno_paga='$data', pagato=1 WHERE pagato=0 and id='$userIde'";
        $up_ricercha = mysqli_query($admin,$query_aggiorna) ;
        //aggiora database premi
        $query_aggiorna = "UPDATE t_premidb SET status='pagato', pagamento='$data', user='$uid' WHERE  codice='$code'";
        $up_dbpremi = mysqli_query($admin,$query_aggiorna) ;
            
            

            $contapagati20euro=$contapagati20euro+1;
        }	
        
    }	

    if(($var_pagato=="PAGA")&&(strstr($tipoPremio,"Amazon")))
    {
        if ($code != null)	
        {
        $csv .= "\n";
        $csv .=$row['user_id'].";".$row['email'].";".$euroPaga.";".$code; 
        }
    }
}

?>

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
$query_cerca = "SELECT * FROM t_user_history,t_user_info where pagato like '$cerca_progetto' AND t_user_history.user_id=t_user_info.user_id AND event_type='withdraw' and event_info LIKE '%Amazon%' order by event_date asc";
$cerca = mysqli_query($admin,$query_cerca);


//STAMPA IN TABELLA
	while ($row = mysqli_fetch_assoc($cerca))
		{
			$newdate = substr($row['event_date'],0,strlen($row['event_date'])-3);
			$paydate = substr($row['giorno_paga'],0,strlen($row['giorno_paga'])-8);
			$euroPaga=substr($row['event_info'], -7, 7);
			$tipoPremio=substr($row['event_info'], -14,7);
            $ifPagato=$row['pagato'];
           
		
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

         if ($ifPagato==0) { $stampIP=$row['ip'];}
         else { $stampIP="&nbsp;"; }

		  echo "<tr>
		  <td style='max-width:200px;'><a href=\"user.php?user_id=".$row['user_id']."\" style=\"color:#00C; text-decoration:none \" target='_blank'>".$row['user_id']."<br/>".$row['email']."</a></td>
		 <td style='background:".$bacCol."'>".$tipoPremio." - ".$euroPaga."</td>
		 <td>".$puntiSpesi."</td>
		 <td>".$newdate."</td>
		 <td>".$stampIP."</td>";
		  if ($row['codice2']===null){echo "<td>n.a.</td><td>n.p.</td>";}
								else
								{
									echo "<td>".$row['codice2']."</td><td>".$paydate."</td>"; 
									 
								}
							
			$montDate=date("m",strtotime($row['event_date']));
			$yearDate=date("y",strtotime($row['event_date']));
			
			
//delete prizes
?>

<td>
<form action="" method="GET">
<input type="hidden" id="id_sur<?php echo $row['id'] ?>" name="idPremio" value="<?php echo $row['id'] ?>">
<button id="delPrize" class="btn btn-success" value="Delete" onclick="return confirm('Sei sicuro?')" data-ide=<?php echo $row['id'] ?> name="del" type="button"><i class="fa-solid fa-trash-can"></i></button>
</form>
</td>







<?php
		}
?>


</tr>	
</tbody>
</table>



</div>


</div>


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
        "destroy": true,
        'columnDefs': [ {

                        'targets': [0,5,6,7], /* column index */

                        'orderable': false, /* true or false */

                        }]
    } );

 
} );


</script>


<script>
//TROVA DUPLICATI IP E SOTTOLINEA


const tabella = "#table_sur";
  const colonnaDaControllare = 5; // Ad esempio, controlla la seconda colonna

  function trovaDuplicatiETagli(tabella, colonna) {
    const celleColonna = $(tabella).find(`tr td:nth-child(${colonna})`);
    const valori = {};
    console.log(celleColonna);

    celleColonna.each(function() {
      const valore = $(this).text();
      if (valori[valore]) {
        $(this).addClass("duplicato");
      } else {
        valori[valore] = true;
      }
    });
  }


$(document).ready(function() {
  trovaDuplicatiETagli(tabella, colonnaDaControllare);
  $(".duplicato").css("background-color","#ff6b6b");
});

$( "#table_sur" ).on( "mousemove", function( event ) {
	trovaDuplicatiETagli(tabella, colonnaDaControllare);
	$(".duplicato").css("background-color","#ff6b6b");
	console.log("Muovo");

});
</script>


</div>


<div  id="parteDestra">

<?php



$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_premidb where valore=2 and status='pagato' and pagamento LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data2=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_premidb where valore=5 and status='pagato' and pagamento LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data5=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_premidb where valore=10 and status='pagato' and pagamento LIKE '".$cyear."%' ";
$t_PAGO = mysqli_query($admin,$query_pago) ;
$data10=mysqli_fetch_assoc($t_PAGO);

$query_pago= "SELECT COUNT(*) as total FROM millebytesdb.t_premidb where valore=20 and status='pagato' and pagamento LIKE '".$cyear."%' ";
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

/* premi in cassa */

$query_cassa = "SELECT * FROM t_premidb where status='disponibile'";
$cassaRim = mysqli_query($admin,$query_cassa) ;

$rimasti2=0;
$rimasti5=0;
$rimasti10=0;
$rimasti20=0;
$sumRimasti=0;

	while ($row = mysqli_fetch_assoc($cassaRim))
		{
		 $valorePremi=$row['valore'];


		  if ($valorePremi==2) { $rimasti2++;}	
		  if ($valorePremi==5) { $rimasti5++;}	
		  if ($valorePremi==10) { $rimasti10++;}	
		  if ($valorePremi==20) { $rimasti20++;}	
		}	

/* premi acquistati */

$query_cassa = "SELECT * FROM t_premidb ";
$premiBuy = mysqli_query($admin,$query_cassa) ;

$buy2=0;
$buy5=0;
$buy10=0;
$buy20=0;
$buyTotal=0;

	while ($row = mysqli_fetch_assoc($premiBuy))
		{
		 $valorePremi=$row['valore'];
		 $scadenzaPremi=substr($row['scadenza'], -4);
		 $scadenzaPremi=(int)$scadenzaPremi;
		 $scadenzaPremi=$scadenzaPremi-10;

		 if($cyear==$scadenzaPremi)
			{

				if ($valorePremi==2) { $buy2++;}	
				if ($valorePremi==5) { $buy5++;}	
				if ($valorePremi==10) { $buy10++;}	
				if ($valorePremi==20) { $buy20++;}	
			}	


		}			

		
?>

<div class="row">
 
<div class="card-success shadow mb-12">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> PREMI <?php echo $cyear ?> </h6></span>
 </div>

   
 <div class="card-body  recent-users-sec"> 


<table style="font-size:11px"  class="table table-striped table-bordered">
		<tr class='intesta'><th></th><th >&euro; 2</th><th >&euro;5</th><th >&euro;10</th><th> &euro;20 </th></tr>

		<tr class=''>
		<td style="vertical-align : middle; text-align:center;" rowspan="2">Pagati</td>
		<td><?php echo $data2['total']; ?></td>
		<td><?php echo $data5['total']; ?></td>
		<td><?php echo $data10['total']; ?></td>
		<td><?php echo $data20['total']; ?></td>
		</tr>
		<tr>
		<td><?php echo $data2['total']*2; ?>€</td><td><?php echo $data5['total']*5; ?>€</td><td><?php echo $data5['total']*5; ?>€</td><td><?php echo $data20['total']*20; ?>€</td>
		</tr>
		<tr class=''>
		<td colspan="3" style="vertical-align : middle; text-align:center;"><b>TOTALE PAGATI</b></td>
		<td colspan="2" style="vertical-align : middle; text-align:center;">
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
		<tr class='intesta'><th></th><th >&euro; 2</th><th >&euro;5</th><th >&euro;10</th><th> &euro;20 </th></tr>
		<tr class=''>
		<td style="vertical-align : middle; text-align:center;" rowspan="2">Acquistati</td>
		<td><?php echo $buy2; ?></td>
		<td><?php echo $buy5; ?></td>
		<td><?php echo $buy10; ?></td>
		<td><?php echo $buy20; ?></td>
		</tr>
		<tr>
		<td><?php echo $buy2*2; ?>€</td><td><?php echo $buy5*5; ?>€</td><td><?php echo $buy10*5; ?>€</td><td><?php echo $buy20*20; ?>€</td>
		</tr>
		<tr class=''>
		<td colspan="3" style="vertical-align : middle; text-align:center;"><b>TOTALE ACQUISTATI</b></td>
		<td colspan="2" style="vertical-align : middle; text-align:center;">
		<?php 
		$totalone=($buy2*2)+($buy5*5)+($buy10*10)+($buy20*20);
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
 
<div class="card shadow mb-12">
<div class="card-header py-6 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> CASSA </h6></span>
 </div>
   
 <div class="card-body  recent-users-sec"> 

<table style="font-size:11px; width:100%"  class="table table-striped table-bordered">
		<tr class='intesta'><th>Tipologia</th><th >Rimasti</th><th>Valore</th></tr>
		<tr>
		<td>Buoni 2 euro:</td> 
		<td><?php echo $rimasti2  ?></td>
		<td><?php echo $rimasti2*2; $sumRimasti=$sumRimasti+$rimasti2*2; ?>€</td>

		</tr>
			
		<tr>
		<td>Buoni 5 euro:</td> 
		<td><?php echo $rimasti5 ?></td>
		<td><?php echo $rimasti5*5; $sumRimasti=$sumRimasti+$rimasti5*5; ?>€</td>
		</tr>
		
		
		<tr>
		<td>Buoni 10 Euro:</td>
		<td><?php echo $rimasti10 ?></td>
		<td><?php echo $rimasti10*10; $sumRimasti=$sumRimasti+$rimasti10*10; ?>€</td>
		</tr>
		
		
		<tr>
		<td>Buoni 20 Euro:</td>
		<td><?php echo $rimasti20 ?></td>
		<td><?php echo $rimasti20*20; $sumRimasti=$sumRimasti+$rimasti20*20; ?>€</td>
		</tr>

		<tr>
		<td><b>Cassa totale</b></td>
		<td colspan="2" style="text-align: center;"><b><?php echo $sumRimasti; ?>€</b></td>
		
		</tr>

</table>
</div>
</div>

</div>

 
	<div class="row">
		
	<div class="card card-danger shadow mb-12">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            PREMI RICHIESTI
         </div>
         <div class="card-body">
         <div class="row"><div class="col-md-12"><button style="width:100%" type="button" class="btn btn-primary"> Buoni Amazon 2 € <span class="badge badge-light"><?php echo "(".$contadapagati2euro.")";?></span> </button></div></div>	  
         <div class="row"><div class="col-md-12"> <button style="width:100%" type="button" class="btn btn-danger"> Buoni Amazon 5 € <span class="badge badge-light"><?php echo "(".$contadapagati5euro.")";?></span></button></div></div>
         <div class="row"><div class="col-md-12"><button style="width:100%" type="button" class="btn btn-warning"> Buoni Amazon 10 € <span class="badge badge-light"><?php echo "(".$contadapagati10euro.")";?></span></button></div></div>
         <div class="row"><div class="col-md-12"><button style="width:100%" type="button" class="btn btn-success"> Buoni Amazon 20 €  <span class="badge badge-light"><?php echo "(".$contadapagati20euro.")";?></span></button></div></div>
		</div>
			
	</div>
</div>

 <div class="row">
 <div class="card card-danger shadow mb-12">
 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

 <form style="text-align:center" method="GET">
 <button id="payPrize" class='btn btn-secondary' style="min-width:214px;" type='button'  name='var_pagato' value='PAGA'>ASSEGNA</button>
</form>	
 
 </div>
 <div class="card-body"> 
				<div  class="formCsv">
				<form style="text-align:center" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="premi2" />
				<input type="hidden" name="filetype" value="pr2" />
				<input id="esp" style="height: 50px; width:60px;" class="form-control" type="image" nam='esporta' value="submit" src="img/csv.png" />
				</form>	
				</div>	
				 
                </div>
	 </div>
 </div>


  </div>

