


<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);



$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Strumenti Utenti';
$areapagina = "tools";
$coldx = "no";

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

@$sid = $_REQUEST['sid'];
//@$stId = $_REQUEST['stid'];
$stId=0;
@$prj = $_REQUEST['prj'];
@$nl = $_REQUEST['nl'];
@$abi = $_REQUEST['abi'];
@$gt = $_REQUEST['gst'];
@$panel = $_REQUEST['panel'];
@$vId = $_REQUEST['viewId'];
@$ctId = $_REQUEST['ctId'];
@$ctRe = $_REQUEST['ctRe'];
@$nome=$_REQUEST["idval"];

//Tutto maiuscolo//
//$sid=strtoupper($sid);
$prj=strtoupper($prj);
$vId=strtoupper($vId);

$addLinks="";
$genLink="";
$genId="";


// FUNZIONE PER RIATTIVARE LINK 

if ($ctRe=="ATTIVA")
{
$aggCont=0;
$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');
$contatti=count($fl);

//connetti ftp
// $ftp_server="46.37.21.33";
// $ftp_user_name="primis";
// $ftp_user_pass="Imr_PrimiFields13";
// // set up basic connection
// $conn_id = ftp_connect($ftp_server);
// // login with username and password
// $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

	if ($nome<>"")
	{
	@$array=explode("\n",$nome);
	@$Carr=count($array);
	}
	
	if ($Carr<> 0)
	{
		$delConta=0;
		foreach($array as $arrV)  
		{
		$sql="update t_respint set status='0', iid='-1' where sid='".$sid."' and uid='".trim($arrV)."'";
		mysqli_query($admin,$sql);

		//if (mysqli_affected_rows()=="1") {$aggCont++;}
		$contaDel=0;
		//delete file
		for ($i = 0; $i < $contatti; $i++) 
				{  
			

				$riga = file($fl[$i]);
				$fileName=substr($fl[$i], -11);
				$prima_riga=$riga[0]; 
				$elementi = explode(";", $prima_riga);
				$readId=$elementi[4];
				$delId=trim($arrV);
				//echo $fileName."<br>";
				if ($readId==$delId && $contaDel==0)
					{ 
					//$delete=ftp_delete($conn_id, "/".$prj."/".$sid."/results/".$fileName."");
					$delete=unlink("/var/imr/fields/$prj/$sid/results/$fileName");
					$contaDel++;
					$delConta++;
					}

				}
		
		}
		$messAgg="Hai aggioranto ".$aggCont." link!";
		$messDel="Hai eliminato ".$contaDel." file!";
	}
	
	else {
	$messAgg="Nessuna corrispondenza trovata"; 
	$messDeò="Nessuna file eliminato"; 
	}?>

<?php } ?>

<!-- FINE FUNZIONE RIATTIVA LINK -->


  <div class="content-wrapper">
       <div class="container">
	   
	   
<?php 

$ssiVar="";
$ot="";

if($panel!="Nessuno") {$ssiVar="&pan=".$panel; }

if ($nl>0 || $gt==true)
{

?>


<div class="row">
<div class="col-xl-12">
 <div class="card shadow mb-12">
 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">LINKS </h6></span>
                        </div>
						<button class="btn btn-primary" data-clipboard-target=".lnk">Copia</button><br>
                        <div class="card-body">


<div class="lnk">

<?php



if ($gt==true) {echo "<div>https://www.primisoft.com/primis/run.do?sid=".$sid."&prj=".$prj."&uid=GUEST".$ssiVar.$ot."\n</div>";}

else 
{
if ($nl>0)
	{
		//SUFFISSO ID PER PANEL SELEZIONATO
		switch ($panel) 
		{
				case "1": $tPanel="IDEXCI"; $cint=true; break;
				case "2": $tPanel="IDEXDY"; break;
				case "3": $tPanel="IDEXBI"; break;
				case "4": $tPanel="IDEXNO"; break;	
				case "5": $tPanel="IDEXTO"; break;	
				case "6": $tPanel="IDEXNE"; break;		
				case "7": $tPanel="IDEXCT"; break;														
				case "8": $tPanel="IDEXA8L"; break;														
				case "9": $tPanel="IDEXA9L"; break;														
		}

		//CALCOLO ULTIMO UID UTILIZZATO
		$query_lastid = "SELECT COUNT(uid) as total FROM t_respint where uid LIKE '".$tPanel."%' and sid='$sid'";
		$res_lastId = mysqli_query($admin,$query_lastid);
		$lastId=mysqli_fetch_assoc($res_lastId);


		$stId=(int)$lastId['total']+2;



	for ($i=0; $i<=$nl; ++$i) 
		{	

		$varId=$tPanel.($i+1+$stId);
		$genId=$varId;
		$genLink="https://www.primisoft.com/primis/run.do?sid=".$sid."&prj=".$prj."&uid=".$varId.$ssiVar.$ot;
		echo "<div>".$genLink."</div>";
		$addLinks.=$genLink.";".$genId."\n";
		
		if($abi==true)
		    {
			
		    $query_insid = "INSERT INTO t_respint VALUES ('$sid','$varId',0,-1,'$prj')";
		    $ininrespint = mysqli_query($admin,$query_insid);
		    }
		}
	}
}	
	?>	
	
</div>

<?php

// csv per download campione



@$csv="Url;Code";
$csv .= "\n";

if ($cint==true) 
{
	$csv .= "Do not remove;123456789";
	$csv .= "\n";
	$csv .= "Do not remove;abcdefgh";
	$csv .= "\n";
}

$csv .=$addLinks; 
//fine csv

?>

<form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="links" />
				<input type="hidden" name="filetype" value="links" />
				<button type="submit" class="btn btn-secondary"> <span><i class="far fa-arrow-alt-circle-down" aria-hidden="true"></i></span> </button>

				</form>	

</div>
</div>
	
	
	
</div>
</div>

<?php } ?>

	   

<div class="row"> 
<div class="col-xl-8 col-lg-8">
<div class="card shadow mb-6">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
<h6 class="m-0 font-weight-bold text-primary"> CREA LINK </h6></span>
</div>
<div class="card-body">
	  

		    <form role="form" method="get" action="tools_link.php">
			
			<div class="form-row">

			<div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">SID:</label>
  			</div>
 			<input class="form-control"  id="res" name="sid" type="text">
 			</div>	
			</div>	
								
			<div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">PRJ:</label>
  			</div>
			<input class="form-control" style="text-transform:uppercase;" id="pro" name="prj" type="text">
            
                           
			</div>	
			</div>

		<!-- form-row end -->
		</div>
	
			
		<div class="form-row">
				


			<div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">LINK DA CREARE:</label>
  			</div>
			<input class="form-control"  id="nLink" name="nl" type="text" onchange="soloNum();" value="0">
			</div>
			</div>
			
			<div class="form-group col-md-6 form-inline">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">ALTRE VARIABILI:</label>
  			</div>
             <input class="form-control" id="otVar" name="ot" type="text">
            </div>			
			</div>

			<!-- form-row end -->		  
			</div>		  


			
	<div class="form-row">


    <div style="margin-bottom:5%" class="form-group col-md-6 form-inline">
      <label class="input-group-btn" for="inlineFormCustomSelect">Seleziona il Panel</label>
      <select style="margin-left:5%" class="custom-select mr-sm-2" name="panel" id="panel">
        <option selected>Nessuno</option>
        <option value="1">CINT</option>
        <option value="2">DYNATA</option>
        <option value="3">BILENDI</option>
        <option value="4">NORSTAT</option>
        <option value="5">TOLUNA</option>
        <option value="6">NETQUEST</option>
        <option value="7">CATI</option>
        <option value="8">PANEL 8</option>
        <option value="9">PANEL 9</option>
      </select>
    </div>

	<div class="form-group col-md-4 form-inline">
	<div class="form-row align-items-left">
    <div class="col-auto my-1">
      <div class="custom-control custom-checkbox mr-sm-2">
        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="abi" checked="checked">
        <label class="custom-control-label" for="customControlAutosizing">Abilita</label>
      </div>
	  <div class="custom-control custom-checkbox mr-sm-2">
        <input type="checkbox" class="custom-control-input" id="guest" name="gst">
        <label class="custom-control-label" for="guest">GUEST</label>
      </div>
    </div>
    <div class="col-auto my-1 ">
      <button type="submit" id="crea" value="CREA" class="btn btn-primary">Submit</button>
    </div>
  </div>

</div>

		<!-- form-row end -->		
	</div>
		  

	  

	  

	  </form>
</div>

</div>
</div>

	<!-- colonna link end -->	

	<!-- colonna riattiva id -->	

 <div class="col-xl-4 col-lg-4">
<div class="card shadow mb-6">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> RIATTIVA ID </h6></span>
                        </div>
			
<div class="card-body">


<form role="form" method="get" action="tools_link.php">

<div class="form-row">

<div class="form-group col-md-6">
<div class="input-group mb-3">
  <div class="input-group-prepend">
	<label class="input-group-text" for="inputGroupSelect01">SID:</label>
  </div>
<input class="form-control"  id="res" name="sid" type="text">
                        
  </div>
  </div>

  <div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">PRJ:</label>
  			</div>
   <input class="form-control" style="text-transform:uppercase;" id="res" name="prj" type="text">
                        
  </div>
  </div>

<!-- end formgroup  -->
 </div>
 <hr />
   
 <div class="form-row">

 <div class="form-group col-md-12">
			<div class="input-group mb-6">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">AGGIUNGI ID:</label>
  			</div>
       <textarea class="form-control" name="idval" cols="15" placeholder="Inserisci qui gli UID" rows="10"></textarea>
       </div>
	</div>   

<!-- end formgroup  -->
</div>	
  
  <hr />

  <div class="form-row">
  <div class="form-group col-md-9">
  </div>
  <div class="form-group col-md-3">
			<div style="color:red"><?php echo $messAgg;?></div>
			<div style="color:red"><?php echo $messDel;?></div>  
			<button class="btn btn-success" align="left" name="ctRe" type="submit" id="attiva" value="ATTIVA">Attiva</button>
  </div>
<!-- end formgroup  -->
</div>
		    
</form>

</div>
</div>
</div>





</div>
</div>
</div>



<?php require_once('inc_footer.php'); ?>
<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="jquery.copy-to-clipboard.js"></script>
</body>
</html>