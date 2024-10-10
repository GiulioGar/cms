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

@$sid = $_REQUEST['sid'];
@$stId = $_REQUEST['stid'];
@$prj = $_REQUEST['prj'];
@$gt = $_REQUEST['guest'];
@$ss = $_REQUEST['ss'];
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
		mysqli_query($sql,$admin) or die(mysql_error());

		if (mysql_affected_rows()=="1") {$aggCont++;}
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
if($ss==true) { $ssiVar="&ssi=1"; }
else { $ssiVar="";}
?>

 <div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
 <div class="panel panel-default">
                        <div class="panel-heading">
                          LINK:
                        </div>
						<button class="btn btn-primary" data-clipboard-target=".lnk">Copy text from textarea.</button><br>
                        <div class="panel-body">


<div class="lnk">

<?php

if ($gt==true) {echo "<div>http://www.primisoft.com/primis/run.do?sid=".$sid."&prj=".$prj."&uid=GUEST".$ssiVar.$ot."\n</div>";}

if ($nl>0)
	{
	for ($i=0; $i<=$nl; ++$i) 
		{
		$varId="IDEX".($i+1000+$stId);
		echo "<div>http://www.primisoft.com/primis/run.do?sid=".$sid."&prj=".$prj."&uid=".$varId.$ssiVar.$ot."\n</div>";
		if($abi==true)
		    {
		    $query_insid = "INSERT INTO t_respint VALUES ('$sid','$varId',0,-1,'$prj')";
		    $con = mysqli_query($query_insid, $admin) or die(mysql_error());
		    }
		}
	}?>	
	
</div>
</div>
</div>
	
	
	
</div>
</div>

<?php } ?>

	   

 <div class="row">
	   
	   
<div class="col-md-8 col-sm-8 col-xs-12">
<div class="panel panel-info">
               <div class="panel-heading">
                          CREA LINK
                        </div>
			
			 <div class="panel-body">
	  
		    <form role="form" method="get" action="tools_link2.php">
			
			<div class="col-md-12 col-sm-12 col-xs-12">
		                     <div class="form-group col-md-7 col-sm-7 col-xs-12">
                                            <label>Sid:</label>
                                           <input class="form-control" style="text-transform:uppercase;" id="res" name="sid" type="text">
                                            <p class="help-block">Numero ricerca.</p>
							</div>	
								
							<div class="form-group col-md-5 col-sm-5 col-xs-12">
                                            <label>Prj:</label>
											<input class="form-control" style="text-transform:uppercase;" id="pro" name="prj" type="text">
                                            <p class="help-block">Codice progetto.</p>
                           
							 </div>	
			</div>
	
			
			<div class="col-md-12 col-sm-12 col-xs-12">
				
		                     <div class="form-group col-md-7 col-sm-7 col-xs-12">
                                            <label>Start Id:</label>
                                           <input class="form-control" id="stid" name="stid" value="0" type="text">
                                            <p class="help-block">Id di partenza.</p>
                             </div>		
					
                            <div class="form-group col-md-5 col-sm-5 col-xs-12">
                                            <label>Info</label>
                                            <div class="checkbox">
                                                <label>
                                                   <input  id="gst" name="guest" type="checkbox">Guest
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input id="ss" name="ss" type="checkbox">SSI
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input id="ot"  type="checkbox" onclick="viewOt()">Altro
                                                </label>
                                            </div>
      
                      </div>
					  
			</div>		  
	 
			
					<div class="col-md-12 col-sm-12 col-xs-12">
						 <div class="form-group has-success col-md-7 col-sm-7 col-xs-12">
                                            <label class="control-label" for="success">N&deg;Link</label>
                                           <input class="form-control"  id="nLink" name="nl" type="text" onchange="soloNum();" value="0">&nbsp;&nbsp;<span class="alert"></span>
                         </div>	
						  <div class="form-group has-warning col-md-5 col-sm-5 col-xs-12">
                                            <label class="control-label otVar" for="warning">Altre variabili:</label>
                                            <input class="form-control" id="otVar" name="ot" type="text">
                       </div>			
			
					</div>

			
		<div class="col-md-12 col-sm-12 col-xs-12">
		    <input type="submit" id="crea" value="CREA">&nbsp;&nbsp;&nbsp;
			Abilita<input id="abi" checked="checked" name="abi" type="checkbox">
		   </div> 
		    </form>
		    
		    </div>
	  
	  </div>
	  


</div>



 <div class="col-md-4 col-sm-4 col-xs-12">
<div class="panel panel-danger">
               <div class="panel-heading">
                          RIATTIVA ID
                        </div>
			
<div class="panel-body">


<form role="form" method="get" action="tools_link2.php">


  <div class="form-group">
                            <label>Sid</label>
                            <input class="form-control" style="text-transform:uppercase;" id="res" name="sid" type="text">
                            <p class="help-block">Numero ricerca</p>
  </div>

  <div class="form-group">
                            <label>Progetto</label>
                            <input class="form-control" style="text-transform:uppercase;" id="res" name="prj" type="text">
                            <p class="help-block">Codice progetto</p>
  </div>
  
  
     <hr />
   
       <div class="form-group">
       <label>Text area</label>
       <textarea class="form-control" style="text-transform:uppercase;" name="idval" cols="15" placeholder="Inserisci qui gli UID" rows="10"></textarea>
       </div>
  
  <hr />
			<div style="color:red"><?php echo $messAgg;?></div>
			<div style="color:red"><?php echo $messDel;?></div>  
			<div style="margin-top:70px"> <input align="left" name="ctRe" type="submit" id="attiva" value="ATTIVA"></div>
  

		    
</form>

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