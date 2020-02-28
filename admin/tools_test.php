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


	
	

?>
<div class="content-wrapper">
  <div class="container">
	   
 <div class="row">
	   
 
 <div class="col-xl-12 col-lg-8">
<div class="card shadow mb-12">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary"> TOOL AUTO TEST </h6></span>
                        </div>
			
			 <div class="card-body">
	  
		    <form id="iscrizione">
			<input id="inizio" name="inizio" type="hidden" value="1">

			<div class="form-row">


			<div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">SID:</label>
			</div>
             <input class="form-control" style="text-transform:uppercase;" id="sid" name="sid" type="text">
			</div>	
			</div>	

			<div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">PRJ:</label>
			</div>
			<input class="form-control" style="text-transform:uppercase;" id="prj" name="prj" type="text">
			</div>	
			</div>	

			<!-- END FORM ROW -->
			</div>
	
			
			<div class="form-row">  
			<div class="form-group col-md-6">
			<div class="input-group mb-3">
 			 <div class="input-group-prepend">
   			 <label class="input-group-text" for="inputGroupSelect01">Numero Test:</label>
			</div>
			<input class="form-control"  id="nl" name="nl" type="text"  value="0">
             </div>	
             </div>	
						  	
			 <div class="form-group col-md-6">
			<button class="btn btn-primary" type="submit" id="crea" value="Inizia Test">START</button>
			</div> 

			<!-- END FORM ROW -->
			</div>
		
		    </form>

<!-- END card body -->
</div>

</div>
</div>
</div>

<!-- BARRA RISPOSTE -->

<div class="row"> 
<div class="col-xl-12 col-lg-12">
<div id="risposta"></div> 
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