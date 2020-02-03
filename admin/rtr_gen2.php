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




?>




 <div class="content-wrapper">
       <div class="container">
	   




	
	


	   

 <div class="row">
	   
	   
<div class="col-md-8 col-sm-8 col-xs-12">
<div class="panel panel-info">
               <div class="panel-heading">
                          CREA LINK
                        </div>
			
			 <div class="panel-body">
	  
<form action="rtr_gen.php" method="post" enctype="multipart/form-data">  
   <input type="file" name="uploaded_file">  
   <input type="submit" name="up" value="Upload files">  
</form>   

<?php
  if(!empty($_FILES['uploaded_file']))
  {
    $path = "res/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
  
  
?>		    
		    </div>
	  
	  </div>
	
<div class="panel panel-info">
               <div class="panel-heading">
                         RISULTATO
                        </div>

						
		<div class="panel-body risultato">
	  
  
	    </div>
	  
	  </div>	
	


</div>



 <div class="col-md-4 col-sm-4 col-xs-12">
<div class="panel panel-danger">
               <div class="panel-heading">
                        CONFIGURA QUOTE 
                        </div>
			
<div class="panel-body">




  <div class="form-group">
                            <label>Totale interviste</label>
                            <input class="form-control" style="text-transform:uppercase;" id="totint" name="sid" type="number">
                            <p class="help-block">Imposta totale complete</p>
  </div>

  
  
   <hr />
   
     <div class="form-group">
                            <label>Quote per Leg</label>
			
							 
							 <p class="help-block">Inserire nome della leg:</p>
                            <input class="form-control"  id="nomeleg" type="text">
                        
						  <p class="help-block">Numero di leg da creare:</p>
							<input class="form-control" id="numleg" type="number">
                         
                           
							
							
  </div>
   
<button id="genera" class="btn btn-primary" data-clipboard-target=".lnk">Genera</button><br>
  
  <hr />
			
  

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

<script type='text/javascript'>

		
		var testo;
		var totint;
		var namleg;
		var quo;
		var perleg;
		
$( "#genera" ).on('click', function() {	
		totint="";
		testo="\"quota\": {<br/>\"total_interviews\":";
		totint=$("#totint").val();
		namleg=$("#nomeleg").val();
		numleg=$("#numleg").val();
		perleg=totint/numleg;
		quo="";
		
		testo=testo+totint;
		
		if (namleg !="")
		{
			testo=testo+", <br/>"+
			"\"total_by_leg\": <br/>{<br/>"+
			"\"variable_name\": \""+namleg+"\",<br/>"+
			"\"values\": {<br/>";
			
			for (i = 1; i <= numleg; i++) 
			{
				if (i==numleg) { quo=quo+"\""+i+"\":"+perleg+"<br/>}"; }
				else { quo=quo+"\""+i+"\":"+perleg+",<br/>"; }
			} 
			
			testo=testo+quo;
		}
		
		
		
		testo=testo+"<br/>}";
		$("div.risultato").html(testo);
		});
		
	</script>

</body>
</html>