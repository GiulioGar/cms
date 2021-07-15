


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
@$stId = $_REQUEST['stid'];
@$prj = $_REQUEST['prj'];
@$gt = $_REQUEST['guest'];
@$ss = $_REQUEST['ss'];
@$cint = $_REQUEST['cint'];
@$ot = $_REQUEST['ot'];
@$nl = $_REQUEST['nl'];
@$abi = $_REQUEST['abi'];
@$vId = $_REQUEST['viewId'];
@$ctId = $_REQUEST['ctId'];
@$ctRe = $_REQUEST['ctRe'];
@$nome=$_REQUEST["idval"];

//Tutto maiuscolo//
$sid=strtoupper($sid);
$prj=strtoupper($prj);
$vId=strtoupper($vId);

$addLinks="";
$genLink="";
$genId="";



if ($ctRe=="ATTIVA")
{
$aggCont=0;
$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');
$contatti=count($fl);

//connetti ftp
$ftp_server="46.37.21.33";
$ftp_user_name="primis";
$ftp_user_pass="Imr_PrimiFields13";
// set up basic connection
$conn_id = ftp_connect($ftp_server);
// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

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

		if (mysqli_affected_rows()=="1") {$aggCont++;}
		$contaDel=0;
		//delete file
		for ($i = 0; $i < $contatti; $i++) 
				{  
				$riga = file($fl[$i]);
				$fileName=substr($fl[$i], -11);
				$prima_riga=$riga[0]; 
				$elementi = explode(";", $prima_riga);
				$readId=$elementi[3];
				$delId=trim($arrV);
				//echo $fileName."<br>";
				if ($readId==$delId && $contaDel==0)
					{ 
					$delete=ftp_delete($conn_id, "/".$prj."/".$sid."/results/".$fileName."");
					$contaDel++;
					$delConta++;
					}

				}
		
		}
		$messAgg="Hai aggioranto ".$aggCont." link!";
		$messDel="Hai eliminato ".$delConta." file!";
	}
	
	else {
	$messAgg="Nessuna corrispondenza trovata"; 
	$messDeò="Nessuna file eliminato"; 
	}?>


<?php } ?>

  <div class="content-wrapper">
       <div class="container">
	   
	   
<?php 

if ($nl>0 || $gt==true)
{
if($ss==true) { $ssiVar="&pan=2"; }
if($cint==true) { $ssiVar="&pan=1"; }
else { $ssiVar="";}
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

if ($nl>0)
	{
	for ($i=0; $i<=$nl; ++$i) 
		{
		$varId="IDEX".($i+1000+$stId);
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
	}?>	
	
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
 			<input class="form-control" style="text-transform:uppercase;" id="res" name="sid" type="text">
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
   			 <label class="input-group-text" for="inputGroupSelect01">START ID:</label>
  			</div>
			<input class="form-control" id="stid" name="stid" value="0" type="text">
			
			</div>		
			</div>


			<div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">LINK DA CREARE:</label>
  			</div>
			<input class="form-control"  id="nLink" name="nl" type="text" onchange="soloNum();" value="0">
			</div>
			</div>
			
			

			<!-- form-row end -->		  
			</div>		  


			
			<div class="form-row">

			<div class="form-group col-md-6">
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
			<div class="form-group col-md-6 align-items-center">
			<div class="form-check form-check-inline">
			<input  id="gst" name="guest" type="checkbox">
			<label class="form-check-label" for="inlineCheckbox1">&nbsp;&nbsp;GUEST</label>
			</div>
			<div class="form-check form-check-inline">
			<input id="cint" name="cint" type="checkbox">
			<label class="form-check-label" for="inlineCheckbox2"> &nbsp;&nbsp;CINT</label>
			</div>
			<div class="form-check form-check-inline">
			<input id="ss" name="ss" type="checkbox">
			<label class="form-check-label" for="inlineCheckbox3"> &nbsp;&nbsp;SSI</label>
			</div>
			<div class="form-check form-check-inline">
			<input id="ot"  type="checkbox" onclick="viewOt()">
			<label class="form-check-label" for="inlineCheckbox4">&nbsp;&nbsp;ALTRO</label>
			</div>
			</div>
		<!-- form-row end -->		
			</div>
		  


			<div class="form-row">

			<div class="form-group col-md-10">

			</div>

	<div class="form-group col-md-2">
	<div class="form-row align-items-left">
    <div class="col-auto my-1">
      <div class="custom-control custom-checkbox mr-sm-2">
        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="abi" checked="checked">
        <label class="custom-control-label" for="customControlAutosizing">Abilita</label>
      </div>
    </div>
    <div class="col-auto my-1">
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
<input class="form-control" style="text-transform:uppercase;" id="res" name="sid" type="text">
                        
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
       <textarea class="form-control" style="text-transform:uppercase;" name="idval" cols="15" placeholder="Inserisci qui gli UID" rows="10"></textarea>
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



<?php 

require_once('inc_footer.php'); 
?>
<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="jquery.copy-to-clipboard.js"></script>
</body>
</html>