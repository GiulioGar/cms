<html>
<head>

</head>

<body>





<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);
	  
	  $tradotto=$_REQUEST['tradotto'];
	  $nomeleg=$_REQUEST['nomeleg'];
	  $numleg=$_REQUEST['numleg'];
	  $sid=$_REQUEST['sid'];

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
                         CARICA SDL
                        </div>
			
			 <div class="panel-body">
	  
<form action="rtr_gen.php" method="post" enctype="multipart/form-data">  
   <input type="file" name="uploaded_file">  
   <input type="submit" name="up" value="Genera Config">  
   <input type="hidden" name="tradotto" value="1" />
 

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
                         SCARICA FILE DOMANDE
                        </div>



						
<div class="panel-body ">
	  
	  
	  <?php 


$pathsdl="res/".basename( $_FILES['uploaded_file']['name']);
$basename=$_FILES['uploaded_file']['name'];

	
$without_extension = basename($basename, '.sdl');




$conta=0;

$rtrtesto="{\n \"rtr\": { \n \"questions\": [";

$sdlb=file_get_contents($pathsdl);

///togliamo a capo
$sdlb=str_replace("\n", " " ,$sdlb);

//separiamo per domande
$arr = explode("send qst;", $sdlb);
	
	
	
	foreach ($arr as $a) {
		
		
	
		preg_match_all("(qst = new question\(\"(.*?)\", (.*?)\);)", $a , $id);
		preg_match_all("(qst.setProperty\(\"code\", \"(.*?)\"\);)", $a , $code);
		preg_match_all("(qst.setProperty\(\"options\", (.*?)\);)", $a , $opt);
		
		$contachoice=0;
		
		
		
		for ($i = 0; $i < 5000; $i++) 
		{
		
		$stringa=$id[0][$i];
		
		if ((strpos($stringa, 'composed') === false) && ($stringa!="")&&(strpos($stringa, 'concept') === false) && (strpos($stringa, 'scale') === false)&& (strpos($stringa, 'open') === false)&& (strpos($stringa, 'fixed_sum') === false)&& (strpos($stringa, 'concept_eval') === false)) {
			
			
		
		$salvaopt=$opt[1][$contachoice];	
		
		
			
		
		
		
		if (strpos($stringa, 'choice') !== false){$contachoice=$contachoice+1;}
			
		//echo $id[2][$i]." ".$code[1][$i]." ".$opt[1][$i];
		
		$salvaid=$id[2][$i];
		$salvacode=$code[1][$i];
		
		//echo $stringa." ".$salvaopt." ".$salvaid." ".$salvacode."<br>";
		
		
		
		if (strpos($salvaid, 'qid') === false)
		{
		
		
		preg_match_all("(vector ".$salvaopt." = new vector {(.*?)};)", $sdlb , $vet);
		
		$dimensionevettore=sizeof($vet);
		
		$rtrtesto=$rtrtesto."\n {\n\"id\": ".$salvaid.",";
		$rtrtesto=$rtrtesto."\n \"title\":\"".$salvacode."\",";
		$rtrtesto=$rtrtesto."\n \"labels\": [ ";
		
		for ($s = 0; $s <= $dimensionevettore; $s++) 
		{
		
		//echo $vet[1][$s];
		
		//echo "<br>";
		
		$item=$vet[1][$s];
		
		$item = str_replace("'", " ", $item);
		$item = str_replace("}", " ", $item);
		$item = str_replace("{", " ", $item);
		
		$rtrtesto=$rtrtesto.$item;
		
		}
		
		$rtrtesto=$rtrtesto."],";
		$rtrtesto=$rtrtesto."\n  \"show_table\": \"true\",";
		$rtrtesto=$rtrtesto."\n \"show_chart\": \"true\",";
		$rtrtesto=$rtrtesto."\n \"chart_type\": \"pie\"\n},";
		
	
		
		}
		}
		
		}
		
		
		
	}
	
	
	
	$rtrtesto=$rtrtesto."]";
	
	$rtrtesto = str_replace(",]", "]", $rtrtesto);
	
	
	if ($sid!="") {
				  $rtrtesto=$rtrtesto."\n},\n";
				  $rtrtesto=$rtrtesto."\"quota\": {\n\"total_interviews\":".$sid;
				  
				  $perleg=$totint/$numleg;
				  
				 
				  
				  if ($nomeleg!="")
								  {
								  $rtrtesto=$rtrtesto.",\n";
								  $rtrtesto=$rtrtesto."\"total_by_leg\": \n{\n";
								  $rtrtesto=$rtrtesto."\"variable_name\": \"".$nomeleg."\",\n";
								  $rtrtesto=$rtrtesto."\"values\": {\n";
								  
								  for ($j = 0; $j <=$numleg; $j++) 
								  {
									
								  if ($j==$numleg) { $quo=$quo."\"".$j."\":".$perleg."\n}"; }
								  else {$quo=$quo."\"".$j."\":".$perleg.",\n"; }
								  
								  }
								  
								  
								  
								  }
								  else
								  {
								  $rtrtesto=$rtrtesto."\n}";
								  }
				 
				  
				  
				  if ($nomeleg!=""){
					$rtrtesto=$rtrtesto.$quo;
								   $rtrtesto=$rtrtesto."\n}";
								   
								   $rtrtesto=$rtrtesto."\n}";
								   }
				  
				  
				  
				  }
				  else
				  {$rtrtesto=$rtrtesto."\n}";}
				  
	$rtrtesto=$rtrtesto."\n}";			  
	
	//$salvafile="res/".$without_extension.".txt";
	
	$salvafile="res/config.json";
	
	
	$fp = fopen($salvafile,"wb");
	fwrite($fp,$rtrtesto);
	fclose($fp);

	
	
	
	if ($tradotto=="1")
	{
	echo "<a href='".$salvafile."' download>SCARICA CONFIG</a>";
	}







//echo $rtrtesto;

?>
  
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
                            <input class="form-control"  id="nomeleg" name="nomeleg" type="text">
                        
						  <p class="help-block">Numero di leg da creare:</p>
							<input class="form-control" id="numleg" name="numleg" type="number">
                         
                           
							
							
  </div>

  

  
  <hr />
			
  

</div>
</div>
</div>





</div>
</div>
</div>

</form>  


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