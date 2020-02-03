<html>
<head>

	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style type="text/css">	
		.progress-bar {
		float: left;
		width: 0;
		height: 100%;
		font-size: 12px;
		color: #ffffff;
		text-align: center;
		background-color: #428bca;
		-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
		box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
		-webkit-transition: width 0.6s ease;
		transition: width 0.6s ease;
		}
	</style>
	<script type="text/javascript">  
	
	
	
		$(document).ready(function() {  
			$("form#iscrizione").submit(function(){  
				var sid = $("#sid").val();  
				var prj = $("#prj").val();  
				var nl = $("#nl").val();  
				var inizio = $("#inizio").val();
				$.ajax({  
					type: "POST",
					url: "tools_test_esegui.php",  
					data: "sid=" + sid + "&prj=" + prj+ "&nl=" + nl+ "&inizio=" + inizio,
					dataType: "html",
					cache: true,
                    async: true,
					success: function(risposta) {  
						$("div#risposta").html(risposta);
						$("#inizio").val('');
						//partistoppa(1);
						$("form#iscrizione").submit();
					},
					error: function(){
						alert("Chiamata fallita!!!");
					} 
				}); 
				return false;  
			});
			
			
			
			
		});
		

		
		
		
		
		
		
    </script>  

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

	
		$contatti=0;
		
$fl=0;	     
		
		

	$test=0;



	/*
	if (!empty($sid) && !empty($prj) && !empty($nl)){
		
		$linkoriginale="http://www.primisoft.com/primis/run.do?sid=".$sid."&prj=".$prj."&uid=GUEST&test=1";
		
		
		
		$contatti=0;
		
		echo '<script type="text/javascript">',
		'function lanciatest(){',
		'secondi='.$nl.';',
		'millisecondi=secondi*1000;',
		'myWindow = window.open("'.$linkoriginale.'", "myWindow", "width=250, height=250");',
		'setTimeout(function() { myWindow.close();}, millisecondi);',
		'}',
		'lanciatest();',
		'</script>';
		
		
		
		}
	*/
	
	
	

?>

	
	<script>
		
	</script>


  <div class="content-wrapper">
       <div class="container">
	   
	   

 <div class="row">
	   
	   
<div class="col-md-8 col-sm-8 col-xs-12">
<div class="panel panel-info">
               <div class="panel-heading">
                          Tool Test
                        </div>
			
			 <div class="panel-body">
	  
		    <form id="iscrizione">
			<input id="inizio" name="inizio" type="hidden" value="1">
			<div class="col-md-12 col-sm-12 col-xs-12">
		                     <div class="form-group col-md-7 col-sm-7 col-xs-12">
                                            <label>Sid:</label>
                                           <input class="form-control" style="text-transform:uppercase;" id="sid" name="sid" type="text">
                                            <p class="help-block">Numero ricerca.</p>
							</div>	
								
							<div class="form-group col-md-5 col-sm-5 col-xs-12">
                                            <label>Prj:</label>
											<input class="form-control" style="text-transform:uppercase;" id="prj" name="prj" type="text">
                                            <p class="help-block">Codice progetto.</p>
                           
							 </div>	
			</div>
	
			
			<div class="col-md-12 col-sm-12 col-xs-12">
				
		                	
					
                         
					  
			</div>		  
	 
			
					<div class="col-md-12 col-sm-12 col-xs-12">
						 <div class="form-group has-success col-md-7 col-sm-7 col-xs-12">
                                            <label class="control-label" for="success">Numero Test</label>
                                           <input class="form-control"  id="nl" name="nl" type="text"  value="0">&nbsp;&nbsp;<span class="alert"></span>
                         </div>	
						  	
			
					</div>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="submit" id="crea" value="Inizia Test">&nbsp;&nbsp;&nbsp;
					
				</div> 

			
		
		    </form>
			
			
		    
		    </div>
	    
	  
	  </div>
	  
	  
	
	  


</div>









</div>

<div id="risposta"></div> 

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