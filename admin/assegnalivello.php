<html>
<head>

</head>

<body>





<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($admin,$database_admin);

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Strumenti Utenti';
$areapagina = "tools";
$coldx = "no";

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 


@$nome=$_REQUEST["idval"];
$numliv=$_REQUEST["numliv"];
$motliv=$_REQUEST["motliv"];

//Tutto maiuscolo//
$sid=strtoupper($sid);
$prj=strtoupper($prj);
$vId=strtoupper($vId);

$data=date("Y-m-d H:i:s");


	if ($nome<>"")
	{
	@$array=explode("\n",$nome);
	$array=array_map('trim', $array);
	@$Carr=count($array);
	}
	

// echo $Carr;

if ($Carr<> 0) 
{
		


foreach($array as $arrV)  
{
			
	
$query_cerca_livello = "SELECT * FROM t_user_info where user_id='$arrV' ";
$cerca_livello = mysqli_query($admin,$query_cerca_livello) ;
$lvl = mysqli_fetch_assoc($cerca_livello);



//$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+1 WHERE entity_id='".$lvl['entity_id']."'";
$query_aggiorna = "UPDATE t_user_info SET points=points+$numliv WHERE user_id='$arrV'";
$add_livello = mysqli_query($admin,$query_aggiorna) ;

echo $query_aggiorna."<br/>";

$livelloaggiornato=$lvl['points'];

$uidletto=$lvl['user_id'];



if ($uidletto != "")
			{	
$livelloprecedente=$livelloaggiornato;
$livelloaggiornato=$livelloaggiornato+$numliv;

		
$query_aggbonus= "INSERT INTO t_user_history (user_id, event_date, event_type, event_info, prev_level, new_level) values ('".$lvl['user_id']."', '".$data."','Bonus','$motliv',".$livelloprecedente.",".$livelloaggiornato.")";
$aggiungihistory = mysqli_query($admin,$query_aggbonus) ;

			}
			
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_block;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_bootstrap;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_field;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_filter;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_form;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_image;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_menu;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_page;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_path;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_token;") ;
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_update;") ;	


			
		}
		
		
		
		
		
	}
	
	?>



  <div class="content-wrapper">
       <div class="container">
	   
 <div class="row">

<div class="col-md-12">

<div class="col-md-12">
<div class="card shadow mb-6">
 <div style="padding:10px; font-size:18px;" class="m-0 font-weight-bold text-success"> ASSEGNAZIONE BYTES <i class="fas fa-level-up-alt"></i></div>
			
<div class="card-body">


<form role="form" method="POST" action="assegnalivello.php">
  
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span style="width:173px;" class="input-group-text" id="basic-addon1">Numero Bytes</span>
  </div>
  <input type="number" name="numliv" style="width: 500px;">
</div>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span style="width:173px;" class="input-group-text" id="basic-addon2">Motivazione:</span>
  </div>
  <input type="text" name="motliv" style="width: 500px;">
</div>
 
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text">Utenti da incentivare</span>
  </div>
  <textarea class="form-control" style="text-transform:uppercase;" name="idval" placeholder="Inserisci qui gli uid" rows="10"></textarea>
</div>

      
			<div style="color:red"><?php echo $messAgg;?></div>
			<div style="color:red"><?php echo $messDel;?></div>  
<hr>
			<button class="btn btn-primary" name="ctRe" type="submit" value="Assegna" id="attiva" >ASSEGNA</div></td>


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
<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="jquery.copy-to-clipboard.js"></script>

<script>


       
</script>



</body>
</html>