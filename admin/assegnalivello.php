<html>
<head>

</head>

<body>





<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Strumenti Utenti';
$areapagina = "tools";
$coldx = "no";

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 


@$nome=$_REQUEST["idval"];
$numliv=$_REQUEST["numliv"];

//Tutto maiuscolo//
$sid=strtoupper($sid);
$prj=strtoupper($prj);
$vId=strtoupper($vId);

$data=date("Y-m-d H:i:s");






	if ($nome<>"")
	{
	@$array=explode("\n",$nome);
	@$Carr=count($array);
	}
	
	if ($Carr<> 0)
	{
		
		
		foreach($array as $arrV)  
		{
			
	//echo $Carr;
	
$query_cerca_livello = "SELECT t_user_info.user_id,field_data_field_user_level.entity_id,field_user_level_value FROM field_data_field_user_id, t_user_info,field_data_field_user_level where t_user_info.email='".$arrV."' AND t_user_info.user_id=field_data_field_user_id.field_user_id_value AND field_data_field_user_id.entity_id=field_data_field_user_level.entity_id";
$cerca_livello = mysqli_query($admin,$query_cerca_livello) or die(mysql_error());
$lvl = mysqli_fetch_assoc($cerca_livello);




//$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+1 WHERE entity_id='".$lvl['entity_id']."'";
$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+$numliv WHERE entity_id='".$lvl['entity_id']."'";
$add_livello = mysqli_query($admin,$query_aggiorna) or die(mysql_error());
//$lvlagg = mysqli_fetch_assoc($add_livello);
$livelloaggiornato=$lvl['field_user_level_value'];

echo "ciaooo ".$arrV." ".$numliv." ".$livelloaggiornato." ".$lvl['entity_id']."<br>";

$uidletto=$lvl['user_id'];

			if ($uidletto != "")
			{
			
			for ($i = 1; $i <= $numliv; $i++) {
				
$livelloprecedente=$livelloaggiornato;
$livelloaggiornato=$livelloaggiornato+1;
				
			//$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+1 WHERE entity_id='".$lvl['entity_id']."'";
		
			$query_aggbonus= "INSERT INTO t_user_history (user_id, event_date, event_type, event_info, prev_level, new_level) values ('".$lvl['user_id']."', '".$data."','Bonus','Livello Bonus',".$livelloprecedente.",".$livelloaggiornato.")";
			$aggiungihistory = mysqli_query($admin,$query_aggbonus) or die(mysql_error());
			}
			
			}
			
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_block;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_bootstrap;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_field;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_filter;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_form;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_image;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_menu;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_page;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_path;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_token;") or die(mysql_error());
		$pulisci = mysqli_query($admin,"TRUNCATE TABLE cache_update;") or die(mysql_error());	
			
		}
		
		//$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+1 WHERE entity_id='".$lvl['entity_id']."'";
		
		
		
		
	}
	
	?>



  <div class="content-wrapper">
       <div class="container">
	   
 <div class="row">

<div class="col-md-12 col-sm-12 col-xs-12">

 <div class="col-md-10 col-sm-10 col-xs-12">
<div class="panel panel-danger">
               <div class="panel-heading">
                          ASSEGNA LIVELLO
                        </div>
			
<div class="panel-body">


<form role="form" method="POST" action="assegnalivello.php">



  
  
     <hr />
   
       <div class="form-group">
       <label>Assegna livello</label>
       <textarea class="form-control" style="text-transform:uppercase;" name="idval" cols="15" placeholder="Inserisci qui gli indirizzi email" rows="10"></textarea>
       </div>
  
  <hr />
  Numero Livelli: <input type="text" name="numliv" style="width: 500px;">
  
			<div style="color:red"><?php echo $messAgg;?></div>
			<div style="color:red"><?php echo $messDel;?></div>  
			<div style="margin-top:70px"> <input align="left" name="ctRe" type="submit" id="attiva" value="Assegna"></div>
  

		    
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

mysql_close();
?>
<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="jquery.copy-to-clipboard.js"></script>
</body>
</html>